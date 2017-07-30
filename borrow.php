<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ยืมครุภัณฑ์</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/jquery.datetimepicker.css" rel="stylesheet" />
</head>
<body>
   <?php require_once 'nav.php'; ?>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>ยืมครุภัณฑ์</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ข้อมูลที่ต้องการยืม
                        </div>
                        <div class="panel-body">

                          <form class="form-horizontal" method="post" action="borrow_add.php?mem_id=<?php echo $_SESSION['mem_id'];?>" >
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
                                        <br>
                                    </div>
                                    <div id="result"></div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ครุภัณฑ์ที่เลือก</label>

                                    <div class="col-sm-9">
                                      <?php

                                          $itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                                          if (isset($_SESSION['qty']))
                                          {
                                              $meQty = 0;
                                              foreach ($_SESSION['qty'] as $meItem)
                                              {
                                                  $meQty = $meQty + $meItem;
                                              }
                                          } else
                                          {
                                              $meQty = 0;
                                          }
                                          if (isset($_SESSION['cart']) and $itemCount > 0)
                                          {
                                              $itemIds = "";
                                              foreach ($_SESSION['cart'] as $itemId)
                                              {
                                                  $itemIds = $itemIds . $itemId . ",";
                                                  echo $itemId;
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
                                                  <th class="text-center" width="100">หมายเลขครุภัณฑ์</th>
                                                  <th class="text-center" width="80">ชื่อครุภัณฑ์</th>
                                                  <th class="text-center" width="100">สถานะ</th>
                                                  <th class="text-center" width="80">ดำเนินการ</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                              while ($meResult = mysql_fetch_array($meQuery))
                                              {
                                                  $key = array_search($meResult['id'], $_SESSION['cart']);

                                                  ?>
                                                  <tr>
                                                      <td>
                                                          <?php echo $meResult['du_id']; ?>
                                                      </td>
                                                      <td>
                                                          <?php echo $meResult['du_name']; ?>
                                                      </td>
                                                      <td class="text-center">

                                                        <?php if ($meResult["du_bstatus"]==0) {
                                                            echo "<font size='4'><span class='label label-success'>ว่าง</span><font>";

                                                          }else if($meResult["du_bstatus"]==1){
                                                            echo "<font size='4'><span class='label label-warning'>ไม่ว่าง</span><font> <br>";

                                                            $sel = mysql_query("SELECT * FROM borrow NATURAL JOIN borrow_detail WHERE id='".$meResult['id']."' AND bd_status=1");

                                                            while($re = mysql_fetch_array($sel)){

                                                            $date = date_create($re['b_date']);
                                                            $rdate = date_create($re['b_rdate']);


                                                              echo "<font size='2'>(".date_format($date,'d/m/Y')." - ".date_format($rdate,'d/m/Y').")<font><br>";

                                                            }}else{

                                                              echo "<font size='4'><span class='label label-warning'>จองแล้ว</span><font> <br>";

                                                            $sel = mysql_query("SELECT * FROM borrow NATURAL JOIN borrow_detail WHERE id='".$meResult['id']."' AND bd_status=1");
                                                            while($re = mysql_fetch_array($sel)){

                                                            $date = date_create($re['b_date']);
                                                            $rdate = date_create($re['b_rdate']);

                                                              echo "<font size='2'>(".date_format($date,'d/m/Y')." - ".date_format($rdate,'d/m/Y').")<font><br>";

                                                            }}?>

                                                      </td>


                                                      <input type="hidden" name="du_id[]" value="<?php echo $meResult['id']; ?>" />

                                                      <td class="text-center">
                                                          <a class="btn btn-danger" href="admin_remove_cart.php?itemId=<?php echo $meResult['id']; ?>" role="button">
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
                                    <label class="col-sm-2 control-label">วันที่ยืม</label>
                                    <div class="col-sm-7">
                                    <input type="text" id="startDate" name="startDate" placeholder="วัน/เดือน/ปี ที่ยืม" autocomplete="off" class="form-control" value="<?php echo $_SESSION['startDate']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">วันที่คืน</label>
                                    <div class="col-sm-7">
                                    <input type="text" id="endDate" name="endDate" placeholder="วัน/เดือน/ปี ที่คืน" autocomplete="off" class="form-control" value="<?php echo $_SESSION['endDate'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">เหตุผลที่ยืม</label>
                                    <div class="col-sm-7">
                                    <textarea type="text" class="form-control" placeholder="เหตุผลที่ยืมครุภัณฑ์นี้..." name="b_detail"></textarea>
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
       url:"search_borrow.php",
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
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/tooltip.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.datetimepicker.full.js"></script>

    <script type="text/javascript">
    $(function(){

        var optsDate = {
            format:'d/m/Y', // รูปแบบวันที่
            formatDate:'d/m/Y',
            yearOffset:543,
            timepicker:false,
            closeOnDateSelect:true,
        }
        var setDateFunc = function(ct,obj){
            var minDateSet = $("#startDate").val();
            var maxDateSet = $("#endDate").val();

            if($(obj).attr("id")=="startDate"){
                this.setOptions({
                    minDate:false,
                    maxDate:maxDateSet?maxDateSet:false
                })
            }
            if($(obj).attr("id")=="endDate"){
                this.setOptions({
                    maxDate:false,
                    minDate:minDateSet?minDateSet:false
                })
            }
        }

        var setTimeFunc = function(ct,obj){
            var minDateSet = $("#startDate").val();
            var maxDateSet = $("#endDate").val();
        }

        $("#startDate,#endDate").datetimepicker($.extend(optsDate,{
            onShow:setDateFunc,
            onSelectDate:setDateFunc,
        }));

        $.datetimepicker.setLocale('th'); // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.

    });
    </script>

</body>
</html>
