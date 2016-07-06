<?php
	@session_start();
	if(!isset($_SESSION['administrator']))
	{
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
	else
		require_once("../include/db_info.inc.php");
	if(isset($_POST['infoid']))
	{
		require_once("../include/check_post_key.php");
		$infoid=intval($_POST['infoid']);
		if($infoid>=1&&$infoid<=$INFO_NUM)
		{
			$content=$_POST['content'];
			if (get_magic_quotes_gpc ()){
				$content = stripslashes($content);
			}
        	$content=mysql_real_escape_string($content);
        	$sql="UPDATE `info` SET `content`='$content' WHERE `info_id`='$infoid'";
        	mysql_query($sql) or die(mysql_error());
        	echo "<script language='javascript'>\n";
			echo "alert(\"Update Successfully!\");\n";
			echo "location='./admin_info.php?infoid=$infoid';\n";
			echo "</script>";
		}
		else
		{
			echo "<script language='javascript'>\n";
			echo "alert('No Such Information!');\n";
			echo "history.go(-1);\n";
			echo "</script>";
		}
	}
	else
	{
		echo "<script language='javascript'>\n";
		echo "alert('No Such Information!');\n";
		echo "history.go(-1);\n";
		echo "</script>";
	}
?>