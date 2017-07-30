<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>จัดการข้อมูลประเภทครุภัณฑ์</title>
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

    if($_GET["Action"] == "Save"){

        $strSQL = "UPDATE category SET cat_name = '".$_POST["cat_name"]."' WHERE cat_id = '".$_POST["hdnid"]."' ";
        $objQuery = mysql_query($strSQL);

        if ($objQuery > 0){
            echo "<script>alert('คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว');</script>";
            echo "<script>window.location.href='manage_category.php'</script>";
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
                     <h2>จัดการข้อมูลประเภทครุภัณฑ์</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                 ประเภทครุภัณฑ์
                            </div>
                            <div class="panel-body">
                            <div class="btn-group" style="float: right;">
                                <button class="btn btn-default" data-toggle="modal" data-target="#add_cat" style="background-color: #00b3b3;color: #fff;">
                                    เพิ่มประเภทครุภัณฑ์
                                </button>
                                <button class="btn btn-default" onclick="window.location.href='admin_edit_category.php'" style="background-color: #00b3b3;color: #fff;">
                                    แก้ไขประเภทครุภัณฑ์ทั้งหมด
                                </button>
                            </div>

                                <?php
                                require_once 'connectdb.php';
                                $select="SELECT * FROM category";
                                $query=mysql_query($select);
                                $row=mysql_num_rows($query);

                                error_reporting( error_reporting() & ~E_NOTICE );

                                $Per_Page = 7;   // Per Page

                                 $Page = $_GET["Page"];
                                 if(!$_GET["Page"])
                                 {
                                   $Page=1;
                                 }

                                 $Prev_Page = $Page-1;
                                 $Next_Page = $Page+1;

                                 $Page_Start = (($Per_Page*$Page)-$Per_Page);
                                 if($row<=$Per_Page)
                                 {
                                   $Num_Pages =1;
                                 }
                                 else if(($row % $Per_Page)==0)
                                 {
                                   $Num_Pages =($row/$Per_Page) ;
                                 }
                                 else
                                 {
                                   $Num_Pages =($row/$Per_Page)+1;
                                   $Num_Pages = (int)$Num_Pages;
                                 }

                                 $select .=" order  by cat_name ASC LIMIT $Page_Start , $Per_Page";
                                 $query  = mysql_query($select);
                                 ?>
                                 <!--End Pagination (ปิดการแบ่งหน้า)-->
                                 <?php

                                if ($row==0) {
                                        echo "ไม่พบข้อมูลประเภทครุภัณฑ์ในขณะนี้ คลิก 'เพิ่มประเภทครุภัณฑ์' เพื่อเพิ่มข้อมูลประเภทครุภัณฑ์ตอนนี้";
                                }else{
                                 ?>
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ประเภทครุภัณฑ์</th>

                                            </tr>
                                        </thead>
                                        <?php while ($result=mysql_fetch_array($query)) { ?>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td><?php echo $result["cat_name"]; ?>
                                                    <div style="float: right">
                                                        <button class="btn btn-default" onclick="window.location.href='manage_catdurable.php?cat_id=<?php echo $result["cat_id"];?>&cat_name=<?php echo $result["cat_name"];?>'">ครุภัณฑ์ในประเภทนี้</button>
                                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_cat<?php echo $result["cat_id"];?>"><i class="fa fa-edit"></i></button>
                                                        <a href="admin_delete.php?submit=del&Action=dc&cat_id=<?php echo $result["cat_id"];?>" class="btn btn-danger" onclick="return checkdel();"><i class="glyphicon glyphicon-trash"></i></a>
                                                    </div>
                                                </td>

                                                <form name="frmMain" method="post" action="manage_category.php?Action=Save">
                                                    <div class="modal fade" id="edit_cat<?php echo $result["cat_id"];?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" >
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <center><h4>แก้ไขข้อมูลประเภทครุภัณฑ์</h4></center>
                                                                </div>
                                                                <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>ชื่อประเภทครุภัณฑ์</label>
                                                                            <input type="hidden" name="hdnid" value="<?php echo $result["cat_id"];?>">
                                                                            <input type="text" class="form-control" name="cat_name" value="<?php echo $result["cat_name"]; ?>" autocomplete="off">
                                                                        </div>
                                                                    <center>
                                                                        <button type="submit" class="btn btn-success">แก้ไขประเภทครุภัณฑ์</button>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                                                    </center>
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

                                <!-- modal -->
                                <div class="modal fade" id="add_cat">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" >
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <center><h4>เพิ่มประเภทครุภัณฑ์</h4></center>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form" method="post" action="admin_add_category.php">
                                                    <div class="form-group">
                                                        <label>ชื่อประเภทครุภัณฑ์</label>
                                                        <input type="text" class="form-control" name="field_cat_name" placeholder="ชื่อประเภทครุภัณฑ์" required autofocus autocomplete="off">
                                                    </div>
                                                <center>
                                                    <button type="submit" class="btn btn-success">เพิ่มประเภทครุภัณฑ์</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                                </center>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal -->

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
