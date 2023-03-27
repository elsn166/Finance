<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_branch_id = $_SESSION['bid'];
$session_role_id=$_SESSION['role_id'];

 if(!isset($_GET['tally_date'])) {
$tally_date=date("d-m-Y");
 }
 else
 {
   $tally_date = $_GET['tally_date'];
 }
$current_date = date("Y-m-d");
$opening_bal=0;
$member_amt=0;
$account_amt=0;
$savings_renewal_amt=0;
$loan_renewal_amt=0;
$loan_amt=0;
$maturity_amt=0;
$prematurity_amt=0;
$expense_amt=0;
$credit_total_amt=0;
$debit_total_amt=0;
$closing_balance=0;


if($session_role_id == 1 || $session_role_id == 7 || $session_role_id == 9)
  {
    $daily_list = select_data(TALLY_MASTER,"where date='$current_date'");
  }
  else{
    $daily_list = select_data(TALLY_MASTER,"where date='$current_date' and branch_id='$session_branch_id'");
  }


if(count($daily_list )>0){

  foreach($daily_list as $daily_list)
  {
    
    if($daily_list['opening_balance'] == '')
    {
      $opening_bal = 0;
    }
    else{
      $opening_bal += $daily_list['opening_balance'];
    }
    
    if($daily_list['member_amt'] == '')
    {
      $member_amt = 0;
    }
    else{
      $member_amt += $daily_list['member_amt'];
    }
    
    if($daily_list['account_amt'] == '')
    {
      $account_amt = 0;
    }
    else{
      $account_amt += $daily_list['account_amt'];
    }
    
    if($daily_list['savings_renewal_amt'] == '')
    {
      $savings_renewal_amt = 0;
    }
    else{
      $savings_renewal_amt += $daily_list['savings_renewal_amt'];
    }

    
    if($daily_list['loan_renewal_amt'] == '')
    {
      $loan_renewal_amt = 0;
    }
    else{
      $loan_renewal_amt += $daily_list['loan_renewal_amt'];
    }
    
    if($daily_list['loan_amt'] == '')
    {
      $loan_amt = 0;
    }
    else{
      $loan_amt += $daily_list['loan_amt'];
    }
    
    if($daily_list['maturity_amt'] == '')
    {
      $maturity_amt = 0;
    }
    else{
      $maturity_amt += $daily_list['maturity_amt'];
    }
    
    if($daily_list['prematurity_amt'] == '')
    {
      $prematurity_amt = 0;
    }
    else{
      $prematurity_amt += $daily_list['prematurity_amt'];
    }
    
    if($daily_list['expense_amt'] == '')
    {
      $expense_amt = 0;
    }
    else{
      $expense_amt += $daily_list['expense_amt'];
    }
  
  }//foreach
  
  $credit_total_amt = $opening_bal + $member_amt + $account_amt + $savings_renewal_amt + $loan_renewal_amt;

  $debit_total_amt = $loan_amt + $maturity_amt + $prematurity_amt + $expense_amt;
  
  $closing_balance = $credit_total_amt - $debit_total_amt;
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


  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Account Tally</h1>
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
        <h3 class="card-title">Account Tally</h3>

  <a class="btn-sm btn-success float-right" href="#">Print</a>
      </div>
      <!-- <form class="form-horizontal"> -->

      <form method="GET" action="" id="form1" name="form1">
        

      <div class="card-body">

      <div class="form-group row">
      <label for="employee_name" class="col-sm-1 col-form-label">Date<span style="color:red">*</span></label>


      <div class="col-sm-3">
      <input type="text" name="tally_date" class="form-control" id="tally_date" placeholder="Select Date" value="<?php echo $tally_date; ?>" />
      </div>



      <div class="col-sm-3">
      <button type="submit" class="btn-sm btn-success" id="submit">Submit</button>
      </div>


      </div>
      
   
       

    
        
           <!-- card-body -->
       

<?php if(!isset($_GET['tally_date'])) { ?>

         <div class="form-group row">
            <label for="plan_term" class="col-sm-4 col-form-label">
                Date: &nbsp;&nbsp;&nbsp;<?php echo date('d-m-Y'); ?>  
            </label>

            <label for="plan_term" class="col-sm-4 col-form-label">
                Opening Balance: &nbsp;&nbsp;&nbsp;<?php echo $opening_bal; ?>  
            </label>


            

          </div>

        <div class="form-group row">

                <table class="table table-bordered table-striped">
                
                <thead>
                  <tr>
                    <th>S. No</th>
                    <th>Category</th>
                    <th>Credit</th>
                    <th>Debit</th>
                  </tr>
                  </thead>
                  <tbody>

                  <tr>
                  <td>1</td>
                  <td>Member Creation</td>
                  <td><?php echo $member_amt; ?></td>
                  <td>-</td>
                  </tr>

                  <tr>
                  <td>2</td>
                  <td>Account Creation</td>
                  <td><?php echo $account_amt; ?></td>
                  <td>-</td>
                  </tr>

                  <tr>
                  <td>3</td>
                  <td>Savings Renewal</td>
                  <td><?php echo $savings_renewal_amt; ?></td>
                  <td>-</td>
                  </tr>

                  <tr>
                  <td>4</td>
                  <td>Loan Renewal</td>
                  <td><?php echo $loan_renewal_amt; ?></td>
                  <td>-</td>
                  </tr>

                  <tr>
                  <td>5</td>
                  <td>Loan</td>
                
                  <td>-</td>
                  <td><?php echo $loan_amt; ?></td>
                  </tr>

                  <tr>
                  <td>6</td>
                  <td>Maturity</td>
                
                  <td>-</td>
                  <td><?php echo $maturity_amt; ?></td>
                  </tr>

                  <tr>
                  <td>7</td>
                  <td>PreMaturity</td>
                  
                  <td>-</td>
                  <td><?php echo $prematurity_amt; ?></td>
                  </tr>

                  <tr>
                  <td>8</td>
                  <td>Expense</td>
                  
                  <td>-</td>
                  <td><?php echo $expense_amt; ?></td>
                  </tr>


                  <tr>
                  <td></td>
                  <td></td>
                  
                  <td><strong><?php echo $credit_total_amt; ?></strong></td>
                  <td><strong><?php echo $debit_total_amt; ?></strong></td>
                  </tr>

            
              
              </tbody></table>

                          
        </div>


        <div class="form-group row">
            <label for="plan_term" class="col-sm-4 col-form-label">
                Date: &nbsp;&nbsp;&nbsp;<?php echo date('d-m-Y'); ?>  
            </label>

            <label for="plan_term" class="col-sm-4 col-form-label">
                Closing Balance: &nbsp;&nbsp;&nbsp;<?php echo $closing_balance; ?>  
            </label>

       </div>

<?php }else{ 
  
  $tallydate = date('Y-m-d', strtotime($_GET['tally_date']));

  if($session_role_id == 1 || $session_role_id == 7 || $session_role_id == 9)
  {
    $daily_list = select_data(TALLY_MASTER,"where date='$tallydate'");
  }
  else{
    $daily_list = select_data(TALLY_MASTER,"where date='$tallydate' and branch_id='$session_branch_id'");
  }
  
  
  
  if(count($daily_list )>0){
    foreach($daily_list as $daily_list)
    {
      
      if($daily_list['opening_balance'] == '')
      {
        $opening_bal = 0;
      }
      else{
        $opening_bal += $daily_list['opening_balance'];
      }

      
      if($daily_list['member_amt'] == '')
      {
        $member_amt = 0;
      }
      else{
        $member_amt += $daily_list['member_amt'];
      }
      
      if($daily_list['account_amt'] == '')
      {
        $account_amt = 0;
      }
      else{
        $account_amt += $daily_list['account_amt'];
      }
      
      if($daily_list['savings_renewal_amt'] == '')
      {
        $savings_renewal_amt = 0;
      }
      else{
        $savings_renewal_amt += $daily_list['savings_renewal_amt'];
      }
      
      if($daily_list['loan_renewal_amt'] == '')
      {
        $loan_renewal_amt = 0;
      }
      else{
        $loan_renewal_amt += $daily_list['loan_renewal_amt'];
      }
      
      if($daily_list['loan_amt'] == '')
      {
        $loan_amt = 0;
      }
      else{
        $loan_amt += $daily_list['loan_amt'];
      }
      
      if($daily_list['maturity_amt'] == '')
      {
        $maturity_amt = 0;
      }
      else{

        $maturity_amt += $daily_list['maturity_amt'];
      }
      
      if($daily_list['prematurity_amt'] == '')
      {
        $prematurity_amt = 0;
      }
      else{
        $prematurity_amt += $daily_list['prematurity_amt'];
      }
      
      if($daily_list['expense_amt'] == '')
      {
        $expense_amt = 0;
      }
      else{
        $expense_amt += $daily_list['expense_amt'];
      }

      

    } //foreach

    $credit_total_amt =  $opening_bal + $member_amt + $account_amt + $savings_renewal_amt + $loan_renewal_amt;

    $debit_total_amt = $loan_amt + $maturity_amt + $prematurity_amt + $expense_amt;
    
    $closing_balance = $credit_total_amt - $debit_total_amt;


}
  
  
  
  
  
  ?>


<div class="form-group row">
<label for="plan_term" class="col-sm-4 col-form-label">
    Date: &nbsp;&nbsp;&nbsp;<?php echo $_GET['tally_date']; ?>  
</label>

<label for="plan_term" class="col-sm-4 col-form-label">
    Opening Balance: &nbsp;&nbsp;&nbsp;<?php echo $opening_bal; ?>  
</label>

</div>

<div class="form-group row">

    <table class="table table-bordered table-striped">
    
    <thead>
      <tr>
        <th>S. No</th>
        <th>Category</th>
        <th>Credit</th>
        <th>Debit</th>
      </tr>
      </thead>
      <tbody>

      <tr>
      <td>1</td>
      <td>Member Creation</td>
      <td><?php echo $member_amt; ?></td>
      <td>-</td>
      </tr>

      <tr>
      <td>2</td>
      <td>Account Creation</td>
      <td><?php echo $account_amt; ?></td>
      <td>-</td>
      </tr>

      <tr>
      <td>3</td>
      <td>Savings Renewal</td>
      <td><?php echo $savings_renewal_amt; ?></td>
      <td>-</td>
      </tr>

      <tr>
      <td>4</td>
      <td>Loan Renewal</td>
      <td><?php echo $loan_renewal_amt; ?></td>
      <td>-</td>
      </tr>

      <tr>
      <td>5</td>
      <td>Loan</td>
    
      <td>-</td>
      <td><?php echo $loan_amt; ?></td>
      </tr>

      <tr>
      <td>6</td>
      <td>Maturity</td>
    
      <td>-</td>
      <td><?php echo $maturity_amt; ?></td>
      </tr>

      <tr>
      <td>7</td>
      <td>PreMaturity</td>
      
      <td>-</td>
      <td><?php echo $prematurity_amt; ?></td>
      </tr>

      <tr>
      <td>8</td>
      <td>Expense</td>
      
      <td>-</td>
      <td><?php echo $expense_amt; ?></td>
      </tr>


      <tr>
      <td></td>
      <td></td>
      
      <td><strong><?php echo $credit_total_amt; ?></strong></td>
      <td><strong><?php echo $debit_total_amt; ?></strong></td>
      </tr>

   
  
  
  </tbody></table>

              
</div>




<div class="form-group row">
<label for="plan_term" class="col-sm-4 col-form-label">
    Date: &nbsp;&nbsp;&nbsp;<?php echo $_GET['tally_date']; ?>  
</label>

<label for="plan_term" class="col-sm-4 col-form-label">
    Closing Balance: &nbsp;&nbsp;&nbsp;<?php echo $closing_balance; ?>  
</label>

</div>



  <?php
} ?>
          
        </div>
        <!-- /.card-body -->
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
    $("#formdgdfg1").validate({
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
 $( "#tally_date" ).datepicker({
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
