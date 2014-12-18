<?php
include_once("checksession.php");
include("header.html");
include_once("../db.php");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<form action="doaddadmin.php" method=post name="form1">

<table width=70% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

<tr>
  <td class=head colspan=7><b>请添加网站管理员：</b></td>
</tr>

<tr align=center>
  <td class=b width=29%>管理员用户名:</td>
  <td colspan="3" class=b><input type=text name=username size=50></td></tr>


<tr align=center>
  <td class=b width=29%>登录密码:</td>
  <td colspan="3" class=b><input type=password name=password size=50></td></tr>
<tr align=center>
  <td class=b width=29%>密码确认:</td>
  <td colspan="3" class=b><input type=password name=password2 size=50></td></tr>
  

<tr align=center>
  <td class=b width=29%>手机号:</td>
  <td colspan="3" class=b><input type=text name=mobile size=50></td></tr>  
  

<tr align=center>
  <td class=b width=29%>所属单位(单位管理员才需要选择此项):</td>
  <td colspan="3" class=b>
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
  
  <td width="31%" align="center" class=b>
    <INPUT type=radio  value=1 name=states> 超级管理员
    <INPUT type=radio CHECKED value=2 name=states>  副超级管理员	  
    <INPUT type=radio CHECKED value=3 name=states>  单位管理员				  
    <br />
	</td>
  
</tr>
</table></td></tr>
</table>
<br><center><input type='submit' value='提交'></center></form>



<?php include("bottom.html"); ?>