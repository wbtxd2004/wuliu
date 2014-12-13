<?php

include("checksession.php");
include_once("../db.php");
$query = "select * from danwei where tid='$_GET[tid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r=mysql_fetch_array($result);
print_r($r);
echo $_SESSION['adminusername2'];
$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);
if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}
?>
<?php include("header.html"); ?>

<META http-equiv=Content-Type content=text/html;charset=utf-8>

<form name=form1  method="POST" action="doeditdanwei.php?tid=<?php echo $r[tid];  ?>">
<table width=98% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>
<tr><td class=head colspan=5><b>编辑单位</b></td></tr>

<tr align=center><td class=b width=30%>单位ID:</td>
<td colspan="3" class=b><input name="tid" type="text" size="100" value="<?php echo $r["tid"];  ?>" /></td></tr>

<tr align=center><td class=b width=30%>单位名称:</td>
<td colspan="3" class=b><input name="name" type="text" size="100" value="<?php echo $r["name"];  ?>" /></td></tr>



<tr align=center><td class=b width=30%>用户名（短信通道）:</td>
<td colspan="3" class=b><input name="username" type="text" size="100" value="<?php echo $r["username"];  ?>" /></td></tr>


<tr align=center><td class=b width=30%>密码（短信通道）:</td>
<td colspan="3" class=b><input name="password" type="text" size="100" value="<?php echo $r["password"];  ?>" /></td></tr>

<tr align=center><td class=b width=30%>msgid:</td>
<td colspan="3" class=b><input name="msgid" type="text" size="100" value="<?php echo $r["msgid"];  ?>" /></td></tr>

<!--<tr align=center>
  <td class=b width=29%>选择权限:</td>
  <td width="12%" align="center" class=b></td>
  <td width="31%" align="right" class=b>
   <input type=radio value=1  <?php if($r[states]==1) { ?> checked="checked" <?php } ?>
                  name=states>
   超级管理员  
   <input type=radio value=2  <?php if($r[states]==2) { ?>checked="checked" <?php } ?>
                  name=states>一般管理员
    <br />
    
	</td>
  <td width="28%" align="center" class=b>&nbsp;</td>
</tr>-->

</table></td></tr></table>
<br><center><input type='submit' value='提交修改'></center></form>		
					
		<?php include("bottom.html"); ?>					
