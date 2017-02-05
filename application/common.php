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