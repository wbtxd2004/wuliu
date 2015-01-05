

<?php
include_once("checksession.php");
include("header.html");
include_once("../db.php");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<?php
if(!$_GET['tid']){
  echo "传入id错误<p>";
  echo "点击<a href=listask.php>这里</a>返回";
  exit();
}

$tid = $_GET['tid'] ;
?>
<script language=javascript>
	function check(){
		obj1=document.f.info;
		if(obj1.value==""){
			alert("评论内容不能为空！");
			obj1.focus();
			return false;
		}
		return true;
	}
</script>
<form action="doeditasks_reply.php" method=post name="f" onsubmit="return check()"  enctype="multipart/form-data">

<?php


$query = "select * from ask_reply where tid='$_GET[tid]' ";
$result = mysql_db_query($DataBase, $query);
$row=mysql_fetch_array($result);
?>




<table width=70% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

<tr>
  <td class=head colspan=7><b>编辑评论：</b></td>
</tr>


<tr align=center>
  <td class=b width=29%>问答ID:</td>
  <td colspan="3" class=b><? echo $row[asks_id]?></td>
</tr>

  <tr align=center>
  <td class=b width=29%>评论者ID:</td>
  <td colspan="3" class=b>
  <input type="text" name="member_id" value="<?php echo $row[member_id] ?>" />
  </td>
  </tr>  

  <tr align=center>
  <td class=b width=29%>评论内容:</td>
  <td colspan="3" class=b>
  	<textarea cols="50" rows="10" name="info" ><?php echo $row[info] ?></textarea>
  </td>
  </tr>


<tr  align=center class=b><td>已有图片：</td><td>
<?php
$sql="select * from ask_reply_images where ask_reply_id='$tid' and filetype='0' ";
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
        echo "<a href=ask_reply_images/big/".$obj["filename"]." target=_blank>";
        echo "<img src=ask_reply_images/small/".$obj["filename"]." style=\"max-height: 175px; max-width: 175px;\">";
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
$sql="select * from ask_reply_images where ask_reply_id='$tid' and filetype='1'";
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
        echo "<a href=ask_reply_audio/".$audiobj["filename"]." target=_blank>";
        echo "<embed src=ask_reply_audio/".$audiobj["filename"]." />";
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




<tr  align=center class=b>
	<td colspan="2" align="center">
		<input type="submit" value="确认编辑">
	</td>
</tr>

<input type="hidden" value="<?php echo $_GET['asks_id'];  ?>" name="asks_id"  />
<input type="hidden" value="<?php echo $row['tid'];  ?>" name="tid"  />
</form>

</table>

</td>
</tr>
</table>


		
<?php include("bottom.html"); ?>