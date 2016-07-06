<?php
	require_once('./admin_header.php');
	include_once("../fckeditor/fckeditor.php");
	require_once("../include/check_get_key.php");
	$typeid=1;
	if(isset($_GET['typeid']))
	{
		$typeid=intval($_GET['typeid']);
		if($typeid<1||$typeid>$NEWS_TYPE_NUM)
			$typeid=1;
	}
	$sql_1 = "SELECT `title` FROM `News_type` WHERE `type_id`='$typeid'";
	$result_1 = mysql_query($sql_1) or die(mysql_error());
	$row_1 = mysql_fetch_object($result_1);
	$typetitle = $row_1->title;
	mysql_free_result($result_1);
	$content="";
	if(isset($_GET['newsid']))
	{
		$newsid=intval($_GET['newsid']);
		$query = "SELECT `title`,`content` FROM `News_main` WHERE `type_id`='$typeid' AND `news_id`='$newsid'";
		$myresult = mysql_query($query) or die(mysql_error());
		$myrow = mysql_fetch_object($myresult);
		$titlename = $myrow->title;
		$content = $myrow->content;
		mysql_free_result($myresult);
	}
	else
		exit(0);
?>
	<div class="content">
	<h2 style="text-align:center">修改<?php echo $typetitle?>信息</h2>
	<form action="add_news_ok.php" method="post">
	<?php
		require_once('../include/set_post_key.php');
	?>
	<font size=4>标题名称:</font><input type="text" name="title" value=<?php if(isset($titlename)) echo $titlename?> ><br><br>
	<font size=4>内容部分:(请在下面编辑框中填写)</font><br>
	<?php
		$fck_description = new FCKeditor('content');
		$fck_description->BasePath = '../fckeditor/';
		$fck_description->Height = 600 ;
		$fck_description->Width= 600;
		$fck_description->Value = $content;
		$fck_description->Create() ;
	?>
	<input type="hidden" name="typeid" value="<?php echo $typeid?>">
	<input type="hidden" name="newsid" value="<?php echo $newsid?>">
	<br><input type="submit" value="确认修改" class="mybutton">
	<input type="button" value="取消" class="mybutton" onclick="javascript:history.go(-1);">
	</form>
</div>
<?php
	require_once('./admin_footer.php');
?>