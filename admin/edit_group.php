<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>
<center>
<?php

if(!$_GET["tid"])
{
	echo "传入id错误<p>";
	echo "点击<a href=listgroup.php>这里</a>查看群组";
}
else
{
	

	include_once("../db.php");
	$tid=$_GET["tid"];
	$query="SELECT * FROM tongxun_group WHERE tid=$tid";
	$result= mysql_db_query($DataBase, $query);
	$row=mysql_fetch_array($result);
	?>
	<script language=javascript>
	function check()
	{
		obj=document.f.name;
		if(obj.value=="")
		{
			alert("群组名称不能为空！");
			obj.focus();
			return false;
		}
		else return true;
	}
</script>

<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
	<form name="f" method="post" action=doedit_group.php?tid=<?php echo $tid?> onsubmit="return check()">
<tr>
  <td class=head colspan=2><b>编辑群组</b></td>
</tr>
<tr align="center" class="b">
<td>新的群组名称：</td>

<td>
<input type="text" name="name" value="<?php echo $row["name"]?>"><input type="submit" value="确认修改">
</tr>
</form>
</table>
<?php
}
?>
<?php include("bottom.html"); ?>