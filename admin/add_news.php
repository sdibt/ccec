<?php
require_once('./admin_header.php');
include_once("../fckeditor/fckeditor.php");
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
?>
    <div class="content">
        <h2 style="text-align:center">添加新的<?php echo $typetitle ?></h2>

        <form action="add_news_ok.php" method="post">
            <?php
            require_once('../include/set_post_key.php');
            ?>
            <font size=4>标题名称:</font><input type="text" name="title"><br><br>
            <font size=4>内容部分:(请在下面编辑框中填写)</font><br>
            <?php
            $fck_description = new FCKeditor('content');
            $fck_description->BasePath = '../fckeditor/';
            $fck_description->Height = 600;
            $fck_description->Width = 600;
            $fck_description->Value = "";
            $fck_description->Create();
            ?>
            <input type="hidden" name="typeid" value="<?php echo $typeid ?>">
            <br><input type="submit" value="确认" class="mybutton">
            <input type="button" value="取消" class="mybutton" onclick="javascript:history.go(-1);">
        </form>
    </div>
<?php
require_once('./admin_footer.php');
?>