<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

$userid= $_SESSION['emp_id'];
$session_branch_id = $_SESSION['bid'];
$session_role_id=$_SESSION['role_id'];

 if(!isset($_GET['tally_date'])) {
$tally_date=date("d-m-Y");
$tally_date1=date("Y-m-d");
$close_tally_date=date("d-m-Y");
$close_tally_date1=date("Y-m-d");
 }
 else
 {
   $tally_date = $_GET['tally_date'];
   $tally_date1 = date('Y-m-d', strtotime($_GET['tally_date']));
   if($session_role_id ==1)
   {
    $close_tally_date = '';
    $close_tally_date1 = '';
    
   }
   else
   {
     $close_tally_date = $_GET['close_tally_date'];
    $close_tally_date1 = date('Y-m-d', strtotime($_GET['close_tally_date']));
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





?>

<title></title>
    <meta charset="utf-8" />
    <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js"> </script>
    <script language="javascript" type="text/javascript">
         
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML =
                "<html><head><title></title></head><body>" +
                divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;


        }
    </script>
    <style type="text/css">
       #header {
  display: table-header-group;
}

#main {
  display: table-row-group;
}

#footer {
  display: table-footer-group;
      bottom: 0px
}


table {
	border-collapse: collapse;
}

table {
	border: 1px solid black;
}

tr {
	border: 1px solid black;
}

td {
    border: 1px solid black;
    padding-left: 5px;
    padding:10px;
    text-align:center;
    /* font-family: Times New Roman !important; */
}

tr:nth-child(odd) { 
            background-color:white; 
        } 


@media print {
  #but {
    display: none;
  }


  tr:nth-child(odd) { 
            background-color:white; 
        } 

}


.watermark { opacity: 0.2;
  position: fixed;
  left: 0;
  top: 130px;
  width: 100%;
  height: auto; }
.watermark::after { position: absolute; bottom: 0; right: 0; content: "COPYRIGHT"; }
    </style>

</head>
<body>
<input type="button" value="Print Page" id="but" onclick="javascript:printDiv('printablediv')" /> 
    <script>
        function myFunction() {
            window.print();
        }

    </script>



   
    
      
   

    <div id="printablediv">



    <img class="watermark" src="images/ADN1.png"/>

    <table style="table-layout:fixed;width:100%;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;">
            <colgroup>
                <col style="width:10%;">
                <col style="width:40%;">
                <col style="width:30%;">
                <col style="width:30%;">
            </colgroup>
            
    <thead>
              
			
		<tr>
			
			<td  colspan="4" width="25%" style="border-bottom: 1px solid black; text-align:center;background-color:white;">
			<span style="color:#000000;  font-size:13px"><img src="images/ADN.png" width="80" height="80"></span>
			<h1 style="font-size:18px;font-weight:800;">AMUDHINI MULTIPURPOSE KOOTURAVU SANGAM NIDHI LIMITED</h1>
      <h2 style="font-size:14px;font-weight:800;">Reg. No. CIN U65990TN2021PLN141344</h2>
<h5>Regd.Office:1/163,P.S.S.Nivas Building First Floor, Keelapallivasal Street, Paramakudi - 623707.</h5>
      </td>
			
		
		</tr>


        </thead>
        
   
   <td colspan="4">

   <div style="text-align: left;">
   
 <!--  <b> Branch Name:
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
     
   </tr>
    
</style>
<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible" style="margin:0 0 0 230px;width:100% !important"><?php echo  $info;?></div>

<?php } ?>


  <!-- Content Wrapper. Contains page content -->
<div class="">
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
        
  <!-- <a class="btn-sm btn-success float-right" href="account_tally_print.php" onclick="window.print()">Print</a> -->
      </div>
      <!-- <form class="form-horizontal"> -->

  
        

    
        
           <!-- card-body -->
       

<?php if(!isset($_GET['tally_date'])) { 
  
  
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

                <table class="table table-bordered table-striped"style="width:100%">
                
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
  
  $tallydate = date('Y-m-d', strtotime($_GET['tally_date']));
   $tallydate1 = date('Y-m-d', strtotime($_GET['tally_date']));

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
$close_tally_date1 = date('Y-m-d', strtotime($_GET['close_tally_date']));
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
    Date: &nbsp;&nbsp;&nbsp;<?php echo $_GET['tally_date'];  ?>  
</label>

<label for="plan_term" class="col-sm-4 col-form-label">
    Opening Balance: &nbsp;&nbsp;&nbsp;<?php echo $opening_bal; ?>  
</label>

</div>

<div class="form-group row">

        <table class="table table-bordered table-striped" style="width:100%">
                
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
        
<?php 
if($session_role_id != 1 && $session_role_id != 2 && $session_role_id != 9)
{ ?>



<?php } ?>


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
