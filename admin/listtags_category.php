<?php
include_once("checksession.php");
include("header.html");
include_once("../db.php");
?>


<br>
<META http-equiv=Content-Type content=text/html;charset=utf-8>


<form action="doaddtags_category.php" method=post name="form1">
<?php
if($_GET['tid']!='')
{




$query = "select * from taobao_category where tid='$_GET[tid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r2=mysql_fetch_array($result);

//echo $query;
//print_r($r2);
$aaa.='<a href="listtags_category.php?tid='.$r2['tid'].'">'.$r2['biaoti_cn'].'</a>--->';

//echo $aaa;

if($r2['parent_id']>0)
{
$query = "select * from taobao_category where tid='$r2[parent_id]'  ";
$result = mysql_db_query($DataBase, $query); 
$r3=mysql_fetch_array($result);
$bbb='<a href="listtags_category.php?tid='.$r3['tid'].'">'.$r3['biaoti_cn'].'</a>--->';
}

if($r3['parent_id']>0)
{
$query = "select * from taobao_category where tid='$r3[parent_id]'  ";
$result = mysql_db_query($DataBase, $query); 
$r4=mysql_fetch_array($result);
$ccc='<a href="listtags_category.php?tid='.$r4['tid'].'">'.$r4['biaoti_cn'].'</a>--->';
}

$ddd='<a href="listtags_category.php">一级分类</a>--->';







?>
<input type=hidden name=tid value=<?php echo $_GET['tid']; ?> >
<?php
}
?>
<table width=90% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

<tr>
  <td class=head colspan=7><b>添加一级分类</b></td>
</tr>
<tr align=center>
  <td class=b width=32%>分类名称:</td>
  <td colspan="3" class=b><input type=text name=biaoti size=100  ></td></tr>

<tr align=center>
  <td class=b width=32%> 分类淘宝ID号:</td>
  <td colspan="3" class=b><input type=text name=taobao_id size=100  ></td></tr>

 
</table></td></tr>
</table>
<br><center><input type='submit' value='提交'></center>
</form>







<form name=form3  method="GET" action="listtags_category.php" enctype="multipart/form-data">


<table width=98% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>
<tr>
  <td class=head colspan=5><b>淘宝分类查询</b></td>
</tr>   
     <tr align=center>
  <td class=b width=30%>分类ID号：</td>
  <td class=b><input name="taobao_id" type="text" size="100" value="" /></td>
</tr>


</table></td></tr></table>
<br><center><input type='submit' value='提交修改'></center></form>	

<table width=90% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

 
<tr align=center>
  <td class=b width=32%>当前位置:</td>
  <td colspan="3" class=b> <?php echo $ddd.$ccc.$bbb.$aaa; ?> </td></tr>
 
 
</table></td></tr>
</table>


















<?php






$t="1   ";









if($_GET[taobao_id]!='')
{
$t=$t."  and taobao_id='$_GET[taobao_id]' ";
}else
{







if($_GET[tid]!='')
{
$t=$t."  and parent_id='$_GET[tid]' ";
}else
{
$t=$t."  and  parent_id=0  ";
}





}



if($_GET[status]!='')
{
$t=$t."  and status='$_GET[status]' ";
}






$query = "select * from taobao_category    where $t    ";

//echo $query;
//echo $query;
$result = mysql_db_query($DataBase, $query); 

$amount=mysql_num_rows($result);

$page_size=40;

$pagecount=($amount/$page_size);


