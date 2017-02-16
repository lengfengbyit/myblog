<?php 

namespace app\common\model;

use app\common\model\Common;

class Tag extends Common{
	

	public function getTagList($condition=['status'=>1],$order="sort desc,t_id asc"){

		return $this->where($condition)->order($order)->select();
	}
}