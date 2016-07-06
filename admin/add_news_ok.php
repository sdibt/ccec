<?php
@session_start();
if (!isset($_SESSION['administrator'])) {
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
} else {
    require_once("../include/db_info.inc.php");
}
?>
<?php
require_once('../include/check_post_key.php');
if (isset($_POST['newsid'])) {
    if (isset($_POST['typeid']) && isset($_POST['title'])) {
        $newsid = intval($_POST['newsid']);
        $typeid = intval($_POST['typeid']);
        $title = trim($_POST['title']);
        $content = $_POST['content'];
        if (get_magic_quotes_gpc()) {
            $title = stripcslashes($title);
            $content = stripcslashes($content);
        }
        $title = mysql_real_escape_string($title);
        $content = mysql_real_escape_string($content);
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `News_main` SET `title`='$title',`content`='$content',`addtime` = '$now' WHERE `type_id`='$typeid' AND `news_id`='$newsid'";
        mysql_query($sql) or die(mysql_error());
        header("location:admin_news.php?typeid=$typeid");
    }
} else if (isset($_POST['typeid']) && isset($_POST['title'])) {
    $typeid = intval($_POST['typeid']);
    $title = trim($_POST['title']);
    $content = $_POST['content'];
    if (get_magic_quotes_gpc()) {
        $title = stripcslashes($title);
        $content = stripcslashes($content);
    }
    $title = mysql_real_escape_string($title);
    $content = mysql_real_escape_string($content);
    $sql = "INSERT INTO `News_main`(`type_id`,`title`,`content`,`addtime`)
		VALUES('$typeid','" . $title . "','" . $content . "',NOW())";
    mysql_query($sql) or die(mysql_error());
    header("location:admin_news.php?typeid=$typeid");
} else {
    echo "No Such Information";
    exit(0);
}
?>