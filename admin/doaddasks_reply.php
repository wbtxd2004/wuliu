<?php
include_once("checksession.php");
include("header.html");
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

/*
$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);
if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}
*/

?>

<?php

/*** input data start ***/

$member_id = $_SESSION[memberId];
$ip = $_SERVER["REMOTE_ADDR"];
$dtime = date("Y-m-d H:i:s");

$query = "
	INSERT INTO ask_reply (asks_id, info, member_id, ip, dtime) 
	VALUES ('$_POST[asks_id]','$_POST[info]', '$member_id', '$ip', '$dtime');
	";

$result = mysql_db_query($DataBase, $query);
if(!$result){
	echo"操作失败！";
}

/* 评论后，问答的回复数，会加1 **/
$query = "SELECT reply_num FROM asks WHERE tid = $_POST[asks_id];";
$result = mysql_db_query($DataBase, $query);
$r=mysql_fetch_array($result);

$reply_num = $r['reply_num'];
$reply_num ++;

$query = "UPDATE asks SET `reply_num` = '$reply_num' WHERE tid = $_POST[asks_id];";
$result = mysql_db_query($DataBase, $query);

/*** input data end ***/

$query = 'SELECT MAX(tid) AS tid FROM ask_reply';
$result = mysql_db_query($DataBase, $query);
$r=mysql_fetch_array($result);
$tid = $r['tid'];


/*** attachment start ***/

$checkimg=$_POST["checkimg"];
$checkaudio=$_POST["checkaudio"];
$num1=count($checkimg);
$num2=count($checkaudio);
$current_date=date("Y-m-d");
$zoom_rate=0.5;



for($i=0;$i<$num1;$i++)
{
	$temp=$checkimg[$i];
	$query="SELECT filename FROM ask_reply_images WHERE tid=$temp";
	$result=mysql_db_query($DataBase,$query);
	$row=mysql_fetch_array($result);
	unlink("ask_reply_images/big/".$row["filename"]);
	unlink("ask_reply_images/small/".$row["filename"]);
	$query="DELETE FROM ask_reply_images WHERE `tid`=$temp";
	mysql_db_query($DataBase, $query);
}



if($_FILES["upload_file"]["name"][0]!="")
{

$up_num=count($_FILES["upload_file"]["name"]);
//echo '$up_num = '.$up_num.'<br>';

if($up_num>10)
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
for($i=0;$i<$up_num;$i++)
{
	get_size($_FILES['upload_file']['size'][$i]);
	get_ext($_FILES['upload_file']['name'][$i]);
}



$dir1="ask_reply_images/big/";
$dir2="ask_reply_images/small/";



if(!file_exists($dir1.$current_date))
{
	mkdir($dir1.$current_date);
	mkdir($dir2.$current_date);
}

$dir1=$dir1.$current_date."/";
$dir2=$dir2.$current_date."/";



$query="SELECT filename FROM ask_reply_images WHERE ask_reply_id=$tid";
	$result=mysql_db_query($DataBase,$query);
	$offset=mysql_num_rows($result);

for($i=0;$i<$up_num;$i++)
{

	$tmp_name=$_FILES['upload_file']['tmp_name'][$i];
	$type=get_type($_FILES['upload_file']['name'][$i]);
	$f_name=$tid."_".($offset+$i+1).".".$type;
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
	   $query="INSERT INTO ask_reply_images(`ask_reply_id`,`filename`) VALUES('$tid','$insert_name') ";
		mysql_db_query($DataBase, $query);
}

}

########添加声音片段，Changed By WuBin in 20141212######
for($i=0;$i<$num2;$i++)
{
	$temp2=$checkaudio[$i];
	$query2="SELECT filename FROM ask_reply_images WHERE tid=$temp2";
	$result2=mysql_db_query($DataBase,$query2);
	$row2=mysql_fetch_array($result2);
	unlink("ask_reply_audio/".$row2["filename"]);
	$query2="DELETE FROM ask_reply_images WHERE `tid`=$temp2";
	mysql_db_query($DataBase, $query2);
}

if($_FILES["upload_file1"]["name"][0]!="")
{

$up_num2=count($_FILES["upload_file1"]["name"]);
echo $up_num2;

if($up_num2>2)
{
	echo"<script>alert('附件超过2个，请重新输入！');history.go(-1);</script>";
	exit;
}

function get_size2($f_size)
{
	if($f_size>2071520)
	{
		echo"<script>alert('附件大小不能大于2M，请重新输入！');history.go(-1);</script>";
		exit;
	}
}
function get_ext2($f_name)
{
	$ee=explode(".",$f_name);
	$cc=count($ee)-1;
	$type=strtolower($ee[$cc]);
	if($type!='wav' and $type!='mp3' and $type!='wma' and $type!='rm')
	{
		echo"Please upload wav / mp3 / wma /rm image file.";
		exit;
	}
}
function get_type2($f_name)
{
	$ee=explode(".",$f_name);
	$cc=count($ee)-1;
	$type=strtolower($ee[$cc]);
	return $type;
}
for($i=0;$i<$up_num2;$i++)
{
	get_size2($_FILES['upload_file1']['size'][$i]);
	get_ext2($_FILES['upload_file1']['name'][$i]);
}



$dir1="ask_reply_audio/";

if(!file_exists($dir1.$current_date))
{
	mkdir($dir1.$current_date);
}

$dir1=$dir1.$current_date."/";


$query="SELECT * FROM ask_reply_images WHERE ask_reply_id='$tid'";
$result2=mysql_db_query($DataBase,$query);
$offset2=mysql_num_rows($result2);
//exit;
for($i=0;$i<$up_num2;$i++)
{

	$tmp_name=$_FILES['upload_file1']['tmp_name'][$i];
	$type=get_type2($_FILES['upload_file1']['name'][$i]);
	$f_name=$tid."_".($offset2+$i+1).".".$type;
	$dirname=$dir1.$f_name;
	$insert_name=$current_date."/".$f_name;
	move_uploaded_file($tmp_name,$dirname);


	   $query="INSERT INTO ask_reply_images(`ask_reply_id`,`filename`,`filetype`) VALUES('$tid','$insert_name','1') ";
	   //echo $query ;
		mysql_db_query($DataBase, $query);
}




}


/*** attachment end ***/


echo"问题评论添加成功！";
echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=viewasks.php?tid=$_POST[asks_id]'>";
?>

<META http-equiv=Content-Type content=text/html;charset=utf-8>
<?php include("bottom.html"); ?>