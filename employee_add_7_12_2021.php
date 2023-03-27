<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$target_dir = "uploads/";


$userid= $_SESSION['emp_id'];

$employee_name='';
$employee_code='';
$dob='';
$role_id='';
$mobile_number='';
$certificate_id=[];
$door_no = '';
$address = '';
$landmark='';
$country_id='';
$state_id='';
$district_id='';
$pincode='';
$pwd="";
$branch_id='';
$blood_group_id='';


if($_SESSION['role_id']!=1)
 {
     $disable="disabled";
     $readonly="readonly";
 }
 else{

  $disable="";
  $readonly="readonly";
 }

if(isset($_GET['action']) && $_GET['action']=="edit" )
{
    $employee_id=$_GET['employee_id'];
    $employee_details=select_data(EMPLOYEE_MASTER,"where employee_id='$employee_id' ");
    $employee_name=$employee_details[0]['employee_name'];
    $role_id=$employee_details[0]['role_id'];
    $mobile_number = $employee_details[0]['mobile_number'];
    $employee_code = $employee_details[0]['employee_code'];
    $dob = $employee_details[0]['dob'];
    $certificate_id = $employee_details[0]['certificate_id'];
    $certificate_id = explode(",",$certificate_id);
    $door_no = $employee_details[0]['door_no'];
    $address = $employee_details[0]['address'];
    $landmark = $employee_details[0]['landmark'];
    $country_id = $employee_details[0]['country_id'];
    $state_id = $employee_details[0]['state_id'];
    $district_id = $employee_details[0]['district_id'];
    $pincode = $employee_details[0]['pincode'];
    $branch_id =  $employee_details[0]['branch_id'];
    $pwd = $employee_details[0]['password'];
    $blood_group_id = $employee_details[0]['blood_group_id'];

    $upload_files = $employee_details[0]['upload_files'];
}


if(isset($_POST['update']))
{
  // print_r($_POST);

  if(!isset($_POST['status']))
  {
       $status = 0;
  } else {
    $status = $_POST['status'];
  }

  $employee_name=$_POST['employee_name'];
  $role_id= $_POST['role_id'];
  $mobile_number = $_POST['mobile_number'];
  $employee_code = $_POST['employee_code'];
  $pwd = $_POST['pwd'];
  $dob = $_POST['dob'];
  $dob = date("Y-m-d", strtotime($dob));
  $certificate_id = $_POST['certificate_id'];
  $certificate_id =implode(",",$certificate_id);
  $branch_id = $_POST['branch_id'];
  $blood_group_id = $_POST['blood_group_id'];

  
 
  $door_no = $_POST['door_no'];
  $address = $_POST['address'];
  $landmark = $_POST['landmark'];
  $country_id = $_POST['country_id'];
  $state_id = $_POST['state_id'];
  $district_id = $_POST['district_id'];
  $pincode = $_POST['pincode'];
  $status = $status;

  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  
  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
  $fileName = $_FILES['fileToUpload']['name'];
    
  $data['employee_name']=$employee_name;
  $data['role_id'] = $role_id;
  $data['mobile_number'] = $mobile_number;
  $data['employee_code'] = $employee_code;
  $data['dob'] = $dob;
  $data['certificate_id'] = $certificate_id;
  $data['door_no'] = $door_no;
  $data['address'] = $address;
  $data['landmark'] = $landmark;
  $data['country_id'] = $country_id;
  $data['state_id'] = $state_id;
  $data['district_id'] = $district_id;
  $data['pincode'] = $pincode;
  $data['password'] = $pwd;
  $data['branch_id'] = $branch_id;
  $data['blood_group_id'] = $blood_group_id;
  $data['status'] = $status;
  $data['upload_files'] = $fileName;
 

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $update=update_data(EMPLOYEE_MASTER,$data,"employee_id",$_GET['employee_id']);
  if($update!=0)
  { 
      echo "<script type='text/javascript'>window.location='employee_view.php?success=Employee Detail Updated Successfully';</script>";
  }
        
}


 if(isset($_POST['submit']))
 {
  if(!isset($_POST['status']))
  {
       $status = 0;
  } else {
    $status = $_POST['status'];
  }
    $employee_name=$_POST['employee_name'];
    $role_id= $_POST['role_id'];
    $mobile_number = $_POST['mobile_number'];
    $pwd = $_POST['pwd'];
    $branch_id = $_POST['branch_id'];
    $employee_code = $_POST['employee_code'];
    $dob = $_POST['dob'];
    $dob = date("Y-m-d", strtotime($dob));
    $certificate_id = $_POST['certificate_id'];
    $certificate_id =implode(",",$certificate_id);
    $door_no = $_POST['door_no'];
    $address = $_POST['address'];
    $landmark = $_POST['landmark'];
    $country_id = $_POST['country_id'];
    $state_id = $_POST['state_id'];
    $district_id = $_POST['district_id'];
    $pincode = $_POST['pincode'];
    $blood_group_id = $_POST['blood_group_id'];
    $status = $status;

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    $fileName = $_FILES['fileToUpload']['name'];

    $data['employee_name']=$employee_name;
    $data['role_id'] = $role_id;
    $data['mobile_number'] = $mobile_number;
    $data['password'] = $pwd;
    $data['employee_code'] = $employee_code;
    $data['dob'] = $dob;
    $data['certificate_id'] = $certificate_id;
    $data['door_no'] = $door_no;
    $data['address'] = $address;
    $data['landmark'] = $landmark;
    $data['country_id'] = $country_id;
    $data['state_id'] = $state_id;
    $data['district_id'] = $district_id;
    $data['pincode'] = $pincode;
    $data['branch_id'] = $branch_id;
    $data['blood_group_id'] = $blood_group_id;
    $data['upload_files'] = $fileName;
    $data['status'] = $status;
    
    $data['created_date']= date("Y-m-d H:i:s");
    $data['created_by']=$userid;

    $insert=insert_data(EMPLOYEE_MASTER,$data); 

    if($insert!=0)
    { 
        echo "<script type='text/javascript'>window.location='employee_view.php?success=Employee Detail Added Successfully';</script>";
            
    }
         
 }
