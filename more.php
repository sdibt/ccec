<?php
require_once('./index_header.php');
require_once('./include/db_info.inc.php');
?>
    <div class="content clearfix"><!-- content start -->
        <?php
        require_once('./school_btf.php');
        ?>
        <?php
        if (isset($_GET['infoid'])) {
            $infoid = intval($_GET['infoid']);
            if ($infoid < 1 || $infoid > $INFO_NUM)
                $infoid = 1;
            $sql = "SELECT `title`,`content` FROM `info` WHERE `info_id`='$infoid'";
            $result = mysql_query($sql) or die(mysql_error());
            $row = mysql_fetch_object($result);
            echo "<div class=\"right\">";
            echo "<hr>";
            echo "<div class=\"newsbar clearfix\">";
            echo "<div class=\"pull-left title\">$row->title</div>";
            echo "</div>";
            echo "<hr>";
            echo "<div class='infocontent'>";
            echo "$row->content";
            mysql_free_result($result);
            if ($infoid == 5) {
                $tmpsql = "SELECT `news_id`,`title` FROM `News_main` WhERE `type_id`='9' ORDER BY `news_id` DESC";
                $tmpresult = mysql_query($tmpsql) or die(mysql_error());
                $tmprow_cnt = mysql_num_rows($tmpresult);
                if ($tmprow_cnt != 0) {
                    echo "<font color=blue>相关链接:</font><br>";
                    echo "<table class=\"table\">";
                }
                $numcnt = 1;
                while ($tmprow = mysql_fetch_object($tmpresult)) {
                    echo "<tr><td>$numcnt.<a class='table' href='./showinfo.php?typeid=9&newsid=$tmprow->news_id'>$tmprow->title</a></td></tr>";
                    $numcnt++;
                }
                mysql_free_result($tmpresult);
                if ($tmprow_cnt != 0) {
                    echo "</table>";
                }
            }
            echo "</div></div>";
        } else if (isset($_GET['typeid'])) {
            $typeid = intval($_GET['typeid']);
            if ($typeid < 1 || $typeid > $NEWS_TYPE_NUM)
                $typeid = 1;
            $sql = "SELECT `title` FROM `News_type` WHERE `type_id`='$typeid'";
            $result = mysql_query($sql) or die(mysql_error());
            $row = mysql_fetch_object($result);
            echo "<div class=\"right\">";
            echo "<hr>";
            echo "<div class=\"newsbar clearfix\">";
            echo "<div class=\"pull-left title\">$row->title</div>";
            echo "</div>";
            echo "<hr>";
            mysql_free_result($result);

            require_once('./include/my_func.inc.php');
            $table = "News_main";
            $srchsql = "WHERE `type_id`='$typeid'";
            $url = "./more.php?typeid=$typeid";
            $message = showpageup($table, $srchsql);
            $page = $message['page'];
            $prepage = $message['prepage'];
            $startpage = $message['startpage'];
            $endpage = $message['endpage'];
            $nextpage = $message['nextpage'];
            $lastpage = $message['lastpage'];
            $eachpage = $message['eachpage'];
            $sqladd = $message['sqladd'];

            $sql = "SELECT `news_id`,`title`,`addtime` FROM `News_main` WHERE `type_id`='$typeid' ORDER BY `news_id` DESC $sqladd";
            $result = mysql_query($sql) or die(mysql_error());
            echo "<table class='table'>";
            while ($row = mysql_fetch_object($result)) {
                $len = strlen($row->title);
                $mytitle = mb_substr($row->title, 0, 20, 'utf-8');
                if ($len > 20)
                    $mytitle = $mytitle . "....";
                echo "<tr><td></td><td></td>";
                echo "<td width=80%><a href=\"./showinfo.php?typeid=$typeid&newsid=$row->news_id\">·$mytitle</a></td>";
                $addtime = substr($row->addtime, 0, 10);
                echo "<td width=20%>$addtime</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysql_free_result($result);
            showpagedown($page, $prepage, $startpage, $endpage, $nextpage, $lastpage, $url);
            echo "</div>";
        } else if (isset($_GET['donorid'])) {
            echo "<div class=\"right\">";
            echo "<hr>";
            echo "<div class=\"newsbar clearfix\">";
            echo "<div class=\"pull-left title\">捐赠统计</div>";
            echo "</div>";
            echo "<hr>";
            $project = array();
            $project[0] = "无指定项目";
            /*select all donation_project_name*/
            $sql1 = "SELECT `news_id`,`title` FROM `News_main` WHERE `type_id`='3'";
            $res = mysql_query($sql1) or die(mysql_error());
            while ($rowres = mysql_fetch_object($res)) {
                $project[$rowres->news_id] = $rowres->title;
            }
            mysql_free_result($res);

            require_once('./include/my_func.inc.php');
            $table = "donor";
            $srchsql = "WHERE `isvisble`='1'";
            $url = "./more.php?donorid=all";
            $message = showpageup($table, $srchsql);
            $page = $message['page'];
            $prepage = $message['prepage'];
            $startpage = $message['startpage'];
            $endpage = $message['endpage'];
            $nextpage = $message['nextpage'];
            $lastpage = $message['lastpage'];
            $eachpage = $message['eachpage'];
            $sqladd = $message['sqladd'];

            $query = "SELECT `money`,`name`,`project_id`,`addtime` FROM `donor` WHERE `isvisble`=1 $sqladd";
            $result1 = mysql_query($query) or die(mysql_error());
            echo "<table class='table table-hover'>";
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
            showpagedown($page, $prepage, $startpage, $endpage, $nextpage, $lastpage, $url);
            echo "</div>";
        } else {
            echo "No Such Information";
        }
        ?>
    </div><!-- content end -->
<?php
require_once('./index_footer.php');
?>