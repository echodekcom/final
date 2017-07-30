<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
  <head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search Durable</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
  </head>
  <style>
  @import url('https://fonts.googleapis.com/css?family=Kanit:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');
  body{
    font-family: 'Kanit', sans-serif;
  }
  </style>
  <body>
    <?php
    //fetch.php
    require_once 'connectdb.php';
    $output = '';
    if(isset($_POST["query"]))
    {
     $search = mysql_real_escape_string($_POST["query"]);
     $select = "SELECT * FROM durable NATURAL JOIN category NATURAL JOIN room NATURAL JOIN building
      WHERE du_id LIKE '%".$search."%'
      OR du_name LIKE '%".$search."%'
      OR cat_name LIKE '%".$search."%'
      OR du_status LIKE '%".$search."%'
      OR build_name LIKE '%".$search."%'
      OR room_name LIKE '%".$search."%' ";

    }
    $query = mysql_query($select);
    if($query > 0)
    {
     $output
    ?>
      <div class="table-responsive">
       <table class="table table-striped table-bordered table-hover">
        <tr>
            <th class="text-center" width="100">รูปครุภัณฑ์</th>
            <th class="text-center" width="100">รหัสครุภัณฑ์</th>
            <th class="text-center" width="150">ชื่อครุภัณฑ์</th>
            <th class="text-center" width="140">สถานะ</th>
            <th class="text-center" width="80">รายละเอียดครุภัณฑ์</th>
            <th class="text-center" width="80">แจ้งซ่อม</th>
        </tr>
     <?php
     while($result = mysql_fetch_array($query))
     {
      $output
     ?>
      <tbody>
         <tr class="odd gradeX">
              <td class="text-center">
                <?php if ($result["du_img"]==""){
                    echo "<center><font color=MediumOrchid'>ไม่มีรูปภาพ</font></center>";
                ?>
                <?php }else { ?>
                  <center><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#du_img<?php echo $result["id"];?>'>ดูรูปภาพ</button></center>
                <?php } ?>
              </td>
              <td class="text-center"><?php echo $result["du_id"]; ?></td>
              <td class="text-center"><?php echo $result["du_name"]; ?></td>
              <td class="text-center">

                <?php if ($result["du_bstatus"]==0) {
                    echo "<font size='4'><span class='label label-success'>ว่าง</span><font>";

                  }else if($result["du_bstatus"]==1){
                    echo "<font size='4'><span class='label label-warning'>ไม่ว่าง</span><font> <br>";

                    $sel = mysql_query("SELECT * FROM borrow NATURAL JOIN borrow_detail WHERE id='".$result['id']."' AND bd_status=1");

                    while($re = mysql_fetch_array($sel)){

                    $date = date_create($re['b_date']);
                    $rdate = date_create($re['b_rdate']);


                      echo "<font size='2'>(".date_format($date,'d/m/Y')." - ".date_format($rdate,'d/m/Y').")<font><br>";

                    }}else{

                      echo "<font size='4'><span class='label label-warning'>จองแล้ว</span><font> <br>";

                    $sel = mysql_query("SELECT * FROM borrow NATURAL JOIN borrow_detail WHERE id='".$result['id']."' AND bd_status=1");
                    while($re = mysql_fetch_array($sel)){

                    $date = date_create($re['b_date']);
                    $rdate = date_create($re['b_rdate']);

                      echo "<font size='2'>(".date_format($date,'d/m/Y')." - ".date_format($rdate,'d/m/Y').")<font><br>";

                    }}?>

              </td>
              <td class="text-center"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#barcode<?php echo $result["id"]; ?>">รายละเอียดครุภัณฑ์</button></td>

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

              <div class="modal fade" id="barcode<?php echo $result["id"]; ?>">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" >
                                  <span aria-hidden="true">&times;</span>
                              </button>
                              <center><h4>รายละเอียดครุภัณฑ์ <?php echo $result["du_name"]; ?></h4></center>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                  <label class="col-md-3 col-md-offset-1">ประเภท : </label>
                                  <div class="col-md-8">
                                      <?php echo $result["cat_name"];?>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                  <label class="col-md-3 col-md-offset-1">ห้อง : </label>
                                  <div class="col-md-8">
                                      <?php echo $result["room_name"];?>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                  <label class="col-md-3 col-md-offset-1">รายละเอียดอื่นๆ : </label>
                                  <div class="col-md-8">
                                      <?php echo $result["du_details"];?>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <td class="text-center">
                <button class="btn btn-default" type="button" onclick="window.location.href='admin_update_cart.php?itemId=<?php echo $result["id"]; ?>'"> <i class="fa fa-plus"> ยืมครุภัณฑ์</i></button>
              </td>
          </tr>
     </tbody>
    <?php
     }
     echo $output;
    }
    ?>

    <script src="assets/js/jquery.min.js"></script>

  </body>
</html>
