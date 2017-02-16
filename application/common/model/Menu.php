<?php

namespace app\common\model;

use app\common\model\Common;

class Menu extends Common{

	/**
	 * 获得菜单树
	 * @return [type] [description]
	 */
	public function getMenuTree($condition){

		$list = $this->where($condition)->order(array('level'=>'asc','sort'=>'desc'))->select();

		$res = getTree($list,'p_mid','m_id');

		return $res;
	}
	

}