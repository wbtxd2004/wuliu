<?php


include("checksession.php");
?>


<META http-equiv=Content-Type content=text/html;charset=utf-8>

<?php

include_once("../db.php");
echo  $_SESSION['adminusername2'];
$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";

$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);
if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}
$sql = "update danwei set name='$_POST[name]',username='$_POST[username]',password='$_POST[password]',msgid='$_POST[msgid]' where tid='$_GET[tid]' ";
$rr = mysql_db_query($DataBase, $sql);



if($rr){ 
echo"修改单位成功！";
echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=adddanwei.php'>";

}


?>