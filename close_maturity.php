<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");


if(isset($_GET['account_id']) && $_GET['account_id']!="" )
{

  $account_id=$_GET['account_id'];

  $account_details=select_data(ACCOUNT_MASTER,"where account_id='".$account_id."'");
  $account_no = $account_details[0]['account_no'];
  $accamt = $account_details[0]['amount'];
  $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$account_details[0]['customer_id']."'");
  $customer_no = $customerlist[0]['customer_no']; 
  $customer_name = $customerlist[0]['customer_name'];
  $total_amt=0;
  $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='$account_id'");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

         $total_amt =$total_amt+$ad['renewal_amt'];

    }
  }

  $planlist=select_data(PLAN_MASTER," where plan_id='".$account_details[0]['plan_id']."'");
  $plan_code = $planlist[0]['plan_code'];

  $principal_amt = $account_details[0]['principal_amt'];
  $int_amt = $account_details[0]['int_amt'];
  $maturity_amt = $account_details[0]['maturity_amt'];
  $account_close_date = $account_details[0]['account_close_date'];
  if($account_close_date != '')
  {
    $acd = date('d-m-Y', strtotime($account_close_date));
  }
  else{
    $acd = '';
  }
}



if(isset($_POST['update']))
{

    if($session_role_id == 1)
    {
      $status=3;
    }
    else
    {
      $status=2;
    }


  $principal_amt = $_POST['principal_amt'];
  $int_amt = $_POST['int_amt'];
  $maturity_amt = $_POST['maturity_amt'];


  $acd=$_POST['acd'];
  if($acd!=""){ 
  $acd = date("Y-m-d", strtotime($acd));
  }

  $data['status']=$status;
  $data['principal_amt']=$principal_amt;
  $data['int_amt']=$int_amt;
  $data['maturity_amt']=$maturity_amt;
  $data['account_close_date']=$acd;
  $data['maturity_acct']=1;
  $data['prematurity_acct']=0;
  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;
  $update=update_data(ACCOUNT_MASTER,$data,"account_id",$_GET['account_id']);
  if($update!=0)
  { 

    if($session_role_id == 1)
    {

    //check whether for account close date entry exists in tally list table
    $get_tally_details = select_data(TALLY_MASTER,"where date='".$acd."' and branch_id='".$session_branch_id."'");
    if(count($get_tally_details )>0)
    {
      $exp_details=select_data(TALLY_MASTER,"where date='".$acd."' and branch_id='".$session_branch_id."'");
      $mamt=$exp_details[0]['maturity_amt'];
      $nmamt=(int)$mamt+$maturity_amt;
      $update_tallyqry="UPDATE ".TALLY_MASTER." set maturity_amt='$nmamt' where date='$acd' and branch_id='$session_branch_id'";
      $updatetally = mysqli_query($CN,$update_tallyqry);

    }
    else{

      $expdata['maturity_amt']=$maturity_amt;
      $expdata['date'] = $acd;
      $expdata['branch_id'] = $session_branch_id;
      $insert=insert_data(TALLY_MASTER,$expdata); 

    }

    echo "<script type='text/javascript'>window.location='view_maturity.php?success=Account Closed Successfully';</script>";

  }
  else{

      echo "<script type='text/javascript'>window.location='view_maturity.php?success=Maturity Account Details Forwarded Successfully';</script>";

    }
    
  }
}


?>
<style>

.invalid-feedback {
    display: inline;
    margin-left: 174px;
    font-size: 14px;
}

.dataTables_filter label{
  text-align:left;
}
.dataTables_filter{
  text-align:right;
}
</style>
<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>


  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Maturity Details</h1>
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
        <h3 class="card-title">Maturity Details</h3>
        <a class="btn-sm btn-success float-right" href="view_maturity.php">Back</a>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">
        <div class="card-body">


        <div class="form-group row">
                <label for="plan_term" class="col-sm-4 col-form-label">
                Account Number: &nbsp;&nbsp;&nbsp;<?php echo $account_no; ?>  
            </label>

            <label for="plan_term" class="col-sm-4 col-form-label">
                Member Number: &nbsp;&nbsp;&nbsp;<?php echo $customer_no; ?>  
            </label>


            <label for="plan_term" class="col-sm-4 col-form-label">
                Member Name: &nbsp;&nbsp;&nbsp;<?php echo $customer_name; ?>  
            </label>

          </div>

          <div class="form-group row">
                <label for="plan_term" class="col-sm-4 col-form-label">
                Scheme Code: &nbsp;&nbsp;&nbsp;<?php echo  $plan_code.'-'.$accamt; ?>  
            </label>

            <label for="plan_term" class="col-sm-4 col-form-label">
                Total Amount Paid: &nbsp;&nbsp;&nbsp;  <?php echo "Rs. ".$total_amt; ?>
            </label>
            
          </div>


          <div class="form-group row">
            <label for="maturity_amt" class="col-sm-2 col-form-label">Principal Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="principal_amt" class="form-control" id="principal_amt" placeholder="Enter Principal Amount" value="<?php echo $total_amt; ?>"/>
              <span class="has-error"></span>
            </div>
          </div>

          <div class="form-group row">
            <label for="maturity_amt" class="col-sm-2 col-form-label">Interest Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="int_amt" class="form-control" id="int_amt" placeholder="Enter Interest Amount" value="<?php echo $int_amt; ?>"/>
              <span class="has-error"></span>
            </div>
          </div>


          <div class="form-group row">
            <label for="maturity_amt" class="col-sm-2 col-form-label">Total Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="maturity_amt" class="form-control" id="maturity_amt" placeholder="Enter Maturity Amount" value="<?php echo $maturity_amt; ?>"/>
              <span class="has-error"></span>
            </div>
          </div>


          <div class="form-group row">
        <label for="acd" class="col-sm-2 col-form-label">Account Close Date<span style="color:red">*</span></label>
        <div class="col-sm-5">
          <input type="text" name="acd" class="form-control" id="acd" placeholder="Select Date" value="<?php echo $acd; ?>"/>
        </div>
      </div>         
          
        </div>
        <!-- /.card-body -->
              
        <div class="card-footer">

<div id="inner">
  <?php if(isset($_GET['account_id'])) { ?>

<?php if($session_role_id == 1){
?>

<button type="submit" class="btn-sm btn-success" id="update" name="update" >Approve</button>

<?php }else{ ?>

<button type="submit" class="btn-sm btn-success" id="update" name="update" >Forward To Admin</button>

<?php } ?>

          <?php } ?>
<a href=""><button type="button" class="btn-sm btn-default">Cancel</button></a>
</div>

</div>

      <!-- /.card-footer -->

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

$("#form1").validate({
rules: { 
 principal_amt: { required: true},
 int_amt: {required: true},
 maturity_amt: {required: true},
 acd: {required: true },
 
},
messages: {
principal_amt: { required: 'Please Enter Principal Amount'},
int_amt: {required: 'Please Enter Interest Amount' },
maturity_amt: {required: 'Please Enter Total Amount' },
 acd: {required: 'Please Select Account Closing Date' },
 


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
  



$(function() {
  $( "#acd" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c'
 });
});

 </script>
</body>
</html>
