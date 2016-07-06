<?php
require_once('./admin_header.php');
$typeid = 1;
if (isset($_GET['typeid'])) {
    $typeid = intval($_GET['typeid']);
    if ($typeid < 1 || $typeid > $NEWS_TYPE_NUM) {
        $typeid = 1;
    }
}
$sql = "SELECT `title` FROM `News_type` WHERE `type_id`='$typeid'";
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_object($result);
$typetitle = $row->title;
mysql_free_result($result);
require_once('./navbar.php');
require_once('../include/my_func.inc.php');
$table = "News_main";
$srchsql = "WHERE `type_id`='$typeid'";
$url = "./admin_news.php?typeid=$typeid";
$message = showpageup($table, $srchsql);
$page = $message['page'];
$prepage = $message['prepage'];
$startpage = $message['startpage'];
$endpage = $message['endpage'];
$nextpage = $message['nextpage'];
$lastpage = $message['lastpage'];
$eachpage = $message['eachpage'];
$sqladd = $message['sqladd'];
?>
    <div class="content">
        <h2 style="text-align:center"><?php echo $typetitle ?>总览</h2>

        <form action="add_news.php" method="get" class="pull-left">
            <input type="submit" value="添加" class="mybutton">
            <input type="hidden" name="typeid" value=<?php echo $typeid ?>>
        </form>
        <table class="table table-hover table-bordered table-striped table-condensed">
            <thread>
                <th width=3%>序号</th>
                <th width=25%>标题</th>
                <th width=12%>创建时间</th>
                <th width=5%>浏览次数</th>
                <th width=8% colspan="2">操作</th>
            </thread>
            <tbody>
            <?php
            require_once('../include/set_get_key.php');
            $key = $_SESSION['getkey'];
            $sql = "SELECT `news_id`,`title`,`addtime`,`seecount` FROM `News_main` WHERE `type_id`='$typeid' ORDER BY `news_id` DESC $sqladd";
            $result = mysql_query($sql) or die(mysql_error());
            $numcount = 1 + $eachpage * ($page - 1);
            while ($row = mysql_fetch_object($result)) {
                echo "<tr><td>$numcount</td>";
                $len = strlen($row->title);
                $mytitle = mb_substr($row->title, 0, 25, 'utf-8');
                if ($len > 25) {
                    $mytitle = $mytitle . "....";
                }
                echo "<td><a href=\"./showinfoadmin.php?typeid=$typeid&newsid=$row->news_id\">$mytitle</a></td>";
                echo "<td>$row->addtime</td>";
                echo "<td>$row->seecount</td>";
                echo "<td><a href='javascript:suredo(\"./del_news.php?typeid=$typeid&newsid=$row->news_id&getkey=$key\",\"确定删除?\")'>[删除]</a></td>";
                echo "<td><a href='./edit_news.php?typeid=$typeid&newsid=$row->news_id&getkey=$key'>[编辑]</a></td></tr>";
                $numcount++;
            }
            mysql_free_result($result);
            ?>
            </tbody>
        </table>
        <?php
        showpagedown($page, $prepage, $startpage, $endpage, $nextpage, $lastpage, $url);
        ?>
    </div>
    <script language="javascript">
        function suredo(src, q) {
            var ret;
            ret = confirm(q);
            if (ret != false)
                window.location.href = src;
        }
    </script>
<?php
require_once('./admin_footer.php');
?>