<?php
include_once("checksession.php");
include("header.html");

include_once("../db.php");
?>
<META http-equiv=Content-Type content=text/html;charset=utf-8>

<form action="doaddtags.php" method=post name="form1">

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
for($i=1;$i<=8;$i++)
{
?>
<tr align=center>
  <td class=b >


  <SELECT  name=company[] >
                    <option value=aae > AAE快递</option>
                  <option value=anjie > 安捷快递</option>
                  <option value=anxinda > 安信达快递</option>
                  <option value=aramex > Aramex国际快递</option>
                  <option value=benteng > 成都奔腾国际快递</option>
                  <option value=cces > CCES快递</option>
                  <option value=changtong > 长通物流</option>
                  <option value=chengguang > 程光快递</option>
                  <option value=chengji > 城际快递</option>
                  <option value=chengshi100 > 城市100</option>
                  <option value=chuanxi > 传喜快递</option>
                  <option value=chuanzhi > 传志快递</option>
                  <option value=citylink > CityLinkExpress</option>
                  <option value=coe > 东方快递</option>
                  <option value=cszx > 城市之星</option>
                  <option value=datian > 大田物流</option>
                  <option value=dayang > 大洋物流快递</option>
                  <option value=debang > 德邦物流</option>
                  <option value=dechuang > 德创物流</option>
                  <option value=dhl > DHL快递</option>
                  <option value=diantong > 店通快递</option>
                  <option value=dida > 递达快递</option>
                  <option value=disifang > 递四方速递</option>
                  <option value=dpex > DPEX快递</option>
                  <option value=dsu > D速快递</option>
                  <option value=ees > 百福东方物流</option>
                  <option value=ems > EMS快递</option>
                  <option value=fanyu > 凡宇快递</option>
                  <option value=fardar > Fardar</option>
                  <option value=fedex > 国际Fedex</option>
                  <option value=fedexcn > Fedex国内</option>
                  <option value=feibang > 飞邦物流</option>
                  <option value=feibao > 飞豹快递</option>
                  <option value=feihang > 原飞航物流</option>
                  <option value=feihu > 飞狐快递</option>
                  <option value=feiyuan > 飞远物流</option>
                  <option value=fengda > 丰达快递</option>
                  <option value=fkd > 飞康达快递</option>
                  <option value=gdyz > 广东邮政物流</option>
                  <option value=gnxb > 邮政国内小包</option>
                  <option value=gongsuda > 共速达物流|快递</option>
                  <option value=guotong > 国通快递</option>
                  <option value=haihong > 山东海红快递</option>
                  <option value=haimeng > 海盟速递</option>
                  <option value=haosheng > 昊盛物流</option>
                  <option value=hebeijianhua > 河北建华快递</option>
                  <option value=henglu > 恒路物流</option>
                  <option value=huaqi > 华企快递</option>
                  <option value=huaxialong > 华夏龙物流</option>
                  <option value=huayu > 天地华宇物流</option>
                  <option value=huiqiang > 汇强快递</option>
                  <option value=huitong > 汇通快递</option>
                  <option value=hwhq > 海外环球快递</option>
                  <option value=jiaji > 佳吉快运</option>
                  <option value=jiayi > 佳怡物流</option>
                  <option value=jiayunmei > 加运美快递</option>
                  <option value=jinda > 金大物流</option>
                  <option value=jingguang > 京广快递</option>
                  <option value=jinyue > 晋越快递</option>
                  <option value=jixianda > 急先达物流</option>
                  <option value=jldt > 嘉里大通物流</option>
                  <option value=kangli > 康力物流</option>
                  <option value=kcs > 顺鑫(KCS)快递</option>
                  <option value=kuaijie > 快捷快递</option>
                  <option value=kuayue > 跨越快递</option>
                  <option value=lejiedi > 乐捷递快递</option>
                  <option value=lianhaotong > 联昊通快递</option>
                  <option value=lijisong > 成都立即送快递</option>
                  <option value=longbang > 龙邦快递</option>
                  <option value=minbang > 民邦快递</option>
                  <option value=mingliang > 明亮物流</option>
                  <option value=minsheng > 闽盛快递</option>
                  <option value=nengda > 港中能达快递</option>
                  <option value=ocs > OCS快递</option>
                  <option value=pinganda > 平安达</option>
                  <option value=pingyou > 中国邮政平邮</option>
                  <option value=pinsu > 品速心达快递</option>
                  <option value=quanchen > 全晨快递</option>
                  <option value=quanfeng > 全峰快递</option>
                  <option value=quanjitong > 全际通快递</option>
                  <option value=quanritong > 全日通快递</option>
                  <option value=quanyi > 全一快递</option>
                  <option value=rpx > RPX保时达</option>
                  <option value=rufeng > 如风达快递</option>
                  <option value=saiaodi > 赛澳递</option>
                  <option value=santai > 三态速递</option>
                  <option value=scs > 伟邦(SCS)快递</option>
                  <option value=shengan > 圣安物流</option>
                  <option value=shengfeng > 盛丰物流</option>
                  <option value=shenghui > 盛辉物流</option>
                  <option value=shentong > 申通快递（可能存在延迟）</option>
                  <option value=shunfeng > 顺丰快递</option>
                  <option value=suijia > 穗佳物流</option>
                  <option value=sure > 速尔快递</option>
                  <option value=tiantian > 天天快递</option>
                  <option value=tnt > TNT快递</option>
                  <option value=tongcheng > 通成物流</option>
                  <option value=tonghe > 通和天下物流</option>
                  <option value=ups > UPS</option>
                  <option value=usps > USPS快递</option>
                  <option value=wanjia > 万家物流</option>
                  <option value=weitepai > 微特派</option>
                  <option value=xianglong > 祥龙运通快递</option>
                  <option value=xinbang > 新邦物流</option>
                  <option value=xinfeng > 信丰快递</option>
                  <option value=xiyoute > 希优特快递</option>
                  <option value=yad > 源安达快递</option>
                  <option value=yafeng > 亚风快递</option>
                  <option value=yibang > 一邦快递</option>
                  <option value=yinjie > 银捷快递</option>
                  <option value=yishunhang > 亿顺航快递</option>
                  <option value=yousu > 优速快递</option>
                  <option value=ytfh > 北京一统飞鸿快递</option>
                  <option value=yuancheng > 远成物流</option>
                  <option value=yuantong > 圆通快递</option>
                  <option value=yuanzhi > 元智捷诚</option>
                  <option value=yuefeng > 越丰快递</option>
                  <option value=yunda > 韵达快递</option>
                  <option value=yuntong > 运通中港快递</option>
                  <option value=ywfex > 源伟丰</option>
                  <option value=zhaijisong > 宅急送快递</option>
                  <option value=zhima > 芝麻开门快递</option>
                  <option value=zhongtie > 中铁快运</option>
                  <option value=zhongtong > 中通快递</option>
                  <option value=zhongxinda > 忠信达快递</option>
                  <option value=zhongyou > 中邮物流</option>
                </SELECT></td>
   <td class=b ><input type=text name=shipping_no[] size=30  ></td>
    <td class=b ><input type=text name=product_info[] size=50  ></td>
	 <td class=b ><SELECT  name=air_type[] >
                  <option value=1 > 普通</option>
				  <option value=2 > 敏感</option>
				   
				  
				 
				 
                </SELECT></td>
	  <td class=b ><SELECT  name=info[] >
                  <option value=1 > 拆包</option>
				  <option value=2  selected="selected"> 不拆包</option>
				   
				  
				 
				 
                </SELECT></td>
  </tr>
<?php
}
?> 




