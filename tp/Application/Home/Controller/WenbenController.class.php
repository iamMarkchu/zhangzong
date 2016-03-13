<?php
namespace Home\Controller;
use Think\Controller;
class WenbenController extends Controller {
    public function index(){
        $this->display();
    }

    public function upload(){
    	if ($_FILES["file"]["error"] > 0){
	       $this->error($_FILES["file"]["error"]);
	    }else{
	        $_FILES["file"]["name"] = "feiwu.txt";
	        $f = move_uploaded_file($_FILES["file"]["tmp_name"],"/home/www/weixin/" . $_FILES["file"]["name"]);
	        if($f){
	        	$this->success("上传成功!");
	        }else{
	        	$this->error("上传失败!");
	        }
	    }
    }
}