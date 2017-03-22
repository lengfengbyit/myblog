<?php

namespace app\common\model;

use app\common\model\Common;

class Article extends Common {

	/**
	 * 定义全局查询范围 ，查询的时候自动合并该查询条件
	 * @param  [type] $query [description]
	 * @return [type]        [description]
	 */
	public function base($query) {

		$query->where('is_show', 1);
	}

	/**
	 * 文章类型一对一关联
	 * @return [type] [description]
	 */
	public function artCate() {

		return $this->hasOne('articleCategory', 'ac_id');
	}

	/**
	 * 文章评论一对多关联
	 * @return [type] [description]
	 */
	public function comments() {

		return $this->hasMany('comment', 'a_id')->order('create_time desc');
	}

	/**
	 * 获得文章标签
	 * @param  $field 获得标签属性
	 * @param  $mode 返回值类型 0：数组，1：标签名字符串
	 * @return [type] [description]
	 */
	public function tags($field = "tag_name", $mode = 0) {

		$res = Model('tag')->where(['t_id' => ['in', $this->tag_ids]])->column($field);
		if ($mode && is_string($res[0])) {

			return implode(',', $res);
		}
		return $res;
	}

	/**
	 * 获得文章信息（包括关联信息）
	 * @return [type] [description]
	 */
	public function getArtFullList($param = [], $page = 10) {

		$condition = ['is_show' => 1];
		if (isset($param['condition'])) {
			$condition = array_merge($condition, $param['condition']);
		}
		$articleList = $this->where($condition)->order('a_id desc')->paginate($page);

		// 标签获取模式 ： 0：数组模式，1:字符串模式
		$tag_mode = isset($param['tag_mode']) ? intval($param['tag_mode']) : 0;
		if ($tag_mode == 0) {
			$tag_field = 't_id,tag_name';
		} else {
			$tag_field = 'tag_name';
		}
		foreach ($articleList as $i => $art) {
			// 标签预加载
			$articleList[$i]['tags'] = $art->tags($tag_field, $tag_mode);
			// 分类名称预加载
			$articleList[$i]['cate_name'] = $art->artCate['cate_name'];
		}

		return $articleList;
	}

	/**
	 * 获得文章详情（包括关联信息）
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getFullInfoById($id) {

		$info = $this->get($id);
		$info['tags'] = $info->tags();
		$info['cate_name'] = $info->artCate['cate_name'];
		return $info;
	}

	/**
	 * 根据当前文章获得其他类似的文章
	 * @param  [type] $art [description]
	 * @return [type]      [description]
	 */
	public function getOtherArtList($art, $field = "a_id,title,create_time", $page = 10) {

		$condition = [];
		if (!empty($art)) {

			$condition = "a_id <> {$art->a_id} and (ac_id = {$art->ac_id} or tag_ids = '{$art->tag_ids}')";
		}
		return $this->field($field)->where($condition)->limit($page)->select();
	}
}