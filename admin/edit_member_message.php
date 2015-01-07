<?php 
include_once("checksession.php");
include("header.html");
?>
<?php

if(!$_GET["tid"])
{
	echo "传入id错误<p>";
	echo "点击<a href=list_member_message.php>这里</a>查看私信";
}
else 
{
	

	include_once("../db.php");
	$tid=$_GET["tid"];

	$query="SELECT * FROM member_get_message WHERE tid=$tid";
	$result= mysql_db_query($DataBase, $query);
	$row=mysql_fetch_array($result);
?>
<script language=javascript>
	function check()
	{
		obj1=document.f.biaoti;
		obj2=document.f.info;
		file_num=document.f["upload_file[]"].files.length
		if(obj1.value=="")
		{
			alert("私信标题不能为空！");
			obj1.focus();
			return false;
		}
		else if(obj2.value=="")
		{
			alert("私信内容不能为空！");
			obj2.focus();
			return false;
		}
		else if(file_num>10)
		{
			alert("上传文件大于10个！");
			return false;
		}
		else return true;
	}
</script>
<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<form action="doedit_member_message.php?tid=<?php echo $tid?>" method=post name="f" onsubmit="return check()" enctype="multipart/form-data">
<tr class=b>
  <td class=head colspan=2><b>编辑私信</b></td>
</tr>
<tr align=center class=b><td>收件人ID：</td><td><?php echo $row["member_id"]?></td></tr>
<tr align=center class=b><td>私信标题：</td><td><input type="text" name="biaoti" value="<?php echo $row["biaoti"]?>" size=58></td></tr>
<tr  align=center class=b><td>私信内容：</td><td><textarea rows=5 cols=50 name="info"><?php echo $row["info"]?></textarea>
</td></tr>
<tr  align=center class=b><td>已有图片：</td><td>
<?php
$sql="select * from member_get_message_images where mid='$tid' and filetype='0' ";
	$r=mysql_db_query($DataBase,$sql);
	$n=mysql_num_rows($r);
	//$obj=mysql_fetch_array($r);
	if($n==0) echo "无";
	else
	{
		while($obj=mysql_fetch_array($r))
		{
			if ($obj[filetype]!=0) {
				echo "无";
			}
			else{

				$filename = explode ('/', $obj["filename"]);
				$filename = $filename[1];
				echo "<div style='float:left'>";
				echo "<input type='checkbox' name='checkimg[]' value='".$obj["tid"]."'>";
				echo "<a href=message_image/big/".$obj["filename"]." target=_blank>";
				echo "<img src=message_image/small/".$obj["filename"].">";
				echo "<br>".$filename;
				echo "</a>&nbsp;&nbsp;";
				echo "</div>";
			}
		}
	}
?>
<p>
选中的图片将被删除</td></tr>
<tr  align=center class=b><td>上传新图：</td><td><input type="file" name="upload_file[]" size="58"  multiple ></td></tr>

<!--修改声音上传部分，Changed By WuBin in 20141212-->
<tr  align=center class=b><td>已有声音：</td><td>
<?php
$sql="select * from member_get_message_images where mid='$tid' and filetype='1'";
	$queryaudio=mysql_db_query($DataBase,$sql);
	$audionum=mysql_num_rows($queryaudio);
	if($audionum==0) echo "无";
	else
	{
		while($audiobj=mysql_fetch_array($queryaudio))
		{
			if ($audiobj[filetype]!=1) {
				echo "无 2";
			}else{

				$filename = explode ('/', $audiobj["filename"]);
				$filename = $filename[1];				
				echo "<div style='float:left'>";			
				echo "<input type='checkbox' name='checkaudio[]' value='".$audiobj["tid"]."'>";
				echo "<a href=message_audio/".$audiobj["filename"]." target=_blank>";
				echo "<embed src=message_audio/".$audiobj["filename"]." />";
				echo "<br>".$filename;			
				echo "</a>&nbsp;&nbsp;";
				echo "</div>";
			}
		}
	}
?>
<p>
选中的声音将被删除</td></tr>
<tr  align=center class=b><td>上传新声音：</td><td><input type="file" name="upload_file1[]" size="58"  multiple ></td></tr>

<!--Changed Over-->

<tr  align=center class=b><td colspan="2" align="center"><input type="submit" value="确认编辑"></td></tr>
</form>
</table>
</table>
<?php
}
?>