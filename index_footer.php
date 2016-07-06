</div> <!-- container end -->
<div class="footer"> <!-- footer start -->
    <hr>
    <font>
        网址:<a href='http://jijinhui.sdibt.edu.cn/' target='_blank'>http://jijinhui.sdibt.edu.cn/</a>&nbsp;&nbsp;
        电话：0535-6904966&nbsp;&nbsp;
        通讯地址：山东省烟台市莱山区滨海中路191号&nbsp;&nbsp;
        邮政编码：264005<br>
        <?php
        @session_start();
        if (!isset($_SESSION['administrator'])) {
            echo "<a href=\"./loginpage.php\" title=\"登录\">[登录]</a>";
        } else {
            echo "<a href=\"./admin/\" title=\"进入管理\">[进入管理]</a>";
        }
        ?>
    </font>
    <hr>
</div> <!-- footer end -->
</body>
</html>