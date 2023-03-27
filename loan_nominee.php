<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_branch_id = $_SESSION['bid'];

$nominee_name='';
$nominee_mob_no='';
$relation_id="";

$session_role_id=$_SESSION['role_id'];

if($session_role_id==1)
{
  $disabled="";
}
else{
  if(isset($_GET['action']) && $_GET['action']=='view'){ 
    $disabled = "disabled";
  }
  else{
    $disabled="";
  }
}

if(isset($_GET['loan_id']) && $_GET['loan_id']!="" )
{
    $loan_id=$_GET['loan_id'];
    $account_details=select_data(LOAN_MASTER,"where loan_id='$loan_id'");
    $nominee_name=$account_details[0]['nominee_name'];
    $nominee_mob_no=$account_details[0]['nominee_mob_no'];
    // if($nominee_dob!=""){ 
    //   $nominee_dob = date("d-m-Y", strtotime($nominee_dob));
    //   }
    $relation_id=$account_details[0]['relation_id'];
    
}


if(isset($_POST['update']))
{
  $nominee_name=$_POST['nominee_name'];
  $nominee_mob_no=$_POST['nominee_mob_no'];
  $relation_id = $_POST['relation_id'];
  
  // if($nominee_dob!=""){ 
  //   $nominee_dob = date("Y-m-d", strtotime($nominee_dob));
  // }
  $data['nominee_name']=$nominee_name;
  $data['nominee_mob_no']=$nominee_mob_no;
  $data['relation_id']=$relation_id;
 

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  

    $update=update_data(LOAN_MASTER,$data,"loan_id",$_GET['loan_id']);
    if($update!=0)
    { 

      // echo "<script type='text/javascript'>window.location='account_nominee.php?account_id=".$_GET['account_id']."&success=Details Updated Successfully';</script>";

      echo "<script type='text/javascript'>window.location='loan_personal.php?loan_id=".$_GET['loan_id']."&success=Details Updated Successfully&loan_status=".$_GET['loan_status']."';</script>";
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

    <?php  include("loan_leftmenu.php"); ?>

      <!-- left column -->
      <div class="col-md-9">
           
    <!-- Horizontal Form -->
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Nominee Details</h3>
              <a class="btn-sm btn-success float-right" href="loan_view.php">Back</a> 
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
            <label for="customer_id" class="col-sm-2 col-form-label">Nominee Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="nominee_name" class="form-control" id="nominee_name" placeholder="Enter Nominee Name" value="<?php echo $nominee_name; ?>" <?php echo $disabled; ?>/>
            </div>
        </div>


       
       <!-- <div class="form-group row">
            <label for="employee_name" class="col-sm-2 col-form-label">Date Of Birth<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="nominee_dob" class="form-control" id="nominee_dob" placeholder="Select Date Of Birth" value="<?php //echo $nominee_dob; ?>" />
            </div>
          </div> -->

          <div class="form-group row">
            <label for="mobile_number" class="col-sm-2 col-form-label">Mobile Number<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="nominee_mob_no" class="form-control" id="nominee_mob_no" placeholder="Enter Mobile Number" value="<?php echo $nominee_mob_no; ?>" <?php echo $disabled; ?>/>
            </div>
          </div>


        <div class="form-group row">
            <label for="plan_id" class="col-sm-2 col-form-label">Type Of Relation<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="relation_id" class="form-control" id="relation_id" <?php echo $disabled; ?>>
              <option value="">Select</option>
              <?php
             $relation_list=select_data(TYPE_MASTER," where category='relation'");
             foreach($relation_list as $rl)
             {
             ?>
               <option value="<?php echo $rl['type_id'];?>" <?php if($relation_id == $rl['type_id']){ echo 'selected'; } ?>><?php echo $rl['type_name'];?></option>
               <?php  
             }
             ?>
              </select>
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

            <?php if($loan_id ==""){?>
              <button type="submit" class="btn-sm btn-success" id="submit" name="update" >Submit</button>
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
  nominee_name: { required: true},
  nominee_mob_no: {required: true,
  number: true },
  relation_id: {required: true },
  
},
messages: {
  nominee_name: { required: 'Please Enter Nominee Name'},
  nominee_mob_no: {required: 'Please Enter Mobile Number' },
  relation_id: {required: 'Please Select Type of Relation' },
  
 
 
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
  $( "#nominee_dob" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
 });
});
   </script>
</body>
</html>
