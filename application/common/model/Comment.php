<?php

namespace app\common\model;

use app\common\model\Common;

class Comment extends Common {

	/**
	 * 多对一关联
	 * @return [type] [description]
	 */
	public function article() {

		return $this->belongsTo('article', 'a_id');
	}

	/**
	 * 获得被回复的留言信息
	 * @return [type] [description]
	 */
	public function getRevNickNameAttr($value, $data) {

		return $this->where(['c_id' => $data['rev_cid']])->value('nick_name');
	}

	/**
	 * 最新留言
	 * @param  array   $conditon [description]
	 * @param  integer $page     [description]
	 * @return [type]            [description]
	 */
	public function getNewCommentList($condition = [], $page = 10) {

		return $this->where($condition)->order('c_id desc')->limit($page)->select();
	}

	/**
	 * 获得留言列表
	 * @param  array  $condition [description]
	 * @param  [type] $order     [description]
	 * @param  string $filed     [description]
	 * @return [type]            [description]
	 */
	public function getPageList($condition = [], $page = "10", $field = "*", $order = "create_time desc") {

		return $this->field($field)->where($condition)->order($order)->paginate($page);
	}
}