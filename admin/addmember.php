<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html; charset=utf-8>

<form action="doaddmember.php" method=post name="form1">

<table width=70% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

<tr>
  <td class=head colspan=7><b>添加会员：</b></td>
</tr>




<tr align=center>
  <td class=b width=29%>用户名（昵称）:</td>
  <td colspan="3" class=b><input type=text name=username size=50></td></tr>
  <tr align=center>
  <td class=b width=29%>真实姓名:</td>
  <td colspan="3" class=b><input type=text name=name size=50></td></tr>
   <tr align=center>
  <td class=b width=29%>密码:</td>
  <td colspan="3" class=b><input type=password name=password size=50></td></tr>
     <tr align=center>
  <td class=b width=29%>确认密码:</td>
  <td colspan="3" class=b><input type=password name=password2 size=50></td></tr>
<tr align=center>
  <td class=b width=29%>手机号码:</td>
  <td colspan="3" class=b><input type=text name=mobile size=50></td></tr>
  <tr align=center>
  <td class=b width=29%>财富值:</td>
  <td colspan="3" class=b><input type=text name=caifu size=50></td></tr>  



</table></td></tr>
</table>
<br><center><input type='submit' value='提交'></center></form>


<?php include("bottom.html"); ?>