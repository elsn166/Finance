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

<div class="alert alert-success alert-dismissible" style="margin:0 0 0 230px;width:100% !important"><?php echo  $info;?></div>

<?php } ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h3> Expense Report </h3>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- /.card-header -->
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Expense Report</h3>  
                 <a class="btn-sm btn-success float-right" href="expense_report_print1.php?branch_id=<?php echo $branch_id;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date;?>&expence_id=<?php echo $expense_lists;?>" target="_blank">Print</a>
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  
                  <!-- <a class="btn-sm btn-success float-right" href="account_profile.php">Add New</a> -->
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



<div class="card-body">
<div class="form-group row">
 <label for="employee_name" class="col-1 col-form-label">Expense Name<span style="color:red">*</span></label>
            <div class="col-sm-3">
            <select name="expence_id" class="form-control" id="expence_id">
              <option value="">Select Expenses </option>
              <?php
              $expense_list=select_data(EXPENSE_TYPE_MASTER," ORDER BY expense_type_id ASC");
              foreach($expense_list as $al)
              {
              ?>
                <option value="<?php echo $al['expense_type_id'];?>" <?php if( $expense_lists == $al['expense_type_id']){ echo 'selected'; } ?>><?php echo $al['expense_type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
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
    
  if(($from_date!='') && ($to_date!='') && ($branch_id!='') && ($expense_lists!=''))
 
{
 $from_date = date('Y-m-d', strtotime($_POST['from_date']));
 $to_date = date('Y-m-d', strtotime($_POST['to_date']));
 // echo $from_date;
 // echo $to_date;
 $expense_details=select_data(EXPENSE_MASTER," where status=2 AND branch_id='". ($_POST['branch_id'])." 'AND expense_type_id='". ($_POST['expence_id'])." 'AND  expense_date >= '".  $from_date."' AND  expense_date <= '".$to_date."' ORDER BY expense_date asc");
 
    $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where status=2 AND branch_id='". ($_POST['branch_id'])." 'AND expense_type_id='". ($_POST['expence_id'])." 'AND  expense_date >= '".  $from_date."' AND  expense_date <= '".$to_date."'");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['expense_amount'];

    }
  }
}elseif(($from_date!='') && ($to_date!='') && ($branch_id!=''))
{
 $from_date = date('Y-m-d', strtotime($_POST['from_date']));
 $to_date = date('Y-m-d', strtotime($_POST['to_date']));
  //echo $from_date;
 // echo $to_date;
 $expense_details=select_data(EXPENSE_MASTER," where status=2 AND branch_id='". ($_POST['branch_id'])." 'AND expense_date >= '".  $from_date."' AND  expense_date <= '".$to_date."' ORDER BY expense_date asc");
 
    $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where status=2 AND branch_id='". ($_POST['branch_id'])." 'AND expense_date >= '".  $from_date."' AND  expense_date <= '".$to_date."'");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['expense_amount'];

    }
  }
 
}elseif(($from_date!='') && ($to_date!='') &&($expense_lists!=''))
{
 $from_date = date('Y-m-d', strtotime($_POST['from_date']));
 $to_date = date('Y-m-d', strtotime($_POST['to_date']));
 // echo $from_date;
 // echo $to_date;
 $expense_details=select_data(EXPENSE_MASTER," where status=2 AND expense_type_id='". ($_POST['expence_id'])." 'AND expense_date >= '".  $from_date."' AND  expense_date <= '".$to_date."' ORDER BY expense_date asc");
 
   $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where status=2 AND expense_type_id='". ($_POST['expence_id'])." 'AND expense_date >= '".  $from_date."' AND  expense_date <= '".$to_date."'");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['expense_amount'];

    }
  }
 
}elseif(($branch_id!='')&& ($expense_lists!=''))
{
  $expense_details=select_data(EXPENSE_MASTER,"where status=2 and expense_type_id='". $_POST['expence_id']." ' AND  branch_id='". $_POST['branch_id'] ." ' ORDER BY expense_date ASC");
    $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where  status=2 and expense_type_id='". $_POST['expence_id']." ' AND  branch_id='". $_POST['branch_id'] ." '");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['expense_amount'];

    }
  }
}elseif(($branch_id!=''))
{
     $expense_details=select_data(EXPENSE_MASTER,"where status=2 and  branch_id='". $_POST['branch_id'] ." ' ORDER BY expense_date ASC");
      $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where status=2 and branch_id='". $_POST['branch_id'] ." '");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['expense_amount'];

    }
  }
}elseif(($expense_lists!=''))
{
    $expense_details=select_data(EXPENSE_MASTER,"where status=2 and expense_type_id='". $_POST['expence_id']."' ORDER BY expense_date ASC");
      $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where status=2 and expense_type_id='". $_POST['expence_id'] ."'");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {
     $total_amt=$total_amt+$ad['expense_amount'];
     }
   }
 }
 else{
  $expense_details=select_data(EXPENSE_MASTER,"where status=2 ORDER BY expense_date ASC");
   $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where status=2 ");
  if(count($acct_details) > 0)
  { 
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['expense_amount'];

    }
  }
}  
}





