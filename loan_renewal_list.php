<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");

 if(!isset($_POST['tally_date'])) {
$tally_date=date("d-m-Y");
$tally_date1=date("Y-m-d");
$close_tally_date=date("d-m-Y");
$close_tally_date1=date("Y-m-d");
 }
if(isset($_GET['loan_id']) && $_GET['loan_id']!="" )
{
    
  $loan_id=$_GET['loan_id'];

  $loan_details=select_data(LOAN_MASTER,"where loan_id='".$loan_id."'");
  $loan_no = $loan_details[0]['loan_no'];
  $loan_closing_date=$loan_details[0]['actual_date'];     
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

if(isset($_POST['update3']))
{
      if($session_role_id == 1) {
      $status=4;
  }
  else{
      $status=5;
  }
  $penalty=$_POST['penalty'];
  $date4=$_POST['date4'];
 


  
  
  if($date4!=""){ 
  $date4 = date("Y-m-d", strtotime($date4));
  }
  $data['actual_date']=$date4;
  $data['status']=$status;
 $data['penalty_date']=$date4;
 $data['loan_penalty']=$penalty;

  

  $update=update_data(LOAN_MASTER,$data,"loan_id",$_GET['loan_id']);
  if($update!=0)
  { 
      //$_SESSION['sta'] = $_GET['loan_status'];
      
    echo "<script type='text/javascript'>window.location='view_loan_renewal.php';</script>";
  }
        
}
if(isset($_POST['update2']))
{

    {
      $status=4;
    }
  
  $data['status']=$status;
   $date1=$_POST['date_new1'];
     if($date1!=""){ 
  $date1 = date("Y-m-d", strtotime($date1));
  }
  $data['actual_date']=$date1;
  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;
  //if only admin login, generate loan no
  if($session_role_id == 1)
  {
  $loanlist=select_data(LOAN_MASTER,"where loan_id='".$_GET['loan_id']."'");

  $loanno = $loanlist[0]['loan_no'];
  $loan_amount = $loanlist[0]['loan_amount'];

  //generate loan number only for the first time
  if($loanno == '')
  { 

    $loan_type_id = $loanlist[0]['loan_type_id'];

  
  $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$loanlist[0]['customer_id']."'");

  
  $branchlist=select_data(BRANCH_MASTER," where branch_id='".$customerlist[0]['branch_id']."'");

  
  $branch_code = $branchlist[0]['branch_code'];
  
  $loantypelist=select_data(LOAN_TYPE_MASTER," where loan_type_id='".$loan_type_id."'");
  $loan_type_code = $loantypelist[0]['loan_type_code'];
  
  $loandate = $loanlist[0]['loan_date'];
  
  if($loandate!= '')
  {
    $loandateval =  explode("-",$loandate);
    $year = $loandateval[0];
    $cur_year = substr($year, -2);
    $cur_mon = $loandateval[1];
    $cur_date = $loandateval[2];
  
  }
  else{
    $cur_year = date('y');
    $cur_mon = date('m');
    $cur_date = date('d');
  }
  

  // generating loan number
  $cusbranchid = $customerlist[0]['branch_id'];
  
  $loan_details=select_data(LOAN_MASTER,"where branch_id='$cusbranchid' and loan_type_id='$loan_type_id' ORDER BY loan_id ASC");
  $count_val = count($loan_details);

   

  if($count_val==0)
  {
    $loan_no = $loan_type_code.$branch_code.$cur_date.$cur_mon.$cur_year."00001";
    $ref_no = $loan_type_code."-".$branch_code."-".$cur_date."-".$cur_mon."-".$cur_year."-"."00001";
  }
  else
  {
    $loanid = $_GET['loan_id'];
     
    $ref_loan_no = get_last_loan_no($loan_type_id,$cusbranchid,$loanid);
     
    $loanno = explode("-",$ref_loan_no);
  
    $new_loan_no = str_pad($loanno[5] + 1, 5, 0, STR_PAD_LEFT);

    $loan_no = $loan_type_code.$branch_code.$cur_date.$cur_mon.$cur_year.$new_loan_no;
    $ref_no = $loan_type_code."-".$branch_code."-".$cur_date."-".$cur_mon."-".$cur_year."-".$new_loan_no;
  }


  $data['loan_no'] = $loan_no;
  $data['ref_loan_no'] = $ref_no;




  //check whether for loan date entry exists in tally list table
$get_tally_details = select_data(TALLY_MASTER,"where date='".$loandate."' and branch_id='".$cusbranchid."'");
if(count($get_tally_details )>0)
{

  $loan_tally_details=select_data(TALLY_MASTER,"where date='".$loandate."' and branch_id='".$cusbranchid."'");
  $loantallyamt=$loan_tally_details[0]['loan_amt'];
  $new_loantally_amt = $loan_amount;
  // $savrenewdata['savings_renewal_amt']=$savrenewamt+$new_savrenew_amt;
  // $updatetally=update_data(TALLY_MASTER,$savrenewdata,"date",$savings_renewal_date);

  $nloantallyamt = (int)$loantallyamt+$new_loantally_amt;
  $update_tallyqry="UPDATE ".TALLY_MASTER." set loan_amt='$nloantallyamt' where date='$loandate' and branch_id='$cusbranchid'";
  $updatetally = mysqli_query($CN,$update_tallyqry);

}
else{

  $loantallydata['loan_amt']=$loan_amount;
  $loantallydata['date'] = $loandate;
  $loantallydata['branch_id'] = $cusbranchid;
  $insert=insert_data(TALLY_MASTER,$loantallydata); 

}




  }//generate loan number only for the first time




  
  

  }
//the above part is only functioned by admin

  $update=update_data(LOAN_MASTER,$data,"loan_id",$_GET['loan_id']);
  if($update!=0)
  { 

    if($session_role_id == 1)
    {
      echo "<script type='text/javascript'>window.location='loan_view.php?loan_id=".$_GET['loan_id']."&success=Loan Details Approved Successfully';</script>";
    }
    else{
      echo "<script type='text/javascript'>window.location='loan_view.php?loan_id=".$_GET['loan_id']."&success=Loan Details Forwarded Successfully';</script>";

    }
    
  }
        
}
if(isset($_POST['update1']))
{

    {
      $status=5;
    }
  $date2=$_POST['date_new'];
    if($date2!=""){ 
  $date2 = date("Y-m-d", strtotime($date2));
  }
  $data['status']=$status;
  $data['actual_date']=$date2;
  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  //if only admin login, generate loan no
  if($session_role_id == 1)
  {

     
  $loanlist=select_data(LOAN_MASTER,"where loan_id='".$_GET['loan_id']."'");

  $loanno = $loanlist[0]['loan_no'];
  $loan_amount = $loanlist[0]['loan_amount'];

  //generate loan number only for the first time
  if($loanno == '')
  { 

    $loan_type_id = $loanlist[0]['loan_type_id'];

  
  $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$loanlist[0]['customer_id']."'");

  
  $branchlist=select_data(BRANCH_MASTER," where branch_id='".$customerlist[0]['branch_id']."'");

  
  $branch_code = $branchlist[0]['branch_code'];
  
  $loantypelist=select_data(LOAN_TYPE_MASTER," where loan_type_id='".$loan_type_id."'");
  $loan_type_code = $loantypelist[0]['loan_type_code'];
  
  $loandate = $loanlist[0]['loan_date'];
  
  if($loandate!= '')
  {
    $loandateval =  explode("-",$loandate);
    $year = $loandateval[0];
    $cur_year = substr($year, -2);
    $cur_mon = $loandateval[1];
    $cur_date = $loandateval[2];
  
  }
  else{
    $cur_year = date('y');
    $cur_mon = date('m');
    $cur_date = date('d');
  }
  

  // generating loan number
  $cusbranchid = $customerlist[0]['branch_id'];
  
  $loan_details=select_data(LOAN_MASTER,"where branch_id='$cusbranchid' and loan_type_id='$loan_type_id' ORDER BY loan_id ASC");
  $count_val = count($loan_details);

   

  if($count_val==0)
  {
    $loan_no = $loan_type_code.$branch_code.$cur_date.$cur_mon.$cur_year."00001";
    $ref_no = $loan_type_code."-".$branch_code."-".$cur_date."-".$cur_mon."-".$cur_year."-"."00001";
  }
  else
  {
    $loanid = $_GET['loan_id'];
     
    $ref_loan_no = get_last_loan_no($loan_type_id,$cusbranchid,$loanid);
     
    $loanno = explode("-",$ref_loan_no);
  
    $new_loan_no = str_pad($loanno[5] + 1, 5, 0, STR_PAD_LEFT);

    $loan_no = $loan_type_code.$branch_code.$cur_date.$cur_mon.$cur_year.$new_loan_no;
    $ref_no = $loan_type_code."-".$branch_code."-".$cur_date."-".$cur_mon."-".$cur_year."-".$new_loan_no;
  }


  $data['loan_no'] = $loan_no;
  $data['ref_loan_no'] = $ref_no;




  //check whether for loan date entry exists in tally list table
$get_tally_details = select_data(TALLY_MASTER,"where date='".$loandate."' and branch_id='".$cusbranchid."'");
if(count($get_tally_details )>0)
{

  $loan_tally_details=select_data(TALLY_MASTER,"where date='".$loandate."' and branch_id='".$cusbranchid."'");
  $loantallyamt=$loan_tally_details[0]['loan_amt'];
  $new_loantally_amt = $loan_amount;
  // $savrenewdata['savings_renewal_amt']=$savrenewamt+$new_savrenew_amt;
  // $updatetally=update_data(TALLY_MASTER,$savrenewdata,"date",$savings_renewal_date);

  $nloantallyamt = (int)$loantallyamt+$new_loantally_amt;
  $update_tallyqry="UPDATE ".TALLY_MASTER." set loan_amt='$nloantallyamt' where date='$loandate' and branch_id='$cusbranchid'";
  $updatetally = mysqli_query($CN,$update_tallyqry);

}
else{

  $loantallydata['loan_amt']=$loan_amount;
  $loantallydata['date'] = $loandate;
  $loantallydata['branch_id'] = $cusbranchid;
  $insert=insert_data(TALLY_MASTER,$loantallydata); 

}




  }//generate loan number only for the first time




  
  

  }
