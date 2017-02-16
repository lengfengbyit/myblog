<?php

namespace app\admin\controller;

use app\common\controller\AdminCommon;

class Tag extends AdminCommon{

	public function index(){

		$this->getIndexData();

		return $this->fetch();
	}

	public function _validate(){

		if(I('post.tag_name','','trim') == ''){

			$this->ajaxReturn(['error'=>1,'msg'=>'标签名称不能为空']);
		}

		return false;
	}

	public function _saveData($model){

		$data = [
			'tag_name' => I("post.tag_name",'','trim'),
			'sort' => I('post.sort',255,'intval'),
			'status' => I('post.status',1,'intval')
		];

		return $model->save($data);
	}
}