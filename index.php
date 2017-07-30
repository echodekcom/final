<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">

<head>

    <title>ยินดีต้อนรับเข้าสู่ระบบจัดการครุภัณฑ์สาขาคอมพิวเตอร์ มหาวิทยาลัยราชภัฏยะลา</title>

    <!-- Bootstrap -->
    <link rel="icon" href="./assets/img/logo.png" type="image/png" sizes="16x16">
    <link href="assets/css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
</head>
<style type="text/css">
    body {
        background: url(assets/img/yru.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    a{
        padding-top:200px;
    }
</style>
<style>
@import url('https://fonts.googleapis.com/css?family=Kanit:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');
body{
  font-family: 'Kanit', sans-serif;
}
</style>
<body>
    <div class="main">
      <div class="container">
          <center>
            <img src="assets/img/logo.png" class="img-responsive" height="180" width="150"><br><br>
            <h1 class="text-center" style="color:#ffffff">ระบบจัดการครุภัณฑ์สาขาคอมพิวเตอร์ <br><br>มหาวิทยาลัยราชภัฏยะลา</h1><br>
            <div class="middle">
              <div id="login">
                <form method="POST" action="admin_login.php">
                      <p><span class="fa fa-user"></span><input type="text" name="user" Placeholder="Username" autocomplete="off" required="required" autofocus></p> <!-- JS because of IE support; better: placeholder="Username" -->
                      <p><span class="fa fa-lock"></span><input type="password" name="pass" Placeholder="Password" autocomplete="off" required="required"></p> <!-- JS because of IE support; better: placeholder="Password" -->
                    <div>
                    <span style="width:100%; text-align:center; display:inline-block;"><input type="submit" value="เข้าสู่ระบบ"> <input type="reset" value="ล้างข้อมูล"></span>
                    </div>
                </form>
              </div> <!-- end login -->
            </div>
          </center>
      </div>
    </div>


</body>

</html>
