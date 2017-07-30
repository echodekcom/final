<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ครุภัณฑ์ทั้งหมด</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<body>
   <?php require_once 'nav.php'; ?>

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>ข้อมูลครุภัณฑ์ทั้งหมด</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             ครุภัณฑ์ทั้งหมด
                        </div>
                        <div class="panel-body">

                        <?php
                        if($_GET["txtKeyword"] != "");

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
                            echo "ยังไม่มีข้อมูลครุภัณฑ์ในขณะนี้";
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
                                  <a href="durable.php" class="btn btn-info"><i class="fa fa-repeat"></i></a>
                              </div>

                              <?php if ($_SESSION['mem_status']=='admin') {?>
                                <div class="form-group">
                                  <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" style="background-color: #00b3b3;color: #fff;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-print"></i> พิมพ์ข้อมูล
                                    <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                      <li><a href="print/print_durable.php?strKeyword=<?php echo $_GET["txtKeyword"]; ?>">พิมพ์ข้อมูลครุภัณฑ์</a></li>
                                      <div role="separator" class="divider"></div>
                                      <li><a href="print/print_barcode.php?Action=print_barcode&strKeyword=<?php echo $_GET["txtKeyword"]; ?>">พิมพ์บาร์โค้ด</a></li>
                                    </ul>
                                  </div>
                              </div>
                              <?php } ?>

                          </div><br>
                           <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th class="text-center" width="100">รูปภาพ</th>
                                          <th class="text-center" width="90">เลขครุภัณฑ์</th>
                                          <th class="text-center" width="150">ชื่อครุภัณฑ์</th>
                                          <th class="text-center" width="110">ประเภท</th>
                                          <th class="text-center" width="120">สถานะครุภัณฑ์</th>
                                          <th class="text-center" width="70">ห้อง</th>
                                          <th class="text-center" width="90">รายละเอียด</th>
                                          <th class="text-center" width="100">สถานะการยืม</th>
                                          <th class="text-center" width="110">บาร์โค้ด</th>
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
                                          <td class="text-center"><?php echo $result["du_id"]; ?></td>
                                          <td class="text-center"><?php echo $result["du_name"]; ?></td>
                                          <td class="text-center"><?php echo $result["cat_name"]; ?></td>
                                          <td class="text-center"><?php echo $result["du_status"]; ?></td>
                                          <td class="text-center"><?php echo $result["room_name"]; ?></td>
                                          <td class="text-center"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#details<?php echo $result["id"];?>">รายละเอียดครุภัณฑ์</button></td>
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
                                          <td class="text-center"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#barcode<?php echo $result["id"]; ?>">ดูบาร์โค้ด</button></td>

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

                                        <!--Modal รายละเอียดครุภัณฑ์-->
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
                                                            <label class="col-md-3 col-md-offset-1">รายละเอียด : </label>
                                                            <div class="col-md-8">
                                                                <?php echo $result["du_details"];?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br><br><br><br>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Modal Barcode-->
                                        <div class="modal fade" id="barcode<?php echo $result["id"]; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" >
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <center><h4>Barcode</h4></center>
                                                    </div>
                                                    <div class="modal-body">
                                                        <center>
                                                            <img src="barcode.php?barcode=<?php echo $result["du_id"].'&width=200&height=80';?>" />
                                                        </center>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>

                                                            <?php if ($_SESSION['mem_status']=='admin'): ?>
                                                              <a href="print/print_barcode.php?Action=print_one&id=<?php echo $result['id'];?>" type="submit" class="btn btn-info"><i class="fa fa-print"> พิมพ์บาร์โค้ด</i></a>
                                                            <?php endif ?>

                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
                                                        </center>
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
                        <!--End Advanced Tables -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script>
    $(document).ready(function(){

     load_data();

     function load_data(query)
     {
      $.ajax({
       url:"search_durable.php",
       method:"POST",
       data:{query:query},
       success:function(data)
       {
        $('#result').html(data);
       }
      });
     }
     $('#search_text').keyup(function(){
      var search = $(this).val();
      if(search != '')
      {
       load_data(search);
      }
      else
      {
       load_data();
      }
     });
    });
    </script>



</body>
</html>
