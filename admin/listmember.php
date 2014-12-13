<?php
include_once("checksession.php");
include("header.html");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
  <td class=head colspan=10><b>会员列表修改管理</b></td>
</tr>
<tr align="center" class="head_1">
<td>ID</td>
<td> 用户名</td>

<td>真实姓名（昵称）</td>
<td>手机号</td>
<td>财富值</td>
<td>会员发布问题数</td>
<td>会员回答数</td>
<td>提交记录的IP</td>
<td>记录时间</td>
<td>操作</td>
</tr>
                     
<?php
include_once("../db.php");

$query = "select * from member    ";
$result = mysql_db_query($DataBase, $query); 

$amount=mysql_num_rows($result);

$page_size=10;

$pagecount=($amount/$page_size);


$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;











$query = "select * from member order by tid    limit $a,$page_size ";
$result = mysql_db_query($DataBase, $query);



while ($r=mysql_fetch_array($result)) {
?>
<tr align=center class=b>
<td><?php echo $r[tid]; ?></td>
<td><?php echo $r[username]; ?></td>
<td><?php   echo $r[name];?></td>
<td><?php   echo $r[mobile];?></td>
<td><?php   echo $r[questions];?></td>
<td><?php   echo $r[replys];?></td>
<td><?php  echo $r[caifu]; ?></td>
<td><?php   echo $r[ip];?></td>
<td><?php   echo $r[dtime];?></td>
<td>
<a href=editmember.php?tid=<?php echo $r[tid]; ?>>编辑审核</a>
<a onClick="if(confirm('您确定删除吗?')) {return true;}else {return false;}"  href="delmember.php?tid=<?php echo $r[tid];?>" class="button"  >删除</a>
</td></tr>




<?php


}

mysql_free_result($result)




?>



</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-weight:bold;">
  
    <tr><td style="height:28px;width:100%;"><font style="font-weight:bold;">&nbsp;&nbsp;&nbsp;
    共有<font id="red"><?php echo $amount; ?></font>条&nbsp;&nbsp;共有<font id="red"><?php echo $pagecount; ?></font>页&nbsp;&nbsp;<font id="red"><?php echo $page;?></font>/<?php echo $pagecount;?> </font>
    &nbsp;&nbsp;  <a href="?page=1" class="backs">[首页]</a>&nbsp;&nbsp;<?php $i=$_GET[page]-4;$j=$_GET[page]+4;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?page=$u>$u</a>";} ?>
    &nbsp;&nbsp;  <a href="?page=<?php echo $pagecount;?>" class="backs">[尾页]</a></td></tr>
   
   
</table>
<?php include("bottom.html"); ?>