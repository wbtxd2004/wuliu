<?php
include_once("checksession.php");
include("header.html");
include_once("../db.php");
$query = "select * from taobao_order  where tid='$_GET[tid]'  ";
$result = mysql_db_query($DataBase, $query); 
$r6=mysql_fetch_array($result);
//echo $r[cid];

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
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<form action="doedittags.php?tid=<?php echo $r6[tid];  ?>" method=post name="form1">

<table width=90% align=center cellspacing=0 cellpadding=0 class=i_table>
<tr><td><table width=100% cellspacing=1 cellpadding=6>

<tr>
  <td class=head colspan=7><b>添加物流资料</b></td>
</tr>
<tr align=center>
  <td class=b >物流公司:</td>
   <td class=b >运单号码:</td>
    <td class=b >包裹内容:</td>
	 <td class=b >空运类型:</td>
	  <td class=b >备注:</td>
  </tr>
 
<?php


$query = "select * from  index_product      where   order_id='$r6[tid]'     order by tid  ";
$result2 = mysql_db_query($DataBase, $query);


$i=0;
while ($r2=mysql_fetch_array($result2)) {
$i++;

?>
<tr align=center>
  <td class=b >


  <SELECT  name=company[] >
  <?php
  foreach($expresses as $key=>$value)
  {
  ?>
                    <option value=<?php echo $key; ?>  <?php if($key==$r2['company']){ ?>  selected="selected" <?php } ?> > <?php echo $value; ?></option>
<?php
}
?>					
                  
				  
                </SELECT></td>
   <td class=b ><input type=text name=shipping_no[] size=30 value="<?php echo $r2[shipping_no]; ?>"  ></td>
    <td class=b ><input type=text name=product_info[] size=50  value="<?php echo $r2[product_info]; ?>"  ></td>
	 <td class=b ><SELECT  name=air_type[] >
                  <option value=1 <?php if($r2[air_type]==1) { ?>selected="selected" <?php } ?> > 普通</option>
				  <option value=2  <?php if($r2[air_type]==2) { ?>selected="selected" <?php } ?> > 敏感</option>
				   
				  
				 
				 
                </SELECT></td>
	  <td class=b ><SELECT  name=info[] >
                  <option value=1  <?php if($r2[info]==1) { ?>selected="selected" <?php } ?> > 拆包</option>
				  <option value=2  <?php if($r2[info]==2) { ?>selected="selected" <?php } ?> > 不拆包</option>
				   
				  
				 
				 
                </SELECT></td>
  </tr>
<?php
}

?> 




 
 
<tr align=center>
<td  colspan="2" class=b >收货人资料：</td>
  <td colspan="3"  class=b  ><textarea name="shipping_info" cols="60" rows="6" id="info">
  <?php
echo $r6[shipping_info];
  ?> </textarea></td>
   </tr>
   
<tr align=center>
<td  colspan="2" class=b >订单编号：</td>
  <td colspan="3" class=b  ><input type=text name=order_number size=30 value="<?php echo $r6[order_number]; ?>"  ></td>
   </tr>
</table></td></tr>
</table>
<br><center><input type='submit' value='提交'></center></form>

<?php include("bottom.html"); ?>
