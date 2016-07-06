<?php
require_once('./index_header.php');
require_once('./include/db_info.inc.php');
?>
    <style type="text/css">
        .infocontent {
            height: 155px;
            overflow: hidden;
        }
    </style>
    <div class="content clearfix">
        <?php
        require_once('./school_btf.php');
        ?>
        <div class="right">
            <hr>
            <div class="newsbar">
                <div class="pull-left title">捐赠方式</div>
                <div class="pull-right"><a href='./more.php?infoid=3'>更多&gt;&gt;</a></div>
            </div>
            <div style="clear:both"></div>
            <hr>
            <?php
            $sql = "SELECT `content` FROM `info` WHERE `info_id`='3'";
            $result = mysql_query($sql) or die(mysql_error());
            $row = mysql_fetch_object($result);
            echo "<div class='infocontent'>";
            echo $row->content;
            echo "</div>";
            mysql_free_result($result);
            ?>
            <div>
                <hr>
                <div class="newsbar">
                    <div class="pull-left title">免税说明</div>
                    <div class="pull-right"><a href='./more.php?infoid=5'>更多&gt;&gt;</a></div>
                </div>
                <div style="clear:both"></div>
                <hr>
            </div>
            <?php
            $sql = "SELECT `content` FROM `info` WHERE `info_id`='5'";
            $result = mysql_query($sql) or die(mysql_error());
            $row = mysql_fetch_object($result);
            echo "<div class='infocontent' style='height:100px;'>";
            echo $row->content;
            echo "</div>";
            mysql_free_result($result);
            ?>
            <hr>
            <div class="newsbar">
                <div class="pull-left title">鸣谢办法</div>
                <div class="pull-right"><a href='./more.php?infoid=6'>更多&gt;&gt;</a></div>
            </div>
            <div style="clear:both"></div>
            <hr>
            <?php
            $sql = "SELECT `content` FROM `info` WHERE `info_id`='6'";
            $result = mysql_query($sql) or die(mysql_error());
            $row = mysql_fetch_object($result);
            echo "<div class='infocontent' style='font-size:15px'>";
            echo mb_substr(strip_tags($row->content, '<div>'), 0, 1000, 'utf-8');
            echo "</div>";
            mysql_free_result($result);
            ?>
        </div>
    </div>
<?php
require_once('./index_footer.php');
?>