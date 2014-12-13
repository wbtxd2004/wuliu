<?php
include("checksession.php");

include_once("../db.php");

$sql = "update  taobao_order   set order_number='$_POST[order_number]',shipping_info='$_POST[shipping_info]'  where tid='$_GET[tid]' ";
$rr = mysql_db_query($DataBase, $sql);

//echo $sql;

$sql = "delete from index_product   where order_id='$_GET[tid]' ";
$rr = mysql_db_query($DataBase, $sql);

 
 $ccc=count($_POST[shipping_no]);
 
 for($i=0;$i<$ccc;$i++)
{


if($_POST[shipping_no][$i]!='')
{
$query = "INSERT INTO index_product (company,shipping_no,product_info,air_type,info,shipping_info,order_number,order_id,cid) VALUES  ('".$_POST[company][$i]."','".$_POST[shipping_no][$i]."','".$_POST[product_info][$i]."','".$_POST[air_type][$i]."','".$_POST[info][$i]."','$_POST[shipping_info]','$_POST[order_number]','$_GET[tid]','$_POST[cid]')";
$result = mysql_db_query($DataBase, $query);
}


}

if($result){ 
echo"update success!";
$uu="$_SERVER[HTTP_REFERER]"; 

echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=listtags.php'>";
}


?>