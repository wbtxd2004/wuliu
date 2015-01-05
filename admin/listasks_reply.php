<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=12><b>问答回复列表修改管理</b></td>
</tr>
<tr align="center" class="head_1">
<td>ID</td>

<td>栏目名称</td>
<td>问题的标题</td>
<td>回复者</td>
<td>所属单位</td>
<td>回复内容</td>
<td>图片</td>
<td>声音</td>
<td>ip记录</td>
<td>添加的时间</td>

<td>操作</td>
<td>审核状态</td>
</tr>

<?php
include_once("../db.php");




$query = "select * from ask_reply";
$result = mysql_db_query($DataBase, $query); 
$r=mysql_fetch_array($result);
$amount=mysql_num_rows($result);


$page_size=10;
$pagecount=($amount/$page_size);
$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}

?>
<p>
<center>
当前问答共有 <?php echo $amount ?>条结果
<br><br>
<a href='addaskreplay.php'>添加问答回复</a><br><br>
</center>
</p>



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

$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;
$limit=" limit $a,$page_size";//加了这一句
$query1 = "select * from ask_reply where $t $limit ";
$result1 = mysql_db_query($DataBase, $query1);


while ($r=mysql_fetch_array($result1)) { ?>
     


<?	
	/*  
	$query3 = "select * from ask_class   where tid='$r4[cid]' ";
	  $result3= mysql_db_query($DataBase,$query3);
	  $r3 = mysql_fetch_array($result3);*/

?>
<tr align=center class=b>
<td><?php echo $r[tid]; ?></td>

<td>
    <?php
    	/* 栏目名称 */
        $sql="select cid from asks where tid=$r[asks_id]";
        $result2=mysql_db_query($DataBase,$sql);
        $r2=mysql_fetch_array($result2);
        $cid =  $r2['cid'];

        $sql="select name from ask_class where tid=$cid";
        $result2=mysql_db_query($DataBase,$sql);
        $r2=mysql_fetch_array($result2);
        echo $r2[name];
    ?>
</td>
<td>
	<?php
		/* 问题的标题 */
		$sql = "SELECT biaoti FROM asks WHERE tid= '$r[asks_id]'";
		$result2 = mysql_db_query($DataBase,$sql);
		$r2= mysql_fetch_array($result2);
		echo $r2[biaoti];

	?>

</td>
<td>

    <?php
    	/* 发布者 */
        $sql="SELECT username,manage_id FROM member WHERE tid = '$r[member_id]'";
        $result2=mysql_db_query($DataBase,$sql);
        $r2=mysql_fetch_array($result2);
        echo $r2[username];
    ?>

</td>
<td>
    <?php
    	/* 所属单位 */
    	$manage_id = $r2['manage_id'];
        $sql="select danwei_id from beian_manage where tid=$manage_id";
        $result2=mysql_db_query($DataBase,$sql);
        $r2=mysql_fetch_array($result2);
        $danwei_id = $r2[danwei_id];        

        $sql="select name from danwei where tid=$danwei_id";
        $result2=mysql_db_query($DataBase,$sql);
        $r2=mysql_fetch_array($result2);
        echo $r2[name];
		
    ?>
	
</td>
<td><?php  echo $r[info]; ?></td>
<td>
	<?php  
		$query3 = "select * from ask_reply_images where ask_reply_id='$r[tid]' AND filetype = '0'";
		$result3= mysql_db_query($DataBase,$query3);
		$imgHTML = '&nbsp;';
		while($r3 = mysql_fetch_array($result3)){
		$fileName = $r3[filename];
		$path = 'ask_reply_images/small/'.$fileName;
		$imgHTML .= '<img src="'.$path.'" width="50" />&nbsp;';
		
	}
		echo $imgHTML; 
	?>
</td>
<td>
	<?php  
		$query3 = "select * from ask_reply_images where ask_reply_id='$r[tid]' AND filetype = '1'";
		$result3= mysql_db_query($DataBase,$query3);
		$audioHTML = '&nbsp;';
		while($r3 = mysql_fetch_array($result3)){
		$fileName = $r3[filename];
		$path = 'ask_reply_audio/'.$fileName;
		$audioHTML .= '<embed src="'.$path.'" align="center" width=50 height=50 />&nbsp;';		
	}
		echo $audioHTML; 
	?>
</td>
<td><?php  echo $r[ip];?></td>
<td><?php  echo $r[dtime];?></td>
<td>
<a href=editasks_reply.php?tid=<?php echo $r[tid]; ?>>编辑审核</a>
<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  
href="delasks_reply.php?tid=<?php echo $r[tid];?>" class="button"  >
删除</a>

</td>

<?php
//echo $r[caina_status].'******';
?>

<td>

	<?php if($r[caina_status] ==0){ ?>
	<a onClick="if(confirm('您确定加入采纳吗?')) {return true;}else {return false;}"  
	href="listasks_reply_function.php?tid=<?php echo$r[tid] .'&'."get=1";?>" class="button"  >
		加入采纳
	</a>
	<?php }else{ ?>
	<a onClick="if(confirm('您确定移除采纳吗?')) {return true;}else {return false;}"  
	href="listasks_reply_function.php?tid=<?php echo$r[tid];?>" class="button"  >
		移除采纳
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
    &nbsp;&nbsp;  <a href="?page=1" class="backs">[首页]</a>
	
	&nbsp;&nbsp;<?php $i=$_GET[page]-4;$j=$_GET[page]+4;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?page=$u>$u</a>";} ?>
    &nbsp;&nbsp;  
	
	
	<a href="?page=<?php echo $pagecount;?>" class="backs">[尾页]</a>
    <a href="?sorting=<?php echo $orderBy ?>&desc=<?php echo $desc ?>&page=<?php echo($page-1);?>">上一页</a>
    <a href="?sorting=<?php echo $orderBy ?>&desc=<?php echo $desc ?>&page=<?php echo($page+1);?>">下一页</a>
    </td></tr>
   
   
</table>
<?php include("bottom.html"); ?>