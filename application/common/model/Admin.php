<?php

namespace app\common\model;

use app\common\model\Common;

use traits\model\SoftDelete;

class Admin extends Common{

	use SoftDelete;
 
	protected $pk = 'a_id';//主键，默认自动识别，也可手动设置

	// 获取器 
	public function getRegisterTimeAttr($val){

		return date($this->dateFormat,$val);
	}
}