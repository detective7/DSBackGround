<?php
/*
 * ѧ��������ҵ�������
 */
//include ("conn.php"); //�������ݿ�
ob_clean();
$filename = str_replace(" ", "", $_POST['mName']);
$filename = iconv("UTF-8","GB2312",$filename);
$filepath = "E:/PHPworkspace/uplodeShare/". $filename;
//�ж��ļ��Ƿ����
if(!file_exists($filepath)){
	echo "Error���ļ�������";
	return;
}
$fp=fopen($filepath,"r");

//ȡ���ļ���С
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