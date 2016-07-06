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
                <div class="pull-left title">捐赠统计</div>
                <div class="pull-right"><a href='./more.php?donorid=all'>更多&gt;&gt;</a></div>
            </div>
            <div style="clear:both"></div>
            <hr>
            <?php

            $project = array();
            $project[0] = "无指定项目";
            /*select all donation_project_name*/
            $sql1 = "SELECT `news_id`,`title` FROM `News_main` WHERE `type_id`='3'";
            $res = mysql_query($sql1) or die(mysql_error());
            while ($rowres = mysql_fetch_object($res)) {
                $project[$rowres->news_id] = $rowres->title;
            }
            mysql_free_result($res);

            $fenyesql = " LIMIT 0,7";
            $query = "SELECT `money`,`name`,`project_id`,`addtime` FROM `donor` WHERE `isvisble`=1 $fenyesql";
            $result1 = mysql_query($query) or die(mysql_error());
            echo "<table class='table'>";
            while ($row1 = mysql_fetch_object($result1)) {
                echo "<tr>";
                echo "<td></td><td></td>";
                echo "<td>$row1->name</td>";
                echo "<td>$row1->money" . "元</td>";
                $title = $project[$row1->project_id];
                echo "<td>$title</td>";
                $addtime = substr($row1->addtime, 0, 10);
                echo "<td>$addtime</td>";
                echo "</tr>";
            }
            echo "</table>";
            unset($project);
            mysql_free_result($result1);
            ?>
            <div>
                <hr>
                <div class="newsbar">
                    <div class="pull-left title">资助信息</div>
                    <div class="pull-right"><a href='./more.php?typeid=7'>更多&gt;&gt;</a></div>
                </div>
                <div style="clear:both"></div>
                <hr>
            </div>
            <?php
            $sql = "SELECT `news_id`,`title`,`addtime` FROM `News_main` WHERE `type_id`='7' ORDER BY `news_id` DESC $fenyesql";
            $result = mysql_query($sql) or die(mysql_error());
            echo "<table class='table'>";
            while ($row = mysql_fetch_object($result)) {
                $len = strlen($row->title);
                $mytitle = mb_substr($row->title, 0, 20, 'utf-8');
                if ($len > 20) {
                    $mytitle = $mytitle . "....";
                }
                echo "<tr><td></td><td></td><td width=80%><a href=\"./showinfo.php?typeid=7&newsid=$row->news_id\">·$mytitle</a>";
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