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
	],
	'site_logo' => [
		'max_size' => 500 * 1024 * 1024,//500KB
		'max_size_msg' => 'LOGO图片的最大尺寸为500KB,请重新上传',
		'save_path' => UPLOAD_PATH . 'site/' 
	],
	'site' => [
    	// 站点设置属性
    	'setting_field' => [
    		'site_name' => '',
    		'site_logo' => '',
    		'site_copyright' => '',
    		'visitor_message' => 0,
    		'site_open' => 0
    	],
    	// seo设置属性
    	'seo_field' => [
    		'title' => '',
    		'key' => '',
    		'desc' => ''
    	]
    ]
];