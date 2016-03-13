<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();


class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty( $keyword ))
                {
                    $host = 'localhost';
                    $user = 'root';
                    $pwd = 'chukui';
                    $con = mysql_connect($host,$user,$pwd);
                    mysql_select_db("zhangzong");
                    mysql_query("set names 'utf8'");
                    $contentStr = "";
                    $sql = "select * from Keyword";
                    $f = mysql_query($sql);
                    $kd = array();
                    while ($row = mysql_fetch_array($f)) {
                        if($row['values'] == '?' || $row['values'] == '？'){
                            $kd[] = "\\".$row['values'];
                        }else{
                            $kd[] = $row['values'];
                        }
                    }
                    $kd = implode("|", $kd);
                    $reg = "/($kd)/";
                    if(preg_match($reg,$keyword)){
                        $file = file('./feiwu.txt');
                        shuffle($file);
                        $contentStr = $file[0];
                    }
              		$msgType = "text";
                	if(empty($contentStr)) $contentStr = "您好!";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			$time = date("Y-m-d H:i:s");
                    $sql = "insert into user (`fromuser`,`touser`,`sendtime`,`content`,`backcontent`) values ('{$fromUsername}','{$toUsername}','{$time}','{$keyword}','{$contentStr}')";
                    $f = mysql_query($sql);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }
                mysql_close();
        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>
