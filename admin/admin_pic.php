<?php
require_once('./admin_header.php');
require_once('../include/my_func.inc.php');
$table = "picshow";
$url = "./admin_pic.php?action=showpic";
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
    <script src="../include/tmp.js"></script>
    <div class="content">
        <h2 style="text-align:center">幻灯片设置</h2>

        <form method="post" enctype="multipart/form-data" action="upload_pic.php">
            <input type="file" name="myFile">
            <input type="submit" value="上传" class="mybutton"/>
        </form>
        <table class="table table-hover table-bordered table-striped table-condensed">
            <thread>
                <th width=5%>序号</th>
                <th width=55%>图片链接</th>
                <th width=8%>状态</th>
                <th width=12% colspan="2">操作</th>
            </thread>
            <tbody>
            <?php
            $hasdel = 0;
            $sql = "SELECT `pic_id`,`isshow`,`urllink` FROM `picshow` ORDER BY `pic_id` DESC $sqladd";
            $result = mysql_query($sql) or die(mysql_error());
            $numcount = 1 + $eachpage * ($page - 1);
            while ($row = mysql_fetch_object($result)) {
                if (!file_exists("./$row->urllink")) {
                    $delsql = "DELETE FROM `picshow` WHERE `pic_id`='$row->pic_id'";
                    mysql_query($delsql) or die(mysql_error());
                    $hasdel = 1;
                }
                echo "<tr><td>$numcount</td>";
                echo "<td><a href=\"./$row->urllink\" target='_blank'>$row->urllink</a></td>";
                if ($row->isshow == '1') {
                    echo "<td id='picshow$row->pic_id'>显示</td>";
                } else {
                    echo "<td id='picshow$row->pic_id'>隐藏</td>";
                }
                if ($row->isshow == '1') {
                    echo "<td id='pic$row->pic_id'><a href='javascript:void(0);' onclick=\"do_change('0','$row->pic_id')\">[隐藏]</a></td>";
                } else {
                    echo "<td id='pic$row->pic_id'><a href='javascript:void(0);' onclick=\"do_change('1','$row->pic_id')\">[显示]</a></td>";
                }
                echo "<td id='delpic$row->pic_id'><a href=\"javascript:void(0);\" onclick=\"delpic($row->pic_id)\">[删除]</a></td>";
                $numcount++;
            }
            mysql_free_result($result);
            if ($hasdel === 1) {
                header("location:admin_pic.php");
            }
            ?>
            </tbody>
        </table>
        <?php
        showpagedown($page, $prepage, $startpage, $endpage, $nextpage, $lastpage, $url);
        ?>
    </div>
    <script language="javascript">
        function do_change(tostatu, picid) {
            var d = "action=picchange&to=" + tostatu + "&picid=" + picid;
            var res = postData("change_logo.php", "post", d);
            document.getElementById('picshow' + picid).innerHTML = res;
            var bar = document.getElementById('pic' + picid);
            if (tostatu == 1) {
                bar.innerHTML = "<a href='javascript:void(0);' onclick=do_change('0','" + picid + "')>[隐藏]</a>";
            } else {
                bar.innerHTML = "<a href='javascript:void(0);' onclick=do_change('1','" + picid + "')>[显示]</a>";
            }
        }
        function delpic(picid) {
            var d = "action=delpic&picid=" + picid;
            var res = postData("change_logo.php", "get", d);
            if (res == "yes") {
                var e = document.getElementById('delpic' + picid);
                e.parentNode.parentNode.removeChild(e.parentNode);
            } else {
                alert(res);
            }
        }
    </script>
<?php
require_once('./admin_footer.php');
?>