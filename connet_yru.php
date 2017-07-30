<?php
	error_reporting( error_reporting() & ~E_NOTICE );
	$connect = mysql_connect("student.yru.ac.th","405659003_db","405659003");
	$db_select = mysql_select_db("405659003_db",$connect);

	mysql_query("SET NAMES UTF8");
	mysql_query("SET character_set_result=utf8");
?>
