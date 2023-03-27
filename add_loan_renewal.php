<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_role_id=$_SESSION['role_id'];
$session_branch_id = $_SESSION['bid'];
$customer_id='';
$loan_id="";
$loan_renewal_amt="";
$loan_renewal_date="";




 if(isset($_POST['submit']))
 {
    $customer_id=$_POST['customer_id'];
    $loan_id= $_POST['loan_id'];
    $loan_renewal_amt= $_POST['loan_renewal_amt'];
    $loan_renewal_date= $_POST['loan_renewal_date'];
    if($loan_renewal_date!=""){ 
      $loan_renewal_date = date("Y-m-d", strtotime($loan_renewal_date));
    }
    $status = 1;

    $data['customer_id']=$customer_id;
    $data['loan_id'] = $loan_id;
    $data['loan_renewal_amt'] = $loan_renewal_amt;
    $data['loan_renewal_date'] = $loan_renewal_date;
    $data['status'] = $status;
    $data['created_date']= date("Y-m-d H:i:s");
    $data['created_by']=$userid;

    $insert=insert_data(LOAN_RENEWAL,$data); 

    if($insert!=0)
    { 

      //check whether for loan date entry exists in tally list table
      $get_tally_details = select_data(TALLY_MASTER,"where date='".$loan_renewal_date."' and branch_id='".$session_branch_id."'");
      if(count($get_tally_details )>0)
      {

        $loan_renew_details=select_data(TALLY_MASTER,"where date='".$loan_renewal_date."' and branch_id='".$session_branch_id."'");
        $loanrenewamt=$loan_renew_details[0]['loan_renewal_amt'];
        $new_loanrenew_amt = $loan_renewal_amt;
        // $savrenewdata['savings_renewal_amt']=$savrenewamt+$new_savrenew_amt;
        // $updatetally=update_data(TALLY_MASTER,$savrenewdata,"date",$savings_renewal_date);

        $nloanrenewamt = (int)$loanrenewamt+$new_loanrenew_amt;
        $update_tallyqry="UPDATE ".TALLY_MASTER." set loan_renewal_amt='$nloanrenewamt' where date='$loan_renewal_date' and branch_id='$session_branch_id'";
        $updatetally = mysqli_query($CN,$update_tallyqry);

      }
      else{

        $loanrenewdata['loan_renewal_amt']=$loan_renewal_amt;
        $loanrenewdata['date'] = $loan_renewal_date;
        $loanrenewdata['branch_id'] = $session_branch_id;
        $insert=insert_data(TALLY_MASTER,$loanrenewdata); 

      }
        

        echo "<script type='text/javascript'>window.location='view_loan_renewal.php?success=Amount Added Successfully';</script>";
            
    }
         
 }
?>
<style>

.invalid-feedback {
    display: inline;
    margin-left: 170px;
    font-size: 14px;
}

#inner {
    display: table;
    margin: 0 auto;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Loan Renewal</h1>
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
        <h3 class="card-title">Loan Renewal</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">
        <div class="card-body">
        <div class="form-group row">
            <label for="customer_id" class="col-sm-2 col-form-label">Member Number<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="customer_id" class="form-control select2" id="customer_id">
              <option value="">Select Member Number</option>
              <?php
               if($session_role_id == 1)
               {
              $member_list=select_data(CUSTOMER_MASTER," ORDER BY customer_id ASC");
               }
               else{
      $member_list=select_data(CUSTOMER_MASTER,"where branch_id='".$session_branch_id."' ORDER BY customer_id ASC");  
               }
              foreach($member_list as $ml)
              {
              ?>
                <option value="<?php echo $ml['customer_id'];?>" <?php if($customer_id == $ml['customer_id']){ echo 'selected'; } ?>><?php echo $ml['customer_no'].'-'.$ml['customer_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>

           <div class="form-group row">
            <label for="loan_id" class="col-sm-2 col-form-label">Loan Number<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="loan_id" class="form-control select2" id="loan_id">
              <option value="">Select Loan Number</option>
             
              </select>
            </div>
        </div>


        <table class="table table-bordered table-hover plantbl">		  
                <thead>
                    <tr>
                      <th>Loan Type</th>
                      <th>Loan Term</th>
                      <th>Loan Interest</th>
                      <th>Loan Repay Amount</th>
                    </tr>
                </thead>
                <tbody id="displaytbl">

                </tbody>
        
        </table>

<br>

         <div class="form-group row">
            <label for="loan_renewal_amt" class="col-sm-2 col-form-label">Renewal Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="loan_renewal_amt" class="form-control" id="loan_renewal_amt" placeholder="Enter Amount" value="<?php echo $loan_renewal_amt; ?>" />
            </div>
        </div>


        <div class="form-group row">
            <label for="loan_renewal_date" class="col-sm-2 col-form-label">Renewal Date<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="loan_renewal_date" class="form-control" id="loan_renewal_date" placeholder="Select Date" value="<?php echo $loan_renewal_date; ?>" />
            </div>
        </div>







          
        </div>
        <!-- /.card-body -->
              
        <div class="card-footer">

        <div id="inner">
            <?php if(!isset($_GET['plan_id'])) { ?>
              <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
                    <?php } else { ?>
            <button type="submit" class="btn-sm btn-success" id="submit" name="update" >Update</button>
                          <?php } ?>
              <a href=""><button type="button" class="btn-sm btn-default">Cancel</button></a>
          </div>

          <!-- <button type="submit" name="submit" class="btn btn-success">Submit</button> -->
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

$(function () {
     $("#form1").validate({
rules: { 
  customer_id: { required: true},
  loan_id: { required: true},
  loan_renewal_amt: { required: true},
  loan_renewal_date: { required: true},
},
messages: {
  customer_id: { required: 'Please Select Member Number'},
  loan_id: { required: 'Please Select Loan Number'},
  loan_renewal_amt: { required: 'Please Enter Renewal Amount'},
  loan_renewal_date: { required: 'Please Select Renewal Date'},
 
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


 $(document.body).on('change','#customer_id',function(){
  var customer_id = $('#customer_id').val();
    //  alert(customer_id);
    var dataString = "loan_customer_id="+customer_id;
      $.ajax({ 
      type: "GET", 
      url: "ajax_data.php", 
      data: dataString, 
        
      success:  function(data){ 

        
        $("#loan_id").html(data);
      } 
    });
});


 $(document.body).on('change','#loan_id',function(){
  var loan_id = $('#loan_id').val();
    //  alert(account_id);
    var dataString = "loan_account_id="+loan_id;
      $.ajax({ 
      type: "GET", 
      url: "ajax_data.php", 
      data: dataString, 
        
      success:  function(data){ 
// alert(data);
        $("#plantbl").show();

        $("#displaytbl").html(data);
      } 
    });
});
$(function() {
  $( "#loan_renewal_date" ).datepicker({
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
