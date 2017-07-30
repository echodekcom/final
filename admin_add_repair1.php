<?php
session_start();
require_once ("connectdb.php");
	
foreach ($_POST['du_id'] as $key => $value) {


	$check = "SELECT * FROM repair  WHERE  id='".$_POST['du_id'][$key]."' AND repair_status =0";
	$result = mysql_query($check) ;
	$num = mysql_num_rows($result);
	
	if($num > 0){
		unset($_SESSION['cart1']);
		unset($_SESSION['qty1']);
		
		echo "<script>alert('ครุภัณฑ์นี้ถูกแจ้งซ่อมแล้ว');</script>";
		echo "<script>window.location.href='repair_info.php'</script>";
	}else{
	
		$strSQL = "INSERT INTO repair (mem_id,id,repair_detail) VALUES 
				   ('".$_GET["mem_id"]."','".$_POST['du_id'][$key]."','".$_POST['field_repair_detail']."')";
		
		$objQuery = mysql_query($strSQL);
	}
}
				
if($objQuery>0){
	unset($_SESSION['cart1']);
	unset($_SESSION['qty1']);
	
	echo "<script>alert('คุณได้แจ้งซ่อมครุภัณฑ์เรียบร้อยแล้ว');</script>";
	echo "<script>window.location.href='repair_mine.php'</script>";
}else{
	echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
	echo "<script>history.back();</script>";
}

?>
