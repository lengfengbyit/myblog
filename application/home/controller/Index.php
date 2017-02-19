<?php 

namespace app\home\controller;

use app\common\controller\HomeCommon;

class Index extends HomeCommon{

	public function index(){

		$c = config('template');
		// dump($c);die;
		return $this->fetch();
	}
}