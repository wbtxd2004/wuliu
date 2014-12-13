<?php
//include_once("checksession.php");
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=orders.xls");
header("<meta http-equiv=Content-Type content=textml; charset=gb2312>" );





include_once("../db.php");

mysql_query("SET NAMES 'GBK'");

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


 
