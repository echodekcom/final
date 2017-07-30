<?php
session_start();
require_once ("connectdb.php");


/*
1 =รอการอนุมัติ
2 =ok
3 =no ok
4 =return
*/

if($_GET["action"] == "ok"){

	foreach ($_POST['status'] as $key => $value) {

	$update = "UPDATE borrow_detail SET bd_status='".$_POST['status'][$key]."',bd_detail='".$_POST['bd_detail'][$key]."' WHERE bd_id = $key ";
	$query = mysql_query($update);

  }

	$select1 = "SELECT * FROM borrow_detail WHERE b_id = '".$_GET["b_id"]."' AND bd_status=1";
	$query1 = mysql_query($select1);

	while ($result1 = mysql_fetch_array($query1)) {

		$id=$result1['id'];

		$select2 = "SELECT * FROM borrow_detail NATURAL JOIN borrow WHERE b_id != '".$_GET["b_id"]."' AND bd_status=0 AND b_date='".$_POST['b_date']."' AND b_rdate='".$_POST['b_rdate']."'";

		$query2 = mysql_query($select2);

		while ($result2 = mysql_fetch_array($query2)) {

			$update3 = "UPDATE borrow_detail NATURAL JOIN borrow SET bd_status='2',bd_detail='ไม่ว่าง' WHERE id = $id AND b_id != '".$_GET["b_id"]."' AND b_date='".$_POST['b_date']."' AND b_rdate='".$_POST['b_rdate']."'";
			$query3 = mysql_query($update3);

		}

	}

	$updatee = "UPDATE borrow SET b_status=2 , msu_status=1 , msa_status=0 WHERE b_id = '".$_GET["b_id"]."' ";
	$queryy = mysql_query($updatee);

	$select="SELECT * FROM borrow_detail WHERE bd_status=1";
	$queryyy=mysql_query($select);
	while ($result=mysql_fetch_array($queryyy)){

	$id=$result['id'];

	$updateee = "UPDATE durable SET du_bstatus = 2 WHERE id = $id";
	$queryyyy = mysql_query($updateee);

	}

	if($queryyyy){
		echo "<script>alert('คุณได้ดำเนินการเรียบร้อยแล้ว');</script>";
		echo "<script>window.location.href='manage_borrow.php'</script>";
	}else{
		echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
		echo "<script>history.back();</script>";
	}

}else if($_GET["action"] == "return"){

	$update = "UPDATE borrow_detail SET bd_status='3' WHERE bd_id ='".$_GET["bd_id"]."' ";
	$query = mysql_query($update);

	$select="SELECT * FROM borrow_detail WHERE id='".$_GET["id"]."' AND bd_status = 1";
	$queryyy=mysql_query($select);
	$row=mysql_num_rows($queryyy);

		if ($row==0) {
			$updateee = "UPDATE durable SET du_bstatus = 0 WHERE id ='".$_GET["id"]."'";
			$queryyyy = mysql_query($updateee);
		}

		echo "<script>alert('คุณได้ทำการคืนครุภัณฑ์เรียบร้อยแล้ว');</script>";
		echo "<script>window.location.href='borrow_accept.php'</script>";
			
}else{
	echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
	echo "<script>history.back();</script>";
	}



?>
