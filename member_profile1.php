<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$emp_details=select_data(EMPLOYEE_MASTER,"where employee_id='$userid' ");
$session_branch_id = $emp_details[0]['branch_id'];


$customer_name='';
$mother_name='';
$father_name='';
$husband_name='';
$gender_id='';
$mobile_number='';
$blood_group_id = '';
$marital_status_id = '';
$dob='';
$email="";
$employee_id="";
$nationality='';
$mcd='';


if(isset($_GET['customer_id']) && $_GET['customer_id']!="" )
{
    $customer_id=$_GET['customer_id'];
    $customer_details=select_data(CUSTOMER_MASTER,"where customer_id='$customer_id' ");
    $customer_name=$customer_details[0]['customer_name'];
    $dob=$customer_details[0]['dob'];
    $dob = date("d-m-Y", strtotime($dob));
    $mobile_number = $customer_details[0]['mobile_number'];
    $email = $customer_details[0]['email'];
    $gender_id = $customer_details[0]['gender_id'];
    $blood_group_id = $customer_details[0]['blood_group_id'];
    $marital_status_id = $customer_details[0]['marital_status_id'];
    $mother_name = $customer_details[0]['mother_name'];
    $father_name = $customer_details[0]['father_name'];
    $husband_name = $customer_details[0]['husband_name'];
    $employee_id = $customer_details[0]['employee_id'];
    $nationality = $customer_details[0]['nationality'];
    $date = $customer_details[0]['date'];
    $mcd = date("d-m-Y", strtotime($date));
    
}


