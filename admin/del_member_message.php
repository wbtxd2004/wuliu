<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<?php

if(!$_GET["tid"])
{
	echo "没有传入删除群组ID，<p>";
	echo "<a href='list_member_message.php'>查看私信</>";
}
else
{
	include_once("../db.php");
	$tid=$_GET["tid"];
	$query="DELETE FROM member_get_message WHERE `tid`=$tid";
	$result=mysql_db_query($DataBase, $query);
	if($result)
	{
		echo"私信删除成功！";
		echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=list_member_message.php'>";
	}
}
?>
<?php include("bottom.html"); ?>