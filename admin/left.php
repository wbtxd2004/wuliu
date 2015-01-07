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
<meta http-equiv="content-type" content="text/html; charset=utf-8" >
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
            <a target=leftframe href="left.php"><b>管理区首页</b></a> | 
            <a target="_top" href="logout.php"><b>退出</b></a>
        </td>
    </tr>
    <tr>
        <td class=b align=center>
            <a href="#" onClick="return ClearAdminDeploy()">+ 全部展开</a> 
            <a href="#" onClick="return SetAdminDeploy()">- 全部收缩</a>
        </td>
    </tr>


    
    <tr>
        <td>
            <table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
                <tr>
                    <td class=head><b>管理信息</b></td>
                </tr>
                <tr>
                    <td class=left_padding>
                        当前管理员:<?php echo $r2[username]; ?><br>
                        级别:<?php if($r2[states]==1){ echo"超级管理员";}else  if($r2[states]==2){ echo"副超级管理员";}else  if($r2[states]==3){ echo"单位管理员";} ?><br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>




    <tr>
        <td>
            <table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
                <tr>
                    <td class=head height=18>
                        <a style="float:right" href="#" onClick="return IndexDeploy('a0',1)">
                        <img id="img_a0" src="./images/cate_fold.gif" border=0 alt='open'>
                        </a>
                        <b>会员管理</b>
                    </td>
                </tr>
                <tbody id="cate_a0" style="">
                    <tr>
                        <td class=left_padding>
                            <?php if($_SESSION[adminStates] < 3){ ?>
                            <a href="adddanwei.php" target="mainframe">添加单位</a><br>
                            <a href="listdanwei.php" target="mainframe">单位列表</a><br>
                            <a href="addadmin.php" target="mainframe">管理员添加</a><br>
                            <a href="listadmin.php" target="mainframe">管理员列表</a><br><br>
                            <?php } ?>
                            <a href="addmember.php" target="mainframe">添加会员</a><br>
                            <a href="listmember.php" target="mainframe">会员列表</a><br>
                            <a href="search_member.php" target="mainframe">会员搜索</a><br> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>


    <tr>
        <td>
            <table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
                <tr>
                    <td class=head height=18>
                        <a style="float:right" href="#" onClick="return IndexDeploy('a1',1)">
                        <img id="img_a1" src="./images/cate_fold.gif" border=0 alt='open'>
                        </a>
                        <b>新闻管理</b>
                    </td>
                </tr>
                <tbody id="cate_a1" style="">
                    <tr>
                        <td class=left_padding>
						<?php if($_SESSION[adminStates] != 1){ ?>
                            <a href="addnews_category.php" target="mainframe">新闻分类添加</a><br>
                            <a href="listnews_category.php" target="mainframe">新闻分类列表</a><br>
						  	
                            <a href="addnews.php" target="mainframe">新闻添加</a><br>
                           
						   <?php } ?>
						    <a href="listnews.php" target="mainframe">新闻列表</a><br>
                            <a href="search_news.php" target="mainframe">新闻搜索</a><br>
                            <a href="listnews_reply.php" target="mainframe">新闻评论列表</a><br>
							
							
							<a href="search_newsreply.php" target="mainframe">新闻评论搜索</a><br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>



    <tr>
        <td>
            <table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
                <tr>
                    <td class=head height=18>
                        <a style="float:right" href="#" onClick="return IndexDeploy('a2',1)">
                        <img id="img_a2" src="./images/cate_fold.gif" border=0 alt='open'>
                        </a>
                        <b>问答管理</b>
                    </td>
                </tr>
                <tbody id="cate_a2" style="">
                    <tr>
                        <td class=left_padding>
						<?php if($_SESSION[adminStates] != 1){ ?>
                            <a href="addask_category.php" target="mainframe">问答分类添加</a><br>
                            <a href="listask_category.php" target="mainframe">问答分类列表</a><br>
                            <a href="addask.php" target="mainframe">问答添加</a><br>
							 <?php } ?>
                            <a href="listask.php" target="mainframe">问答列表</a><br>
                            <a href="search_ask.php" target="mainframe">问答搜索</a><br>
                            <a href="listasks_reply.php" target="mainframe">问答回复列表</a><br> 
							<a href="search_askreply.php" target="mainframe">问答回复搜索</a><br>
							<a href="ask_tongji.php" target="mainframe">问答统计</a><br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>



    <tr>
        <td>
            <table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
                <tr>
                    <td class=head height=18>
                        <a style="float:right" href="#" onClick="return IndexDeploy('a3',1)">
                        <img id="img_a3" src="./images/cate_fold.gif" border=0 alt='open'>
                        </a>
                        <b>通讯录管理</b>
                    </td>
                </tr>
                <tbody id="cate_a3" style="">
                    <tr>
                        <td class=left_padding>
                            <a href="list_group.php" target="mainframe">查看群组</a><br>
                            <a href="add_group.php" target="mainframe">添加群组</a><br><br>
                            <a href="list_record.php" target="mainframe">查看记录</a><br>
                            <a href="add_record.php" target="mainframe">添加记录</a><br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <?php if($_SESSION[adminStates] == 1){ ?>
    <tr>
        <td>
            <table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
                <tr>
                    <td class=head height=18>
                        <a style="float:right" href="#" onClick="return IndexDeploy('a4',1)">
                        <img id="img_a4" src="./images/cate_fold.gif" border=0 alt='open'>
                        </a>
                        <b>私信管理</b>
                    </td>
                </tr>
                <tbody id="cate_a4" style="">
                    <tr>
                        <td class=left_padding>
                            <a href="add_admin_message.php" target="mainframe">添加私信（会员发管理员）</a><br>
                            <a href="add_member_message.php" target="mainframe">添加私信（管理员发会员）</a><br>
                            <a href="add_member_to_member.php" target="mainframe">添加私信（会员发会员）</a><br>
                            <a href="list_admin_message.php" target="mainframe">管理接收会员私信列表</a><br>
                            <a href="list_member_message.php" target="mainframe">会员接收管理员私信列表</a><br>
                            <a href="list_member_to_member.php" target="mainframe">会员之间私信列表</a><br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <?php } ?>

    <?php if($_SESSION[adminStates] == 1){ ?>
    <tr>
        <td>
            <table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
                <tr>
                    <td class=head height=18>
                        <a style="float:right" href="#" onClick="return IndexDeploy('a5',1)">
                        <img id="img_a5" src="./images/cate_fold.gif" border=0 alt='open'>
                        </a>
                        <b>公告管理</b>
                    </td>
                </tr>
                <tbody id="cate_a5" style="">
                    <tr>
                        <td class=left_padding>
                            <a href="addgonggao.php" target="mainframe">公告添加</a><br>
                            <a href="listgonggao.php" target="mainframe">公告列表</a><br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <?php } ?>

    <?php if($_SESSION[adminStates] == 1){ ?>
    <tr>
        <td>
            <table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
                <tr>
                    <td class=head height=18>
                        <a style="float:right" href="#" onClick="return IndexDeploy('a6',1)">
                        <img id="img_a6" src="./images/cate_fold.gif" border=0 alt='open'>
                        </a>
                        <b>广告管理</b>
                    </td>
                </tr>
                <tbody id="cate_a6" style="">
                    <tr>
                        <td class=left_padding>
                            <a href="list_guanggao.php" target="mainframe">查看广告</a><br>
                            <a href="add_guanggao.php" target="mainframe">添加广告</a><br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <?php } ?>

    <?php if($_SESSION[adminStates] == 1){ ?>
    <tr>
        <td>
            <table width=98% align=center cellspacing=1 cellpadding=4 class=i_table>
                <tr>
                    <td class=head height=18>
                        <a style="float:right" href="#" onClick="return IndexDeploy('a7',1)">
                        <img id="img_a7" src="./images/cate_fold.gif" border=0 alt='open'>
                        </a>
                        <b>数据库管理</b>
                    </td>
                </tr>
                <tbody id="cate_a7" style="">
                    <tr>
                        <td class=left_padding>
                            <a   onClick="if(confirm('are you sure?')) {return true;}else {return false;}"  href="database_data/backupall.php" target="mainframe">数据备份</a><br>
                            <a   onClick="if(confirm('你确定恢复数据吗？慎重操作！?')) {return true;}else {return false;}"  href="database_data/restoreall.php" target="mainframe">数据恢复</a><br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <?php } ?>

    <!--
    <tr>
        <td class=head_2 align=center>
            <b>manage</font></b>
        </td>
    </tr>
    -->

</table>
</td>
<script language="JavaScript" src="./javascript/Deploy.js"></script>
<script language="JavaScript" src="./javascript/DeployInit.js"></script>
<!---->