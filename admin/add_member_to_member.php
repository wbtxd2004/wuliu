<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>
<script language=javascript>
window.onload = function()
{
	if (!window.applicationCache)
	{
		alert("你的浏览器不支持HTML5");
	}
}
	function check()
	{
		
		obj1=document.f.biaoti;
		obj2=document.f.info;
		file_num=document.f["upload_file[]"].files.length;
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

<table width=70% align=center cellspacing=1 cellpadding=3 class=i_table>
<form action="doadd_member_to_member.php" method=post name="f" onsubmit="return check()" enctype="multipart/form-data">
<tr class=b>
  <td class=head colspan=2><b>创建私信</b></td>
</tr>
<tr align=center class=b><td>收件人ID：</td><td><input type="text" name="member_id" size=58></td></tr>
<tr align=center class=b><td>私信标题：</td><td><input type="text" name="biaoti" size=58></td></tr>
<tr  align=center class=b><td>私信内容：</td><td><textarea rows=5 cols=50 name="info"></textarea>
</td></tr>
            <tr align=center class=b> 
              <td>图片文件：</td>
              <td> 
                <input type="file" name="upload_file[]" multiple="multiple">
              </td>
            </tr>
  <tr align=center class=b> 
              <td>声音文件：</td>
              <td> 
                <input type="file" name="upload_file1[]" multiple="multiple">
              </td>
            </tr>
<tr  align=center class=b><td colspan="2" align="center"><input type="submit" value="确认添加"></td></tr>
</form>
</table>
<?php include("bottom.html"); ?>
