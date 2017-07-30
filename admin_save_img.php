<?php
    require_once 'connectdb.php';

    $fileupload = $_GET['fileupload']; //รับค่าไฟล์จากฟอร์ม
    $fileID = $_GET['mem_id']; //รับค่าไฟล์จากฟอร์ม

    if($_FILES["fileupload"]["name"] != ""){

    //ฟังก์ชั่นวันที่
    date_default_timezone_set('Asia/Bangkok');
  	$date = date("Ymd");
    //ฟังก์ชั่นสุ่มตัวเลข
    $numrand = (mt_rand());
    //เพิ่มไฟล์
    $upload=$_FILES['fileupload'];
    if($upload <> '') {   //not select file
    //โฟลเดอร์ที่จะ upload file เข้าไป
    $path="assets/img/profile/";

    //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
     $type = strrchr($_FILES['fileupload']['name'],".");

    //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
    $newname = $date.$numrand.$type;
    $path_copy=$path.$newname;
    $path_link="assets/img/profile/".$newname;

    //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
    move_uploaded_file($_FILES['fileupload']['tmp_name'],$path_copy);
    	}
    			//*** Delete Old File ***//
    			@unlink("assets/img/profile/".$_POST["update_img_db"]);
    	// เพิ่มไฟล์เข้าไปในตาราง uploadfile

    		$sql = "UPDATE member SET mem_img='$newname' WHERE mem_id=$fileID";
        $result = mysql_query($sql);

    	if($result){
        echo "<script>alert('คุณได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');</script>";
      	echo "<script type='text/javascript'>";
      	echo "window.location = 'home.php'; ";
      	echo "</script>";
    	}
    	else{
        echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการใหม่ภายหลัง');</script>";
        echo "<script>history.back();</script>";
    }
  }
    echo "<script>alert('คุณได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<script type='text/javascript'>";
    echo "window.location = 'home.php'; ";
    echo "</script>";

?>
