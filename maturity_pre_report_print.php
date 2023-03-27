<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");


 $account_id = '';
 $customer_id='';
 $from_date = '';
 $to_date = '';
 $session_branch_id = $_SESSION['bid'];
 $session_role_id=$_SESSION['role_id'];
 $month_value='';
 if(isset($_GET['month']) && $_GET['month']!="" )
 {
    $month_value = $_GET['month'];

 }
//  if(isset($_POST['customer_id']) && $_POST['customer_id']!="" )
//  {
 
//    $customer_id=$_POST['customer_id'];
//    $account_id = $_POST['account_id'];
//    $from_date = $_POST['from_date'];
//    $to_date = $_POST['to_date'];

//    $customer_details=select_data(CUSTOMER_MASTER,"where customer_id='".$customer_id."'");
//    $customer_name = $customer_details[0]['customer_name'];
//    $customer_no = $customer_details[0]['customer_no'];
//  }


?>
<html>
<head>
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
   
  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
     
   </tr>
    
<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>


  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Maturity Pre Report</h1>
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
    
<label for="from_date" class="col-sm-2 col-form-label">Select Month : <?php echo $month_value; ?><span style="color:red"></span></label>
<div class="col-sm-3">

</div>




<div class="col-sm-3">

</div>


</div>


<?php if(isset($_GET['month']) && $_GET['month']!="" )
{
  // print_r($_POST);

  $month_value = $_GET['month'];


  $selected_from_date = '01-'.$month_value;
  $selected_to_date = '31-'.$month_value;

  $from_date = date('Y-m-d', strtotime($selected_from_date));
  $to_date = date('Y-m-d', strtotime($selected_to_date));


  $customer_ids_to_show=array();


  $account_details=select_data(ACCOUNT_MASTER,"where status=1 ORDER BY account_id DESC");

foreach($account_details as $ad)
{
$creationdate = $ad['date'];
$date = date("d-m-Y", strtotime($creationdate));

$planlist=select_data(PLAN_MASTER," where plan_id='".$ad['plan_id']."'");
$plan_code = $planlist[0]['plan_code'];
$plan_term = $planlist[0]['plan_term'];
$plan_term_value=$planlist[0]['plan_term_value'];

if($plan_term == "1" && $plan_term_value == 'Y')
{
$maturity_date=date('d-m-Y', strtotime('+1 year', strtotime($creationdate)) );
$m_date = date('Y-m-d', strtotime('+1 year', strtotime($creationdate)) );
}
else if($plan_term == "100" && $plan_term_value == 'D')
{
$maturity_date=date('d-m-Y', strtotime('+100 days', strtotime($creationdate)) );
$m_date = date('Y-m-d', strtotime('+100 days', strtotime($creationdate)) );

}
else if($plan_term == "180" && $plan_term_value == 'D')
{
$maturity_date=date('d-m-Y', strtotime('+180 days', strtotime($creationdate)) );
$m_date = date('Y-m-d', strtotime('+180 days', strtotime($creationdate)) );
}
else if($plan_term == "2" && $plan_term_value == 'Y')
{
  $maturity_date=date('d-m-Y', strtotime('+2 year', strtotime($creationdate)) );
  $m_date = date('Y-m-d', strtotime('+2 year', strtotime($creationdate)) );
}
else if($plan_term == "10" && $plan_term_value == 'Y')
{
  $maturity_date=date('d-m-Y', strtotime('+10 year', strtotime($creationdate)) );
  $m_date = date('Y-m-d', strtotime('+10 year', strtotime($creationdate)) );
}
$accno = $ad['account_no'];
$accamt = $ad['amount'];


$plantypelist=select_data(PLAN_TYPE_MASTER," where plan_type_id='".$ad['plan_type_id']."'");
$plan_type_name = $plantypelist[0]['plan_type_name'];


if($m_date <= $to_date && $m_date >= $from_date)
{
   
  array_push($customer_ids_to_show,$ad['account_id']);

}

}
//foreach


$account_ids = implode("','", $customer_ids_to_show);
  


  
  ?>


       
        

        <table id="" class="table table-bordered table-striped"style="width:100%">
                
                  <thead>
                  <tr>
                  <th>S No</th>
                    <th>Member Name</th>
                    <th>Account No.</th>
                    <th>Member No.</th>
                    <!-- <th>Plan Type</th> -->
                    <th>Scheme Code</th>
                    <th>Total Amount</th>
                    <th>Account Open Date</th>
                    <th>Account Close Date</th>
                   
                  </tr>
                  </thead>
                  
                  
                  <tbody>

     
<?php 

if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
  $account_details=select_data(ACCOUNT_MASTER,"where account_id in ('$account_ids') ORDER BY account_id DESC");
}
else{

  $account_details=select_data(ACCOUNT_MASTER,"where account_id in ('$account_ids') and branch_id='".$session_branch_id."' ORDER BY account_id DESC");
}

              $i=1;
              foreach($account_details as $ad)
              {
                $creationdate = $ad['date'];
                $date = date("d-m-Y", strtotime($creationdate));
                $acd = date("d-m-Y", strtotime($ad['account_close_date']));
                $planlist=select_data(PLAN_MASTER," where plan_id='".$ad['plan_id']."'");
                $plan_code = $planlist[0]['plan_code'];
                $plan_term = $planlist[0]['plan_term'];
                $plan_term_value=$planlist[0]['plan_term_value'];

                if($plan_term == "1" && $plan_term_value == 'Y')
                {
                  $maturity_date=date('d-m-Y', strtotime('+1 year', strtotime($creationdate)) );
                }
                else if($plan_term == "100" && $plan_term_value == 'D')
                {
                  $maturity_date=date('d-m-Y', strtotime('+100 days', strtotime($creationdate)) );
                  
                }
                else if($plan_term == "180" && $plan_term_value == 'D')
                {
                  $maturity_date=date('d-m-Y', strtotime('+180 days', strtotime($creationdate)) );
                }
                else if($plan_term == "2" && $plan_term_value == 'Y')
                {
                  $maturity_date=date('d-m-Y', strtotime('+2 year', strtotime($creationdate)) );
                  
                }
                else if($plan_term == "10" && $plan_term_value == 'Y')
                {
                  $maturity_date=date('d-m-Y', strtotime('+10 year', strtotime($creationdate)) );
                 
                }

                
                $accno = $ad['account_no'];
                $accamt = $ad['amount'];
                $maturity_amount = $ad['maturity_amt'];
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ad['customer_id']."'");
              
                $plantypelist=select_data(PLAN_TYPE_MASTER," where plan_type_id='".$ad['plan_type_id']."'");
                $plan_type_name = $plantypelist[0]['plan_type_name'];

                $total_amt = 0;
                $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='".$ad['account_id']."'");
                if(count($acct_details) > 0)
                { 
                  
                  foreach($acct_details as $ad)
                  {

                      $total_amt =$total_amt+$ad['renewal_amt'];

                  }
                }


              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $customerlist[0]['customer_name']; ?></td>
                  <td><?php echo  $accno; ?></td>
                  <td><?php echo  $customerlist[0]['customer_no']; ?></td>
                  
                  <td><?php echo  $plan_code.'-'.$accamt; ?></td>
                  <td><?php echo  $total_amt; ?></td>
                  <td><?php echo  $date; ?></td>
                  <td><?php echo  $maturity_date; ?></td>

                  
              </tr>
             <?php  $i++; } ?>
                  </tbody>
                 
                </table>

 <?php } ?>
         
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







 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>


<link rel="stylesheet" href="dist/css/jquery-ui.css">

<script>


$(function() {
 $( "#month_value" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat: 'mm-yy',
yearRange : '1920:c+100',

});


});
</script>
</body>
</html>