?>
<style>

.invalid-feedback {
    display: inline;
    margin-left: 174px;
    font-size: 14px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: green!important;
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
            <h1>Employee Details</h1>
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
        <h3 class="card-title">Employee Details</h3>

        <a class="btn-sm btn-success float-right" href="employee_view.php">Back</a>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1" enctype="multipart/form-data">
        <div class="card-body">


        <div class="form-group row">
            <label for="customer_name" class="col-sm-2 col-form-label">Branch Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <select name="branch_id" class="form-control" id="branch_id">
              <option value="">Select Branch Name</option>
              <?php
              $branch_list=select_data(BRANCH_MASTER," ORDER BY branch_id ASC");
              foreach($branch_list as $bl)
              {
              ?>
                <option value="<?php echo $bl['branch_id'];?>" <?php if($branch_id == $bl['branch_id']){ echo 'selected'; } ?>><?php echo $bl['branch_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>

         <div class="form-group row">
            <label for="employee_name" class="col-sm-2 col-form-label">Employee Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="employee_name" class="form-control" id="employee_name" placeholder="Enter Employee Name" value="<?php echo $employee_name; ?>" <?php echo $disable;?>/>
              <span class="has-error"></span>
            </div>
          </div>


          <div class="form-group row">
            <label for="employee_name" class="col-sm-2 col-form-label">Employee Code<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="employee_code" class="form-control" id="employee_code" placeholder="Enter Employee Code" value="<?php echo $employee_code; ?>" <?php echo $disable;?>/>
            </div>
          </div>

          <div class="form-group row">
            <label for="employee_name" class="col-sm-2 col-form-label">Date Of Birth<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="dob" class="form-control" id="dob" placeholder="Select Date Of Birth" value="<?php echo $dob; ?>" />
            </div>
          </div>


          <div class="form-group row">
            <label for="employee_name" class="col-sm-2 col-form-label">Mobile Number<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Enter Mobile Number" value="<?php echo $mobile_number; ?>" <?php echo $disable;?>/>
            </div>
          </div>

          <div class="form-group row">
            <label for="blood_group_id" class="col-sm-2 col-form-label">Blood Group<span style="color:red">*</span></label>
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
            <label for="plan_type_id" class="col-sm-2 col-form-label">Select Role Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="role_id" class="form-control" id="role_id" <?php echo $disable;?>>
              <option value="">Select Role</option>
              <?php
              $role_list=select_data(ROLE," ORDER BY role_id  ASC");
              foreach($role_list as $rl)
              {
              ?>
                <option value="<?php echo $rl['role_id'];?>" <?php if($role_id == $rl['role_id']){ echo 'selected'; } ?>><?php echo $rl['role_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>


          <div class="form-group row">
            <label for="certificate_id" class="col-sm-2 col-form-label">Certificates Provided<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="certificate_id[]" class="form-control select2" id="certificate_id" multiple>
              <option value="">Select</option>
              <?php
              $certificate_list=select_data(TYPE_MASTER," where category='certificate'");
              foreach($certificate_list as $cl)
              {
              ?>
                <option value="<?php echo $cl['type_id'];?>" <?php if(in_array($cl['type_id'],$certificate_id)){ echo 'selected'; } ?>><?php echo $cl['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>


        <h5 for="exampleInputEmail1"><b>Residential Address </b></h5><br>

        <div class="form-group row">
          <label for="door_no" class="col-sm-2 col-form-label">Door No<span style="color:red">*</span></label>
          <div class="col-sm-5">
            <input type="text" name="door_no" class="form-control" id="door_no" placeholder="Enter Door No" value="<?php echo $door_no; ?>" />
          </div>
        </div>


        <div class="form-group row">
          <label for="address" class="col-sm-2 col-form-label">Address<span style="color:red">*</span></label>
          <div class="col-sm-5">
            <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" value="<?php echo $address; ?>" />
          </div>
        </div>

        <div class="form-group row">
          <label for="landmark" class="col-sm-2 col-form-label">Landmark<span style="color:red">*</span></label>
          <div class="col-sm-5">
            <input type="text" name="landmark" class="form-control" id="landmark" placeholder="Enter Landmark" value="<?php echo $landmark; ?>" />
          </div>
        </div>



        <div class="form-group row">
          <label for="country_id" class="col-sm-2 col-form-label">Country<span style="color:red">*</span></label>
          <div class="col-sm-5">
            <select name="country_id" class="form-control" id="country_id">
            <option value="">Select Country</option>
            <?php
            $country_list=select_data(COUNTRY_MASTER," ORDER BY country_id ASC");
            foreach($country_list as $cl)
            {
            ?>
              <option value="<?php echo $cl['country_id'];?>" <?php if($country_id == $cl['country_id']){ echo 'selected'; } ?>><?php echo $cl['country_name'];?></option>
              <?php  
            }
            ?>
            </select>
          </div>
        </div>


        <div class="form-group row">
          <label for="state_id" class="col-sm-2 col-form-label">State<span style="color:red">*</span></label>
          <div class="col-sm-5">
            <select name="state_id" class="form-control" id="state_id">
            <option value="">Select State</option>
            <?php
            $state_list=select_data(STATE_MASTER," ORDER BY state_id ASC");
            foreach($state_list as $sl)
            {
            ?>
              <option value="<?php echo $sl['state_id'];?>" <?php if($state_id == $sl['state_id']){ echo 'selected'; } ?>><?php echo $sl['state_name'];?></option>
              <?php  
            }
            ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="district_id" class="col-sm-2 col-form-label">District<span style="color:red">*</span></label>
          <div class="col-sm-5">
            <select name="district_id" class="form-control" id="district_id">
            <option value="">Select District</option>
            <?php
            $district_list=select_data(DISTRICT_MASTER," ORDER BY district_id ASC");
            foreach($district_list as $dl)
            {
            ?>
              <option value="<?php echo $dl['district_id'];?>" <?php if($district_id == $dl['district_id']){ echo 'selected'; } ?>><?php echo $dl['district_name'];?></option>
              <?php  
            }
            ?>
            </select>
          </div>
        </div>


        <div class="form-group row">
          <label for="pincode" class="col-sm-2 col-form-label">Pincode<span style="color:red">*</span></label>
          <div class="col-sm-5">
            <input type="text" name="pincode" class="form-control" id="pincode" placeholder="Enter Pincode" value="<?php echo $pincode; ?>" />
          </div>
        </div>

         <div class="form-group row">
          <label for="pwd" class="col-sm-2 col-form-label">Password<span style="color:red">*</span></label>
          <div class="col-sm-5">
            <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Enter Password" value="<?php echo $pwd; ?>" />
          </div>
        </div>
         

      <!-- Status Toggle -->
      <div class="form-group row">
      
      <label for="status" class="col-sm-2 col-form-label">Status<span style="color:red">*</span></label>
      <div class="col-sm-5">
          <input type="checkbox" name="status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" value="1">
          </div>
      </div>


      <div class="form-group row">
      
      <label for="status" class="col-sm-2 col-form-label">Upload Profile Photo<span style="color:red">*</span></label>
      <div class="col-sm-5">
      <input type="file" name="fileToUpload" id="fileToUpload">
      <?php echo $upload_files; ?>
          </div>
      </div>
     


              
          
        </div>
        <!-- /.card-body -->
              
        <div class="card-footer">

        <div id="inner">
            <?php if(!isset($_GET['employee_id'])) { ?>
              <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
                    <?php } else { ?>
            <button type="submit" class="btn-sm btn-success" id="submit" name="update" >Update</button>
                          <?php } ?>
              <a href=""><button type="button" class="btn btn-default">Cancel</button></a>
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
  employee_name: { required: true},
  employee_code: {required: true },
  dob: {required: true },
  mobile_number: {required: true },
  role_id: {required: true },
  "certificate_id[]": {required: true },
  door_no: {required: true },
  address: {required: true },
  landmark: {required: true },
  country_id: {required: true },
  state_id: {required: true },
  district_id: {required: true },
  pincode: {required: true },
  blood_group_id: {required: true},
  pwd: {required: true},
  branch_id: {required: true},
},
messages: {
  employee_name: { required: 'Please Enter Employee Name'},
  employee_code: {required: 'Please Enter Employee Code' },
  dob: {required: 'Please Select Date of Birth' },
  mobile_number: {required:'Please Enter Mobile Number' },
  role_id: {required: 'Please Select Role Name' },
  "certificate_id[]": {required: 'Please Select Certificates' },
  door_no: {required: 'Please Enter Door No' },
  address: {required: 'Please Enter Address' },
  landmark: {required: 'Please Enter Landmark' },
  country_id: {required: 'Please Select Country Name' },
  state_id: {required: 'Please Enter State Name' },
  district_id: {required: 'Please Enter District Name' },
  pincode: {required: 'Please Enter Pincode' },
  blood_group_id: {required: 'Please Select Blood Group'},
  pwd: {required: 'Please Enter Password'},
  branch_id: {required: 'Please Select Branch Name'},
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

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
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
   </script>
   
</body>
</html>
