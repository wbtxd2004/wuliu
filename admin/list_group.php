<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<center>
<?php
include_once("../db.php");
echo "<p>";

$query = "select * from tongxun_group";
$result = mysql_db_query($DataBase, $query); 

$amount=mysql_num_rows($result);


//print_r($num);
echo "当前通讯录群组共有".$amount."条结果";
echo "<p>";
echo "<a href='add_group.php'>添加群组</a>&nbsp;&nbsp;";





$page_size=10;

$pagecount=($amount/$page_size);


$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;











$query = "select * from tongxun_group order by tid    limit $a,$page_size ";
$result = mysql_db_query($DataBase, $query);







?>
<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=5><b>通讯录群组列表</b></td>
</tr>
<tr align="center" class="head_1">
<td>ID</td>
<td>群组名称</td>
<td>群发短信</td>

<td>编辑</td>
<td>删除</td>
</tr>
<?php


while($row=mysql_fetch_array($result))
{
	echo "<tr  align=center class=b>";
	echo "<td>".$row["tid"]."</td>";
	echo "<td>".$row["name"]."</td>";
	echo "<td><a href=send_message.php?id=".$row["tid"].">群发短信</a></td>";
	echo "<td><a href='edit_group.php?tid=".$row["tid"]."'>编辑</a></td>";
	echo "<td>";
	?>
	<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="del_group.php?tid=<?php echo $row["tid"];?>" class="button"  >删除</a>
	<?php echo "</td>";
	echo "</tr>\n";
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