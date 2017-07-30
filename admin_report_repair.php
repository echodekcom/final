<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>รายงานการแจ้งซ่อม</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <script type="text/javascript">
        function checkreturn() {
            if (confirm('ยืนยันการคืนครุภัณฑ์ ?')) {
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
                     <h2>รายงานการแจ้งซ่อม</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            รายงานการแจ้งซ่อมทั้งหมด
                        </div>
                        <div class="panel-body">
                          <div class="table-responsive">
                            <?php
                              error_reporting( error_reporting() & ~E_NOTICE );
                              if($_GET["txtKeyword"] != "");

                            	$select = "SELECT * FROM repair NATURAL JOIN building NATURAL JOIN room NATURAL JOIN durable NATURAL JOIN member WHERE repair_status !='0'
                              AND (mem_name LIKE '%".$_GET["txtKeyword"]."%'
                              OR mem_lname LIKE '%".$_GET["txtKeyword"]."%'
                              OR du_id LIKE '%".$_GET["txtKeyword"]."%'
                              OR du_name LIKE '%".$_GET["txtKeyword"]."%'
                              OR build_name LIKE '%".$_GET["txtKeyword"]."%'
                              OR room_name LIKE '%".$_GET["txtKeyword"]."%')";
                            	$query = mysql_query($select);
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


                            	$select .=" order  by repair_id DESC LIMIT $Page_Start , $Per_Page";
                            	$query  = mysql_query($select);

                              if ($Num_Rows==0) {
                                  echo "ขณะนี้ยังไม่มีรายงานครุภัณฑ์ที่กำลังซ่อม/ซ่อมแล้ว/เสียแล้ว";
                              }else{
                            ?>

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
                                      <a href="admin_report_repair.php" class="btn btn-info"><i class="fa fa-repeat"></i></a>
                                  </div>
                                  <div class="form-group">
                                      <a href="print/print_repair.php?strKeyword=<?php echo $_GET["txtKeyword"]; ?>" class="btn btn-default" style="background-color: #00b3b3;color: #fff;"><i class="fa fa-print"></i> พิมพ์ข้อมูล</a>
                                  </div>
                              </div><br>
                              <table class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th class="text-center">ชื่อผู้แจ้ง</th>
                                          <th class="text-center">รหัสครุภัณฑ์</th>
                                          <th class="text-center">ชื่อครุภัณฑ์</th>
                                          <th class="text-center">อาคาร</th>
                                          <th class="text-center">ห้อง</th>
                                          <th class="text-center">อาการ</th>
                                          <th class="text-center">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <?php while ($result=mysql_fetch_array($query)) { ?>
                                  <tbody>
                                      <tr class="odd gradeX">
                                          <td class="text-center"><?php echo $result["mem_name"]."&nbsp;&nbsp;".$result["mem_lname"]; ?></td>
                                          <td class="text-center"><?php echo $result["du_id"]; ?></td>
                                          <td class="text-center"><?php echo $result["du_name"]; ?></td>
                                          <td class="text-center"><?php echo $result["build_name"]; ?></td>
                                          <td class="text-center"><?php echo $result["room_name"]; ?></td>
                                          <td class="text-center"><?php echo $result["repair_detail"]; ?></td>
                                          <td class="text-center">
                                            <?php
                                            $result["repair_status"];
                                                if ($result["repair_status"]==1) {
                                                    echo "<font size='4'><span class='label label-warning'>กำลังซ่อม</span><font>";
                                                }else if ($result["repair_status"]==2){
                                                    echo "<font size='4'><span class='label label-success'>ซ่อมแล้ว</span><font>";
                                                }else if ($result["repair_status"]==3){
                                                    echo "<font size='4'><span class='label label-danger'>เสีย</span><font>";
                                                }

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
