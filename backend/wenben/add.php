<?php
    if ($_FILES["file"]["error"] > 0){
      echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }else{
        $_FILES["file"]["name"] = "feiwu.txt";
        move_uploaded_file($_FILES["file"]["tmp_name"],"../../" . $_FILES["file"]["name"]);
        echo "success!"."<a href='../index.php'>返回</a>";
    }
?>