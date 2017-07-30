<?php
include("connectdb.php");
if($_GET["Action"] == "check_id"){

  foreach ($_POST['field_id'] as $key => $value) {

    $field_id = $_POST["field_id"][$key];
    //เช็คจากตาราง User
    $sql = "SELECT * FROM durable WHERE du_id='$field_id'";
    $result = mysql_query($sql);
  }
    if(mysql_num_rows($result) == 0){
      echo "true,<img src='assets/img/success.png' width='20px' height='20px'/>";
    }
    else{
      echo "false,<span style='color:red'>มีรหัสครุภัณฑ์ซ้ำกัน...</span>";
    }
  }

if($_GET["Action"] == "check"){
  $field_id = $_POST["field_id"];
  //เช็คจากตาราง User
  $sql = "SELECT * FROM durable WHERE du_id='$field_id'";
  $result = mysql_query($sql);
  if(mysql_num_rows($result) == 0){
    echo "true,<img src='assets/img/success.png' width='20px' height='20px'/>";
  }
  else{
    echo "false,<span style='color:red'>มีรหัสครุภัณฑ์ซ้ำกัน...</span>";
  }
}

?>
