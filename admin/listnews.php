<?php
include_once("checksession.php");
include("header.html");

?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=12><b>新闻列表修改管理</b></td>
</tr>
<tr align="center" class="head_1">
<td>
	<div align="center">
	<b>ID<br>
	<?php echo sortingLink('tid') ?>
	</b>
	</div>
</td>
<td>
	<div align="center">
	<b>标题<br>
	<?php echo sortingLink('biaoti') ?>
	</b>
	</div>
</td>
<td>
	<div align="center">
	<b>发布者<br>
	<?php echo sortingLink('admin_id') ?>
	</b>
	</div>
</td>
<td>
	<div align="center">
	<b>所属单位<br>
	<?php echo sortingLink('danwei_id') ?>
	</b>
	</div>
</td>
<td>
	<div align="center">
	<b>新闻类别<br>
	<?php echo sortingLink('cid') ?>
	</b>
	</div>
</td>
<td>
	<div align="center">
	<b>图片</b>
	</div>
</td>
<td>
	<div align="center">
	<b>新闻内容<br>
	<?php echo sortingLink('info') ?></b>
	</div>
</td>
<td>
	<div align="center">
	<b>ip记录<br>
	<?php echo sortingLink('ip') ?></b>
	</div>
</td>
<td>
	<div align="center">
	<b>添加的时间<br>
	<?php echo sortingLink('dtime') ?></b>
	</div>
</td>

<td><b>操作</b></td>
<td><b>推荐操作</b></td>
<td><b>置頂操作</b></td>
</tr>

<?php
include_once("../db.php");



$orderBy = '';
switch ($_GET['sorting']) {
	case 'tid':
	case 'biaoti':
	case 'admin_id':
	case 'danwei_id':
	case 'cid':
	case 'info':
	case 'ip':
	case 'dtime':
		$orderBy .= $_GET['sorting'];
		if ($_GET['desc'] >= 1)$orderBy .= ' DESC';
		break;
	default:
		$orderBy = 'tid';
		break;
}


$t="1";
if($_GET[keywords]!='')
{
$t=$t."  and biaoti like '%$_GET[keywords]%' ";
}

$query = "select * from news where $t  ";



$result = mysql_db_query($DataBase, $query); 

$amount=mysql_num_rows($result);

$page_size=10;

$pagecount=($amount/$page_size);

$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}
if($_GET[page]>$pagecount)
{$_GET[page]=$pagecount;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;


$query = "select * from news  where $t  ORDER BY  $orderBy  limit $a,$page_size ";
echo $query.'<br>';

$result = mysql_db_query($DataBase, $query);



while ($r=mysql_fetch_array($result)) {
	$query2 = "select * from new_class where tid='$r[cid]' ";
	$result2= mysql_db_query($DataBase,$query2);
	$r2 = mysql_fetch_array($result2);

	/** get News image **/
	$query3 = "select * from news_images where nid='$r[tid]' AND filetype = '0' LIMIT 1";
	$result3= mysql_db_query($DataBase,$query3);
	$r3 = mysql_fetch_array($result3);
	if($r3){
		$fileName = $r3[filename];
		$path = 'news_images/small/'.$fileName;
		$imgHTML = '<img src="'.$path.'" style="max-height: 36px; max-width: 36px;" />';
		}else{
		$imgHTML = '&nbsp;';
	}


?>
<tr align=center class=b>

<td><?php echo $r[tid]; ?> </td> 
<td><?php echo $r[biaoti]; ?> </td> 
<td><?php echo $r[admin_id]; ?> </td> 
<td><?php echo $r[danwei_id]; ?></td>
<td><?php echo $r2[name]; ?></td>
<td><?php echo $imgHTML;?></td>
<td><?php echo $r[info];?></td>
<td><?php echo $r[ip];?></td>
<td><?php echo $r[dtime];?></td>

<td>
<a href=editnews.php?tid=<?php echo $r[tid]; ?>>编辑审核</a>
<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="delnews.php?tid=<?php echo $r[tid];?>" class="button"  >删除</a>
<a href=viewnews.php?tid=<?php echo $r[tid]; ?>>查看新闻</a>
</td>
<td>
	<?php if($r[recommand] ==0){ ?>
	<a onClick="if(confirm('您确定加入推荐吗?')) {return true;}else {return false;}"  
	href="recommand_news.php?tid=<?php echo $r[tid];?>" class="button"  >
		加入推荐
	</a>
	<?php }else{ ?>
	<a onClick="if(confirm('您确定移除推荐吗?')) {return true;}else {return false;}"  
	href="recommand_news.php?tid=<?php echo $r[tid];?>" class="button"  >
		移除推荐
	</a>
	<?php } ?>
</td>
<td>
	<?php if($r[placeTop] ==0){ ?>
	<a onClick="if(confirm('您确定加入置頂吗?')) {return true;}else {return false;}"  
	href="top_news.php?tid=<?php echo $r[tid];?>" class="button"  >
		加入置頂
	</a>
	<?php }else{ ?>
	<a onClick="if(confirm('您确定移除置頂吗?')) {return true;}else {return false;}"  
	href="top_news.php?tid=<?php echo $r[tid];?>" class="button"  >
		移除置頂
	</a>
	<?php } ?>

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
    &nbsp;&nbsp;  <a href="?sorting=<?php echo $_GET[sorting]; ?>&desc=<?php echo $_GET[desc]; ?>&keywords=<?php echo $_GET[keywords]; ?>&page=1" class="backs">[首页]</a>&nbsp;&nbsp;<?php $i=$_GET[page]-4;$j=$_GET[page]+4;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?page=$u&sorting=$_GET[sorting]&desc=$_GET[desc]>$u</a>";} ?>
    &nbsp;&nbsp;  <a href="?sorting=<?php echo $_GET[sorting]; ?>&desc=<?php echo $_GET[desc]; ?>&keywords=<?php echo $_GET[keywords]; ?>&page=<?php echo $pagecount;?>" class="backs">[尾页]</a>
	<a href="?sorting=<?php echo $_GET[sorting]; ?>&desc=<?php echo $_GET[desc]; ?>&keywords=<?php echo $_GET[keywords]; ?>&tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page-1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">上一页</a>
	<a href="?sorting=<?php echo $_GET[sorting]; ?>&desc=<?php echo $_GET[desc]; ?>&keywords=<?php echo $_GET[keywords]; ?>&tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page+1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">下一页</a>
    </td></tr>
   
</table>
<?php 


include("bottom.html"); 

function sortingLink($fieldName){
	$html ='';
	$html .='<a href="?sorting='.$fieldName.'">';
	$html .='<font face="Webdings">5</font>';
	$html .='</a>';
	$html .='<a href="?sorting='.$fieldName.'&desc=1">';
	$html .='<font face="Webdings">6</font>';
	$html .='</a>';
	return $html;
}


?>