<?php

/*
 * Created on 2016-4-8
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "myDB";

// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
//$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
	die("Connection failed:" . $conn->connect_error);
}
//echo "Connected successfully" . "<br>";

//$sql = "CREATE DATABASE myDB";
//$sql2 = "DROP DATABASE myDB";
//if ($conn->query($sql) === TRUE) {
//	echo "DATABASE created successfully";
//} else {
//	//	$conn->query($sql2);
//	echo "Error creating database:" . $conn->error;
//}
//
//$conn->close();
?>
