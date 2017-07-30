<?php
require_once '../connectdb.php';
require_once('../print/mpdf/mpdf.php');
ob_start();
?>
<?php
    $thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
    $thai_month_arr=array(
        "0"=>"",
        "1"=>"มกราคม",
        "2"=>"กุมภาพันธ์",
        "3"=>"มีนาคม",
        "4"=>"เมษายน",
        "5"=>"พฤษภาคม",
        "6"=>"มิถุนายน",
        "7"=>"กรกฎาคม",
        "8"=>"สิงหาคม",
        "9"=>"กันยายน",
        "10"=>"ตุลาคม",
        "11"=>"พฤศจิกายน",
        "12"=>"ธันวาคม"
    );
    $thai_month_arr_short=array(
        "0"=>"",
        "1"=>"ม.ค.",
        "2"=>"ก.พ.",
        "3"=>"มี.ค.",
        "4"=>"เม.ย.",
        "5"=>"พ.ค.",
        "6"=>"มิ.ย.",
        "7"=>"ก.ค.",
        "8"=>"ส.ค.",
        "9"=>"ก.ย.",
        "10"=>"ต.ค.",
        "11"=>"พ.ย.",
        "12"=>"ธ.ค."
    );
    function thai_date_and_time($time){   // 19 ธันวาคม 2556 เวลา 10:10:43
        global $thai_day_arr,$thai_month_arr;
        $thai_date_return.=date("j",$time);
        $thai_date_return.=" ".$thai_month_arr[date("n",$time)];
        $thai_date_return.= " ".(date("Y",$time)+543);
        $thai_date_return.= " เวลา ".date("H:i:s",$time);
        return $thai_date_return;
    }
    function thai_date_and_time_short($time){   // 19  ธ.ค. 2556 10:10:4
        global $thai_day_arr,$thai_month_arr_short;
        $thai_date_return.=date("j",$time);
        $thai_date_return.="&nbsp;&nbsp;".$thai_month_arr_short[date("n",$time)];
        $thai_date_return.= " ".(date("Y",$time)+543);
        $thai_date_return.= " ".date("H:i:s",$time);
        return $thai_date_return;
    }
    function thai_date_short($time){   // 19  ธ.ค. 2556
        global $thai_day_arr,$thai_month_arr_short;
        $thai_date_return.=date("j",$time);
        $thai_date_return.="&nbsp;&nbsp;".$thai_month_arr_short[date("n",$time)];
        $thai_date_return.= " ".(date("Y",$time)+543);
        return $thai_date_return;
    }
    function thai_date_fullmonth($time){   // 19 ธันวาคม 2556
        global $thai_day_arr,$thai_month_arr;
        $thai_date_return.=date("j",$time);
        $thai_date_return.=" ".$thai_month_arr[date("n",$time)];
        $thai_date_return.= " ".(date("Y",$time)+543);
        return $thai_date_return;
    }
    function thai_date_short_number($time){   // 19-12-56
        global $thai_day_arr,$thai_month_arr;
        $thai_date_return.=date("d",$time);
        $thai_date_return.="-".date("m",$time);
        $thai_date_return.= "-".substr((date("Y",$time)+543),-2);
        return $thai_date_return;
    }
    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<body>

    <?php
    $select="SELECT * FROM borrow NATURAL JOIN member  WHERE b_id=".$_GET['b_id']."";
    $query=mysql_query($select);
    while ($result=mysql_fetch_array($query)) {
    ?>
    <div class="container">
        <div class="row">
          &nbsp;&nbsp;&nbsp;<img src="../assets/img/logo_print.jpg" width="100" height="80"/>
          <p align = "center"><font size = "5"> บันทึกข้อความ </font></p>
          <p align = "left"><font size = "4"> <b>ส่วนราชการ</b>&nbsp; <font color="DimGrey">สาขาวิชาคอมพิวเตอร์ &nbsp; คณะวิทยาศาสตร์เทคโนโลยีและการเกษตร &nbsp; มหาวิทยาลัยราชภัฏยะลา</font>&nbsp;</font></p>
          <p align = "left"><font size = "4"> <b>ที่</b>&nbsp; <font color="DimGrey">สาขาวิชาคอมพิวเตอร์ </font> <b>วันที่</b>&nbsp; <font color="DimGrey"><?=thai_date_short(time())?></font></font></p>
          <p align = "left"><font size = "4"> <b>เรื่อง</b>&nbsp; <font color="DimGrey">ขอยืมวัสดุอุปกรณ์สาขาคอมพิวเตอร์</font></font></p>
          <p align = "left"><font size = "3"> <b>เรียน</b>&nbsp; <font color="DimGrey">ผู้ประสานสาขาวิชาคอมพิวเตอร์</font></font></p>
          <p align = "left"><font size = "3">
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ด้วยข้าพเจ้า &nbsp;<font color="DimGrey"><?php echo $result['mem_name'];?> &nbsp;&nbsp; <?php echo $result['mem_lname'];?></font> &nbsp; หมายเลขโทรศัพท์...........................................................<br><br>
          <input name="t" type="text" id="t" maxlength="2" style="width:15px;"/> อาจารย์ &nbsp; &nbsp; <input name="t" type="text" id="t" maxlength="2" style="width:15px;"/> เจ้าหน้าที่ &nbsp; &nbsp; <input name="t" type="text" id="t" maxlength="2" style="width:15px;"/> นักศึกษา &nbsp; &nbsp;
          สังกัด (หลักสูตร).............................................................<br><br>
          <?php
              $sselect="SELECT * FROM borrow_detail NATURAL JOIN category NATURAL JOIN durable WHERE b_id='".$_GET["b_id"]."' AND bd_status='1'";
              $qquery=mysql_query($sselect);
              ?>
          มีความประสงค์จะขอยืมใช้วัสดุอุปกรณ์ของสาขาคอมพิวเตอร์ ดังนี้ <br><br>
          <?php
          $i=1;
          while ($rresult=mysql_fetch_array($qquery)) { ?>
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $i,".&nbsp; &nbsp; &nbsp; &nbsp; <b>รหัสครุภัณฑ์ :</b> ",$rresult['du_id'],"&nbsp;&nbsp; <b>ชื่อครุภัณฑ์ :</b> ",$rresult['du_name']; ?><br><br>
          <?php $i++; } ?>
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; เพื่อใช้สำหรับ &nbsp; <font color="DimGrey"><?php echo $result['b_detail'];?></font><br><br>
          กำหนดเวลายืมวัสดุอุปกรณ์ดังกล่าวตั้งแต่วันที่่ <font color="DimGrey">
            <?php
              $date = date_create($result['b_date']);
              echo date_format($date,'d/m/Y');
            ?></font>
            &nbsp; และจะนำส่งคืนให้สาขาวิชาคอมพิวเตอร์ภายในวันที่ <font color="DimGrey">
              <?php
              $date1 = date_create($result['b_rdate']);
              echo date_format($date1,'d/m/Y');
              ?><br><br><br><br>
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; จึงเรียนมาเพื่อโปรดพิจารณา <br><br><br><br>
          <div align = "left"><font size = "3"> ลงชื่อ........................................................ผู้ยืม &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ลงชื่อ........................................................ผู้ให้ยืม</font></div><br><br>
          <div align = "left"><font size = "3"> ลงชื่อ........................................................ผู้คืน &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ลงชื่อ........................................................ผู้รับคืน <font></div><br><br><br><br><br><br><br>
          <div align = "left"><font size = "3"> <b>หมายเหตุ :</b> <font color="DimGrey">อนุญาติให้อาจารย์และนักศึกษายืมใช้ในการเรียนการสอนและกิจกรรมของมหาวิทยาลัยเท่านั้น</font> </font></div>

        </div>
    </div>
    <?php } ?>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'TH SarabunPSK');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
