﻿<?php
if(!$_POST["message"])
{
	echo "没有短信内容！";
	exit();
}
else
{
	Function SendSMS($url,$postStr)
	{
		$ch = curl_init();
		$header = "Content-type: text/xml; charset=utf-8";
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($ch, CURLOPT_HEADER, $header);
		$result = curl_exec($ch);
		curl_close($ch); 
		$str = mb_convert_encoding($result, "UTF-8", "gb2312");
		return $result;
	}

	function sms_send($phone, $content) {
	  $phoneList	= $phone;
	  $content = mb_convert_encoding($content,"UTF-8","GB2312"); 
	  $userName = urlencode('hua_hxnyz');
	  $msgid="2";
	  $userPwd = '123456';
	  $url = "http://webservice.hctcom.com/service.asmx/SendSMS?";
	  $postStr = "uc=".$userName."&pwd=".$userPwd."&callee=".$phoneList."&cont=".$content."&msgid=".$msgid."&otime=";

		$res = SendSMS($url,$postStr);
	  return substr($res,0,3) == 000 ? true : strval($content); 

}
	$c=$_POST["c"];
	$content= urlencode($_POST["message"]);//内容
	for($i=0;$i<$num;$i++)
	{
		sms_send($c[$i],$content);
	}
	if($i==$num)
	{
		echo "成功群发短信，";
		echo "点<a href=list_group.php'>这里</a>返回";
	}
}
?> 