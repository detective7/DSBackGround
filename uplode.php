<?php


/*
 * Created on 2016-4-299
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include ("conn.php"); //连接数据库
$ted_id = $_POST['ted_id'];
$toClass = $_POST['toClass'];
$title = $_POST['title'];
$content = $_POST['content'];
$time = $_POST['time'];
$select_sql = "SELECT * FROM mydb.work WHERE title='" . $title . "';";
$insert_sql1 = "INSERT INTO `mydb`.`work` (`tea_id`, `class`, `title`, `text`, `time`) " .
"VALUES ('" . $ted_id . "', '" . $toClass . "', '" . $title . "', '" . $content . "', '" . $time . "');";

if ($_FILES["file"]["name"] === null) {
	if ($conn->query($insert_sql1) === TRUE) {
		//echo $ted_id . "\n" . $toClass . "\n" . $title . "\n" . $content . "\n" . $time . "\n";
		echo "noFile,success" . "\n";
	} else {
		echo "noFile,false" . "\n";
	}

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

		$insert_sql2 = "INSERT INTO `mydb`.`work` (`tea_id`, `class`, `title`, `text`,`material`, `time`) " .
		"VALUES ('" . $ted_id . "', '" . $toClass . "', '" . $title . "', '" . $content . "', '" . "E:\/PHPworkspace\/uplodeFile\/" . $_FILES["file"]["name"] . "', '" . $time . "');";
		if (file_exists("E:\PHPworkspace\uplodeFile\\" . $filename)) {
			echo iconv("GB2312", "UTF-8//IGNORE", "Error: 数据库已存在" ). $_FILES["file"]["name"] . ",false\n";
		} else {

			move_uploaded_file($_FILES["file"]["tmp_name"], "E:\PHPworkspace\uplodeFile\\" . $filename);
			if ($conn->query($insert_sql2) === TRUE) {
				echo "File,success" . "\n";
			} else {
				echo "File,false" . "\n";
			}
			echo "Stored in: " . "E:\PHPworkspace\uplodeFile\\" . $_FILES["file"]["name"] . ",success\n";
		}
	}
}
?>