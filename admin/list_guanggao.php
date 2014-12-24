<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<center>
<?php
include_once("../db.php");
echo "<p>";

$query = "select * from guanggao";
$result = mysql_db_query($DataBase, $query); 

$amount=mysql_num_rows($result);


//print_r($num);
echo "当前广告共有".$amount."条结果";
echo "<p>";
echo "<a href='add_guanggao.php'>添加广告</a>&nbsp;&nbsp;";





$page_size=10;

$pagecount=($amount/$page_size);


$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;











$query = "select * from guanggao order by tid    limit $a,$page_size ";
$result = mysql_db_query($DataBase, $query);







?>
<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=8><b>广告列表</b></td>
</tr>
<tr align="center" class="head_1">
<td>ID</td>
<td>标题</td>
<td>内容</td>
<td>IP地址</td>
<td>添加时间</td>
<td>编辑</td>
<td>删除</td>
<td>广告打开/隐藏</td>
</tr>
<?php

while($row=mysql_fetch_array($result))
{
	echo "<tr  align=center class=b>";
	echo "<td>".$row["tid"]."</td>";
	echo "<td>".$row["biaoti"]."</td>";
	echo "<td>".$row["info"]."</td>";
	echo "<td>".$row["ip"]."</td>";
	echo "<td>".$row["dtime"]."</td>";
	echo "<td><a href='edit_guanggao.php?tid=".$row["tid"]."'>编辑</a></td>";
	echo "<td>";
?>
	<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="del_guanggao.php?tid=<?php echo $row["tid"];?>" class="button"  >删除</a>
	<?php echo "</td>";


	if($row["status"]==0){
	echo "<td>";
	?>
	<a onClick="if(confirm('您确定关闭吗?')) {return true;}else{return false;}" href='hide_guanggao.php?status=<?php echo $row["status"];?>&tid=<?php echo $row["tid"];?>'>状态打开：点击关闭</a>
	<?php echo "</td>\n";}
	if($row["status"]==1){
	echo "<td>";
	?>
	<a onClick="if(confirm('您确定打开吗?')) {return true;}else{return false;}"
	href='hide_guanggao.php?status=<?php echo $row["status"];?>&tid=<?php echo $row["tid"];?>'>状态关闭：点击打开</a>
	<?php echo "</td>\n";}
	echo "</tr>";	
}
echo "</table>\n";
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-weight:bold;">
  
    <tr><td style="height:28px;width:100%;"><font style="font-weight:bold;">&nbsp;&nbsp;&nbsp;
    共有<font id="red"><?php echo $amount; ?></font>条&nbsp;&nbsp;共有<font id="red"><?php echo $pagecount; ?></font>页&nbsp;&nbsp;<font id="red"><?php echo $page;?></font>/<?php echo $pagecount;?> </font>
    &nbsp;&nbsp;  <a href="?page=1" class="backs">[首页]</a>&nbsp;&nbsp;<?php $i=$_GET[page]-4;$j=$_GET[page]+4;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?page=$u>$u</a>";} ?>
    &nbsp;&nbsp;  <a href="?page=<?php echo $pagecount;?>" class="backs">[尾页]</a>
	<a href="?sorting=<?php echo $orderBy ?>&desc=<?php echo $desc ?>&page=<?php echo($page-1);?>">上一页</a>
	<a href="?sorting=<?php echo $orderBy ?>&desc=<?php echo $desc ?>&page=<?php echo($page+1);?>">下一页</a>
	</td></tr>
   
   
</table>

<?php include("bottom.html"); ?>