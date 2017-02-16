<?php

namespace app\common\model;

use app\common\model\Common;

class Role extends Common{
	
	public function __construct($data = []){

		$this->table = C('database.prefix') . 'auth_group';

		parent::__construct($data);
	}
}