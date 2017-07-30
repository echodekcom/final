<?php
require ('../connectdb.php');
require_once('mpdf/mpdf.php');
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
<html lang="en">
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

    <div class="container">
        <div class="row">
          <?php
          $strKeyword=$_GET["strKeyword"];
          $select = "SELECT * FROM repair NATURAL JOIN building NATURAL JOIN room NATURAL JOIN durable NATURAL JOIN member WHERE repair_status !='0'
          AND (mem_name LIKE '%".$strKeyword."%'
          OR mem_lname LIKE '%".$strKeyword."%'
          OR du_id LIKE '%".$strKeyword."%'
          OR du_name LIKE '%".$strKeyword."%'
          OR build_name LIKE '%".$strKeyword."%'
          OR room_name LIKE '%".$strKeyword."%') order  by repair_id DESC";
          $query = mysql_query($select);
          ?>
          <br><br>
          <div align="center">
            <b><font face="Kanit Light" font size="4">รายงานการแจ้งซ่อมครุภัณฑ์ทั้งหมด <br><br><b>หน่วยงาน</b> <font color="DimGrey">สาขาคอมพิวเตอร์</font> <b>คณะ</b> <font color="DimGrey">วิทยาศาสตร์เทคโนโลยีและการเกษตร์ มหาวิทยาลัยราชภัฏยะลา</font></font></b><br><br>
            <b><font face="Kanit Light" font size="4"><b>ปีงบประมาณ................. สำรวจเมื่อวันที่........... เดือน.......................... พ.ศ. ................... </b></font></b><br><br>
            วันที่พิมพ์ : <?=thai_date_and_time_short(time())?>
          </div><hr>

          <table bordercolor="#424242" width="1141" height="78" border="1"  align="center" cellpadding="0" cellspacing="0" class="style3">
              <thead>
                  <tr>
                      <th class="text-center" width="150" height="30" bgcolor="#D5D5D5"><b>ชื่อผู้แจ้ง</b></th>
                      <th class="text-center" width="100" height="30" bgcolor="#D5D5D5"><b>รหัสครุภัณฑ์</b></th>
                      <th class="text-center" width="250" height="30" bgcolor="#D5D5D5"><b>ชื่อครุภัณฑ์</b></th>
                      <th class="text-center" width="100" height="30" bgcolor="#D5D5D5"><b>อาคาร</b></th>
                      <th class="text-center" width="100" height="30" bgcolor="#D5D5D5"><b>ห้อง</b></th>
                      <th class="text-center" width="250" height="30" bgcolor="#D5D5D5"><b>อาการ</b></th>
                      <th class="text-center" width="100" height="30" bgcolor="#D5D5D5"><b>สถานะ</b></th>
                  </tr>
              </thead>
              <?php while ($result=mysql_fetch_array($query)) { ?>
              <tbody>
                  <tr class="odd gradeX">
                      <td height="30"><center><?php echo $result["mem_name"]."&nbsp;&nbsp;".$result["mem_lname"]; ?></center></td>
                      <td height="30"><center><?php echo $result["du_id"]; ?></center></td>
                      <td height="30"><center><?php echo $result["du_name"]; ?></center></td>
                      <td height="30"><center><?php echo $result["build_name"]; ?></center></td>
                      <td height="30"><center><?php echo $result["room_name"]; ?></center></td>
                      <td height="30"><center><?php echo $result["repair_detail"]; ?></center></td>
                      <td height="30"><center>
                        <?php
                        $result["repair_status"];
                            if ($result["repair_status"]==1) {
                                echo "กำลังซ่อม ";
                            }else if ($result["repair_status"]==2){
                                echo "ซ่อมแล้ว";
                            }else if ($result["repair_status"]==3){
                                echo "เสีย";
                            }

                            ?>
                      </center></td>
                  </tr>
              </tbody>
              <?php } ?>
          </table>
        </div>
    </div>

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
$pdf = new mPDF('th', 'A4', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
