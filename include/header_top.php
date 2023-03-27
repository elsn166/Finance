<?php 
//print_r($_SESSION);
if($_SESSION['emp_id'] == '' && $_SESSION['emp_name'] == '' && $_SESSION['role_id'] == '')
{
     header("Location:login.php");

}
else{
$userid= $_SESSION['emp_id'];
$emp_details=select_data(EMPLOYEE_MASTER,"where employee_id='$userid' ");
$session_branch_id = $emp_details[0]['branch_id'];
$branch_code = branch_code($session_branch_id);
}

?>
<style>
 .wrapper{font-size:14px!important;}
 </style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
   
       <!-- <div style="color:white;margin-left:50px;margin-top:7px;"> <h4>Dashboard</h4></div> -->
     
      <div style="margin-top: 2px;
    font-size: 20px; font-weight: 600;color: white!important;">
          BBC
      </div> 
      <div style="margin-top: 2px;
    font-size: 20px; font-weight: 600;color: white!important;">

    <?php echo $branch_code;?>
           </div> 


    </ul>


 
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu" style="margin-left: 850px;">
   

  

            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php //echo $logtype; ?>
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
             
              <li class="user-footer">
                <div class="float-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="float-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          </ul>


      
  </nav><!-- Header Navbar: style can be found in header.less -->
    
  <!-- /.navbar -->