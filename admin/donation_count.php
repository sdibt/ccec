<?php
require_once('./admin_header.php');
require_once('../include/my_func.inc.php');
$table = "donor";
$url = "./donation_count.php?action=showdonor";
$message = showpageup($table);
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
        <h2 style="text-align:center">捐赠统计总览</h2>
        <script src="../include/tmp.js"></script>
        <table class="point table table-hover table-bordered table-striped table-condensed">
            <thread>
                <th width=3%>序号</th>
                <th width=15%>捐款单位或个人</th>
                <th width=5%>捐款金额</th>
                <th width=10%>捐赠时间</th>
                <th width=7%>是否已捐赠</th>
                <th width=5%>状态</th>
                <th width=8% colspan="2">操作</th>
            </thread>
            <tbody>
            <?php
            require_once('../include/set_get_key.php');
            $key = $_SESSION['getkey'];
            $sql = "SELECT `donor_id`,`money`,`project_id`,`name`,`isdonation`,`isvisble`,`addtime` FROM `donor` ORDER BY `donor_id` DESC $sqladd";
            $result = mysql_query($sql) or die(mysql_error());
            $numcount = 1 + $eachpage * ($page - 1);
            while ($row = mysql_fetch_object($result)) {
                echo "<tr><td>$numcount</td>";
                echo "<td><a href=\"./showinfoadmin.php?donorid=$row->donor_id\">$row->name</a></td>";
                echo "<td>$row->money</td>";
                $addtime = substr($row->addtime, 0, 10);
                echo "<td>$addtime</td>";
                if ($row->isdonation == 1)
                    echo "<td><font id='show$row->donor_id'>YES</font> <input type=\"button\" id='donation$row->donor_id' value=\"设置未捐\" onclick=\"make_change('0','$row->donor_id')\"></td>";
                else
                    echo "<td><font id='show$row->donor_id'>NO</font> <input type=\"button\" id='donation$row->donor_id' value=\"设置已捐\" onclick=\"make_change('1','$row->donor_id')\"></td>";
                if ($row->isvisble == '1')
                    echo "<td id='statu$row->donor_id'>显示</td>";
                else
                    echo "<td id='statu$row->donor_id'>隐藏</td>";
                echo "<td><a href='javascript:suredo(\"./del_news.php?donorid=$row->donor_id&getkey=$key\",\"确定删除?\")'>[删除]</a></td>";
                if ($row->isvisble == '1')
                    echo "<td id='visible$row->donor_id'><a href='javascript:void(0);' onclick=\"do_change('0','$row->donor_id')\">[隐藏]</a></td>";
                else
                    echo "<td id='visible$row->donor_id'><a href='javascript:void(0);' onclick=\"do_change('1','$row->donor_id')\">[显示]</a></td>";
                echo "</tr>";
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
        function do_change(tostatu, donorid) {
            var d = "action=change&to=" + tostatu + "&donorid=" + donorid;
            var res = postData("change_logo.php", "post", d);
            document.getElementById('statu' + donorid).innerHTML = res;
            var bar = document.getElementById('visible' + donorid);
            if (tostatu == 1) {
                bar.innerHTML = "<a href='javascript:void(0);' onclick=do_change('0','" + donorid + "')>[隐藏]</a>";
            }
            else {
                bar.innerHTML = "<a href='javascript:void(0);' onclick=do_change('1','" + donorid + "')>[显示]</a>";
            }
        }
        function make_change(tostatu, donorid) {
            var d = "action=donation&to=" + tostatu + "&donorid=" + donorid;
            var res = postData("change_logo.php", "post", d);
            document.getElementById('show' + donorid).innerHTML = res;
            var bar = document.getElementById('donation' + donorid);
            if (tostatu == 1) {
                bar.onclick = function () {
                    make_change(0, donorid);
                }
                bar.value = "设置未捐";
            }
            else {
                bar.onclick = function () {
                    make_change(1, donorid);
                }
                bar.value = "设置已捐";
            }
        }
    </script>
<?php
require_once('./admin_footer.php');
?>