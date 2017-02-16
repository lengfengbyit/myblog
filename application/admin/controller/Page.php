<?php

namespace app\admin\controller;

use think\Validate;

use app\common\controller\AdminCommon;

/**
 *  单页面 管理
 */
class Page extends AdminCommon{

	public function index(){

		$this->getIndexData();

		return $this->fetch();
	}

	public function _validate(){

		$validate = new Validate([
			'title' => 'require',
			'content' => 'require'
		],[
			'title' => '请输入标题',
			'content' => '内容不能为空'
		]);

		$res = $validate->check($_POST);

		if(!$res){

			return ['error'=>1,'msg'=>$validate->getError()];
		}

		return true;
	}

	public function _saveData($model){

		$data = [
			'title' => I('post.title','','trim'),
			'content' => I('post.content','','htmlspecialchars'),
			'sort' => I('post.sort',255,'intval'),
			'status' => I('post.status',1,'intval')
		];

		return $model->save($data);
	}
}