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

    if($_GET["Action"] == "Save"){

        $strSQL = "UPDATE room SET room_name = '".$_POST["room_name"]."',roomt_id = '".$_POST["roomt_id"]."' WHERE room_id = '".$_POST["hdnid"]."' ";
        $objQuery = mysql_query($strSQL);

        if ($objQuery > 0){
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
                     <h2>ห้องทั้งหมดใน <?php echo $_GET["build_name"];?></h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                 ห้อง
                            </div>
                            <div class="panel-body">
                            <div class="btn-group" style="float: right;">
                                <button class="btn btn-default" onclick="window.location.href='manage_roomtype.php'" style="background-color: #00b3b3;color: #fff;">
                                    จัดการประเภทห้อง
                                </button>
                                <button class="btn btn-default" data-toggle="modal" data-target="#add_room" style="background-color: #00b3b3;color: #fff;">
                                    เพิ่มห้อง
                                </button>
                                <button class="btn btn-default" onclick="window.location.href='admin_edit_room.php?build_id=<?php echo $_GET["build_id"];?>&build_name=<?php echo $_GET["build_name"];?>'" style="background-color: #00b3b3;color: #fff;">
                                    แก้ไขห้องทั้งหมด
                                </button>
                            </div>

                                <?php
                                require_once 'connectdb.php';

                                $select=mysql_query("SELECT * FROM room NATURAL JOIN room_type NATURAL JOIN building WHERE build_id='".$_GET["build_id"]."' ");
                                $row=mysql_num_rows($select);

                                if ($row===0) { ?>
                                    <div>ไม่พบข้อมูลห้องในอาคารนี้ คลิก 'เพิ่มห้อง' เพื่อเพิ่มข้อมูลห้องสำหรับอาคารนี้</div>
                                <?php }else{ ?>
                                    <br><br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" colspan="2">ห้อง</th>
                                            </tr>
                                        </thead>
                                        <?php while ($result=mysql_fetch_array($select)) { ?>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td><?php echo $result["room_name"]; ?></td>
                                                <td><?php echo $result["roomt_name"]; ?>
                                                <div style="float: right;">
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_room<?php echo $result["room_id"];?>"><i class="fa fa-edit"></i></button>
                                                <a href="admin_delete.php?submit=del&Action=dr&room_id=<?php echo $result["room_id"];?>" class="btn btn-danger" onclick="return checkdel();"><i class="glyphicon glyphicon-trash"></i></a>
                                                </div>

                                                <form name="frmMain" method="post" action="manage_room.php?Action=Save">
                                                    <div class="modal fade" id="edit_room<?php echo $result["room_id"];?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" >
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <center><h4>แก้ไขข้อมูลห้อง</h4></center>
                                                                </div>
                                                                <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <input type="hidden" name="hdnid" value="<?php echo $result["room_id"];?>">
                                                                            <label>ชื่ออาคาร</label>
                                                                            <input type="text" class="form-control" name="room_name" value="<?php echo $result["build_name"]; ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>ชื่อห้อง</label>
                                                                            <input type="text" class="form-control" name="room_name" value="<?php echo $result["room_name"]; ?>" autocomplete="off">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>ประเภทห้อง</label>
                                                                            <select class="form-control" name="roomt_id" required>
                                                                                <option value="<?php echo $result["roomt_id"];?>">
                                                                                    <?php echo $result["roomt_name"];?>
                                                                                </option>
                                                                                <?php
                                                                                    $query = mysql_query ("SELECT * FROM room_type WHERE roomt_id !='".$result["roomt_id"]."'");
                                                                                    while($viewcat=mysql_fetch_array($query)){ ?>
                                                                                    <option id="<?php echo $viewcat['roomt_id'];?>" value="<?php echo $viewcat['roomt_id'];?>"><?php echo $viewcat['roomt_name'];?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>

                                                                    <center>
                                                                        <button type="submit" class="btn btn-success">แก้ไขห้อง</button>
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
                                    </table>
                                </div>
                                <?php } ?>



                                <!-- modal -->

                                <div class="modal fade" id="add_room">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" >
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <center><h4>เพิ่มห้อง</h4></center>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form" method="post" action="admin_add_room.php?build_id=<?php echo $_GET["build_id"];?>">
                                                    <div class="form-group">
                                                        <label>ชื่ออาคาร</label>
                                                        <input type="text" class="form-control" value="<?php echo $_GET["build_name"];?>" readonly >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ชื่อห้อง</label>
                                                        <input type="text" class="form-control" name="field_room_name" placeholder="ชื่อห้อง" required autofocus autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ประเภท</label>
                                                       <select class="form-control" name="field_room_type" required>
                                                            <option value="">--เลือกประเภทห้อง--</option>
                                                            <?php
                                                                $query = mysql_query ("SELECT * FROM room_type");
                                                                while($viewcat=mysql_fetch_array($query)){ ?>
                                                                <option id="<?php echo $viewcat['roomt_id'];?>" value="<?php echo $viewcat['roomt_id'];?>"><?php echo $viewcat['roomt_name'];?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                <center>
                                                    <button type="submit" class="btn btn-success">เพิ่มห้อง</button>
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
