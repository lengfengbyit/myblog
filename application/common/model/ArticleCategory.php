<?php

namespace app\common\model;

use app\common\model\Common;

class ArticleCategory extends Common{

    /**
     * 一对多关联
     * @return [type] [description]
     */
    public function article(){

        return $this->hasMany('article','a_id','ac_id');
    }

	/**
	 * 获得菜单树
	 * @return [type] [description]
	 */
	public function getCateTree($condition='status = 1'){

		$list = $this->where($condition)->order(array('level'=>'asc','sort'=>'desc'))->select();

		$res = getTree($list,'pid','ac_id');

		return $res;
	}


}