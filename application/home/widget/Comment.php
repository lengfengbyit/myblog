<?php

namespace app\home\widget;

use app\common\controller\HomeCommon;

/**
 * 留言
 */
class Comment extends HomeCommon {

	/**
	 * 最新留言列表
	 * @return [type] [description]
	 */
	public function lastCommentList() {
		// 最新留言
		$commentList = Model('Comment')->getNewCommentList();

		$this->assign('commentList', $commentList);
		return $this->fetch('widget:lastCommentList');
	}

	/**
	 * 发表留言
	 * @param int $aid 文章id
	 */
	public function addComment($aid = 0) {

		$this->assign('aid', $aid);
		return $this->fetch('widget:addComment');
	}
}