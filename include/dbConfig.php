<?php
static $DB_HOST = "127.0.0.1";
static $DB_NAME = "found";
static $DB_USER = "root";
static $DB_PASS = "root";

if (mysql_pconnect($DB_HOST, $DB_USER, $DB_PASS)) ;
else
    die('Could not connect: ' . mysql_error());
mysql_query("set names utf8");
mysql_set_charset("utf8");
if (mysql_select_db($DB_NAME)) ;
else
    die('Could not use foo : ' . mysql_error());
date_default_timezone_set("PRC");
?>