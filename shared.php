<?php


/*
 * Created on 2016-4-20
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include ("conn.php"); //连接数据库

$sql = "select * from data";
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$lineID=0;
	while($row=$result->fetch_assoc()){
		$response[$lineID]["data_id"] =  $row['id_data'];
		$response[$lineID]["userId"] =  $row['user_id'];
		$response[$lineID]["title"] =  $row['title'];
		$response[$lineID]["content"] =  $row['text'];
		$response[$lineID]["mPath"] =  $row['path'];
		$response[$lineID]["mTime"] =  $row['time'];
		$lineID++;
	}
	echo json_encode($response);
} else {
	echo "Error";
}
?>