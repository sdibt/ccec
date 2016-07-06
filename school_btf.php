<div class="left">
    <div>
        <hr>
        <div class="newsbar">
            <div class="pull-left title">校园风光</div>
        </div>
        <div style="clear:both"></div>
        <hr>
    </div>
    <div class='hdshow'>
        <?php
        $myimgurl = array();
        $maxpic = 0;
        if (!isset($NEWS_TYPE_NUM))
            require_once('./include/db_info.inc.php');
        $picsql = "SELECT `urllink` FROM `picshow` WHERE `isshow`='1'";
        $picresult = mysql_query($picsql) or die(mysql_error());
        $pic_cnt = mysql_num_rows($picresult);
        while ($picrow = mysql_fetch_object($picresult)) {
            $myimgurl[$maxpic] = "./admin/$picrow->urllink";
            $maxpic++;
        }
        mysql_free_result($picresult);
        if ($pic_cnt != 0)
            echo "<img src=\"$myimgurl[0]\" id='img11' alt=\"校园风光\">";
        ?>
    </div>
    <div class='gdshow'>
        <marquee height=200px align=left direction="up" onmouseover="stop()" onmouseout="start()" scrollamount="2">
            <?php
            $fenyesql = " LIMIT 0,10";
            $querybtf = "SELECT `money`,`name`,`addtime` FROM `donor` WHERE `isvisble`='1' $fenyesql";
            $resultbtf = mysql_query($querybtf) or die(mysql_error());
            echo "<table width=100%>";
            while ($rowbtf = mysql_fetch_object($resultbtf)) {
                echo "<tr>";
                echo "<td><font size=2>$rowbtf->name</font></td>";
                echo "<td>$rowbtf->money" . "元</td>";
                $btfaddtime = substr($rowbtf->addtime, 0, 10);
                echo "<td width=28%>$btfaddtime</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysql_free_result($resultbtf);
            ?>
        </marquee>
    </div>
</div>
<script language="javascript">
    var maxpic =<?php echo $maxpic?>;
    var imgnumb = 1;
    var obj = eval('<?php echo json_encode($myimgurl);?>');
    setInterval(function () {
        if (maxpic != 0) {
            if (imgnumb == maxpic) {
                imgnumb = 0;
            }
            document.getElementById("img11").src = obj[imgnumb];
            imgnumb++;
        }
    }, 3000)
</script> 