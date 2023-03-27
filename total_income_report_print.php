<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");



 $employee_id='';
 $session_branch_id = $_SESSION['bid'];
 $session_role_id=$_SESSION['role_id'];
  if(isset($_GET['branch_id']))
{
  $branch_id = $_GET['branch_id'];
}
else
{
  $branch_id = "";
}

  if(isset($_GET['expence_id']))
{
 $expense_lists = $_GET['expence_id'];
 
}
else
{
  $expense_lists = "";
}
if(isset($_GET['from_date']))
{
  $from_date = $_GET['from_date'];
}
else
{
  $from_date = "";
}if(isset($_GET['to_date']))
{
  $to_date = $_GET['to_date'];
}
else
{
  $to_date = "";
}


 $session_role_id=$_SESSION['role_id'];
 $session_branch_id = $_SESSION['bid'];


 if(!isset($_GET['tally_date'])) {
$tally_date=date("d-m-Y");
$close_tally_date=date("d-m-Y");
 }
 else
 {
   $tally_date = $_GET['tally_date'];
   if($session_role_id ==1)
   {
    $close_tally_date = '';
   }
   else
   {
    $close_tally_date = $_GET['close_tally_date'];
   }
   
 }
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

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>


  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Savings Renewal Report</h1>
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
       
          </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

  <form method="POST" action="" id="form1" name="form1" autocomplete="off">
        <div class="card-body">


<div class="form-group row">
    <b>
<label for="from_date" class="col-4 col-form-label">From Date :<?php echo $from_date; ?><span style="color:red"></span></label>



<label for="to_date" class="col-4 col-form-label">To Date :<?php echo $to_date; ?><span style="color:red"></span></label>





</div>



   
 
   
 <?php
if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
if(($from_date!='') && ($to_date!='') && ($branch_id!=''))
{
 $from_date = date('Y-m-d', strtotime($_GET['from_date']));
 $to_date = date('Y-m-d', strtotime($_GET['to_date']));
  //echo $from_date;
 // echo $to_date;
 $renewal_list=select_data(LOAN_MASTER,"where branch_id='". $_GET['branch_id']."' and penalty_date >= '".$from_date."' and   penalty_date <= '".$to_date."'  ORDER BY penalty_date asc");
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
$book_fee=select_data(INCOME_MASTER,"where  income_type_id=1 and branch_id='". $_GET['branch_id']."' and income_date >= '".$from_date."' and   income_date <= '".$to_date."'  ORDER BY income_date  asc");
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
$document_charge=select_data(INCOME_MASTER,"where income_type_id=2 and branch_id='". ($_GET['branch_id'])."' and income_date >= '".$from_date."' and   income_date <= '".$to_date."'  ORDER BY income_date  asc");
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
$deduction_amount=select_data(TALLY_MASTER,"where branch_id='". ($_GET['branch_id'])."' and date >= '".$from_date."' and   date <='".$to_date."'  ORDER BY date  asc"); 
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
  $from_date = date('Y-m-d', strtotime($_GET['from_date']));
  $to_date = date('Y-m-d', strtotime($_GET['to_date']));
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
 $renewal_list=select_data(LOAN_MASTER,"where branch_id='".$_GET['branch_id'] ." 'ORDER BY penalty_date ASC");
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
$book_fee=select_data(INCOME_MASTER,"where income_type_id=1 and  branch_id='". $_GET['branch_id'] ."'ORDER BY income_date ASC");
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
$document_charge=select_data(INCOME_MASTER,"where income_type_id=2 and  branch_id='".$_GET['branch_id']."'ORDER BY income_date ASC");
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
$deduction_amount=select_data(TALLY_MASTER,"where branch_id='".$_GET['branch_id']."'ORDER BY date ASC");
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
  $from_date = date('Y-m-d', strtotime($_GET['from_date']));
  $to_date = date('Y-m-d', strtotime($_GET['to_date']));
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
<table id="" class="table table-bordered table-striped"style=width:100%>
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
$(document.body).on('change','#customer_id',function(){
  // alert('hi');
  var customer_id = $('#customer_id').val();

    var dataString = "savings_customer_id="+customer_id;
      $.ajax({ 
      type: "GET", 
      url: "ajax_data.php", 
      data: dataString, 
        
      success:  function(data){ 
        $("#account_id").html(data);
      } 
    });
});

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
