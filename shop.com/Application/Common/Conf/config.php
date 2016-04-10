<?php

define('DOMAIN_SGOP', 'http://www.shop.com');
return array(
    //'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => array(
        '__CSS__' => DOMAIN_SGOP . '/Public/style',
        '__JS__'  => DOMAIN_SGOP . '/Public/js',
        '__IMG__' => DOMAIN_SGOP . '/Public/images',
    ),
    //配置数据库连接
    'DB_TYPE'           => 'mysql',
    'DB_HOST'           => '127.0.0.1',
    'DB_PORT'           => '3306',
    'DB_USER'           => 'root',
    'DB_PWD'            => '123456',
    'DB_NAME'           => 'jxshop',
    'DB_PREFIX'         => '',
    'DB_CHARSET'        => 'utf8',
    'SHOW_PAGE_TRACE'   => true,
    'PAGE_SIZE'         => 2,
    'PAGE_THEME'        => '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    'URL_MODEL'         => 2,
);