if(isset($_POST['update']))
{
  $customer_name=$_POST['customer_name'];
  $mother_name=$_POST['mother_name'];
  $father_name=$_POST['father_name'];
  $husband_name=$_POST['husband_name'];
  $dob=$_POST['dob'];
  $email=$_POST['email'];
  $employee_id= $_POST['employee_id'];
  $gender_id= $_POST['gender_id'];
  $blood_group_id= $_POST['blood_group_id'];
  $marital_status_id= $_POST['marital_status_id'];
  $mobile_number = $_POST['mobile_number'];
  $nationality = $_POST['nationality'];
  
  if($dob!=""){ 
    $dob = date("Y-m-d", strtotime($dob));
  }

  $mcd=$_POST['mcd'];
  if($mcd!=""){ 
  $mcd = date("Y-m-d", strtotime($mcd));
  }


  $data['customer_name']=$customer_name;
  $data['mother_name']=$mother_name;
  $data['father_name']=$father_name;
  $data['husband_name']=$husband_name;

  $data['employee_id'] = $employee_id;
  $data['gender_id'] = $gender_id;
  $data['blood_group_id'] = $blood_group_id;
  $data['marital_status_id'] = $marital_status_id;

  $data['mobile_number'] = $mobile_number;
  $data['dob'] = $dob;
  $data['email'] = $email;
  $data['nationality'] = $nationality;
  $data['date'] = $mcd;
 

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $update=update_data(CUSTOMER_MASTER,$data,"customer_id",$_GET['customer_id']);
  if($update!=0)
  { 
    echo "<script type='text/javascript'>window.location='member_profile.php?customer_id=".$_GET['customer_id']."&success=Details Updated Successfully';</script>";
  }
        
}


 if(isset($_POST['submit']))
 {
   
  $customer_name=$_POST['customer_name'];
  $mother_name=$_POST['mother_name'];
  $father_name=$_POST['father_name'];
  $husband_name=$_POST['husband_name'];
  $dob=$_POST['dob'];
  if($dob!=""){ 
  $dob = date("Y-m-d", strtotime($dob));
  }
  $mcd=$_POST['mcd'];
  if($mcd!=""){ 
  $mcd = date("Y-m-d", strtotime($mcd));
  }

  $email=$_POST['email'];
  $employee_id= $_POST['employee_id'];
  $gender_id= $_POST['gender_id'];
  $blood_group_id= $_POST['blood_group_id'];
  $marital_status_id= $_POST['marital_status_id'];
  $mobile_number = $_POST['mobile_number'];
  $nationality = $_POST['nationality'];
  $branch_id = $session_branch_id;

  $data['customer_name']=$customer_name;
  $data['mother_name']=$mother_name;
  $data['father_name']=$father_name;
  $data['husband_name']=$husband_name;

  $data['employee_id'] = $employee_id;
  $data['gender_id'] = $gender_id;
  $data['blood_group_id'] = $blood_group_id;
  $data['marital_status_id'] = $marital_status_id;

  $data['mobile_number'] = $mobile_number;
  $data['dob'] = $dob;
  $data['email'] = $email;
  $data['nationality'] = $nationality;
  $data['branch_id'] = $branch_id;
  $data['date'] = $mcd;
    
  $data['created_date']= date("Y-m-d H:i:s");
  $data['created_by']=$userid;

  


  $insert=insert_data(CUSTOMER_MASTER,$data); 
  $last_id=mysqli_insert_id($CN);
  if($insert!=0)
  { 
    echo "<script type='text/javascript'>window.location='member_profile.php?customer_id=".$last_id."&success=Details Added Successfully';</script>";
          
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
            <h1>Member Details</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

    <?php  include("member_leftmenu.php"); ?>

      <!-- left column -->
      <div class="col-md-9">
           
    <!-- Horizontal Form -->
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Member Profile</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">


<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>

        <div class="card-body">
     
 <!-- <div class="form-group row">
            <label for="customer_name" class="col-sm-2 col-form-label">Branch Name</label>
            <div class="col-sm-5">
            <select name="branch_id" class="form-control" id="branch_id">
              <option value="">Select Branch Name</option>
              <?php
              // $branch_list=select_data(BRANCH_MASTER," ORDER BY branch_id ASC");
              // foreach($branch_list as $bl)
              // {
              ?>
                <option value="<?php //echo $bl['branch_id'];?>" <?php //if($branch_id == $bl['branch_id']){ echo 'selected'; } ?>><?php echo $bl['branch_name'];?></option>
                <?php  
             // }
              ?>
              </select>
            </div>
          </div> -->

         <div class="form-group row">
            <label for="customer_name" class="col-sm-2 col-form-label">Member Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Enter Member Name" value="<?php echo $customer_name; ?>" />
            </div>
          </div>

            <div class="form-group row">
            <label for="mother_name" class="col-sm-2 col-form-label">Mother's Name</label>
            <div class="col-sm-5">
              <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Enter Mother's Name" value="<?php echo $mother_name; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label for="father_name" class="col-sm-2 col-form-label">Father/Guardian Name</label>
            <div class="col-sm-5">
              <input type="text" name="father_name" class="form-control" id="father_name" placeholder="Enter Father's Name" value="<?php echo $father_name; ?>" />
            </div>
          </div>

            <div class="form-group row">
            <label for="husband_name" class="col-sm-2 col-form-label">Husband/Wife Name</label>
            <div class="col-sm-5">
              <input type="text" name="husband_name" class="form-control" id="husband_name" placeholder="Enter Husband's Name" value="<?php echo $husband_name; ?>" />
            </div>
          </div>

        <div class="form-group row">
            <label for="gender_id" class="col-sm-2 col-form-label">Gender<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="gender_id" class="form-control" id="gender_id">
              <option value="">Select Gender</option>
              <?php
              $gender_list=select_data(TYPE_MASTER," where category='gender'");
              foreach($gender_list as $gl)
              {
              ?>
                <option value="<?php echo $gl['type_id'];?>" <?php if($gender_id == $gl['type_id']){ echo 'selected'; } ?>><?php echo $gl['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>


         



<div class="form-group row">
            <label for="employee_id" class="col-sm-2 col-form-label">Referred By<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="employee_id" class="form-control" id="employee_id">
              <option value="">Select Employee Name</option>
              <?php
              $employee_list=select_data(EMPLOYEE_MASTER," ORDER BY employee_id ASC");
              foreach($employee_list as $el)
              {
              ?>
                <option value="<?php echo $el['employee_id'];?>" <?php if($employee_id == $el['employee_id']){ echo 'selected'; } ?>><?php echo $el['employee_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="marital_status_id" class="col-sm-2 col-form-label">Marital Status<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="marital_status_id" class="form-control" id="marital_status_id">
              <option value="">Select Marital Status</option>
              <?php
              $marital_status_list=select_data(TYPE_MASTER," where category='marital_status'");
              foreach($marital_status_list as $msl)
              {
              ?>
                <option value="<?php echo $msl['type_id'];?>" <?php if($marital_status_id == $msl['type_id']){ echo 'selected'; } ?>><?php echo $msl['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>
          

          <div class="form-group row">
            <label for="mobile_number" class="col-sm-2 col-form-label">Mobile Number<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Enter Mobile Number" value="<?php echo $mobile_number; ?>" />
            </div>
          </div>

           <div class="form-group row">
            <label for="employee_name" class="col-sm-2 col-form-label">Email-ID</label>
            <div class="col-sm-5">
              <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email-ID" value="<?php echo $email; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label for="blood_group_id" class="col-sm-2 col-form-label">Blood Group</label>
            <div class="col-sm-5">
              <select name="blood_group_id" class="form-control" id="blood_group_id">
              <option value="">Select Blood Group</option>
              <?php
              $blood_group_list=select_data(TYPE_MASTER," where category='blood_group'");
              foreach($blood_group_list as $bgl)
              {
              ?>
                <option value="<?php echo $bgl['type_id'];?>" <?php if($blood_group_id == $bgl['type_id']){ echo 'selected'; } ?>><?php echo $bgl['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>


          <div class="form-group row">
            <label for="employee_name" class="col-sm-2 col-form-label">Date Of Birth</label>
            <div class="col-sm-5">
              <input type="text" name="dob" class="form-control" id="dob" placeholder="Select Date Of Birth" value="<?php echo $dob; ?>" />
            </div>
          </div>

            <div class="form-group row">
            <label for="nationality" class="col-sm-2 col-form-label">Nationality</label>
            <div class="col-sm-5">
              <input type="text" name="nationality" class="form-control" id="nationality" placeholder="Enter Nationality" value="<?php echo $nationality; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label for="employee_name" class="col-sm-2 col-form-label">Member Creation Date</label>
            <div class="col-sm-5">
              <input type="text" name="mcd" class="form-control" id="mcd" placeholder="Select Date" value="<?php echo $mcd; ?>" />
            </div>
          </div>

 

         

         
          
        </div>
        <!-- /.card-body -->
        <br>
              <br>
        <div class="card-footer">

        <div id="inner">
            <?php if(!isset($_GET['customer_id'])) { ?>
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

 

<link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
 <script>

 $(function () {
     $("#form1").validate({
rules: { 
  customer_name: { required: true},
  gender_id: {required: true },
  employee_id: {required: true },
  marital_status_id: {required: true },
  mobile_number: {required: true }
  
},
messages: {
  customer_name: { required: 'Please Enter Member Name'},
  gender_id: {required:'Please Select Gender' },
  employee_id: {required: 'Please Select Referred By' },
  marital_status_id: {required: 'Please Select Marital Status' },
  mobile_number: {required: 'Please Enter Mobile Number' }
 
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
  $( "#dob" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
 });
});

$(function() {
  $( "#mcd" ).datepicker({
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
