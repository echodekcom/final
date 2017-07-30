<?php 
session_start();
require 'admin-c.php';
require_once ("connectdb.php");

$cat_name=$_POST['field_cat_name'];

	$check = "SELECT cat_name FROM category WHERE cat_name='$cat_name'";
	$result = mysql_query($check);
	$num = mysql_num_rows($result);
	if($num > 0){
		echo "<script>alert('ประเภทนี้มีอยู่แล้ว กรุณาป้อนใหม่อีกครั้ง');</script>";
		echo "<script>history.back();</script>";
	}else{

$insert="INSERT INTO category (cat_name) VALUES ('$cat_name')";
$result=mysql_query($insert);

	if($result>0){
		echo "<script>alert('คุณได้เพิ่มข้อมูล ".$cat_name." เรียบร้อยแล้ว');</script>";
		echo "<script>window.location.href='manage_category.php'</script>";
			}else{
				echo "<script>alert('ระบบไม่สามารถเพิ่มข้อมูล ".$cat_name." ได้กรุณาทำรายการภายหลัง');</script>";
				echo "<script>history.back();</script>";
				}
}				
?>
