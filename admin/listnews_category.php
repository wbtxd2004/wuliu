<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>
    <?php
	
include_once("../db.php");

if($_GET['tid']!='')
{




$query = "select * from new_class where tid='$_GET[tid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r2=mysql_fetch_array($result);
//echo '未执行时显示aaa='.$aaa;
//echo $query;

$aaa.='<a href="listnews_category.php?tid='.$r2['tid'].'">'.$r2['name'].'</a>--->';
//echo  '执行后时显示aaa='.$aaa;


if($r2['cid']>0)
{
$query = "select * from new_class where tid='$r2[cid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r3=mysql_fetch_array($result);
echo '<br/>';

$bbb='<a href="listnews_category.php?tid='.$r3['tid'].'">'.$r3['name'].'</a>--->';
}

if($r3['cid']>0)
{
$query = "select * from new_class where tid='$r3[cid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r4=mysql_fetch_array($result);
$ccc='<a href="listnewss_category.php?tid='.$r4['tid'].'">'.$r4['name'].'</a>--->';
}

$ddd='<a href="listnews_category.php">一级分类</a>--->';







?>
<input type=hidden name=tid value=<?php echo $_GET['tid']; ?> >
<?php
}
?>
<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>

  <tr align=center>
  <td class=b width=32%>当前位置:</td>
  <td colspan="3" class=b> <?php echo $ddd.$ccc.$bbb.$aaa; ?> </td></tr>
<tr>
  <td class=head colspan=10><b>新闻分类列表修改管理</b></td>
</tr>

</table>

<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>


<tr align="center" class="head_1">
<td>id</td>
<td>子分类个数</td>
<td>上级分类ID</td>
<td>新闻分类名</td>
<td>操作</td>


 

  
	      
	              
<?php





$t="1   ";








 




if($_GET[tid]!='')
{
$t=$t."  and cid='$_GET[tid]' ";
}else
{
$t=$t."  and  cid='0'  ";
}



 



$query = "select * from new_class     where $t      ";
$result = mysql_db_query($DataBase, $query); 

$amount=mysql_num_rows($result);

$page_size=20;


$pagecount=($amount/$page_size);


$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}
if($_GET[page]>$pagecount)
{$_GET[page]=$pagecount;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;











$query = "select * from new_class  where $t    order by tid desc   limit $a,$page_size   ";
$result = mysql_db_query($DataBase, $query);



while ($r=mysql_fetch_array($result)) {




$query = "select * from new_class     where cid='$r[tid]'      ";
$result2 = mysql_db_query($DataBase, $query); 

$amount2=mysql_num_rows($result2);



?>
<tr align=center class=b>


<td><?php echo $r[tid]; ?></td>

<td><?php echo $amount2; ?></td>


<td><?php echo $r[cid]; ?></td>
<td><?php   echo $r[name];?></td>

<td>
<a href=editnews_category.php?tid=<?php echo $r[tid]; ?>>编辑审核</a>


<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="delnews_category.php?tid=<?php echo $r[tid];?>" class="button"  >删除</a>
<a href=listnews_category.php?tid=<?php echo $r[tid]; ?>>查看下级分类</a>
<a href="addnews_category.php?tid=<?php echo $r[tid]; ?>">添加子分类</a>
</td></tr>




<?php


}

mysql_free_result($result) ;




?>



</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-weight:bold;">
  
    <tr><td style="height:28px;width:100%;"><font style="font-weight:bold;">&nbsp;&nbsp;&nbsp;
    共有<font id="red"><?php echo $amount; ?></font>条&nbsp;&nbsp;共有<font id="red"><?php echo $pagecount; ?></font>页&nbsp;&nbsp;<font id="red"><?php echo $page;?></font>/<?php echo $pagecount;?> </font>
    &nbsp;&nbsp;  <a href="?tid=<?php echo $_GET[tid]; ?>&page=1&operation=<?php echo $_GET[operation];?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" class="backs">[首页]</a>&nbsp;&nbsp;<?php $i=$_GET[page]-8;$j=$_GET[page]+15;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?tid=$_GET[tid]&page=$u&operation=$_GET[operation]&invoice=$_GET[invoice]&startdate=$_GET[startdate]&enddate=$_GET[enddate]&customer_name=$_GET[customer_name]&shipping_id=$_GET[shipping_id]&payment_gross=$_GET[payment_gross]&username=$_GET[username]&jufu_status=$_GET[jufu_status]>$u</a>";} ?>
    &nbsp;&nbsp;  <a href="?tid=<?php echo $_GET[tid]; ?>&page=<?php echo $pagecount;?>&operation=<?php echo $_GET[operation];?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" class="backs">[尾页]</a> <a href="?operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page-1);?>&&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" >上一页</a>   <a href="?operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page+1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">下一页</a></td></tr>
   
   
</table>
<?php include("bottom.html"); ?>