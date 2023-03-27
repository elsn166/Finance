<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

 if(isset($_POST['branch_id']))
 {
   $branch_id = $_POST['branch_id'];
 }
 else
 {
   $branch_id = "";
 }

$userid= $_SESSION['emp_id'];

$session_branch_id = $_SESSION['bid'];
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

$customer_id='';
$plan_type_id='';
$plan_id="";
$amount='';
$mode_of_payment_id='';
$cheque_acc_no='';
$cheque_date='';
$bank_name='';
$mode_of_operation_id="";
$maturity_instruction_id="";
$senior_citizen="";
$sms="";
$acd="";




if(isset($_GET['account_id']) && $_GET['account_id']!="" )
{
    $account_id=$_GET['account_id'];
    $account_details=select_data(ACCOUNT_MASTER,"where account_id='$account_id' ");
    $customer_id=$account_details[0]['customer_id'];
    $plan_type_id=$account_details[0]['plan_type_id'];
    $branch_id=$account_details[0]['branch_id'];
    $plan_id = $account_details[0]['plan_id'];
    $amount = $account_details[0]['amount'];
    $mode_of_payment_id = $account_details[0]['mode_of_payment_id'];
    $mode_of_operation_id = $account_details[0]['mode_of_operation_id'];
    $cheque_date = $account_details[0]['cheque_date'];
    if($cheque_date!=""){ 
      $cheque_date = date("d-m-Y", strtotime($cheque_date));
      }
    $branch_id4=$account_details[0]['branch_id'];
    $cheque_acc_no = $account_details[0]['cheque_acc_no'];
    $bank_name = $account_details[0]['bank_name'];
    $maturity_instruction_id = $account_details[0]['maturity_instruction_id'];
    $senior_citizen = $account_details[0]['senior_citizen'];
    $sms = $account_details[0]['sms'];
    $date = $account_details[0]['date'];
    $acd = date("d-m-Y", strtotime($date));
    print_r($senior_citizen);
    
}


