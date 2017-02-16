<?php

namespace app\admin\controller;

use think\Validate;
use app\common\controller\AdminCommon;

/**
 *  权限规则管理
 */
class Rule extends AdminCommon{


	public function index(){

		$list = $this->model->getMenuTree();

		$this->assign('list',$list);
		return $this->fetch();
	}

	protected function formGetBefore(){

		$list = $this->model->where('type',0)->select();

		$this->assign('list',$list);
	}

	protected function _validate(){

		$rule = [
			'title' => 'require',
		];
		$msg = [
			'title' => '请输入规则名称'
		];

		if(I('post.pid',0,'intval') > 0){

			$rule['name'] = 'require';
			$msg['name'] = '请输入规则唯一标识';
		}

		$validate = new Validate($rule,$msg);

		if(!$validate->check(I('post.'))){

			return ['error' => 1, 'msg' => $validate->getError()];
		}

		return true;
	}

	protected function _saveData($model){

		$data = [
			'title'     => I('post.title','','trim'),
			'status'    => I('post.status',1,'intval'),
			'name'      => I('post.name','','trim'),
			'condition' => I('post.condition','','trim'),
			'pid'       => I('post.pid',0,'intval'),
			'type'      => 0,
		];

		if(I('post.pid') > 0){
			
			$data['type'] = 1;
		}	

		return $model->save($data);
	}
}