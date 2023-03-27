<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];

$plan_type_id='';
$plan_term='';
$plan_code='';
$plan_interest='';
$plan_spl_interest='';
$plan_term_value='';

if(isset($_GET['action']) && $_GET['action']=="edit" )
{
    $plan_id=$_GET['plan_id'];
    $plan_details=select_data(PLAN_MASTER,"where plan_id='$plan_id' ");
    $plan_type_id=$plan_details[0]['plan_type_id'];
    $plan_term=$plan_details[0]['plan_term'];
    $plan_term_value = $plan_details[0]['plan_term_value'];
    $plan_code=$plan_details[0]['plan_code'];
    $plan_interest=$plan_details[0]['plan_interest'];
    $plan_spl_interest=$plan_details[0]['plan_spl_interest'];
}


if(isset($_POST['update']))
{
  $plan_type_id=$_POST['plan_type_id'];
  $plan_term= $_POST['plan_term'];
  $plan_term_value= $_POST['plan_term_value'];
  $plan_code= $_POST['plan_code'];
  $plan_interest= $_POST['plan_interest'];
  $plan_spl_interest= $_POST['plan_spl_interest'];
    
  $data['plan_type_id']=$plan_type_id;
  $data['plan_term'] = $plan_term;
  $data['plan_term_value'] = $plan_term_value;
  $data['plan_code'] = $plan_code;
  $data['plan_interest'] = $plan_interest;
  $data['plan_spl_interest'] = $plan_spl_interest;

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $update=update_data(PLAN_MASTER,$data,"plan_id",$_GET['plan_id']);
  if($update!=0)
  { 
      echo "<script type='text/javascript'>window.location='plan_view.php?success=Plan Updated Successfully';</script>";
  }
        
}


 if(isset($_POST['submit']))
 {
    $plan_type_id=$_POST['plan_type_id'];
    $plan_term= $_POST['plan_term'];
    $plan_term_value = $_POST['plan_term_value'];
    $plan_code= $_POST['plan_code'];
    $plan_interest= $_POST['plan_interest'];
    $plan_spl_interest= $_POST['plan_spl_interest'];

    $data['plan_type_id']=$plan_type_id;
    $data['plan_term'] = $plan_term;
    $data['plan_term_value'] = $plan_term_value;
    $data['plan_code'] = $plan_code;
    $data['plan_interest'] = $plan_interest;
    $data['plan_spl_interest'] = $plan_spl_interest;
    $data['created_date']= date("Y-m-d H:i:s");
    $data['created_by']=$userid;

    $insert=insert_data(PLAN_MASTER,$data); 

    if($insert!=0)
    { 
        echo "<script type='text/javascript'>window.location='plan_view.php?success=Plan Added Successfully';</script>";
            
    }
         
 }
?>
<style>

.invalid-feedback {
    display: inline;
    margin-left: 170px;
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
            <h1>Plan Details</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
           
    <!-- Horizontal Form -->
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Plan Details</h3>

        <a class="btn-sm btn-success float-right" href="plan_view.php">Back</a>

      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">
        <div class="card-body">
          <div class="form-group row">
            <label for="plan_type_id" class="col-sm-2 col-form-label">Select Plan Type Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="plan_type_id" class="form-control" id="plan_type_id">
              <option value="">Select</option>
              <?php
              $plan_type_list=select_data(PLAN_TYPE_MASTER," ORDER BY plan_type_id  ASC");
              foreach($plan_type_list as $ptl)
              {
              ?>
                <option value="<?php echo $ptl['plan_type_id'];?>" <?php if($plan_type_id == $ptl['plan_type_id']){ echo 'selected'; } ?>><?php echo $ptl['plan_type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
          <label for="plan_term" class="col-sm-2 col-form-label">Plan Term<span style="color:red">*</span></label>
              <div class="col-sm-2">
              <input type="text" name="plan_term" class="form-control" id="plan_term" placeholder="Enter Plan Term" value="<?php echo $plan_term; ?>" />
              </div>

              <div class="col-sm-2">
              <select name="plan_term_value" class="form-control" id="plan_term_value">
                <option value="">Select</option>
                <option value="Y" <?php if($plan_term_value == "Y"){ echo 'selected'; } ?>>Year</option>
                <option value="M" <?php if($plan_term_value == "M"){ echo 'selected'; } ?>>Month</option>
                <option value="D" <?php if($plan_term_value == "D"){ echo 'selected'; } ?>>Days</option>
                </select>
              </div>
          </div>

          <div class="form-group row">
            <label for="plan_code" class="col-sm-2 col-form-label">Plan Code<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="plan_code" class="form-control" id="plan_code" placeholder="Enter Plan Code" value="<?php echo $plan_code; ?>" />
            </div>
          </div>

           <div class="form-group row">
            <label for="plan_code" class="col-sm-2 col-form-label">Interest For General Citizen<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="plan_interest" class="form-control" id="plan_interest" placeholder="Enter Interest For General Citizen" value="<?php echo $plan_interest; ?>" />
            </div>
          </div>

           <div class="form-group row">
            <label for="plan_code" class="col-sm-2 col-form-label">Interest For Senior Citizen/Women<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="plan_spl_interest" class="form-control" id="plan_spl_interest" placeholder="Enter Interest For Senior Citizen/Women" value="<?php echo $plan_spl_interest; ?>" />
            </div>
          </div>
          
        </div>
        <!-- /.card-body -->
              
        <div class="card-footer">

        <div id="inner">
            <?php if(!isset($_GET['plan_id'])) { ?>
              <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
                    <?php } else { ?>
            <button type="submit" class="btn-sm btn-success" id="submit" name="update" >Update</button>
                          <?php } ?>
              <a href=""><button type="button" class="btn-sm btn-default">Cancel</button></a>
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
 
 
 <script>

$(function () {
    $("#form1").validate({
rules: { 
  plan_type_id: { required: true},
  plan_term: {required: true },
  plan_term_value: {required: true },
  plan_code: {required: true },
  plan_interest: {required: true,
  number: true },
  plan_spl_interest: {required: true,number: true },
 
},
messages: {
  plan_type_id: { required: 'Select Plan Type Name'},
  plan_term: {required:'Enter Plan Term' },
  plan_term_value: {required: 'Please Select Plan Term Value' },
  plan_code: {required: 'Please Enter Plan Code' },
  plan_interest: {required: 'Please Enter Interest For General Citizen' },
  plan_spl_interest: {required: 'Please Enter Interest For Senior Citizen/Women' }

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

   </script>
</body>
</html>
