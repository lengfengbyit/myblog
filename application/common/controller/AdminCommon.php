<?php

namespace app\common\controller;

use think\Controller;
use think\Request;

class AdminCommon extends Controller {


	//不做登录判断的action
	protected $ignore_action; 

	protected $req;

	public function __construct(Request $req){

		parent::__construct($req);

		$this->req = $req;

		$this->ignore_action = [
			'login','logout'
		];


		//判断是否登录
		if( !session('?admin_info') && 
			!in_array( $req->action() ,$this->ignore_action ) ){
		
			$this->redirect('Index/login');
		}

	}

	/**
	 * 获得index页面 数据
	 * @return [type] [description]
	 */
	protected function getIndexData($condition=[],$order='',$model='',$page=10){

		if($model == ''){

			$model = $this->req->controller();
		}
	
		$list = model($model)->where($condition)->order($order)->paginate($page);
		$page = $list->render();
		
		$this->assign('list',$list);
		$this->assign('page',$page);
	}

	/**
	 * 返回ajax 数据
	 * @return [type] [description]
	 */
	protected function ajaxReturn($jsonData=[]){

		echo json_encode($jsonData);
	}	

	/**
	 * 新增操作
	 */
	public function add(){
		
		$model = model($this->req->controller());

		if(!isPost()){

			$info = $model->initField(['status'=>1]);

			$this->assign('url',url('add'));
			$this->assign('info',$info);

			if(method_exists($this, 'addGetBefore')){

				$this->addGetBefore($model);
			}

			return $this->fetch('form');
		}else{
			
			$this->_validate();
			
			if(method_exists($this, 'addPostBefore')){

				$this->addPostBefore($model);
			}

			if($this->_saveData($model)){

				$this->ajaxReturn(['error'=>0,'msg'=>'添加成功']);
			}else{

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
		$model = model($this->req->controller());
		$info = $model->get($id);

		if(!isPost()){

			if($id <= 0){

				$this->ajaxReturn(['error'=>1,'msg'=>'数据不存在']);
			}

			if(method_exists($this, 'editGetBefore')){

				$this->editGetBefore($model);
			}

			$this->assign('url',url('edit',array('id'=>$id)));
			$this->assign('info',$info);
			return $this->fetch('form');
		}else{

			$this->_validate();

			if($this->_saveData($info)){

				$this->ajaxReturn(['error'=>0,'msg'=>'编辑成功']);
			}else{

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

		$model = model($this->req->controller());

		$haAfter = method_exists($this, 'delAfter');
		if($haAfter){
			$modelData = $model->get($id);
		}
		
		if($model->get($id)->delete()){

			if($haAfter){

				$this->delAfter($modelData);
			}

			$this->ajaxReturn(['error'=>0,'msg'=>'删除成功']);
		}else{

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

		$model = model($this->req->controller());

		$condition = $model->getPk() . " in ({$ids})";

		$hasAfter = method_exists($this, 'delSelectAfter');

		if($hasAfter){

			$list = $model->all($ids);
		}
		$res = $model->where($condition)->delete();

		if($res){

			if($hasAfter){

				$this->delSelectAfter($list);
			}

			$this->success('删除成功','index');
		}else{

			$this->error('删除失败');
		}
	}

}