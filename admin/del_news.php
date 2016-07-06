<?php
@session_start();
if (!isset($_SESSION['administrator'])) {
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
} else
    require_once("../include/db_info.inc.php");
?>
<?php
require_once('../include/check_get_key.php');
if (isset($_GET['donorid'])) {
    $donorid = intval($_GET['donorid']);
    if (is_numeric($donorid) && $donorid > 0) {
        $sql = "DELETE FROM `donor` WHERE `donor_id`='$donorid'";
        mysql_query($sql) or die(mysql_error());
    }
} else if (isset($_GET['typeid']) && isset($_GET['newsid'])) {
    $typeid = intval($_GET['typeid']);
    $newsid = intval($_GET['newsid']);
    if (is_numeric($typeid) && is_numeric($newsid) && $newsid > 0 && $typeid > 0) {
        $sql = "DELETE FROM `News_main` WHERE `type_id`='$typeid' AND `news_id`='$newsid'";
        mysql_query($sql) or die(mysql_error());
    }
} else {
    echo "<script language='javascript'>\n";
    echo "alert(\"Invaild data\");\n";
    echo "history.go(-1);\n";
    echo "</script>";
}
echo "<script language='javascript'>history.go(-1);</script>";
?>