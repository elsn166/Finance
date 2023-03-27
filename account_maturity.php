<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];

$maturity_payment_id='';
$bank_name='';
$branch_name="";
$beneficiary_name = "";
$bank_acc_no="";
$ifsc_code="";




if(isset($_GET['account_id']) && $_GET['account_id']!="" )
{
  $account_id=$_GET['account_id'];
  $account_details=select_data(ACCOUNT_MASTER,"where account_id='$account_id' ");
  $maturity_payment_id=$account_details[0]['maturity_payment_id'];
  $bank_name=$account_details[0]['trans_bank_name'];
  $branch_name=$account_details[0]['trans_branch_name'];
  $beneficiary_name=$account_details[0]['trans_beneficiary_name'];
  $bank_acc_no=$account_details[0]['trans_bank_acc_no'];
  $ifsc_code=$account_details[0]['trans_ifsc_code'];
}


if(isset($_POST['update']))
{
  $maturity_payment_id=$_POST['maturity_payment_id'];
  $bank_name=$_POST['bank_name'];
  $branch_name=$_POST['branch_name'];
  $beneficiary_name=$_POST['beneficiary_name'];
  $bank_acc_no=$_POST['bank_acc_no'];
  $ifsc_code=$_POST['ifsc_code'];
  
  
  
  $data['maturity_payment_id']=$maturity_payment_id;
  $data['trans_bank_name']=$bank_name;
  $data['trans_branch_name']=$branch_name;
  $data['trans_beneficiary_name']=$beneficiary_name;

  $data['trans_bank_acc_no'] = $bank_acc_no;
  $data['trans_ifsc_code'] = $ifsc_code;

 

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;


  $accountlist = select_data(ACCOUNT_MASTER," where account_id='".$_GET['account_id']."'");
  $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$accountlist[0]['customer_id']."'");
  $branchlist=select_data(BRANCH_MASTER," where branch_id='".$customerlist[0]['branch_id']."'");
  $branch_code = $branchlist[0]['branch_code'];

  $planlist=select_data(PLAN_MASTER," where plan_id='".$accountlist[0]['plan_id']."'");
  $plan_code = $planlist[0]['plan_code'];

  $cur_year = date('y');
  $cur_mon = date('m');
  $cur_date = date('d');

  // generating account number
  $acct_details=select_data(ACCOUNT_MASTER,"ORDER BY account_id ASC");
  $count_val = count($acct_details);

  if($count_val==0)
  {
    $acc_no = $plan_code.$branch_code.$cur_date.$cur_mon.$cur_year."00001";
  $ref_no = $plan_code."-".$branch_code."-".$cur_date."-".$cur_mon."-".$cur_year."-"."00001";
  }
  else
  {
    $ref_acc_no = get_last_acc_no();
    $accno = explode("-",$ref_acc_no);
  
    $new_acc_no = str_pad($accno[5] + 1, 5, 0, STR_PAD_LEFT);

$acc_no = $plan_code.$branch_code.$cur_date.$cur_mon.$cur_year.$new_acc_no;
$ref_no = $plan_code."-".$branch_code."-".$cur_date."-".$cur_mon."-".$cur_year."-".$new_acc_no;
  }


  $data['account_no'] = $acc_no;
  $data['ref_acc_no'] = $ref_no;

  $update=update_data(ACCOUNT_MASTER,$data,"account_id",$_GET['account_id']);
  if($update!=0)
  { 
    echo "<script type='text/javascript'>window.location='account_maturity.php?account_id=".$_GET['account_id']."&success=Details Updated Successfully';</script>";
  }
        
}
?>
<style>

