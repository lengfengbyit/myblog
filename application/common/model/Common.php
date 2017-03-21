<?php

namespace app\common\model;

use think\Model;

class Common extends Model {

	public function getField() {

		if (empty($this->field)) {

			$this->field = $this->db(false)->getTableInfo('', 'fields');
		}

		return $this->field;
	}

	/**
	 * 初始化表字段
	 * @param  array  $setting [设置字段默认值]
	 * @return [type]          [description]
	 */
	public function initField($setting = []) {

		$res = [];

		$field = $this->getField();

		foreach ($field as $k => $v) {

			$res[$v] = '';
		}

		return array_merge($res, $setting);
	}

}