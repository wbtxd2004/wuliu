<?php
include_once("checksession.php");
include_once("../db.php");
$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r2=mysql_fetch_array($result);
?>

<html>
<head>
<title></title>
<meta http-equiv="content-type" content="text/html; charset=gb2312" >
<style type="text/css">
table { BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 2px}
select {
	FONT-SIZE: 12px;
	COLOR: #000000; background-color: #E0E2F1;
}
a { TEXT-DECORATION: none; color:#000000}
a:hover{ text-decoration: underline;}
body {font-family:Verdana;FONT-SIZE: 12px;MARGIN: 0;color: #000000;background: #F7F7F7;}
textarea,input,object{font-size: 12px;}
td { BORDER-RIGHT: 1px; BORDER-TOP: 0px; FONT-SIZE: 12px; COLOR: #000000;}
.b{background:#F7F7F7;}

.head { color: #ffffff;background: #739ACE;font-weight:bold;}
.head td{color: #ffffff;}
.head a{color: #ffffff;}
.head_2 {background: #CED4E8;}
.head_2 td{color: #000000;}
.left_padding{background:#F7F7F7;}
.hr  {border-top: 1px solid #739ACE; border-bottom: 0; border-left: 0; border-right: 0; }
.bold {font-weight:bold;}
.smalltxt {font-family: Tahoma, Verdana; font-size: 12px;color: #000000;}
.i_table{border: 1px solid #739ACE;background:#DEE3EF;}
</style>

<script language="JavaScript">
ifcheck = true;
function CheckAll(form)
{
	for (var i=0;i<form.elements.length-2;i++)
	{
		var e = form.elements[i];
		e.checked = ifcheck;
	}
	ifcheck = ifcheck == true ? false : true;
}
</script>
<!---->
</head>
<body topmargin=5 leftmargin=5>
<table width="99%" align=center cellspacing=2 cellpadding=4 border=0>
    <tr>
        <td class=head height=23 align=center>

            <a target=leftframe href="left.php"><b>��������ҳ</b></a> | 
            <a target="_top" href="logout.php"><b>�˳�</b></a>
        </td>
    </tr>
    <tr>
        <td class=b align=center>
            <a href="#" onClick="return ClearAdminDeploy()">+ ȫ��չ��</a> 
            <a href="#" onClick="return SetAdminDeploy()">- ȫ������</a>

        </td>
    </tr>
    <tr>
        <td>
            <table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
                <tr><td class=head><b>������Ϣ</b></td></tr>
                <tr>
                    <td class=left_padding>
                          
                        ��ǰ����Ա:<?php echo $r2[username]; ?><br>
                        ����:<?php if($r2[states]==2){ echo"��������Ա";}else  if($r2[states]==1){ echo"������Ա";}else  if($r2[states]==0){ echo"һ�����Ա";} ?><br>
                        
                    </td>
                </tr>
            </table>
        </td>
    </tr>
<!---->



<!---->
<?php
//}
?>

<tr><td>
<table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
    <tr>
        <td class=head height=18>
            <a style="float:right" href="#" onClick="return IndexDeploy('a0',1)">
                <img id="img_a0" src="./images/cate_fold.gif" border=0 alt='open'>
            </a>
            <b>�ʽ����</b>
        </td>

    </tr>
    <tbody id="cate_a0" style="">
    <tr>
		<td class=left_padding>
			<a href="addmoney.php" target="mainframe">��ʼ��ֵ</a><br>
			<a href="listmoney.php" target="mainframe">��ֵ�б�</a><br>
			
			<a href="addadmin.php" target="mainframe">����Ա����</a><br>



			
		</td>
	</tr>

    </tbody>
</table>
</td></tr>


<?php
//if($r2[job]=='yes')
//{
?>
<tr><td>
<table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
    <tr>
        <td class=head height=18>
            <a style="float:right" href="#" onClick="return IndexDeploy('a3',1)">
                <img id="img_a3" src="./images/cate_fold.gif" border=0 alt='open'>
            </a>

            <b>��������</b>
        </td>
    </tr>
    <tbody id="cate_a3" style="">
        <tr>
            <td class=left_padding>




<a href="addtags.php" target="mainframe">�����������</a><br><br>


<a href="listtags.php" target="mainframe">���������б�</a><br> <br>

  
 
<a href="addadmin.php" target="mainframe">��ӹ���Ա</a><br> 
 
			</td>
        </tr>
    </tbody>
</table>
</td></tr>

 
	<tr><td>
<table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
    <tr>
        <td class=head height=18>
            <a style="float:right" href="#" onClick="return IndexDeploy('a5',1)">
                <img id="img_a5" src="./images/cate_fold.gif" border=0 alt='open'>
            </a>

            <b>��������</b>
        </td>
    </tr>
    <tbody id="cate_a5" style="">
        <tr>
            <td class=left_padding>
                           
 

                

 
   
  
   
  <a href="listblock_id.php" target="mainframe">�����Ա�ID�б�</a><br>
  
   
  <a href="listblock_keyword.php" target="mainframe">���ιؼ����б�</a><br>

 
			</td>
        </tr>
    </tbody>
</table>
</td></tr>
 
	<tr>
        <td class=head_2 align=center>

            <b>manage</font></b>
        </td>
    </tr>
</table>
</td>
<script language="JavaScript" src="./javascript/Deploy.js"></script>
<script language="JavaScript" src="./javascript/DeployInit.js"></script>
<!---->