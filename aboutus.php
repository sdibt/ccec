<?php
require_once('./index_header.php');
require_once('./include/db_info.inc.php');
?>
    <style>
        .imgtt img {
            border: 0;
        }
    </style>
<?php
$infoid = 1;
$typeid = 0;
if (isset($_GET['infoid'])) {
    $infoid = intval($_GET['infoid']);
}
if ($infoid < 1 || $infoid > $INFO_NUM) {
    $infoid = 1;
}
if (isset($_GET['typeid'])) {
    $typeid = intval($_GET['typeid']);
    if ($typeid < 1 || $typeid > $NEWS_TYPE_NUM)
        $typeid = 0;
}
?>
    <div class="content clearfix">
        <div class="left">
            <div>
                <hr>
                <div class="newsbar">
                    <div class="pull-left title">教育基金会</div>
                </div>
                <div style="clear:both"></div>
                <hr>
                <a class='imgtt' href="./aboutus.php?infoid=1"><img src="./pic/b-01.gif" alt="基金会简介"></a>
                <a class='imgtt' href="./aboutus.php?infoid=2"><img src="./pic/b-02.gif" alt="基金会章程"></a>
                <a class='imgtt' href="./aboutus.php?infoid=7"><img src="./pic/b-03.gif" alt="组织架构"></a>
                <a class='imgtt' href="./aboutus.php?typeid=1"><img src="./pic/b-04.gif" alt="管理办法"></a>
                <a class='imgtt' href="./aboutus.php?typeid=4"><img src="./pic/b-05.gif" alt="年度报告"></a>
                <a class='imgtt' href="./aboutus.php?infoid=4"><img src="./pic/b-06.gif" alt="联系方式"></a>
            </div>
        </div>
        <div class="right">
            <hr>
            <div class="newsbar">
                <?php
                if ($typeid == 0) {
                    if ($infoid == 2)
                        echo "<div class=\"pull-left title\">基金会章程</div>";
                    else if ($infoid == 7)
                        echo "<div class=\"pull-left title\">组织架构</div>";
                    else if ($infoid == 4)
                        echo "<div class=\"pull-left title\">联系方式</div>";
                    else
                        echo "<div class=\"pull-left title\">基金会简介</div>";
                } else {
                    if ($typeid == 1) {
                        echo "<div class=\"pull-left title\">管理办法</div>";
                        echo "<div class=\"pull-right\"><a href='./more.php?typeid=1'>更多&gt;&gt;</a></div>";
                    } else {
                        echo "<div class=\"pull-left title\">年度报告</div>";
                        echo "<div class=\"pull-right\"><a href='./more.php?typeid=4'>更多&gt;&gt;</a></div>";
                    }
                }
                ?>
            </div>
            <div style="clear:both"></div>
            <hr>
            <?php
            if ($typeid == 0) {
                if ($infoid != 2 && $infoid != 4 && $infoid != 7)
                    $infoid = 1;
                $sql = "SELECT `content` FROM `info` WHERE `info_id`='$infoid'";
                $result = mysql_query($sql) or die(mysql_error());
                $row = mysql_fetch_object($result);
                echo "<div class='infocontent'>";
                echo $row->content;
                echo "</div>";
                mysql_free_result($result);
            } else {
                if ($typeid != 1 && $typeid != 4)
                    $typeid = 1;
                $fenyesql = " LIMIT 0,10";
                $sql = "SELECT `news_id`,`title`,`addtime` FROM `News_main` WHERE `type_id`='$typeid' ORDER BY `news_id` DESC $fenyesql";
                $result = mysql_query($sql) or die(mysql_error());
                echo "<table class='table'>";
                while ($row = mysql_fetch_object($result)) {
                    $len = strlen($row->title);
                    $mytitle = mb_substr($row->title, 0, 20, 'utf-8');
                    if ($len > 20)
                        $mytitle = $mytitle . "....";
                    echo "<tr>";
                    echo "<td><a href=\"./showinfo.php?typeid=$typeid&newsid=$row->news_id\">$mytitle</a></td>";
                    $addtime = substr($row->addtime, 0, 10);
                    echo "<td>$addtime</td>";
                    echo "</tr>";
                }
                echo "</table>";
                mysql_free_result($result);
            }
            ?>
        </div>
    </div>
<?php
require_once('./index_footer.php');
?>