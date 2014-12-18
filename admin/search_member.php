<?php
include("checksession.php");
include("header.html");
 


?>

<META http-equiv=Content-Type content=text/html;charset=utf-8>

 
<form name=form1  method="GET" action="listmember.php" >
 
<table width=98% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>
<tr>
  <td class=head colspan=5><b>会员搜索</b></td>
</tr>   
<tr align=center>

  <td class=b width=30%>昵称：</td>
  <td class=b><input name="search[username]" type="text" size="100" value="" /></td>
</tr>
<tr align=center>
  <td class=b width=30%>真实姓名：</td>
  <td class=b><input name="search[name]" type="text" size="100" value="" /></td>
</tr>
<tr align=center> 
  <td class=b width=30%>手机号码：</td>
  <td class=b><input name="search[mobile]" type="text" size="100" value="" /></td>

</tr>
</table></td></tr></table>
<br><center><input type='submit' value='提交查询'></center></form>		
					
<?php include("bottom.html"); ?>