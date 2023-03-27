<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");


$userid= $_SESSION['emp_id'];
$session_role_id=$_SESSION['role_id'];
$session_branch_id = $_SESSION['bid'];

if(isset($_GET['account_id']) && $_GET['account_id']!="" )
{

  $account_id=$_GET['account_id'];
  

  if(isset($_POST['savings_renewal_amt']))
{
 $savings_renewal_amt = $_POST['savings_renewal_amt'];
 
}
  $account_details=select_data(ACCOUNT_MASTER,"where account_id='".$account_id."'");
  $account_no = $account_details[0]['account_no'];
  $customer_id = $account_details[0]['customer_id'];
  $plan_id=$account_details[0]['plan_id'];
  $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$account_details[0]['customer_id']."'");
  $customer_no = $customerlist[0]['customer_no']; 
  $customer_name = $customerlist[0]['customer_name'];
  $total_amt=0;
  $int_amt=0;
  
      $ecct_details = select_data(PLAN_MASTER,"where plan_id='$plan_id' ");
      if(count($ecct_details) > 0){
      $plan_intt1=$ecct_details[0]['plan_interest'];
      $plan_intt2=$ecct_details[0]['plan_spl_interest'];
      $plan_term_value=$ecct_details[0]['plan_term_value'];
      $plan_id=$ecct_details[0]['plan_type_id'];
      $plan_term=$ecct_details[0]['plan_term'];
      $plan_code=$ecct_details[0]['plan_code'];
}

  $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='$account_id'");
  $interest = $acct_details[0]['interest'];
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {
         $total_amt =$total_amt+$ad['renewal_amt'];
    }
  }
  
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

if($ad['interest']!=''){
         $total_int =$int_amt+$ad['interest'];
}
else{
    $total_int=0;
}
    }
  }

  $acct_status = $account_details[0]['status'];
$int_tot=$total_int+$total_amt ;
if ($plan_term=='10' && $plan_term_value =='Y'&& $paln_code='TM') {
   $int_tot=$int_tot*2;
}
}

?>
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
    text-align:center;
    /*padding:2px;*/
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
        
    <tr style="height:100px;">
   <td colspan="4">

   <div style="text-align: left;">
   
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
            
            <label for="plan_term" class="col-sm-4 col-form-label">
                Total Amount Returns: &nbsp;&nbsp;&nbsp;<?php echo "Rs. ".$int_tot; ?>  
            </label>
            
            
            <label for="plan_term" class="col-sm-4 col-form-label">
                Total Interest: &nbsp;&nbsp;&nbsp;<?php echo "Rs. ".$total_int; ?>  
            </label>
           

          </div>
   </tr>

<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>

<div class="alert alert-success alert-dismissible" id="successToShow" style="margin-left:248px;display:none;">Added Successfully</div>


  <!-- Content Wrapper. Contains page content -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
           
    <!-- Horizontal Form -->
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Savings Renewal List</h3>
 
       
   

<?php if($session_role_id != 1 && $session_role_id != 2) {

if($acct_status !=3 ){?>


        <a class="btn-sm btn-success float-right" data-toggle="modal" data-target="#feedback-modal" data-backdrop="static" data-keyboard="false" style="margin-right:34px;color:white;">

                  Add Renewal Amount
        </a>



        <!-- large modal -->
        <div class="modal fade" id="feedback-modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
         
            <div class="modal-body">

            <div class="card-body">
            <form method="post" action="" id="form2" name="form2">
      

        <input type="hidden" name="get_acct_id" id="get_acct_id" value="<?php echo $_GET['account_id']; ?>">

        
        <input type="hidden" name="get_cust_id" id="get_cust_id" value="<?php echo $customer_id; ?>">

        <input type="hidden" name="get_user_id" id="get_user_id" value="<?php echo $userid; ?>">
        
        <input type="hidden" name="get_branch_id" id="get_branch_id" value="<?php echo $session_branch_id; ?>">

       
        <span id="errorToShow" style="color:red;"></span>
       

            </form>
</div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<?php } 

}
?>

      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">
        <div class="card-body">


  

 <div class="form-group row">
 <?php 
              $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='$account_id' order by renewal_date desc");
    if(count($acct_details) > 0)
    { ?>
        
                <table id="" class="table table-bordered table-striped" style="width:100% ">
                
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

        //   $("#feedback-modal").modal('hide'); 
        //   $("#successToShow").show();
        //   location.reload();
        window.location.href="view_savings_renewal.php?success=Added Successfully";
        }
        
      } 
    });

    }



	});	
});


</script>
</body>
</html>
