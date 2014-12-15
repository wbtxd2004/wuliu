<?php
include_once("checksession.php");
include("header.html");
include_once("../db.php");
 
 $query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);

$expresses=array (
  'aae' => 'AAE快递',
  'anjie' => '安捷快递',
  'anxinda' => '安信达快递',
  'aramex' => 'Aramex国际快递',
  'benteng' => '成都奔腾国际快递',
  'cces' => 'CCES快递',
  'changtong' => '长通物流',
  'chengguang' => '程光快递',
  'chengji' => '城际快递',
  'chengshi100' => '城市100',
  'chuanxi' => '传喜快递',
  'chuanzhi' => '传志快递',
  'citylink' => 'CityLinkExpress',
  'coe' => '东方快递',
  'cszx' => '城市之星',
  'datian' => '大田物流',
  'dayang' => '大洋物流快递',
  'debang' => '德邦物流',
  'dechuang' => '德创物流',
  'dhl' => 'DHL快递',
  'diantong' => '店通快递',
  'dida' => '递达快递',
  'disifang' => '递四方速递',
  'dpex' => 'DPEX快递',
  'dsu' => 'D速快递',
  'ees' => '百福东方物流',
  'ems' => 'EMS快递',
  'fanyu' => '凡宇快递',
  'fardar' => 'Fardar',
  'fedex' => '国际Fedex',
  'fedexcn' => 'Fedex国内',
  'feibang' => '飞邦物流',
  'feibao' => '飞豹快递',
  'feihang' => '原飞航物流',
  'feihu' => '飞狐快递',
  'feiyuan' => '飞远物流',
  'fengda' => '丰达快递',
  'fkd' => '飞康达快递',
  'gdyz' => '广东邮政物流',
  'gnxb' => '邮政国内小包',
  'gongsuda' => '共速达物流|快递',
  'guotong' => '国通快递',
  'haihong' => '山东海红快递',
  'haimeng' => '海盟速递',
  'haosheng' => '昊盛物流',
  'hebeijianhua' => '河北建华快递',
  'henglu' => '恒路物流',
  'huaqi' => '华企快递',
  'huaxialong' => '华夏龙物流',
  'huayu' => '天地华宇物流',
  'huiqiang' => '汇强快递',
  'huitong' => '汇通快递',
  'hwhq' => '海外环球快递',
  'jiaji' => '佳吉快运',
  'jiayi' => '佳怡物流',
  'jiayunmei' => '加运美快递',
  'jinda' => '金大物流',
  'jingguang' => '京广快递',
  'jinyue' => '晋越快递',
  'jixianda' => '急先达物流',
  'jldt' => '嘉里大通物流',
  'kangli' => '康力物流',
  'kcs' => '顺鑫(KCS)快递',
  'kuaijie' => '快捷快递',
  'kuayue' => '跨越快递',
  'lejiedi' => '乐捷递快递',
  'lianhaotong' => '联昊通快递',
  'lijisong' => '成都立即送快递',
  'longbang' => '龙邦快递',
  'minbang' => '民邦快递',
  'mingliang' => '明亮物流',
  'minsheng' => '闽盛快递',
  'nengda' => '港中能达快递',
  'ocs' => 'OCS快递',
  'pinganda' => '平安达',
  'pingyou' => '中国邮政平邮',
  'pinsu' => '品速心达快递',
  'quanchen' => '全晨快递',
  'quanfeng' => '全峰快递',
  'quanjitong' => '全际通快递',
  'quanritong' => '全日通快递',
  'quanyi' => '全一快递',
  'rpx' => 'RPX保时达',
  'rufeng' => '如风达快递',
  'saiaodi' => '赛澳递',
  'santai' => '三态速递',
  'scs' => '伟邦(SCS)快递',
  'shengan' => '圣安物流',
  'shengfeng' => '盛丰物流',
  'shenghui' => '盛辉物流',
  'shentong' => '申通快递（可能存在延迟）',
  'shunfeng' => '顺丰快递',
  'suijia' => '穗佳物流',
  'sure' => '速尔快递',
  'tiantian' => '天天快递',
  'tnt' => 'TNT快递',
  'tongcheng' => '通成物流',
  'tonghe' => '通和天下物流',
  'ups' => 'UPS',
  'usps' => 'USPS快递',
  'wanjia' => '万家物流',
  'weitepai' => '微特派',
  'xianglong' => '祥龙运通快递',
  'xinbang' => '新邦物流',
  'xinfeng' => '信丰快递',
  'xiyoute' => '希优特快递',
  'yad' => '源安达快递',
  'yafeng' => '亚风快递',
  'yibang' => '一邦快递',
  'yinjie' => '银捷快递',
  'yishunhang' => '亿顺航快递',
  'yousu' => '优速快递',
  'ytfh' => '北京一统飞鸿快递',
  'yuancheng' => '远成物流',
  'yuantong' => '圆通快递',
  'yuanzhi' => '元智捷诚',
  'yuefeng' => '越丰快递',
  'yunda' => '韵达快递',
  'yuntong' => '运通中港快递',
  'ywfex' => '源伟丰',
  'zhaijisong' => '宅急送快递',
  'zhima' => '芝麻开门快递',
  'zhongtie' => '中铁快运',
  'zhongtong' => '中通快递',
  'zhongxinda' => '忠信达快递',
  'zhongyou' => '中邮物流'
);
?>

