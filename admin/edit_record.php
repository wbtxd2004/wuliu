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

	$query="SELECT * FROM tongxun_record WHERE tid=$tid";
	$result= mysql_db_query($DataBase, $query);
	$row=mysql_fetch_array($result);
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
<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<form name="f" method="post" action=doedit_record.php?tid=<?php echo $tid?>  onsubmit="return check()">
<tr align=center>
  <td class=head colspan=2><b>编辑记录</b></td>
</tr>
<tr align=center class=b><td>名&nbsp;&nbsp;称：</td><td><input type="text" name="name" value="<?php echo $row["name"]?>"></td></tr>
<tr align=center class=b><td>选择群组：</td><td><select name="cid" size="1">
<?php

	$re=mysql_db_query($DataBase,"select * from tongxun_group");
	while($row2=mysql_fetch_array($re))
	{
		echo "<option value='".$row2["tid"]."'";
		if($row["cid"]==$row2["tid"]) echo " selected";
		echo ">".$row2["name"]."</option>\n";
	}

?>
</select>
</td></tr>
<tr align=center class=b><td>手机号：</td><td><input type="text" name="mobile" value="<?php  echo $row["mobile"]?>"></td></tr>
<tr align=center><td colspan="2" align="center"><input type="submit" value="确认修改"></td></tr>
</form>
</table>
<?php
}
?>