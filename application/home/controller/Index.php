<?php 

namespace app\home\controller;

use app\common\controller\HomeCommon;

class Index extends HomeCommon{

	public function index(){

        // 文章列表
        $articleList = Model('article')->getArtFullList();
        $page = $articleList->render();

        // 标签列表
        $tagList = Model('tag')->all();

        // 最新留言
        $commentList = Model('comment')->order('c_id desc')->limit(10)->select();

        $this->assign('page',$page);
        $this->assign('tagList',$tagList);
        $this->assign('articleList',$articleList);
        $this->assign('commentList',$commentList);
		return $this->fetch();
	}
}