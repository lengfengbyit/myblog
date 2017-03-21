<?php

namespace app\home\widget;

use app\common\controller\HomeCommon;

/**
 * 文章
 */
class Article extends HomeCommon {

	/**
	 * 文章搜索表单
	 * @return [type] [description]
	 */
	public function searchForm($keyword = '') {

		$this->assign('keyword', $keyword);
		return $this->fetch('widget:search');
	}

	/**
	 * 相关文章
	 * @param  string $info [description]
	 * @return [type]       [description]
	 */
	public function otherArticle($info = '') {

		// 相关文章
		$otherArtList = model('Article')->getOtherArtList($info);

		$this->assign('otherArtList', $otherArtList);
		return $this->fetch('widget:otherArticle');
	}
}