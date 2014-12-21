<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$active_group = 'default';
$active_record = TRUE;

$config['site_name'] = '贪心盒子 | 取值有道';


//本app_id和app_secret仅做测试用途
//请去淘宝开放平台申请自己的应用key和secret
//http://open.taobao.com/index.htm
$config['appkey'] = '12673864';
$config['secretkey'] = 'd4cb57d3eec5d6f1cbbfd0f430caf282';

//如果你处于防火墙之中，需要配置HTTP代理，请配置你的HTTP代理服务器地址和IP
//否则，请留空
//举例：腾讯公司内部的代理服务器如下：
//$config['http_proxy'] = 'http://proxy.tencent.com:8080';
$config['http_proxy'] = '';

//SEO
//关键词列表用英文逗号隔开
$config['site_keyword'] = '女装,男装,小新奇,导购精选,导购主题,greedybox,贪心盒子,出彩盒子';
$config['site_description'] = '贪心盒子是基于淘宝,苏宁,国美,亚马逊,京东等大型网店的导购精选网站,导购取值有道,贪值有理,让您的生活更加出彩';