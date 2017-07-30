<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>จัดการข้อมูลห้องทั้งหมด</title>
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
                 <h2>แก้ไขข้อมูลห้องทั้งหมดใน <?php echo $_GET["build_name"];?></h2>
                </div>
            </div>

           <?php

            if($_GET["Action"] == "Save"){

                for($i=1;$i<=$_POST["hdnLine"];$i++){

                    $strSQL = "UPDATE room SET room_name = '".$_POST["room_name$i"]."',roomt_id = '".$_POST["roomt_id$i"]."' WHERE room_id='".$_POST["hdnroom$i"]."' ";
                    $objQuery = mysql_query($strSQL);

                    if ($objQuery){
                        echo "<script>alert('คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว');</script>";
                        echo "<script>history.back();</script>";
                    }else{
                        echo "<script>alert('ระบบไม่สามารถทำรายการได้ในขณะนี้ กรุณาทำรายการภายหลัง');</script>";
                        echo "<script>history.back();</script>";
                    }
                }
            }
            $strSQL = "SELECT * FROM room NATURAL JOIN room_type";
            $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
            $row=mysql_num_rows($objQuery);
            ?>

            <hr />

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             ข้อมูลห้องทั้งหมดใน <?php echo $_GET["build_name"];?>
                        </div>
                        <div class="panel-body">
                        <?php if ($row==0) { ?>
                            <div>ไม่พบข้อมูลที่จะแก้ไขตอนนี้ <a href="manage_room.php?build_id=<?php echo $_GET["build_id"];?>&build_name=<?php echo $_GET["build_name"];?>">เพิ่มห้อง</a></div>
                        <?php }else{ ?>
                            <form name="frmMain" method="post" action="admin_edit_room.php?Action=Save">
                                <div class="table-responsive">
                                    <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">ชื่อห้อง</th>
                                                <th class="text-center">ประเภทห้อง</th>
                                            </tr>
                                        </thead>
                                        <?php
                                            $i =0;
                                            while($objResult = mysql_fetch_array($objQuery)){
                                                $i = $i + 1;
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="hidden" name="hdnroom<?php echo $i;?>" value="<?php echo $objResult["room_id"];?>">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="room_name<?php echo $i;?>" value="<?php echo $objResult["room_name"];?>" autocomplete="off" >
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="roomt_id<?php echo $i;?>" >
                                                        <option value="<?php echo $objResult["roomt_id"];?>">
                                                            <?php echo $objResult["roomt_name"];?>
                                                        </option>
                                                        <?php
                                                            require_once ("connectdb.php");
                                                            $query = mysql_query ("SELECT * FROM room_type WHERE roomt_id !='".$objResult["roomt_id"]."'");
                                                            while($viewcat=mysql_fetch_array($query)){ ?>
                                                            <option id="<?php echo $viewcat['roomt_id'];?>" value="<?php echo $viewcat['roomt_id'];?>"><?php echo $viewcat['roomt_name'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                    </table>
                                </div>

                                <center>
                                    <button type="submit" name="submit" class="btn btn-success">บันทึก</button>
                                    <input type="hidden" name="hdnLine" value="<?php echo $i;?>">
                                    <button type="button" class="btn btn-danger" onclick="history.go(-1);">ยกเลิก</button>
                                </center>
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
