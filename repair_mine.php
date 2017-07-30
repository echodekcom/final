<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>รายการแจ้งซ่อมของฉัน</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<body>
   <?php
      require_once 'nav.php';

       if($_GET["Action"] == "read"){
           $strSQL = "UPDATE repair SET user_status_read = 2 WHERE repair_id='".$_GET["repair_id"]."' ";
           $objQuery = mysql_query($strSQL);

           if ($objQuery){
               echo "<script>window.location.href='repair_mine.php'</script>";
           }else{
               echo "<script>history.back();</script>";
           }
       }else if($_GET["Action"] == "read1"){
           $strSQL = "UPDATE repair SET user_status_read = 2 ";
           $objQuery = mysql_query($strSQL);

           if ($objQuery){
               echo "<script>window.location.href='repair_mine.php'</script>";
           }else{
               echo "<script>history.back();</script>";
           }
       }
   ?>

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>รายการแจ้งซ่อมทั้งหมดของ <?php echo $_SESSION['mem_name']; ?></h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            รายการที่ฉันแจ้งซ่อม
                        </div>
                        <div class="panel-body">
                         <div class="btn-group" style="float: right;">
                                <button class="btn btn-default" onclick="window.location.href='repair.php'" style="background-color: #00b3b3;color: #fff;">
                                    แจ้งซ่อม
                                </button>
                            </div>

                          <div class="table-responsive">
                      <?php
                          require_once 'connectdb.php';
                          $select = "SELECT * FROM repair NATURAL JOIN building NATURAL JOIN room NATURAL JOIN durable WHERE mem_id=".$_SESSION['mem_id']." ";
                          $query = mysql_query($select);
                          $num = mysql_num_rows($query);

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
                           if($num<=$Per_Page)
                           {
                             $Num_Pages =1;
                           }
                           else if(($num % $Per_Page)==0)
                           {
                             $Num_Pages =($num/$Per_Page) ;
                           }
                           else
                           {
                             $Num_Pages =($num/$Per_Page)+1;
                             $Num_Pages = (int)$Num_Pages;
                           }

                           $select .=" order by repair_id DESC LIMIT $Page_Start , $Per_Page";
                           $query  = mysql_query($select);
                           ?>
                           <!--End Pagination (ปิดการแบ่งหน้า)-->
                           <?php

                          if ($num==0) { ?>

                          <div>ขณะนี้ยังไม่มีครุภัณฑ์ที่คุณแจ้งซ่อม</div>

                          <?php }else{ ?>
                              <br><br>
                              <table class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th class="text-center">รหัสครุภัณฑ์</th>
                                          <th class="text-center">ชื่อครุภัณฑ์</th>
                                          <th class="text-center">อาคาร</th>
                                          <th class="text-center">ห้อง</th>
                                          <th class="text-center">อาการ</th>
                                          <th class="text-center">สถานะ / สถานะการซ่อม</th>
                                          <th class="text-center">ผลการซ่อม</th>
                                      </tr>
                                  </thead>
                                  <?php while ($result=mysql_fetch_array($query)) { ?>
                                  <tbody>
                                      <tr class="odd gradeX">
                                          <td class="text-center"><?php echo $result["du_id"]; ?></td>
                                          <td class="text-center"><?php echo $result["du_name"]; ?></td>
                                          <td class="text-center"><?php echo $result["build_name"]; ?></td>
                                          <td class="text-center"><?php echo $result["room_name"]; ?></td>
                                          <td class="text-center"><?php echo $result["repair_detail"]; ?></td>
                                          <td class="text-center">
                                          <?php
                                          $result["repair_status"];
                                              if ($result["repair_status"]==0) {
                                                  echo "<font size='4'><span class='label label-danger'>ยังไม่อ่าน</span><font>";
                                                  if ($result["repair_status"]==0) {
                                                    echo " / <font size='4'><span class='label label-warning'>รอดำเนินการ</span><font>";
                                                  }
                                              }else if ($result["repair_status"]==1){
                                                  echo "<font size='4'><span class='label label-success'>อ่านแล้ว</span><font>";
                                                  if ($result["repair_status"]==1) {
                                                    echo " / <font size='4'><span class='label label-warning'>รอซ่อม</span><font>";
                                                  }
                                              }else if ($result["repair_status"]==2){
                                                  echo "<font size='4'><span class='label label-success'>อ่านแล้ว</span><font>";
                                                  if ($result["repair_status"]==2) {
                                                    echo " / <font size='4'><span class='label label-success'>ซ่อมแล้ว</span><font>";
                                                  }
                                              }else if ($result["repair_status"]==3){
                                                  echo "<font size='4'><span class='label label-success'>อ่านแล้ว</span><font>";
                                                  if ($result["repair_status"]==3) {
                                                    echo " / <font size='4'><span class='label label-danger'>เสีย</span><font>";
                                                  }
                                              }

                                              ?>
                                          </td>
                                          <td class="text-center">
                                          <?php if ($result["repair_status"]==0) {
                                            echo "<font size='4'><span class='label label-default'>รอดำเนินการ</span><font>";
                                          }else if($result["repair_status"]==1) {
                                            echo "<font size='4'><span class='label label-default'>รอซ่อม</span><font>";
                                          }else {
                                            echo $result["repair_bdetail"];
                                          } ?>
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
                          <?php } ?>
                          </div>
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
