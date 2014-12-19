<?php

include("checksession.php");
include_once("../db.php");


$query = "select * from news where tid='$_GET[tid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r=mysql_fetch_array($result);
	$query5 = "select * from member   where  tid  ='$r[member_id]' ";
	  $result5= mysql_db_query($DataBase,$query5);
	  $r5 = mysql_fetch_array($result5);
  print_r($r5);
	
	$query3 = "select * from new_class   where tid='$r[cid]' ";
	  $result3= mysql_db_query($DataBase,$query3);
	  $r3 = mysql_fetch_array($result3);
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
<?php include("header.html"); ?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

 <table width=98% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>
<tr>
  <td class=head colspan=5><b>查看新闻评论</b></td>
</tr>



<tr align=center><td class=b width=30%> 标题:</td>
<td colspan="3" class=b><input name="biaoti" type="text" size="100" value="<?php echo $r["biaoti"];  ?>" /></td></tr>



<tr align=center><td class=b width=30%>发布者:</td>
<td colspan="3" class=b><input name="admin_id" type="text" size="100" value="<?php echo $r["admin_id"];  ?>" /></td></tr>


<tr align=center><td class=b width=30%>所属单位:</td>
<td colspan="3" class=b><input name="danwei_id" type="text" size="100" value="<?php echo $r["danwei_id"];  ?>" /></td></tr>

<tr align=center><td class=b width=30%>新闻类别:</td>
<td colspan="3" class=b><input name="cid" type="text" size="100" value="<?php echo $r["cid"];  ?>" /></td></tr>
<tr align=center><td class=b width=30%>新闻内容:</td>
<td colspan="3" class=b><input name="info" type="text" size="100" value="<?php echo $r["info"];  ?>" /></td></tr>
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

</table></td></tr></table>
<br><center>
</center> 		
	<form action="doaddnews_reply.php" method=post name="form1">

<table width=70% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

<tr>
  <td class=head colspan=7><b>添加评论：</b></td>
</tr>

<tr align=center>
  <td class=b width=29%>&nbsp;</td>
  <td colspan="3" class=b>&nbsp;</td></tr>


<!-- 发布者 -->
   
<!-- 发布者 -->

<?php
      


?>
  <?php  echo $_GET[tid]; ?>
  <tr align=center>
  <td class=b width=29%>&nbsp;</td>
  <td colspan="3" class=b>&nbsp;</td></tr>
  
    <tr align=center>
  <td class=b width=29%>评论内容:</td>
  <td colspan="3" class=b>
  <input type="hidden" value="<?php echo $_GET['tid'];  ?>" name="tid"  />
  <textarea cols="50" rows="10" name="info" ></textarea>  </td></tr>
</table></td></tr>

</table>
<br><center><input type='submit' value='提交'></center></form>		





















<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=10><b>新闻评论列表修改管理</b></td>
</tr>
<tr align="center" class="head_1">
<td>ID</td>
<td> 标题</td>

<td>发布者</td>

<td>所属单位</td>
<td>新闻类别</td>
<td>新闻评论内容</td>
<td>ip记录</td>
<td>添加的时间</td>

<td>操作</td>
</tr>
                     
<?php

 





$query1 = "select * from news_reply    where  news_id='$_GET[tid]'     order by tid desc  ";

$result1 = mysql_db_query($DataBase, $query1);

$query6 = "select * from news where tid='$_GET[tid]'  ";
$result6 = mysql_db_query($DataBase, $query6); 
$r6=mysql_fetch_array($result6);


$query8 = "select * from member where tid='$r[member_id]'  ";
$result8 = mysql_db_query($DataBase, $query8); 
$r8=mysql_fetch_array($result8);

while ($r2=mysql_fetch_array($result1)) {
	
?>
<tr align=center class=b>
<td><?php echo $r2[tid]; ?></td>
<!--<td>&nbsp; </td>
-->
<td><?php   echo $r6[biaoti];?></td>
<td><?php   echo $r5[username];?></td>
<td><?php   echo $r1[name];?></td>

<td><?php  echo $r3[name]; ?></td>
<td><?php  echo $r2[info]; ?></td>
<td><?php   echo $r2[ip];?></td>
<td><?php   echo $r2[dtime];?></td>
<td>
<a href=editnews_reply.php?tid=<?php echo $r2[tid]; ?>>编辑审核</a>
<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="delnews_reply.php?tid=<?php echo $r2[tid];?>" class="button"  >删除</a>
</td></tr>




<?php


}

mysql_free_result($result);




?>



</table>






		
		<?php include("bottom.html"); ?>					
