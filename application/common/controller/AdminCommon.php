<?php

namespace app\common\controller;

use think\Controller;
use think\Request;

abstract class AdminCommon extends Controller {


	//不做登录判断的action
	protected $ignore_action = ['login','logout']; 

	// 忽略不存在模型的控制器
	protected $ignore_controller = ['Index'];

	protected $req;

	protected $initDefaultField = ['status'=>1,'sort'=>255];

	protected $model;

	//日志类型
	protected $logType = [
		'add' => '添加',
		'edit' => '编辑',
		'del' => '删除',
		'delselect' => '删除选中',
		'clearall' => '清空',
		'createnav' => '创建菜单'
	];

	//日志状态
	protected $logStatus = ['success'=>'成功','error'=>'失败'];

	public function __construct(Request $req){

		parent::__construct($req);

		$this->req = $req;

		//判断是否登录
		if( !session('?admin_info') && 
			!in_array( $req->action() ,$this->ignore_action ) ){
		
			$this->redirect('Index/login');
		}

		$controller = $this->req->controller();

		if(!$this->model && !in_array($controller, $this->ignore_controller)){

			$this->model = model($controller);
		}
	}

	//列表页面
	abstract public function index();

	//表单数据校验
	abstract protected function _validate();

	//保存数据
	abstract protected function _saveData($model);

	/**
	 * 获得index页面 数据
	 * @return [type] [description]
	 */
	protected function getIndexData($condition=[],$order='',$model='',$page=10){
	
		$list = $this->model->where($condition)->order($order)->paginate($page);
		$page = $list->render();
		
		$this->assign('list',$list);
		$this->assign('page',$page);
	}

	/**
	 * 返回ajax 数据
	 * @return [type] [description]
	 */
	protected function ajaxReturn($jsonData=[]){

		echo json_encode($jsonData);die;
	}	

	/**
	 * 新增操作
	 */
	public function add(){
		
		$model = $this->model;

		if(!isPost()){

			$info = $model->initField($this->initDefaultField);

			$this->assign('url',url('add'));
			$this->assign('info',$info);

			$this->trigger('formGetBefore');

			return $this->fetch('form');
		}else{
			
			$res = $this->trigger('_validate');
			if( $res !== true){

				$this->ajaxReturn($res);
			}
			
			$this->trigger('addPostBefore',$model);

			if($this->_saveData($model)){

				$id = $model->getData($model->getPk());
				$this->addLog($id,'success');
				$this->ajaxReturn(['error'=>0,'msg'=>'添加成功']);
			}else{

				$this->addLog(false,'error');
				$this->ajaxReturn(['error'=>1,'msg'=>'添加失败,请重新添加']);
			}
		}
	}

	/**
	 * 编辑操作
	 * @return [type] [description]
	 */
	public function edit(){ 

		$id = I('id',0,'intval');
		$model = $this->model;
		$info = $model->get($id);
		
		if(!isPost()){

			if($id <= 0){

				$this->ajaxReturn(['error'=>1,'msg'=>'数据不存在']);
			}

			$this->trigger('formGetBefore',$model);

			$this->assign('url',url('edit',array('id'=>$id)));
			$this->assign('info',$info);
			return $this->fetch('form');
		}else{

			// $res = $this->_validate();
			$res = $this->trigger('_validate');
			if( $res !== true){

				$this->ajaxReturn($res);
			}
			
			if($this->_saveData($info)){

				$this->addLog($id,'success');
				$this->ajaxReturn(['error'=>0,'msg'=>'编辑成功']);
			}else{

				$this->addLog($id,'error');
				$this->ajaxReturn(['error'=>1,'msg'=>'编辑失败']);
			}
		}
	}

	/**
	 * 删除
	 * @return [type]            [description]
	 */
	public function del(){

		$id = I('id',0,'intval');
		$page = I('page',1,'intval');

		if($id == 0){

			$this->error('请求参数错误');
		}

		$model = $this->model;

		$modelData = null;
		if(method_exists($this, 'delAfter')){
			$modelData = $model->get($id);
		}
		
		if($model->get($id)->delete()){

			$this->trigger('delAfter',$modelData);
			
			$this->addLog($id,'success');
			$this->ajaxReturn(['error'=>0,'msg'=>'删除成功']);
		}else{

			$this->addLog($id,'error');
			$this->ajaxReturn(['error'=>1,'msg'=>'删除失败']);
		}
	}

	/**
	 * 删除选中项
	 * @return [type] [description]
	 */
	public function delSelect(){

		$param = request()->param();

		$ids = implode(',', $param['id']);

		if(empty($ids)){

			$this->error('没有选中数据');
		}

		$model = $this->model;

		$condition = $model->getPk() . " in ({$ids})";

		$list = null;
		if(method_exists($this, 'delSelectAfter')){

			$list = $model->all($ids);
		}
		$res = $model->where($condition)->delete();

		if($res){

			$this->trigger('delSelectAfter',$list);

			$this->addLog($ids,'success');
			$this->success('删除成功','index');
		}else{

			$this->addLog($ids,'error');
			$this->error('删除失败');
		}
	}

	/**
	 * 添加日志 
	 * @param [type] $data [description]
	 */
	protected function addLog($id,$res){

		$action = $this->req->action();
		$statusText = $this->logStatus[$res];
		$actionText = $this->logType[$action];

		$title = $actionText;
		if($id){

			$title .= "数据，id:" . $id . "," ;
		}
		$title .= $statusText;

		$data = [
			'title' => $title,
			'table' => $this->req->controller(),
			'action' => $action,
			'admin_id' => session('admin_info.a_id'),
			'create_time' => time()
		];

		return model('Log')->insert($data);
	}

	/**
	 * 触发事件
	 * @param  [type] $method [方法名]
	 * @param  [type] $param  [参数]
	 * @return [type]         [description]
	 */
	protected function trigger($method,$param = null){

		if(method_exists($this, $method)){

			return $this->$method($param
				);
		}

		return false;
	}
}