<?php
session_start();
require_once 'admin_login-c.php';
?>

<style>
@import url('https://fonts.googleapis.com/css?family=Kanit:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');
body{
  font-family: 'Kanit', sans-serif;
}
</style>

<?php
require 'connectdb.php';

$select = "SELECT * FROM member WHERE mem_id=".$_SESSION['mem_id']." ";
$result = mysql_query($select) or die ("Error Query [".$select."]");
$objResult = mysql_fetch_array($result);
?>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">YRU</a>
        </div>
        <div style="color: white;padding: 15px 50px 15px 50px;float: left;font-size: 20px;">
            ระบบจัดการครุภัณฑ์สาขาคอมพิวเตอร์ มหาวิทยาลัยราชภัฏยะลา
        </div>


        <div style="color: white;padding: 15px 50px 15px 50px;float: right;font-size: 16px;">
          <?php if($_SESSION['mem_status'] === 'admin'){
          echo "สถานะ : ผู้ดูแลระบบ&nbsp";
          }else{
          echo "สถานะ : ผู้ใช้งาน&nbsp";
          } ?>

          <?php if($_SESSION['mem_status'] === 'admin'){ ?>
          <div class="btn-group">
            <?php

              $select = "SELECT * FROM borrow NATURAL JOIN member WHERE msa_status=1";
              $query = mysql_query($select);
              $badge_number = mysql_num_rows($query);

              $select1 = "SELECT * FROM repair NATURAL JOIN member WHERE admin_status_read=1";
              $query1 = mysql_query($select1);
              $badge_number1 = mysql_num_rows($query1);

            ?>
              <!-- Single button -->
          <button type="button" id="btnBottom" data-placement="bottom" title="แจ้งเตือน" class="btn btn-default square-btn-adjust dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <?php if ($badge_number+$badge_number1!=0){ ?>
                <span class="badge badge_number"><?php echo $badge_number+$badge_number1; ?></span>
                <?php  } ?>
             <i class="fa fa-bell-o"></i> <span class="caret"></span>
          </button>
          <?php if ($badge_number+$badge_number1!=0){ ?>
          <ul class="dropdown-menu" style="left: -175px;min-width: 250px">
          <?php  }else{ ?>
          <ul class="dropdown-menu" style="left: -200px;min-width: 250px">
          <?php  } ?>
            <li>
                <div class="text-center" style="color:black">แจ้งเตือนการยืม</div>
                <?php while ($result=mysql_fetch_array($query)) { ?>
                <div role="separator" class="divider"></div>
                <div> <?php echo "&nbsp;&nbsp;"; ?> <a href="manage_borrow.php?Action=read&b_id=<?php echo $result["b_id"]; ?>">
                  <?php if ($result["msa_status"]==1) {
                    echo "รายการใหม่จาก".$result["mem_name"]."&nbsp;&nbsp;".$result["mem_lname"];
                  } ?>
                </a></div>
                <?php }?>
            </li>
            <div role="separator" class="divider"></div>
            <li>
                <div class="text-center" style="color:black">แจ้งเตือนการแจ้งซ่อม</div>
                <?php while ($result1=mysql_fetch_array($query1)) { ?>
                <div role="separator" class="divider"></div>
                <div> <?php echo "&nbsp;&nbsp;"; ?> <a href="repair_info.php?Action=read&repair_id=<?php echo $result1["repair_id"]; ?>">
                  <?php if ($result1["admin_status_read"]==1) {
                    echo "รายการใหม่จาก&nbsp;".$result1["mem_name"]."&nbsp;&nbsp;".$result1["mem_lname"];
                  } ?>
                </a></div>
                <?php }?>
            </li>
          </ul>
        </div>
        <?php }else { ?>
          <div class="btn-group">
            <?php

            $select2 = "SELECT * FROM borrow WHERE msu_status=1 AND mem_id='".$_SESSION['mem_id']."'";
            $query2 = mysql_query($select2);
            $badge_number2 = mysql_num_rows($query2);

            $select3 = "SELECT * FROM repair WHERE user_status_read=1 OR user_status_read=3 OR user_status_read=4 AND mem_id='".$_SESSION['mem_id']."'";
            $query3 = mysql_query($select3);
            $badge_number3 = mysql_num_rows($query3);

            ?>
              <!-- Single button -->
              <button type="button" id="btnBottom" data-placement="bottom" title="แจ้งเตือน" class="btn btn-default square-btn-adjust dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <?php if ($badge_number2+$badge_number3!=0){ ?>
                    <span class="badge badge_number"><?php echo $badge_number2+$badge_number3; ?></span>
                    <?php  } ?>
                 <i class="fa fa-bell-o"></i> <span class="caret"></span>
              </button>
          <?php if ($badge_number2+$badge_number3!=0){ ?>
          <ul class="dropdown-menu" style="left: -175px;min-width: 250px">
          <?php  }else{ ?>
          <ul class="dropdown-menu" style="left: -200px;min-width: 250px">
          <?php  } ?>
            <li>
                <div class="text-center" style="color:black">แจ้งเตือนการยืม</div>
                <?php while ($result2=mysql_fetch_array($query2)) { ?>
                <div role="separator" class="divider"></div>
                <div> <?php echo "&nbsp;&nbsp;"; ?> <a href="borrow_mine.php?Action=read&b_id=<?php echo $result2["b_id"]; ?>">
                  <?php if ($result2["msu_status"]==1) {
                    echo "รายการของคุณมีการอัพเดท";
                  } ?>
                </a></div>
                <?php }?>
            </li>
            <div role="separator" class="divider"></div>
            <li>
                <div class="text-center" style="color:black">แจ้งเตือนการแจ้งซ่อม</div>
                <?php while ($result3=mysql_fetch_array($query3)) { ?>
                <div role="separator" class="divider"></div>
                <div> <?php echo "&nbsp;&nbsp;"; ?> <a href="repair_mine.php?Action=read&repair_id=<?php echo $result3["repair_id"]; ?>">
                  <?php if ($result3["user_status_read"]!=2) {
                    echo "รายการของคุณมีการอัพเดท";
                  } ?>
                </a></div>
                <?php }?>
            </li>
          </ul>
        </div>
        <?php } ?>

            <a href="admin_logout.php" class="btn btn-danger square-btn-adjust">ออกจากระบบ</a>
        </div>
    </nav>

    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
            <li class="text-center">
              <?php if ($objResult['mem_img']=="user.jpg") {?>
                <img src="assets/img/profile/<?php echo $objResult['mem_img']; ?>" class="img-responsive" id="btnRight" data-placement="bottom" title="คลิกเพื่อแก้ไขรูปโปรไฟล์" data-toggle="modal" data-target="#upload_profile"/>
                <?php }else { ?>
                  <img src="assets/img/profile/<?php echo $objResult['mem_img']; ?>" class="img-responsive" id="btnRight" data-placement="bottom" title="คลิกเพื่อแก้ไขรูปโปรไฟล์" data-toggle="modal" data-target="#update_profile"/>
                <?php } ?>
                </li>
                <li>
                    <a class="active-menu" href="home.php"><i class="fa fa-home fa-2x">
                    </i>หน้าแรก</a>
                </li>

                <li><a href="category.php"><i class="fa fa-desktop fa-2x"></i>ประเภทครุภัณฑ์</a></li>
                <li><a href="durable.php"><i class="fa fa-list-alt fa-2x"></i>ครุภัณฑ์ทั้งหมด</a></li>
                <?php if($_SESSION['mem_status'] === 'admin'){ ?>
                <li>
                    <a  href=""><i class="fa fa-cogs fa-2x"></i>จัดการข้อมูลต่างๆ<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="manage_building.php">จัดการข้อมูลอาคารและห้อง</a></li>
                        <li><a href="manage_category.php">จัดการข้อมูลประเภทครุภัณฑ์</a></li>
                        <li><a href="manage_durable.php">จัดการข้อมูลครุภัณฑ์</a></li>
                    </ul>
                </li>
                <li>
                    <a  href=""><i class="fa fa-share-square-o fa-2x"></i>รายการยืม<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="manage_borrow.php">รายการยืมทั้งหมด</a></li>
                        <li><a href="borrow_accept.php">รายการยืมที่อนุมัติ</a></li>
                        <li><a href="borrow_cancel.php">รายการยืมที่ไม่อนุมัติ</a></li>
                        <li><a href="borrow_return.php">รายการยืมที่คืนแล้ว</a></li>
                    </ul>
                </li>
                <li>
                    <a  href=""><i class="fa fa-wrench fa-2x"></i>รายการแจ้งซ่อม<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="repair_info.php">รายการแจ้งซ่อมทั้งหมด</a></li>
                        <li><a href="repair_success.php">รายการครุภัณฑ์ที่ซ่อมแล้ว</a></li>
                        <li><a href="repair_fail.php">รายการครุภัณฑ์ที่เสีย</a></li>
                    </ul>
                </li>
                <li>
                    <a  href=""><i class="fa fa-print fa-2x"></i>รายงาน<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="admin_report_borrow.php">รายงานการยืม</a></li>
                        <li><a href="admin_report_repair.php">รายงานการแจ้งซ่อม</a></li>
                    </ul>
                </li>
                <?php }else{ ?>
                <li>
                    <a  href="#"><i class="fa fa-share-square-o fa-2x"></i>ยืมครุภัณฑ์<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="borrow.php">ยืมครุภัณฑ์</a></li>
                        <li><a href="borrow_mine.php">รายการยืมของฉัน</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-wrench fa-2x"></i>แจ้งซ่อมครุภัณฑ์<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                      <li><a href="repair.php">แจ้งซ่อมครุภัณฑ์</a></li>
                      <li><a href="repair_mine.php">รายการแจ้งซ่อมของฉัน</a></li>
                      <li><a href="repair_info.php">รายการแจ้งซ่อมทั้งหมด</a></li>
                  </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>

<!-- Modal อัพโหลดรูปโปรไฟล์-->
<div class="modal fade" id="upload_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">อัพโหลดรูปโปรไฟล์</h4>
    </div>
    <div class="modal-body">
    <center><img src="assets/img/profile/<?php echo $objResult['mem_img']; ?>" class="user-image img-responsive"/>
    <form action="admin_save_img.php?mem_id=<?php echo $_SESSION["mem_id"];?>" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk1();">
      <center><label class="btn btn-success">
          <input type="file" name="fileupload" id="fileupload" style="display:none;" accept="image/*" onchange="loadFile1(event)">
          เลือกรูปโปรไฟล์...
      </label></center><br>
      <img id="output" class="user-image img-responsive"//>
      <script>
        var loadFile1 = function(event) {
          var reader = new FileReader();
          reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
          };
          reader.readAsDataURL(event.target.files[0]);
        };
      </script>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
    </div>
  </form>
  </div>
