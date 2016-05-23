<?php


/*
 * Created on 2016-4-299
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include ("conn.php"); //连接数据库
$user_id = $_POST['user_id'];
$title = $_POST['title'];
$content = $_POST['content'];
$time = $_POST['time'];
$select_sql = "SELECT * FROM mydb.data WHERE title='" . $title . "';";

if ($_FILES["file"]["name"] === null) {
		echo "false" . "\n";
} else {
	if ($_FILES["file"]["error"] > 0) {
		//	$response["success"] = 1;
		//	$response["message"] = $_FILES["file"]["error"];
		echo "Error: " . $_FILES["file"]["error"] . ",false\n";
	} else {
		//		echo "Upload: " . $_FILES["file"]["name"] . "\n";
		//		echo "Type: " . $_FILES["file"]["type"] . "\n";
		//		echo "Size: " . ($_FILES["file"]["size"] / 1048576) . " MB\n";
		//		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "\n";

		$filename = iconv("UTF-8//IGNORE", "GB2312",$_FILES["file"]["name"]);

		$insert_sql2 = "INSERT INTO `mydb`.`data` (`user_id`, `title`, `text`,`path`, `time`) " .
		"VALUES ('" . $user_id . "', '" . $title . "', '" . $content . "', '" . "E:/PHPworkspace/uplodeShare/" . $_FILES["file"]["name"] . "', '" . $time . "');";
		if (file_exists("E:/PHPworkspace/uplodeShare/" . $filename)) {
			echo iconv("GB2312", "UTF-8//IGNORE", "Error: 数据库已存在" ). $_FILES["file"]["name"] . ",false\n";
		} else {

			move_uploaded_file($_FILES["file"]["tmp_name"], "E:/PHPworkspace/uplodeShare/" . $filename);
			if ($conn->query($insert_sql2) === TRUE) {
				echo "File,success" . "\n";
			} else {
				echo "File,false" . "\n";
			}
			echo "Stored in: " . "E:/PHPworkspace/uplodeShare/" . $_FILES["file"]["name"] . ",success\n";
		}
	}
}
?>