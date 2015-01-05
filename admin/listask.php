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


$page_size=10;
$pagecount=($amount/$page_size);

$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}
if($_GET[page]>$pagecount)
{$_GET[page]=$pagecount;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;

?>

<p>
<center>
当前问答共有 <?php echo $amount ?>条结果
<br><br>
<a href='addask.php'>添加问答</a><br><br>
</center>
</p>


<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=16><b>问答列表修改管理</b></td>
</tr>
<tr align="center" class="head_1">
<td><div align="center"><b>ID<br><?php echo sortingLink('tid') ?></b></div></td>
<td><div align="center"><b>栏目名称<br><?php echo sortingLink('cid') ?></b></div></td>
<td><div align="center"><b>标题<br><?php echo sortingLink('biaoti') ?></b></div></td>
<td><div align="center"><b>问答内容<br><?php echo sortingLink('info') ?></b></div></td>

<td><div align="center"><b>点击数<br><?php echo sortingLink('visit_count') ?></b></div></td>
<td><div align="center"><b>回复数<br><?php echo sortingLink('reply_num') ?></b></div></td>
<td><div align="center"><b>悬赏<br><?php echo sortingLink('shang') ?></b></div></td>

<td><div align="center"><b>发布者<br><?php echo sortingLink('member_id') ?></b></div></td>
<td><div align="center"><b>单位名称<br><?php echo sortingLink('shang') ?></b></div></td>

<td><div align="center"><b>ip记录<br><?php echo sortingLink('ip') ?></b></div></td>
<td><div align="center"><b>提问时间<br><?php echo sortingLink('dtime') ?></b></div></td>
<td><div align="center"><b>最后回复时间<br><?php echo sortingLink('lastReply_dtime') ?></b></div></td>
<td>图片</td>
<td>声音</td>
<td>操作</td>
<td>锁定操作</td>
</tr>

<?php

$t ='1';
if($_GET['blacklist']){
	$t .= ' AND `blockstatus` = "1"';
}
$search_cons = array_filter($_GET[search]);
foreach ($search_cons as $key => $value) {
	switch ($key) {
		case 'biaoti':
		case 'info':
			$t .= " AND `$key` LIKE '%$value%'";
			break;
		case 'member_id':
			$t .= " AND `$key` = '$value'";
			break;		
	}
}

$orderBy = '';
switch ($_GET['sorting']) {
	case 'tid':
	case 'cid':	
	case 'biaoti':
	case 'info':
	case 'visit_count':
	case 'reply_num':
	case 'member_id':
	case 'danwei_id':
	case 'ip':
	case 'dtime':
	case 'lastReply_dtime':
		$orderBy .= $_GET['sorting'];
		if($_GET['desc']>=1){
			$orderBy .= ' DESC';
		}
		break;
	default:
		$orderBy = 'dtime DESC';
		break;
}

$query = "select * from asks  where $t  ORDER BY  $orderBy ";
//echo $query.'<br>';

$result = mysql_db_query($DataBase, $query); 


while ($r=mysql_fetch_array($result)) {
?>
<tr align=center class=b>
<td><?php echo $r[tid]; ?></td>
<td>
<?php
	$sql="select name from ask_class where tid=$r[cid]";
	$r2=mysql_db_query($DataBase,$sql);
	$row=mysql_fetch_array($r2);
	echo $row[name];
?>
</td>
<td><?php echo $r[biaoti]; ?></td>
<td><?php echo $r[info]; ?></td>
<td><?php echo $r[visit_count]; ?></td>
<td><?php echo $r[reply_num]; ?></td>
<td><?php echo $r[shang]; ?></td>

<td>
<?php
	$sql="select username from member where tid=$r[member_id]";
	$r2=mysql_db_query($DataBase,$sql);
	$row=mysql_fetch_array($r2);
	echo $row[username];
?>
</td>
<td>
<?php
	$sql="select name from danwei where tid=$r[danwei_id]";
	$r2=mysql_db_query($DataBase,$sql);
	$row=mysql_fetch_array($r2);
	echo $row[name];
?>
</td>
<td><?php echo $r[ip];?></td>
<td><?php echo $r[dtime];?></td>
<td><?php echo $r[lastReply_dtime];?></td>



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

?>
</td>
<td>
<?php
 

##########在列表添加声音文件名显示， By WuBin in 20141214#########
 
$queryaudio="select filename from ask_images where ask_id=$r[tid] and filetype='1'";
$raudio=mysql_db_query($DataBase,$queryaudio);
$naudio=mysql_num_rows($raudio);
if($naudio==0) echo "无";
else
{
	while($audiobj=mysql_fetch_array($raudio))
	{
		echo "<a href='playaudio.php?audio=ask_audio/".$audiobj["filename"]."' target=_blank style='display:block'>";
		echo "{$audiobj["filename"]}";
		echo "</a>";

	}
}
?>
</td>



<td>
<a href=viewasks.php?tid=<?php echo $r[tid]; ?>>查看问答</a>
<a href=editask.php?tid=<?php echo $r[tid]; ?>>编辑审核</a>
<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="delask.php?tid=<?php echo $r[tid];?>" class="button"  >删除</a>

</td>
<td>
<?php if($r[blockstatus]==0){ ?>
<a 
onClick="if(confirm('您确定将该问答封锁吗？')){return true;} else{return false;}" 
href="block_ask.php?blockstatus=<?php echo $r[blockstatus]?>&tid=<?php echo $r[tid];?>">
	封锁
</a>
<?php }else{ ?>
<a 
onClick="if(confirm('您确定移除该问答的封锁吗？')){return true;} else{return false;}" 
href="block_ask.php?blockstatus=<?php echo $r[blockstatus]?>&tid=<?php echo $r[tid];?>">
	移除封锁
</a>
<?php } ?>

</td>
</tr>

<?php 


}

mysql_free_result($result);

?>


</table>
<?php //if(isset($_GET[desc])){echo "&"."desc=".$_GET[desc];} ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-weight:bold;">
  
    <tr><td style="height:28px;width:100%;"><font style="font-weight:bold;">&nbsp;&nbsp;&nbsp;
    共有<font id="red"><?php echo $amount; ?></font>条&nbsp;&nbsp;共有<font id="red"><?php echo $pagecount; ?></font>页&nbsp;&nbsp;<font id="red"><?php echo $page;?></font>/<?php echo $pagecount;?> </font>
    &nbsp;&nbsp;  <a href="?sorting=<?php echo $_GET[sorting]; ?>&desc=<?php echo $_GET[desc]; ?>&page=1" class="backs">[首页]</a>&nbsp;&nbsp;<?php $i=$_GET[page]-4;$j=$_GET[page]+4;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?page=$u&sorting=$_GET[sorting]&desc=$_GET[desc]>$u</a>";} ?>
    &nbsp;&nbsp;  <a href="?sorting=<?php echo $_GET[sorting]; ?>&desc=<?php echo $_GET[desc]; ?>&page=<?php echo $pagecount;?>" class="backs">[尾页]</a>
	<a href="?sorting=<?php echo $_GET[sorting]; ?>&desc=<?php echo $_GET[desc]; ?>&tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page-1);?>&&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" >上一页</a>   <a href="?sorting=<?php echo $_GET[sorting]; ?>&desc=<?php echo $_GET[desc]; ?>&tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page+1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">下一页</a>
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