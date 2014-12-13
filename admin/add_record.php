<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>
<?php
include_once("../db.php");
$query="select count(tid) from tongxun_group";
$result=mysql_db_query($DataBase,$query);
$num=mysql_fetch_array($result);
if($num[0]<1)
{
	echo "当前通讯录群组没有记录<p>";
	echo "请至少创建一个群组再添加记录<p>";
	echo "点击<a href=add_group.php>这里</a>创建一个群组";
}
else
{
?>
<script language=javascript>
	function check()
	{
		obj1=document.f.name;
		obj2=document.f.mobile;
		if(obj1.value=="")
		{
			alert("名称不能为空！");
			obj1.focus();
			return false;
		}
		else if(obj2.value=="")
		{
			alert("手机号不能为空！");
			obj2.focus();
			return false;
		}
		else return true;
	}
</script>

<table width=70% align=center cellspacing=1 cellpadding=3 class=i_table>
<form action="doadd_record.php" method=post name="f" onsubmit="return check()">
<tr class=b>
  <td class=head colspan=2><b>添加通讯录</b></td>
</tr>
<tr align=center class=b><td>名&nbsp;&nbsp;称：</td><td><input type="text" name="name"></td></tr>
<tr  align=center class=b><td>选择群组：</td><td><select name="cid" size="1">
<?php

	$query="select * from tongxun_group";
	$result=mysql_db_query($DataBase,$query);
	while($row=mysql_fetch_array($result))
	{
		echo "<option value='".$row["tid"]."'>".$row["name"]."</option>\n";
	}

?>
</select>
</td></tr>
<tr align=center class=b><td>手机号：</td><td><input type="text" name="mobile"></td></tr>
<tr  align=center class=b><td colspan="2" align="center"><input type="submit" value="确认添加"></td></tr>
</form>
</table>
<?php
}
	?>
<?php include("bottom.html"); ?>
