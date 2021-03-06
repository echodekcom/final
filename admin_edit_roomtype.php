<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>แก้ไขข้อมูลประเภทห้องทั้งหมด</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<body>

    <?php
        require_once("nav.php");
        require 'admin-c.php';
    ?>

     <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                 <h2>แก้ไขข้อมูลประเภทห้องทั้งหมด</h2>
                </div>
            </div>

            <?php

            if($_GET["Action"] == "Save"){

                for($i=1;$i<=$_POST["hdnLine"];$i++){

                    $strSQL = "UPDATE room_type SET roomt_name = '".$_POST["roomt_name$i"]."' WHERE roomt_id = '".$_POST["hdnroomtid$i"]."' ";
                    $objQuery = mysql_query($strSQL);

                    if ($objQuery > 0){
                        echo "<script>alert('คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว');</script>";
                        echo "<script>window.location.href='manage_roomtype.php'</script>";
                    }else{
                        echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
                        echo "<script>history.back();</script>";
                    }

                }
            }
            $strSQL = "SELECT * FROM room_type";
            $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
            $row=mysql_num_rows($objQuery);
             ?>

            <hr />

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             ข้อมูลประเภทห้องทั้งหมด
                        </div>
                        <div class="panel-body">
                             <?php if ($row==0) { ?>
                                <div>ไม่พบข้อมูลที่จะแก้ไขตอนนี้ <a href="manage_roomtype.php">เพิ่มประเภทห้อง</a></div>
                            <?php }else{ ?>
                            <form class="form-horizontal" name="frmMain" method="post" action="admin_edit_roomtype.php?Action=Save">
                                <div class="form-group">
                                    <center><label class="col-md-offset-5 col-md-2 col-md-offset-5"> ชื่อประเภทห้อง </label></center>
                                </div>
                                <?php
                                        $i =0;
                                        while($objResult = mysql_fetch_array($objQuery)){
                                            $i = $i + 1;
                                    ?>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-8 col-md-offset-2">
                                        <input type="hidden" name="hdnroomtid<?php echo $i;?>" value="<?php echo $objResult["roomt_id"];?>">
                                        <input type="text" class="form-control" name="roomt_name<?php echo $i;?>" value="<?php echo $objResult["roomt_name"];?>" autocomplete="off" >
                                    </div>
                                </div>
                                <?php } ?>
                                <center>
                                    <button type="submit" name="submit" class="btn btn-success">บันทึก</button>
                                    <input type="hidden" name="hdnLine" value="<?php echo $i;?>">
                                    <button type="button" class="btn btn-danger" onclick="history.go(-1);">ยกเลิก</button>
                                </center><br>
                            </form>
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