//the above part is only functioned by admin

  $update=update_data(LOAN_MASTER,$data,"loan_id",$_GET['loan_id']);
  if($update!=0)
  { 

    if($session_role_id == 1)
    {
      echo "<script type='text/javascript'>window.location='loan_view.php?loan_id=".$_GET['loan_id']."&success=Loan Details Approved Successfully';</script>";
    }
    else{
      echo "<script type='text/javascript'>window.location='loan_view.php?loan_id=".$_GET['loan_id']."&success=Loan Details Forwarded Successfully';</script>";

    }
    
  }
        
}
?>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
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
            <h1>Loan Renewal List</h1>
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
        <h3 class="card-title">Loan Renewal List</h3>
  <a class="btn-sm btn-success float-right" href="loan_renewal_print.php?loan_id=<?php echo  $loan_id; ?>" target="_blank">Print</a>

        <a class="btn-sm btn-success float-right" href="view_loan_renewal.php">Back</a>
        
        <?php if($session_role_id != 1 && $session_role_id != 2) { ?>

<a class="btn-sm btn-success float-right" data-toggle="modal" data-target="#feedback-modal" data-backdrop="static" data-keyboard="false" style="margin-right:34px;color:white;">

          Add Renewal Amount
</a>

 <!-- large modal -->
 <div class="modal fade" id="feedback-modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Loan Renewal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <div class="card-body">
            <form method="post" action="" id="form2" name="form2">

         

            <div class="form-group row">
            <label for="loan_renewal_amt" class="col-sm-2 col-form-label">Renewal Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="loan_renewal_amt" class="form-control" id="loan_renewal_amt" placeholder="Enter Renewal Amount" value="" />
            </div>

            <span id="errorToShowAmt" style="color:red;margin-left:150px;"></span>

        </div>


             <div class="form-group row">
            <label for="loan_renewal_date" class="col-sm-2 col-form-label">Renewal Date<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="loan_renewal_date" class="form-control" id="loan_renewal_date" placeholder="Select Renewal Date" value="" />
            </div>

            <span id="errorToShowDate" style="color:red;margin-left:150px;"></span>


        </div>
        <input type="hidden" name="get_loan_id" id="get_loan_id" value="<?php echo $_GET['loan_id']; ?>">

        
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
?>

      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">
        <div class="card-body">


        <div class="form-group row">
                <label for="plan_term" class="col-sm-4 col-form-label">
                Loan Number: &nbsp;&nbsp;&nbsp;<?php echo $loan_no; ?>  
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
                Total Amount Paid: &nbsp;&nbsp;&nbsp;<?php echo "Rs. ".$total_amt; ?>  </label>
                <label for="plan_term" class="col-4 col-form-label">
                Loan Closed Date: &nbsp;&nbsp;&nbsp;<?php echo "".$loan_closing_date; ?>  </label>
 <?php 
   if($session_role_id != 1){?>
   <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">
  Forward For Closing
</button>
      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" action="" id="form1" name="form1">
   <div class="col-8 modal-body">
    <input type="text" name="date_new" class="form-control" id="date2" placeholder="Select Loan Closing Date" value="<?php echo $close_tally_date; ?>" />
    </div>
      <div class="modal-footer">
       <button type="submit" class="btn-sm btn-success" id="update1" name="update1" $disabled >Forward For Closing</button>
      </div>
      </form>
    </div>
  </div>
</div>
   <?php }?>
      <?php
    if($session_role_id == 1){
    ?>
 <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal1">
  Closing Account
</button>
      <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" action="" id="form1" name="form1">
   <div class="col-8 modal-body">
    <input type="text" name="date_new1" class="form-control" id="date1" placeholder="Select Loan Closing Date" value="<?php echo $close_tally_date; ?>" />
    </div>
      <div class="modal-footer">
       <button type="submit" class="btn-sm btn-success" id="update2" name="update2" $disabled >Account Closing</button>
      </div>
      </form>
    </div>
  </div>
</div>
 <?php }?>
 
  <?php 
     $date1 = date('Y-m-d');
      $loanlist=select_data(LOAN_MASTER,"where loan_id='".$_GET['loan_id']."'");

    //  $closing_date['closing_after2_days'] =$loanlist;
    $close = $loanlist[0]['closing_after2_days'];
    // echo $close;
    $close_date = date('Y-m-d', strtotime($close));
    // echo $close_date;
    
   if($close_date <= $date1 ){?>
   <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Penalty
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
      </div>
        <form method="post" action="" id="form1" name="form1">
      <div class="modal-body col-8">
    <input type="text" name="penalty" id="penalty" class="form-control" placeholder="Enter Penalty Amount">
      </div>
   <div class="col-8 modal-body">
    <input type="text" name="date4" class="form-control" id="loan_renewal_date1" placeholder="Select Date" value="<?php echo $close_tally_date; ?>" />
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <?php
    if($session_role_id == 1){
    ?>
        <button type="submit" name="update3" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal">close Loan</button>
        <?php
    }else{
        ?>
         <button type="submit" name="update3" class="btn btn-primary" >Forward to close</button>
        <?php
    }
    ?>
      </div>
      </form>
    </div>
  </div>
</div>
   <?php }?>
  


  </div>
            
           

        

 <div class="form-group row">
 <?php 
              $loan_details = select_data(LOAN_RENEWAL,"where loan_id='$loan_id' order by loan_renewal_date asc");
    if(count($loan_details) > 0)
    { ?>
        
                <table class="table table-bordered table-striped">
                
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
  $( "#loan_renewal_date" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c'
 });
});
$(function() {
  $( "#loan_renewal_date1" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c'
 });
});

$(function() {
  $( "#date1" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c'
 });
});

$(function() {
  $( "#date2" ).datepicker({
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
