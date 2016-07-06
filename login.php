<?php
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
$user_id = trim($_POST['user_id']);
if (get_magic_quotes_gpc()) {
    $user_id = stripcslashes($user_id);
}
$user_id = mysql_real_escape_string($user_id);
$password = $_POST['password'];
$vcode = trim($_POST['vcode']);
if ($vcode != $_SESSION['vcode'] || $vcode == "" || $vcode == null) {
    $_SESSION['vcode'] = null;
    echo "<script language='javascript'>\n";
    echo "alert('Vcode is wrong!');\n";
    echo "location='./loginpage.php'\n";
    echo "</script>";
    exit(0);
}
session_destroy();
session_start();
$sql = "SELECT `user_id` FROM `users` WHERE `user_id`='" . $user_id . "'";
$result = mysql_query($sql) or die(mysql_error());
$row_cnt = mysql_num_rows($result);
mysql_free_result($result);
if ($row_cnt == 0) {
    echo "<script language='javascript'>\n";
    echo "alert('No such user');\n";
    echo "location='./loginpage.php'\n";
    echo "</script>";
    exit(0);
}
$sql = "SELECT `password` FROM `users` WHERE `user_id`='" . $user_id . "'";
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($result);
if ($row && pwCheck($password, $row['password'])) {
    mysql_free_result($result);
    $_SESSION['administrator'] = $user_id;
    header("Location: ./admin/");
} else {
    mysql_free_result($result);
    echo "<script language='javascript'>\n";
    echo "alert('Password Wrong!');\n";
    echo "location='./loginpage.php'\n";
    echo "</script>";
}
?>