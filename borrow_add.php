<?php
session_start();

		require 'connectdb.php';

		$id=$_SESSION['mem_id'];

		$field_date = $_POST['startDate'];
		$_SESSION['startDate']= $field_date;
		$date = explode('/', $field_date);
		$field_date = implode('/', array($date[2], $date[1], $date[0]));


		$field_rdate = $_POST['endDate'];
		$_SESSION['endDate']= $field_rdate;
		$date = explode('/', $field_rdate);
		$field_rdate = implode('/', array($date[2], $date[1], $date[0]));

		$detail=$_POST['b_detail'];


		foreach ($_POST['du_id'] as $key) {

			$sql = "SELECT * FROM borrow_detail NATURAL JOIN borrow WHERE id=$key AND b_date <= '$field_date' AND bd_status=1";
			$query = mysql_query($sql);

			while($result=mysql_fetch_array($query)){
				if($result['b_rdate']>$field_date){
					$r++;
				}
			}
		}

		foreach ($_POST['du_id'] as $key) {

			$sql = "SELECT * FROM borrow_detail NATURAL JOIN borrow WHERE id=$key AND b_date > '$field_date' AND bd_status=1";
			$query = mysql_query($sql);

			while($result=mysql_fetch_array($query)){
				if($result['b_date']<$field_rdate){
					$t++;
				}
			}
		}

		$e=$r+$t;

		if ($e!=0) {

			echo "<script>alert('กรุณาตรวจสอบวันที่ยืม-คืนของคุณอีกครั้งอาจมีข้อมูลที่ชนกัน');</script>";
			echo "<script>history.back();</script>";

		}else{

			$meSql = "INSERT INTO borrow(mem_id,b_date,b_rdate,b_detail,b_status) values ('$id','$field_date','$field_rdate','$detail','1')";
			$meQeury = mysql_query($meSql);
			if ($meQeury) {
				$b_id = mysql_insert_id();

				for ($i = 0; $i < count($_POST['du_id']); $i++) {
					$du_id = mysql_real_escape_string($_POST['du_id'][$i]);
					$cat_id = mysql_real_escape_string($_POST['cat_id'][$i]);
					$lineSql = "INSERT INTO borrow_detail (id,b_id) ";
					$lineSql .= "VALUES (";
					$lineSql .= "'{$du_id}',";
					$lineSql .= "'{$b_id}'";
					$lineSql .= ") ";

					mysql_query($lineSql);

				}
				mysql_close();
				unset($_SESSION['cart']);
				unset($_SESSION['qty']);
				unset($_SESSION['startDate']);
				unset($_SESSION['endDate']);
				echo "<script>alert('คุณได้ทำการยืมครุภัณฑ์เรียบร้อยแล้ว');</script>";
				echo "<script>window.location.href='borrow_mine.php'</script>";
			}else{
				mysql_close();
				echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
				echo "<script>history.back();</script>";
			}

	}
?>
