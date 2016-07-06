<?php
	@session_start();
	if(!isset($_SESSION['administrator']))
	{
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
	else{
		require_once("../include/db_info.inc.php");
		require_once("resizepic.php");
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
	$allowExt = array('bmp','gif','jpeg','jpg','png') ;
	$myFile = $_FILES['myFile'];
	$tmp_name = $myFile['tmp_name'];
	$name = $myFile['name'];
	$size = $myFile['size'];
	$ext = strtolower(pathinfo($name,PATHINFO_EXTENSION));
	$error = $myFile['error'];
	if($error==0)
	{
		$max_size=2*1024*1024;//2M
		if($size>$max_size){
			exit('上传文件过大');
		}
		if(!in_array($ext, $allowExt)){
			exit('非法文件类型');
		}
		if(!is_uploaded_file($tmp_name)){
			exit('文件不是通过HTTP POST方式上传');
		}
		if(!getimagesize($tmp_name)){
			exit('不是一个真正的图片类型');
		}
		$path = 'hdimage';
		if(!file_exists($path)){
			mkdir($path,0777,true);
			chmod($path,0777);
		}
		$uniName = substr(md5(uniqid(microtime(true),true)),0,10);
		$basname=substr($name,0,strrpos($name, '.'));
		$uniName=$basname.'_'.$uniName.'.'.$ext;
		$des = $path.'/'.$uniName;
		if(@move_uploaded_file($tmp_name, $des)){
			resizepic($des,288,270);
			$urllink = htmlspecialchars($des);
			$urllink = mysql_real_escape_string($urllink);
			
			$sql = "INSERT INTO `picshow`(`urllink`) VALUES('$urllink')";
			mysql_query($sql) or die(mysql_error());

			echo "<script language='javascript'>\n";
			echo "alert(\"上传成功!\");\n";
			echo "location='./admin_pic.php';\n";
			echo "</script>";
		}
		else{
			echo "上传失败";
		}
	}
	else
	{
		switch($error)
		{
			case 1:
				echo "文件超过了上传限制大小";
				break;
			case 2:
				echo "文件超过了表单上传限制大小";
				break;
			case 3:
				echo "只有部分文件被上传";
				break;
			case 4:
				echo "没有文件被上传";
				break;
			case 6:
				echo "找不到临时文件夹";
				break;
			case 7:
			case 8:
				echo "系统错误";
				break;
		}
		exit(0);
	}
?>