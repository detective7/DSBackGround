<?php


/*
 * Created on 2016-4-8
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 * $response["success"]的意义：
 * 0：表示注册成功
 * 1：error 表示学号或教师号不存在
 * 2: error 表示学号已被注册
 * 3: error 注册失败
 */
include ("conn.php"); //连接数据库

//if (isset ($_POST['user_num']) && isset ($_POST['password']) && isset ($_POST['phone'])) {
$user_num = $_POST['user_num'];
$user_password = $_POST['password'];
$user_phone = $_POST['phone'];
$select_sql = "SELECT * FROM mydb.user_from_osystem WHERE user_number='" . $user_num . "';";
$select_sql2 = "SELECT * FROM mydb.users WHERE user_num='" . $user_num . "';";
$xinxi = $conn->query($select_sql);
$isSignin = $conn->query($select_sql2);
if ($isSignin->num_rows > 0) {
	$response["success"] = 2;
	$response["message"] = iconv("GB2312", "UTF-8//IGNORE", "学号已被注册");
	echo json_encode($response);
} else {
	if ($xinxi->num_rows > 0) {
		while ($row = $xinxi->fetch_assoc()) {
			//$response["success"] = 0;
			//$response["message"] = iconv("GB2312","UTF-8//IGNORE","学号存在且还未被注册");
			$insert_sql = "INSERT INTO users(user_num,password,phone) VALUES ('$user_num','$user_password','$user_phone');";
			//面向对象的数据插入
			if ($conn->query($insert_sql) === TRUE) {
				$response["success"] = 0;
				$response["message"] = iconv("GB2312", "UTF-8//IGNORE", "注册成功");
				$response["user_class"] = $row['user_class'];
				$response["user_status_id"] = $row['user_status_id'];
				echo json_encode($response);
				break;
			} else {
				$response["success"] = 3;
				//$response["message"] = iconv("GB2312", "UTF-8//IGNORE", "注册失败");
				$response["message"] = "Error: ". $conn->error;
				$response["user_class"] = $row['user_class'];
				$response["user_status_id"] = $row['user_status_id'];
				//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				echo json_encode($response);
				break;
			}

			//echo json_encode($response);

		}
	} else {
		$response["success"] = 1;
		$response["message"] = iconv("GB2312", "UTF-8//IGNORE", "学号不存在");
		echo json_encode($response);
	}
}
?>
