<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>รายการการยืมทั้หมด</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<body>
   <?php
        require_once 'nav.php';
        require 'admin-c.php';

        if($_GET["Action"] == "read"){
            $strSQL = "UPDATE borrow SET msa_status = 0 WHERE b_id='".$_GET["b_id"]."' ";
            $objQuery = mysql_query($strSQL);

            if ($objQuery){
                echo "<script>window.location.href='manage_borrow.php'</script>";
            }else{
                echo "<script>history.back();</script>";
            }
        }
    ?>

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>รายการการยืมทั้งหมด</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            รายการทั้งหมด
                        </div>
                        <div class="panel-body">
                            <?php
                                require_once 'connectdb.php';
                                $select="SELECT * FROM borrow NATURAL JOIN member WHERE b_status=1";
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

                                 $select .=" order  by b_id ASC LIMIT $Page_Start , $Per_Page";
                                 $query  = mysql_query($select);
                                 ?>
                                 <!--End Pagination (ปิดการแบ่งหน้า)-->
                                 <?php

                                if ($row==0) {
                                    echo "ยังไม่มีข้อมูลการยืมในขณะนี้";
                                }else{ ?>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ชื่อผู้ยืม</th>
                                                <th class="text-center">ครุภัณฑ์ที่ยืม</th>
                                                <th class="text-center">เหตุผลที่ยืม</th>
                                                <th class="text-center">วันที่ยืม</th>
                                                <th class="text-center">วันที่คืน</th>
                                            </tr>
                                        </thead>
                                        <?php while ($result=mysql_fetch_array($query)) { ?>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td class="text-center"><?php echo $result["mem_name"]; ?></td>
                                                <td class="text-center"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#details<?php echo $result["b_id"];?>">ครุภัณฑ์ที่ขอยืม</button>

                                                <form method="post" action="admin_update_borrow.php?action=ok&mem_id=<?php echo $result["mem_id"];?>&b_id=<?php echo $result["b_id"];?>">
                                                <div class="modal fade" id="details<?php echo $result["b_id"];?>">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" >
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <center><h4>ครุภัณฑ์ที่ยืม</h4></center>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                    require_once 'connectdb.php';
                                                                    $sselect="SELECT * FROM borrow_detail NATURAL JOIN durable  NATURAL JOIN category WHERE b_id='".$result["b_id"]."'";
                                                                    $qquery=mysql_query($sselect);
                                                                    $rrow=mysql_num_rows($qquery);
                                                                    ?>
                                                                <div class="table-responsive">
                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">ประเภทครุภัณฑ์</th>
                                                                            <th class="text-center">หมายเลขครุภัณฑ์</th>
                                                                            <th class="text-center">ชื่อครุภัณฑ์</th>
                                                                            <th class="text-center">เลือกเครุภัณฑ์</th>
                                                                            <th class="text-center">เหตุผลที่ไม่อนุมัติ</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php while ($rresult=mysql_fetch_array($qquery)) { ?>
                                                                    <tbody>
                                                                        <tr class="odd gradeX">
                                                                            <td class="text-center"><?php echo $rresult["cat_name"]; ?></td>
                                                                            <td class="text-center"><?php echo $rresult["du_id"]; ?></td>
                                                                            <td class="text-center"><?php echo $rresult["du_name"]; ?></td>
                                                                            <td>
                                                                            <?php if ($rresult["bd_status"]==0) {?>
                                                                              <input type="radio" name="status[<?php echo $rresult["bd_id"]?>]"  value="1"> อนุมัติ
                                                                              <input type="radio" name="status[<?php echo $rresult["bd_id"]?>]"  value="2"> ไม่อนุมัติ
                                                                            <?php }else if($rresult["bd_status"]==2) {
                                                                              echo "ถูกยืมไปแล้ว";
                                                                              } ?>

                                                                            </td>
                                                                            <td class="text-center"><input type="text" autocomplete="off" name="bd_detail[<?php echo $rresult["bd_id"]?>]" class="form-control" placeholder="เหตุผล..."></td>
                                                                        </tr>
                                                                    </tbody>
                                                                    <?php } ?>
                                                                </table>
                                                                </div>

                                                                  <input type="hidden" name="b_date" value="<?php echo $result['b_date'];?>">
                                                                  <input type="hidden" name="b_rdate" value="<?php echo $result['b_rdate'];?>">

                                                                <button class="btn btn-success" type="submit">บันทึก</button>
                                                                <button class="btn btn-danger" type="button" class="close" data-dismiss="modal">
                                                                    ยกเลิก
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>

                                                <td><?php echo $result["b_detail"]; ?></td>
                                                </td>
                                                <td class="text-center">
                                                  <?php
                                                    $date = date_create($result['b_date']);
                                                    echo date_format($date,'d/m/Y');
                                                  ?>
                                                </td>
                                                <td class="text-center">
                                                  <?php
                                                    $date = date_create($result['b_rdate']);
                                                    echo date_format($date,'d/m/Y');
                                                  ?>
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
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/tooltip.js"></script>

</body>
</html>
