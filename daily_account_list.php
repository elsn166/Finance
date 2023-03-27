<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_branch_id = $_SESSION['bid'];
$session_role_id=$_SESSION['role_id'];

 if(!isset($_POST['tally_date'])) {
$tally_date=date("d-m-Y");
$tally_date1=date("Y-m-d");
$close_tally_date=date("d-m-Y");
$close_tally_date1=date("Y-m-d");
 }
 else
 {
   $tally_date = $_POST['tally_date'];
   $tally_date1 = date('Y-m-d', strtotime($_POST['tally_date']));
   if($session_role_id ==1)
   {
    $close_tally_date = '';
    $close_tally_date1 = '';
    
   }
   else
   {
    $close_tally_date = $_POST['close_tally_date'];
    $close_tally_date1 = date('Y-m-d', strtotime($_POST['close_tally_date']));
   }
   
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
$deduction_amt=0;
$income_amt=0;

if(isset($_POST['submit']))
{

$closing_bal = $_POST['closing_bal_hidden'];
$selecteddate = $_POST['selecteddate'];
$close_tally_date = $_POST['close_tally_date'];

// $next_date = date('Y-m-d', strtotime('+1 day', strtotime($selecteddate)) );

$next_date = date('Y-m-d', strtotime($close_tally_date));

$get_tally_details = select_data(TALLY_MASTER,"where date='".$next_date."' and branch_id='".$session_branch_id."'");
if(count($get_tally_details)>0)
{
  $update_tallyqry="UPDATE ".TALLY_MASTER." set opening_balance='$closing_bal' where date='$next_date' and branch_id='$session_branch_id'";
  $updatetally = mysqli_query($CN,$update_tallyqry);
  echo "<script type='text/javascript'>window.location='daily_account_list.php?success=Account Tally Submitted Successfully';</script>";
}
else{
$data['opening_balance']=$closing_bal;
$data['date'] = $next_date;
$data['branch_id'] = $session_branch_id;
$insert=insert_data(TALLY_MASTER,$data);
echo "<script type='text/javascript'>window.location='daily_account_list.php?success=Account Tally Submitted Successfully';</script>";


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
<style>
.dataTables_filter label{
  text-align:left;
}
.dataTables_filter{
  text-align:right;
}
</style>
<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible" style="margin:0 0 0 230px;width:100% !important"><?php echo  $info;?></div>

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

  <!-- <a class="btn-sm btn-success float-right" href="account_tally_print.php" onclick="window.print()">Print</a> -->

  

  <a class="btn-sm btn-success float-right" href="account_tally_print.php?tally_date=<?php echo $tally_date; ?>&branch_id=<?php echo $session_branch_id; ?>&close_tally_date=<?php echo $close_tally_date; ?>" target="_blank">Print</a>



  


      </div>
      <!-- <form class="form-horizontal"> -->

      <form method="POST" action="" id="form1" name="form1">
        

      <div class="card-body">

      <div class="form-group row">
      <label for="employee_name" class="col-sm-1 col-form-label">Date<span style="color:red">*</span></label>


      <div class="col-sm-3">
      <input type="text" name="tally_date" class="form-control" id="tally_date" placeholder="Select Date" value="<?php echo $tally_date; ?>" />
      </div>



      <div class="col-sm-3">
      <button type="submit" class="btn-sm btn-success" id="view">View</button>
      </div>


      </div>
        
           <!-- card-body -->
       

<?php if(!isset($_POST['tally_date'])) { 
  
  
if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
  
  
$daily_list = select_data(TALLY_MASTER,"where date='$current_date'");

$pmk_remitted_amt = pmk_remitted($current_date);
$ramnad_remitted_amt = ramnad_remitted($current_date);
$mudhuvai_remitted_amt = mudhuvai_remitted($current_date);
$madurai_remitted_amt = madurai_remitted($current_date);
$ho_remitted_amt = ho_remitted($current_date);

$pmk_received_amt = pmk_received($current_date);
$ramnad_received_amt = ramnad_received($current_date);
$mudhuvai_received_amt = mudhuvai_received($current_date);
$madurai_received_amt = madurai_received($current_date);
$ho_received_amt = ho_received($current_date);

}
else{
  $daily_list = select_data(TALLY_MASTER,"where date='$current_date' and branch_id='$session_branch_id'");


$pmk_remitted_amt = pmk_remitted_branch($current_date,$session_branch_id);
$ramnad_remitted_amt = ramnad_remitted_branch($current_date,$session_branch_id);
$mudhuvai_remitted_amt = mudhuvai_remitted_branch($current_date,$session_branch_id);
$madurai_remitted_amt = madurai_remitted_branch($current_date,$session_branch_id);
$ho_remitted_amt = ho_remitted_branch($current_date,$session_branch_id);

$pmk_received_amt = pmk_received_branch($current_date,$session_branch_id);
$ramnad_received_amt = ramnad_received_branch($current_date,$session_branch_id);
$mudhuvai_received_amt = mudhuvai_received_branch($current_date,$session_branch_id);
$madurai_received_amt = madurai_received_branch($current_date,$session_branch_id);
$ho_received_amt = ho_received_branch($current_date,$session_branch_id);

}
// loan penalty ammount start
 if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
  {
      $date= date("Y-m-d");
    $renewal_list=select_data(LOAN_MASTER," where penalty_date='$current_date'");
  }
  else{

    $renewal_list=select_data(LOAN_MASTER," where penalty_date='$current_date' and branch_id='$session_branch_id'");
  }

if(count($renewal_list)>0)
{
    $penalty_amt = 0;
    $i=1;
    foreach($renewal_list as $cl)
    {
      $penalty_amt = (int)$penalty_amt + (int)$cl['loan_penalty'];
    }
}
else{
   $penalty_amt=0;  
}

// loan penalty ammount end

if(count($daily_list )>0){

foreach($daily_list as $daily_list)
{
  
  if($daily_list['opening_balance'] == '')
  {
    $opening_bal = $opening_bal;
  }
  else{
    $opening_bal += $daily_list['opening_balance'];
  }
  
  if($daily_list['member_amt'] == '')
  {
    $member_amt = $member_amt;
  }
  else{
    $member_amt += $daily_list['member_amt'];
  }
  
  if($daily_list['account_amt'] == '')
  {
    $account_amt = $account_amt;
  }
  else{
    $account_amt += $daily_list['account_amt'];
  }
  
  if($daily_list['savings_renewal_amt'] == '')
  {
    $savings_renewal_amt = $savings_renewal_amt;
  }
  else{
    $savings_renewal_amt += $daily_list['savings_renewal_amt'];
  }

  
  if($daily_list['loan_renewal_amt'] == '')
  {
    $loan_renewal_amt = $loan_renewal_amt;
  }
  else{
    $loan_renewal_amt += $daily_list['loan_renewal_amt'];
  }
  
  if($daily_list['loan_amt'] == '')
  {
    $loan_amt = $loan_amt;
  }
  else{
    $loan_amt += $daily_list['loan_amt'];
  }
  
  if($daily_list['maturity_amt'] == '')
  {
    $maturity_amt = $maturity_amt;
  }
  else{
    $maturity_amt += $daily_list['maturity_amt'];
  }
  
  if($daily_list['prematurity_amt'] == '')
  {
    $prematurity_amt = $prematurity_amt;
  }
  else{
    $prematurity_amt += $daily_list['prematurity_amt'];
  }
  
  if($daily_list['expense_amt'] == '')
  {
    $expense_amt = $expense_amt;
  }
  else{
    $expense_amt += $daily_list['expense_amt'];
  }

  if($daily_list['deduction_amt'] == "")
  {
    $deduction_amt = $deduction_amt;
  }
  else{
    $deduction_amt += $daily_list['deduction_amt'];
  }

  if($daily_list['income_amt'] == '')
  {
    $income_amt = $income_amt;
  }
  else{
    $income_amt += $daily_list['income_amt'];
  }

}//foreach






}




  
$total_income=$penalty_amt+$deduction_amt+$ramnad_received_amt+$pmk_received_amt+$ho_received_amt+$madurai_received_amt+$mudhuvai_received_amt+$income_amt;
$total_expense=$ho_remitted_amt+ $madurai_remitted_amt+$mudhuvai_remitted_amt+$pmk_remitted_amt+$ramnad_remitted_amt+$expense_amt;
$credit_total_amt = $opening_bal + $member_amt + $account_amt + $savings_renewal_amt + $loan_renewal_amt + $total_income;
$debit_total_amt = $loan_amt + $maturity_amt + $prematurity_amt + $total_expense;
$closing_balance = $credit_total_amt - $debit_total_amt;
  ?>

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
                    <th>Debit</th>
                    <th>Credit</th>
                    
                  </tr>
                  </thead>
                  <tbody>

                  <tr>
                  <td>1</td>
                  <td>Member Creation</td>
                  <td>-</td>
                  <td><?php echo $member_amt; ?></td>
                  
                  </tr>

                  <tr>
                  <td>2</td>
                  <td>Account Creation</td>
                  <td>-</td>
                  <td><?php echo $account_amt; ?></td>
                  
                  </tr>

                  <tr>
                  <td>3</td>
                  <td>Savings Renewal</td>
                  <td>-</td>
                  <td><?php echo $savings_renewal_amt; ?></td>
                 
                  </tr>

                  <tr>
                  <td>4</td>
                  <td>Loan Renewal</td>
                  <td>-</td>
                  <td><?php echo $loan_renewal_amt; ?></td>
                 
                  </tr>
                  
                <!--  <tr>
                  <td>5</td>
                  <td>Loan penalty</td>
                  <td>-</td>
                  <td><?php echo $penalty_amt; ?></td>
                 
                  </tr>



                  <tr>
                  <td>6</td>
                  <td>Deduction Amount</td>
                  <td>-</td>
                  <td><?php echo $deduction_amt; ?></td>
                 
                  </tr>-->
                  
                  <tr>
                  <td>5</td>
                  <td>PreMaturity</td>
                  <td><?php echo $prematurity_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                
                
                  <tr>
                  <td>6</td>
                  <td>Loan</td>
                  <td><?php echo $loan_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                  <tr>
                  <td>7</td>
                  <td>Maturity</td>
                  <td><?php echo $maturity_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                 
                 <tr>
                 <td>8</td>
                 <td>Total Expense</td>
                 <td><?php echo $total_expense; ?></td>
                 <td>-</td>
                 </tr>


                <!--  <tr>
                  <td>11</td>
                  <td>AMOUNT RECEIVED FROM RAMNAD BRANCH</td>
                  <td>-</td>
                  <td><?php echo $ramnad_received_amt; ?></td>
                 
                 
                  </tr>

                  <tr>
                  <td>12</td>
                  <td>AMOUNT RECEIVED FROM PMK BRANCH</td>
                  <td>-</td>
                  <td><?php echo $pmk_received_amt; ?></td>
                  
                 
                  </tr>

                  <tr>

                  <td>13</td>
                  <td>AMOUNT RECEIVED FROM MUDHUVAI BRANCH</td>
                  <td>-</td>
                  <td><?php echo $mudhuvai_received_amt; ?></td>
                 
                 
                  </tr>
                  
                  <tr>

                  <td>14</td>
                  <td>AMOUNT RECEIVED FROM MADURAI BRANCH</td>
                  <td>-</td>
                  <td><?php echo $madurai_received_amt; ?></td>
                 
                 
                  </tr>



                  <tr>
                  <td>15</td>
                  <td>AMOUNT RECEIVED FROM HO</td>
                  <td>-</td>
                  <td><?php echo $ho_received_amt; ?></td>
                  
                  </tr>-->

                  <tr>
                <!--  <td>16</td>
                  <td>AMOUNT REMITTED TO RAMNAD BRANCH</td>
                  <td><?php echo $ramnad_remitted_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                  <tr>
                  <td>17</td>
                  <td>AMOUNT REMITTED TO PMK BRANCH</td>
                  <td><?php echo $pmk_remitted_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                  <tr>
                  <td>18</td>
                  <td>AMOUNT REMITTED TO MUDHUVAI BRANCH</td>
                  <td><?php echo $mudhuvai_remitted_amt; ?></td>
                  <td>-</td>
                  
                  </tr>
                  
                  <tr>
                  <td>19</td>
                  <td>AMOUNT REMITTED TO MADURAI BRANCH</td>
                  <td><?php echo $madurai_remitted_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                  <tr>
                  <td>20</td>
                  <td>AMOUNT REMITTED TO HO</td>
                  <td><?php echo $ho_remitted_amt; ?></td>
                  <td>-</td>
                   <tr>-->
                       
                <td>9</td>
                <td>TOTAL INCOME</td>
                <td>-</td>
                 <td><?php echo $total_income; ?></td>
                </tr>
                  </tr>
  

                  <?php
                  $i=22;
                 
                  $income_type_list= select_data(INCOME_TYPE_MASTER,"ORDER BY income_type_id  ASC");
               
                  foreach($income_type_list as $itl)
                  { ?>


                  <tr>

             <!--     <td><?php echo $i;?></td>
                  <td><?php echo $itl['income_type_name']; ?></td>
                  <td>-</td>
                  <td><?php 
                   if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9){
                        $income_list = select_data(INCOME_MASTER,"where income_type_id='".$itl['income_type_id']."' and income_date='".$current_date."' ");
                        
                   }
                   else
                   {
                       $income_list = select_data(INCOME_MASTER,"where income_type_id='".$itl['income_type_id']."' and income_date='".$current_date."' and branch_id='$session_branch_id' ");
                       
                   }
                        $incomeamt = 0;
                        if(count($income_list)>0){
                          foreach($income_list as $il)
                          { 
                            $incomeamt = $incomeamt + $il['income_amount'];
                          }
                          echo $incomeamt;
                        }
                        else{
                          echo '0';
                        }
                  ?>
                  </td>
                
                 
                  </tr>-->

                 <?php $i++; }
                  ?>



                  <tr>
                  <td></td>
                  <td></td>
                  
                  <td><strong><?php echo $debit_total_amt; ?></strong></td>
                  <td><strong><?php echo $credit_total_amt; ?></strong></td>
                 
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
  
  $tallydate = date('Y-m-d', strtotime($_POST['tally_date']));
   $tallydate1 = date('Y-m-d', strtotime($_POST['tally_date']));

  if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
  {
    $daily_list = select_data(TALLY_MASTER,"where date='$tallydate'");

$pmk_remitted_amt = pmk_remitted($tallydate);
$ramnad_remitted_amt = ramnad_remitted($tallydate);
$mudhuvai_remitted_amt = mudhuvai_remitted($tallydate);
$madurai_remitted_amt = madurai_remitted($tallydate);
$ho_remitted_amt = ho_remitted($tallydate);

$pmk_received_amt = pmk_received($tallydate);
$ramnad_received_amt = ramnad_received($tallydate);
$mudhuvai_received_amt = mudhuvai_received($tallydate);
$madurai_received_amt = madurai_received($tallydate);
$ho_received_amt = ho_received($tallydate);
  }
  else{
$daily_list = select_data(TALLY_MASTER,"where date='$tallydate' and branch_id='$session_branch_id'");

$pmk_remitted_amt = pmk_remitted_branch($tallydate,$session_branch_id);
$ramnad_remitted_amt = ramnad_remitted_branch($tallydate,$session_branch_id);
$mudhuvai_remitted_amt = mudhuvai_remitted_branch($tallydate,$session_branch_id);
$madurai_remitted_amt = madurai_remitted_branch($tallydate,$session_branch_id);
$ho_remitted_amt = ho_remitted_branch($tallydate,$session_branch_id);

$pmk_received_amt = pmk_received_branch($tallydate,$session_branch_id);
$ramnad_received_amt = ramnad_received_branch($tallydate,$session_branch_id);
$mudhuvai_received_amt = mudhuvai_received_branch($tallydate,$session_branch_id);
$madurai_received_amt = madurai_received_branch($tallydate,$session_branch_id);
$ho_received_amt = ho_received_branch($tallydate,$session_branch_id);
  }
  
  // loan penalty ammount start
 if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
  {
      $date= date("Y-m-d");
     
    $renewal_list=select_data(LOAN_MASTER," where penalty_date='$tallydate1'");
  }
  else{
$close_tally_date1 = date('Y-m-d', strtotime($_POST['close_tally_date']));
    $renewal_list=select_data(LOAN_MASTER," where penalty_date='$tallydate1' and branch_id='$session_branch_id'");
  }

if(count($renewal_list)>0)
{
    $penalty_amt = 0;
    $i=1;
    foreach($renewal_list as $cl)
    {
      $penalty_amt = (int)$penalty_amt + (int)$cl['loan_penalty'];
    }
    
   
    // echo '10000';
}
else{
    $penalty_amt= 0;
}

// loan penalty ammount end
  
  if(count($daily_list )>0){
    foreach($daily_list as $daily_list)
    {
      
      if($daily_list['opening_balance'] == '')
      {
        $opening_bal =  $opening_bal;
      }
      else{
        $opening_bal += $daily_list['opening_balance'];
      }

      
      if($daily_list['member_amt'] == '')
      {
        $member_amt = $member_amt;
      }
      else{
        $member_amt += $daily_list['member_amt'];
      }
      
      if($daily_list['account_amt'] == '')
      {
        $account_amt = $account_amt;
      }
      else{
        $account_amt += $daily_list['account_amt'];
      }
      
      if($daily_list['savings_renewal_amt'] == '')
      {
        $savings_renewal_amt = $savings_renewal_amt;
      }
      else{
        $savings_renewal_amt += $daily_list['savings_renewal_amt'];
      }
      
      if($daily_list['loan_renewal_amt'] == '')
      {
        $loan_renewal_amt = $loan_renewal_amt;
      }
      else{
        $loan_renewal_amt += $daily_list['loan_renewal_amt'];
      }
      
      if($daily_list['loan_amt'] == '')
      {
        $loan_amt = $loan_amt;
      }
      else{
        $loan_amt += $daily_list['loan_amt'];
      }
      
      if($daily_list['maturity_amt'] == '')
      {
        $maturity_amt = $maturity_amt;
      }
      else{

        $maturity_amt += $daily_list['maturity_amt'];
      }
      
      if($daily_list['prematurity_amt'] == '')
      {
        $prematurity_amt = $prematurity_amt;
      }
      else{
        $prematurity_amt += $daily_list['prematurity_amt'];
      }
      
      if($daily_list['expense_amt'] == '')
      {
        $expense_amt = $expense_amt;
      }
      else{
        $expense_amt += $daily_list['expense_amt'];
      }

      if($daily_list['deduction_amt'] == '')
      {
        $deduction_amt = $deduction_amt;
      }
      else{
        $deduction_amt += $daily_list['deduction_amt'];
      }


      if($daily_list['income_amt'] == '')
      {
        $income_amt = $income_amt;
      }
      else{
        $income_amt += $daily_list['income_amt'];
      }

      

    } //foreach

    // $credit_total_amt =  $opening_bal + $member_amt + $account_amt + $savings_renewal_amt + $loan_renewal_amt;

    // $debit_total_amt = $loan_amt + $maturity_amt + $prematurity_amt + $expense_amt;

   


}

$total_income=$penalty_amt+$deduction_amt+$ramnad_received_amt+$pmk_received_amt+$ho_received_amt+$madurai_received_amt+$mudhuvai_received_amt+$income_amt;
$total_expense=$ho_remitted_amt+ $madurai_remitted_amt+$mudhuvai_remitted_amt+$pmk_remitted_amt+$ramnad_remitted_amt+$expense_amt;
$credit_total_amt = $opening_bal + $member_amt + $account_amt + $savings_renewal_amt + $loan_renewal_amt + $total_income;
$debit_total_amt = $loan_amt + $maturity_amt + $prematurity_amt + $total_expense;
$closing_balance = $credit_total_amt - $debit_total_amt;
  
  ?>


<div class="form-group row">
<label for="plan_term" class="col-sm-4 col-form-label">
    Date: &nbsp;&nbsp;&nbsp;<?php echo $_POST['tally_date'];  ?>  
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
                    <th>Debit</th>
                    <th>Credit</th>
                    
                  </tr>
                  </thead>
                  <tbody>

                  <tr>
                  <td>1</td>
                  <td>Member Creation</td>
                  <td>-</td>
                  <td><?php echo $member_amt; ?></td>
                  
                  </tr>

                  <tr>
                  <td>2</td>
                  <td>Account Creation</td>
                  <td>-</td>
                  <td><?php echo $account_amt; ?></td>
                  
                  </tr>

                  <tr>
                  <td>3</td>
                  <td>Savings Renewal</td>
                  <td>-</td>
                  <td><?php echo $savings_renewal_amt; ?></td>
                 
                  </tr>

                  <tr>
                  <td>4</td>
                  <td>Loan Renewal</td>
                  <td>-</td>
                  <td><?php echo $loan_renewal_amt; ?></td>
                 
                  </tr>
                  
                <!--  <tr>
                  <td>5</td>
                  <td>Loan penalty</td>
                  <td>-</td>
                  <td><?php echo $penalty_amt; ?></td>
                 
                  </tr>



                  <tr>
                  <td>6</td>
                  <td>Deduction Amount</td>
                  <td>-</td>
                  <td><?php echo $deduction_amt; ?></td>
                 
                  </tr>-->
                  
                  <tr>
                  <td>5</td>
                  <td>PreMaturity</td>
                  <td><?php echo $prematurity_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                
                
                  <tr>
                  <td>6</td>
                  <td>Loan</td>
                  <td><?php echo $loan_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                  <tr>
                  <td>7</td>
                  <td>Maturity</td>
                  <td><?php echo $maturity_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                 
                 <tr>
                 <td>8</td>
                 <td>Total Expense</td>
                 <td><?php echo $total_expense; ?></td>
                 <td>-</td>
                 </tr>


                <!--  <tr>
                  <td>11</td>
                  <td>AMOUNT RECEIVED FROM RAMNAD BRANCH</td>
                  <td>-</td>
                  <td><?php echo $ramnad_received_amt; ?></td>
                 
                 
                  </tr>

                  <tr>
                  <td>12</td>
                  <td>AMOUNT RECEIVED FROM PMK BRANCH</td>
                  <td>-</td>
                  <td><?php echo $pmk_received_amt; ?></td>
                  
                 
                  </tr>

                  <tr>

                  <td>13</td>
                  <td>AMOUNT RECEIVED FROM MUDHUVAI BRANCH</td>
                  <td>-</td>
                  <td><?php echo $mudhuvai_received_amt; ?></td>
                 
                 
                  </tr>
                  
                  <tr>

                  <td>14</td>
                  <td>AMOUNT RECEIVED FROM MADURAI BRANCH</td>
                  <td>-</td>
                  <td><?php echo $madurai_received_amt; ?></td>
                 
                 
                  </tr>



                  <tr>
                  <td>15</td>
                  <td>AMOUNT RECEIVED FROM HO</td>
                  <td>-</td>
                  <td><?php echo $ho_received_amt; ?></td>
                  
                  </tr>-->

                  <tr>
                <!--  <td>16</td>
                  <td>AMOUNT REMITTED TO RAMNAD BRANCH</td>
                  <td><?php echo $ramnad_remitted_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                  <tr>
                  <td>17</td>
                  <td>AMOUNT REMITTED TO PMK BRANCH</td>
                  <td><?php echo $pmk_remitted_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                  <tr>
                  <td>18</td>
                  <td>AMOUNT REMITTED TO MUDHUVAI BRANCH</td>
                  <td><?php echo $mudhuvai_remitted_amt; ?></td>
                  <td>-</td>
                  
                  </tr>
                  
                  <tr>
                  <td>19</td>
                  <td>AMOUNT REMITTED TO MADURAI BRANCH</td>
                  <td><?php echo $madurai_remitted_amt; ?></td>
                  <td>-</td>
                  
                  </tr>

                  <tr>
                  <td>20</td>
                  <td>AMOUNT REMITTED TO HO</td>
                  <td><?php echo $ho_remitted_amt; ?></td>
                  <td>-</td>
                   <tr>-->
                       
                <td>9</td>
                <td>TOTAL INCOME</td>
                <td>-</td>
                 <td><?php echo $total_income; ?></td>
                </tr>
                  </tr>
  

                  <?php
                  $i=22;
                 
                  $income_type_list= select_data(INCOME_TYPE_MASTER,"ORDER BY income_type_id  ASC");
               
                  foreach($income_type_list as $itl)
                  { ?>


                  <tr>

             <!--     <td><?php echo $i;?></td>
                  <td><?php echo $itl['income_type_name']; ?></td>
                  <td>-</td>
                  <td><?php 
                   if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9){
                        $income_list = select_data(INCOME_MASTER,"where income_type_id='".$itl['income_type_id']."' and income_date='".$current_date."' ");
                        
                   }
                   else
                   {
                       $income_list = select_data(INCOME_MASTER,"where income_type_id='".$itl['income_type_id']."' and income_date='".$current_date."' and branch_id='$session_branch_id' ");
                       
                   }
                        $incomeamt = 0;
                        if(count($income_list)>0){
                          foreach($income_list as $il)
                          { 
                            $incomeamt = $incomeamt + $il['income_amount'];
                          }
                          echo $incomeamt;
                        }
                        else{
                          echo '0';
                        }
                  ?>
                  </td>
                
                 
                  </tr>-->

                 <?php $i++; }
                  ?>



                  <tr>
                  <td></td>
                  <td></td>
                  
                  <td><strong><?php echo $debit_total_amt; ?></strong></td>
                  <td><strong><?php echo $credit_total_amt; ?></strong></td>
                 
                  </tr>

            
              
              </tbody></table>

              
</div>




<div class="form-group row">
<label for="plan_term" class="col-sm-4 col-form-label">
    Date: &nbsp;&nbsp;&nbsp;<?php echo $_POST['tally_date']; ?>  
</label>

<label for="plan_term" class="col-sm-4 col-form-label">
    Closing Balance: &nbsp;&nbsp;&nbsp;<?php echo $closing_balance; ?>  
</label>

</div>



  <?php
} ?>
          
        </div>
        <!-- /.card-body -->
        
<?php 
if($session_role_id != 1 && $session_role_id != 2 && $session_role_id != 9)
{ ?>

  <div class="card-body">
  <div class="form-group row">

    <label for="employee_name" class="col-sm-1 col-form-label">Date<span style="color:red">*</span></label>


    <div class="col-sm-3">
    <input type="text" name="close_tally_date" class="form-control" id="close_tally_date" placeholder="Select Date" value="<?php echo $close_tally_date; ?>" />
    </div>


    <button type="submit" class="btn-sm btn-success" name="submit" id="submit" >Submit</button>
    <input type="hidden" name="closing_bal_hidden" value="<?php echo $closing_balance; ?>" />
    <input type="hidden" name="selecteddate" value="<?php echo $tally_date; ?>" />
   
   
  </div>
  </div>

<?php } ?>

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


$( "#close_tally_date" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
});


});
  </script>
</body>
</html>
