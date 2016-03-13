<?php 
	echo phpinfo();exit;
	$f = fopen("wenben.txt", "w+");
	for ($i=0; $i <15 ; $i++) { 
		fwrite($f, "我是sb".$i."\r\n");
	}
	fclose($f);echo "success";
 ?>
