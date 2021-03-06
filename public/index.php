<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
define('DOMAIN', 'http://myblog.com/');
define('ROOT_PATH', __DIR__ . '/');
define('STATIC_URL', DOMAIN . 'static/');
define('UPLOAD_PATH', __DIR__ . '/static/upload/');
define('UPLOAD_URL', STATIC_URL . 'upload/');
define('CONF_PATH', __DIR__ . '/../config/');
define('RUNTIME_PATH', ROOT_PATH . '../runtime/');

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
