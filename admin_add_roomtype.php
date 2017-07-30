<?php
session_start();
require 'admin-c.php';
require_once ("connectdb.php");

$room_type=$_POST['field_roomt_name'];
	
	$check = "SELECT roomt_name FROM room_type WHERE roomt_name='$room_type'";
	$result = mysql_query($check);
	$num = mysql_num_rows($result);
	if($num > 0){
		echo "<script>alert('ประเภทห้องนี้มีอยู่แล้ว กรุณาป้อนใหม่อีกครั้ง');</script>";
		echo "<script>history.back();</script>";
	}else{


$insert="INSERT INTO room_type (roomt_name) VALUES ('$room_type')";
$result=mysql_query($insert);

	if($result>0){
		echo "<script>alert('คุณได้เพิ่มข้อมูล ".$room_type." เรียบร้อยแล้ว');</script>";
		echo "<script>history.back();</script>";
			}else{
				echo "<script>alert('ระบบไม่สามารถเพิ่มข้อมูล ".$room_type." ได้กรุณาทำรายการภายหลัง');</script>";
				echo "<script>history.back();</script>";
				}
}				
?>
