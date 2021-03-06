<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
/**
 * 1.如果不存在指定的模块,就创建之
 * 2.如果存在,就访问之
 * 3.当使用了BIND_MODULE之后m参数失效
 */
define('BIND_MODULE','Home');

// 定义应用目录
define('ROOT_PATH', __DIR__ . '/');
define('APP_PATH',ROOT_PATH.'Application/');

// 引入ThinkPHP入口文件
require ROOT_PATH.'../ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单