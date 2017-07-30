<?php
	require_once ("connectdb.php");

	session_start();
	  if($_SESSION['mem_status']==""){
	  	echo "<script>alert ('กรุณาเข้าสู่ระบบ');</script>";
	    echo "<script>window.location='index.php';</script>";
	}
?>
