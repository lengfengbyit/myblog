<?php

namespace app\common\model;

use app\common\model\Common;

class Log extends Common{

	//自动写入时间戳
	protected $autoWriteTimestamp = true;

	//不写更新字段
	// protected $updateTime = false;	

}