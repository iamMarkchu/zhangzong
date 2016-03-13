<?php
	header("Content-type:text/html;charset=utf-8");
	if($_POST){
		$keyword = $_POST['keyword'];
		include_once "../db/db.php";
		$sql = "insert into keyword (`values`) values ('{$keyword}')";
		$f = mysql_query($sql);
		if($f){
			echo "关键词 : ".$keyword." 提交成功!"."<a href='index.php'>返回</a>";
		}else{
			echo mysql_error();
		}
	}
?>