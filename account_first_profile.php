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

$first_depositor_id='';
$customer_name='';
$mother_name='';
$dob='';
$gender_name='';
$email='';
$pan_no='';
$aadhar_no='';
$mobile_number='';



if(isset($_GET['account_id']) && $_GET['account_id']!="" )
{
    $account_id=$_GET['account_id'];
    $account_details=select_data(ACCOUNT_MASTER,"where account_id='$account_id' ");
    $first_depositor_id=$account_details[0]['first_depositor_id'];
    if($first_depositor_id != '')
    {
    $customer_details=select_data(CUSTOMER_MASTER,"where customer_id='$first_depositor_id' ");
    $customer_name=$customer_details[0]['customer_name'];
    $mother_name=$customer_details[0]['mother_name'];
    $dob=$customer_details[0]['dob'];
    $gender_id=$customer_details[0]['gender_id'];
    $gender_details=select_data(TYPE_MASTER,"where type_id='$gender_id' ");
    $gender_name = $gender_details[0]['type_name'];
    $email=$customer_details[0]['email'];
    $pan_no=$customer_details[0]['pan_no'];
    $aadhar_no=$customer_details[0]['aadhar_no'];
    $mobile_number=$customer_details[0]['mobile_number'];
    }
    
    
}


if(isset($_POST['update']))
{
  
  $first_depositor_id=$_POST['first_depositor_id'];
 

  $data['first_depositor_id']=$first_depositor_id;

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $update=update_data(ACCOUNT_MASTER,$data,"account_id",$_GET['account_id']);
  if($update!=0)
  { 
    echo "<script type='text/javascript'>window.location='account_second_profile.php?account_id=".$_GET['account_id']."&success=Details Updated Successfully';</script>";
  }
        
}

?>
<style>

.invalid-feedback {
    display: inline;
    margin-left: 130px;
    font-size: 14px;
}

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
        <h3 class="card-title">1st Depositor Details</h3>
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
            <label for="customer_id" class="col-sm-2 col-form-label">Member Number<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="first_depositor_id" class="form-control select2" id="first_depositor_id" placeholder="Select Member Name" <?php echo $disabled; ?>>
              <option value="">Select</option>
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
                <option value="<?php echo $ml['customer_id'];?>" <?php if($first_depositor_id == $ml['customer_id']){ echo 'selected'; } ?>><?php echo $ml['customer_no'].'-'.$ml['customer_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>

 <div class="form-group row">
      <label for="member_name" class="col-sm-2 col-form-label">Member Full Name</label>
      <div class="col-sm-5">
        <input type="text" name="member_name" class="form-control" id="member_name" placeholder="Enter Member Name" value="<?php echo $customer_name; ?>" <?php echo $disabled; ?> />
      </div>
    </div>

        <div class="form-group row">
      <label for="mother_name" class="col-sm-2 col-form-label">Mother Name</label>
      <div class="col-sm-5">
        <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Enter Mother Name" value="<?php echo $mother_name; ?>" <?php echo $disabled; ?> />
      </div>
    </div>

      <div class="form-group row">
      <label for="dob" class="col-sm-2 col-form-label">DOB</label>
      <div class="col-sm-5">
        <input type="text" name="dob" class="form-control" id="dob" placeholder="Select Date" value="<?php echo $dob; ?>" <?php echo $disabled; ?> />
      </div>
    </div>


        <div class="form-group row">
      <label for="dob" class="col-sm-2 col-form-label">Gender</label>
      <div class="col-sm-5">
        <input type="text" name="gender" class="form-control" id="gender" placeholder="Enter Gender" value="<?php echo $gender_name; ?>" <?php echo $disabled; ?> />
      </div>
    </div>

      <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-5">
        <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="<?php echo $email; ?>" <?php echo $disabled; ?> />
      </div>
    </div>

     <div class="form-group row">
      <label for="pan_no" class="col-sm-2 col-form-label">PAN No.</label>
      <div class="col-sm-5">
        <input type="text" name="pan_no" class="form-control"  id="pan_no" placeholder="Enter PAN No" value="<?php echo $pan_no; ?>" <?php echo $disabled; ?> />
      </div>
    </div>

     <div class="form-group row">
      <label for="aadhar_no" class="col-sm-2 col-form-label">Aadhaar No.</label>
      <div class="col-sm-5">
        <input type="text" name="aadhar_no"  class="form-control" id="aadhar_no" placeholder="Enter Aadhaar No" value="<?php echo $aadhar_no; ?>" <?php echo $disabled; ?> />
      </div>
    </div>


    <div class="form-group row">
      <label for="mobile_no" class="col-sm-2 col-form-label">Mobile No.</label>
      <div class="col-sm-5">
        <input type="text" name="mobile_no"  class="form-control" id="mobile_no" placeholder="Enter Mobile No" value="<?php echo $mobile_number; ?>" <?php echo $disabled; ?> />
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
        <?php  } ?>
          
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


<link rel="stylesheet" href="dist/css/jquery-ui.css">

 <script>

 $(function () {
     $("#form1").validate({
rules: { 
  first_depositor_id: { required: true},
  
},
messages: {
  first_depositor_id: { required: 'Please Select Member'},
  
 
 
},
errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }

});
    });

 
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

$(document.body).on('change','#first_depositor_id',function(){
  var customer_id = $('#first_depositor_id').val();
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
