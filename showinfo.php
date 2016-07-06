<?php
require_once('./index_header.php');
require_once('./include/db_info.inc.php');
$typeid = 1;
$newsid = 1;
if (isset($_GET['typeid']) && isset($_GET['newsid'])) {
    $typeid = intval($_GET['typeid']);
    $newsid = intval($_GET['newsid']);
    if ($typeid < 1 || $typeid > $NEWS_TYPE_NUM) {
        $typeid = 1;
    }
}
$sql_1 = "SELECT `title` FROM `News_type` WHERE `type_id`='$typeid'";
$result_1 = mysql_query($sql_1) or die(mysql_error());
$row_1 = mysql_fetch_object($result_1);
$title_1 = $row_1->title;
mysql_free_result($result_1);
?>
    <div class="content clearfix">
        <?php
        require_once('./school_btf.php');
        ?>
        <div class="right">
            <hr>
            <div class="newsbar">
                <div class="pull-left title"><?php echo $title_1 ?></div>
            </div>
            <div style="clear:both"></div>
            <hr>
            <?php
            $query = "SELECT `title`,`content`,`addtime`,`seecount` FROM `News_main` WHERE `type_id`='$typeid' AND `news_id`='$newsid'";
            $result = mysql_query($query) or die(mysql_error());
            $row_cnt = mysql_num_rows($result);
            if ($row_cnt == 0) {
                echo "No Such Information";
            } else {
                $row = mysql_fetch_object($result);
                $newstitle = $row->title;
                $content = $row->content;
                $addtime = $row->addtime;
                $seecount = $row->seecount;
                $newseecount = $seecount + 1;
                $sql = "UPDATE `News_main` SET `seecount`='$newseecount' WHERE `type_id`='$typeid' AND `news_id`='$newsid'";
                mysql_query($sql) or die(mysql_error());
                echo "<h2>$newstitle</h2>";
                echo "发布时间:$addtime 浏览次数:$newseecount";
                echo "<div class='infocontent'>";
                echo "$content";
                echo "</div>";
            }
            mysql_free_result($result);
            ?>
        </div>
    </div>
<?php
require_once('./index_footer.php');
?>