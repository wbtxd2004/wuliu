<?php
include("header.html");
include_once("checksession.php");


include_once("../db.php");

$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);

//echo $_SESSION[adminusername2];
//print_r($r8);

if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}


$name=$_POST["name"];
$tid=$_GET["tid"];
$cid=$_POST["cid"];
$mobile=$_POST["mobile"];

$query="UPDATE tongxun_record SET `name`='$name',`cid`='$cid',`mobile`='$mobile'  WHERE `tid`='$tid'";
//echo $query;
$result = mysql_db_query($DataBase, $query);
if($result){
echo"通讯记录编辑成功！";
			
echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=list_record.php'>";
}
?>
<?php include("bottom.html"); ?>