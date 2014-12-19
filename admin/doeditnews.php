<?php
include("checksession.php");
include("header.html");
?>


<?php

include_once("../db.php");
$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";

$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);
if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}


$sql = "update news SET 
	biaoti='$_POST[biaoti]',
	admin_id='$_POST[admin_id]',
	danwei_id='$_POST[danwei_id]',
	cid='$_POST[cid]' ,
	info='$_POST[info]' 
	where tid='$_GET[tid]' ";
$rr = mysql_db_query($DataBase, $sql);




$checkimg=$_POST["checkimg"];
$num1=count($checkimg);

$current_date=date("Y-m-d");
$zoom_rate=0.5;

for($i=0;$i<$num1;$i++)
{
	$temp=$checkimg[$i];
	$query="SELECT filename FROM news_images WHERE tid=$temp";
	$result=mysql_db_query($DataBase,$query);
	$row=mysql_fetch_array($result);
	unlink("news_images/big/".$row["filename"]);
	unlink("news_images/small/".$row["filename"]);
	$query="DELETE FROM news_images WHERE `tid`=$temp";
	mysql_db_query($DataBase, $query);
}


$tid = $_GET[tid];
$num=count($_FILES["upload_file"]["name"]);
if($_FILES["upload_file"]["name"][0]!="")
{
	$dir1="news_images/big/";
	$dir2="news_images/small/";

	if(!file_exists($dir1.$current_date))
	{
		if(!mkdir($dir1.$current_date, 0777) || !mkdir($dir2.$current_date, 0777)){
			exit('错误：创建目录失败。'.$dir1.$current_date);
		}
	}
	$dir1=$dir1.$current_date."/";
	$dir2=$dir2.$current_date."/";



	$query="SELECT filename FROM news_images WHERE nid=$tid ORDER BY filename DESC LIMIT 1";
	$r = mysql_db_query($DataBase, $query);
	$row=mysql_fetch_array($r);
	$strpos = strrpos($row[filename], '_', -1);
	$offset = substr($row[filename], $strpos+1);
	$strpos = strrpos($offset, '.');
	$offset = substr($offset, 0, $strpos);

	for($i=0;$i<$num;$i++)
	{

		$tmp_name=$_FILES['upload_file']['tmp_name'][$i];
		$type=get_type($_FILES['upload_file']['name'][$i]);
		$f_name='4_'.$tid."_".($offset+$i+1).".".$type;
		$dirname=$dir1.$f_name;

		$insert_name=$current_date."/".$f_name;

		if( !move_uploaded_file($tmp_name,$dirname) )  {
			exit('错误：储存图片失败。');
		}

		if($type=="jpg" or $type=="jpeg")	$src_image=imagecreatefromjpeg($dirname);
		else if($type=="png") $src_image=imagecreatefrompng($dirname);
		else $src_image=imagecreatefromgif($dirname);
	    $srcw=ImageSX($src_image);
	    $srch=ImageSY($src_image);
		$dstw=$srcw*$zoom_rate;
		$dsth=$srch*$zoom_rate;

	    $dst_image=ImageCreateTrueColor($dstw,$dsth);
	    ImageCopyResized($dst_image,$src_image,0,0,0,0,$dstw,$dsth,$srcw,$srch);
	    if($type=="jpg" or $type=="jpeg") ImageJpeg($dst_image,$dir2.$f_name);
		else if($type=="png") Imagepng($dst_image,$dir2.$f_name);
		else Imagegif($dst_image,$dir2.$f_name);
		imagedestroy($dst_image);
		imagedestroy($src_image);
		$query="INSERT INTO news_images(`nid`,`filename`) VALUES('$tid','$insert_name') ";
		mysql_db_query($DataBase, $query);

	}
}


function get_ext($f_name)
{
	$ee=explode(".",$f_name);
	$cc=count($ee)-1;
	$type=strtolower($ee[$cc]);
	if($type!='jpg' and $type!='gif' and $type!='jpeg' and $type!='png')
	{
		echo"Please upload jpg / jpeg / gif /png image file.";
		exit;
	}
}
function get_type($f_name)
{
	$ee=explode(".",$f_name);
	$cc=count($ee)-1;
	$type=strtolower($ee[$cc]);
	return $type;
}



echo"修改新闻列表成功！";


echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=listnews.php'>";


?>

<META http-equiv=Content-Type content=text/html;charset=utf-8>

<?php include("bottom.html"); ?>