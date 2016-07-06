<?php
require_once('./index_header.php');
require_once('./include/db_info.inc.php');
?>
    <div class="content clearfix">
        <?php
        require_once('./school_btf.php');
        ?>
        <div class="right">
            <hr>
            <div class="newsbar">
                <div class="pull-left title">教育基金项目</div>
                <div class="pull-right"><a href='./more.php?typeid=3'>更多&gt;&gt;</a></div>
            </div>
            <div style="clear:both"></div>
            <hr>
            <?php
            $fenyesql = " LIMIT 0,7";
            $sql = "SELECT `news_id`,`title`,`addtime` FROM `News_main` WHERE `type_id`='3' ORDER BY `news_id` DESC $fenyesql";
            $result = mysql_query($sql) or die(mysql_error());
            echo "<table class='table'>";
            while ($row = mysql_fetch_object($result)) {
                $len = strlen($row->title);
                $mytitle = mb_substr($row->title, 0, 30, 'utf-8');
                if ($len > 30)
                    $mytitle = $mytitle . "....";
                echo "<tr><td></td><td></td><td width=80%><a href=\"./showinfo.php?typeid=3&newsid=$row->news_id\">·$mytitle</a>";
                $addtime = substr($row->addtime, 0, 10);
                echo "</td><td width=20%>[$addtime]";
                echo "</td></tr>";
            }
            echo "</table>";
            mysql_free_result($result);
            ?>
            <div>
                <hr>
                <div class="newsbar">
                    <div class="pull-left title">校园基本建设</div>
                    <div class="pull-right"><a href='./more.php?typeid=5'>更多&gt;&gt;</a></div>
                </div>
                <div style="clear:both"></div>
                <hr>
            </div>
            <?php
            $sql = "SELECT `news_id`,`title`,`addtime` FROM `News_main` WHERE `type_id`='5' ORDER BY `news_id` DESC $fenyesql";
            $result = mysql_query($sql) or die(mysql_error());
            echo "<table class='table'>";
            while ($row = mysql_fetch_object($result)) {
                $len = strlen($row->title);
                $mytitle = mb_substr($row->title, 0, 30, 'utf-8');
                if ($len > 30)
                    $mytitle = $mytitle . "....";
                echo "<tr><td></td><td></td><td width=80%><a href=\"./showinfo.php?typeid=5&newsid=$row->news_id\">·$mytitle</a>";
                $addtime = substr($row->addtime, 0, 10);
                echo "</td><td width=20%>[$addtime]";
                echo "</td></tr>";
            }
            echo "</table>";
            mysql_free_result($result);
            ?>
        </div>
    </div>
<?php
require_once('./index_footer.php');
?>