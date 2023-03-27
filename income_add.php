<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_role_id=$_SESSION['role_id'];
$session_branch_id = $_SESSION['bid'];
$income_type_id='';
$income_amount='';
$income_date = '';
$comments = '';
$disabled = '';
if(isset($_GET['action']) && $_GET['action']=="view" )
{
    $income_id=$_GET['income_id'];
    $income_details=select_data(INCOME_MASTER,"where income_id='$income_id' ");
    $income_type_id=$income_details[0]['income_type_id'];
    $income_amount=$income_details[0]['income_amount'];
    $income_date=$income_details[0]['income_date'];
    if($income_date!=""){ 
      $income_date = date("d-m-Y", strtotime($income_date));
      }
    $comments = $income_details[0]['comments'];

    $disabled = "disabled";
}


if(isset($_POST['update']))
{
  $income_type_id=$_POST['income_type_id'];
  $income_amount= $_POST['income_amount'];
  $incomedate = $_POST['income_date'];
  $comments = $_POST['comments'];
  if($incomedate!=""){ 
    $income_date = date("Y-m-d", strtotime($incomedate));
  }
  $status = 1;

    
  $data['income_type_id']=$income_type_id;
  $data['income_amount'] = $income_amount;
  $data['income_date'] = $income_date;
  $data['status'] = $status;
  $data['comments'] = $comments;

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

    $update=update_data(INCOME_MASTER,$data,"income_id",$_GET['income_id']);

    // get branch id 
    $get_income_details = select_data(INCOME_MASTER,"where income_id='".$_GET['income_id']."'");
    $entry_branch_id = $get_income_details[0]['branch_id'];

    //check whether for income date entry exists in tally list table
    $get_tally_details = select_data(TALLY_MASTER,"where date='".$income_date."' and branch_id='".$entry_branch_id."'");
    if(count($get_tally_details )>0)
    {

      $income_details=select_data(TALLY_MASTER,"where date='".$income_date."' and branch_id='".$entry_branch_id."'");
      $incomeamt=$income_details[0]['income_amt'];
      if($incomeamt == '')
      {
        $incomeamt = 0;
      }
      // $expdata['expense_amt']=$expenseamt+$expense_amount;
      // $updatetally=update_data(TALLY_MASTER,$expdata,"date",$expense_date);

      $nincomeamt = (int)$incomeamt+(int)$income_amount;
      $update_tallyqry="UPDATE ".TALLY_MASTER." set income_amt='$nincomeamt' where date='$income_date' and branch_id='$entry_branch_id'";
      $updatetally = mysqli_query($CN,$update_tallyqry);

    }
    else{

      $expdata['income_amt']=$income_amount;
      $expdata['date'] = $income_date;
      $expdata['branch_id'] = $entry_branch_id;
      $insert=insert_data(TALLY_MASTER,$expdata); 

    }

  if($update!=0)
  { 
    echo "<script type='text/javascript'>window.location='income_view.php?success=Daily Income Updated Successfully';</script>";
  }
        
}


 if(isset($_POST['submit']))
 {
   
      $status = 1;
    

    $income_type_id=$_POST['income_type_id'];
    $income_amount= $_POST['income_amount'];
    $incomedate = $_POST['income_date'];
    $comments = $_POST['comments'];
    if($incomedate!=""){ 
      $income_date = date("Y-m-d", strtotime($incomedate));
    }

    $data['income_type_id']=$income_type_id;
    $data['income_amount'] = $income_amount;
    $data['income_date'] = $income_date;
    $data['status'] = $status;
    $data['comments'] = $comments;
    $data['branch_id'] = $session_branch_id;
    $data['created_date']= date("Y-m-d H:i:s");
    $data['created_by']=$userid;

    $insert=insert_data(INCOME_MASTER,$data);
    //check whether for expense date entry exists in tally list table
    $get_tally_details = select_data(TALLY_MASTER,"where date='".$income_date."' and branch_id='".$session_branch_id."'");
    if(count($get_tally_details )>0)
    {
      $exp_details=select_data(TALLY_MASTER,"where date='".$income_date."' and branch_id='".$session_branch_id."'");
      $incomeamt=$exp_details[0]['income_amt'];
      if($incomeamt == '')
      {
        $incomeamt = 0;
      }
      $nincomeamt=(int)$incomeamt+(int)$income_amount;
      $update_tallyqry="UPDATE ".TALLY_MASTER." set income_amt='$nincomeamt' where date='$income_date' and branch_id='$session_branch_id'";
      $updatetally = mysqli_query($CN,$update_tallyqry);

    }
    else{

      $expdata['income_amt']=$income_amount;
      $expdata['date'] = $income_date;
      $expdata['branch_id'] = $session_branch_id;
      $insert=insert_data(TALLY_MASTER,$expdata); 

    }

    if($insert!=0)
    { 
        echo "<script type='text/javascript'>window.location='income_view.php?success=Daily Income Added Successfully';</script>";
            
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
            <h1>Daily Income Details</h1>
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
        <h3 class="card-title">Daily Income Details</h3>

        <a class="btn-sm btn-success float-right" href="income_view.php">Back</a>


      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">
        <div class="card-body">
          <div class="form-group row">
            <label for="income_type_id" class="col-sm-2 col-form-label">Select Income Type Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="income_type_id" class="form-control" id="income_type_id" <?php echo $disabled ?>>
              <option value="">Select</option>
              <?php
              $income_type_list=select_data(INCOME_TYPE_MASTER," ORDER BY income_type_id  ASC");
              foreach($income_type_list as $etl)
              {
              ?>
                <option value="<?php echo $etl['income_type_id'];?>" <?php if($income_type_id == $etl['income_type_id']){ echo 'selected'; } ?>><?php echo $etl['income_type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="income_amount" class="col-sm-2 col-form-label">Income Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="income_amount" class="form-control" id="income_amount" placeholder="Enter Income Amount" value="<?php echo $income_amount; ?>" <?php echo $disabled ?>/>
            </div>
          </div>

          <div class="form-group row">
            <label for="income_date" class="col-sm-2 col-form-label">Income Date<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="income_date" class="form-control" id="income_date" placeholder="Select Income Date" value="<?php echo $income_date; ?>" <?php echo $disabled ?>/>
            </div>
          </div> 

          <div class="form-group row">
            <label for="comments" class="col-sm-2 col-form-label">Comments</label>
            <div class="col-sm-5">
              <input type="text" name="comments" class="form-control" id="comments" placeholder="Enter Comments" value="<?php echo $comments; ?>" <?php echo $disabled ?>/>
            </div>
          </div>

          
        </div>
        <!-- /.card-body -->
              
        <div class="card-footer">

        <div id="inner">
    <?php if(!isset($_GET['income_id'])) { ?>

                   

      <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
                    
      <a href=""><button type="button" class="btn-sm btn-default">Cancel</button></a>
          </div>  

                 <?php   
                           
            } ?>

             

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
  income_type_id: { required: true},
  income_amount: {required: true,
  number: true },
  income_date: {required: true },
  
},

messages: {
  income_type_id: { required: 'Please Select Income Type'},
  income_amount: {required: 'Please Enter Income Amount' },
  income_date: {required: 'Please Select Income Date' },
  
 
 
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
  $( "#income_date" ).datepicker({
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
