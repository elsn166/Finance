<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];

$occupation_id='';
$employment_id='';
$income_id='';
$aadhar_no='';
$pan_no='';
$proof_of_identity=[];
$proof_of_addr=[];


if(isset($_GET['customer_id']) && $_GET['customer_id']!="" )
{
    $customer_id=$_GET['customer_id'];
    $customer_details=select_data(CUSTOMER_MASTER,"where customer_id='$customer_id' ");
    $occupation_id=$customer_details[0]['occupation_id'];
    $employment_id=$customer_details[0]['employment_id'];
    $income_id=$customer_details[0]['income_id'];
    $aadhar_no=$customer_details[0]['aadhar_no'];
    $pan_no=$customer_details[0]['pan_no'];
    $proof_of_identity=$customer_details[0]['proof_of_identity'];
    $proof_of_identity = explode(',',$proof_of_identity);
    $proof_of_addr=$customer_details[0]['proof_of_addr'];
    $proof_of_addr = explode(',',$proof_of_addr);
   
}
print_r($occupation_id);

if(isset($_POST['update']))
{
  $occupation_id=$_POST['occupation_id'];
  $employment_id=$_POST['employment_id'];
  $income_id=$_POST['income_id'];
  $aadhar_no=$_POST['aadhar_no'];
  $pan_no=$_POST['pan_no'];
  $proof_of_identity=$_POST['proof_of_identity'];
  $proof_of_identity = implode(',',$proof_of_identity);
  $proof_of_addr= $_POST['proof_of_addr'];
  $proof_of_addr = implode(',',$proof_of_addr);
  
  
  
  $data['occupation_id']=$occupation_id;
  $data['employment_id']=$employment_id;
  $data['income_id']=$income_id;
  $data['aadhar_no']=$aadhar_no;
  $data['pan_no'] = $pan_no;
  $data['proof_of_identity'] = $proof_of_identity;
  $data['proof_of_addr'] = $proof_of_addr;
 

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $update=update_data(CUSTOMER_MASTER,$data,"customer_id",$_GET['customer_id']);
  if($update!=0)
  { 
    echo "<script type='text/javascript'>window.location='member_personal.php?customer_id=".$_GET['customer_id']."&success=Details Updated Successfully';</script>";
  }
        
}


?>
<style>

.invalid-feedback {
    display: inline;
    margin-left: 190px;
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
        <h3 class="card-title">Member Personal Details</h3>
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
            <label for="occupation_id" class="col-sm-3 col-form-label">Occupation<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <select name="occupation_id" class="form-control" id="occupation_id">
              <option value="">Select Occupation</option>
              <?php
              $occupation_list=select_data(TYPE_MASTER," where category='occupation'");
              foreach($occupation_list as $ol)
              {
              ?>
                <option value="<?php echo $ol['type_id'];?>" <?php if($occupation_id == $ol['type_id']){ echo 'selected'; } ?>><?php echo $ol['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>

          <?php if($occupation_id == '22'){
            ?>
          <div class="form-group row">
          <?php }else{ 
            ?>
            <div class="form-group row employment" style="display:none;">
          <?php } ?>
            <label for="employment_id" class="col-sm-3 col-form-label">Employment With<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <select name="employment_id" class="form-control" id="employment_id" >
              <option value="">Select Employment With</option>
              <?php
              $employment_list=select_data(TYPE_MASTER," where category='employment'");
              foreach($employment_list as $el)
              {
              ?>
                <option value="<?php echo $el['type_id'];?>" <?php if($employment_id == $el['type_id']){ echo 'selected'; } ?>><?php echo $el['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>


           <div class="form-group row">
            <label for="income_id" class="col-sm-3 col-form-label">Gross Annual Income<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <select name="income_id" class="form-control" id="income_id" >
              <option value="">Select Gross Annual Income</option>
              <?php
              $income_list=select_data(TYPE_MASTER," where category='income'");
              foreach($income_list as $il)
              {
              ?>
                <option value="<?php echo $il['type_id'];?>" <?php if($income_id == $il['type_id']){ echo 'selected'; } ?>><?php echo $il['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>


         <div class="form-group row">
            <label for="proof_of_identity" class="col-sm-3 col-form-label">Proof Of Identity<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <select name="proof_of_identity[]" class="form-control select2" id="proof_of_identity" multiple>
              <option value="">Select Proof Of Identity</option>
              <?php
              $proof_of_identity_list=select_data(TYPE_MASTER," where category='proof_of_identity'");
              foreach($proof_of_identity_list as $poil)
              {
              ?>
                <option value="<?php echo $poil['type_id'];?>" <?php if(in_array($poil['type_id'],$proof_of_identity)){ echo 'selected'; } ?>><?php echo $poil['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>



  <div class="form-group row">
            <label for="proof_of_addr" class="col-sm-3 col-form-label">Proof Of Address<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <select name="proof_of_addr[]" class="form-control select2" id="proof_of_addr" multiple>
              <option value="">Select Proof Of Address</option>
              <?php
              $proof_of_addr_list=select_data(TYPE_MASTER," where category='proof_of_address'");
              foreach($proof_of_addr_list as $poal)
              {
              ?>
                <option value="<?php echo $poal['type_id'];?>" <?php if(in_array($poal['type_id'],$proof_of_addr)){ echo 'selected'; } ?>><?php echo $poal['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>

         <div class="form-group row">
            <label for="aadhar_no" class="col-sm-3 col-form-label">AADHAR No</label>
            <div class="col-sm-5">
              <input type="text" name="aadhar_no" class="form-control" id="aadhar_no" placeholder="Enter AADHAR No" value="<?php echo $aadhar_no; ?>" />
            </div>
          </div>


         <div class="form-group row">
            <label for="pan_no" class="col-sm-3 col-form-label">PAN No</label>
            <div class="col-sm-5">
              <input type="text" name="pan_no" class="form-control" id="pan_no" placeholder="Enter PAN No" value="<?php echo $pan_no; ?>" />
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

 <script>

 $(function () {
     $("#form1").validate({
rules: { 
  occupation_id: { required: true},
  employment_id: {required: true },
  income_id: {required: true },
  "proof_of_identity[]": {required: true },
  "proof_of_addr[]": {required: true },
  aadhar_no:{ required:{
    depends: function(element) {
                    var a = false;
                    $('#proof_of_identity  option:selected').each(function(){
                      if (this.value == 44) {
                        a = true;
                      }
                    });


                     $('#proof_of_addr  option:selected').each(function(){
                      if (this.value == 49) {
                        a = true;
                      }
                    });

                    return a;
                            
                }
  }

  },
  pan_no:{required:{
    depends: function(element) {
                    var a = false;
                    $('#proof_of_identity  option:selected').each(function(){
                      if (this.value == 41) {
                        a = true;
                      }
                    });
                    return a;
                            
                }
  }
  },
  
},
messages: {
  occupation_id: { required: 'Please Select Occupation'},
  employment_id: {required: 'Please Select Employment With' },
  income_id: {required: 'Please Enter Gross Annual Income' },
  "proof_of_identity[]": {required:'Please Select Proof of Identity' },
  "proof_of_addr[]": {required: 'Please Select Proof of Address' },
  aadhar_no: {required: 'Please Enter Aadhaar No'},
  pan_no: {required: 'Please Enter PAN No'},
 
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
$(document.body).on('change','#occupation_id',function(){
  var type_id = $('#occupation_id').val();
  if(type_id == 22)
  {
  $('.employment').show();
  }else{
  $('.employment').hide();
  }
});
   </script>
</body>
</html>
