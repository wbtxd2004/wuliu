<?php
include_once("checksession.php");
if(empty($_POST[username])){exit;}
if($_POST[password]!=$_POST[password2] ){echo"密码不一致"; exit;}
include_once("../db.php");
if($_POST[username]!='')
{
$query = "select * from beian_manage where username='$_POST[username]' ";
$result = mysql_db_query($DataBase, $query); 
if($r2=mysql_fetch_array($result))
{
echo"<script>alert('该管理员已经存在！');history.go(-1);</script>";
exit;
}
}

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
$ip = $_SERVER["REMOTE_ADDR"];
$dbtime=date("Y-m-d H:i:s");

$query = "INSERT INTO beian_manage (username,password,states,danwei_id,mobile) VALUES ('$_POST[username]','$_POST[password]','$_POST[states]','$_POST[danwei_id]',$_POST[mobile])";
$result = mysql_db_query($DataBase, $query);
var_dump($result);
if($result){
echo"管理员添加成功！";
			
echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=addadmin.php'>";
}
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>