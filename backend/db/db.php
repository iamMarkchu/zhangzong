<?php 
	$host = "localhost";
	$user = "root";
	$pwd = "chukui";
	$con = mysql_connect($host,$user,$pwd);
	mysql_select_db("zhangzong");
	mysql_query("set names 'utf8'");
 ?>