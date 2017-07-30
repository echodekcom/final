<?php
session_start();
require_once ("connectdb.php");


if($_POST["show"] == '2'){
	$update_repair="UPDATE repair SET repair_status=3,repair_bdetail='".$_POST['repair_bdetail2']."' , user_status_read=4 WHERE repair_id='".$_GET["repair_id"]."' ";
	$query_repair=mysql_query($update_repair);

	$update_durable="UPDATE durable SET du_status='ใช้การไม่ได้/เสีย' WHERE id='".$_GET["du_id"]."' ";
	$query_durable=mysql_query($update_durable);
	if($query_durable>0){
		echo "<script>alert('คุณได้บันทึก ".เสีย." ครุภัณฑ์นี้แล้ว');</script>";
		echo "<script>window.location.href='repair_info.php'</script>";
			}else{
				echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
				echo "<script>history.back();</script>";
				}

}else if($_POST["show"] == '1'){
	$update_repair="UPDATE repair SET repair_status=2 , repair_bdetail='".$_POST['repair_bdetail1']."' , user_status_read=3 WHERE repair_id='".$_GET["repair_id"]."' ";
	$query_repair=mysql_query($update_repair);

	$update_durable="UPDATE durable SET du_status='ปกติ' WHERE id='".$_GET["du_id"]."' ";
	$query_durable=mysql_query($update_durable);
	if($query_durable>0){
		echo "<script>alert('คุณได้บันทึก ".ซ่อมแล้ว." ครุภัณฑ์นี้แล้ว');</script>";
		echo "<script>window.location.href='repair_info.php'</script>";
			}else{
				echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
				echo "<script>history.back();</script>";
				}

}else if($_GET["action"] == "read"){
	$update_repair="UPDATE repair SET repair_status=1 , user_status_read=1 , admin_status_read=2 WHERE repair_id='".$_GET["repair_id"]."' ";
	$query_repair=mysql_query($update_repair);

	$update_durable="UPDATE durable SET du_status='รอซ่อม/กำลังซ่อม' WHERE id='".$_GET["du_id"]."' ";
	$query_durable=mysql_query($update_durable);
	if($query_durable>0){
		echo "<script>window.location.href='repair_info.php'</script>";
			}else{
				echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
				echo "<script>history.back();</script>";
				}
}else {
	$mem_id=$_GET["mem_id"];
	$du_id=$_POST['field_du_id'];
	$repair_detail=$_POST['field_repair_detail'];

	$check = "SELECT * FROM repair  WHERE  id=$du_id AND repair_status =0";
	$result = mysql_query($check) ;
	$num = mysql_num_rows($result);
				if($num > 0)
				{
						 echo "<script>";
						 echo "alert('ครุภัณฑ์นี้ถูกแจ้งซ่อมแล้ว');";
						 echo "window.location='repair_info.php';";
						 echo "</script>";
		}
		/*End Check for dupplicate*/
		else{

	$insert="INSERT INTO repair (mem_id,id,repair_detail) VALUES ('$mem_id','$du_id','$repair_detail')";
	$result=mysql_query($insert);

		}

		if($result>0){
			echo "<script>alert('คุณได้แจ้งซ่อมครุภัณฑ์เรียบร้อยแล้ว');</script>";
			echo "<script>window.location.href='repair_mine.php'</script>";
				}else{
					echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
					echo "<script>history.back();</script>";
					}
}


?>
