<?php
session_start();
require_once ("connectdb.php");

	if ($_GET['field_cat_id']) {
        $field_cat_id = isset($_GET['field_cat_id']) ? $_GET['field_cat_id'] : "";

        $query = mysql_query("SELECT d.*,c.* FROM durable d left join category c ON d.cat_id = c.cat_id WHERE d.cat_id='{$field_cat_id}'");
        $Rows = mysql_num_rows($query);

        if($Rows > 0) {
            while ($Result = mysql_fetch_array($query)) {?>
                <br>
                <div class="table-responsive">
                <?php
                    $check = "SELECT * FROM borrow_detail NATURAL JOIN borrow WHERE b_rdate > '".$_SESSION['startDate']."' AND bd_status=1 ";
                      $query1 = mysql_query($check);
                      
                      while ($result1=mysql_fetch_array($query1)) {
                        
                        $result1['id'];
                        
                        $id=array($result1['id']);

                        foreach ($id as $key) {
                          $select = "SELECT * FROM durable NATURAL JOIN category NATURAL JOIN room NATURAL JOIN borrow   WHERE id != $key";
                          $query = mysql_query($select);
                        }
                      }
                                  
                ?>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="100">รูปครุภัณฑ์</th>
                            <th class="text-center" width="100">รหัสครุภัณฑ์</th>
                            <th class="text-center" width="150">ชื่อครุภัณฑ์</th>
                            <th class="text-center" width="80">รายละเอียดครุภัณฑ์</th>
                            <th class="text-center" width="80">เพิ่มลงในตะกร้า</th>
                        </tr>
                    </thead>
                    <?php while ($result=mysql_fetch_array($query)) { ?>
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
                                                <label class="col-md-3 col-md-offset-1">ห้องที่เก็บ : </label>
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

                            <td>
                            <button class="btn btn-default" type="button" onclick="window.location.href='admin_update_cart.php?itemId=<?php echo $result["id"]; ?>'"> <i class="fa fa-plus"> ยืมครุภัณฑ์</i></button>
                            </td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </div>

				<?php
			}
		}else{
			echo "ไม่มีอุปกรณ์";
		}

	}else if($_GET['field_build_id']) {
		$field_build_id = isset($_GET['field_build_id']) ? $_GET['field_build_id'] : "";

		$query = mysql_query("SELECT r.*,b.* FROM room r left join building b ON r.build_id = b.build_id WHERE r.build_id='{$field_build_id}'");
		$Rows = mysql_num_rows($query);

		if($Rows > 0) {
			while ($Result = mysql_fetch_array($query)) {
	echo "<option value=\"" . $Result['room_id'] . "\">" . $Result['room_name'] ."</option>";
			}
		}else{
			echo "<option value=\"\">ไม่มีห้อง</option>";
		}

	}else {
		$field_room_id = isset($_GET['field_room_id']) ? $_GET['field_room_id'] : "";

		$query = mysql_query("SELECT d.*,r.* FROM durable d left join room r ON d.room_id = r.room_id WHERE d.room_id='{$field_room_id}' AND d.du_status!='รอซ่อม/กำลังซ่อม' AND d.du_bstatus='0'");
		$Rows = mysql_num_rows($query);

		if($Rows > 0) {
			while ($Result = mysql_fetch_array($query)) {
	echo "<option value=\"" . $Result['id'] . "\">" . $Result['du_id'] ." " . $Result['du_name'] ."</option>";
			}
		}else{
			echo "<option value=\"\">ไม่มีครุภัณฑ์ในห้องนี้</option>";
		}
	}

?>
