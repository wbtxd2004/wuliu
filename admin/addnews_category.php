<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html; charset=utf-8>

<form action="doaddnews_category.php" method=post name="form1" method="post">

<table width=70% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

<tr>
  <td class=head colspan=7><b>添加新闻分类：</b></td>
</tr>




<tr align=center>
  <td class=b width=29%>分类名称:</td>
  <input type="hidden"  name='cid' value="<?php echo $_GET[tid] ; ?>" >
   
  <td colspan="3" class=b><input type=text name=name size=50></td></tr>
  <td colspan="3" class=b  align=center>  
      
    </td></tr>

 
</table></td></tr>
</table>
<br><center><input type='submit' value='提交'></center></form>


<?php include("bottom.html"); ?>