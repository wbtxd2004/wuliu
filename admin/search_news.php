<?php
include("checksession.php");
 
 


?>
<?php include("header.html"); ?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

 
<form name=form1  method="GET" action="listnews.php" enctype="multipart/form-data">
 
<table width=98% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>
<tr>
  <td class=head colspan=5><b>新闻搜索</b></td>
</tr>   
     <tr align=center>
  <td class=b width=30%>关键字：</td>
  <td class=b><input name="keywords" type="text" size="100" value="" /></td>
</tr>
</table></td></tr></table>
<br><center><input type='submit' value='提交查询'></center></form>		
					
		<?php include("bottom.html"); ?>					
