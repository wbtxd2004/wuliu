<?php
$str="短信内容测试的";
echo $str."</br>";
echo mb_convert_encoding($str, "UTF-8","auto");


?>