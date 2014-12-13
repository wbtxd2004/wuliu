<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<?php

if(!$_GET["tid"])
{
	echo "没有传入删除群组ID，<p>";
	echo "<a href='group.php'>查看群组</>";
}
else
{
	include_once("../db.php");
	$tid=$_GET["tid"];
	$query="DELETE FROM tongxun_record WHERE `tid`=$tid";
	$result=mysql_db_query($DataBase, $query)or die("删除失败");
	if($result) 
	{
		echo"通讯录删除成功！";
		echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=list_record.php'>";
	}
}
?>
<?php include("bottom.html"); ?>