<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>จัดการข้อมูลครุภัณฑ์</title>
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
        require_once 'connectdb.php';

        if($_GET["Action"] == "Save"){

                $strSQL = "UPDATE durable SET du_id = '".$_POST["du_id"]."',du_name = '".$_POST["du_name"]."',cat_id = '".$_POST["cat_id"]."',du_datein = '".$_POST["du_datein"]."',du_price = '".$_POST["du_price"]."',du_status = '".$_POST["du_status"]."',room_id = '".$_POST["room_id"]."',du_details = '".$_POST["du_details"]."' WHERE id = '".$_POST["hdnid"]."' ";
                $objQuery = mysql_query($strSQL);

                if ($objQuery){
                    echo "<script>alert('คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว');</script>";
                    echo "<script>history.back();</script>";
                }else{
                    echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
                    echo "<script>history.back();</script>";
                }
            }
        ?>

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>จัดการข้อมูลครุภัณฑ์</h2>
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
                            <button class="btn btn-default" style="background-color: #00b3b3;color: #fff;" onclick="window.location.href='add_durable.php'">เพิ่มครุภัณฑ์</button>
                        </div>



                                <?php
                                    require_once 'connectdb.php';

                                    if($_GET["Action"] == "img"){

                                      $fileupload = $_GET['fileupload']; //รับค่าไฟล์จากฟอร์ม
                                      $fileID = $_GET['id']; //รับค่าไฟล์จากฟอร์ม

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
                                      $path="assets/img/durable/";

                                      //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
                                       $type = strrchr($_FILES['fileupload']['name'],".");

                                      //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
                                      $newname = $date.$numrand.$type;
                                      $path_copy=$path.$newname;
                                      $path_link="assets/img/durable/".$newname;

                                      //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
                                      move_uploaded_file($_FILES['fileupload']['tmp_name'],$path_copy);
                                        }
                                            //*** Delete Old File ***//
                                            @unlink("assets/img/durable/".$_POST["update_img_db"]);
                                        // เพิ่มไฟล์เข้าไปในตาราง durable

                                          $sql = "UPDATE durable SET du_img='$newname' WHERE id=$fileID";
                                          $result = mysql_query($sql);

                                        if($result){
                                        echo "<script>history.back();</script>";
                                        }
                                        else{
                                          echo "<script>alert ('Cannot Save');</script>";
                                          echo "<script>history.back();</script>";
                                      }
                                    }
                                      echo "<script>alert('คุณได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');</script>";
                                      echo "<script type='text/javascript'>";
                                      echo "window.location = 'manage_durable.php'; ";
                                      echo "</script>";

                                    }

                                    error_reporting( error_reporting() & ~E_NOTICE );
                                    if($_GET["txtKeyword"] != "");

                                    $objConnect = mysql_connect("localhost","root","") or die("Error Connect to Database");
                                  	$objDB = mysql_select_db("final");
                                  	// Search By Name or Email

                                  	$select = "SELECT * FROM durable NATURAL JOIN category NATURAL JOIN room
                                               WHERE (du_id LIKE '%".$_GET["txtKeyword"]."%'
                                               OR du_name LIKE '%".$_GET["txtKeyword"]."%'
                                               OR cat_name LIKE '%".$_GET["txtKeyword"]."%'
                                               OR du_status LIKE '%".$_GET["txtKeyword"]."%'
                                               OR room_name LIKE '%".$_GET["txtKeyword"]."%')";
                                  	$query = mysql_query($select) or die ("Error Query [".$select."]");
                                  	$Num_Rows = mysql_num_rows($query);

                                  	$Per_Page = 7;   // Per Page

                                  	$Page = $_GET["Page"];
                                  	if(!$_GET["Page"])
                                  	{
                                  		$Page=1;
                                  	}

                                  	$Prev_Page = $Page-1;
                                  	$Next_Page = $Page+1;

                                  	$Page_Start = (($Per_Page*$Page)-$Per_Page);
                                  	if($Num_Rows<=$Per_Page)
                                  	{
                                  		$Num_Pages =1;
                                  	}
                                  	else if(($Num_Rows % $Per_Page)==0)
                                  	{
                                  		$Num_Pages =($Num_Rows/$Per_Page) ;
                                  	}
                                  	else
                                  	{
                                  		$Num_Pages =($Num_Rows/$Per_Page)+1;
                                  		$Num_Pages = (int)$Num_Pages;
                                  	}


                                  	$select .=" order  by id DESC LIMIT $Page_Start , $Per_Page";
                                  	$query  = mysql_query($select);

                                    if ($Num_Rows==0) {
                                        echo "ไม่พบข้อมูลครุภัณฑ์ในขณะนี้ คลิก 'เพิ่มครุภัณฑ์' เพื่อเพิ่มข้อมูลครุภัณฑ์ตอนนี้ี้";
                                    }else{
                                ?>
                            <br><br>
                            <form class="form-inline" name="frmSearch" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                              <div class="text-center">
                                  <div class="form-group">
                                    <input name="txtKeyword" class="form-control" type="text" autocomplete="off" placeholder="ค้นหาข้อมูล" id="txtKeyword" value="<?php echo $_GET["txtKeyword"];?>">
                                  </div>
                                  <div class="form-group">
                                      <button class="btn btn-success" type="submit"><i class="fa fa-search"></i> ค้นหา</button>
                                  </div>
                                  </form>
                                  <div class="form-group">
                                      <a href="manage_durable.php" class="btn btn-info"><i class="fa fa-repeat"></i></a>
                                  </div>
                              </div><br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="80">รูปภาพ</th>
                                            <th class="text-center" width="90">เลขครุภัณฑ์</th>
                                            <th class="text-center" width="150">ชื่อครุภัณฑ์</th>
                                            <th class="text-center" width="110">ประเภท</th>
                                            <th class="text-center" width="90">วันที่รับมา</th>
                                            <th class="text-center" width="70">ห้อง</th>
                                            <th class="text-center" width="90">รายละเอียด</th>
                                            <th class="text-center" width="100">สถานะการยืม</th>
                                            <th class="text-center" width="110">แก้ไข / ลบ</th>
                                        </tr>
                                    </thead>

                                    <?php while ($result=mysql_fetch_array($query)) { ?>

                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td>
                                              <?php if ($result["du_img"]==""){ ?>
                                              <button type='button' class='btn btn-success' data-toggle='modal' data-target='#du_upload<?php echo $result["id"];?>'>อัพโหลดภาพ</button>
                                            <?php }else { ?>
                                              <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#du_img<?php echo $result["id"];?>'>แก้ไขรูปภาพ</button>
                                            <?php } ?>
                                            </td>
                                            <td><?php echo $result["du_id"]; ?></td>
                                            <td><?php echo $result["du_name"]; ?></td>
                                            <td><?php echo $result["cat_name"]; ?></td>
                                            <td class="text-center">
                                              <?php
                                                $date = date_create($result['du_datein']);
                                                echo date_format($date,'d/m/Y');
                                              ?>
                                            </td>
                                            <td><?php echo $result["room_name"]; ?></td>
                                            <td><button class="btn btn-default" type="button" data-toggle="modal" data-target="#details<?php echo $result["id"];?>">รายละเอียด</button>

                                              <!-- Modal อัพโหลดรูปครุภัณฑ์-->
                                            <div class="modal fade" id="du_upload<?php echo $result["id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">อัพโหลดรูปภาพครุภัณฑ์</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                  <form action="manage_durable.php?Action=img&id=<?php echo $result["id"];?>" method="post" enctype="multipart/form-data">
                                                    <input type="file" name="fileupload" accept="image/*">
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
                                                  </div>
                                                </form>
                                                </div>
                                              </div>
                                            </div>


                                            <!-- Modal แก้ไขรูปครุภัณฑ์-->
                                            <div class="modal fade" id="du_img<?php echo $result["id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">แก้ไขรูปภาพครุภัณฑ์</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                  <center><img src="assets/img/durable/<?php echo $result['du_img']; ?>" class="user-image img-responsive"/>
                                                  <form action="manage_durable.php?Action=img&id=<?php echo $result["id"];?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="update_img_db" value="<?php echo $result["du_img"];?>">
                                                    <input type="file" name="fileupload" accept="image/*">
                                                    </center>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
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
                                                                <label class="col-md-3 col-md-offset-1">รายละเอียด : </label>
                                                                <div class="col-md-8">
                                                                    <?php echo $result["du_details"];?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br><br><br>
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
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit<?php echo $result["id"];?>">
                                                    <i class="fa fa-edit"></i></button>
                                                    <a href="admin_delete.php?submit=del&Action=dd&id=<?php echo $result["id"];?>" class="btn btn-danger" onclick="return checkdel();"><i class="glyphicon glyphicon-trash"></i></a>
                                                </div>

                                                <form name="frmMain" method="post" action="manage_durable.php?Action=Save">
                                                <div class="modal fade" id="edit<?php echo $result["id"];?>">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" >
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <center><h4>แก้ไขข้อมูล</h4></center>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 col-md-offset-1 control-label"> รหัสอุปกรณ์ </label>
                                                                            <div class="col-md-8">
                                                                                <input type="hidden" name="hdnid" value="<?php echo $result["id"];?>">
                                                                                <input type="text" class="form-control" name="du_id" autocomplete="off" value="<?php echo $result["du_id"];?>" >
                                                                            </div>
                                                                        </div><br>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 col-md-offset-1 control-label"> ชื่ออุปกรณ์ </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" name="du_name" autocomplete="off" value="<?php echo $result["du_name"];?>" >
                                                                            </div>
                                                                        </div><br>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 col-md-offset-1 control-label"> ประเภท </label>
                                                                            <div class="col-md-8">
                                                                            <select class="form-control" name="cat_id" required>
                                                                                <option value="<?php echo $result["cat_id"];?>">
                                                                                    <?php echo $result["cat_name"];?>
                                                                                </option>
                                                                                <?php
                                                                                    $qq = mysql_query ("SELECT * FROM category WHERE cat_id !='".$result["cat_id"]."'");
                                                                                    while($viewcat=mysql_fetch_array($qq)){ ?>
                                                                                    <option id="<?php echo $viewcat['cat_id'];?>" value="<?php echo $viewcat['cat_id'];?>"><?php echo $viewcat['cat_name'];?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                            </div>
                                                                        </div><br>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 col-md-offset-1 control-label"> วันที่สั่งซื้อ </label>
                                                                            <div class="col-md-8">
                                                                            <input type="date" class="form-control" name="du_datein" value="<?php echo $result["du_datein"];?>" >
                                                                            </div>
                                                                        </div><br>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 col-md-offset-1 control-label"> ราคา </label>
                                                                            <div class="col-md-8">
                                                                            <input type="text" class="form-control" name="du_price" autocomplete="off" value="<?php echo $result["du_price"];?>" >
                                                                            </div>
                                                                        </div><br>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 col-md-offset-1 control-label"> สถานะ </label>
                                                                            <div class="col-md-8">
                                                                            <select class="form-control" name="du_status" >
                                                                                <option value="<?php echo $result["du_status"];?>">
                                                                                    <?php echo $result["du_status"];?>
                                                                                </option>
                                                                                    <option>ปกติ</option>
                                                                                    <option>รอซ่อม/กำลังซ่อม</option>
                                                                                    <option>ใช้การไม่ได้/เสีย</option>
                                                                                    <option>แทงจำหน่าย</option>
                                                                            </select>
                                                                            </div>
                                                                        </div><br>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 col-md-offset-1 control-label"> ห้อง </label>
                                                                            <div class="col-md-8">
                                                                            <select class="form-control" name="room_id" required>
                                                                                <option value="<?php echo $result["room_id"];?>">
                                                                                    <?php echo $result["room_name"];?>
                                                                                </option>
                                                                                <?php
                                                                                    $q = mysql_query ("SELECT * FROM room WHERE room_id !='".$result["room_id"]."'");
                                                                                    while($viewcat=mysql_fetch_array($q)){ ?>
                                                                                    <option id="<?php echo $viewcat['room_id'];?>" value="<?php echo $viewcat['room_id'];?>"><?php echo $viewcat['room_name'];?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                            </div>
                                                                        </div><br>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 col-md-offset-1 control-label"> รายละเอียด </label>
                                                                            <div class="col-md-8">
                                                                            <?php $value=$result["du_details"]; ?>
                                                                                <textarea type="text" class="form-control" name="du_details" autocomplete="off" value="<?php echo $result["du_details"];?>" ><?php echo htmlentities($value);?></textarea>
                                                                            </div>
                                                                        </div><br><br><br>
                                                                    </form>
                                                                    <center>
                                                                        <button type="submit" name="submit" class="btn btn-success">บันทึก</button>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                </form>

                                            </td>
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
                                  <li> <?php echo "<a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&txtKeyword=$_GET[txtKeyword]'><span aria-hidden='true'>&larr;</span> Back</a>";?></li>
                                  <?php
                                }

                                for($i=1; $i<=$Num_Pages; $i++)
                                  {
                                    ?>
                                    <li <?php if ($Page==$i) echo 'class="active"'; ?>> <?php echo "<a href='$_SERVER[SCRIPT_NAME]?Page=$i&txtKeyword=$_GET[txtKeyword]'>$i</a>"; ?></li>
                                    <?php
                                  }
                                if($Page!=$Num_Pages)
                                {
                                  ?>
                                  <li> <?php echo "<a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&txtKeyword=$_GET[txtKeyword]'>Next <span aria-hidden='true'>&rarr;</span></a>";?></li>
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
                    <!--End Advanced Tables -->
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
