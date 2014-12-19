<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>



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
	<td>新闻内容</td>
	<td>ip记录</td>
	<td>添加的时间</td>
	<td>操作</td>
</tr>

<?php
	include_once("../db.php");

	$query = "select * from news_reply    ";
	$result = mysql_db_query($DataBase, $query); 

	$amount=mysql_num_rows($result);

	$page_size=10;

	$pagecount=($amount/$page_size);


	$pagecount=intval($pagecount)+1;
	if($_GET[page]==0)
	{$_GET[page]=1;}
	$page=$_GET[page];

	$a=($_GET[page]-1)*$page_size;









	$query1 = "select * from news_reply order by tid    limit $a,$page_size ";

	$result1 = mysql_db_query($DataBase, $query1);



	while ($r2=mysql_fetch_array($result1)) {

		$query4 = "SELECT * from news where tid='$r2[news_id]'";
		$result4 = mysql_db_query($DataBase,$query4);
		$r4= mysql_fetch_array($result4);
		  
		  
		$query3 = "select * from new_class   where tid='$r4[cid]' ";
		$result3= mysql_db_query($DataBase,$query3);
		$r3 = mysql_fetch_array($result3);

		$querydw = "SELECT * from `danwei` where tid='$r4[danwei_id]'";
		$resultdw = mysql_db_query($DataBase, $querydw);
		$rdw = mysql_fetch_array($resultdw);

?>                    

<tr align=center class=b>
	<td> <?php echo $r2[tid]; ?> </td>
	<!--<td>&nbsp; </td>
	-->
	<td> <?php echo $r4[biaoti]; ?> </td>
	<td> <?php echo $r2[member_id];?> </td>
	<td> <?php echo $rdw[name];?> </td>
	<td><?php  echo $r3[name]; ?></td>
	<td><?php  echo $r2[info]; ?></td>
	<td><?php   echo $r2[ip];?></td>
	<td><?php   echo $r2[dtime];?></td>
	<td>
		<a href=editnews_reply.php?tid=<?php echo $r2[tid]; ?>>编辑审核</a>
		<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="delnews_reply.php?tid=<?php echo $r2[tid];?>" class="button"  >删除</a>
		<a href=viewnews.php?tid=<?php echo $r2[tid]; ?>>查看新闻</a>
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