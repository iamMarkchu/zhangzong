<?php 
header("Content-type:text/html;charset=utf-8");
	if($_GET){
		$id = $_GET['id'];
		include_once "../db/db.php";
		$sql = "delete from keyword where id = {$id}";
		$f = mysql_query($sql);
		if($f){
			echo "关键词id : ".$id." 删除成功!";
		}else{
			echo mysql_error();
		}
		echo "<a href='index.php'>返回</a>";
	}
 ?>