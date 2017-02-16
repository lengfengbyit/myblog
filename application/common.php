<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 判断是否是post请求
 * @return boolean [description]
 */
function isPost(){

	return request()->isPost();
}

/**
 * 获得请求参数
 * @param [type] $val [description]
 */
function I($val, $default = null, $filter = ''){

	return input($val, $default, $filter);
}

/**
 * 获取配置信息
 * @param [type] $val [description]
 */
function C($val){

	return config($val);
}

/**
 * 获得请求信息
 * @param  [type] $param [description]
 * @return [type]        [description]
 */
function req($param){

	return request()->$param();
}

/**
 * 格式化时间戳
 * @param  [type] $time [description]
 * @return [type]       [description]
 */
function time_formate($time,$format='Y:m:d H:i'){

	return $time > 0 ? date($format,$time) : '';
}

function status_icon($status = 0){
	if(!empty($status)){

		return '<i style="color:green;" class="layui-icon">&#xe616;</i>';
	}else{

		return '<i style="color:red;" class="layui-icon">ဇ</i>';
	}								
}

// 规则类型
function rule_type($type = 0){

	if($type == 0){

		return '模块';
	}

	return '规则';
}

/**
 * 获得树形菜单
 * @param  [type] $list [数据]
 * @param  [type] $pid  [父id 字段]
 * @param  [type] $id   [id 字段]
 * @return [type]       [description]
 */
function getTree($list,$pid,$id){

	$res = [];
	foreach ($list as $k => $item) {
		
		$item = is_array($item) ? $item : $item->toArray();
		if($item[$pid] == 0){

			$item['children'] = _getTree($item,$list,$pid,$id);
			$res[] = $item;
		}
	}

	return $res;
}

/**
 * 递归实现树形菜单 工具函数 依赖getTree
 * @param  [type] $item [description]
 * @param  [type] $list [description]
 * @param  [type] $pid  [description]
 * @param  [type] $id   [description]
 * @return [type]       [description]
 */
function _getTree($item,$list,$pid,$id){

	if(empty($item) || empty($list)){

		return;
	}	

	$res = [];
	$item = is_array($item) ? $item : $item->toArray();
	foreach ($list as $k => $v) {

		$v = is_array($v) ? $v : $v->toArray();
		if( $v[$pid] == $item[$id]){

			$v['children'] = _getTree($v,$list,$pid,$id);
			$res[] = $v;
		}
	}
	return $res;
}