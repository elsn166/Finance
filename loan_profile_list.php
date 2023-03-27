<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");

 $employee_id='';
 $session_branch_id = $_SESSION['bid'];
 $session_role_id=$_SESSION['role_id'];
if(isset($_GET['loan_id']) && $_GET['loan_id']!="" )
{
    
  $loan_id=$_GET['loan_id'];

  $loan_details=select_data(LOAN_MASTER,"where loan_id='".$loan_id."'");
  $loan_no = $loan_details[0]['loan_no'];
  $customer_id = $loan_details[0]['customer_id'];
  $loan_amt=$loan_details[0]['loan_amount'];
  $loan_repay_amt=$loan_details[0]['loan_repay_amt'];
  $loan_penalty=$loan_details[0]['loan_penalty'];
  $loan_closing_date=date('d-m-Y',strtotime($loan_details[0]['actual_date']));
//  $loan_closing_date=$loan_details[0]['actual_date'];
  $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$loan_details[0]['customer_id']."'");
  $customer_no = $customerlist[0]['customer_no']; 
  $customer_name = $customerlist[0]['customer_name'];
  $total_amt=0;
  $loan_details = select_data(LOAN_RENEWAL,"where loan_id='$loan_id'");
  if(count($loan_details) > 0)
  { 
    
    foreach($loan_details as $ld)
    {

         $total_amt =$total_amt+$ld['loan_renewal_amt'];

    }
  }
  
 
}

if(isset($_POST['update3']))
{
  if($session_role_id == 1) {
      $status=4;
  }
  else{
      $status=5;
  }
  $penalty=$_POST['penalty'];
  $penalty=$_POST['penalty'];
   $loan_repay_amt=$_POST['loan_repay_amt'];
   $loan_amount=$_POST['loan_amount'];
   $pre_date=$_POST['pre-close'];
  if($pre_date!=""){ 
  $pre_date = date("Y-m-d", strtotime($pre_date));
  }
   
  $date= date("Y-m-d");


  $data['status']=$status;
  $data['loan_penalty']=$penalty;
  $data['penalty_date']=$date;
  $data['status']=$status;
  $data['loan_repay_amt']=$loan_repay_amt;
  $data['loan_amount']=$loan_amount;
  $data['actual_date']=$pre_date;
  

  $update=update_data(LOAN_MASTER,$data,"loan_id",$_GET['loan_id']);
  if($update!=0)
  { 
      $_SESSION['sta'] = $_GET['loan_status'];
      
    echo "<script type='text/javascript'>window.location='view_loan_renewal.php';</script>";
  }
        
}
if(isset($_POST['update2']))
{

    {
      $status=4;
    }
   $penalty=$_POST['penalty'];
   $pre_date=$_POST['pre-close'];
    if($pre_date!=""){ 
  $pre_date = date("Y-m-d", strtotime($pre_date));
  }
  $data['loan_penalty']=$penalty;


  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;
  $data['status']=$status;
  $data['actual_date']=$pre_date;

  //if only admin login, generate loan no
  if($session_role_id == 1)

//the above part is only functioned by admin

  $update=update_data(LOAN_MASTER,$data,"loan_id",$_GET['loan_id']);
  if($update!=0)
  { 

    if($session_role_id == 1)
    {
      echo "<script type='text/javascript'>window.location='dashboard.php';</script>";
    }
    else{
      echo "<script type='text/javascript'>window.location='dashboard.php'</script>";

    }
    
  }
        
}
if(isset($_POST['update1']))
{

    {
      $status=5;
    }
   
  $data['status']=$status;

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  //if only admin login, generate loan no
  
//the above part is only functioned by admin

  $update=update_data(LOAN_MASTER,$data,"loan_id",$_GET['loan_id']);
  if($update!=0)
  { 

    if($session_role_id == 1)
    {
      echo "<script type='text/javascript'>window.location='dashboard.php';</script>";
    }
    else{
      echo "<script type='text/javascript'>window.location='dashboard.php';</script>";

    }
    
  }
        
}
?>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
<style>
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

<div class="alert alert-success alert-dismissible" id="successToShow" style="margin-left:248px;display:none;">Added Successfully</div>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Loan Closing View</h1>
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
        <h3 class="card-title">Loan Closing View</h3>
  
        <a class="btn-sm btn-success float-right" href="view_loan_renewal.php">Back</a>
        
        <?php if($session_role_id != 1 && $session_role_id != 2) { ?>

<a class="btn-sm btn-success float-right" data-toggle="modal" data-target="#feedback-modal" data-backdrop="static" data-keyboard="false" style="margin-right:34px;color:white;">

          Add Renewal Amount
</a>

 <!-- large modal -->
 <div class="modal fade" id="feedback-modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Loan Renewal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <div class="card-body">
            <form method="post" action="" id="form2" name="form2">

         

            <div class="form-group row">
            <label for="loan_renewal_amt" class="col-sm-2 col-form-label">Renewal Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="loan_renewal_amt" class="form-control" id="loan_renewal_amt" placeholder="Enter Renewal Amount" value="" />
            </div>

            <span id="errorToShowAmt" style="color:red;margin-left:150px;"></span>

        </div>


        <div class="form-group row">
            <label for="loan_renewal_date" class="col-sm-2 col-form-label">Renewal Date<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="loan_renewal_date" class="form-control" id="loan_renewal_date" placeholder="Select Renewal Date" value="" />
            </div>

            <span id="errorToShowDate" style="color:red;margin-left:150px;"></span>


        </div>

        <input type="hidden" name="get_loan_id" id="get_loan_id" value="<?php echo $_GET['loan_id']; ?>">

        
        <input type="hidden" name="get_cust_id" id="get_cust_id" value="<?php echo $customer_id; ?>">

        <input type="hidden" name="get_user_id" id="get_user_id" value="<?php echo $userid; ?>">
        
        <input type="hidden" name="get_branch_id" id="get_branch_id" value="<?php echo $session_branch_id; ?>">

       
        <span id="errorToShow" style="color:red;"></span>
       

            </form>
</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="submit">Submit</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      
      <?php }
