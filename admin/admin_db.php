<?php
require_once('./admin_header.php');
require_once('./navbar.php');
if (isset($_GET['dbmain'])) {
    echo "<br>";
    echo "<div class=\"content\">";
    $dbmainid = intval($_GET['dbmain']);
    if ($dbmainid == 1) {
        echo "<h2 style=\"text-align:center\">修改密码</h2>";
        $userid = $_SESSION['administrator'];
        echo "<form action=\"update_db.php\" method='post'>";
        echo "<table class=\"table\">";
        echo "<tr><td>UserName:</td><td><input type=\"text\" value=\"$userid\" disabled=\"disabled\"></td></tr>";
        echo "<tr><td>Old Password:</td><td><input type=\"password\" name=\"opassword\"></td></tr>";
        echo "<tr><td>New Password:</td><td><input type=\"password\" name=\"npassword\">*至少六位字符</td></tr>";
        echo "<tr><td>Repeat New Password:</td><td><input type=\"password\" name=\"rptpassword\"></td></tr>";
        echo "</table>";
        echo "<input type=\"hidden\" value='$dbmainid' name='dbmainid'>";
        require_once('../include/set_post_key.php');
        echo "<input type=\"submit\" value=\"确认修改\" class='mybutton'>";
        echo "</form>";
    } else if ($dbmainid == 2) {
        echo "<h2 style=\"text-align:center\">添加用户</h2>";
        echo "<form action=\"update_db.php\" method='post'>";
        echo "<table class=\"table\">";
        echo "<tr><td>UserName:</td><td><input type=\"text\" name=\"userid\"></td></tr>";
        echo "<tr><td>Password:</td><td><input type=\"password\" name=\"npassword\">*至少六位字符</td></tr>";
        echo "<tr><td>Repeat Password:</td><td><input type=\"password\" name=\"rptpassword\"></td></tr>";
        echo "</table>";
        echo "<input type=\"hidden\" value='$dbmainid' name='dbmainid'>";
        require_once('../include/set_post_key.php');
        echo "<input type=\"submit\" value=\"添加\" class='mybutton'>";
        echo "<input type=\"reset\" value=\"重置\" class='mybutton'>";
        echo "</form>";
    } else if ($dbmainid == 3) {
        echo "<h2 style=\"text-align:center\">数据库备份</h2>";
        echo "<form action=\"update_db.php\" method='post'>";
        echo "<input type=\"hidden\" value='$dbmainid' name='dbmainid'>";
        require_once('../include/set_post_key.php');
        echo "<input type=\"submit\" value=\"点击备份\" class='mybutton' onclick=\"return suredo('是否真的要备份数据库？');\">";
        echo "</form>";
    }
    echo "</div>";
}
?>
    <script language="javascript">
        function suredo(q) {
            var ret;
            ret = confirm(q);
            return ret;
        }
    </script>
<?php
require_once('./admin_footer.php');
?>