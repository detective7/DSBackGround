<?php


/*
 * Created on 2016-4-8
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 * statu����3�����½ʧ��
 */
include ("conn.php"); //�������ݿ�
$user_num = str_replace(" ", "", $_POST['user_num']); //���տͻ��˷�����username��
$user_password = $_POST['password'];
$sql = "select password from users where user_num='$user_num'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		if ($user_password == $row['password']) {
			$response["success"] = 1;
			$response["message"] = iconv("GB2312", "UTF-8//IGNORE", "��½�ɹ�");
			//��ȡϵͳ��Ϣ
			$sql_xinxi = "SELECT * FROM mydb.user_from_osystem  where user_number='$user_num';";
			$xinxi = $conn->query($sql_xinxi);
			while ($row = $xinxi->fetch_assoc()) {
				$response["class"] = $row['user_class'];
				$response["statu"] = $row['user_status_id'];
				$response["department"] = $row['user_department'];
			}
			echo json_encode($response);
			break;
		} else {
			$response["success"] = 0;
			$response["statu"] = 3;
			$response["message"] = iconv("GB2312", "UTF-8//IGNORE", "�������");
			echo json_encode($response);
		}
	}
} else {
	$response["success"] = 0;
	$response["statu"] = 3;
	$response["message"] = iconv("GB2312", "UTF-8//IGNORE", "ѧ��δע��");
	echo json_encode($response);
}
?>
