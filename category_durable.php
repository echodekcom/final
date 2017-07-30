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
    <?php require_once 'nav.php'; ?>

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

                                $select="SELECT * FROM durable NATURAL JOIN category NATURAL JOIN room WHERE cat_id='".$_GET["cat_id"]."' ";
                                $query=mysql_query($select);
                                $row=mysql_num_rows($query);
                                  ?>
                                 <?php

                                if ($row===0) { echo"ไม่พบข้อมูลครุภัณฑ์ในปประเภทนี้";}else{ ?>
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">รูปภาพ</th>
                                                <th class="text-center">หมายเลขครุภัณฑ์</th>
                                                <th class="text-center">ชื่อครุภัณฑ์</th>
                                                <th class="text-center">สถานะการยืม</th>
                                            </tr>
                                        </thead>
                                        <?php while ($result=mysql_fetch_array($query)) { ?>
                                        <tbody>
                                            <tr class="odd gradeX">
                                              <td>
                                              <?php if ($result["du_img"]==""){
                                                  echo "<center><font color=MediumOrchid'>ไม่มีรูปภาพ</font></center>";
                                              ?>
                                              <?php }else { ?>
                                                <center><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#du_img<?php echo $result["id"];?>'>ดูรูปภาพ</button></center>
                                              <?php } ?>
                                              </td>
                                                <td width="20%" class="text-center"><?php echo $result["du_id"]; ?></td>
                                                <td><?php echo $result["du_name"]; ?>
                                                    <div style="float: right;">
                                                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#details<?php echo $result["id"];?>">รายละเอียดครุภัณฑ์</button>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                <?php
                                                $result["du_bstatus"];
                                                    if ($result["du_bstatus"]==0) {
                                                      echo "<font size='4'><span class='label label-success'>ว่าง</span><font>";
                                                     }else if($result["du_bstatus"]==1){
                                                        echo "<font size='4'><span class='label label-danger'>ไม่ว่าง</span><font>";
                                                        }else{
                                                        echo "<font size='4'><span class='label label-warning'>จองแล้ว</span><font>";
                                                        }?>

                                                  <!-- Modal -->
                                                <div class="modal fade" id="du_img<?php echo $result["id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">รูปภาพ</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <center><img src="assets/img/durable/<?php echo $result['du_img']; ?>" class="user-image img-responsive">
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
                                                      </div>
                                                    </form>
                                                    </div>
                                                  </div>
                                                </div>

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
                                                                    <label class="col-md-3 col-md-offset-1">สภาพการใช้งาน : </label>
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
                                                            </div>
                                                            <br><br><br><br>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-md-offset-1">บาร์โค้ด : </label>
                                                                    <div class="col-md-8">
                                                                        <img src="barcode.php?barcode=<?php echo $result["du_id"].'&width=200&height=80';?>" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br><br><br>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                    </table><hr>

                                    <!--start pagination (หมายเลขหน้า)-->
                                      <div class="text-right" style="padding-right: 15px">
                                        <nav aria-label="Page navigation ">
                                          <ul class="pagination pagination-md">

                                      <!--จำนวนทั้งหมด ( <?php //echo $Num_Rows;?> ) รายการ | จำนวนหน้า ( <?php //echo $Num_Pages;?> ) หน้า | หน้าที่ :-->
                                      <?php
                                      if($Prev_Page)
                                      {
                                        ?>
                                        <li> <?php echo "<a href='?Page=$Prev_Page'><span aria-hidden='true'>&larr;</span> Back</a>";?></li>
                                        <?php
                                      }

                                      for($i=1; $i<=$Num_Pages; $i++)
                                        {
                                          ?>
                                          <li <?php if ($Page==$i) echo 'class="active"'; ?>> <?php echo "<a href='?Page=$i'>$i</a>"; ?></li>
                                          <?php
                                        }
                                      if($Page!=$Num_Pages)
                                      {
                                        ?>
                                        <li> <?php echo "<a href ='?Page=$Next_Page'>Next <span aria-hidden='true'>&rarr;</span></a>";?></li>
                                        <?php
                                      }
                                      ?>
                                    </ul>
                                    </nav>
                                    </div>
                                    <!--End pagination (สิ้นสุดการแบ่งหมายเลขหน้า)-->

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
