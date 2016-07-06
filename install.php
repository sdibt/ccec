<?php
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");

static $ADMIN_USER_ID = "admin";
static $ADMIN_PASSWORD = "123456";
static $infoarr = array("基金会简介", "基金会章程", "捐款方式", "联系方式", "免税说明", "鸣谢办法", "组织框架", "常用下载");
static $newstypearr = array("管理办法", "获赠感言", "基金项目", "年度报告", "校园建设", "新闻动态", "资助信息", "图片新闻", "免税说明");
static $INSTALL = false;

if ($INSTALL == true) {
    $user_id = $ADMIN_USER_ID;
    $password = $ADMIN_PASSWORD;
    $pas = pwGen($password);
    $sql = "INSERT INTO `users` VALUES('" . $user_id . "','" . $pas . "')";
    mysql_query($sql) or die(mysql_error());

    $sql = "INSERT INTO `info` (`info_id`,`title`) VALUES('1','$infoarr[0]')";
    for ($i = 1; $i < count($infoarr); $i++) {
        $num = $i + 1;
        $sql = $sql . ",('$num','$infoarr[$i]')";
    }
    mysql_query($sql) or die(mysql_error());

    $sql = "INSERT INTO `News_type`(`title`) VALUES('$newstypearr[0]')";
    for ($i = 1; $i < count($newstypearr); $i++) {
        $sql = $sql . ",('$newstypearr[$i]')";
    }
    mysql_query($sql) or die(mysql_error());
} else {
    echo "it doesn't work";
}
?>