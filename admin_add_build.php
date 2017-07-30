<?php 
session_start();
require 'admin-c.php';
require_once ("connectdb.php");

$build_name=$_POST['field_build_name'];

	$check = "SELECT build_name FROM building WHERE build_name='$build_name'";
	$result = mysql_query($check);
	$num = mysql_num_rows($result);
	if($num > 0){
		echo "<script>alert('อาคารนี้มีอยู่แล้ว กรุณาป้อนใหม่อีกครั้ง');</script>";
		echo "<script>window.location.href='manage_building.php'</script>";
	}else{

$insert="INSERT INTO building (build_name) VALUES ('$build_name')";
$result=mysql_query($insert);

	if($result>0){
		echo "<script>alert('คุณได้เพิ่มข้อมูล ".$build_name." เรียบร้อยแล้ว');</script>";
		echo "<script>window.location.href='manage_building.php'</script>";
			}else{
				echo "<script>alert('ระบบไม่สามารถเพิ่มข้อมูล ".$build_name." ได้กรุณาทำรายการภายหลัง');</script>";
				echo "<script>history.back();</script>";
				}
}				
?>
