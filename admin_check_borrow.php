<?php
include("connectdb.php");

if ($_GET['startDate']) {

	$field_date = $_GET['startDate'];
	$date = explode('-', $field_date);
	$field_date = implode('-', array($date[2], $date[1], $date[0]));


	$sql = "SELECT * FROM borrow_detail NATURAL JOIN borrow WHERE b_rdate = '$field_date' AND bd_status=1";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num != 0){
		echo "false,<span style='color:red'>ชื่อนี้มีผู้ใช้งานแล้ว!!!</span>";	
	}
	else{
		echo "true,<span style='color:green'>ชื่อนี้ใช้งานได้</span>";
	}

}else{

	$field_rdate = $_GET['endDate'];
	$date = explode('-', $field_rdate);
	$field_rdate = implode('-', array($date[2], $date[1], $date[0]));


	$sql = "SELECT * FROM borrow_detail NATURAL JOIN borrow WHERE b_date = '$field_rdate' AND bd_status=1";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num != 0){
		echo "false,<span style='color:red'>ชื่อนี้มีผู้ใช้งานแล้ว!!!</span>";	
	}
	else{
		echo "true,<span style='color:green'>ชื่อนี้ใช้งานได้</span>";
	}
}
?>
