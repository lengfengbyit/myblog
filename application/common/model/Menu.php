<?php

namespace app\common\model;

use app\common\model\Common;

class Menu extends Common {

	/**
	 * 获得菜单树
	 * @return [type] [description]
	 */
	public function getMenuTree($condition) {

		$list = $this->where($condition)->order(array('level' => 'asc', 'sort' => 'desc'))->select();

		$res = getTree($list, 'p_mid', 'm_id');

		return $res;
	}

	/**
	 * 获得导航菜单
	 * @return [type] [description]
	 */
	public function getNavMenu() {

		$list = cache('home_nav_menu');
		if (!$list) {
			$condition = ['type' => 1, 'status' => 1];
			$order = ['level' => 'asc', 'sort' => 'desc', 'm_id' => 'asc'];
			$list = $this->where($condition)->order($order)->select();
			cache('home_nav_menu', $list);
		}
		return $list;
	}
}