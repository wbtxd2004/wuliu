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


$biaoti=$_POST["biaoti"];
$info=$_POST["info"];
$tid=$_GET["tid"];

$query="UPDATE member_to_member SET `biaoti`='$biaoti',`info`='$info' WHERE `tid`='$tid'";
//echo $query;
$result = mysql_db_query($DataBase, $query);
if($result){
echo"私信编辑成功！";
			
echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=list_member_to_member.php'>";
}
?>
<?php include("bottom.html"); ?>