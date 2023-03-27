<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_role_id=$_SESSION['role_id'];
$session_branch_id = $_SESSION['bid'];
$expense_type_id='';
$expense_amount='';
$expense_date = '';
$comments = '';

if(isset($_GET['action']) && $_GET['action']=="edit" )
{
    $expense_id=$_GET['expense_id'];
    $expense_details=select_data(EXPENSE_MASTER,"where expense_id='$expense_id' ");
    $expense_type_id=$expense_details[0]['expense_type_id'];
    $expense_amount=$expense_details[0]['expense_amount'];
    $expense_date=$expense_details[0]['expense_date'];
    if($expense_date!=""){ 
      $expense_date = date("d-m-Y", strtotime($expense_date));
      }
    $comments = $expense_details[0]['comments'];
}


if(isset($_POST['update']))
{
  $expense_type_id=$_POST['expense_type_id'];
  $expense_amount= $_POST['expense_amount'];
  $expensedate = $_POST['expense_date'];
  $comments = $_POST['comments'];
  if($expensedate!=""){ 
    $expense_date = date("Y-m-d", strtotime($expensedate));
  }

  if($session_role_id == 1)
  {
    $status = 2;
  }
    
  $data['expense_type_id']=$expense_type_id;
  $data['expense_amount'] = $expense_amount;
  $data['expense_date'] = $expense_date;
  $data['status'] = $status;
  $data['comments'] = $comments;

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  
  

    if($session_role_id == 1)
    {
      if((int)$expense_type_id != 21 && (int)$expense_type_id != 22 && (int)$expense_type_id != 20 && (int)$expense_type_id != 19 && (int)$expense_type_id != 14 && (int)$expense_type_id != 15 && (int)$expense_type_id != 16 && (int)$expense_type_id != 17 && (int)$expense_type_id != 44 && (int)$expense_type_id != 45)
      {

          $update=update_data(EXPENSE_MASTER,$data,"expense_id",$_GET['expense_id']);

          // get branch id 
          $get_exp_details = select_data(EXPENSE_MASTER,"where expense_id='".$_GET['expense_id']."'");
          $entry_branch_id = $get_exp_details[0]['branch_id'];

          //check whether for expense date entry exists in tally list table
          $get_tally_details = select_data(TALLY_MASTER,"where date='".$expense_date."' and branch_id='".$entry_branch_id."'");
          if(count($get_tally_details )>0)
          {

            $exp_details=select_data(TALLY_MASTER,"where date='".$expense_date."' and branch_id='".$entry_branch_id."'");
            $expenseamt=$exp_details[0]['expense_amt'];
            if($expenseamt == '')
            {
              $expenseamt = 0;
            }
            // $expdata['expense_amt']=$expenseamt+$expense_amount;
            // $updatetally=update_data(TALLY_MASTER,$expdata,"date",$expense_date);

            $nexpamt = $expenseamt+$expense_amount;
            $update_tallyqry="UPDATE ".TALLY_MASTER." set expense_amt='$nexpamt' where date='$expense_date' and branch_id='$entry_branch_id'";
            $updatetally = mysqli_query($CN,$update_tallyqry);

          }
          else{

            $expdata['expense_amt']=$expense_amount;
            $expdata['date'] = $expense_date;
            $expdata['branch_id'] = $entry_branch_id;
            $insert=insert_data(TALLY_MASTER,$expdata); 

          }

                


        }
        else{

          $update=update_data(EXPENSE_MASTER,$data,"expense_id",$_GET['expense_id']);
        }

    }

  if($update!=0)
  { 
    echo "<script type='text/javascript'>window.location='expense_view.php?success=Daily Expense Updated Successfully';</script>";
  }
        
}


 if(isset($_POST['submit']))
 {
    if($session_role_id == 1)
    {
      $status = 2;
    }
    else
    {
      $status = 1;
    }

    $expense_type_id=$_POST['expense_type_id'];
    $expense_amount= $_POST['expense_amount'];
    $expensedate = $_POST['expense_date'];
    $comments = $_POST['comments'];
    if($expensedate!=""){ 
      $expense_date = date("Y-m-d", strtotime($expensedate));
    }

    $data['expense_type_id']=$expense_type_id;
    $data['expense_amount'] = $expense_amount;
    $data['expense_date'] = $expense_date;
    $data['status'] = $status;
    $data['comments'] = $comments;
    $data['branch_id'] = $session_branch_id;
   
    $data['created_date']= date("Y-m-d H:i:s");
    $data['created_by']=$userid;

    if($session_role_id == 1)
    {

      $insert=insert_data(EXPENSE_MASTER,$data);

      if((int)$expense_type_id != 21 && (int)$expense_type_id != 22 && (int)$expense_type_id != 20 && (int)$expense_type_id != 19 && (int)$expense_type_id != 14 && (int)$expense_type_id != 15 && (int)$expense_type_id != 16 && (int)$expense_type_id != 17 && (int)$expense_type_id != 44 && (int)$expense_type_id != 45)
      {


         //check whether for expense date entry exists in tally list table
          $get_tally_details = select_data(TALLY_MASTER,"where date='".$expense_date."' and branch_id='".$session_branch_id."'");
          if(count($get_tally_details )>0)
          {
            $exp_details=select_data(TALLY_MASTER,"where date='".$expense_date."' and branch_id='".$session_branch_id."'");
            $expenseamt=$exp_details[0]['expense_amt'];
            $nexpamt=$expenseamt+$expense_amount;
            $update_tallyqry="UPDATE ".TALLY_MASTER." set expense_amt='$nexpamt' where date='$expense_date' and branch_id='$session_branch_id'";
            $updatetally = mysqli_query($CN,$update_tallyqry);

          }
          else{

            $expdata['expense_amt']=$expense_amount;
            $expdata['date'] = $expense_date;
            $expdata['branch_id'] = $session_branch_id;
            $insert=insert_data(TALLY_MASTER,$expdata); 

          }


      }
     

      

    }
    else
    {
      $insert=insert_data(EXPENSE_MASTER,$data);
    } 

    if($insert!=0)
    { 
        echo "<script type='text/javascript'>window.location='expense_view.php?success=Daily Expense Added Successfully';</script>";
            
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
            <h1>Daily Expense Details</h1>
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
        <h3 class="card-title">Daily Expense Details</h3>

        <a class="btn-sm btn-success float-right" href="expense_view.php">Back</a>


      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">
        <div class="card-body">
          <div class="form-group row">
            <label for="expense_type_id" class="col-sm-2 col-form-label">Select Expense Type Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="expense_type_id" class="form-control" id="expense_type_id">
              <option value="">Select</option>
              <?php
              $expense_type_list=select_data(EXPENSE_TYPE_MASTER," ORDER BY expense_type_id  ASC");
              foreach($expense_type_list as $etl)
              {
              ?>
                <option value="<?php echo $etl['expense_type_id'];?>" <?php if($expense_type_id == $etl['expense_type_id']){ echo 'selected'; } ?>><?php echo $etl['expense_type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="expense_amount" class="col-sm-2 col-form-label">Expense Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="expense_amount" class="form-control" id="expense_amount" placeholder="Enter Expense Amount" value="<?php echo $expense_amount; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label for="expense_date" class="col-sm-2 col-form-label">Expense Date<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="expense_date" class="form-control" id="expense_date" placeholder="Select Expense Date" value="<?php echo $expense_date; ?>" />
            </div>
          </div> 

          <div class="form-group row">
            <label for="comments" class="col-sm-2 col-form-label">Comments</label>
            <div class="col-sm-5">
              <input type="text" name="comments" class="form-control" id="comments" placeholder="Enter Comments" value="<?php echo $comments; ?>" />
            </div>
          </div>

          
        </div>
        <!-- /.card-body -->
              
        <div class="card-footer">

        <div id="inner">
    <?php if(!isset($_GET['expense_id'])) { 

                    if($session_role_id==1){ ?>

                    <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
                    
                    <?php }

                    else{ ?>

              <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Forward To Admin</button>

                    <?php }
                           
            } else { ?>

      <button type="submit" class="btn-sm btn-success" id="submit" name="update" >Approve</button>
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
  expense_type_id: { required: true},
  expense_amount: {required: true,
  number: true },
  expense_date: {required: true },
  
},

messages: {
  expense_type_id: { required: 'Please Select Expense Type'},
  expense_amount: {required: 'Please Enter Expense Amount' },
  expense_date: {required: 'Please Select Expense Date' },
  
 
 
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
  $( "#expense_date" ).datepicker({
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