<script>
function ck(){
  if(document.form1.money.value==""){
    alert("请输入金额");
    document.form1.money.focus();
    return false;
  }
  }
 function  CheckAll()  
{  
   for(var  i=0;i<document.form1.elements.length;i++){  
       var  e=document.form1.elements[i];  
       if  (e.name  !=  'chkall')  
             e.checked  =  document.form1.chkall.checked;  
   }  
}  
/*
function ck2(){
  if(document.form1.money.value==""){
    alert("请选择出生年！");
    return false;
  }
  
  if(document.form1.month.value==""){
    alert("请选择出生月！");
    return false;
  }
  
  if(document.form1.day.value==""){
    alert("请选择出生日！");
    return false;
  }
  
  }
*/
</script>
<br>
<META http-equiv=Content-Type content=text/html;charset=utf-8>



<?php





$t="1";





if($_GET[tid]!='')
{
$t=$t."  and cid='$_GET[tid]' ";
}



if($_GET[country]!='')
{
$t=$t."  and country='$_GET[country]' ";
}



if($_GET[status]!='')
{
$t=$t."  and status='$_GET[status]' ";
}


if($r8[states]!=2)
{
$t=$t."  and admin_id='$r8[tid]' ";
}





$query = "select * from taobao_order     where $t    ";

//echo $query;
//echo $query;
$result = mysql_db_query($DataBase, $query); 

$amount=mysql_num_rows($result);

$page_size=50;

$pagecount=($amount/$page_size);


$pagecount=intval($pagecount)+1;
if($_GET[page]==0)
{$_GET[page]=1;}
if($_GET[page]>$pagecount)
{$_GET[page]=$pagecount;}
$page=$_GET[page];

$a=($_GET[page]-1)*$page_size;
?>


 
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-weight:bold;">
  
    <tr><td style="height:28px;width:100%;"><font style="font-weight:bold;">&nbsp;&nbsp;&nbsp;
    共有<font id="red"><?php echo $amount; ?></font>条&nbsp;&nbsp;共有<font id="red"><?php echo $pagecount; ?></font>页&nbsp;&nbsp;<font id="red"><?php echo $page;?></font>/<?php echo $pagecount;?> </font>
    &nbsp;&nbsp;  <a href="?tid=<?php echo $_GET[tid]; ?>&page=1&operation=<?php echo $_GET[operation];?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" class="backs">[首页]</a>&nbsp;&nbsp;<?php $i=$_GET[page]-8;$j=$_GET[page]+15;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?tid=$_GET[tid]&page=$u&operation=$_GET[operation]&invoice=$_GET[invoice]&startdate=$_GET[startdate]&enddate=$_GET[enddate]&customer_name=$_GET[customer_name]&shipping_id=$_GET[shipping_id]&payment_gross=$_GET[payment_gross]&username=$_GET[username]&jufu_status=$_GET[jufu_status]>$u</a>";} ?>
    &nbsp;&nbsp;  <a href="?tid=<?php echo $_GET[tid]; ?>&page=<?php echo $pagecount;?>&operation=<?php echo $_GET[operation];?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" class="backs">[尾页]</a> <a href="?tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page-1);?>&&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" >上一页</a>   <a href="?tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page+1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">下一页</a></td></tr>
   
   
</table>
<form name=form1  method=post action=exportcsv.php>

<table width=98% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr><td class=head colspan=13><b>查看操作情况</b></td></tr>



                     
<?php


$query = "select * from taobao_order     where $t     order by tid desc  limit $a,$page_size ";
$result = mysql_db_query($DataBase, $query);



