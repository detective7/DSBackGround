<?php


/*
 * Created on 2016-4-20
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include ("conn.php"); //连接数据库
$user_num = str_replace(" ", "", $_POST['user_num']); //接收客户端发来的username；
$user_password = $_POST['password'];
$sql = "select password from users where user_num='$user_num' AND password='$user_password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$response["success"] = 1;
	$response["message"] = iconv("GB2312", "UTF-8//IGNORE", "登陆成功");
	//提取系统信息
	$sql_xinxi="SELECT * FROM mydb.user_from_osystem  where user_number='$user_num';";
	$xinxi = $conn->query($sql_xinxi);
	while($row=$xinxi->fetch_assoc()){
		$response["class"] =  $row['user_class'];
		$response["statu"] =  $row['user_status_id'];
		$response["department"] =  $row['user_department'];
	}
	$sql_class="select DISTINCT(user_class) from user_from_osystem WHERE user_class REGEXP '[0-9]'";
	$class = $conn->query($sql_class);
	$response["allClass"]="";
	while($row=$class->fetch_assoc()){
		$response["allClass"] = $response["allClass"].";" .$row['user_class'];
	}
	echo json_encode($response);
} else {
	$response["success"] = 0;
	$response["message"] = iconv("GB2312", "UTF-8//IGNORE", "学号错误");
	echo json_encode($response);
}
?>