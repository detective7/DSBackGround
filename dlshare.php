<?php
/*
 * 学生下载作业相关资料
 */
//include ("conn.php"); //连接数据库
ob_clean();
$filename = str_replace(" ", "", $_POST['mName']);
$filename = iconv("UTF-8","GB2312",$filename);
$filepath = "E:/PHPworkspace/uplodeShare/". $filename;
//判断文件是否存在
if(!file_exists($filepath)){
	echo "Error：文件不存在";
	return;
}
$fp=fopen($filepath,"r");

//取得文件大小
$files_size = filesize($filepath);
//echo $files_size;
header("Content-Type:application/octet-stream");
header("Accept-Ranges:bytes");
header("Accept-Length:".$files_size);
header("Content-Disposition:attachment; filename=$filename");

//echo fread($fp,$files_size);
//fclose($fp);
$buffer = 1024;
$buffer_count=0;

while(!feof($fp) && $files_size-$buffer_count>0){
	$data = fread($fp,$buffer);
	$buffer_count+=$buffer;
	echo $data;
}


?>