?>

      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">
        <div class="card-body">


        <div class="form-group row">
                <label for="plan_term" class="col-sm-4 col-form-label">
                Loan Number: &nbsp;&nbsp;&nbsp;<?php echo $loan_no; ?>  
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
                Total Amount Paid: &nbsp;&nbsp;&nbsp;<?php echo "Rs. ".$total_amt; ?>  </label>
                
 
 
  <?php 
     $date1 = date('Y-m-d');
      $loanlist=select_data(LOAN_MASTER,"where loan_id='".$_GET['loan_id']."'");

    //  $closing_date['closing_after2_days'] =$loanlist;
    $close = $loanlist[0]['closing_after2_days'];
    // echo $close;
    $close_date = date('Y-m-d', strtotime($close));
    // echo $close_date;
    
   if($close_date <= $date1 ){?>
   <!-- Button trigger modal -->


<!-- Modal -->

   <?php }?>


            

           

          </div>


          <div class="form-group row">
            <label for="maturity_amt" class="col-sm-2 col-form-label">Loan Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="loan_amount" class="form-control" id="loan_amount" placeholder="Enter Interest Amount" value="<?php echo $loan_amt; ?>"/>
              <span class="has-error"></span>
            </div>
          </div>


          <div class="form-group row">
            <label for="maturity_amt" class="col-sm-2 col-form-label">Loan Repay Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="loan_repay_amt" class="form-control" id="loan_repay_amt" placeholder="Enter Maturity Amount" value="<?php echo $loan_repay_amt   ; ?>"/>
              <span class="has-error"></span>
            </div>
          </div>


          <div class="form-group row">
        <label for="acd" class="col-sm-2 col-form-label">Loan Paid Amount<span style="color:red">*</span></label>
        <div class="col-sm-5">
          <input type="text" name="tot_amt" class="form-control" id="tot_amt" placeholder="Select Date" value="<?php echo $total_amt; ?>"/>
        </div>
      </div>         
          
         <div class="form-group row">
        <label for="maturity_amt" class="col-sm-2 col-form-label">Penalty Amount<span style="color:red">*</span></label>
        <div class="col-sm-5">
        <input type="text" name="penalty" class="form-control" id="penalty" placeholder="Enter Penalty Amount" value="<?php echo $loan_penalty; ?>"/>
         <span class="has-error"></span>
        </div>
          </div>
          
         <div class="form-group row">
        <label for="maturity_amt" class="col-sm-2 col-form-label">Loan Close Date<span style="color:red">*</span></label>
        <div class="col-sm-5">
        <input type="text" name="pre-close" class="form-control" id="pre-close"  value="<?php echo $loan_closing_date; ?>"/>
         <span class="has-error"></span>
        </div>
          </div>

      <?php
    if($session_role_id == 1){
    ?>
      <button type="submit" class="btn-sm btn-success" id="update2"name="update2" $disabled >Account closing</button>
 <?php }?>
        
        </div>
        <!-- /.card-body -->
              


 

          
         
          
        </div>
        <!-- /.card-body -->
              
        <div class="card-footer">

       

          
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

$(function() {
  $( "#pre-close" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c'
 });
});


 $(document).ready(function(){ 	
	$("button#submit").click(function(){

//alert('hi');

    var loan_id = $('#get_loan_id').val();
    var loan_renewal_amt = $("#loan_renewal_amt").val();
    var loan_renewal_date = $("#loan_renewal_date").val();
    var customer_id = $('#get_cust_id').val();
    var renewal_user_id = $('#get_user_id').val();
    
    var renewal_branch_id = $('#get_branch_id').val();
   

    if(loan_renewal_amt == '' && loan_renewal_date == '')
    {
          $("#errorToShowAmt").html("Please Enter Renewal Amount");

          $("#errorToShowDate").html("Please Select Renewal Date");
          return false;
    }
    else if(loan_renewal_amt == '')
    {
      $("#errorToShowAmt").html("Please Enter Renewal Amount");
      return false;
    }
    else if(loan_renewal_date == '')
    {
      $("#errorToShowDate").html("Please Select Renewal Date");
      return false;
    }
    else{

      var dataString = "renewal_loan_id="+loan_id+"&loan_renewal_amt="+loan_renewal_amt+"&loan_renewal_date="+loan_renewal_date+"&loan_renewal_customer_id="+customer_id+"&loan_renewal_user_id="+renewal_user_id+"&loan_renewal_branch_id="+renewal_branch_id;
      $.ajax({ 
      type: "GET", 
      url: "ajax_data.php", 
      data: dataString, 
        
      success:  function(data){ 
//alert(data);
        if(data == 1)
        {
          $("#errorToShow").html("Entry Already Exist For Selected Date");
          return false;
        }
        else if(data == 0){

           $("#feedback-modal").modal('hide'); 
           $("#successToShow").show();
           location.reload();
        }
        
      } 
    });

    }



	});	
});


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
