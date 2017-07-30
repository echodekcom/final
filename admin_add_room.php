<?php
session_start();
require 'admin-c.php';
require_once ("connectdb.php");

$build_id=$_GET["build_id"];
$room_name=$_POST['field_room_name'];
$room_type=$_POST['field_room_type'];

	$check = "SELECT room_name FROM room WHERE room_name='$room_name'";
	$result = mysql_query($check);
	$num = mysql_num_rows($result);
	if($num > 0){
		echo "<script>alert('ห้องนี้มีอยู่แล้ว กรุณาป้อนใหม่อีกครั้ง');</script>";
		echo "<script>history.back();</script>";
	}else{


$insert="INSERT INTO room (build_id,roomt_id,room_name) VALUES ('$build_id','$room_type','$room_name')";
$result=mysql_query($insert);

	if($result>0){
		echo "<script>alert('คุณได้เพิ่มข้อมูล ".$room_name." เรียบร้อยแล้ว');</script>";
		echo "<script>history.back();</script>";
			}else{
				echo "<script>alert('ระบบไม่สามารถเพิ่มข้อมูล ".$room_name." ได้กรุณาทำรายการภายหลัง');</script>";
				echo "<script>history.back();</script>";
				}
}				
?>
