<?php
require_once('dbConfig.php');
@session_start();
static $NEWS_TYPE_NUM = 9;
/*
    NEWS_NAME	NEWS_TYPE
       管理办法 		1
　　    获赠感言 		2
       基金项目 		3
       年度报告 		4
       校园建设 		5
       新闻动态 		6
       资助信息 		7
       图片新闻 		8
       免税说明		9
*/
static $INFO_NUM = 8;
/*
    INFO_NAME	INFO_TYPE
    基金会简介  	1
    基金会章程  	2
    捐款方式   	3
    联系方式   	4
    免税说明		5
    鸣谢办法		6
    组织框架		7
    常用下载     8
*/
?>