$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}
if($_GET[page]>$pagecount)
{$_GET[page]=$pagecount;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;
?>


 
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-weight:bold;">
  
    <tr><td style="height:28px;width:100%;"><font style="font-weight:bold;">&nbsp;&nbsp;&nbsp;
    共有<font id="red"><?php echo $amount; ?></font>条&nbsp;&nbsp;共有<font id="red"><?php echo $pagecount; ?></font>页&nbsp;&nbsp;<font id="red"><?php echo $page;?></font>/<?php echo $pagecount;?> </font>
    &nbsp;&nbsp;  <a href="?tid=<?php echo $_GET[tid]; ?>&page=1&operation=<?php echo $_GET[operation];?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" class="backs">[首页]</a>&nbsp;&nbsp;<?php $i=$_GET[page]-8;$j=$_GET[page]+15;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?tid=$_GET[tid]&page=$u&operation=$_GET[operation]&invoice=$_GET[invoice]&startdate=$_GET[startdate]&enddate=$_GET[enddate]&customer_name=$_GET[customer_name]&shipping_id=$_GET[shipping_id]&payment_gross=$_GET[payment_gross]&username=$_GET[username]&jufu_status=$_GET[jufu_status]>$u</a>";} ?>
    &nbsp;&nbsp;  <a href="?tid=<?php echo $_GET[tid]; ?>&page=<?php echo $pagecount;?>&operation=<?php echo $_GET[operation];?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" class="backs">[尾页]</a> <a href="?operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page-1);?>&&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" >上一页</a>   <a href="?operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page+1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">下一页</a></td></tr>
   
   
</table>


<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr><td class=head colspan=13><b>查看操作情况</b></td></tr>

<tr align="center" class="head_1">


<td><span class="STYLE1"> ID </span></td>
  <td><span class="STYLE1">淘宝ID </span></td>
<td><span class="STYLE1">淘宝分类名称 </span></td>
 <td><span class="STYLE1">中文名称 </span></td>
  <td><span class="STYLE1">子分类个数 </span></td>
  <td><span class="STYLE1">当前重量 </span></td>  
<td><span class="STYLE1">操作</span></td>
</tr>
                     
<?php


$query = "select * from taobao_category    where $t     order by tid   limit $a,$page_size ";
$result = mysql_db_query($DataBase, $query);



while ($r=mysql_fetch_array($result)) {


?>
<tr align=center class=b>

<td >

<?php echo $r[tid]; ?></td>
<td  >  <?php echo $r[taobao_id]; ?>  </td>
<td  > <?php echo $r[biaoti]; ?>   </td>
<td  > <?php echo $r[biaoti_cn]; ?> </td>
<td  > <?php echo $r[sub_category]; ?>  </td>
<td  > <?php echo $r[weight]; ?> </td>
 
<td>
 
 
<a href="listtags_category.php?tid=<?php echo $r[tid];?>" class="button"  > 查看下级分类</a>&nbsp;&nbsp;


 
<a href="edittags_category.php?tid=<?php echo $r[tid];?>" class="button"  > 修改</a>

<a href="edittags_category.php?tid=<?php echo $r[tid];?>" class="button"  > 设为首页一级分类</a>
<a href="edittags_category.php?tid=<?php echo $r[tid];?>" class="button"  > 设为首页二级分类</a>
</td>
</tr>






<?php
}

mysql_free_result($result);




?>
</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-weight:bold;">
  
    <tr><td style="height:28px;width:100%;"><font style="font-weight:bold;">&nbsp;&nbsp;&nbsp;
    共有<font id="red"><?php echo $amount; ?></font>条&nbsp;&nbsp;共有<font id="red"><?php echo $pagecount; ?></font>页&nbsp;&nbsp;<font id="red"><?php echo $page;?></font>/<?php echo $pagecount;?> </font>
    &nbsp;&nbsp;  <a href="?tid=<?php echo $_GET[tid]; ?>&page=1&operation=<?php echo $_GET[operation];?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" class="backs">[首页]</a>&nbsp;&nbsp;<?php $i=$_GET[page]-8;$j=$_GET[page]+15;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?tid=$_GET[tid]&page=$u&operation=$_GET[operation]&invoice=$_GET[invoice]&startdate=$_GET[startdate]&enddate=$_GET[enddate]&customer_name=$_GET[customer_name]&shipping_id=$_GET[shipping_id]&payment_gross=$_GET[payment_gross]&username=$_GET[username]&jufu_status=$_GET[jufu_status]>$u</a>";} ?>
    &nbsp;&nbsp;  <a href="?tid=<?php echo $_GET[tid]; ?>&page=<?php echo $pagecount;?>&operation=<?php echo $_GET[operation];?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" class="backs">[尾页]</a> <a href="?operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page-1);?>&&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" >上一页</a>   <a href="?operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page+1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">下一页</a></td></tr>
   
   
</table>









<?php include("bottom.html"); ?>