while ($r=mysql_fetch_array($result)) {


?>
<tr align="center" class="head_1">

<td width="9%"><span class="STYLE1"> 物流公司 </span></td>
<td width="9%"><span class="STYLE1"> 运单号码 </span></td>
<td width="9%"><span class="STYLE1"> 包裹内容 </span></td>
<td width="11%"><span class="STYLE1">空运类型 </span></td>
<td width="8%"><span class="STYLE1">快递状态</span></td>
<td width="5%"><span class="STYLE1">备注 </span></td>
<td width="22%"><span class="STYLE1">收货人资料 </span></td>
<td width="9%"><span class="STYLE1">发货时间 </span></td>
<td width="18%"><span class="STYLE1">操作</span></td>
</tr>
<?php


$query = "select * from  index_product      where   order_id='$r[tid]'     order by tid  ";
$result2 = mysql_db_query($DataBase, $query);


$i=0;
while ($r2=mysql_fetch_array($result2)) {
$i++;

?>
<tr align=center class=b>
<td >
<?php echo $expresses{$r2[company]}; ?></td>
<td  > <?php echo $r2[shipping_no]; ?> </td>
<td >

<?php echo $r2[product_info]; ?></td>
<td  > <?php if($r2[air_type]==1){echo"普通";}else if($r2[air_type]==2){echo"<font color=red>敏感</font>";} ?> </td>

<td>
<?php
if($r2[status]==0)
{
echo"未查询";
}else
if($r2[status]==1)
{
echo"正常";
}else
if($r2[status]==2)
{
echo"<font color=red>派送中</font>";
}else
if($r2[status]==3)
{
echo"<font color=green>已签收</font>";
}else
if($r2[status]==4)
{
echo"退回";
} ?></td>

<td>
<?php if($r2[info]==1){echo"拆包";}else if($r2[info]==2){echo"<font color=red>不拆包</font>";} ?>
</td>
<td  align="left" > <?php
 if($i==1)
 {
   $info=str_replace("\n","<br>",$r[shipping_info]);
$info=str_replace(" ","&nbsp;",$info);
 echo $info; 
 //echo $r[shipping_info];
 }
  ?> </td>
<td  > <?php echo $r2[shipping_time]; ?> </td>
<td>
 <?php
 if($i==1)
 {
 
  ?> 
<a href="edittags.php?tid=<?php echo $r[tid];?>"   class="button"  > 修改</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="deltags.php?tid=<?php echo $r[tid];?>"    onClick="if(confirm('你确定删除吗?')) {return true;}else {return false;}"  class="button"  > 删除</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="get_status.php?tid=<?php echo $r[tid];?>"   class="button"  > 更新状态</a>
select 
                   <INPUT type=checkbox value=<?php echo $r[tid]; ?> name=idarray[]>
<?php
}
?>           
           
</td>
</tr>
<?php
}






?>






<?php
}

mysql_free_result($result);




?>




<tr align=center class=b>
<td >
 </td>
<td >&nbsp;</td>
 <td >&nbsp;</td>
<td  ><input type="submit" name="operation" value="export_csv"  >&nbsp;  </td>

<td>
 </td>

<td>
 
</td>
<td  >  </td>
<td>Check All:
                  <INPUT  onclick=CheckAll()  type=checkbox  name=chkall>
 
 
</td>


</tr>
</table>
</form>
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-weight:bold;">
  
    <tr><td style="height:28px;width:100%;"><font style="font-weight:bold;">&nbsp;&nbsp;&nbsp;
    共有<font id="red"><?php echo $amount; ?></font>条&nbsp;&nbsp;共有<font id="red"><?php echo $pagecount; ?></font>页&nbsp;&nbsp;<font id="red"><?php echo $page;?></font>/<?php echo $pagecount;?> </font>
    &nbsp;&nbsp;  <a href="?tid=<?php echo $_GET[tid]; ?>&page=1&operation=<?php echo $_GET[operation];?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" class="backs">[首页]</a>&nbsp;&nbsp;<?php $i=$_GET[page]-8;$j=$_GET[page]+15;if($i<1){$i=1;}if($j>$pagecount){$j=$pagecount;}for($u=$i;$u<=$j;$u++){echo "&nbsp;<a href=?tid=$_GET[tid]&page=$u&operation=$_GET[operation]&invoice=$_GET[invoice]&startdate=$_GET[startdate]&enddate=$_GET[enddate]&customer_name=$_GET[customer_name]&shipping_id=$_GET[shipping_id]&payment_gross=$_GET[payment_gross]&username=$_GET[username]&jufu_status=$_GET[jufu_status]>$u</a>";} ?>
    &nbsp;&nbsp;  <a href="?tid=<?php echo $_GET[tid]; ?>&page=<?php echo $pagecount;?>&operation=<?php echo $_GET[operation];?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" class="backs">[尾页]</a> <a href="?tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page-1);?>&&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>" >上一页</a>   <a href="?tid=<?php echo $_GET[tid]; ?>&operation=<?php echo $_GET[operation]; ?>&page=<?php echo($page+1);?>&invoice=<?php echo $_GET[invoice];?>&startdate=<?php echo $_GET[startdate];?>&enddate=<?php echo $_GET[enddate];?>&customer_name=<?php echo $_GET[customer_name];?>&shipping_id=<?php echo $_GET[shipping_id];?>&payment_gross=<?php echo $_GET[payment_gross];?>&username=<?php echo $_GET[username];?>&jufu_status=<?php echo $_GET[jufu_status];?>">下一页</a></td></tr>
   
   
</table>









<?php include("bottom.html"); ?>
