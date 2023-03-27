<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_role_id=$_SESSION['role_id'];
$session_branch_id = $_SESSION['bid'];

if(isset($_GET['account_id']) && $_GET['account_id']!="" )
{

  $account_id=$_GET['account_id'];

  

  $account_details=select_data(ACCOUNT_MASTER,"where account_id='".$account_id."'");
  $account_no = $account_details[0]['account_no'];
  $customer_id = $account_details[0]['customer_id'];
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

  $acct_status = $account_details[0]['status'];
 
}

?>
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
            <h1>PreMaturity Report - Savings Renewal List</h1>
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
        <h3 class="card-title">PreMaturity Report - Savings Renewal List</h3>

 <a class="btn-sm btn-success float-right" href="prematurity_report_view_list_print.php?account_id=<?php echo $ad['account_id']; ?>"target="_blank">Print</a>
        <a class="btn-sm btn-success float-right" href="maturity_report.php">Back</a>



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
                Total Amount Paid: &nbsp;&nbsp;&nbsp;<?php echo "Rs. ".$total_amt; ?>  
            </label>

           

          </div>

 <div class="form-group row">
 <?php 
              $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='$account_id' order by renewal_date desc");
    if(count($acct_details) > 0)
    { ?>
        
                <table id="example2" class="table table-bordered table-striped" style="width:990px;">
                
                <thead>
                  <tr>
                    <th>S. No</th>
                    <th>Renewal Amount</th>
                    <th>Renewal Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $i=1;
              
                    
                    foreach($acct_details as $ad)
                    {
                      $date = date('d-m-Y',strtotime($ad['renewal_date']))
                      ?>
                    <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $ad['renewal_amt'];?></td>
                    <td><?php echo $date; ?></td>

                        
                        
                    </tr>
       <?php  $i++; } ?>
                </tbody></table>

                   <?php } ?>
 </div>


          
         
          
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
  $( "#savings_renewal_date" ).datepicker({
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

    var account_id = $('#get_acct_id').val();
    var savings_renewal_amt = $("#savings_renewal_amt").val();
    var savings_renewal_date = $("#savings_renewal_date").val();
    var customer_id = $('#get_cust_id').val();
    var renewal_user_id = $('#get_user_id').val();
    
    var renewal_branch_id = $('#get_branch_id').val();
   

    if(savings_renewal_amt == '' && savings_renewal_date == '')
    {
          $("#errorToShowAmt").html("Please Enter Renewal Amount");

          $("#errorToShowDate").html("Please Select Renewal Date");
          return false;
    }
    else if(savings_renewal_amt == '')
    {
      $("#errorToShowAmt").html("Please Enter Renewal Amount");
      return false;
    }
    else if(savings_renewal_date == '')
    {
      $("#errorToShowDate").html("Please Select Renewal Date");
      return false;
    }
    else{

      var dataString = "renewal_account_id="+account_id+"&savings_renewal_amt="+savings_renewal_amt+"&savings_renewal_date="+savings_renewal_date+"&renewal_customer_id="+customer_id+"&renewal_user_id="+renewal_user_id+"&renewal_branch_id="+renewal_branch_id;
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
</body>
</html>