else{
    if(($from_date!='') && ($to_date!='') &&($expense_lists!=''))
{
 $from_date = date('Y-m-d', strtotime($_POST['from_date']));
 $to_date = date('Y-m-d', strtotime($_POST['to_date']));
 // echo $from_date;
 // echo $to_date;
 $expense_details=select_data(EXPENSE_MASTER," where status=2 and expense_type_id='". ($_POST['expence_id'])."' and expense_date >= '".  $from_date."' and  expense_date <= '".$to_date."' and branch_id='".$session_branch_id."' ORDER BY expense_date asc");
 
   $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where status=2 and expense_type_id='". ($_POST['expence_id'])."' and expense_date >= '".  $from_date."' and  expense_date <= '".$to_date."' and  branch_id='".$session_branch_id."'");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['expense_amount'];

    }
  }
  }elseif(($from_date!='') && ($to_date!='')) 
 
{
  $from_date = date('Y-m-d', strtotime($_POST['from_date']));
  $to_date = date('Y-m-d', strtotime($_POST['to_date']));
  //echo $from_date;
    //echo $to_date;
  $expense_details=select_data(EXPENSE_MASTER," where status=2 and expense_date >= '".  $from_date."' and  expense_date <= '".$to_date."' and branch_id='".$session_branch_id."' ORDER BY expense_date asc");
  $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where status=2 and expense_date >= '".  $from_date."' and  expense_date <= '".$to_date."' and branch_id='".$session_branch_id."'");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['expense_amount'];

    }
  }

}elseif(($expense_lists!='')){
    $expense_details=select_data(EXPENSE_MASTER,"where status=2 and expense_type_id='". $_POST['expence_id']."' and branch_id='".$session_branch_id."' ORDER BY expense_date ASC");
      $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where status=2 and expense_type_id='". $_POST['expence_id'] ."' and branch_id='".$session_branch_id."' ");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['expense_amount'];

    }
  }
}
   


//if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
//{
  //$expense_details=select_data(EXPENSE_MASTER,"where status=2 AND  branch_id='".$session_branch_id." 'ORDER BY expense_date ASC");
//}
else{
  $expense_details=select_data(EXPENSE_MASTER,"where status=2 and branch_id='".$session_branch_id."' ORDER BY expense_date ASC");
   $total_amt=0;
  $acct_details = select_data(EXPENSE_MASTER,"where status=2 and branch_id='".$session_branch_id."'");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['expense_amount'];

    }
  }
}  

}
?>   


              <!-- /.card-header -->
            
             
 
        <div class="card-body">
              
                <table id="example2" class="table table-bordered table-striped">
                       <div class="form-group row">
                <label for="plan_term" class="col-sm-4 col-form-label">
                Total Amount Paid: &nbsp;&nbsp;&nbsp;<?php echo "Rs. ".$total_amt; ?>  
            </label>

           

          </div>
                  <thead>
                  <tr>  
               
       
                    <th>S No</th>
                    <th>Expense Type Name</th>
                    <th>Expense Amount</th>
                    <th>Expense Date</th>
                    <th>Comments</th>
                    <!-- <th>Action</th> -->
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($expense_details as $ed)
              {
                $expense_date = $ed['expense_date'];
                $exp_date = date("d-m-Y", strtotime($expense_date));
                $expense_type_id = $ed['expense_type_id'];
                $expense_type_details=select_data(EXPENSE_TYPE_MASTER,"where expense_type_id='".$expense_type_id."'");
                $expense_type_name = $expense_type_details[0]['expense_type_name'];
                $expense_amt = $ed['expense_amount'];
                $comments = $ed['comments']; 
             ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $expense_type_name; ?></td>
                  <td><?php echo  $expense_amt; ?></td>
                  <td><?php echo  $exp_date; ?></td>
                  <td><?php echo  $comments; ?></td>
              </tr>
             <?php  $i++; } ?>
                  </tbody>
                 
                </table>
              </div>
              
              
            
         
           
            
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

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
