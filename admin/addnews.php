<?php
include_once("checksession.php");
include("header.html");


?>

<?php
  include_once("../db.php");
  $ip = $_SERVER["REMOTE_ADDR"];
$dbtime=date("Y-m-d H:i:s");

  $query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);

?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<form action="doaddnews.php" method=post name="form1" enctype="multipart/form-data">

<table width=70% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

<tr>
  <td class=head colspan=7><b>添加文章：</b></td>
</tr>

<tr align=center>
  <td class=b width=29%>标题:</td>
  <td colspan="3" class=b><input type=text name=biaoti size=50></td></tr>


<!-- 发布者 -->
   
<!-- 发布者 -->

<?php
      


?>
  
  <tr align=center>
  <td class=b width=29%>栏目名称:</td>
  <td colspan="3" class=b><select name=cid>
  
   <?php

$query = "select * from new_class  where cid=0  order by tid ";

$result = mysql_db_query($DataBase, $query); 

while ($r2 = mysql_fetch_array($result)) 

{

echo"<option value=$r2[tid] >A $r2[name]</option>";

$query = "select * from new_class  where cid='$r2[tid]'  order by tid  ";

$result2 = mysql_db_query($DataBase, $query); 

while ($r3 = mysql_fetch_array($result2)) 

{

echo"<option value=$r3[tid] >&nbsp;&nbsp;&nbsp;&nbsp;B  $r3[name]</option>";
     $query = "select * from new_class  where cid='$r3[tid]'  order by tid  ";

$result2 = mysql_db_query($DataBase, $query); 

while ($r4 = mysql_fetch_array($result2)) 

{

echo"<option value=$r4[tid] >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C  $r4[name]</option>";

}

}

}

?>
  </select>
  
  </td></tr>
  
    <tr align=center>
  <td class=b width=29%>文章内容:</td>
  <td colspan="3" class=b>
  <textarea cols="50" rows="10" name="info" ></textarea>
  
  </td></tr>

            <tr align=center class=b> 
              <td>文件：</td>
              <td> 
                <input type="file" name="upload_file[]" multiple="multiple">
              </td>
            </tr>

</table>
<td></td>
</table>
<br><center><input type='submit' value='提交'></center></form>
<?php
mysql_free_result($result);
?>

<?php include("bottom.html"); ?>