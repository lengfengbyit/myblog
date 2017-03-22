<?php

namespace app\admin\controller;

use app\common\controller\AdminCommon;

/**
 * 留言管理
 */
class Comment extends AdminCommon {

	public function index() {

		$this->getIndexData(['rev_cid' => 0]);

		return $this->fetch();
	}

	protected function _validate() {

	}

	protected function _saveData($model) {

	}
}