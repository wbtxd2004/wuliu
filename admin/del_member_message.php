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
	$sql="select filename from member_get_message_images where mid=$tid";
	$r=mysql_db_query($DataBase,$sql);
	while($row=mysql_fetch_array($r))
	{
		if($row['filetype'] === 0){
			unlink("message_image/big/".$row["filename"]);
			unlink("message_image/small/".$row["filename"]);			
		}elseif($row['filetype'] === 1){
			unlink("message_audio/".$row["filename"]);		
		}
	}
	$query="DELETE FROM member_get_message_images WHERE `mid`=$tid";
	mysql_db_query($DataBase, $query);

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