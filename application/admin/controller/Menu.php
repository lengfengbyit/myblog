<?php

namespace app\admin\controller;

use think\Validate;

use app\common\controller\AdminCommon;

/**
 * 菜单管理类
 */
class Menu extends AdminCommon{

	public function index(){

		$type = I('type',0,'intval');

		$condition = ['type'=>$type];

		$list = model('Menu')->getMenuTree($condition);

		$this->assign('type',$type);
		$this->assign('list',$list);
		return $this->fetch();
	}

	/**
	 * get 请求，输出页面之前执行
	 * @param [type] $model [description]
	 */
	public function addGetBefore($model){

		$type = I('type',0,'intval');
		$list = $model->all(['p_mid'=>0,'type'=>$type]);
		$this->assign('type',$type);
		$this->assign('list',$list);
	}

	/**
	 * get 请求，输出页面之前执行
	 * @param [type] $model [description]
	 */
	public function editGetBefore($model){

		$list = $model->all(['p_mid'=>0]);
		$this->assign('list',$list);
	}

	/**
	 * 创建菜单
	 * @return [type] [description]
	 */
	public function createNav(){

		$list = model('Menu')->getMenuTree(['type'=>0,'status'=>1]);

		$res = [];

		foreach ($list as $k => $val) {
			
			$item = [
				'title' => $val['menu_name'],
				'icon' => $val['icon_class']
			];

			if(isset($val['children']) && count($val['children']) > 0){
				$item['spread'] = false;
				$children = [];

				foreach ($val['children'] as $k => $child) {
					
					$children[] = [
						'title' => $child['menu_name'],
						'icon' => $child['icon_class'],
						'href' => $child['url']
					];
				}
				$item['children'] = $children;
			}else{

				$item['href'] = $val['url'];
			}

			$res[] = $item;
		}

		$str = json_encode($res);
		$navStr = 'var navs = ' . $str;

		$filename = ROOT_PATH . '\static\admin\datas\nav.js';
		if(file_put_contents($filename, $navStr) > 0){

			$this->ajaxReturn(['error'=>0,'msg'=>'创建成功']);
		}else{

			$this->ajaxReturn(['error'=>1,'msg'=>'创建失败']);
		}
	}


	/**
	 * 表单验证
	 * @return [type] [description]
	 */
	protected function _validate(){
		
		$validate = new Validate([
			'menu_name' => 'require',
		],[
			'menu_name' => '菜单名称不能为空',
		]);

		if(!$validate->check(I('post.'))){

			$this->ajaxReturn(['error'=>1,'msg'=>$validate->getError()]);
		}
	}

	/**
	 * 保存数据
	 * @return [type] [description]
	 */
	protected function _saveData($model){

		$model->p_mid = I('post.p_mid',0,'intval');
		$model->menu_name = I('post.menu_name');
		$model->url_type = I('post.url_type');
		$model->param = I('post.param');
		$model->sort = I('post.sort',255,'intval');
		$model->status = I("post.status",1,'intval');
		$model->icon_class = I('post.icon_class','');
		$model->type = I('type',0,'intval');
		$model->level = 1;

		//控制器模式
		if($model->url_type == 0){

			$model->module = I('post.module');
			$model->controller = I('post.controller');
			$model->action = I('post.action');

			$url = [$model->module,$model->controller,$model->action];
			$model->url = url(implode('/', $url),'',false,true);
		}
		//站内路径模式
		else if($model->url_type == 1){

			$model->url = DOMAIN . I('post.url');
		}
		//站外链接模式
		else{

			$model->url = I('post.url');
		}

		//路径后面跟上参数
		if(!empty($model->param)){

			$model->url .= '?' . $model->param;
		}

		if($model->p_mid > 0){

			$parent = model('Menu')->get($model->p_mid);
			$model->level = $parent->level + 1;
		}

		return $model->save();
	}
}