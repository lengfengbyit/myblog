<?php

namespace app\common\model;

use app\common\model\Common;

class RoleAccess extends Common{

	public function __construct($data = []){

		$this->table = C('database.prefix') . 'auth_group_access';
		parent::__construct($data);
	}
}