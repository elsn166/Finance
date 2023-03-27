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
            <h1>Savings Renewal List</h1>
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
        <h3 class="card-title">Savings Renewal List</h3>
  <!-- <a class="btn-sm btn-success float-right" href="#">Print</a> -->
         <a class="btn-sm btn-success float-right" href="saving_renewal_print.php?branch_id=<?php echo $session_branch_id; ?>&account_id=<?php echo $ad['account_id']; ?>" target="_blank">Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a class="btn-sm btn-success float-right" href="view_savings_renewal.php">Back</a>

<?php if($session_role_id != 1 && $session_role_id != 2) {

if($acct_status !=3 ){?>


        <a class="btn-sm btn-success float-right" data-toggle="modal" data-target="#feedback-modal" data-backdrop="static" data-keyboard="false" style="margin-right:34px;color:white;">

                  Add Renewal Amount
        </a>



        <!-- large modal -->
        <div class="modal fade" id="feedback-modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Savings Renewal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <div class="card-body">
            <form method="post" action="" id="form2" name="form2">

         

            <div class="form-group row">
            <label for="savings_renewal_amt" class="col-sm-2 col-form-label">Renewal Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="savings_renewal_amt" class="form-control" id="savings_renewal_amt" placeholder="Enter Renewal Amount" value="" />
            </div>

            <span id="errorToShowAmt" style="color:red;margin-left:150px;"></span>

        </div>


        <div class="form-group row">
            <label for="savings_renewal_date" class="col-sm-2 col-form-label">Renewal Date<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="savings_renewal_date" class="form-control" id="savings_renewal_date" placeholder="Select Renewal Date" value="" />
            </div>

            <span id="errorToShowDate" style="color:red;margin-left:150px;"></span>


        </div>

        <input type="hidden" name="get_acct_id" id="get_acct_id" value="<?php echo $_GET['account_id']; ?>">

        
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

}
?>

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

            
            <label for="plan_term" class="col-sm-4 col-form-label">
                Total Amount Returns: &nbsp;&nbsp;&nbsp;<?php echo "Rs. ".$int_tot; ?>  
            </label>
            
            
            <label for="plan_term" class="col-sm-4 col-form-label">
                Total Interest: &nbsp;&nbsp;&nbsp;<?php echo "Rs. ".$total_int; ?>  
            </label>
          </div>

 <div class="form-group row">
       

 <?php 
              $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='$account_id' order by renewal_date desc");
    if(count($acct_details) > 0)
    
    { ?>
         
         <?php 
              $ecct_details = select_data(ACCOUNT_MASTER,"where account_id='$account_id'");
    if(count($ecct_details) > 0)
    $plan_id=$ecct_details[0]['plan_id'];
    $spl=$ecct_details[0]['senior_citizen'];
    
    { ?>

        <?php 
              $ecct_details = select_data(PLAN_MASTER,"where plan_id='$plan_id'");
    if(count($ecct_details) > 0)
      $plan_intt1=$ecct_details[0]['plan_interest'];
      $plan_intt2=$ecct_details[0]['plan_spl_interest'];
      $plan_term_value=$ecct_details[0]['plan_term_value'];
      $plan_term=$ecct_details[0]['plan_term'];
      $plan_code=$ecct_details[0]['plan_code'];
    { ?>

                <table id="example2" class="table table-bordered table-striped" style="width:990px;">
                
                <thead>
                  <tr>
                    <th>S. No</th>
                    <th>Renewal Amount</th>
                    <th>Renewal Date</th>
                     <th>senior</th>
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
                    <td><?php echo $spl; ?></td>

                        
                        
                    </tr>
       <?php  $i++; } ?>
                </tbody></table>

                         
                
  <?php } ?>
                   <?php } ?>
                   <?php } ?>
    <?php 
               $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='$account_id' ORDER BY renewal_date desc");
               if(count($acct_details) > 0)
               $ren_amt=$acct_details[0]['renewal_amt'];
    { ?>
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

   

        <?php
       // echo $plan_term;

// PHP program to illustrate bcmul() function\



//daily interest calculation 

  
//echo( ($plan_intt)."<br>");
         
//echo( ($plan_code)."<br>");
//echo( ($plan_int)."<br>");

//echo( ($plan_term)."<br>");
//echo( ($plan_term_value)."<br>");
//if ($plan_term==10 && $plan_term_value =='Y') {
  //  $days="3650";
//}else        
//if ($plan_term==3 && $plan_term_value =='Y') {
//    $days="1095";
//}else
//if ($plan_term==2 && $plan_term_value =='Y') {
  //  $days="730";
//}else

//if ($plan_term==1 && $plan_term_value =='Y') {
  //  $days="365";
//}else
//if ($plan_term==6 && $plan_term_value =='M') {
  //  $days="180";
//}else  
//if ($plan_term==180 && $plan_term_value =='D') {
  //  $days="180";
//}else
//if ($plan_term==100 && $plan_term_value =='D') {
  //  $days=" ";
//}
//if ($spl=='0') {
  //  $plan_intt=$plan_intt1;
//}else        
//if ($spl=='1') {
 //   $plan_intt=$plan_intt2;
//}
// $plan_int=$plan_intt/"100";

//$final_int=$plan_int/$days;
//echo( ($plan_intt)."<br>");
//echo( ($final_int)."<br>");
//echo( ($days)."<br>");
// input numbers with arbitrary precision
//$principal_amount =  " $ren_amt";
//$interest_percent = "$final_int";
//echo $principal_amount;
// echo  $interest_percent;
//echo( ($principal_amount)."<br>");
//echo( ($interest_percent)."<br>");
// calculates the multiplication of the two
// numbers when $scaleVal is not specified
//$interest = $interest_percent*$principal_amount;
//echo $interest;
//echo( ($interest)."<br>");

//$currnet_principal_amount=$principal_amount+$interest;
//echo $currnet_principal_amount;
//echo( ( $currnet_principal_amount)."<br>");

//$a=$currnet_principal_amount+$principal_amount;
//echo ;
//echo( ($a)."<br>");


//$interest1= $a*$interest_percent;
//echo( ($interest1)."<br>");

//$currnet_principal_amount=$a+$interest1;

//echo(($currnet_principal_amount) . "<br>");
//echo $plan_id;
//echo( ($plan_id)."<br>");
//echo $plan_int;
//echo( ($plan_int)."<br>");
//echo  $ren_amt;
//echo( ($ren_amt)."<br>");
 
//weekly interest calculation 
//echo( ($plan_intt)."<br>");
         
//echo( ($plan_code)."<br>");
//echo( ($plan_int)."<br>");

//echo( ($plan_term)."<br>");
//echo( ($plan_term_value)."<br>");
//if ($plan_term==10 && $plan_term_value =='Y') {
//    $days="3650";
//}else        
//if ($plan_term==3 && $plan_term_value =='Y') {
  //  $days="1095";
//}else
//if ($plan_term==2 && $plan_term_value =='Y') {
  //  $days="730";
//}else

//if ($plan_term==1 && $plan_term_value =='Y') {
  //  $days="365";
//}else
//if ($plan_term==6 && $plan_term_value =='M') {
  //  $days="180";
//}else  
//if ($plan_term==180 && $plan_term_value =='D') {
  //  $days="180";
//}else
//if ($plan_term==100 && $plan_term_value =='D') {
  //  $days=" ";
//}
//if ($spl=='0') {
  //  $plan_intt=$plan_intt1;
//}else        
//if ($spl=='1') {
//    $plan_intt=$plan_intt2;
//}
// $plan_int=$plan_intt/"100";

//$final_int=$plan_int/$days;
//echo( ($plan_intt)."<br>");
//echo( ($final_int)."<br>");
//echo( ($days)."<br>");
// input numbers with arbitrary precision
//$principal_amount =  " $ren_amt";
//$interest_percent = "$final_int";
//echo $principal_amount;
// echo  $interest_percent;
//echo( ($principal_amount)."<br>");
//echo( ($interest_percent)."<br>");
// calculates the multiplication of the two
// numbers when $scaleVal is not specified
//$interest = $interest_percent*$principal_amount;
//echo $interest;
//echo( ($interest)."<br>");

//$currnet_principal_amount=$principal_amount+$interest;
//echo $currnet_principal_amount;
//echo( ( $currnet_principal_amount)."<br>");

////$a=$currnet_principal_amount+$principal_amount;
//echo ;
//echo( ($a)."<br>");


////$interest1= $a*$interest_percent;
//echo( ($interest1)."<br>");

//$currnet_principal_amount=$a+$interest1;

//echo(($currnet_principal_amount) . "<br>");
//echo $plan_id;
//echo( ($plan_id)."<br>");
//echo $plan_int;
//echo( ($plan_int)."<br>");
//echo  $ren_amt;
//echo( ($ren_amt)."<br>");
//monthly interest calculation 

  //echo( ($plan_intt)."<br>");
         
//echo( ($plan_code)."<br>");
//echo( ($plan_int)."<br>");

//echo( ($plan_term)."<br>");
//echo( ($plan_term_value)."<br>");
//if ($plan_term==10 && $plan_term_value =='Y') {
 ////   $days="3650";
//}else        
//if ($plan_term==3 && $plan_term_value =='Y') {
//    $days="1095";
//}else
//if ($plan_term==2 && $plan_term_value =='Y') {
//    $days="730";
//}else

//if ($plan_term==1 && $plan_term_value =='Y') {
  //  $days="365";
//}else
//if ($plan_term==6 && $plan_term_value =='M') {
//    $days="180";
//}else  
//if ($plan_term==180 && $plan_term_value =='D') {
 //   $days="180";
//}else
//if ($plan_term==100 && $plan_term_value =='D') {
  //  $days=" ";
//}
//if ($spl=='0') {
  //  $plan_intt=$plan_intt1;
//}else        
//if ($spl=='1') {
  //  $plan_intt=$plan_intt2;
////}
 //$plan_int=$plan_intt/"100";

//$final_int=$plan_int/$days;
//echo( ($plan_intt)."<br>");
//echo( ($final_int)."<br>");
//echo( ($days)."<br>");
// input numbers with arbitrary precision
//$principal_amount =  " $ren_amt";
//$interest_percent = "$final_int";
//echo $principal_amount;
// echo  $interest_percent;
//echo( ($principal_amount)."<br>");
//echo( ($interest_percent)."<br>");
// calculates the multiplication of the two
// numbers when $scaleVal is not specified
//$interest = $interest_percent*$principal_amount;
//echo $interest;
//echo( ($interest)."<br>");

//$currnet_principal_amount=$principal_amount+$interest;
//echo $currnet_principal_amount;
//echo( ( $currnet_principal_amount)."<br>");

//$a=$currnet_principal_amount+$principal_amount;
//echo ;
//echo( ($a)."<br>");


//$interest1= $a*$interest_percent;
//echo( ($interest1)."<br>");

//$currnet_principal_amount=$a+$interest1;

//echo(($currnet_principal_amount) . "<br>");
//echo $plan_id;
//echo( ($plan_id)."<br>");
//echo $plan_int;
//echo( ($plan_int)."<br>");
//echo  $ren_amt;
//echo( ($ren_amt)."<br>");
  
//yearly interest calculation 

  //echo( ($plan_intt)."<br>");
         
//echo( ($plan_code)."<br>");
//echo( ($plan_int)."<br>");

//echo( ($plan_term)."<br>");
//echo( ($plan_term_value)."<br>");
//if ($plan_term==10 && $plan_term_value =='Y') {
 //   $days="3650";
//}else        
//if ($plan_term==3 && $plan_term_value =='Y') {
//    $days="1095";
//}else
//if ($plan_term==2 && $plan_term_value =='Y') {
 //   $days="730";
//else

//if ($plan_term==1 && $plan_term_value =='Y') {
    $days="365";
//}else
//if ($plan_term==6 && $plan_term_value =='M') {
 //   $days="180";
//}else  
//if ($plan_term==180 && $plan_term_value =='D') {
//    $days="180";
//}else
//if ($plan_term==100 && $plan_term_value =='D') {
//    $days=" ";
//}
//if ($spl=='0') {
 //   $plan_intt=$plan_intt1;
//}else        
//if ($spl=='1') {
//    $plan_intt=$plan_intt2;
//}
// $plan_int=$plan_intt/"100";

//$final_int=$plan_int/$days;
//echo( ($plan_intt)."<br>");
//echo( ($final_int)."<br>");
//echo( ($days)."<br>");
// input numbers with arbitrary precision
//$principal_amount =  " $ren_amt";
//$interest_percent = "$final_int";
//echo $principal_amount;
// echo  $interest_percent;
//echo( ($principal_amount)."<br>");
//echo( ($interest_percent)."<br>");
// calculates the multiplication of the two
// numbers when $scaleVal is not specified
//$interest = $interest_percent*$principal_amount;
//echo $interest;
//echo( ($interest)."<br>");

//$currnet_principal_amount=$principal_amount+$interest;
//echo $currnet_principal_amount;
//echo( ( $currnet_principal_amount)."<br>");

//$a=$currnet_principal_amount+$principal_amount;
//echo ;
//echo( ($a)."<br>");


//$interest1= $a*$interest_percent;
//echo( ($interest1)."<br>");

//$currnet_principal_amount=$a+$interest1;

//echo(($currnet_principal_amount) . "<br>");
//echo $plan_id;
//echo( ($plan_id)."<br>");
//echo $plan_int;
//echo( ($plan_int)."<br>");
//echo  $ren_amt;
//echo( ($ren_amt)."<br>");
 
 
 
//$num_str1 = "500";
//$num_str2 = "5.8";
//$num=$num_str2/100;
   
// calculates the multiplication of the two
// numbers when $scaleVal is not specified
//$res=$num_str1*$num;
//$res1=$res+$num_str1;
//$res2=$res1+$num_str1;
//$res3=$res2*$num;
//$res4=$res2+$res3;


//echo( ($res)."<br>");
//echo( ($res1)."<br>");
//echo( ($res2)."<br>");
//echo( ($res3)."<br>");
//echo( ($res4)."<br>");
//echo $num;


?>

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
