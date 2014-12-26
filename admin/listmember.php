<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<?php
include_once("../db.php");

$t ='1';


if($_GET['blacklist']){
	$t .= ' AND `blockstatus` = "1"';
}


 if($_SESSION[adminStates]>2)
 {
	$t .= " AND `manage_id` = '$_SESSION[adminId]' ";
 }
$query = "select * from member  where $t    ";
$result = mysql_db_query($DataBase, $query); 

$amount=mysql_num_rows($result); //取得行数
 
$page_size=10; 

$pagecount=($amount/$page_size);

$pagecount=intval($pagecount)+1;  //intval进制转化，获得总分页数
if($_GET[page]==0)
{$_GET[page]=1;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;




$search_cons = array_filter($_GET[search]);
foreach ($search_cons as $key => $value) {
	switch ($key) {
		case 'username':
		case 'name':
		case 'mobile':
			$t .= " AND `$key` LIKE '%$value%'";
			break;
	}
}

$orderBy = '';
	switch ($_GET['sorting']) {
		case 'tid':
		case 'username':
		case 'name':
		case 'mobile':
		case 'manage_id':
		case 'questions':
		case 'replys':
		case 'caifu':
		case 'caina':	
		case 'login_count':
		case 'ip':
			$orderBy .= $_GET['sorting'];
			break;
		default:
			$orderBy = 'tid';
			break;
	}
if($_GET['desc']==1 || $_GET['desc']=='DESC'){
	$desc = 'DESC';
}else {$desc='';}






$query = "select * from member where $t order by $orderBy $desc limit $a,$page_size  ";

echo $query;

$result = mysql_db_query($DataBase, $query);
$amount=mysql_num_rows($result);

?>

<p>
	<center>
		当前会员共有 <?php echo $amount ?>条结果
		<br><br>
		<a href='addmember.php'>添加会员</a><br><br>
		<a href='listmember.php?blacklist=1'>检视黑名单会员</a>
	</center>
</p>

<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=13><b>会员列表修改管理</b></td>
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
		<b>用户名（昵称）<br>
		<?php echo sortingLink('username') ?>
		</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>真实姓名<br>
		<?php echo sortingLink('name') ?>
		</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>手机号<br>
		<?php echo sortingLink('mobile') ?>
		</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>财富值<br>
		<?php echo sortingLink('caifu') ?>
		</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>单位名称<br>
		<?php echo sortingLink('manage_id') ?>
		</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>会员发布问题数<br>
		<?php echo sortingLink('questions') ?>
		</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>会员回答数<br>
		<?php echo sortingLink('replys') ?>
		</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>会员采纳数<br>
		<?php echo sortingLink('caina') ?>
		</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>登录次数<br>
		<?php echo sortingLink('login_count') ?>
		</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>提交记录的IP<br>
		<?php echo sortingLink('ip') ?>
		</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>操作</b>
		</div>
	</td>
	<td>
		<div align="center">
		<b>会员状态
		<!--
		<br>
		<?php echo sortingLink('blockstatus') ?>
		-->
		</b>
		</div>
	</td>
</tr>
                     
<?php

while ($r=mysql_fetch_array($result)) {
?>
<tr align=center class=b>
	<td><?php echo $r[tid]; ?></td>
	<td><?php echo $r[username]; ?></td>
	<td><?php echo $r[name];?></td>
	<td><?php echo $r[mobile];?></td>
	<td><?php echo $r[caifu]; ?></td>
	<td>
		<?php
		$query = "select * from beian_manage where tid = '$r[manage_id]' ";
		//echo "select * from beian_manage where tid = '$r[manage_id]'  ";
		//echo $query;

		$result2 = mysql_db_query($DataBase, $query);
		$r2=mysql_fetch_array($result2);
		$danwei_id = $r2['danwei_id'];

		$query = "select * from danwei where tid = '$danwei_id'  ";
		//echo $query;
		$result3 = mysql_db_query($DataBase, $query);
		$r3=mysql_fetch_array($result3);
		$danwei = $r3['name'];
		echo $danwei;
		?>
	</td>
	<td><?php echo $r[questions];?></td>
	<td><?php echo $r[replys];?></td>
	<td><?php echo $r[caina];?></td>

	<td><?php echo $r[login_count];?></td>
	<td><?php echo $r[ip];?></td>
	<td>
		<a href=editmember.php?tid=<?php echo $r[tid]; ?>>编辑审核</a>
		<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="delmember.php?tid=<?php echo $r[tid];?>" class="button"  >删除</a>
	</td>
	<td>

		<?php if($r[blockstatus]==0){ ?>

		<a 
		onClick="if(confirm('您确定将该会员加入黑名单吗？')){return true;} else{return false;}" 
		href="block_member.php?blockstatus=<?php echo $r[blockstatus]?>&tid=<?php echo $r[tid];?>">
			加入黑名单
		</a>
		<?php }else{ ?>
		<a 
		onClick="if(confirm('您确定将该会员移除黑名单吗？')){return true;} else{return false;}" 
		href="block_member.php?blockstatus=<?php echo $r[blockstatus]?>&tid=<?php echo $r[tid];?>">
			移除黑名单
		</a>
		<?php }?>

	</td>
</tr>

<?php 
}
mysql_free_result($result);
?>



</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-weight:bold;">
  
    <tr>
    	<td style="height:28px;width:100%;">
    		<font style="font-weight:bold;">&nbsp;&nbsp;&nbsp;
    		共有<font id="red"><?php echo $amount; ?></font>条&nbsp;&nbsp;
    		共有<font id="red"><?php echo $pagecount; ?></font>页&nbsp;&nbsp;
    		<font id="red"><?php echo $page;?></font>/<?php echo $pagecount;?> 
    		</font>
    		&nbsp;&nbsp;  <a href="?page=1" class="backs">[首页]</a><!--<?php echo $_GET[page] ?>-->
    		&nbsp;&nbsp;  <?php $i=$_GET[page]-4;$j=$_GET[page]+4;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?page=$u>$u</a>";} ?>
    		&nbsp;&nbsp;  <a href="?page=<?php echo $pagecount;?>" class="backs">[尾页]</a>
			<!--
			<a href="?sorting=<?php echo $orderBy ?>&tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page-1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">上一页</a>   
			<a href="?sorting=<?php echo $orderBy ?>&tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page+1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">下一页</a>
			-->
			<a href="?sorting=<?php echo $orderBy ?>&desc=<?php echo $desc ?>&page=<?php echo($page-1);?>">上一页</a>
			<a href="?sorting=<?php echo $orderBy ?>&desc=<?php echo $desc ?>&page=<?php echo($page+1);?>">下一页</a>
		</td>
	</tr>
   
   
</table>
<?php include("bottom.html"); 

function sortingLink($fieldName){
	$html ='';
	$html .='<a href="?sorting='.$fieldName.'&desc=0">';
	$html .='<font>&#9652</font>';
	$html .='</a>';
	$html .='<a href="?sorting='.$fieldName.'&desc=1">';
	$html .='<font>&#9662</font>';
	$html .='</a>';
	return $html;
}






?>