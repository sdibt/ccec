<?php
function pwGen($password, $md5ed = False) {
    if (!$md5ed) $password = md5($password);
    $salt = sha1(rand());
    $salt = substr($salt, 0, 4);
    $hash = base64_encode(sha1($password . $salt, true) . $salt);
    return $hash;
}

function pwCheck($password, $saved) {
    if (isOldPW($saved)) {
        $mpw = md5($password);
        if ($mpw == $saved) return True;
        else return False;
    }
    $svd = base64_decode($saved);
    $salt = substr($svd, 20);
    $hash = base64_encode(sha1(md5($password) . $salt, true) . $salt);
    if (strcmp($hash, $saved) == 0) return True;
    else return False;
}

function isOldPW($password) {
    for ($i = strlen($password) - 1; $i >= 0; $i--) {
        $c = $password[$i];
        if ('0' <= $c && $c <= '9') continue;
        if ('a' <= $c && $c <= 'f') continue;
        if ('A' <= $c && $c <= 'F') continue;
        return False;
    }
    return True;
}

function isemail($str) {
    $moder = "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
    if (preg_match($moder, $str))
        return true;
    else
        return false;
}

function isnum($str) {
    $moder = "/^\d*$/";
    if (preg_match($moder, $str))
        return true;
    else
        return false;
}

function showpagedown($page, $prepage, $startpage, $endpage, $nextpage, $lastpage, $url) {
    echo "<div class=\"pagination\" style=\"text-align:center\">";
    echo "<ul>";
    echo "<li><a href=\"$url&page=1\">First</a></li>";
    if ($page == 1)
        echo "<li class=\"disabled\"><a href=\"\">Previous</a></li>";
    else
        echo "<li><a href=\"$url&page=$prepage\">Previous</a></li>";
    for ($i = $startpage; $i <= $endpage; $i++) {
        if ($i == $page)
            echo "<li class=\"active\"><a href=\"$url&page=$i\">$i</a></li>";
        else
            echo "<li><a href=\"$url&page=$i\">$i</a></li>";
    }
    if ($page == $lastpage)
        echo "<li class=\"disabled\"><a href=\"\">Next</a></li>";
    else
        echo "<li><a href=\"$url&page=$nextpage\">Next</a></li>";
    echo "<li><a href=\"$url&page=$lastpage\">Last</a></li>";
    echo "</ul>";
    echo "</div>";
}

function showpageup($table, $searchsql = "") {
    if (isset($_GET['page'])) {
        if (!is_numeric($_GET['page']))
            $page = 1;
        $page = intval($_GET['page']);
    } else
        $page = 1;
    $each_page = 12;// each page data num
    $pagenum = 10;//the max of page num

    $sql = "SELECT COUNT(*) FROM $table $searchsql";
    $result = mysql_query($sql) or die(mysql_error());
    $total = mysql_result($result, 0);
    mysql_free_result($result);

    $totalpage = ceil($total / $each_page);
    if ($totalpage == 0) $totalpage = 1;
    $page = $page < 1 ? 1 : $page;
    $page = $page > $totalpage ? $totalpage : $page;

    $offset = ($page - 1) * $each_page;
    $sqladd = " limit $offset,$each_page";

    $lastpage = $totalpage;
    $prepage = $page - 1;
    $nextpage = $page + 1;

    $startpage = $page - 4;
    $startpage = $startpage < 1 ? 1 : $startpage;
    $endpage = $startpage + $pagenum - 1;
    $endpage = $endpage > $totalpage ? $totalpage : $endpage;
    return array('page' => $page,
        'prepage' => $prepage,
        'startpage' => $startpage,
        'endpage' => $endpage,
        'nextpage' => $nextpage,
        'lastpage' => $lastpage,
        'eachpage' => $each_page,
        'sqladd' => $sqladd);
}

?>