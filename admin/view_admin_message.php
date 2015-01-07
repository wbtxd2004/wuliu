 <?php

include("checksession.php");
include_once("../db.php");

$query = "select * from admin_get_message where tid='$_GET[tid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r=mysql_fetch_array($result);



?>


<?php include("header.html"); ?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

 <table width=98% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>
<tr>
  <td class=head colspan=5><b>查看新闻评论</b></td>
</tr>



<tr align=center><td class=b width=30%> 标题:</td>
<td colspan="3" class=b><input name="biaoti" type="text" size="100" value="<?php echo $r["biaoti"];  ?>" /></td></tr>



<tr align=center><td class=b width=30%>内容:</td>
<td colspan="3" class=b><input name="info" type="text" size="100" value="<?php echo $r["info"];  ?>" /></td></tr>


<tr align=center><td class=b width=30%>收件人ID:</td>
<td colspan="3" class=b><input name="member_id" type="text" size="100" value="<?php echo $r["member_id"];  ?>" /></td></tr>

<tr align=center><td class=b width=30%>发件人ID:</td>
<td colspan="3" class=b><input name="admin_id" type="text" size="100" value="<?php echo $r["admin_id"];  ?>" /></td></tr>
<tr align=center><td class=b width=30%>IP地址:</td>
<td colspan="3" class=b><input name="ip" type="text" size="100" value="<?php echo $r["ip"];  ?>" /></td></tr>
<tr align=center><td class=b width=30%>发送时间:</td>
<td colspan="3" class=b><input name="dtime" type="text" size="100" value="<?php echo $r["dtime"];  ?>" /></td></tr>
<tr align=center><td class=b width=30%>图片:</td>
<td colspan="3" class=b>
<?php
	$query3 = "select * from admin_get_message_images where mid='$r[tid]' AND filetype = '0'";
	$result3= mysql_db_query($DataBase,$query3);
	$imgHTML = '&nbsp;';
	while($r3 = mysql_fetch_array($result3)){

		$fileName = $r3[filename];
		$path = 'message_image/small/'.$fileName;
		$imgHTML .= '<img src="'.$path.'" width="50" />&nbsp;';
		echo $imgHTML;
	}
?>

</td></tr>
<!--<td colspan="3" class=b><input name="pic" type="text" size="100" value="<?php echo $imgHTML  ?>" /></td></tr>-->
<tr align=center><td class=b width=30%>声音:</td>
<td colspan="3" class=b>
<?php
	$query3 = "select * from admin_get_message_images where mid='$r[tid]' AND filetype = '1'";
	$result3= mysql_db_query($DataBase,$query3);
	$audioHTML = '&nbsp;';
	while($r3 = mysql_fetch_array($result3)){

		$fileName = $r3[filename];
		$path = 'message_image/'.$fileName;
		//$audioHTML .= '<img src="'.$path.'" width="50" />&nbsp;';
		$audioHTML .= '<embed src="'.$path.'" align="center" width=50 height=50 />&nbsp;';
		echo $audioHTML;
	}
?>
</td></tr>

</table></td></tr></table>




<?php include("bottom.html"); ?>	