<?php
include("header.html"); 
include("checksession.php");
include_once("../db.php");


$query = "select * from asks where tid='$_GET[tid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r=mysql_fetch_array($result);

	/*$query5 = "select * from member where  tid  ='$r[member_id]' ";
	  $result5= mysql_db_query($DataBase,$query5);
	  $r5 = mysql_fetch_array($result5);
  print_r($r5);
	
	$query3 = "select * from new_class   where tid='$r[cid]' ";
	  $result3= mysql_db_query($DataBase,$query3);
	  $r3 = mysql_fetch_array($result3);*/
/*
$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);
if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}
*/
?>

<META http-equiv=Content-Type content=text/html;charset=utf-8>

 <table width=98% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>
<tr>
  <td class=head colspan=5><b>问答资料</b></td>
</tr>
<tr align=center>
    <td class=b width=30%> ID:</td>
    <td colspan="3" class=b><?php echo $r["tid"];  ?></td>
</tr>
<tr align=center>
    <td class=b width=30%> 问题的标题:</td>
    <td colspan="3" class=b><?php echo $r["biaoti"];  ?></td>
</tr>
<tr align=center>
    <td class=b width=30%>栏目名称:</td>
    <td colspan="3" class=b>
    <?php
        $sql="select name from ask_class where tid=$r[cid]";
        $result2=mysql_db_query($DataBase,$sql);
        $r2=mysql_fetch_array($result2);
        echo $r2[name];
    ?>
    </td>
</tr >

<tr align=center>
 <td class=b width=30%>悬赏值</td>
    <td colspan="3" class=b>
		 <?php
		 $sql="select shang from asks where tid=$r[tid]";
        $result2=mysql_db_query($DataBase,$sql);
        $r2=mysql_fetch_array($result2);
		
        echo $r2[shang];?>
</td>
</tr>


<tr align=center>
    <td class=b width=30%>发问者:</td>
    <td colspan="3" class=b>
    <?php
        $sql="SELECT username FROM member WHERE tid = '$r[member_id]'";
        $result2=mysql_db_query($DataBase,$sql);
        $r2=mysql_fetch_array($result2);
        echo $r2[username];
    ?>
    </td>
</tr>
<tr align=center>
    <td class=b width=30%>单位名称:</td>
    <td colspan="3" class=b>
    <?php
        $sql="select name from danwei where tid=$r[danwei_id]";
        $result2=mysql_db_query($DataBase,$sql);
        $r2=mysql_fetch_array($result2);
        echo $r2[name];
    ?>
    </td>
</tr>
<tr align=center>
    <td class=b width=30%>问题内容:</td>
    <td colspan="3" class=b><?php echo $r["info"];  ?></td>
</tr>
<tr align=center>
    <td class=b width=30%>上传的图片:</td>
    <td class=b>
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
        
        echo "<a href=ask_images/big/".$obj["filename"]." target=_blank>";
        echo "<img src=ask_images/small/".$obj["filename"].">";
        echo "</br>".$filename;
        echo "</a>&nbsp;&nbsp;";
        echo "</div>";
      }
    }
  }

?>
	
	
	
	
	</td>
</tr>
<tr align=center>
    <td class=b width=30%>上传的声音:</td>
    <td  class=b>
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
        echo "<a href=ask_audio/".$audiobj["filename"]." target=_blank>";
        echo "<embed src=ask_audio/".$audiobj["filename"]." />";
        echo "<br>".$filename;      
        echo "</a>&nbsp;&nbsp;";
        echo "</div>";
      }
    }
  }
?>
	
	
	
	
	
	</td>
</tr>
</table>
</td>
</tr>
</table>
<br>	

<?php


$query2 = "select * from ask_reply where asks_id='$_GET[tid]'  order by tid desc";
$result2 = mysql_db_query($DataBase, $query2);
$amount = mysql_num_rows($result2);
?>

<p>
<center>
当前问答评论列共有 <?php echo $amount ?>条结果
<br><br>
<a href='addasks_reply.php?asks_id=<?php echo $_GET[tid]; ?>'>添加评论</a><br><br>
</center>
</p>

<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=10><b>问答评论列表修改管理</b></td>
</tr>
<tr align="center" class="head_1">
<td>ID</td>
<td>评论者</td>
<td>所属单位</td>
<td>评论内容</td>
<td>ip记录</td>
<td>添加的时间</td>
<td>操作</td>
</tr>

<?php

while ($r2=mysql_fetch_array($result2)) {
	
?>
<tr align=center class=b>
<td><?php echo $r2[tid]; ?></td>
<td>
    <?php
        $sql="SELECT username FROM member WHERE tid = '$r2[member_id]'";
        $result3=mysql_db_query($DataBase,$sql);
        $r3=mysql_fetch_array($result3);
        echo $r3[username];
    ?>
</td>
<td>

</td>
<td><?php  echo $r2[info]; ?></td>
<td><?php   echo $r2[ip];?></td>
<td><?php   echo $r2[dtime];?></td>
<td>
<a href=editasks_reply.php?tid=<?php echo $r2[tid]; ?>&asks_id=<?php echo $r[tid]; ?>>编辑审核</a>
<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  
href="delasks_reply.php?tid=<?php echo $r2[tid];?>&asks_id=<?php echo $r[tid]; ?>" class="button"  >
删除
</a>
</td>
</tr>


<?php } ?>

</table>
<?php
mysql_free_result($result);
mysql_free_result($result2);
?>
<?php include("bottom.html"); ?>