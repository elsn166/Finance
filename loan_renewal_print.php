<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");


$userid= $_SESSION['emp_id'];
$session_role_id=$_SESSION['role_id'];
$session_branch_id = $_SESSION['bid'];

if(isset($_GET['loan_id']) && $_GET['loan_id']!="" )
{

  $loan_id=$_GET['loan_id'];

  $loan_details=select_data(LOAN_MASTER,"where loan_id='".$loan_id."'");
  $loan_no = $loan_details[0]['loan_no'];
  $customer_id = $loan_details[0]['customer_id'];
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
		</table>
<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>



  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
     
          <div class="col-sm-6">
            
          </div>
         
      <!-- /.container-fluid -->
    </section>

<!-- Main content -->




   
 
      <!-- left column -->
      <div class="col-md-12">
           
    <!-- Horizontal Form -->
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Loan Renewal List</h3>
        <?php if($session_role_id != 1 && $session_role_id != 2) { ?>

<a class="btn-sm btn-success float-right" data-toggle="modal" data-target="#feedback-modal" data-backdrop="static" data-keyboard="false" style="margin-right:34px;color:white;">

          Add Renewal Amount
</a>

 <!-- large modal -->
      <?php }
?>

      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

  
        <div class="card-body">


        <div class="form-group row">
             <table class="table table-bordered table-striped"style=width:100%>
    
    <thead>
      <tr>
        <th>Loan Number</th>
        <th> Member Number:</th>
        <th> Member Name:</th>
        <th>Total Amount Paid:</th>
           </tr>
      </thead>
      <tbody>
            <tr>
      <td><?php echo $loan_no; ?> </td>
      <td><?php echo $customer_no; ?> </td>
      <td><?php echo $customer_name; ?></td>
      <td><?php echo "Rs. ".$total_amt; ?> </td>
      </tr>
               
                 </tbody></table>

          </div>

 <div class="form-group row">
 <?php 
              $loan_details = select_data(LOAN_RENEWAL,"where loan_id='$loan_id' order by loan_renewal_date asc");
    if(count($loan_details) > 0)
    { ?>
        
                <table class="table table-bordered table-striped"style="width:100%">
                
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
              
                    
                    foreach($loan_details as $ld)
                    {
                      $date = date('d-m-Y',strtotime($ld['loan_renewal_date']))
                      ?>
                    <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $ld['loan_renewal_amt'];?></td>
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
        
        
        
        <!-- /.row -->
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->







 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>

 <link rel="stylesheet" href="dist/css/jquery-ui.css">


<script>

$(function() {
  $( "#loan_renewal_date" ).datepicker({
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
</body>
</html>
