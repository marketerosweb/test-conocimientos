<?php


define('BASE_PATH','http://marketerosweb.website/test/');
define('DB_HOST', 'localhost');
define('DB_NAME', 'markete3_conocimientosphp');
define('DB_USER','markete3_usercon');
define('DB_PASSWORD','Vp8gu#0x_O0}');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
mysql_set_charset('utf8',$con);
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

?>