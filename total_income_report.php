<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");
  $employee_id='';
 $session_branch_id = $_SESSION['bid'];
 $session_role_id=$_SESSION['role_id'];
  if(isset($_POST['branch_id']))
{
  $branch_id = $_POST['branch_id'];
}
else
{
  $branch_id = "";
}

  if(isset($_POST['expence_id']))
{
 $expense_lists = $_POST['expence_id'];
 
}
else
{
  $expense_lists = "";
}
if(isset($_POST['from_date']))
{
  $from_date = $_POST['from_date'];
}
else
{
  $from_date = "";
}if(isset($_POST['to_date']))
{
  $to_date = $_POST['to_date'];
}
else
{
  $to_date = "";
}


 $session_role_id=$_SESSION['role_id'];
 $session_branch_id = $_SESSION['bid'];


 if(!isset($_POST['tally_date'])) {
$tally_date=date("d-m-Y");
$close_tally_date=date("d-m-Y");
 }
 else
 {
   $tally_date = $_POST['tally_date'];
   if($session_role_id ==1)
   {
    $close_tally_date = '';
   }
   else
   {
    $close_tally_date = $_POST['close_tally_date'];
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
            <h1>Income Report</h1>
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
        <h3 class="card-title">Income Report</h3>

  <!-- <a class="btn-sm btn-success float-right" href="account_tally_print.php" onclick="window.print()">Print</a> -->
<a class="btn-sm btn-success float-right" href="total_income_report_print.php?branch_id=<?php echo $branch_id;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date;?>" target="_blank">Print</a>

      </div>
      <form method="POST" action="" id="form1" name="form1">
               <div class="form-group row">
  <label for="from_date" class="col-sm-1 col-form-label">From Date<span style="color:red">*</span></label>
     <div class="col-sm-3">
  <input type="text" name="from_date" class="form-control" id="from_date" placeholder="Select From Date" value="<?php echo $from_date; ?>" />
 </div>



<label for="to_date" class="col-sm-1 col-form-label">To Date<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="to_date" class="form-control" id="to_date" placeholder="Select To Date" value="<?php echo $to_date; ?>">
</div>
</div>
<div class="card-body">
<div class="form-group row">
        <?php
 if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{?>
      <label for="employee_name" class="col-1 col-form-label">Branch Name<span style="color:red">*</span></label>
            <div class="col-sm-3">
            <select name="branch_id" class="form-control" id="branch_id">
              <option value="">Select Branch Name</option>
              <?php
              $branch_list=select_data(BRANCH_MASTER," ORDER BY branch_id ASC");
              foreach($branch_list as $bl)
              {
              ?>
                <option value="<?php echo $bl['branch_id'];?>" <?php if( $branch_id == $bl['branch_id']){ echo 'selected'; } ?>><?php echo $bl['branch_name'];?></option>
                <?php }?>
              </select>
            </div>
        </div>

     <?php }?>
      <div class="col-sm-3">
      <button type="submit" class="btn-sm btn-success" id="submit">Submit</button>
      </div>
      </div>
</form>
 <?php
if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
if(($from_date!='') && ($to_date!='') && ($branch_id!=''))
{
 $from_date = date('Y-m-d', strtotime($_POST['from_date']));
 $to_date = date('Y-m-d', strtotime($_POST['to_date']));
  //echo $from_date;
 // echo $to_date;
 $renewal_list=select_data(LOAN_MASTER,"where branch_id='". $_POST['branch_id']."' and penalty_date >= '".$from_date."' and   penalty_date <= '".$to_date."'  ORDER BY penalty_date asc");
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
$book_fee=select_data(INCOME_MASTER,"where  income_type_id=1 and branch_id='". $_POST['branch_id']."' and income_date >= '".$from_date."' and   income_date <= '".$to_date."'  ORDER BY income_date  asc");
if(count($book_fee)>0)
{
    $book_fee_amt = 0;
    $i=1;
    foreach($book_fee as $bl)
    {
      $book_fee_amt = (int)$book_fee_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
    $book_fee_amt= 0;
}  
$document_charge=select_data(INCOME_MASTER,"where income_type_id=2 and branch_id='". ($_POST['branch_id'])."' and income_date >= '".$from_date."' and   income_date <= '".$to_date."'  ORDER BY income_date  asc");
if(count($document_charge)>0)
{
    $document_amt = 0;
    $i=1;
    foreach($document_charge as $bl)
    {
      $document_amt = (int)$document_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
     $document_amt= 0;
}  
$deduction_amount=select_data(TALLY_MASTER,"where branch_id='". ($_POST['branch_id'])."' and date >= '".$from_date."' and   date <='".$to_date."'  ORDER BY date  asc"); 
if(count($deduction_amount)>0)
{
    $deduction_amt = 0;
    $i=1;
    foreach($deduction_amount as $da)
    {
      $deduction_amt = (int)$deduction_amt + (int)$da['deduction_amt'];
    }
 
}
else{
    $deduction_amt= 0;
}
$interest_amount=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$branch_id."') and renewal_date>= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
if(count($interest_amount)>0)
{
    $interest_amt = 0;
    $i=1;
    foreach($interest_amount as $da)
    {
      $interest_amt = (int)$interest_amt + (int)$da['interest'];
    }
 
}
else{
    $interest_amt= 0;
}  
}
elseif(($from_date!='') && ($to_date!='')) 
{
  $from_date = date('Y-m-d', strtotime($_POST['from_date']));
  $to_date = date('Y-m-d', strtotime($_POST['to_date']));
  //echo $from_date;
    //echo $to_date;
 $renewal_list=select_data(LOAN_MASTER," where  penalty_date >= '".$from_date."' and   penalty_date <= '".$to_date."'  ORDER BY penalty_date asc");
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
$book_fee=select_data(INCOME_MASTER," where income_type_id=1 and income_date >= '".$from_date."' and   income_date <= '".$to_date."'  ORDER BY income_date asc");
if(count($book_fee)>0)
{
    $book_fee_amt = 0;
    $i=1;
    foreach($book_fee as $bl)
    {
      $book_fee_amt = (int)$book_fee_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
    $book_fee_amt= 0;
}  
$document_charge=select_data(INCOME_MASTER," where income_type_id=2 and income_date >= '".  $from_date."' and   income_date <= '".$to_date."'  ORDER BY income_date asc");
if(count($document_charge)>0)
{
    $document_amt = 0;
    $i=1;
    foreach($document_charge as $bl)
    {
      $document_amt = (int)$document_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
    $document_amt= 0;
}  

$deduction_amount=select_data(TALLY_MASTER," where date >= '".$from_date."' and  date <= '".$to_date."'  ORDER BY date asc");
if(count($deduction_amount)>0)
{
    $deduction_amt = 0;
    $i=1;
    foreach($deduction_amount as $da)
    {
      $deduction_amt = (int)$deduction_amt + (int)$da['deduction_amt'];
    }
 
}
else{
    $deduction_amt= 0;
}  
$interest_amount=select_data(SAVINGS_RENEWAL,"where renewal_date  >= '".$from_date."' and   renewal_date  <='".$to_date."'  ORDER BY renewal_date  asc"); 
if(count($interest_amount)>0)
{
    $interest_amt = 0;
    $i=1;
    foreach($interest_amount as $da)
    {
      $interest_amt = (int)$interest_amt + (int)$da['interest'];
    }
 
}
else{
    $interest_amt= 0;
}  
}elseif(($branch_id!=''))
{
 $renewal_list=select_data(LOAN_MASTER,"where branch_id='".$_POST['branch_id'] ." 'ORDER BY penalty_date ASC");
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
$book_fee=select_data(INCOME_MASTER,"where income_type_id=1 and  branch_id='". $_POST['branch_id'] ."'ORDER BY income_date ASC");
if(count($book_fee)>0)
{
    $book_fee_amt = 0;
    $i=1;
    foreach($book_fee as $bl)
    {
      $book_fee_amt = (int)$book_fee_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
    $book_fee_amt= 0;
}  
$document_charge=select_data(INCOME_MASTER,"where income_type_id=2 and  branch_id='".$_POST['branch_id']."'ORDER BY income_date ASC");
if(count($document_charge)>0)
{
    $document_amt = 0;
    $i=1;
    foreach($document_charge as $bl)
    {
      $document_amt = (int)$document_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
    $document_amt= 0;
}  
$deduction_amount=select_data(TALLY_MASTER,"where branch_id='".$_POST['branch_id']."'ORDER BY date ASC");
if(count($deduction_amount)>0)
{
    $deduction_amt = 0;
    $i=1;
    foreach($deduction_amount as $da)
    {
      $deduction_amt = (int)$deduction_amt + (int)$da['deduction_amt'];
    }
 
}
else{
    $deduction_amt= 0;
}  
$interest_amount=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$branch_id."') order by renewal_date asc");
if(count($interest_amount)>0)
{
    $interest_amt = 0;
    $i=1;
    foreach($interest_amount as $da)
    {
      $interest_amt = (int)$interest_amt + (int)$da['interest'];
    }
 
}
else{
    $interest_amt= 0;
}  
}
else{
    $renewal_list=select_data(LOAN_MASTER,"");
    
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
    $book_fee=select_data(INCOME_MASTER," where income_type_id=1 ORDER BY income_date asc");
   
if(count($book_fee)>0)
{
    $book_fee_amt = 0;
    $i=1;
    foreach($book_fee as $bl)
    {
      $book_fee_amt = (int)$book_fee_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
    $book_fee_amt= 0;
}  
    $document_charge=select_data(INCOME_MASTER," where income_type_id=2 ORDER BY income_date asc");
  
if(count($document_charge)>0)
{
    $document_amt = 0;
    $i=1;
    foreach($document_charge as $bl)
    {
      $document_amt = (int)$document_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
    $document_amt= 0;
}  
    $deduction_amount=select_data(TALLY_MASTER);
  if(count($deduction_amount)>0)
{
    $deduction_amt = 0;
    $i=1;
    foreach($deduction_amount as $da)
    {
      $deduction_amt = (int)$deduction_amt + (int)$da['deduction_amt'];
    }
 
}
else{
    $deduction_amt= 0;
}  
$interest_amount=select_data(SAVINGS_RENEWAL); 
if(count($interest_amount)>0)
{
    $interest_amt = 0;
    $i=1;
    foreach($interest_amount as $da)
    {
      $interest_amt = (int)$interest_amt + (int)$da['interest'];
    }
 
}
else{
    $interest_amt= 0;
}  
}
}
else{

 if(($from_date!='') && ($to_date!='')) 
{
  $from_date = date('Y-m-d', strtotime($_POST['from_date']));
  $to_date = date('Y-m-d', strtotime($_POST['to_date']));
  //echo $from_date;
    //echo $to_date;
 $renewal_list=select_data(LOAN_MASTER," where  branch_id='".$session_branch_id."' and penalty_date >= '".  $from_date."' and   penalty_date <= '".$to_date."'  ORDER BY penalty_date asc");
   $renewal_list=select_data(LOAN_MASTER," where  penalty_date >= '".$from_date."' and   penalty_date <= '".$to_date."'  ORDER BY penalty_date asc");
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
  $penalty_amt= 0;
} 
$interest_amount=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$session_branch_id."') and renewal_date>= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
if(count($interest_amount)>0)
{
    $interest_amt = 0;
    $i=1;
    foreach($interest_amount as $da)
    {
      $interest_amt = (int)$interest_amt + (int)$da['interest'];
    }
 
}
else{
    $interest_amt= 0;
}  
    
   
    // echo '10000';

  $document_charge=select_data(INCOME_MASTER," where income_type_id=2 and branch_id='".$session_branch_id."' and income_date >= '".  $from_date."' and   income_date <= '".$to_date."'  ORDER BY income_date asc");
  if(count($document_charge)>0)
{
    $document_amt = 0;
    $i=1;
    foreach($document_charge as $bl)
    {
      $document_amt = (int)$document_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
  $document_amt= 0;
} 
  $deduction_amount=select_data(TALLY_MASTER," where branch_id='".$session_branch_id."'and date >= '".  $from_date."' and  date <= '".$to_date."'  ORDER BY date asc");
  if(count($deduction_amount)>0)
{
    $deduction_amt = 0;
    $i=1;
    foreach($deduction_amount as $da)
    {
      $deduction_amt = (int)$deduction_amt + (int)$da['deduction_amt'];
    }
 
}
else{
    $deduction_amt= 0;
}
  $book_fee=select_data(INCOME_MASTER," where income_type_id=1 and branch_id='".$session_branch_id."' and income_date >= '".  $from_date."' and   income_date <= '".$to_date."'  ORDER BY income_date asc");
  if(count($book_fee)>0)
{
    $book_fee_amt = 0;
    $i=1;
    foreach($book_fee as $bl)
    {
      $book_fee_amt = (int)$book_fee_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
    $book_fee_amt= 0;
}  
}else{
    $renewal_list=select_data(LOAN_MASTER," where  branch_id='".$session_branch_id."'");
    
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
    $book_fee=select_data(INCOME_MASTER," where income_type_id=1 and branch_id='".$session_branch_id."' ORDER BY income_date asc");
   
if(count($book_fee)>0)
{
    $book_fee_amt = 0;
    $i=1;
    foreach($book_fee as $bl)
    {
      $book_fee_amt = (int)$book_fee_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
    $book_fee_amt= 0;
}  
    $document_charge=select_data(INCOME_MASTER," where branch_id='".$session_branch_id."'and income_type_id=2 ORDER BY income_date asc");
  
if(count($document_charge)>0)
{
    $document_amt = 0;
    $i=1;
    foreach($document_charge as $bl)
    {
      $document_amt = (int)$document_amt + (int)$bl['income_amount'];
    }
    
   
    // echo '10000';
}
else{
   $document_amt= 0;
}  
    $deduction_amount=select_data(TALLY_MASTER," where  branch_id='".$session_branch_id."'");
  if(count($deduction_amount)>0)
{
    $deduction_amt = 0;
    $i=1;
    foreach($deduction_amount as $da)
    {
      $deduction_amt = (int)$deduction_amt + (int)$da['deduction_amt'];
    }
 
}
else{
    $deduction_amt= 0;
}  
   $interest_amount=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$session_branch_id."')  order by renewal_date asc");
  if(count($interest_amount)>0)
{
    $interest_amt = 0;
    $i=1;
    foreach($interest_amount as $da)
    {
      $interest_amt = (int)$interest_amt + (int)$da['interest'];
    }
 
}
else{
    $interest_amt= 0;
}
}
}

  
//   penalty amt start




$total_amt = $document_amt + $penalty_amt + $book_fee_amt + $deduction_amt+$interest_amt;
?>
<div class="form-group row">
            <label for="plan_term" class="col-sm-4 col-form-label">
                Total Ammount: &nbsp;&nbsp;&nbsp;<?php echo $total_amt; ?>  
            </label>
</div>
<table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S. No</th>
                    <th>Category</th>
                    <th>Debit</th>
                    <!--<th>Credit</th>-->
                    
                  </tr>
                  </thead>
                  <tbody>

                  <tr>
                  <td>1</td>
                  <td>Document Charges</td>
                  <td><?php echo $document_amt; ?></td>
                  
                  </tr>

                  <tr>
                  <td>2</td>
                  <td>Penalty Charges</td>
                  <td><?php echo $penalty_amt; ?></td>
                  
                  </tr>

                  <tr>
                  <td>3</td>
                  <td>Book Fee</td>
                  <td><?php echo $book_fee_amt; ?></td>
                 
                  </tr>

                  <tr>
                  <td>4</td>
                  <td>Deduction Amount</td>
                  <td><?php echo $deduction_amt; ?></td>
                 
                  </tr>
       <tr>
                  <td>5</td>
                  <td>Interest Amount</td>
                  <td><?php echo $interest_amt; ?></td>
                 
                 
                  </tr>
                  <!--<tr>-->
                  <!--<td>5</td>-->
                  <!--<td>Interest Received Amount</td>-->
                  <!--<td></td>-->
                 
                  <!--</tr>-->

                  
              
           
   
   
 </tbody>
                  
        </table>
        </div>
        <!-- /.card-body -->
              
       

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
  <script>


$(function() {
 $( "#from_date" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
});


$( "#to_date" ).datepicker({
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
