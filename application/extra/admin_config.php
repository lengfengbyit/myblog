<?php 

/**
 * 后台扩展配置
 */

return [
	//头像配置
	'avatar' => [
		'max_size' => 500 * 1024 * 1024,//500KB
		'max_size_msg' => '头像图片的最大尺寸为500KB,请重新上传',
		'save_path' => UPLOAD_PATH . 'avatar/' 
	]
];