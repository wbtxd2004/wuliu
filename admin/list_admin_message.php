<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<center>
<?php
include_once("../db.php");
echo "<p>";

$query = "select * from admin_get_message";
$result = mysql_db_query($DataBase, $query); 

$amount=mysql_num_rows($result);


//print_r($num);
echo "当前私信共有".$amount."条结果";
echo "<p>";
echo "<a href='add_admin_message.php'>创建私信</a>&nbsp;&nbsp;";





$page_size=10;

$pagecount=($amount/$page_size);


$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;











$query = "select * from admin_get_message order by tid    limit $a,$page_size ";
$result = mysql_db_query($DataBase, $query);







?>
<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=10><b>管理员私信列表</b></td>
</tr>
<tr align="center" class="head_1">
<td>ID</td>
<td>标题</td>
<td>内容</td>
<td>收件人ID</td>
<td>发件人ID</td>
<td>IP地址</td>
<td>发送时间</td>
<td>图片</td>
<td>声音</td>
<td>编辑</td>
<td>删除</td>
</tr>
<?php


while($row=mysql_fetch_array($result))
{
?>
<tr align=center class=b>
<td><?php echo $row["tid"];?></td>
<td><?php echo $row["biaoti"];?></td>
<td><?php echo $row["info"];?></td>
<td><?php echo $row["member_id"];?></td>
<td><?php echo $row["admin_id"];?></td>
<td><?php echo $row["ip"];?></td>
<td><?php echo $row["dtime"];?></td>
<td>
	<?php
		$sql="select filename from admin_get_message_images where mid=$row[tid] and filetype='0'";
		$r=mysql_db_query($DataBase,$sql);
		$n=mysql_num_rows($r);
		if($n==0) echo "无";
		else
		{
			while($obj=mysql_fetch_array($r))
			{
				echo "<a href=message_image/big/".$obj["filename"]." target=_blank>{$obj["filename"]}</a>&nbsp;&nbsp;";
			}
		}

	?>
</td>
<td>
	<?php
	$queryaudio="select filename from admin_get_message_images where mid=$row[tid] and filetype='1'";
	$raudio=mysql_db_query($DataBase,$queryaudio);
	$naudio=mysql_num_rows($raudio);
	if($naudio==0) echo "无";
	else
	{
		while($audiobj=mysql_fetch_array($raudio))
		{
			echo "<a href=message_audio/".$audiobj["filename"]." target=_blank>{$audiobj["filename"]}</a>&nbsp;&nbsp;";
		}
	}

	##########change over #########
	?>
</td>
<td>
	<?php
		echo "<a href='edit_admin_message.php?tid=".$row["tid"]."'>编辑</a>";
	?>
</td>
<td>
	<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="del_admin_message.php?tid=<?php echo $row["tid"];?>" class="button"  >删除</a>
</td>
</tr>
	<?php } ?>
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