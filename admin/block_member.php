<?php
include_once("checksession.php");
include("header.html");
?>

<?php

$tid = $_GET[tid];
$old_status = $_GET[blockstatus];

if($old_status==0){
	$status = '1';
}else{
	$status = '0';
}

include_once("../db.php");
$query="update member set blockstatus = $status where tid = $tid";
$result=mysql_db_query($DataBase, $query);
if($result){
	
	echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=listmember.php'>";
	if($old_status==0){
		echo "加入黑名单成功";
	}else{
		echo "移除黑名单成功";
	}

}else{
	echo "操作失败";
}


?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>