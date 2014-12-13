<?php
include("header.html");
include_once("checksession.php");

include_once("../db.php");


$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);
if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}



?>

<?php
$biaoti=$_POST["biaoti"];
$info=$_POST["info"];
$member_id=$_POST["member_id"];
$admin_id=$_SESSION["adminusername2"];
$ip = $_SERVER["REMOTE_ADDR"];
$dtime=date("Y-m-d H:i:s");



$query = "INSERT INTO member_to_member(`biaoti`,`info`,`receive_id`,`send_id`,`ip`,`dtime`) VALUES('$biaoti','$info','$member_id','$admin_id','$ip','$dtime') ";
$result = mysql_db_query($DataBase, $query);
if($result){
echo"私信添加成功！";
			
echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=list_member_to_member.php'>";
}
?>
<?php include("bottom.html"); ?>