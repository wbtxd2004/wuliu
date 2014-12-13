<?php
include_once("checksession.php");
include_once("../db.php");

$ip = $_SERVER["REMOTE_ADDR"];
$dbtime=date("Y-m-d H:i:s");
 
 $query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);
 
$query = "INSERT INTO taobao_order (order_number,shipping_info,admin_id) VALUES  ('$_POST[order_number]','$_POST[shipping_info]','$r8[tid]')";
$result = mysql_db_query($DataBase, $query);
 
 $new_id=mysql_insert_id();
 
 
 //print_r($_POST);
 
 
 $ccc=count($_POST[shipping_no]);
 
 for($i=0;$i<$ccc;$i++)
{


if($_POST[shipping_no][$i]!='')
{
$query = "INSERT INTO index_product (company,shipping_no,product_info,air_type,info,shipping_info,order_number,order_id,cid,admin_id) VALUES  ('".$_POST[company][$i]."','".$_POST[shipping_no][$i]."','".$_POST[product_info][$i]."','".$_POST[air_type][$i]."','".$_POST[info][$i]."','$_POST[shipping_info]','$_POST[order_number]','$new_id','$_POST[cid]','$r8[tid]')";
$result = mysql_db_query($DataBase, $query);


$new_id=mysql_insert_id();

	$id='82DA925EDF9BCC17775E122592EC848B';//µ½http://www.ickd.cn/api/reg.htmlÉêÇë
	$url='http://api.ickd.cn/?com='.$_POST[company][$i].'&nu='.$_POST[shipping_no][$i].'&type=xml&id='.$id;   
	$data=file_get_contents($url);   //echo "var data='",$data,"'";  
	
	//echo $data;
$b=preg_match_all("(<status>.+?</status>)",$data,$array);

$now_status = str_replace("<status>","",$array[0][0]) ;
$now_status = str_replace("</status>","",$now_status) ;

$b=preg_match_all("(<time>.+?</time>)",$data,$array);

$now_time = str_replace("<time>","",$array[0][0]) ;
$now_time = str_replace("</time>","",$now_time) ;


$sql = "update index_product set status='$now_status',shipping_time='$now_time'    where tid='$new_id' ";
$rr = mysql_db_query($DataBase, $sql);





}


}

if($result){
echo"insert success!";
 $uu="$_SERVER[HTTP_REFERER]";
echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=listtags.php'>";
}
?>