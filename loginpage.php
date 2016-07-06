<?php
require_once('./index_header.php');
?>
<form action="login.php" method="post" style="margin-top:50px">
    <center>
        <table width="400" algin="center">
            <thead><font size=5>管理员登录</font></thead>
            <tbody>
            <tr>
                <td width=10%>用户名:</td>
                <td width=75%><input type="text" name="user_id" size=20></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input name="password" type="password" size=20></td>
            </tr>
            <tr>
                <td>验证码:</td>
                <td><input type="text" name="vcode" size=4>
                    <img src="./include/vcode.php" id="img1" align="absmiddle" onclick="get_img()"></td>
            </tr>
            <tr>
                <td>
                <td><input name="submit" type="submit" value="登录" class="mybutton">
                    <input name="reset" type="reset" value="重置" class="mybutton"></td>
            </tr>
        </table>
        </tbody>
    </center>
</form>
<br><br>
<?php
require_once('./index_footer.php');
?>
<script type="text/javascript" language="javascript">
    function get_img() {
        var r = Math.round(Math.random() * 10000);
        document.getElementById('img1').src = "./include/vcode.php?action=get_img&r=" + r;
    }
</script>