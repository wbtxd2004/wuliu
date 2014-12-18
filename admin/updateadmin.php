<?php
include("checksession.php");
include_once("../db.php");
$query = "select * from beian_manage where tid='$_GET[tid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r=mysql_fetch_array($result);

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

<form name=form1  method="POST" action="doupdateadmin.php?tid=<?php echo $r[tid];  ?>">
<table width=98% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>
<tr><td class=head colspan=5><b>编辑管理员</b></td></tr>
<tr align=center><td class=b width=30%>管理员用户名:</td>
<td colspan="3" class=b><input name="username" type="text" size="100" value="<?php echo $r["username"];  ?>" /></td></tr>



<tr align=center>
  <td class=b width=30%>登录密码:</td>
  <td colspan="3" class=b><input name="password" type="password" size="100"  /></td></tr>
  <tr align=center>
  <td class=b width=30%>确认密码:</td>
  <td colspan="3" class=b><input name="password2" type="password" size="100" /></td></tr>

<tr align=center>
  <td class=b width=29%>手机号:</td>
  <td colspan="3" class=b><input type="text" name="mobile" size="100" value="<?php echo $r["mobile"]; ?>"></td></tr>  
<tr align=center>
  <td class=b width=29%>所属单位(单位管理员才需要选择此项):</td>
  <td align="left" colspan="3" class=b>
    <SELECT   name=danwei_id>
        <?php
          $query = "select * from  danwei    order by tid desc ";
          $result = mysql_db_query($DataBase, $query); 
                    
          while ($r2 = mysql_fetch_array($result)) 
          {
            if($r2[tid]==$_GET[tid])
            {
              echo"<option value=$r2[tid]  selected=\"selected\">".$r2[name]."</option>";
            }else
            {
              echo"<option value='$r2[tid]' >".$r2[name]."</option>";
            }
          }
                               
        ?> 
    </SELECT>
  </td>
</tr> 
<tr align=center>
  <td class=b width=29%>选择权限:</td>
  <td width="31%" align="left" class=b>
    <input type=radio  value=1 <?php if($r[states]==1) { ?> checked="checked" <?php } ?> name=states>  超级管理员
    <input type=radio  value=2 <?php if($r[states]==2) { ?> checked="checked" <?php } ?> name=states>  副超级管理员    
    <input type=radio  value=3 <?php if($r[states]==2) { ?> checked="checked" <?php } ?> name=states>  单位管理员         
    <br />
  </td> 
</tr>

<!--
<tr align=center>
  <td class=b width=29%>选择权限:</td>
  <td width="12%" align="center" class=b></td>
  <td width="31%" align="right" class=b>
   <input type=radio value=2  <?php if($r[states]==2) { ?> checked="checked" <?php } ?>
                  name=states>
   超级管理员  
   <input type=radio value=0  <?php if($r[states]==0) { ?>checked="checked" <?php } ?>
                  name=states>一般管理员
    <br />
    
	</td>
  <td width="28%" align="center" class=b>&nbsp;</td>
</tr>
-->

</table></td></tr></table>
<br><center><input type='submit' value='提交修改'></center></form>		
					
		<?php include("bottom.html"); ?>					
