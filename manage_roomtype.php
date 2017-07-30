<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>จัดการข้อมูลประเภทห้อง</title>
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

        $strSQL = "UPDATE room_type SET roomt_name = '".$_POST["roomt_name"]."' WHERE roomt_id = '".$_POST["hdnroomtid"]."' ";
        $objQuery = mysql_query($strSQL);

        if ($objQuery > 0){
            echo "<script>alert('คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว');</script>";
            echo "<script>window.location.href='manage_roomtype.php'</script>";
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
                     <h2>จัดการข้อมูลประเภทห้อง</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                 ประเภทห้อง
                            </div>
                            <div class="panel-body">
                            <div class="btn-group" style="float: right;">
                                <button class="btn btn-default" data-toggle="modal" data-target="#add_roomt" style="background-color: #00b3b3;color: #fff;">
                                    เพิ่มประเภทห้อง
                                </button>
                                <button class="btn btn-default" onclick="window.location.href='admin_edit_roomtype.php'" style="background-color: #00b3b3;color: #fff;">
                                    แก้ไขประเภททั้งหมด
                                </button>
                            </div>

                                <?php
                                require_once 'connectdb.php';
                                $select="SELECT * FROM room_type";
                                $query=mysql_query($select);
                                $row=mysql_num_rows($query);

                                if ($row==0) {
                                    echo "ไม่พบข้อมูลประเภทห้องในขณะนี้ คลิก 'เพิ่มประเภทห้อง' เพื่อเพิ่มข้อมูลประเภทห้องตอนนี้";
                                }else{
                                 ?>

                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ประเภทห้อง</th>

                                            </tr>
                                        </thead>
                                        <?php while ($result=mysql_fetch_array($query)) { ?>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td><?php echo $result["roomt_name"]; ?>
                                                    <div style="float: right">
                                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_roomt<?php echo $result["roomt_id"];?>"><i class="fa fa-edit"></i></button>
                                                        <a href="admin_delete.php?submit=del&Action=drt&roomt_id=<?php echo $result["roomt_id"];?>" class="btn btn-danger" onclick="return checkdel();"><i class="glyphicon glyphicon-trash"></i></a>
                                                    </div>
                                                </td>

                                                <form name="frmMain" method="post" action="manage_roomtype.php?Action=Save">
                                                    <div class="modal fade" id="edit_roomt<?php echo $result["roomt_id"];?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" >
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <center><h4>แก้ไขข้อมูลประเภทห้อง</h4></center>
                                                                </div>
                                                                <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>ชื่อประเภทห้อง</label>
                                                                            <input type="hidden" name="hdnroomtid" value="<?php echo $result["roomt_id"];?>">
                                                                            <input type="text" class="form-control" name="roomt_name" value="<?php echo $result["roomt_name"]; ?>" autocomplete="off">
                                                                        </div>
                                                                    <center>
                                                                        <button type="submit" class="btn btn-success">แก้ไขประเภทห้อง</button>
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
                                <div class="modal fade" id="add_roomt">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" >
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <center><h4>เพิ่มประเภทห้อง</h4></center>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form" method="post" action="admin_add_roomtype.php">
                                                    <div class="form-group">
                                                        <label>ประเภทห้อง</label>
                                                        <input type="text" class="form-control" name="field_roomt_name" placeholder="ประเภทห้อง" required autofocus autocomplete="off">
                                                    </div>
                                                <center>
                                                    <button type="submit" class="btn btn-success">เพิ่มประเภท</button>
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
