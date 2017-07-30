<?php
session_start();
require 'admin-c.php';
require_once ("connectdb.php");


if($_GET["Action"] == "dd"){

	$check = "SELECT du_bstatus FROM durable WHERE id='".$_GET["id"]."'";
	$query = mysql_query($check);
	$result = mysql_fetch_array($query);
	
	if($result['du_bstatus']==1){
		echo "<script>alert('ไม่สามารถลบครุภันฑ์นี้ได้เนื่องจากมีคนยืมอยู่ !');</script>";
		echo "<script>history.back();</script>";
	}else{
            
   	$del="DELETE FROM durable WHERE id='".$_GET["id"]."'";
	$result=mysql_query($del);

	if ($result){
			echo "<script>alert('คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว');</script>";
			echo "<script>history.back();</script>";
			}
		else{
			echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
			echo "<script>history.back();</script>";
			}
	} 
}

else if ($_GET["Action"] == "db") {
	
	$del1="UPDATE durable NATURAL JOIN room NATURAL JOIN building SET room_id='1' WHERE build_id='".$_GET["build_id"]."' ";	
	$result1=mysql_query($del1);
	$del2="DELETE FROM room WHERE build_id='".$_GET["build_id"]."'";
	$result2=mysql_query($del2);
	$del3="DELETE FROM building WHERE build_id='".$_GET["build_id"]."'";
	$result3=mysql_query($del3);
	

	if ($result3 > 0){
			echo "<script>alert('คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว');</script>";
			echo "<script>history.back();</script>";
			}
		else{
			echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
			echo "<script>history.back();</script>";
			}
}

else if ($_GET["Action"] == "dr") {
	
	$del="DELETE FROM room WHERE room_id='".$_GET["room_id"]."'";
	$result=mysql_query($del);
	$update="UPDATE durable SET room_id = '1' WHERE room_id='".$_GET["room_id"]."'";
	$result=mysql_query($update);

	if ($result > 0){
			echo "<script>alert('คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว');</script>";
			echo "<script>history.back();</script>";
			}
		else{
			echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
			echo "<script>history.back();</script>";
			}
}

else if ($_GET["Action"] == "dc") {

	$check = "SELECT cat_id FROM durable WHERE cat_id='".$_GET["cat_id"]."'";
	$query = mysql_query($check);
	$num = mysql_num_rows($query);
	
	if($num > 0){
		echo "<script>alert('ไม่สามารถลบประเภทนี้ได้เนื่องจากมีครุภัณฑ์อยู่ในประเภทนี้ !');</script>";
		echo "<script>history.back();</script>";
	}else{
	
	$del="DELETE FROM category WHERE cat_id='".$_GET["cat_id"]."'";
	$result=mysql_query($del);

	if ($result > 0){
			echo "<script>alert('คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว');</script>";
			echo "<script>history.back();</script>";
			}
		else{
			echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
			echo "<script>history.back();</script>";
			}
	}
}

else if ($_GET["Action"] == "drt") {

	$check = "SELECT roomt_id FROM room WHERE roomt_id='".$_GET["roomt_id"]."'";
	$query = mysql_query($check);
	$num = mysql_num_rows($query);
	
	if($num > 0){
		echo "<script>alert('ไม่สามารถลบประเภทนี้ได้เนื่องจากมีห้องอยู่ในประเภทนี้ !');</script>";
		echo "<script>history.back();</script>";
		
	}else{
	
	$del="DELETE FROM room_type WHERE roomt_id='".$_GET["roomt_id"]."'";
	$result=mysql_query($del);

	if ($result > 0){
			echo "<script>alert('คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว');</script>";
			echo "<script>history.back();</script>";
			}
		else{
			echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
			echo "<script>history.back();</script>";
			}
	}
}
?>

