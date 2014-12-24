<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
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
		echo  $result;
		echo"<br>";
		$str = mb_convert_encoding($result, "UTF-8", "gb2312");
		//$str = mb_convert_encoding($result, "UTF-8");
		echo $str;
		return $result;
	}

	function sms_send($phone, $content) {
	  $phoneList	= $phone;
	  //$content = mb_convert_encoding($content,"UTF-8","GB2312"); 
	  $content = mb_convert_encoding($content,"UTF-8","auto"); 
	  echo $content."</br>";
	  $userName = urlencode('hua_hxnyz');
	  $msgid="2";
	  $userPwd = '123456';
	  $url = "http://webservice.hctcom.com/service.asmx/SendSMS?";
	  $postStr = "uc=".$userName."&pwd=".$userPwd."&callee=".$phoneList."&cont=".$content."&msgid=".$msgid."&otime=";

	  $res = SendSMS($url,$postStr);
	  return substr($res,0,3) == 000 ? true : strval($content); 

}
   sms_send("18560653975","短信内容测试的");

?>