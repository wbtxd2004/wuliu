<?php
include_once("checksession.php");


include_once("../db.php");
/*if($_POST[username]!='')
{
$query = "select * from beian_manage where username='$_POST[username]' ";
$result = mysql_db_query($DataBase, $query); 
if($r2=mysql_fetch_array($result))
{
echo"<script>alert('该管理员已经存在！');history.go(-1);</script>";
exit;
}
}*/

$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);
if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}



?>

<?php
$biaoti=$_POST["biaoti"];
$info=$_POST["info"];
$member_id=$_POST["member_id"];
$admin_id=$_SESSION["adminusername2"];

$ip= $_SERVER["REMOTE_ADDR"];
$dtime=date("Y-m-d H:i:s");

$current_date=date("Y-m-d");
$zoom_rate=0.5;


if($_FILES["upload_file"]["name"][0]!="")
{
$num=count($_FILES["upload_file"]["name"]);
if($num>10)
{
	echo"<script>alert('附件超过10个，请重新输入！');history.go(-1);</script>";
	exit;
}

function get_size($f_size)
{
	if($f_size>2071520)
	{
		echo"<script>alert('附件大小不能大于2M，请重新输入！');history.go(-1);</script>";
		exit;
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
for($i=0;$i<$num;$i++)
{
	get_size($_FILES['upload_file']['size'][$i]);
	get_ext($_FILES['upload_file']['name'][$i]);
}
}







$query = "INSERT INTO news (biaoti,admin_id,danwei_id,cid,info,ip,dtime) VALUES ('$_POST[biaoti]','$r8[tid]','$_POST[danwei_id]','$_POST[cid]','$_POST[info]','$ip','$dtime')";
$result = mysql_db_query($DataBase, $query);
if($result){
echo"新闻添加成功！";
			
echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=listnews.php'>";
}


$tid=mysql_insert_id();

if($_FILES["upload_file"]["name"][0]!="")
{
$dir1="news_images/big/";
$dir2="news_images/small/";



if(!file_exists($dir1.$current_date))
{
	mkdir($dir1.$current_date);
	mkdir($dir2.$current_date);
}

$dir1=$dir1.$current_date."/";
$dir2=$dir2.$current_date."/";


for($i=0;$i<$num;$i++)
{

	$tmp_name=$_FILES['upload_file']['tmp_name'][$i];
	$type=get_type($_FILES['upload_file']['name'][$i]);
	$f_name=$tid."_".($i+1).".".$type;
	$dirname=$dir1.$f_name;
	$insert_name=$current_date."/".$f_name;
	move_uploaded_file($tmp_name,$dirname);
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
?>


<META http-equiv=Content-Type content=text/html;charset=utf-8>