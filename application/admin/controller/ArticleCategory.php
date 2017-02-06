<?php

namespace app\admin\controller;

use app\common\controller\AdminCommon;

class ArticleCategory extends AdminCommon{

	public function index(){

		$this->getIndexData();

		return $this->fetch();
	}

}