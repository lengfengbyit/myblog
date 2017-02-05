<?php

namespace app\common\model;

use app\common\model\Common;

class Menu extends Common{

	/**
	 * 获得菜单树
	 * @return [type] [description]
	 */
	public function getMenuTree($condition){

		$list = $this->where($condition)->order('level','asc')->select();

		$res = [];
		foreach ($list as $k => $item) {
			
			$item = is_array($item) ? $item : $item->toArray();
			if($item['p_mid'] == 0){

				$item['children'] = $this->_getMenuTree($item,$list);
				$res[] = $item;
			}
		}

		return $res;
	}

	/**
	 * 递归查询，获得数据结构
	 * @param  [type] $item [description]
	 * @param  [type] $list [description]
	 * @return [type]       [description]
	 */
	private function _getMenuTree($item,$list){

		if(empty($item) || empty($list)){

			return;
		}	

		$res = [];
		$item = is_array($item) ? $item : $item->toArray();
		foreach ($list as $k => $v) {

			$v = is_array($v) ? $v : $v->toArray();
			if( $v['p_mid'] == $item['m_id']){

				$v['children'] = $this->_getMenuTree($v,$list);
				$res[] = $v;
			}
		}
		return $res;
	}

}