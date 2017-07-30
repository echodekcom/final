<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>จัดการข้อมูลอื่นๆ</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <script type="text/javascript">
        function checkdel() {
            if (confirm('ยืนยันการลบข้อมูล ?')) {
                return true;
            }else{
                return false;
            }
        }
    </script>
</head>
<body>
    <?php
        require_once 'nav.php';
        require 'admin-c.php';
    ?>

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>ครุภัณฑ์ทั้งหมดในประเภท <?php echo $_GET["cat_name"];?></h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                 ครุภัณฑ์
                            </div>
                            <div class="panel-body">
                                <div class="btn-group" style="float: right;">
                                <button class="btn btn-default" onclick="window.location.href='durable.php'" style="background-color: #00b3b3;color: #fff;">
                                    ดูครุภัณฑ์ทั้งหมด
                                </button>
                            </div>
                               <?php
                                require_once 'connectdb.php';

                                $select=mysql_query("SELECT * FROM durable NATURAL JOIN category NATURAL JOIN room WHERE cat_id='".$_GET["cat_id"]."' ");
                                $row=mysql_num_rows($select);

                                if ($row===0) { ?>
                                    <div>ไม่พบข้อมูลครุภัณฑ์ในประเภทนี้ ไปยังเมนู 'จัดการข้อมูลต่างๆ/<a href="manage_durable.php">จัดการข้อมูลครุภัณฑ์'</a> เพื่อเพิ่มข้อมูลครุภัณฑ์สำหรับประเภทนี้นี้</div>
                                <?php }else{ ?>
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">รหัสครุภัณฑ์</th>
                                                <th class="text-center" colspan="2">ชื่อครุภัณฑ์</th>
                                            </tr>
                                        </thead>
                                        <?php while ($result=mysql_fetch_array($select)) { ?>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td width="20%" class="text-center"><?php echo $result["du_id"]; ?></td>
                                                <td><?php echo $result["du_name"]; ?>
                                                <div style="float: right;">
                                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#details<?php echo $result["id"];?>">รายละเอียดครุภัณฑ์</button>
                                                </div>
                                                </td>

                                                <div class="modal fade" id="details<?php echo $result["id"];?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" >
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <center><h4>รายละเอียดครุภัณฑ์</h4></center>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-md-offset-1">สถานะ : </label>
                                                                    <div class="col-md-8">
                                                                        <?php echo $result["du_status"];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-md-offset-1">ห้อง : </label>
                                                                    <div class="col-md-8">
                                                                        <?php echo $result["room_name"];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-md-offset-1">รายละเอียด : </label>
                                                                    <div class="col-md-8">
                                                                        <?php echo $result["du_details"];?>
                                                                    </div>
                                                                </div>
                                                            </div><br><br><br><br>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-md-offset-1">สถานะการยืม : </label>
                                                                    <div class="col-md-8">
                                                                      <?php
                                                                      $result["du_bstatus"];
                                                                          if ($result["du_bstatus"]==0) {
                                                                            echo "<font size='4'><span class='label label-success'>ว่าง</span><font>";
                                                                          }else{
                                                                              echo "<font size='4'><span class='label label-danger'>ไม่ว่าง</span><font>";
                                                                              }
                                                                      ?>
                                                                    </div>
                                                                </div>
                                                            </div><br>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/tooltip.js"></script>

</body>
</html>
