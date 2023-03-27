<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_branch_id = $_SESSION['bid'];
$session_role_id=$_SESSION['role_id'];

if($session_role_id==1)
{
  $disabled="readonly";
}
else{
  if(isset($_GET['action']) && $_GET['action']=='view'){ 
    $disabled = "disabled";
  }
  else{
    $disabled="";
  }
}
$second_depositor_id='';

if(isset($_GET['account_id']) && $_GET['account_id']!="" )
{
    $account_id=$_GET['account_id'];
    $account_details=select_data(ACCOUNT_MASTER,"where account_id='$account_id' ");
    $second_depositor_id=$account_details[0]['second_depositor_id'];
    
    
}


if(isset($_POST['update']))
{
  
  $second_depositor_id=$_POST['second_depositor_id'];
 

  $data['second_depositor_id']=$second_depositor_id;

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $update=update_data(ACCOUNT_MASTER,$data,"account_id",$_GET['account_id']);
  if($update!=0)
  { 
    echo "<script type='text/javascript'>window.location='account_nominee.php?account_id=".$_GET['account_id']."&success=Details Updated Successfully';</script>";
  }
        
}

?>
<style>
#inner {
    display: table;
    margin: 0 auto;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Account Details</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

    <?php  include("account_leftmenu.php"); ?>

      <!-- left column -->
      <div class="col-md-9">
           
    <!-- Horizontal Form -->
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">2nd Depositor Details</h3>
           <a class="btn-sm btn-success float-right" href="account_view.php">Back</a> 
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">


<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>

        <div class="card-body">
       

        <div class="form-group row">
            <label for="customer_id" class="col-sm-2 col-form-label">Member Number</label>
            <div class="col-sm-5">
              <select name="second_depositor_id" class="form-control select2" id="second_depositor_id" <?php echo $disabled; ?>>
              <option value="">Select Member Number</option>
              <?php
              if($session_role_id == 1 || $session_role_id == 7 || $session_role_id == 9)
              {
              
                $member_list=select_data(CUSTOMER_MASTER," ORDER BY customer_id ASC");
              
              }
              else{
              
                $member_list=select_data(CUSTOMER_MASTER," where branch_id='".$session_branch_id."' ORDER BY customer_id ASC");
              
              }
             
              foreach($member_list as $ml)
              {
              ?>
                <option value="<?php echo $ml['customer_id'];?>" <?php if($second_depositor_id == $ml['customer_id']){ echo 'selected'; } ?>><?php echo $ml['customer_no'].'-'.$ml['customer_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>

 <div class="form-group row">
      <label for="member_name" class="col-sm-2 col-form-label">Member Full Name</label>
      <div class="col-sm-5">
        <input type="text" name="member_name" class="form-control" id="member_name" placeholder="Enter Member Name" value="" <?php echo $disabled; ?> />
      </div>
    </div>

        <div class="form-group row">
      <label for="mother_name" class="col-sm-2 col-form-label">Mother Name</label>
      <div class="col-sm-5">
        <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Enter Mother Name" value="" <?php echo $disabled; ?> />
      </div>
    </div>

      <div class="form-group row">
      <label for="dob" class="col-sm-2 col-form-label">DOB</label>
      <div class="col-sm-5">
        <input type="text" name="dob" class="form-control" id="dob" placeholder="Select Date" value="" <?php echo $disabled; ?> />
      </div>
    </div>


        <div class="form-group row">
      <label for="dob" class="col-sm-2 col-form-label">Gender</label>
      <div class="col-sm-5">
        <input type="text" name="gender" class="form-control" id="gender" placeholder="Enter Gender" value="" <?php echo $disabled; ?> />
      </div>
    </div>

      <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-5">
        <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="" <?php echo $disabled; ?> />
      </div>
    </div>

     <div class="form-group row">
      <label for="pan_no" class="col-sm-2 col-form-label">PAN No.</label>
      <div class="col-sm-5">
        <input type="text" name="pan_no"  class="form-control" id="pan_no" placeholder="Enter PAN No" value="" <?php echo $disabled; ?> />
      </div>
    </div>

     <div class="form-group row">
      <label for="aadhar_no" class="col-sm-2 col-form-label">Aadhaar No.</label>
      <div class="col-sm-5">
        <input type="text" name="aadhar_no"  class="form-control" id="aadhar_no" placeholder="Enter Aadhaar No" value="" <?php echo $disabled; ?> />
      </div>
    </div>


    <div class="form-group row">
      <label for="mobile_no" class="col-sm-2 col-form-label">Mobile No.</label>
      <div class="col-sm-5">
        <input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Enter Mobile No" value="" <?php echo $disabled; ?> />
      </div>
    </div>

  
          
        </div>
        <!-- /.card-body -->
        <br>
              <br>
        <div class="card-footer">

        <div id="inner">

        <?php if(((isset($_GET['action']) && $_GET['action'] == 'edit') || $session_role_id == 1) || !isset($_GET['action'])) {
              ?>

            <?php if(!isset($_GET['account_id'])) { ?>
              <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
                    <?php } else { ?>
            <button type="submit" class="btn-sm btn-success" id="submit" name="update" >Update</button>
                          <?php } ?>
              <a href=""><button type="button" class="btn-sm btn-default">Cancel</button></a>
          
        <?php } ?>
          </div>

          <!-- <button type="submit" name="submit" class="btn btn-success">Submit</button> -->
        </div>

                <!-- /.card-footer -->


              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>






 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>

 

<link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
 <script>
 
 $(function() {
  $( "#cheque_date" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
 });
});

$(document.body).on('change','#second_depositor_id',function(){
  var customer_id = $('#second_depositor_id').val();
    //  alert(customer_id);
    var dataString = "customer_id="+customer_id;
      $.ajax({ 
      type: "GET", 
      url: "ajax_data.php", 
      data: dataString, 
      success:  function(html){ 
        var subst=html.split('@');
        $("#member_name").val(subst[0]);
        $("#mother_name").val(subst[1]);
        $("#dob").val(subst[2]);
        $("#gender").val(subst[3]);
        $("#email").val(subst[4]);
        $("#pan_no").val(subst[5]);
        $("#aadhar_no").val(subst[6]);
        $("#mobile_no").val(subst[7]);
      } 
    });
});
   </script>
</body>
</html>
