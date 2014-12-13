<?php
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=export_data.xls");

?>



<html xmlns:o="urn:schemas-microsoft-com:office:office"
  	xmlns:x="urn:schemas-microsoft-com:office:excel"
  	xmlns="http://www.w3.org/TR/REC-html40">
 	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  	<html>
  	    <head>
 	        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  	        <style id="Classeur1_16681_Styles"></style>
 	    </head>
 	    <body>
  	        <div id="Classeur1_16681" align=center x:publishsource="Excel">
  	            <table x:str border=1 cellpadding=1 cellspacing=1 width=100% style="border-collapse: collapse">
  	               
				   
              
<?php
include_once("../db.php");

$cc=count($_POST[idarray]);
for($i=0;$i<$cc;$i++)
{

$query = "select * from taobao_order        where tid=".$_POST[idarray][$i]  ;
$result = mysql_db_query($DataBase, $query);

$r=mysql_fetch_array($result);


echo'<tr><td class=xl2216681 nowrap>订单号</td><td class=xl2216681 nowrap>物流公司</td><td class=xl2216681 nowrap>运单号码</td><td class=xl2216681 nowrap>包裹内容</td><td class=xl2216681 nowrap>空运类型</td><td class=xl2216681 nowrap>快递状态</td><td class=xl2216681 nowrap>备注</td><td class=xl2216681 nowrap>收货人资料</td><td class=xl2216681 nowrap>发货时间</td></tr>';




$query = "select * from  index_product      where   order_id='$r[tid]'     order by tid  ";
$result2 = mysql_db_query($DataBase, $query);



while ($r2=mysql_fetch_array($result2)) {


	if($r2[air_type]==1){$now_type="普通";}else if($r2[air_type]==2){$now_type="敏感";}else if($r2[air_type]==3){$now_type="海运";}


if($r2[status]==0)
{
$now_status="未查询";
}else
if($r2[status]==1)
{
$now_status="正常";
}else
if($r2[status]==2)
{
$now_status="派送中";
}else
if($r2[status]==3)
{
$now_status="已签收";
}else
if($r2[status]==4)
{
$now_status="退回";
}


if($r2[info]==1){$beizu="拆包";}else if($r2[info]==2){$beizu="不拆包";}

echo"<tr><td class=xl2216681 nowrap>$r[order_number]</td><td class=xl2216681 nowrap>$r2[company]</td><td class=xl2216681 nowrap>$r2[shipping_no]</td><td class=xl2216681 nowrap>$r2[product_info]</td><td class=xl2216681 nowrap>$now_type</td><td class=xl2216681 nowrap>$now_status</td><td class=xl2216681 nowrap>$beizu</td><td class=xl2216681 nowrap>$r[shipping_info]</td><td class=xl2216681 nowrap>$r2[shipping_time]</td></tr>";



}



}




?>
</table>
 	        </div>
  	    </body>
 	</html>