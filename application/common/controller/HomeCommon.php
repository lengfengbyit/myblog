<?php

namespace app\common\controller;

use think\Controller;

class HomeCommon extends Controller{

	
	public function __construct(){	

		parent::__construct();

		// 导航菜单
		$navMenu = model('menu')->getNavMenu();

        // 网站信息
        $siteInfo = Model('site')->getSiteInfo();
    
        $this->assign('siteInfo',$siteInfo);
		$this->assign('navMenu',$navMenu);
	}

    /**
     * 返回ajax 数据
     * @return [type] [description]
     */
    protected function ajaxReturn($jsonData=[]){

        echo json_encode($jsonData);die;
    }   
}