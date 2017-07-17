<?php 
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'root');
define('DATABASE', 'tangshi');
define('CHAR', 'utf8');

// login mysql server
$link = mysql_connect(HOST,USER,PASSWORD) or die('database connecting faild');

// select databases
mysql_select_db(DATABASE);
// charset
mysql_set_charset(CHAR);

// Time
date_default_timezone_set('PRC');

?>

