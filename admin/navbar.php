<div class="navbar clearfix">
<?php
	if(isset($_GET['infoid']))
	{
		$infoid=intval($_GET['infoid']);
		$bar=$infoid;
		echo "<ul>";
		// //动态查询
		// $sql="SELECT `info_id`,`title` FROM `info` ORDER BY `info_id` ASC";
		// $result=mysql_query($sql) or die(mysql_error());
		// while($row=mysql_fetch_object($result)){
		// 	echo "<li><a href=\"./admin_info.php?infoid=$row->info_id\">$row->title</a></li>";
		// }
		// mysql_free_result($result);
		// 静态固定
		echo "<li id='navbartype1'><a href=\"./admin_info.php?infoid=1\">基金会简介</a></li>";
		echo "<li id='navbartype2'><a href=\"./admin_info.php?infoid=2\">基金会章程</a></li>";
		echo "<li id='navbartype3'><a href=\"./admin_info.php?infoid=3\">捐款方式</a></li>";
		echo "<li id='navbartype4'><a href=\"./admin_info.php?infoid=4\">联系方式</a></li>";
		echo "<li id='navbartype5'><a href=\"./admin_info.php?infoid=5\">免税说明</a></li>";
		echo "<li id='navbartype6'><a href=\"./admin_info.php?infoid=6\">鸣谢办法</a></li>";
		echo "<li id='navbartype7'><a href=\"./admin_info.php?infoid=7\">组织框架</a></li>";
		echo "<li id='navbartype8'><a href=\"./admin_info.php?infoid=8\">常用下载</a></li>";
		echo "</ul>";
	}
	else if(isset($_GET['typeid']))
	{
		$typeid=intval($_GET['typeid']);
		$bar=$typeid;
		echo "<ul>";
		// //动态查询
		// $sql="SELECT `type_id`,`title` FROM `News_type` ORDER BY `type_id` ASC";
		// $result=mysql_query($sql) or die(mysql_error());
		// while($row=mysql_fetch_object($result)){
		// 	echo "<li><a href=\"./admin_news.php?typeid=$row->type_id\">$row->title</a></li>";
		// }
		// mysql_free_result($result);
		// 静态固定
		echo "<li id='navbartype1'><a href=\"./admin_news.php?typeid=1\">管理办法</a></li>";
		//echo "<li id='navbartype2'><a href=\"./admin_news.php?typeid=2\">获赠感言</a></li>";
		echo "<li id='navbartype3'><a href=\"./admin_news.php?typeid=3\">基金项目</a></li>";
		echo "<li id='navbartype4'><a href=\"./admin_news.php?typeid=4\">年度报告</a></li>";
		echo "<li id='navbartype5'><a href=\"./admin_news.php?typeid=5\">校园建设</a></li>";
		echo "<li id='navbartype6'><a href=\"./admin_news.php?typeid=6\">新闻动态</a></li>";
		echo "<li id='navbartype7'><a href=\"./admin_news.php?typeid=7\">资助信息</a></li>";
		echo "<li id='navbartype8'><a href=\"./admin_news.php?typeid=8\">图片新闻</a></li>";
		echo "<li id='navbartype9'><a href=\"./admin_news.php?typeid=9\">免税说明</a></li>";
		echo "</ul>";		
	}
	else if(isset($_GET['dbmain']))
	{
		$dbmainid=intval($_GET['dbmain']);
		$bar=$dbmainid;
		echo "<ul>";
		echo "<li id='navbartype1'><a href=\"./admin_db.php?dbmain=1\">修改密码</a></li>";
		echo "<li id='navbartype2'><a href=\"./admin_db.php?dbmain=2\">添加用户</a></li>";
		echo "<li id='navbartype3'><a href=\"./admin_db.php?dbmain=3\">数据库备份</a></li>";
		echo "</ul>";
	}
?>
</div>
<script language="javascript">
function putclass(){
	var bar=<?php echo $bar?>;
	var d=document.getElementById('navbartype'+bar);
	d.className="xuanz";
}
window.onload=putclass;
</script>