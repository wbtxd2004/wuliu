<?php
include_once("checksession.php");
include("header.html");
?>
<?php

if(!$_GET["tid"])
{
	echo "传入id错误<p>";
	echo "点击<a href=record.php>这里</a>查看通讯录";
}
else
{
	

		include_once("../db.php");
	$tid=$_GET["tid"];

	$query="SELECT * FROM guanggao WHERE tid=$tid";
	$result= mysql_db_query($DataBase, $query);
	$row=mysql_fetch_array($result);
?>
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
<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<form action="doedit_guanggao.php?tid=<?php echo $tid?>" method=post name="f" onsubmit="return check()">
<tr class=b>
  <td class=head colspan=2><b>编辑广告</b></td>
</tr>
<tr align=center><td>广告标题：</td><td><input type="text" name="biaoti" value="<?php echo $row["biaoti"]?>"></td></tr>
<tr  align=center class=b><td>广告内容：</td><td><textarea rows=10 cols=50 name="info"><?php echo $row["info"]?></textarea>
</td></tr>
<tr  align=center class=b><td colspan="2" align="center"><input type="submit" value="确认编辑"></td></tr>
</form>
</table>
</table>
<?php
}
?>