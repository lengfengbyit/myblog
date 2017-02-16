<?php

namespace app\admin\controller;

use app\common\controller\AdminCommon;

class ArticleCategory extends AdminCommon{

	//列表页
	public function index(){

		$list = model('ArticleCategory')->getCateTree();

		$this->assign('list',$list);
		return $this->fetch();
	}

	// add  get操作之前执行
	protected function formGetBefore($model){

		//获得菜单列表
		$list = $model->where(array('pid'=>0))->field('ac_id,cate_name')->select();

		$this->assign('list',$list);
	}

	//数据校验
	protected function _validate(){

		if(I("post.cate_name",'','trim') == ''){

			$this->ajaxReturn(['error'=>1,'msg'=>'请输入分类名称']);
		}

		return true;
	}

	//数据处理
	protected function _saveData($model){

		$data = [
			'pid' => I('post.pid',0,'intval'),
			'cate_name' => I('post.cate_name','','trim'),
			'sort' => I('post.sort',255,'intval'),
			'status' => I("post.status",1,'intval')
		];

		return $model->save($data);
	}
}