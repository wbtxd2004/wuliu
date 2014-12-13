<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>
<script language=javascript>
	function check()
	{
		obj1=document.f.biaoti;
		obj2=document.f.info;
		if(obj1.value=="")
		{
			alert("广告标题不能为空！");
			obj1.focus();
			return false;
		}
		else if(obj2.value=="")
		{
			alert("广告内容不能为空！");
			obj2.focus();
			return false;
		}
		else return true;
	}
</script>

<table width=70% align=center cellspacing=1 cellpadding=3 class=i_table>
<form action="doadd_guanggao.php" method=post name="f" onsubmit="return check()">
<tr class=b>
  <td class=head colspan=2><b>添加广告</b></td>
</tr>
<tr align=center class=b><td>广告标题：</td><td><input type="text" name="biaoti" size=58></td></tr>
<tr  align=center class=b><td>广告内容：</td><td><textarea rows=10 cols=50 name="info"></textarea>
</td></tr>
<tr  align=center class=b><td colspan="2" align="center"><input type="submit" value="确认添加"></td></tr>
</form>
</table>
<?php include("bottom.html"); ?>
