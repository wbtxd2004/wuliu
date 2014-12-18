<?php

include("checksession.php");
//include("header.html");

include_once("../db.php");


if(!$_GET["tid"])
{
  echo "传入id错误<p>";
  echo "点击<a href=list_admin_message.php>这里</a>查看私信";
  exit();
}

$query = "select * from asks where tid='$_GET[tid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r=mysql_fetch_array($result);


$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);
if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}
?>
<?php include("header.html"); ?>

<META http-equiv=Content-Type content=text/html;charset=utf-8>

 

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

<form name="f"  method="POST" action="doeditask.php?tid=<?php echo $r[tid]; ?>" onsubmit="return check()" enctype="multipart/form-data">
<table width=98% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>
<tr><td class=head colspan=5><b>编辑问答</b></td></tr>



<tr align=center><td class=b width=30%> 标题:</td>
<td colspan="3" class=b><input name="biaoti" type="text" size="100" value="<?php echo $r["biaoti"];  ?>" /></td></tr>



<tr align=center><td class=b width=30%>发布者:</td>
<td colspan="3" class=b><input name="member_id" type="text" size="100" value="<?php echo $r["member_id"];  ?>" /></td></tr>


<tr align=center><td class=b width=30%>所属单位:</td>
<td colspan="3" class=b><input name="danwei_id" type="text" size="100" value="<?php echo $r["danwei_id"];  ?>" /></td></tr>

<tr align=center><td class=b width=30%>问答类别:</td>
<td colspan="3" class=b><input name="cid" type="text" size="100" value="<?php echo $r["cid"];  ?>" /></td></tr>
<tr align=center><td class=b width=30%>问答内容:</td>
<td colspan="3" class=b><input name="info" type="text" size="100" value="<?php echo $r["info"];  ?>" /></td></tr>


<tr  align=center class=b><td>已有图片：</td><td>
<?php
$sql="select * from ask_images where ask_id='$_GET[tid]' and filetype='0' ";
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
        echo "<div style='float:center'>";
        echo "<input type='checkbox' name='checkimg[]' value='".$obj["tid"]."'>";
        echo "<a href=ask_images/big/".$obj["filename"]." target=_blank>";
        echo "<img src=ask_images/small/".$obj["filename"].">";
        echo "</br>".$filename;
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
$sql="select * from ask_images where ask_id='$_GET[tid]' and filetype='1'";
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
        echo "<div style='float:center'>";      
        echo "<input type='checkbox' name='checkaudio[]' value='".$audiobj["tid"]."'>";
        echo "<a href=ask_audio/".$audiobj["filename"]." target=_blank>";
        echo "<embed src=ask_audio/".$audiobj["filename"]." />";
        echo "<br>".$filename;      
        echo "</a>&nbsp;&nbsp;";
        echo "</div>";
      }
    }
  }
?>

<p>
选中的声音将被删除</td></tr>
<tr  align=center class=b><td>上传新声音：</td><td>

<input type="file" name="upload_file1[]" size="58"  multiple ></td></tr>

<!--Changed Over-->

</table></td></tr></table>
<br><center><input type='submit' value='提交修改'></center></form>		
					
		<?php include("bottom.html"); ?>					
