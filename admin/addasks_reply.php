
<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<?php
if(!$_GET['asks_id']){
  echo "传入id错误<p>";
  echo "点击<a href=listask.php>这里</a>返回";
}
?>

<form action="doaddasks_reply.php" method=post name="form1" enctype="multipart/form-data">

<table width=70% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

<tr>
  <td class=head colspan=7><b>添加评论：</b></td>
</tr>

<tr align=center>
  <td class=b width=29%>问答ID:</td>
  <td colspan="3" class=b><? echo $_GET[asks_id]?></td></tr>

  <tr align=center>
  <td class=b width=29%>评论内容:</td>
  <td colspan="3" class=b>
  <textarea cols="50" rows="10" name="info" ></textarea>  
  </td></tr>

<tr  align=center class=b><td>上传图片：</td><td><input type="file" name="upload_file[]" size="58"  multiple ></td></tr>
<tr  align=center class=b><td>上传声音：</td><td><input type="file" name="upload_file1[]" size="58"  multiple ></td></tr>


</table></td></tr>

</table>
<br><center><input type='submit' value='提交'></center>

<input type="hidden" value="<?php echo $_GET['asks_id'];  ?>" name="asks_id"  />
</form>		

<?php include("bottom.html"); ?>