<?php 
	include_once "../db/db.php";
	$sql = "select * from keyword";
	$f = mysql_query($sql);
	$kd = array();
	while ($row = mysql_fetch_array($f)) {
		$tmp['id'] = $row['id'];
		$tmp['values'] = $row['values'];
		$kd[] = $tmp;
	}
 ?>
 <html>
 <head>
 	<title>关键词管理</title>
 	<meta charset="UTF-8">
 </head>
 <body>
 	<a href="add.php">添加</a>
 	<a href="../index.php">返回主界面</a>
 	<table>
 		<tr>
 			<th>编号</th>
 			<th>关键字</th>
 			<th>操作</th>
 		</tr>
 		<?php foreach ($kd as $k => $v) {?>
 		<tr>
 			<td><?php echo $v['id'] ?></td>	
 			<td><?php echo $v['values'] ?></td>
 			<td><a href="delete.php?id=<?php echo $v['id']?>">删除</a></td>
 		</tr>
 		<?php }?>
 	</table>
 </body>
 </html>