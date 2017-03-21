<?php

namespace app\common\controller;

use think\Controller;
use think\Request;

class HomeCommon extends Controller {

	protected $req = '';

	public function __construct(Request $req) {

		parent::__construct($req);

		$this->req = $req;

		// 导航菜单
		$navMenu = model('menu')->getNavMenu();

		// 网站信息
		$siteInfo = Model('site')->getSiteInfo();

		$this->assign('siteInfo', $siteInfo);
		$this->assign('navMenu', $navMenu);
	}

	/**
	 * 返回ajax 数据
	 * @return [type] [description]
	 */
	protected function ajaxReturn($jsonData = []) {

		echo json_encode($jsonData);die;
	}
}