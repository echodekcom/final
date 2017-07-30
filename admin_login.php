<?php
	require_once "connectdb.php";
	require_once 'nusoap/nusoap.php';

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
			$_SESSION['mem_user'] = $result['mem_user'];
			$_SESSION['mem_status'] = $result['mem_status'];
			//$_SESSION['mem_img'] = $result['mem_img'];



		}else{

			//Check อาจารย์
			$client = new nusoap_client('http://webservice.yru.ac.th/server/ns_getuser2.php?wsdl', true);
			$result = $client->call('getuser', array('username' => $mem_user,'password' => $mem_pass));

			//ถ้าเจออาจารย์
			if ($result) {
				$myarray=explode( "," ,$result);
				var_dump($myarray);

				$_SESSION['mem_name'] = $myarray[2].$myarray[3];
				$_SESSION['mem_lname'] = $myarray[4];
				$_SESSION['mem_status'] = "user";
				$_SESSION['mem_user'] = $mem_user;

					}else {

						//Check นักศึกษา
						$client = new nusoap_client('http://webservice.yru.ac.th/server/ns_getstudent.php?wsdl', true);
						$result = $client->call('auth', array('username' => $mem_user,'password' => $mem_pass));

							if ($result!="กรุณาตรวจสอบชื่อผู้ใช้และรหัสผ่าน") {
									$myarray=explode( "," ,$result);
									var_dump($myarray);
									$_SESSION['mem_name'] = $myarray[2].$myarray[3];
									$_SESSION['mem_lname'] = $myarray[4];
									$_SESSION['mem_status'] = "user";
									$_SESSION['mem_user'] = $mem_user;


					    }else {
					    	echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');</script>";
								echo "<script>history.back();</script>";
					    }

			}
		}

		if ($_SESSION['mem_status']!="") {

			$check = "SELECT * FROM member WHERE mem_user = '".$_SESSION['mem_user']."'";
			$query = mysql_query($check);
			$re = mysql_fetch_array($query);

			if (mysql_num_rows($query)==0) {

				$insert="INSERT INTO member SET mem_name='".$_SESSION['mem_name']."',mem_lname='".$_SESSION['mem_lname']."'
								 ,mem_user='".$_SESSION['mem_user']."',mem_status='".$_SESSION['mem_status']."' ";
				$query=mysql_query($insert);

				$_SESSION['mem_id']=mysql_insert_id();


			}else {
				$update="UPDATE member SET mem_name='".$_SESSION['mem_name']."',mem_lname='".$_SESSION['mem_lname']."' WHERE mem_user = '".$_SESSION['mem_user']."'";
				$query=mysql_query($update);

				$select="SELECT mem_id FROM member WHERE mem_user = '".$_SESSION['mem_user']."'";
				$q=mysql_query($select);
				$r = mysql_fetch_array($q);

				$_SESSION['mem_id']=$r['mem_id'];
				$_SESSION['mem_status']=$r['mem_status'];
			}
				$_SESSION['mem_status']=$re['mem_status'];
		}

		$sel = "SELECT * FROM borrow_detail NATURAL JOIN borrow WHERE bd_status = 1 AND b_date='".date('Y-m-d')."'";
		$que = mysql_query($sel);

		while($re = mysql_fetch_array($que)){

			$re['id'];

			$up = "UPDATE durable SET du_bstatus=1 WHERE id='".$re['id']."'";
			$qu = mysql_query($up);

		}

					$_SESSION['mem_id'];
					$_SESSION['mem_status'];
					$_SESSION['mem_img'] = $result['mem_img'];

					header('Location: home.php');
?>
