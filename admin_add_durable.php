	<?php
			session_start();
			require 'admin-c.php';
			require_once ("connectdb.php");

			foreach ($_POST['field_id'] as $key => $value) {

					$fileupload = $_POST['fileupload'];
					$field_id = $_POST['field_id'][$key];
					$field_name = $_POST['field_name'][$key];

					$field_date = $_POST['field_date'][$key];
					$date = explode('/', $field_date);
					$field_date = implode('/', array($date[2], $date[1], $date[0]));

					$field_price = $_POST['field_price'][$key];
					$field_detail = $_POST['field_detail'][$key];
					$field_cat = $_POST['field_cat'][$key];
					$field_room = $_POST['field_room'][$key];

					//ฟังก์ชั่นวันที่
					date_default_timezone_set('Asia/Bangkok');
					$date = date("Ymd");
					//ฟังก์ชั่นสุ่มตัวเลข
					$numrand = (mt_rand());
					//เพิ่มไฟล์
					$upload=$_FILES['fileupload'];
					if($upload <> '') {   //not select file
					//โฟลเดอร์ที่จะ upload file เข้าไป
					$path="assets/img/durable/";

					//เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
					 $type = strrchr($_FILES['fileupload']['name'][$key],".");

					//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
					$newname = $date.$numrand.$type;
					$path_copy=$path.$newname;
					$path_link="assets/img/durable/".$newname;

					//คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
					move_uploaded_file($_FILES['fileupload']['tmp_name'][$key],$path_copy);
						}
					$strSQL = "INSERT INTO durable (du_img,du_id,du_name,du_price,du_datein,du_details,cat_id,room_id)
										 VALUES ('$newname','$field_id','$field_name','$field_price','$field_date','$field_detail','$field_cat','$field_room')";
					$objQuery = mysql_query($strSQL);
					}
						if($objQuery>0){
							echo "<script>alert('คุณได้เพิ่มข้อมูล ".$field_name." เรียบร้อยแล้ว');</script>";
								echo "<script>window.location.href='manage_durable.php'</script>";
							}else{
								echo "<script>alert('ระบบไม่สามารถเพิ่มข้อมูล ".$field_name." ได้กรุณาทำรายการภายหลัง');</script>";
								echo "<script>history.back();</script>";
					}
	?>
