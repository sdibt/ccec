<?php
	@session_start();
	if(!isset($_SESSION['administrator']))
	{
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
	else
		require_once("../include/db_info.inc.php");
	require_once('../include/my_func.inc.php');
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
?>
<?php
	if(isset($_POST['dbmainid']))
	{
		require_once('../include/check_post_key.php');
		$dbmainid=intval($_POST['dbmainid']);
		if($dbmainid==1)
		{
			$userid=mysql_real_escape_string($_SESSION['administrator']);
			$password=$_POST['opassword'];
			$sql="SELECT `user_id`,`password` FROM `users` WHERE `user_id`='".$userid."'";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			if ($row && pwCheck($password,$row['password'])) 
				$rows_cnt = 1;
			else 
				$rows_cnt = 0;
			mysql_free_result($result);
			if ($rows_cnt==0)
			{
				exit('Wrong Old Password');
			}
			$len=strlen($_POST['npassword']);
			if($len<6 && $len>0)
			{
				exit("Password should be Longer than 6!");
			}
			else if(strcmp($_POST['npassword'],$_POST['rptpassword'])!=0)
			{
				exit("Two Passwords Not Same!");
			}
			if(strlen($_POST['npassword'])==0)
				$password=pwGen($_POST['opassword']);
			else 
				$password=pwGen($_POST['npassword']);
			$sql = "UPDATE `users` SET `password`='".($password)."' WHERE `user_id`='".$userid."'";
			mysql_query($sql) or die(mysql_error());
			header("Location: ./admin_db.php?dbmain=1");
		}
		else if($dbmainid==2)
		{
			$userid=mysql_real_escape_string($_POST['userid']);
			$sql="SELECT COUNT(`user_id`) FROM `users` WHERE `user_id`='".$userid."'";
			$result=mysql_query($sql) or die(mysql_error());
			$row=mysql_fetch_array($result);
			$row_cnt=$row[0];
			mysql_free_result($result);
			if($row_cnt!=0)
			{
				exit('该用户名已存在!');
			}
			else
			{
				$len=strlen($_POST['npassword']);
				if($len<6)
				{
					exit('Password should be Longer than 6!');
				}
				else if(strcmp($_POST['npassword'],$_POST['rptpassword'])!=0)
				{
					exit("Two Passwords Not Same!");
				}
				$password=pwGen($_POST['npassword']);
				$sql = "INSERT INTO `users` VALUES('".$userid."','".$password."')";
				mysql_query($sql) or die(mysql_error());
				echo "<script language='javascript'>\n";
				echo "alert('添加成功');\n";
				echo "location='./admin_db.php?dbmain=2';\n";
				echo "</script>";
			}
		}
		else if($dbmainid==3)
		{
			$filename = date("Y-m-d_H-i-s")."-".$DB_NAME.".sql";
			header("Pragma:no-cache");
			header("Expires:0");
			$tmpFile = (dirname(__FILE__))."/dbbackup/";
			if(!file_exists($tmpFile)){
				mkdir($tmpFile,0777,true);
				chmod($tmpFile,0777);
			}
			$tmpFile=$tmpFile.$filename;
			exec("mysqldump -h$DB_HOST -u$DB_USER -p$DB_PASS --default-character-set=utf8 $DB_NAME > ".$tmpFile); 
			$file = fopen($tmpFile, "r");
			fread($file,filesize($tmpFile));
			fclose($file);
			sleep(1);
			echo "<script language='javascript'>\n";
			echo "alert('备份成功');\n";
			echo "location='./';\n";
			echo "</script>";
		}
	}
	else
		exit(0);
?>