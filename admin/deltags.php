<?php
include("checksession.php");

include_once("../db.php");

 

//echo $sql;
$sql = "delete from taobao_order   where tid='$_GET[tid]' ";
$rr = mysql_db_query($DataBase, $sql);



$sql = "delete from index_product   where order_id='$_GET[tid]' ";
$rr = mysql_db_query($DataBase, $sql);

 

if($rr){ 
echo"delete success!";
$uu="$_SERVER[HTTP_REFERER]"; 

echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=$uu'>";
}


?>