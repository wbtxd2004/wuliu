<?php
include_once("checksession.php");
include("header.html");
?>

<form action="doadd_group.php" method=post name="form1">

<table width=70% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

<tr>
  <td class=head colspan=7><b>添加通讯录群组：</b></td>
</tr>

<tr align=center>
  <td class=b width=29%>群组名称:</td>
  <td colspan="3" class=b><input type=text name="name" size=50></td></tr>



</table></td></tr>
</table>
<br><center><input type='submit' value='提交'></center></form>

<?php include("bottom.html"); ?>