if(isset($_POST['update']))
{
  
  $customer_id=$_POST['customer_id'];
  $plan_type_id= $_POST['plan_type_id'];
  $plan_id = $_POST['plan_id'];
  $old_plan_id = $_POST['old_plan_id'];
//   echo $old_plan_id;
  $amount = $_POST['amount'];
  $mode_of_payment_id = $_POST['mode_of_payment_id'];
  $mode_of_operation_id = $_POST['mode_of_operation_id'];
  $senior_citizen = $_POST['senior_citizen'];
  $sms= $_POST['sms'];
    if($session_role_id==1){
      $branch_id1 = $_POST['branch_id']; 
      }
  else{
      
       $branch_id1 = $_SESSION['bid'];
  }    
  $cheque_acc_no = $_POST['cheque_acc_no'];
  $cheque_date = $_POST['cheque_date'];
  if($cheque_date!=""){ 
    $cheque_date = date("Y-m-d", strtotime($cheque_date));
  }
  $bank_name = $_POST['bank_name'];
  $maturity_instruction_id = $_POST['maturity_instruction_id'];

  $acd=$_POST['acd'];
  if($acd!=""){ 
  $acd = date("Y-m-d", strtotime($acd));
  }
  $data['customer_id']=$customer_id;
  $data['plan_type_id']=$plan_type_id;
  $data['plan_id']=$plan_id;
  $data['old_plan_id']=$old_plan_id;
  $data['amount']=$amount;
  $data['mode_of_payment_id']=$mode_of_payment_id;
  $data['mode_of_operation_id']=$mode_of_operation_id;
  $data['senior_citizen']=$senior_citizen;
  $data['cheque_acc_no']=$cheque_acc_no;
  $data['cheque_date']=$cheque_date;
  $data['bank_name']=$bank_name;
  $data['maturity_instruction_id']=$maturity_instruction_id;
  $data['date'] = $acd;
  $data['sms'] = $sms;
  $data['branch_id']=$branch_id1;
  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $update=update_data(ACCOUNT_MASTER,$data,"account_id",$_GET['account_id']);
  if($update!=0)
  { 
    echo "<script type='text/javascript'>window.location='account_profile.php?account_id=".$_GET['account_id']."&success=Details Updated Successfully';</script>";
  }
        
}


 if(isset($_POST['submit']))
 {
   
  $customer_id=$_POST['customer_id'];
  $plan_type_id= $_POST['plan_type_id'];
  $plan_id = $_POST['plan_id'];
  $amount = $_POST['amount'];
  $mode_of_payment_id = $_POST['mode_of_payment_id'];
  $mode_of_operation_id = $_POST['mode_of_operation_id'];
  $senior_citizen = $_POST['senior_citizen'];
  $cheque_acc_no = $_POST['cheque_acc_no'];
  $cheque_date = $_POST['cheque_date'];
  $sms = $_POST['sms'];
 // $branch_id=$_POST['branch_id'];
  if($session_role_id==1){
      $branch_id1 = $_POST['branch_id']; 
      }
  else{
      
       $branch_id1 = $_SESSION['bid'];
  }    
      
  
  if($cheque_date!=""){ 
    $cheque_date = date("Y-m-d", strtotime($cheque_date));
    }
  $acd=$_POST['acd'];
  if($acd!=""){ 
  $acd = date("Y-m-d", strtotime($acd));
  }
  $bank_name = $_POST['bank_name'];
  $maturity_instruction_id = $_POST['maturity_instruction_id'];


  $data['customer_id']=$customer_id;
  $data['plan_type_id']=$plan_type_id;
  $data['plan_id']=$plan_id;
  $data['amount']=$amount;
  $data['mode_of_payment_id']=$mode_of_payment_id;
  $data['mode_of_operation_id']=$mode_of_operation_id;
  $data['senior_citizen']=$senior_citizen;
  $data['cheque_acc_no']=$cheque_acc_no;
  $data['cheque_date']=$cheque_date;
  $data['bank_name']=$bank_name;
  $data['maturity_instruction_id']=$maturity_instruction_id;
  $data['date'] = $acd;
  $data['branch_id'] = $branch_id1;
  $data['created_date']= date("Y-m-d H:i:s");
  $data['created_by']=$userid;
  $data['status'] = 1;
  $data['maturity_acct'] = 0;
  $data['prematurity_acct'] = 0;
  $data['sms'] = $sms;
  


    $insert=insert_data(ACCOUNT_MASTER,$data); 
    $last_id=mysqli_insert_id($CN);
    if($insert!=0)
    { 
      echo "<script type='text/javascript'>window.location='account_first_profile.php?account_id=".$last_id."&success=Account Created Successfully';</script>";
            
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
        <h3 class="card-title">Account Profile</h3>
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
            <label for="customer_id" class="col-sm-2 col-form-label">Member Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="customer_id" class="form-control select2" id="customer_id" <?php echo $disabled; ?> >
              <option value="">Select</option>
              <?php
               if($session_role_id == 1)
               {
              $member_list=select_data(CUSTOMER_MASTER," ORDER BY customer_name ASC");
               }
               else{
          $member_list=select_data(CUSTOMER_MASTER,"where branch_id='".$session_branch_id."' ORDER BY customer_name ASC");
               }


              foreach($member_list as $ml)
              {
              ?>
                <option value="<?php echo $ml['customer_id'];?>" <?php if($customer_id == $ml['customer_id']){ echo 'selected'; } ?>><?php echo $ml['customer_no'].'-'.$ml['customer_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>
       <?php if($session_role_id == 1){ ?>
        <div class="form-group row">
            <label for="employee_name" class="col-sm-2 col-form-label">Branch Name<span style="color:red">*</span></label>
            <div class="col-sm-5">

            <select name="branch_id" class="form-control" id="branch_id">
              <option value="">Select Branch Name</option>
              <?php
              $branch_list=select_data(BRANCH_MASTER," ORDER BY branch_id ASC");
              foreach($branch_list as $bl)
              {
              ?>
                <option value="<?php echo $bl['branch_id'];?>" <?php if( $branch_id == $bl['branch_id']){ echo 'selected'; } ?>><?php echo $bl['branch_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
            
        </div>
        
        <?php } else{
        
        }?>
         <div class="form-group row">
            <label for="plan_type_id" class="col-sm-2 col-form-label">Plan Type<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="plan_type_id" class="form-control" id="plan_type_id" <?php echo $disabled; ?>>
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
            <label for="plan_id" class="col-sm-2 col-form-label">Scheme Code<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="plan_id" class="form-control" id="plan_id" <?php echo $disabled; ?>>
              <option value="">Select</option>
              <?php
             $plan_list=select_data(PLAN_MASTER," ORDER BY plan_id  ASC");
             foreach($plan_list as $pl)
             {
             ?>
               <option value="<?php echo $pl['plan_id'];?>" <?php if($plan_id == $pl['plan_id']){ echo 'selected'; } ?>><?php echo $pl['plan_code'];?></option>
               <?php  
             }
             ?>
              </select>
            </div>
        </div>
      <!-- <div class="form-group row">-->
            <!--<label for="plan_id" class="col-sm-2 col-form-label">Scheme Code<span style="color:red">*</span></label>
            <div class="col-sm-5">-->
              <select  name="old_plan_id" class="form-control" id="old_plan_id" hidden <?php echo $disabled;?>>
              <option  value="">Select</option>
              <?php
             $plan_list=select_data(PLAN_MASTER," ORDER BY plan_id  ASC");
             foreach($plan_list as $pl)
             {
             ?>
               <option value="<?php echo $pl['plan_id'];?>" <?php if($plan_id == $pl['plan_id']){ echo 'selected'; } ?>><?php echo $pl['plan_code'];?></option>
               <?php  
             }
             ?>
              </select>
           <!-- </div>-->
       <!-- </div>-->

 <div class="form-group row">
      <label for="customer_name" class="col-sm-2 col-form-label">Opening Amount<span style="color:red">*</span></label>
      <div class="col-sm-5">
        <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" value="<?php echo $amount; ?>" <?php echo $disabled; ?>/>
      </div>
    </div>

      <div class="form-group row">
            <label for="plan_id" class="col-sm-2 col-form-label">Mode Of Payment<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="mode_of_payment_id" class="form-control" id="mode_of_payment_id" <?php echo $disabled; ?>>
              <option value="">Select</option>
              <?php
             $payment_list=select_data(TYPE_MASTER," where category='mode_of_payment'");
             foreach($payment_list as $pl)
             {
             ?>
               <option value="<?php echo $pl['type_id'];?>" <?php if($mode_of_payment_id == $pl['type_id']){ echo 'selected'; } ?>><?php echo $pl['type_name'];?></option>
               <?php  
             }
             ?>
              </select>
            </div>
        </div>


        <div class="form-group row chequeacc" style="display:none;">
            <label for="plan_id" class="col-sm-2 col-form-label">Cheque/DD/Existing Account No<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="cheque_acc_no" class="form-control" id="cheque_acc_no" placeholder="Enter Cheque Account No" value="<?php echo $cheque_acc_no; ?>" <?php echo $disabled; ?>/>
            </div>
        </div>

        <div class="form-group row chequedate" style="display:none;">
            <label for="plan_id" class="col-sm-2 col-form-label">Cheque/DD Date</label>
            <div class="col-sm-5">
            <input type="text" name="cheque_date" class="form-control" id="cheque_date" placeholder="Select Date" value="<?php echo $cheque_date; ?>" <?php echo $disabled; ?>/>
            </div>
        </div>


        <div class="form-group row chequebank" style="display:none;">
            <label for="plan_id" class="col-sm-2 col-form-label">Bank Name</label>
            <div class="col-sm-5">
            <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Enter Bank Name" value="<?php echo $bank_name; ?>" <?php echo $disabled; ?>/>
            </div>
        </div>


        <div class="form-group row">
            <label for="plan_id" class="col-sm-2 col-form-label">Mode Of Operation<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="mode_of_operation_id" class="form-control" id="mode_of_operation_id" <?php echo $disabled; ?>>
              <option value="">Select</option>
              <?php
             $operation_list=select_data(TYPE_MASTER," where category='mode_of_operation'");
             foreach($operation_list as $ol)
             {
             ?>
               <option value="<?php echo $ol['type_id'];?>" <?php if($mode_of_operation_id == $ol['type_id']){ echo 'selected'; } ?>><?php echo $ol['type_name'];?></option>
               <?php  
             }
             ?>
              </select>
            </div>
        </div>


          <div class="form-group row">
            <label for="plan_id" class="col-sm-2 col-form-label">Maturity Instruction<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="maturity_instruction_id" class="form-control" id="maturity_instruction_id" <?php echo $disabled; ?>>
              <option value="">Select</option>
              <?php
             $maturity_instruction_list=select_data(TYPE_MASTER," where category='maturity_instruction'");
             foreach($maturity_instruction_list as $mil)
             {
             ?>
               <option value="<?php echo $mil['type_id'];?>" <?php if($maturity_instruction_id == $mil['type_id']){ echo 'selected'; } ?>><?php echo $mil['type_name'];?></option>
               <?php  
             }
             ?>
              </select>
            </div>
        </div> 


        <div class="form-group row">
            <label for="senior_citizen" class="col-sm-2 col-form-label">Senior Citizen<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <select name="senior_citizen" class="form-control" id="senior_citizen" <?php echo $disabled; ?>>
            <option value="">Select</option>
            <option value="1" <?php if($senior_citizen == 1){  echo 'selected'; } ?>>Yes</option>
            <option value="0" <?php if($senior_citizen == 0){  echo 'selected'; } ?>>No</option>
            </select>
        </div>
        </div>

      <div class="form-group row">
        <label for="acd" class="col-sm-2 col-form-label">Date<span style="color:red">*</span></label>
        <div class="col-sm-5">
          <input type="text" name="acd" class="form-control" id="acd" placeholder="Select Date" value="<?php echo $acd; ?>" <?php echo $disabled; ?>/>
        </div>
      </div>
      
         <div class="form-group row">
            <label for="senior_citizen" class="col-sm-2 col-form-label">SMS<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <select name="sms" class="form-control" id="sms" <?php echo $disabled; ?>>
            <option value="">Select</option>
            <option value="Yes"<?php if($sms == 'Yes'){  echo 'selected'; } ?>>YES</option> 
            <option value="No" <?php if($sms == 'No'){  echo 'selected'; } ?>>No</option>
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
  customer_id: { required: true},
  plan_type_id: {required: true },
  plan_id: {required: true },
  amount: {required: true },
  mode_of_payment_id: {required: true },
  cheque_acc_no:{ required:{
    depends: function(element) {
                    return $('#mode_of_payment_id').val()==54             
                }
  }

  },
  cheque_date:{ required:{
    depends: function(element) {
                    return $('#mode_of_payment_id').val()==54             
                }
  }

  },
  bank_name:{ required:{
    depends: function(element) {
                    return $('#mode_of_payment_id').val()==54             
                }
  }

  },
  mode_of_operation_id: {required: true },
  maturity_instruction_id: {required: true },
  senior_citizen: {required: true },
  acd: {required: true},
},
messages: {
  customer_id: { required: 'Please Select Member'},
  plan_type_id: {required: 'Please Select Plan Type' },
  plan_id: {required: 'Please Select Scheme Code' },
  amount: {required:'Please Enter Opening Amount' },
  mode_of_payment_id: {required: 'Please Select Mode of Payment' },
  cheque_acc_no: {required: 'Please Enter Cheque Account No'},
  cheque_date: {required: 'Please Enter Cheque Date'},
  bank_name: {required: 'Please Enter Bank Name'},
  mode_of_operation_id: {required: 'Please Select Mode of Operation'},
  maturity_instruction_id: {required: 'Please Select Maturity Instruction'},
  senior_citizen: {required: 'Please Select Senior Citizen'},
  acd: {required: 'Please Select Date'},
 
 
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


$(function() {
  $( "#acd" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
 });
});

$(document.body).on('change','#mode_of_payment_id',function(){
  var type_id = $('#mode_of_payment_id').val();
  if(type_id == 54)
  {
  $('.chequeacc').show();
  $('.chequedate').show();
  $('.chequebank').show();
  }else{
  $('.chequeacc').hide();
  $('.chequedate').hide();
  $('.chequebank').hide();
  }
});
   </script>
</body>
</html>
