<?php
include_once("checksession.php");
include("header.html");
include_once("../db.php");


?>
<br>
<META http-equiv=Content-Type content=text/html;charset=utf-8>






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
 
<table width=70% align=center cellspacing=1 cellpadding=3 class=i_table>
<tr>
	<td class=head colspan=2>&nbsp;</td>
</tr>
<script language="JavaScript" src="./javascript/SendMessage.js"></script>
<tr align="center" class="head_1">
	<td width="25%">&nbsp;</td>
	<td width="46%">&nbsp;</td>
</tr>
                     
<tr align="center" class="head_1">
	<td width="25%">&nbsp;</td>
	<td width="46%">&nbsp;</td>
</tr>
<tr align=center class=b>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr align=center class=b>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr align=center class=b>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr align=center class=b>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr align=center class=b>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr align=center class=b>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr align=center class=b>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr align=center class=b>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr align=center class=b>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>


<tr align=center class=b>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table>
<br />
<br />
<?php include("bottom.html"); ?>
