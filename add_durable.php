<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<head>
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x20">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>เพิ่มข้อมูลครุภัณฑ์</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/jquery.datetimepicker.css" rel="stylesheet" />
    <script language="JavaScript" type="text/JavaScript">
        function MM_jumpMenu(targ,selObj,restore){
          eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
          if (restore) selObj.selectedIndex=0;
    }
    </script>
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
<?php
require_once 'nav.php';
require 'admin-c.php';
?>

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>เพิ่มข้อมูลครุภัณฑ์</h2>
                </div>
            </div>
            <hr />
            <form>
              <div class="form-group">
                  <div class="col-md-3">
                      <input type="radio" name="show" value="1" onclick="show_table(this.value);" checked> เพิ่มครุภัณฑ์หลายตัว
                  </div>
                  <div class="col-md-3">
                      <input type="radio" name="show" value="2" onclick="show_table(this.value);"> เพิ่มครุภัณฑ์หลายหมายเลข
                  </div>
              </div>
            </form>

            <br><hr>

            <form action="admin_add_durable.php" name="frmadd" method="post" enctype="multipart/form-data" id="f1">
                <div class="container">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">เลือกจำนวนรายการ :</div>
                                <div class="col-md-1">
                                    <select class="form-control" name="menu1" onChange="MM_jumpMenu('parent',this,0)">

                        <?php
                            for($i=1;$i<=50;$i++){
                            if($_GET["Line"] == $i){
                                $sel = "selected";
                            }else{
                                $sel = "";
                            }
                        ?>

                                    <option value="<?php echo $_SERVER["PHP_SELF"];?>?Line=<?php echo $i;?>" <?php echo $sel;?>><?php echo $i;?></option>
                        <?php } ?>
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
                <?php
                    $line = $_GET["Line"];
                    if($line == 0){$line=1;}
                    for($i=1;$i<=$line;$i++)
                    {
                    $i=1;
                    while ($i <= $line) {
                ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ครุภัณฑ์ที่ <?php echo $i; ?>  &nbsp;<font style ='float:right; color:#ff0000'>หมายเหตุ : ที่มีเครื่องหมาย * จำเป็นต้องกรอกข้อมูลให้ครบถ้วน</font>
                        </div>
                        <div class="panel-body">
                          <div class="form-group">
                            <div class="col-md-6">
                              <label>หมายเลขครุภัณฑ์ &nbsp;<font style ='color:#ff0000'>*</font></label> <span id="msg1"></span>
                              <input type="hidden" name="test[]" value="<?php echo $y;?>">
                              <input type="text" class="form-control" placeholder="หมายเลขครุภัณฑ์" name="field_id[]" id="field_id" required autofocus autocomplete="off" onkeyup="autoTab(this)">
                            </div>
                            <div class="col-md-6">
                              <label>เพิ่มรูปภาพ</label>
                              <input type="file" class="form-control" name="fileupload[]" autofocus autocomplete="off">
                            </div>
                          </div><br><br><br>
                          <div class="form-group">
                            <div class="col-md-6">
                              <label>ชื่อครุภัณฑ์ &nbsp;<font style ='color:#ff0000'>*</font></label>
                              <input type="text" class="form-control" placeholder="ชื่อครุภัณฑ์" name="field_name[]" required autocomplete="off">
                            </div>
                            <div class="col-md-6">
                              <label>ประเภท &nbsp;<font style ='color:#ff0000'>*</font></label>
                              <select class="form-control" name="field_cat[]" required>
                                  <option value="">--เลือกประเภท--</option>
                                  <?php
                                      require_once ("connectdb.php");
                                      $select = mysql_query ("SELECT * FROM category");
                                      while($result=mysql_fetch_array($select)){ ?>
                                      <option id="<?php echo $result['cat_id'];?>" value="<?php echo $result['cat_id'];?>"><?php echo $result['cat_name'];?></option>
                                  <?php } ?>
                              </select>
                            </div>
                          </div><br><br><br>
                          <div class="form-group">
                              <div class="col-md-6">
                                <label>วันเดือนปีที่รับมา &nbsp;<font style ='color:#ff0000'>*</font></label>
                                <input type="text" class="form-control" placeholder="เลือกวันเดือนปีที่รับมา" name="field_date[]" id="startDate" autocomplete="off" required>
                              </div>
                              <div class="col-md-6">
                                <label>ราคา &nbsp;<font style ='color:#ff0000'>*</font></label>
                                <div class="input-group">
                                <input type="text" class="form-control" placeholder="ราคา" name="field_price[]" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required autocomplete="off">
                                <div class="input-group-addon">บาท  </div>
                                </div>
                              </div>
                          </div><br><br><br>
                          <div class="form-group">
                            <div class="col-md-6">
                              <label>ห้อง &nbsp;<font style ='color:#ff0000'>*</font></label>
                              <select class="form-control" required name="field_room[]">
                                  <?php
                                      require_once ("connectdb.php");
                                      $select = mysql_query ("SELECT * FROM room NATURAL JOIN room_type");
                                      while($result=mysql_fetch_array($select)){
                                        if ($result['room_name']=="ไม่มีห้อง" && $result['roomt_name']=="ไม่มีประเภท" ) {?>
                                          <option id="<?php echo $result['room_id'];?>" value="<?php echo $result['room_id'];?>"><?php echo $result['room_name'];?></option>
                                      <?php }else{ ?>
                                      <option id="<?php echo $result['room_id'];?>" value="<?php echo $result['room_id'];?>"><?php echo $result['room_name'];?> <?php echo $result['roomt_name'];?></option>
                                  <?php }} ?>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label>รายละเอียด</label>
                              <textarea type="text" rows="3" cols="20" class="form-control" placeholder="รายละเอียด" name="field_detail[]" autocomplete="off"></textarea>
                            </div>
                          </div><br><br><br>
                          <div class="form-group">
                            <div class="col-md-12">

                            </div>
                          </div>
                        </div>
                    </div>
                    <?php $i++; } } ?>
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">เพิ่มข้อมูล</button>
                        <button class="btn btn-danger" type="submit" onclick="history.go(-1);">ยกเลิก</button>
                        <input type="hidden" name="hdnLine" value="<?php echo $i;?>">
                    </div>
                  </form>

                  <!-- ------------------------------------------------------------------------------------------------ -->

                  <form action="admin_add_durable1.php" name="frmadd" method="post" enctype="multipart/form-data" id="f2" style="display: none;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ข้อมูลครุภัณฑ์  &nbsp;<font style ='float:right; color:#ff0000'>หมายเหตุ : ที่มีเครื่องหมาย * จำเป็นต้องกรอกข้อมูลให้ครบถ้วน</font>
                        </div>
                        <div class="panel-body">
                          <div class="form-group">
                            <div class="col-md-4">
                              <label>หมายเลขครุภัณฑ์ &nbsp;<font style ='color:#ff0000'>*</font></label> <span id="msg2"></span>
                              <input type="text" class="form-control" placeholder="ตัวอย่าง : 01.01.01/01" name="field_id" id="field_id1" required autofocus autocomplete="off">
                            </div>
                            <div class="col-md-2">
                              <label> &nbsp;</label>
                              <input type="text" class="form-control" placeholder="จำนวน" name="field_c" required autofocus autocomplete="off">
                            </div>
                            <div class="col-md-6">
                              <label>เพิ่มรูปภาพ</label>
                              <input type="file" class="form-control" name="fileupload" autofocus autocomplete="off">
                            </div>
                          </div><br><br><br>
                          <div class="form-group">
                            <div class="col-md-6">
                              <label>ชื่อครุภัณฑ์ &nbsp;<font style ='color:#ff0000'>*</font></label>
                              <input type="text" class="form-control" placeholder="ชื่อครุภัณฑ์" name="field_name" required autocomplete="off">
                            </div>
                            <div class="col-md-6">
                              <label>ประเภท &nbsp;<font style ='color:#ff0000'>*</font></label>
                              <select class="form-control" name="field_cat" required>
                                  <option value="">--เลือกประเภท--</option>
                                  <?php
                                      require_once ("connectdb.php");
                                      $select = mysql_query ("SELECT * FROM category");
                                      while($result=mysql_fetch_array($select)){ ?>
                                      <option id="<?php echo $result['cat_id'];?>" value="<?php echo $result['cat_id'];?>"><?php echo $result['cat_name'];?></option>
                                  <?php } ?>
                              </select>
                            </div>
                          </div><br><br><br>
                          <div class="form-group">
                              <div class="col-md-6">
                                <label>วันเดือนปีที่รับมา &nbsp;<font style ='color:#ff0000'>*</font></label>
                                <input type="text" class="form-control" placeholder="เลือกวันเดือนปีที่รับมา" name="field_date" id="startDate" autocomplete="off" required>
                              </div>
                              <div class="col-md-6">
                                <label>ราคา &nbsp;<font style ='color:#ff0000'>*</font></label>
                                <div class="input-group">
                                <input type="text" class="form-control" placeholder="ราคา" name="field_price" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required autocomplete="off">
                                <div class="input-group-addon">บาท  </div>
                                </div>
                              </div>
                          </div><br><br><br>
                          <div class="form-group">
                            <div class="col-md-6">
                              <label>ห้อง &nbsp;<font style ='color:#ff0000'>*</font></label>
                              <select class="form-control" required name="field_room">
                                  <?php
                                      require_once ("connectdb.php");
                                      $select = mysql_query ("SELECT * FROM room NATURAL JOIN room_type");
                                      while($result=mysql_fetch_array($select)){
                                        if ($result['room_name']=="ไม่มีห้อง" && $result['roomt_name']=="ไม่มีประเภท" ) {?>
                                          <option id="<?php echo $result['room_id'];?>" value="<?php echo $result['room_id'];?>"><?php echo $result['room_name'];?></option>
                                      <?php }else{ ?>
                                      <option id="<?php echo $result['room_id'];?>" value="<?php echo $result['room_id'];?>"><?php echo $result['room_name'];?> <?php echo $result['roomt_name'];?></option>
                                  <?php }} ?>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label>รายละเอียด</label>
                              <textarea type="text" rows="3" cols="20" class="form-control" placeholder="รายละเอียด" name="field_detail" autocomplete="off"></textarea>
                            </div>
                          </div><br><br><br>
                          <div class="form-group">
                            <div class="col-md-12">

                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">เพิ่มข้อมูล</button>
                        <button class="btn btn-danger" type="submit" onclick="history.go(-1);">ยกเลิก</button>
                    </div>
                  </form>


              </div>
        </div>


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
    <script type="text/javascript">
    function autoTab(obj){
            var pattern=new String("__.__.___");
            var pattern_ex=new String("."); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
            var returnText=new String("");
            var obj_l=obj.value.length;
            var obj_l2=obj_l-1;
            for(i=0;i<pattern.length;i++){
                if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
                    returnText+=obj.value+pattern_ex;
                    obj.value=returnText;
                }
            }
            if(obj_l>=pattern.length){
                obj.value=obj.value.substr(0,pattern.length);
            }
    }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
          $("#field_id").change(function(){
            var flag;
            $.ajax({
              url: "admin_check_durable.php?Action=check_id",
              data: "field_id[]=" + $("#field_id").val(),
              type: "POST",
              async:false,
              success: function(data, status) {
                 var result = data.split(",");
                 flag = result[0];
                 var msg = result[1];
                 $("#msg1").html(msg);
              },
              error: function(xhr, status, exception) { alert(status); }
            });
            return flag;
          });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
          $("#field_id1").change(function(){
            var flag;
            $.ajax({
              url: "admin_check_durable.php?Action=check",
              data: "field_id=" + $("#field_id1").val(),
              type: "POST",
              async:false,
              success: function(data, status) {
                 var result = data.split(",");
                 flag = result[0];
                 var msg = result[1];
                 $("#msg2").html(msg);
              },
              error: function(xhr, status, exception) { alert(status); }
            });
            return flag;
          });
        });
    </script>

</body>
</html>
