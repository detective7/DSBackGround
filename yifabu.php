<?php


/*
 * Created on 2016-4-20
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include ("conn.php"); //连接数据库
$user_num = str_replace(" ", "", $_POST['user_num']); //接收客户端发来的username；
$sql = "select * from work where tea_id='$user_num'";
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$lineID=0;
	while($row=$result->fetch_assoc()){
		$response[$lineID]["hw_id"] =  $row['id_work'];
		$response[$lineID]["teacher"] =  $row['tea_id'];
		$response[$lineID]["toClass"] =  $row['class'];
		$response[$lineID]["title"] =  $row['title'];
		$response[$lineID]["content"] =  $row['text'];
		$response[$lineID]["material"] =  $row['material'];
		$response[$lineID]["time"] =  $row['time'];
		$lineID++;
	}
	echo json_encode($response);
} else {
	echo "Error";
}
?>