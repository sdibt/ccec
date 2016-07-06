<?php
require_once('./include/db_info.inc.php');
require_once("./include/my_func.inc.php");
$err_str = "";
$err_cnt = 0;
$len;
$vcode = trim($_POST['vcode']);
if (($vcode != $_SESSION["vcode"] || $vcode == "" || $vcode == null)) {
    $_SESSION["vcode"] = null;
    $err_str = $err_str . "Vcode Wrong!\\n";
    $err_cnt++;
}

$money = intval($_POST['money']);
if ($money < 1) {
    $err_str = $err_str . "Money is valid!\\n";
    $err_cnt++;
}

$projectid = intval($_POST['project']);

$name = trim($_POST['yourname']);
$len = strlen($name);
if ($len > 100 || $len <= 0) {
    $err_str = $err_str . "Name is valid!\\n";
    $err_cnt++;
}

$email = trim($_POST['email']);
$len = strlen($email);
if (!isemail($email) || $len > 100 || $len < 5) {
    $err_str = $err_str . "Email is valid!\\n";
    $err_cnt++;
}

$phone = trim($_POST['telphone']);
if (!isnum($phone) || strlen($phone) > 100) {
    $err_str = $err_str . "phone is valid!\\n";
    $err_cnt++;
}

$address = trim($_POST['address']);
$postcode = trim($_POST['postcode']);
$ourschool = trim($_POST['ourschool']);
$schoolname = trim($_POST['schoolname']);
$message = trim($_POST['message']);

if (get_magic_quotes_gpc()) {
    $name = stripcslashes($name);
    $address = stripcslashes($address);
    $postcode = stripcslashes($postcode);
    $schoolname = stripcslashes($schoolname);
    $message = stripcslashes($message);
}
$name = mysql_real_escape_string($name);
$email = mysql_real_escape_string($email);
$phone = mysql_real_escape_string($phone);
$address = mysql_real_escape_string($address);
$postcode = mysql_real_escape_string($postcode);
$schoolname = mysql_real_escape_string($schoolname);
$message = mysql_real_escape_string($message);

if ($err_cnt > 0) {
    print "<script language='javascript'>\n";
    print "alert('";
    print $err_str;
    print "');\n history.go(-1);\n</script>";
    exit(0);
}
// echo "$money <br>";
// echo "$projectid <br>";
// echo "$name <br>";
// echo "$email <br>";
// echo "$postcode <br>";
// echo "$schoolname <br>";
// echo "$ourschool <br>";
// echo "$message <br>";

$sql = "INSERT INTO ";
$sql = $sql . "`donor`(`money`,`project_id`,`name`,`email`,";
$sql = $sql . "`phone`,`address`,`postcode`,`ourschool`,`schoolname`,`addtime`,`message`)";
$sql = $sql . " VALUES('$money','$projectid','$name','$email','$phone','$address',";
$sql = $sql . "'$postcode','$ourschool','$schoolname',NOW(),'$message')";
//echo $sql;
mysql_query($sql) or die(mysql_error());
print "<script language='javascript'>\n";
print "alert('Thank you for your supports');\n";
print "location='./';</script>\n";
?>