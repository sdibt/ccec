<?php
	@session_start();
	if(!isset($_SESSION['administrator']))
	{
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
	else
		require_once("../include/db_info.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="山东工商学院 教育发展基金会">
  <meta name="description" content="山东工商学院 教育发展基金会">
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="../css/admin_css.css">
  <title>山东工商学院 教育发展基金会</title>
</head>
<body>
	<div class="container">
	<div class="header">
	<table width="959" border="0" align="center" cellpadding="0" cellspacing="0">
		<tbody><tr>
			<td><img src="../pic/top.jpg" alt="山东工商学院教育发展基金会" width="959" /></td>
		</tr></tbody>
	</table>
	</div>
	<div class="nav">
		<ul>
			<li class='btn_start'><a href="../" title="回到主页">回到主页</a></li>
			<li class='btn_start'><a href="./admin_pic.php" title="幻灯片管理">幻灯片管理</a></li>
			<li class='btn_start'><a href="./admin_info.php?infoid=1" title="页面管理">页面管理</a></li>
			<li class='btn_start'><a href="./admin_news.php?typeid=1" title="新闻管理">新闻管理</a></li>
			<li class='btn_start'><a href="./donation_count.php" title="捐赠统计">捐赠统计</a></li>
			<li class='btn_start'><a href="./admin_db.php?dbmain=1" title="数据库管理">数据库管理</a></li>
			<li class='btn_start'><a href="./logout.php" title="退出管理">退出管理</a></li>
		</ul>
	</div>