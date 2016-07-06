<?php
require_once('./index_header.php');
require_once('./include/db_info.inc.php');
?>
    <div class="content clearfix">
        <?php
        require_once('./school_btf.php');
        ?>
        <div class="right">
            <div class="left" style="width:48%">
                <hr>
                <div class="newsbar">
                    <div class="pull-left title">新闻动态</div>
                    <div class="pull-right"><a href='./more.php?typeid=6'>更多&gt;&gt;</a></div>
                </div>
                <div style="clear:both"></div>
                <hr>
                <?php
                $fenyesql = " LIMIT 0,10";
                $sql = "SELECT `news_id`,`title`,`addtime` FROM `News_main` WHERE `type_id`='6' ORDER BY `news_id` DESC $fenyesql";
                $result = mysql_query($sql) or die(mysql_error());
                echo "<table class='table'>";
                while ($row = mysql_fetch_object($result)) {
                    $len = strlen($row->title);
                    $mytitle = mb_substr($row->title, 0, 15, 'utf-8');
                    if ($len > 15) {
                        $mytitle = $mytitle . "....";
                    }
                    echo "<tr><td><a href=\"./showinfo.php?typeid=6&newsid=$row->news_id\">·$mytitle</a>";
                    $addtime = substr($row->addtime, 0, 10);
                    echo "<font size='1pt'>[$addtime]</font>";
                    echo "</td></tr>";
                }
                echo "</table>";
                mysql_free_result($result);
                ?>
            </div>
            <div class="right" style="width:48%">
                <hr>
                <div class="newsbar">
                    <div class="pull-left title">图片新闻</div>
                    <div class="pull-right"><a href='./more.php?typeid=8'>更多&gt;&gt;</a></div>
                </div>
                <div style="clear:both"></div>
                <hr>
                <?php
                $sql = "SELECT `news_id`,`title`,`addtime` FROM `News_main` WHERE `type_id`='8' ORDER BY `news_id` DESC $fenyesql";
                $result = mysql_query($sql) or die(mysql_error());
                echo "<table class='table'>";
                while ($row = mysql_fetch_object($result)) {
                    $len = strlen($row->title);
                    $mytitle = mb_substr($row->title, 0, 15, 'utf-8');
                    if ($len > 15)
                        $mytitle = $mytitle . "....";
                    echo "<tr><td><a href=\"./showinfo.php?typeid=8&newsid=$row->news_id\">·$mytitle</a>";
                    $addtime = substr($row->addtime, 0, 10);
                    echo "<font size='1pt'>[$addtime]</font>";
                    echo "</td></tr>";
                }
                echo "</table>";
                mysql_free_result($result);
                ?>
            </div>
        </div>
    </div>
<?php
require_once('./index_footer.php');
?>