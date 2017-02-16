<?php

namespace app\admin\controller;

use think\Validate;
use app\common\controller\AdminCommon;

class Article extends AdminCommon{

	//前置操作
	protected $beforeActionList = [
		'initDefaultField' => ['only'=>'add']
	];

	//初始化field
	protected function initDefaultField(){

		$this->initDefaultField = ['is_show'=>1];
	}

	public function index(){

		$this->getIndexData();

		return $this->fetch();
	}

	/**
	 * form 表单 打开时的操作，准备页面数据。
	 * @return [type] [description]
	 */
	protected function formGetBefore(){

		$cateList = model('ArticleCategory')->getCateTree();

		$tagList = model('Tag')->getTagList();

		$this->assign('tagList',$tagList);
		$this->assign('cateList',$cateList);
	}

	/**
	 * 数据校验
	 * @return [type] [description]
	 */
	public function _validate(){

		$validate = new Validate([
			'ac_id' => 'require|number|gt:0',
			'tag_ids' => 'require',
			'title' => 'require',
			'content' => 'require'
		],[
			'ac_id' => '请选择所属分类',
			'tag_ids' => '请选择标签',
			'title'  => '请输入标题',
			'content' => '请输入文章内容'
		]);

		if(!$validate->check($_POST)){

			return ['error'=>1,'msg'=>$validate->getError()];
		}
		return true;
	}

	/**
	 * 数据保存
	 * @param  [type] $model [description]
	 * @return [type]        [description]
	 */
	public function _saveData($model){
		
		$data = [
			'ac_id'     => I('post.ac_id',0,'intval'),
			'tag_ids'     => implode(',', array_keys($_POST['tag_ids'])),
			'title'       => I('post.title','','trim'),
			'is_show'     => I('post.is_show',1,'intval'),
			'summary'     => I('post.summary','','trim'),
			'content'     => I('post.content','','trim'),
			'create_time' => time(),
			'admin_id'    => session('admin_info.a_id')
		];

		if($data['summary'] == ''){

			$data['summary'] = mb_substr(str_replace(' ', '', strip_tags($data['content'])), 0,200,'utf-8');
		}

		return $model->save($data);
	}
}