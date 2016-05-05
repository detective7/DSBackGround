<?php


/*
 * Created on 2016-4-20
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include ("conn.php"); //连接数据库
$user_num = str_replace(" ", "", $_POST['user_num']); //接收客户端发来的username；
$user_class = str_replace(" ", "", $_POST['user_class']);
$select_sql = "select hw_id from pick_up where stu_id = '$user_num'";
$sql = "select * from work where class='$user_class'";
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$lineID = 0;
//	$int = 0;
	while ($row = $result->fetch_assoc()) {
		$hws = $conn->query($select_sql);
		$put_in = false;
//		$int=$int+1;
		while ($line = $hws->fetch_assoc()) {
//			echo $row['id_work']."????". $line['hw_id']."\n";
//			echo $int."\n";
			if ($row['id_work'] === $line['hw_id']) {
				$put_in = true;
			}
		}
//		echo $put_in."\n";
		if ($put_in === true) {
			$response[$lineID]["hw_id"] = $row['id_work'];
			$response[$lineID]["teacher"] = $row['tea_id'];
			$response[$lineID]["toClass"] = $row['class'];
			$response[$lineID]["title"] = $row['title'];
			$response[$lineID]["content"] = $row['text'];
			$response[$lineID]["material"] = $row['material'];
			$response[$lineID]["time"] = $row['time'];
			$lineID++;
		}

	}
//	echo $int;
	echo json_encode($response);
} else {
	echo "Error";
}
?>