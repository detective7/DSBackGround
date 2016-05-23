<?php
include ("conn.php"); // 连接数据库
$str_id = $_POST ['hw_id'];
$hw_id = intval ( $str_id );
$sql_t = "select user_from_osystem.user_number from `work`,pick_up,user_from_osystem
where `work`.id_work=$hw_id and `work`.id_work=pick_up.hw_id and pick_up.stu_id = user_from_osystem.user_number and `work`.class=user_from_osystem.user_class";
$sql_z = "SELECT user_from_osystem.user_number FROM user_from_osystem,`work` 
WHERE user_from_osystem.user_class=`work`.class AND `work`.id_work=$hw_id;";
// echo $hw_id;
$result_t = $conn->query ( $sql_t );
$t=0;
if ($result_t->num_rows > 0) {
	while ( $row = $result_t->fetch_assoc () ) {
		$t=$t+1;
	}
} 
$result_z = $conn->query ( $sql_z );
$z=0;
if ($result_z->num_rows > 0) {
	while ( $row = $result_z->fetch_assoc () ) {
		$z=$z+1;
	}
}
echo $t."/".$z;
?>