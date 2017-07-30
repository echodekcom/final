<?php
	require_once ("connectdb.php");

	session_start();

    $mem_user = $_POST['user'];
    $mem_pass = $_POST['pass'];

	$check = "SELECT * FROM member WHERE mem_user='$mem_user' AND mem_pass='$mem_pass'";
	$query = mysql_query($check);
	$result = mysql_fetch_array($query);


    if($result){
    	$_SESSION['mem_id'] = $result['mem_id'];
        $_SESSION['mem_name'] = $result['mem_name'];
        $_SESSION['mem_lname'] = $result['mem_lname'];
    	$_SESSION['mem_status'] = $result['mem_status'];

    	echo "<script>window.location='home.php';</script>";
    }else{
    	echo "<script>alert('Wrong password')</script>";
    	echo "<script>history.back();</script>";
    }

?>
