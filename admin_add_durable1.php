<?php
	session_start();
	require 'admin-c.php';
	require_once ("connectdb.php");

	$fileupload = $_POST['fileupload'];
	$field_id = $_POST['field_id'];
	$field_name = $_POST['field_name'];

	$field_date = $_POST['field_date'];
	$date = explode('-', $field_date);
	$field_date = implode('-', array($date[2], $date[1], $date[0]));

	$field_price = $_POST['field_price'];
	$field_detail = $_POST['field_detail'];
	$field_cat = $_POST['field_cat'];
	$field_room = $_POST['field_room'];

	for ($i = 0; $i < $_POST['field_c']; $i++) {

		date_default_timezone_set('Asia/Bangkok');
			$date = date("Ymd");
			$numrand = (mt_rand());
			$upload=$_FILES['fileupload'];

		if($upload <> ''){
			$path="assets/img/durable/";
			$type = strrchr($_FILES['fileupload']['name'],".");
			$newname = $date.$numrand.$type;
			$path_copy=$path.$newname;
			$path_link="assets/img/durable/".$newname;
			move_uploaded_file($_FILES['fileupload']['tmp_name'],$path_copy);
		}

		$strSQL = "INSERT INTO durable (du_img,du_id,du_name,du_price,du_datein,du_details,cat_id,room_id)
				   VALUES
				   ('$newname','$field_id','$field_name','$field_price','$field_date','$field_detail','$field_cat','$field_room')";
		$objQuery = mysql_query($strSQL);

			$field_id++;
	}
		if($objQuery>0){
			echo "<script>alert('คุณได้เพิ่มข้อมูลครุภัณฑ์เรียบร้อยแล้ว');</script>";
			echo "<script>window.location.href='manage_durable.php'</script>";
		}else{
			echo "<script>alert('ระบบไม่สามารถเพิ่มข้อมูลครุภัณฑ์ได้กรุณาทำรายการภายหลัง');</script>";
			echo "<script>history.back();</script>";
		}
?>
