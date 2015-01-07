<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<?php
include_once("../db.php");




$query = "select * from asks      ";

$result = mysql_db_query($DataBase, $query); 

$amount=mysql_num_rows($result);

echo "<p>";
echo "<center>";
echo "当前私信共有".$amount."条结果";
echo "<br><br>";
echo "<a href='addask.php'>添加问答</a>&nbsp;&nbsp;";
echo "</center>";
echo "</p>";


$page_size=10;

$pagecount=($amount/$page_size);


$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;


$query1 = "select * from beian_manage where tid = '$r[admin_id]' ";
$result1=mysql_db_query($DataBase, $query1);
while ($r1=mysql_fetch_array($result1)) {}



$t="1";
if($_GET[keywords]!='')
{
$t=$t."  and biaoti like '%$_GET[keywords]%' ";
}

$query = "select * from asks WHERE $t order by tid   limit $a,$page_size ";

$result = mysql_db_query($DataBase, $query);

?>

<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=10><b>问答列表修改管理</b></td>
</tr>
<tr align="center" class="head_1">
<td>ID</td>
<td> 标题</td>


<td>问答类别</td>
<td>问答内容</td>
<td>ip记录</td>
<td>添加的时间</td>

<td>图片</td>
<td>声音</td>

<td>操作</td>
</tr>
                     
<?php

while ($r=mysql_fetch_array($result)) {
?>
<tr align=center class=b>
<td><?php echo $r[tid]; ?></td>
<td><?php echo $r[biaoti]; ?></td>

<td><?php echo $r[cid];?></td>

<td><?php echo $r[info]; ?></td>
<td><?php echo $r[ip];?></td>
<td><?php echo $r[dtime];?></td>
<td>
<?php
$sql="select filename from ask_images where ask_id=$r[tid] and filetype='0'";
$roo=mysql_db_query($DataBase,$sql);
$n=mysql_num_rows($roo);
if($n==0) echo "无";
else
{
	while($obj=mysql_fetch_array($roo))
	{
		echo "<a href=ask_images/big/".$obj["filename"]." target=_blank style='display:block'>";
		echo "{$obj["filename"]}";
		echo "</a>";
	}
}


echo "</td>";

##########在列表添加声音文件名显示， By WuBin in 20141214#########
echo "<td>";
$queryaudio="select filename from ask_images where ask_id=$r[tid] and filetype='1'";
$raudio=mysql_db_query($DataBase,$queryaudio);
$naudio=mysql_num_rows($raudio);
if($naudio==0) echo "无";
else
{
	while($audiobj=mysql_fetch_array($raudio))
	{
		echo "<a href=ask_audio/".$audiobj["filename"]." target=_blank style='display:block'>";
		echo "{$audiobj["filename"]}";
		echo "</a>";

	}
}
?>


<td>
<a href=editask.php?tid=<?php echo $r[tid]; ?>>编辑审核</a>
<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="delask.php?tid=<?php echo $r[tid];?>" class="button"  >删除</a>
<a href=viewasks.php?tid=<?php echo $r[tid]; ?>>查看问答</a>
</td>
</tr>

<?php


}

mysql_free_result($result)

?>


</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-weight:bold;">
  
    <tr><td style="height:28px;width:100%;"><font style="font-weight:bold;">&nbsp;&nbsp;&nbsp;
    共有<font id="red"><?php echo $amount; ?></font>条&nbsp;&nbsp;共有<font id="red"><?php echo $pagecount; ?></font>页&nbsp;&nbsp;<font id="red"><?php echo $page;?></font>/<?php echo $pagecount;?> </font>
    &nbsp;&nbsp;  <a href="?page=1" class="backs">[首页]</a>&nbsp;&nbsp;<?php $i=$_GET[page]-4;$j=$_GET[page]+4;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?page=$u>$u</a>";} ?>
    &nbsp;&nbsp;  <a href="?page=<?php echo $pagecount;?>" class="backs">[尾页]</a>
	<a href="?tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page-1);?>&&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" >上一页</a>   <a href="?tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page+1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">下一页</a>
    </td></tr>
   
</table>
<?php include("bottom.html"); ?>