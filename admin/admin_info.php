<?php
require_once('./admin_header.php');
require_once('./navbar.php');
include_once("../fckeditor/fckeditor.php");
$infoid = 1;
if (isset($_GET['infoid'])) {
    $infoid = intval($_GET['infoid']);
    if ($infoid < 1 || $infoid > $INFO_NUM) {
        $infoid = 1;
    }
}
$sql = "SELECT `title`,`content` FROM `info` WHERE `info_id`='$infoid'";
$result = mysql_query($sql) or die(mysql_error());
$row_cnt = mysql_num_rows($result);
if ($row_cnt != 0) {
    $row = mysql_fetch_object($result);
    echo "<div class=\"content\">";
    echo "<h1>修改 $row->title</h1>";
    echo "<form action=\"edit_info.php\" method=\"post\">";
    $fck_description = new FCKeditor('content');
    $fck_description->BasePath = '../fckeditor/';
    $fck_description->Height = 600;
    $fck_description->Width = 600;
    $fck_description->Value = $row->content;
    $fck_description->Create();
    require_once("../include/set_post_key.php");
    echo "<br><input type=\"hidden\" name=\"infoid\" value=\"$infoid\">";
    echo "<input type=\"submit\" value=\"确认修改\" class=\"mybutton\">";
    echo "</form></div>";
    mysql_free_result($result);
} else {
    echo "No Such information";
}
?>
<?php
require_once('./admin_footer.php');
?>