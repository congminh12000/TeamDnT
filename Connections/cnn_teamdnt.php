<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$url = "http://teamdnt.dev/";
$hostname_cnn_teamdnt = "127.0.0.1";
$database_cnn_teamdnt = "teamdnt";
$username_cnn_teamdnt = "root";
$password_cnn_teamdnt = "";
$cnn_teamdnt = mysql_connect($hostname_cnn_teamdnt, $username_cnn_teamdnt, $password_cnn_teamdnt) or die('fails');
?>
