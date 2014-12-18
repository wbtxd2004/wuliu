<?php
include("checksession.php");
?>


<META http-equiv=Content-Type content=text/html;charset=utf-8>

<?php
include_once("../db.php");
$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);
if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}
$sql = "update beian_manage set password='$_POST[password]',states='$_POST[states]'  where tid='$_GET[tid]' ";
$rr = mysql_db_query($DataBase, $sql);



if($rr){ 
echo"修改管理员成功！";
echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=addadmin.php'>";

}


?>