<tr><td colspan="5">
<a onclick='document.getElementById("abc").style.display="block"'  style="CURSOR: pointer" >显示更多</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a onclick='document.getElementById("abc").style.display="none"'  style="CURSOR: pointer" >隐藏更多</a>
</td></tr>

<tr><td colspan="5">

<div id="abc" style="display:none"> 

<table width=100% cellspacing=1 cellpadding=6>
<tr align=center>
  <td class=b >物流公司:</td>
   <td class=b >运单号码:</td>
    <td class=b >包裹内容:</td>
	 <td class=b >空运类型:</td>
	  <td class=b >备注:</td>
  </tr>
<?php
for($i=1;$i<=42;$i++)
{
?>
<tr align=center>
  <td class=b >


  <SELECT  name=company[] >
                    <option value=aae > AAE快递</option>
                  <option value=anjie > 安捷快递</option>
                  <option value=anxinda > 安信达快递</option>
                  <option value=aramex > Aramex国际快递</option>
                  <option value=benteng > 成都奔腾国际快递</option>
                  <option value=cces > CCES快递</option>
                  <option value=changtong > 长通物流</option>
                  <option value=chengguang > 程光快递</option>
                  <option value=chengji > 城际快递</option>
                  <option value=chengshi100 > 城市100</option>
                  <option value=chuanxi > 传喜快递</option>
                  <option value=chuanzhi > 传志快递</option>
                  <option value=citylink > CityLinkExpress</option>
                  <option value=coe > 东方快递</option>
                  <option value=cszx > 城市之星</option>
                  <option value=datian > 大田物流</option>
                  <option value=dayang > 大洋物流快递</option>
                  <option value=debang > 德邦物流</option>
                  <option value=dechuang > 德创物流</option>
                  <option value=dhl > DHL快递</option>
                  <option value=diantong > 店通快递</option>
                  <option value=dida > 递达快递</option>
                  <option value=disifang > 递四方速递</option>
                  <option value=dpex > DPEX快递</option>
                  <option value=dsu > D速快递</option>
                  <option value=ees > 百福东方物流</option>
                  <option value=ems > EMS快递</option>
                  <option value=fanyu > 凡宇快递</option>
                  <option value=fardar > Fardar</option>
                  <option value=fedex > 国际Fedex</option>
                  <option value=fedexcn > Fedex国内</option>
                  <option value=feibang > 飞邦物流</option>
                  <option value=feibao > 飞豹快递</option>
                  <option value=feihang > 原飞航物流</option>
                  <option value=feihu > 飞狐快递</option>
                  <option value=feiyuan > 飞远物流</option>
                  <option value=fengda > 丰达快递</option>
                  <option value=fkd > 飞康达快递</option>
                  <option value=gdyz > 广东邮政物流</option>
                  <option value=gnxb > 邮政国内小包</option>
                  <option value=gongsuda > 共速达物流|快递</option>
                  <option value=guotong > 国通快递</option>
                  <option value=haihong > 山东海红快递</option>
                  <option value=haimeng > 海盟速递</option>
                  <option value=haosheng > 昊盛物流</option>
                  <option value=hebeijianhua > 河北建华快递</option>
                  <option value=henglu > 恒路物流</option>
                  <option value=huaqi > 华企快递</option>
                  <option value=huaxialong > 华夏龙物流</option>
                  <option value=huayu > 天地华宇物流</option>
                  <option value=huiqiang > 汇强快递</option>
                  <option value=huitong > 汇通快递</option>
                  <option value=hwhq > 海外环球快递</option>
                  <option value=jiaji > 佳吉快运</option>
                  <option value=jiayi > 佳怡物流</option>
                  <option value=jiayunmei > 加运美快递</option>
                  <option value=jinda > 金大物流</option>
                  <option value=jingguang > 京广快递</option>
                  <option value=jinyue > 晋越快递</option>
                  <option value=jixianda > 急先达物流</option>
                  <option value=jldt > 嘉里大通物流</option>
                  <option value=kangli > 康力物流</option>
                  <option value=kcs > 顺鑫(KCS)快递</option>
                  <option value=kuaijie > 快捷快递</option>
                  <option value=kuayue > 跨越快递</option>
                  <option value=lejiedi > 乐捷递快递</option>
                  <option value=lianhaotong > 联昊通快递</option>
                  <option value=lijisong > 成都立即送快递</option>
                  <option value=longbang > 龙邦快递</option>
                  <option value=minbang > 民邦快递</option>
                  <option value=mingliang > 明亮物流</option>
                  <option value=minsheng > 闽盛快递</option>
                  <option value=nengda > 港中能达快递</option>
                  <option value=ocs > OCS快递</option>
                  <option value=pinganda > 平安达</option>
                  <option value=pingyou > 中国邮政平邮</option>
                  <option value=pinsu > 品速心达快递</option>
                  <option value=quanchen > 全晨快递</option>
                  <option value=quanfeng > 全峰快递</option>
                  <option value=quanjitong > 全际通快递</option>
                  <option value=quanritong > 全日通快递</option>
                  <option value=quanyi > 全一快递</option>
                  <option value=rpx > RPX保时达</option>
                  <option value=rufeng > 如风达快递</option>
                  <option value=saiaodi > 赛澳递</option>
                  <option value=santai > 三态速递</option>
                  <option value=scs > 伟邦(SCS)快递</option>
                  <option value=shengan > 圣安物流</option>
                  <option value=shengfeng > 盛丰物流</option>
                  <option value=shenghui > 盛辉物流</option>
                  <option value=shentong > 申通快递（可能存在延迟）</option>
                  <option value=shunfeng > 顺丰快递</option>
                  <option value=suijia > 穗佳物流</option>
                  <option value=sure > 速尔快递</option>
                  <option value=tiantian > 天天快递</option>
                  <option value=tnt > TNT快递</option>
                  <option value=tongcheng > 通成物流</option>
                  <option value=tonghe > 通和天下物流</option>
                  <option value=ups > UPS</option>
                  <option value=usps > USPS快递</option>
                  <option value=wanjia > 万家物流</option>
                  <option value=weitepai > 微特派</option>
                  <option value=xianglong > 祥龙运通快递</option>
                  <option value=xinbang > 新邦物流</option>
                  <option value=xinfeng > 信丰快递</option>
                  <option value=xiyoute > 希优特快递</option>
                  <option value=yad > 源安达快递</option>
                  <option value=yafeng > 亚风快递</option>
                  <option value=yibang > 一邦快递</option>
                  <option value=yinjie > 银捷快递</option>
                  <option value=yishunhang > 亿顺航快递</option>
                  <option value=yousu > 优速快递</option>
                  <option value=ytfh > 北京一统飞鸿快递</option>
                  <option value=yuancheng > 远成物流</option>
                  <option value=yuantong > 圆通快递</option>
                  <option value=yuanzhi > 元智捷诚</option>
                  <option value=yuefeng > 越丰快递</option>
                  <option value=yunda > 韵达快递</option>
                  <option value=yuntong > 运通中港快递</option>
                  <option value=ywfex > 源伟丰</option>
                  <option value=zhaijisong > 宅急送快递</option>
                  <option value=zhima > 芝麻开门快递</option>
                  <option value=zhongtie > 中铁快运</option>
                  <option value=zhongtong > 中通快递</option>
                  <option value=zhongxinda > 忠信达快递</option>
                  <option value=zhongyou > 中邮物流</option>
                </SELECT></td>
   <td class=b ><input type=text name=shipping_no[] size=30  ></td>
    <td class=b ><input type=text name=product_info[] size=50  ></td>
	 <td class=b ><SELECT  name=air_type[] >
                  <option value=1 > 普通</option>
				  <option value=2 > 敏感</option>
				   
				  
				 
				 
                </SELECT></td>
	  <td class=b ><SELECT  name=info[] >
                  <option value=1 > 拆包</option>
				  <option value=2 > 不拆包</option>
				   
				  
				 
				 
                </SELECT></td>
  </tr>
<?php
}
?> 
</table>
</div>
</td></tr>



 
 
<tr align=center>
<td  colspan="2" class=b >收货人资料：</td>
  <td colspan="3"  class=b  ><textarea name="shipping_info" cols="60" rows="6" id="info"></textarea></td>
   </tr>
   
<tr align=center>
<td  colspan="2" class=b >订单编号：</td>
  <td colspan="3" class=b  ><input type=text name=order_number size=30  ></td>
   </tr>
</table></td></tr>
</table>
<br><center><input type='submit' value='提交'></center></form>



















<?php include("bottom.html"); ?>