</div>
</div>

<!-- Modal แก้ไขรูปโปรไฟล์-->
<div class="modal fade" id="update_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">แก้ไขรูปโปรไฟล์</h4>
      </div>
      <div class="modal-body">
      <center><img src="assets/img/profile/<?php echo $objResult['mem_img']; ?>" class="user-image img-responsive"/>
      <form action="admin_save_img.php?mem_id=<?php echo $_SESSION["mem_id"];?>" method="post" enctype="multipart/form-data" name="form2" id="form2" onsubmit="return chk2();">
        <input type="hidden" name="update_img_db" value="<?php echo $objResult["mem_img"];?>">
        <label class="btn btn-success">
            <input type="file" name="fileupload" id="fileupload" style="display:none;" accept="image/*" onchange="loadFile2(event)">
            เลือกรูปโปรไฟล์...
        </label><br>
        <img id="show" class="user-image img-responsive"//>
        <script>
          var loadFile2 = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
              var show = document.getElementById('show');
              show.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
          };
        </script>
        </center>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--script upload รูปภาพ-->
<script type="text/javascript">
    function chk1(){
    var fty=new Array(".gif",".jpg",".jpeg",".png"); // ประเภทไฟล์ที่อนุญาตให้อัพโหลด
    var a=document.form1.fileupload.value; //กำหนดค่าของไฟล์ใหกับตัวแปร a
    var permiss=0; // เงื่อนไขไฟล์อนุญาต
    a=a.toLowerCase();
    if(a !=""){
        for(i=0;i<fty.length;i++){ // วน Loop ตรวจสอบไฟล์ที่อนุญาต
            if(a.lastIndexOf(fty[i])>=0){  // เงื่อนไขไฟล์ที่อนุญาต
                permiss=1;
                break;
            }else{
                continue;
            }
        }
        if(permiss==0){
            alert("อัพโหลดได้เฉพาะไฟล์นามสกุล .gif .jpg .jpeg .png");
            return false;
        }
    }
    }
</script>

<!--script แก้ไขรูปภาพ-->
<script type="text/javascript">
    function chk2(){
    var fty=new Array(".gif",".jpg",".jpeg",".png"); // ประเภทไฟล์ที่อนุญาตให้อัพโหลด
    var a=document.form2.fileupload.value; //กำหนดค่าของไฟล์ใหกับตัวแปร a
    var permiss=0; // เงื่อนไขไฟล์อนุญาต
    a=a.toLowerCase();
    if(a !=""){
        for(i=0;i<fty.length;i++){ // วน Loop ตรวจสอบไฟล์ที่อนุญาต
            if(a.lastIndexOf(fty[i])>=0){  // เงื่อนไขไฟล์ที่อนุญาต
                permiss=1;
                break;
            }else{
                continue;
            }
        }
        if(permiss==0){
            alert("อัพโหลดได้เฉพาะไฟล์นามสกุล .gif .jpg .jpeg .png");
            return false;
        }
    }
    }
</script>
