<?php

namespace app\admin\controller;

use app\common\controller\AdminCommon;

/**
 * 角色管理
 */
class Role extends AdminCommon{

	public function index(){

		$this->getIndexData();

		return $this->fetch();
	}

	/**
	 * 规则授权
	 * @return [type] [description]
	 */
	public function editRule(){

		if(!isPost()){

			$list = model('rule')->getMenuTree();
			$id = I('id');

			$this->assign('id',$id);
			$this->assign('list',$list);
			return $this->fetch();
		}else{

			$id = I('post.id',0,'intval');
			$rules = array_keys($_POST['rules']);

			$rules = implode(',', $rules);

			$model = $this->model->get($id);
			$model->rules = $rules;
			
			if($model->save()){

				echo ['error'=>0,'msg'=>'授权成功'];
			}else{

				echo ['error'=>1,'msg'=>'授权失败'];
			}
		}
	}

	protected function _validate(){

		if(I('post.title','','trim') == ''){

			return ['error'=>1,'msg'=>'请输入角色名称'];
		}

		return true;
	}

	protected function _saveData($model){

		$data = [

			'title' => I("post.title",'','trim'),
			'status' => I('post.status',1,'intval'),
			'rules' => isset($_POST['rules']) ? implode(',', $_POST['rules']) : ''
		];

		return $model->save($data);
	}
}