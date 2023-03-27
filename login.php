<?php session_start();
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");
if(isset($_POST['btnLogin']))
{

  $login_check = login($_POST['username'],$_POST['password']);
  if($login_check == 1)
  {
      header("Location:dashboard.php");
  }
  else if($login_check == 2){
    echo "<script type='text/javascript'>window.location='login.php?success=Employee Inactivated. Kindly Contact Admin';</script>";
  }
  else if($login_check == 3){
    echo "<script type='text/javascript'>window.location='login.php?success=Invalid Credentials';</script>";
  }


}
?>
<style>
h1 {
  margin: 73px -167px 0px;
  padding: 0px 30px 0px 30px;
  text-align: center;
}
</style>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Amudhini Multipurpose Kooturavu Sangam Nidhi Limited</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>

.alert-success {
    color: black;
    background: #b8bb53;
    border-color: #b8bb53;
}
  .login-page{
    background:#b8bb53;
  }
.form-control{
    border-right: 1 !important;
}
.card {
    box-shadow: 0 0 0 rgba(0,0,0,0), 0 0 0 rgba(0,0,0,0);
    margin-bottom: 0rem;
}
.login-card-body, .register-card-body {
  background:#b8bb53;
  color:black;
   
}
.btn-primary{
  background-color:#234c04;
  border-color:#234c04;
  margin-left: 117px;
  margin-top:32px;
}
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <br>
    <!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
    <img style="width:170px;max-width:170px;margin-top:-156px;" src="images/ADN.png"/>


    <h1 style="font-size:28px;font-weight:800;">AMUDHINI MULTIPURPOSE KOOTURAVU SANGAM NIDHI LIMITED</h1>
<br>

  </div>

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body" style="margin-top:-42px;">
      <p class="login-box-msg" style="font-size: x-large;font-weight:600;">Log In </p>

<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible" style="margin:0 0 0 0px; !important;margin-left:-13px;width:400px;"><?php echo  $info;?></div>

<?php } ?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Employee Code" name="username">
          
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          
        </div>
        <div class="row">
         
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="btnLogin" id="btnLogin">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
