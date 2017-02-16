<?php

namespace app\common\model;

use app\common\model\Common;

/**
 *  权限规则 model
 */
class Rule extends Common{

	protected $table = '';
	protected $pk = 'id';

	public function __construct($data = []){

		// 设置表名
		$this->table = C('database.prefix') . 'auth_rule';

		parent::__construct($data);
	}

	/**
	 * 获得菜单树
	 * @return [type] [description]
	 */
	public function getMenuTree($condition=[]){

		$list = $this->where($condition)->order(array('type'=>'asc','id'=>'asc'))->select();

		$res = getTree($list,'pid','id');

		return $res;
	}
}