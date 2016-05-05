<?php


/*
 * Created on 2016-4-299
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include ("conn.php"); //连接数据库
$stu_id = $_POST['stu_id'];
$hw_id = $_POST['hw_id'];
//$filename = iconv("UTF-8//IGNORE", "GB2312",$_FILES["file"]["name"]);
$time = $_POST['time'];

if ($_FILES["file"]["error"] > 0) {
	//	$response["success"] = 1;
	//	$response["message"] = $_FILES["file"]["error"];
	echo "Error: " . $_FILES["file"]["error"] . ",false\n";
} else {
	//		echo "Upload: " . $_FILES["file"]["name"] . "\n";
	//		echo "Type: " . $_FILES["file"]["type"] . "\n";
	//		echo "Size: " . ($_FILES["file"]["size"] / 1048576) . " MB\n";
	//		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "\n";

	$filename = iconv("UTF-8//IGNORE", "GB2312", $_FILES["file"]["name"]);
	$path = "E:/PHPworkspace/pickUpFile/" . $filename;

	if (file_exists($path)) {
		echo iconv("GB2312", "UTF-8//IGNORE", "Error: 已存在") . $_FILES["file"]["name"] . ",false\n";
	} else {
//		echo $path;
		$insert_sql = "INSERT INTO mydb.pick_up (`hw_id`, `stu_id`, `path`, `time`) VALUES ('$hw_id','$stu_id','$path','$time');";
		if ($conn->query($insert_sql) === TRUE) {
			move_uploaded_file($_FILES["file"]["tmp_name"], $path);
			echo "Stored in: " . $path . ",success\n";
		} else {
			echo "Error: " .$conn->error. ",false\n";
		}
	}
}
?>