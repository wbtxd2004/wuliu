<?php

include("checksession.php");
include_once("../db.php");
$query = "select * from news where tid='$_GET[tid]'  ";
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

<script>

function check(){
    
    obj1=document.form1.biaoti;
    obj2=document.form1.info;
    file_num=document.form1["upload_file[]"].files.length;
    if(obj1.value=="")
    {
        alert("标题不能为空！");
        obj1.focus();
        return false;
    }
    else if(obj2.value=="")
    {
        alert("文章内容不能为空！");
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


<form name=form1  method="POST" action="doeditnews.php?tid=<?php echo $r[tid];?>"  onsubmit="return check()" enctype="multipart/form-data">
<table width=98% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>
<tr><td class=head colspan=5><b>编辑新闻</b></td></tr>



<tr align=center><td class=b width=30%> 标题:</td>
<td colspan="3" class=b><input name="biaoti" type="text" size="100" value="<?php echo $r["biaoti"];  ?>" /></td></tr>



<tr align=center><td class=b width=30%>发布者:</td>
<td colspan="3" class=b><input name="admin_id" type="text" size="100" value="<?php echo $r["admin_id"];  ?>" /></td></tr>


<tr align=center><td class=b width=30%>所属单位:</td>
<td colspan="3" class=b><input name="danwei_id" type="text" size="100" value="<?php echo $r["danwei_id"];  ?>" /></td></tr>

<tr align=center><td class=b width=30%>新闻类别:</td>

<td colspan="3" class=b>

<select name=cid>
<?php

$query = "select * from new_class  where cid=0  order by tid ";

$result = mysql_db_query($DataBase, $query); 

while ($r2 = mysql_fetch_array($result)) 
{
    $selected ='';
    if($r[cid] == $r2[tid]){
      $selected ='selected="selected"';
    }
    echo"<option value=$r2[tid] $selected>A $r2[name]</option>";


    $query = "select * from new_class  where cid='$r2[tid]'  order by tid  ";

    $result2 = mysql_db_query($DataBase, $query); 

    while ($r3 = mysql_fetch_array($result2)) 
    {

        $selected ='';
        if($r[cid] == $r3[tid]){
          $selected ='selected="selected"';
        }
        echo"<option value=$r3[tid] $selected>&nbsp;&nbsp;&nbsp;&nbsp;B  $r3[name]</option>";
           $query = "select * from new_class  where cid='$r3[tid]'  order by tid  ";

        $result2 = mysql_db_query($DataBase, $query); 

        while ($r4 = mysql_fetch_array($result2)) 
        {
          $selected ='';
          if($r[cid] == $r4[tid]){
            $selected ='selected="selected"';
          }
          echo"<option value=$r4[tid] $selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C  $r4[name]</option>";

        }

    }

}
?>
</select>

</td></tr>


<tr align=center><td class=b width=30%>新闻内容:</td>
<td colspan="3" class=b><textarea cols="50" rows="10" name="info" ><?php echo $r["info"];  ?></textarea></td></tr>
<!--<tr align=center>
  <td class=b width=29%>选择权限:</td>
  <td width="12%" align="center" class=b></td>
  <td width="31%" align="right" class=b>
   <input type=radio value=1  <?php if($r[states]==1) { ?> checked="checked" <?php } ?>
                  name=states>
   超级管理员  
   <input type=radio value=2  <?php if($r[states]==2) { ?>checked="checked" <?php } ?>
                  name=states>一般管理员
    <br />
    
	</td>
  <td width="28%" align="center" class=b>&nbsp;</td>
</tr>-->
<tr  align=center class=b><td>已有图片：</td><td>
<?php
$sql="select * from news_images where nid='$_GET[tid]' and filetype='0' ";
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
        echo "<a href=news_images/big/".$obj["filename"]." target=_blank>";
        echo "<img src=news_images/small/".$obj["filename"].">";
        echo "<br>".$filename;
        echo "</a>&nbsp;&nbsp;";
        echo "</div>";
      }
    }
  }
?>
<p style="clear:both">
选中的图片将被删除</td></tr>
<tr  align=center class=b><td>上传新图：</td><td><input type="file" name="upload_file[]" size="58"  multiple ></td></tr>




</table></td></tr></table>
<br><center><input type='submit' value='确认编辑'></center></form>		
					
		<?php include("bottom.html"); ?>					
