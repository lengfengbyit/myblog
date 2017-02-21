<?php

namespace app\common\controller;

use think\Controller;

class HomeCommon extends Controller{

	
	public function __construct(){	

		parent::__construct();

		// dump(config('template'));die;
		// 导航菜单
		$navMenu = model('menu')->getNavMenu();

		$this->assign('navMenu',$navMenu);
	}
}