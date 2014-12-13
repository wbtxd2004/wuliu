<META http-equiv=Content-Type content=text/html;charset=utf-8>

<?php
//include("checksession.php");

include_once("../db.php");


$query = "select * from taobao_order where tid='$_GET[tid]' ";

$result = mysql_db_query($DataBase, $query);

$r=mysql_fetch_array($result);



$query = "select * from  index_product      where   order_id='$r[tid]'     order by tid  ";
$result2 = mysql_db_query($DataBase, $query);



while ($r2=mysql_fetch_array($result2)) {


if($r2[shipping_no]!='')
{
$r2[shipping_no]=str_replace(" ","",$r2[shipping_no]);
	$id='82DA925EDF9BCC17775E122592EC848B';//到http://www.ickd.cn/api/reg.html申请
	$url='http://api.ickd.cn/?com='.$r2[company].'&nu='.$r2[shipping_no].'&type=xml&id='.$id;   
	$data=file_get_contents($url);   //echo "var data='",$data,"'";  
	
	//echo $data;
$b=preg_match_all("(<status>.+?</status>)",$data,$array);

$now_status = str_replace("<status>","",$array[0][0]) ;
$now_status = str_replace("</status>","",$now_status) ;

$b=preg_match_all("(<time>.+?</time>)",$data,$array);

$now_time = str_replace("<time>","",$array[0][0]) ;
$now_time = str_replace("</time>","",$now_time) ;


$sql = "update index_product set status='$now_status',shipping_time='$now_time'    where tid='$r2[tid]' ";
$rr = mysql_db_query($DataBase, $sql);

echo"当前状态:". $now_status ;
echo"<br>";
echo"当前发货时间:". $now_time ;
echo"<br>";

}

}









/*
$sql = "update taobao_productclass set name='$_POST[name]'    where tid='$_GET[tid]' ";
$rr = mysql_db_query($DataBase, $sql);



if($rr){ 
echo"update success!";
$uu="$_SERVER[HTTP_REFERER]"; 

echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=$uu'>";
}
*/

?>