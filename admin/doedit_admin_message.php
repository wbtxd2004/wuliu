<?php
include("header.html");
include_once("checksession.php");


include_once("../db.php");

$query = "select * from beian_manage where username='$_SESSION[adminusername2]' ";
$result = mysql_db_query($DataBase, $query); 
$r8=mysql_fetch_array($result);

//echo $_SESSION[adminusername2];
//print_r($r8);

if($r8[states]!=1)
{
echo"不是超级管理员，不能操作";
exit;
}


$biaoti=$_POST["biaoti"];
$info=$_POST["info"];
$tid=$_GET["tid"];

$checkimg=$_POST["checkimg"];
$checkaudio=$_POST["checkaudio"];
$num1=count($checkimg);
$num2=count($checkaudio);


$current_date=date("Y-m-d");
$zoom_rate=0.5;

//echo $num;


for($i=0;$i<$num1;$i++)
{
	$temp=$checkimg[$i];
	$query="SELECT filename FROM admin_get_message_images WHERE tid=$temp";
	$result=mysql_db_query($DataBase,$query);
	$row=mysql_fetch_array($result);
	unlink("message_image/big/".$row["filename"]);
	unlink("message_image/small/".$row["filename"]);
	$query="DELETE FROM admin_get_message_images WHERE `tid`=$temp";
	mysql_db_query($DataBase, $query);
}

if($_FILES["upload_file"]["name"][0]!="")
{

$up_num=count($_FILES["upload_file"]["name"]);
echo $up_num;

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



$dir1="message_image/big/";
$dir2="message_image/small/";



if(!file_exists($dir1.$current_date))
{
	mkdir($dir1.$current_date);
	mkdir($dir2.$current_date);
}

$dir1=$dir1.$current_date."/";
$dir2=$dir2.$current_date."/";



$query="SELECT filename FROM admin_get_message_images WHERE mid=$tid";
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
	   $query="INSERT INTO admin_get_message_images(`mid`,`filename`) VALUES('$tid','$insert_name') ";
		mysql_db_query($DataBase, $query);
}

}

########添加声音片段，Changed By WuBin in 20141212######
for($i=0;$i<$num2;$i++)
{
	$temp2=$checkaudio[$i];
	$query2="SELECT filename FROM admin_get_message_images WHERE tid=$temp2";
	$result2=mysql_db_query($DataBase,$query2);
	$row2=mysql_fetch_array($result2);
	unlink("message_audio/".$row2["filename"]);
	//unlink("message_image/small/".$row2["filename"]);
	$query2="DELETE FROM admin_get_message_images WHERE `tid`=$temp2";
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



$dir1="message_audio/";

if(!file_exists($dir1.$current_date))
{
	mkdir($dir1.$current_date);
}

$dir1=$dir1.$current_date."/";


$query="SELECT filename FROM admin_get_message_images WHERE mid=$tid";
	$result2=mysql_db_query($DataBase,$query);
	$offset2=mysql_num_rows($result);

for($i=0;$i<$up_num2;$i++)
{

	$tmp_name=$_FILES['upload_file1']['tmp_name'][$i];
	$type=get_type2($_FILES['upload_file1']['name'][$i]);
	$f_name=$tid."_".($offset+$i+1).".".$type;
	$dirname=$dir1.$f_name;
	$insert_name=$current_date."/".$f_name;
	move_uploaded_file($tmp_name,$dirname);


	   $query="INSERT INTO admin_get_message_images(`mid`,`filename`,`filetype`) VALUES('$tid','$insert_name','1') ";
		mysql_db_query($DataBase, $query);
}




}
########Changed Over#########


$query="UPDATE admin_get_message SET `biaoti`='$biaoti',`info`='$info' WHERE `tid`='$tid'";
$result = mysql_db_query($DataBase, $query);
if($result){
echo"私信编辑成功！";
			
$uu="$_SERVER[HTTP_REFERER]"; 

echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=$uu'>";
}
?>
<?php include("bottom.html"); ?>