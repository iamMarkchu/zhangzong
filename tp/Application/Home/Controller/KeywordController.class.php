<?php
namespace Home\Controller;
use Think\Controller;
class KeywordController extends Controller {
    public function index(){
    	$sql = "select * from keyword";
    	$result = M()->query($sql);
    	$this->assign("keyword",$result);
        $this->display();
    }
    public function delete(){
    	if($_GET){
			$id = $_GET['id'];
			$kd = M('keyword');
			$f = $kd->delete($id);
			if($f){
				$this->success("删除成功!");
			}else{
				$this->error("删除失败!");
			}
		}
    }
    public function add(){
    	$this->display();
    }
    public function insert(){
		$keyword = D('keyword');
		if($keyword->create()){
		    $result = $keyword->add(); // 写入数据到数据库 
		    if($result){
		        // 如果主键是自动增长型 成功后返回值就是最新插入的值
		        $insertId = $result;
		    }
		}
		if($insertId){
			$this->success("保存成功!");
		}else{
			$this->error("保存失败!");
		}
    }
}