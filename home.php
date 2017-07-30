<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ยินดีต้อนรับเข้าสู่ระบบจัดการครุภัณฑ์สาขาคอมพิวเตอร์ มหาวิทยาลัยราชภัฏยะลา</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>

<style>
    .f-right{
        float: right;
    }
</style>

<body>
<?php
        require_once 'nav.php';
        require 'connectdb.php';

        $select = "SELECT * FROM member WHERE mem_id=".$_SESSION['mem_id']." ";
        $result = mysql_query($select) or die ("Error Query [".$select."]");
        $objResult = mysql_fetch_array($result);
        ?>

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>ยินดีต้อนรับ : <?php echo $_SESSION['mem_name']; ?> <?php echo $_SESSION['mem_lname']; ?></h2>
                    </div>
                </div>
                <hr/>
                <?php if ($_SESSION['mem_status']=="admin"){

                $select = "SELECT * FROM borrow NATURAL JOIN member WHERE b_status=1";
                $query = mysql_query($select);
                $badge_number = mysql_num_rows($query);

                $select1 = "SELECT * FROM repair NATURAL JOIN member WHERE repair_status=0 OR repair_status=1";
                $query1 = mysql_query($select1);
                $badge_number1 = mysql_num_rows($query1);

                ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-back noti-box">
                          <a href="manage_borrow.php" class="list-group-item" id="btnTop" data-placement="top" title="คลิกเพื่อดูรายละเอียดเพิ่มเติม">
                            <h2 class="list-group-item-heading">
                              <img src="assets/img/borrow_icon.png" alt="">
                              รายการยืม</h2>
                              <?php if ($badge_number!=0){ ?>

                              <h4 class="list-group-item-heading">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                              <font color="DimGrey">คุณมี <?php echo $badge_number; ?> รายการที่กำลังรอดำเนินการ</font></h4>

                              <?php }else{ ?>

                              <h4 class="list-group-item-heading">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                              <font color="DimGrey">ไม่มีรายการยืมจากผู้ใช้งาน</font></h4>

                              <?php } ?>

                          </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-back noti-box">
                            <a href="repair_info.php" class="list-group-item" id="btnLeft" data-placement="top" title="คลิกเพื่อดูรายละเอียดเพิ่มเติม">
                              <h2 class="list-group-item-heading">
                                <img src="assets/img/repair_icon.png" alt="">
                                รายการแจ้งซ่อม</h2>
                                <?php if ($badge_number1!=0){ ?>

                                <h4 class="list-group-item-heading">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <font color="DimGrey">คุณมี <?php echo $badge_number1; ?> รายการที่รอดำเนินการ</font></h4>

                                <?php }else{ ?>

                                <h4 class="list-group-item-heading">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <font color="DimGrey">ไม่มีรายการแจ้งซ่อมจากผู้ใช้งาน</font></h4>

                                <?php } ?>
                            </a>
                        </div>
                    </div>
                </div>

                <?php }else{

                $select2 = "SELECT * FROM borrow WHERE msu_status=1 AND mem_id='".$_SESSION['mem_id']."'";
                $query2 = mysql_query($select2);
                $badge_number2 = mysql_num_rows($query2);

                $select3 = "SELECT * FROM repair WHERE user_status_read=1 OR user_status_read=3 OR user_status_read=4 AND mem_id='".$_SESSION['mem_id']."'";
                $query3 = mysql_query($select3);
                $badge_number3 = mysql_num_rows($query3);

                ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-back noti-box">
                            <a href="borrow_mine.php?Action=read1" class="list-group-item" id="btnTop" data-placement="top" title="คลิกเพื่อดูรายละเอียดเพิ่มเติม">
                              <h2 class="list-group-item-heading">
                                <img src="assets/img/borrow_icon.png" alt="">
                                รายการยืม</h2>
                                <?php if ($badge_number2!=0){ ?>

                                <h4 class="list-group-item-heading">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <font color="DimGrey">คุณมี <?php echo $badge_number2; ?> รายการที่ดำเนินการแล้ว</font></h4>

                                <?php }else{ ?>

                                <h4 class="list-group-item-heading">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <font color="DimGrey">ไม่มีรายการยืมที่ดำเนินการ</font></h4>

                                <?php } ?>

                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-back noti-box">
                            <a href="repair_mine.php?Action=read1" class="list-group-item" id="btnLeft" data-placement="top" title="คลิกเพื่อดูรายละเอียดเพิ่มเติม">
                              <h2 class="list-group-item-heading">
                                <img src="assets/img/repair_icon.png" alt="">
                                รายการแจ้งซ่อม</h2>
                                <?php if ($badge_number3!=0){ ?>

                                <h4 class="list-group-item-heading">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <font color="DimGrey">คุณมี <?php echo $badge_number3; ?> รายการที่ดำเนินการแล้ว</font></h4>

                                <?php }else{ ?>

                                <h4 class="list-group-item-heading">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <font color="DimGrey">ไม่มีรายการแจ้งซ่อมที่ดำเนินการ</font></h4>

                                <?php } ?>

                            </a>

                        </div>
                    </div>
                </div>

                <?php } ?>

                <hr />
                <?php if ($_SESSION['mem_status']=="admin"){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                รายการยืม
                                <a href="manage_borrow.php"><div class="f-right">ดูทั้งหมด..</div></a>
                            </div>
                            <div class="panel-body">
                            <?php
                            $select4="SELECT * FROM borrow NATURAL JOIN member WHERE b_status=1";
                            $query4=mysql_query($select);
                            $row4=mysql_num_rows($query);
                            if ($row4==0) {
                                    echo "ยังไม่มีรายการการยืมใหม่ในขณะนี้";
                                }else{ ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ชื่อผู้ยืม</th>
                                            <th class="text-center">วันที่ยืม</th>
                                            <th class="text-center">วันที่คืน</th>
                                        </tr>
                                    </thead>
                                    <?php while ($result4=mysql_fetch_array($query4)) { ?>
                                    <tbody>
                                        <tr>
                                          <td class="text-center"><?php echo $result4["mem_name"]; ?></td>
                                          <td class="text-center">
                                            <?php
                                              $date = date_create($result4['b_date']);
                                              echo date_format($date,'d/m/Y');
                                            ?>
                                          </td>
                                          <td class="text-center">
                                            <?php
                                              $date = date_create($result4['b_rdate']);
                                              echo date_format($date,'d/m/Y');
                                            ?>
                                          </td>
                                        </tr>
                                    </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                รายการแจ้งซ่อม
                                <a href="repair_info.php"><div class="f-right">ดูทั้งหมด..</div></a>
                            </div>
                            <div class="panel-body">
                            <?php
                            $select5 = "SELECT * FROM repair NATURAL JOIN member NATURAL JOIN building NATURAL JOIN room NATURAL JOIN durable WHERE repair_status=0 OR repair_status=1";
                            $query5 = mysql_query($select5);
                            $num5 = mysql_num_rows($query5);
                            if ($num5==0) {
                                    echo "ยังไม่มีรายการแจ้งซ่อมใหม่ในขณะนี้";
                                }else{ ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="100">ชื่อผู้แจ้ง</th>
                                                <th class="text-center" width="90">รหัสครุภัณฑ์</th>
                                                <th class="text-center" width="140">ชื่อครุภัณฑ์</th>
                                            </tr>
                                        </thead>
                                        <?php while ($result5=mysql_fetch_array($query5)) { ?>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><?php echo $result5["mem_name"]; ?></td>
                                                <td class="text-center"><?php echo $result5["du_id"]; ?></td>
                                                <td class="text-center"><?php echo $result5["du_name"]; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
                <?php } ?>
            </div>
        </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/tooltip.js"></script>



</body>
</html>
