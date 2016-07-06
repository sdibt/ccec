<?php
require_once('./index_header.php');
?>
<div class="content clearfix">
    <?php
    require_once('./school_btf.php');
    ?>
    <div class="right">
        <hr>
        <div class="newsbar">
            <div class="pull-left title">在线捐赠</div>
        </div>
        <div style="clear:both"></div>
        <hr>
        <div class="msgshow">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;感谢您对山东工商学院教育事业的支持！首先请确认您的银行卡已经开通网上银行业务(具体开通方法可参见各银行网站)，然后填写以下信息，点击确认,会保存您的捐款意向.您可以通过银行转账等方式进行捐赠.
            带<font color=red> * </font>号为必填项。
            <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;收款人：山东工商学院教育发展基金会<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;银行帐号：3760 0110 5018 0100 34048<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;开 户 行：交通银行股份有限公司烟台莱山支行<br>
            如需捐赠收据，请在留言中说明并确保通讯地址的有效性，我们会在捐赠到帐后给您寄送。
        </div>
        <hr style="border:1px dashed #DCE1DB">
        <div class="infoshow">
            <form action="jz_online_ok.php" method="post" onSubmit="return checkinput(this)">
                <table>
                    <tr>
                        <td><font color=red>*</font>请输入您要捐赠的金额：(人民币 RMB 单位 元，整数，最低 1 元)</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="money">元</td>
                    </tr>

                    <tr>
                        <td>请输入您要捐赠的项目：</td>
                    </tr>
                    <tr>
                        <td><select name="project" id="project">
                                <option value="0">无指定项目</option>
                                <?php
                                require_once('./include/db_info.inc.php');
                                $sql = "SELECT `news_id`,`title` FROM `News_main` WHERE `type_id`='3'";
                                $result = mysql_query($sql) or die(mysql_error());
                                while ($row = mysql_fetch_object($result)) {
                                    echo "<option value=\"$row->news_id\">$row->title</option>";
                                }
                                mysql_free_result($result);
                                ?>
                            </select></td>
                    </tr>

                    <tr>
                        <td><font color=red>*</font>请输入您的姓名：(只能包含字母、数字、下划线和汉字)</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="yourname"></td>
                    </tr>

                    <tr>
                        <td><font color=red>*</font>请输入您的E-mail：</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="email" maxlength=50></td>
                    </tr>

                    <tr>
                        <td>请输入您的联系电话：(只能包含数字)</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="telphone" maxlength=15></td>
                    </tr>

                    <tr>
                        <td>请输入您的地址：</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="address"></td>
                    </tr>

                    <tr>
                        <td>请输入您的邮编：</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="postcode" maxlength=10></td>
                    </tr>

                    <tr>
                        <td>
                            <hr style="border:1px dashed #DCE1DB">
                        </td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="ourschool" value="1" checked>校友
                            <input type="radio" name="ourschool" value="0">非校友
                        </td>
                    </tr>

                    <tr>
                        <td><font color=red>*</font>请输入您的入学时间及院部(如：10计算机科学与技术学院或10学生处)</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="schoolname"></td>
                    </tr>
                    <tr>
                        <td>
                            <hr style="border:1px dashed #DCE1DB">
                        </td>
                    </tr>

                    <tr>
                        <td>留言:</td>
                    </tr>
                    <tr>
                        <td><textarea name="message" id="message" cols="30" rows="10"></textarea></td>
                    </tr>

                    <tr>
                        <td>验证码:<input type="text" name="vcode" size=4>
                            <img src="./include/vcode.php" id="img1" align="absmiddle" onclick="get_img()"><font
                                color=red>*</font></td>
                    </tr>
                </table>
                <input type="submit" value="确认捐款" class="mybutton">
            </form>
        </div>
    </div>
</div>
<?php
require_once('./index_footer.php');
?>
<script type="text/javascript" language="javascript">
    function get_img() {
        var r = Math.round(Math.random() * 10000);
        document.getElementById('img1').src = "./include/vcode.php?action=get_img&r=" + r;
    }
    function checkinput(form) {
        if (form.money.value == "") {
            alert("请输入您要捐赠的金额！");
            form.money.focus();
            return false;
        }
        if (form.yourname.value == "") {
            alert("请输入您的姓名！");
            form.yourname.focus();
            return false;
        }
        if (form.email.value == "") {
            alert("请输入您的邮箱！");
            form.email.focus();
            return false;
        }
        if (form.schoolname.value == "") {
            alert("请输入您的入学时间及院部");
            form.schoolname.focus();
            return false;
        }
        if (form.vcode.value == "") {
            alert("请输入验证码!");
            form.vcode.focus();
            return false;
        }
        return true;
    }
</script>