.invalid-feedback {
    display: inline;
    margin-left: 190px;
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
        <h3 class="card-title">Maturity Payment Details</h3>
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
            <label for="maturity_payment_id" class="col-sm-3 col-form-label">Mode Of Payment<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="maturity_payment_id" class="form-control" id="maturity_payment_id">
              <option value="">Select</option>
              <?php
              $payment_list=select_data(TYPE_MASTER," where category='mode_of_maturity_payment'");
              foreach($payment_list as $pl)
              {
              ?>
                <option value="<?php echo $pl['type_id'];?>" <?php if($maturity_payment_id == $pl['type_id']){ echo 'selected'; } ?>><?php echo $pl['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>


 <div class="form-group row transaction" style="display:none;">
      <label for="bank_name" class="col-sm-3 col-form-label">Bank Name<span style="color:red">*</span></label>
      <div class="col-sm-5">
        <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Enter Bank Name" value="<?php echo $bank_name; ?>" />
      </div>
    </div>

    <div class="form-group row transaction" style="display:none;">
      <label for="branch_name" class="col-sm-3 col-form-label">Branch Name<span style="color:red">*</span></label>
      <div class="col-sm-5">
        <input type="text" name="branch_name" class="form-control" id="branch_name" placeholder="Enter Branch Name" value="<?php echo $branch_name; ?>" />
      </div>
    </div>

    <div class="form-group row transaction" style="display:none;">
      <label for="beneficiary_name" class="col-sm-3 col-form-label">Beneficiary Name<span style="color:red">*</span></label>
      <div class="col-sm-5">
        <input type="text" name="beneficiary_name" class="form-control" id="beneficiary_name" placeholder="Enter Beneficairy Name" value="<?php echo $beneficiary_name; ?>" />
      </div>
    </div>

      <div class="form-group row transaction" style="display:none;">
      <label for="bank_acc_no" class="col-sm-3 col-form-label">Account Number<span style="color:red">*</span></label>
      <div class="col-sm-5">
        <input type="text" name="bank_acc_no" class="form-control" id="bank_acc_no" placeholder="Enter Account Number" value="<?php echo $bank_acc_no; ?>" />
      </div>
    </div>


     <div class="form-group row transaction" style="display:none;">
      <label for="ifsc_code" class="col-sm-3 col-form-label">IFSC Code<span style="color:red">*</span></label>
      <div class="col-sm-5">
        <input type="text" name="ifsc_code" class="form-control" id="ifsc_code" placeholder="Enter IFSC Code" value="<?php echo $ifsc_code; ?>" />
      </div>
    </div>

      

  
          
        </div>
        <!-- /.card-body -->
        <br>
              <br>
        <div class="card-footer">

        <div id="inner">
            <?php if(!isset($_GET['account_id'])) { ?>
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

 

<link rel="stylesheet" href="dist/css/jquery-ui.css">

 <script>
 $(function () {
     $("#form1").validate({
rules: { 
  maturity_payment_id: { required: true},
  bank_name:{ required:{
    depends: function(element) {
                    return $('#maturity_payment_id').val()==70             
                }
  }

  },
  branch_name:{ required:{
    depends: function(element) {
                    return $('#maturity_payment_id').val()==70             
                }
  }

  },

  beneficiary_name:{ required:{
    depends: function(element) {
                    return $('#maturity_payment_id').val()==70             
                }
  }

  },

  bank_acc_no:{ required:{
    depends: function(element) {
                    return $('#maturity_payment_id').val()==70             
                }
  }

  },

  ifsc_code:{ required:{
    depends: function(element) {
                    return $('#maturity_payment_id').val()==70             
                }
  }

  },
  
},
messages: {
  maturity_payment_id: { required: 'Please Select Mode of Payment'},
  bank_name: {required: 'Please Enter Bank Name' },
  branch_name: {required: 'Please Enter Branch Name' },
  beneficiary_name: {required: 'Please Enter Beneficiary Name' },
  bank_acc_no: {required: 'Please Enter Account Number' },
  ifsc_code: {required: 'Please Enter IFSC Code' },
  
 
 
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

$(document.body).on('change','#maturity_payment_id',function(){
  var type_id = $('#maturity_payment_id').val();
  if(type_id == 70)
  {
  $('.transaction').show();
  }else{
  $('.transaction').hide();
  }
});
   </script>
</body>
</html>
