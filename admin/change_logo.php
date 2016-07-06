<?php
@session_start();
if (!isset($_SESSION['administrator'])) {
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
} else
    require_once("../include/db_info.inc.php");
?>
<?php
if (isset($_REQUEST['action'])) {
    $action = trim($_REQUEST['action']);
    if ($action == "change") {
        $tostatu = intval($_POST['to']);
        $donorid = intval($_POST['donorid']);
        //$query = "SELECT COUNT(`donor_id`) FROM `donor` WHERE ``";
        if ($tostatu == 1) {
            $tostatu = '1';
            echo "显示";
        } else {
            $tostatu = '0';
            echo "隐藏";
        }
        $sql = "UPDATE `donor` SET `isvisble`='$tostatu' WHERE `donor_id`='$donorid'";
        mysql_query($sql) or die(mysql_error());
    } else if ($action == "donation") {
        $tostatu = intval($_POST['to']);
        $donorid = intval($_POST['donorid']);
        if ($tostatu == 1) {
            echo "YES";
        } else {
            $tostatu = 0;
            echo "NO";
        }
        $sql = "UPDATE `donor` SET `isdonation`='$tostatu' WHERE `donor_id`='$donorid'";
        mysql_query($sql) or die(mysql_error());
    } else if ($action == "picchange") {
        $tostatu = intval($_POST['to']);
        $picid = intval($_POST['picid']);
        //$query = "SELECT COUNT(`donor_id`) FROM `donor` WHERE ``";
        if ($tostatu == 1) {
            $tostatu = '1';
            echo "显示";
        } else {
            $tostatu = '0';
            echo "隐藏";
        }
        $sql = "UPDATE `picshow` SET `isshow`='$tostatu' WHERE `pic_id`='$picid'";
        mysql_query($sql) or die(mysql_error());
    } else if ($action == "delpic") {
        $picid = intval($_GET['picid']);
        $sql = "SELECT `urllink` FROM `picshow` WHERE `pic_id`='$picid'";
        $result = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($result);
        $urllink = $row['urllink'];
        mysql_free_result($result);
        if (file_exists($urllink)) {
            $res = @unlink($urllink);
            if ($res) {
                $sql = "DELETE FROM `picshow` WHERE `pic_id`='$picid'";
                mysql_query($sql) or die(mysql_error());
            }
            echo "yes";
        } else {
            echo "no such picture";
        }
    }
} else
    echo "Error";
?>