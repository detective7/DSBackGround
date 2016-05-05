<?php
include ("conn.php"); //连接数据库
$hw_id = $_POST['hw_id'];
$sql_t= "select pick_up.stu_id from `work`,pick_up,user_from_osystem "
		."where `work`.id_work=27 and `work`.id_work=pick_up.hw_id and pick_up.stu_id = user_from_osystem.user_number and `work`.class=user_from_osystem.user_class"
?>