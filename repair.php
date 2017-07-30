<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>แจ้งซ่อม</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />

    <script language="javascript">

    function show_table(id) {
      if(id == 1) { // ถ้าเลือก radio button 1 ให้โชว์ table 1 และ ซ่อน table 2
        document.getElementById("f1").style.display = "";
        document.getElementById("f2").style.display = "none";
      }else if(id == 2) { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1
        document.getElementById("f1").style.display = "none";
        document.getElementById("f2").style.display = "";
      }
    }
    </script>
</head>
<body>
   <?php require_once 'nav.php'; ?>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>แจ้งซ่อม</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ข้อมูลที่ต้องการแจ้งซ่อม
                        </div>
                        <div class="panel-body">
                        <form class="form-horizontal">
                              <div class="form-group">
                                  <label class="col-sm-2 control-label"></label>
                                  <div class="col-sm-3">
                                      <input type="radio" name="show" value="2" onclick="show_table(this.value);" checked> แจ้งซ่อมหลายรายการ
                                  </div>
                                  <div class="col-sm-3">
                                      <input type="radio" name="show" value="1" onclick="show_table(this.value);"> แจ้งซ่อมรายการเดียว
                                  </div>
                              </div>
                        </form>

                          <form class="form-horizontal" method="post" action="admin_add_repair.php?mem_id=<?php echo $_SESSION['mem_id'];?>" id="f1" style="display: none;">
                              <div class="form-group">
                                  <label class="col-sm-2 control-label">ชื่อ</label>
                                  <div class="col-sm-7">
                                      <input type="text" class="form-control" placeholder="" value="<?php echo $_SESSION['mem_name']." ".$_SESSION['mem_lname']; ?>" disabled>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 control-label">อาคาร</label>
                                  <div class="col-sm-7">
                                      <select class="form-control" id="field_build_id" name="field_build_id" required>
                                          <option value="">--เลือกอาคาร--</option>
                                          <?php
                                              require_once ("connectdb.php");
                                              $query = mysql_query ("SELECT * FROM building");
                                              while($viewcat=mysql_fetch_array($query)){ ?>
                                              <option id="<?php echo $viewcat['build_id'];?>" value="<?php echo $viewcat['build_id'];?>"><?php echo $viewcat['build_name'];?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 control-label">ห้อง</label>
                                  <div class="col-sm-7">
                                    <select class="form-control" id="field_room_id" name="field_room_id" required>
                                        <option value="">--เลือกห้อง--</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 control-label">เลือกครุภัณฑ์</label>
                                  <div class="col-sm-7">
                                      <select class="form-control" id="field_du_id" name="field_du_id" required>
                                          <option value="">--เลือกครุภัณฑ์--</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 control-label">อาการ</label>
                                  <div class="col-sm-7">
                                    <textarea type="text" class="form-control" placeholder="อาการของอุปกรณ์ที่ท่านแจ้งซ่อม..." name="field_repair_detail"></textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-7">
                                      <button type="submit" class="btn btn-success"> ยืนยัน </button>
                                      <button type="button" class="btn btn-danger" onclick="window.location.href='home.php'"> ยกเลิก </button>
                                  </div>
                              </div>
                          </form>

                          <!-- ------------------------------------------------ -->

                          <form class="form-horizontal" method="post" action="admin_add_repair1.php?mem_id=<?php echo $_SESSION['mem_id'];?>" id="f2">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ชื่อ</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" value="<?php echo $_SESSION['mem_name']." ".$_SESSION['mem_lname']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ค้นหา</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="search_text" id="search_text" placeholder="ค้นหาครุภัณฑ์" class="form-control" autofocus />
                                        <div id="result"></div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ครุภัณฑ์ที่เลือก</label>

                                    <div class="col-sm-7">
                                      <?php

                                          $itemCount = isset($_SESSION['cart1']) ? count($_SESSION['cart1']) : 0;
                                          if (isset($_SESSION['qty1']))
                                          {
                                              $meQty = 0;
                                              foreach ($_SESSION['qty1'] as $meItem)
                                              {
                                                  $meQty = $meQty + $meItem;
                                              }
                                          } else
                                          {
                                              $meQty = 0;
                                          }
                                          if (isset($_SESSION['cart1']) and $itemCount > 0)
                                          {
                                              $itemIds = "";
                                              foreach ($_SESSION['cart1'] as $itemId)
                                              {
                                                  $itemIds = $itemIds . $itemId . ",";
                                              }
                                              $inputItems = rtrim($itemIds, ",");
                                              $meSql = "SELECT * FROM durable NATURAL JOIN category WHERE id in ({$inputItems})";
                                              $meQuery = mysql_query($meSql);
                                              $meCount = mysql_num_rows($meQuery);
                                          } else
                                          {
                                              $meCount = 0;
                                          }

                                          if ($meCount==0) {
                                              echo "ยังไม่มีครุภัณฑ์ที่เลือกในขณะนี้";
                                          }else{
                                          ?>

                                          <table class="table table-striped table-bordered">
                                          <thead>
                                              <tr>
                                                  <th class="text-center" width="100">รูปครุภัณฑ์</th>
                                                  <th class="text-center" width="100">หมายเลขครุภัณฑ์</th>
                                                  <th class="text-center" width="150">ประเภทครุภัณฑ์</th>
                                                  <th class="text-center" width="80">ชื่อครุภัณฑ์</th>
                                                  <th class="text-center" width="80">ดำเนินการ</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                              while ($meResult = mysql_fetch_array($meQuery))
                                              {
                                                  $key = array_search($meResult['id'], $_SESSION['cart1']);

                                                  ?>
                                                  <tr>
                                                      <td>
                                                        <?php if ($meResult['du_img']==""){
                                                          echo "<center><font color=MediumOrchid'>ไม่มีรูปภาพ</font></center>";
                                                        }else { ?>
                                                          <center><img src="assets/img/durable/<?php echo $meResult['du_img']; ?>" style="width:20%;"></center>
                                                        <?php } ?>
                                                      </td>
                                                      <td>
                                                          <?php echo $meResult['du_id']; ?>
                                                      </td>
                                                      <td>
                                                          <?php echo $meResult['cat_name']; ?>
                                                      </td>
                                                      <td>
                                                          <?php echo $meResult['du_name']; ?>
                                                      </td>

                                                      <input type="hidden" name="du_id[]" value="<?php echo $meResult['id']; ?>" />

                                                      <td class="text-center">
                                                          <a class="btn btn-danger" href="admin_remove_cart1.php?itemId1=<?php echo $meResult['id']; ?>" role="button">
                                                              <i class="glyphicon glyphicon-trash"></i>
                                                              ไม่เลือก</a>
                                                      </td>
                                                  </tr>
                                              <?php } ?>
                                          </tbody>
                                      </table>
                                      <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">อาการ</label>
                                    <div class="col-sm-7">
                                    <textarea type="text" class="form-control" placeholder="อาการของอุปกรณ์ที่ท่านแจ้งซ่อม..." name="field_repair_detail"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-7">
                                        <button type="submit" class="btn btn-success"> ยืนยัน </button>
                                        <button type="button" class="btn btn-danger" onclick="history.go(-1)"> ยกเลิก </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/custom.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script>
    $(document).ready(function(){

     load_data();

     function load_data(query){
      $.ajax({
       url:"search_repair.php",
       method:"POST",
       data:{query:query},
       success:function(data){
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
    <script type="text/javascript">
     $('#field_build_id').change(function() {
                var aaa=$(this).val()
                $.ajax({

                        type: 'GET',
                        data: {field_build_id:aaa},
                        url: 'admin_ajax.php',
                        success: function(data) {
                                $('#field_room_id').html(data);
                        }
                });
        });
        $('#field_room_id').change(function() {
                   var bbb=$(this).val()
                   $.ajax({

                           type: 'GET',
                           data: {field_room_id:bbb},
                           url: 'admin_ajax.php',
                           success: function(data) {
                                   $('#field_du_id').html(data);
                           }
                   });
           });
    </script>


</body>
</html>
