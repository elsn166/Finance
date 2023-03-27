<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");

 $employee_id='';
 $session_branch_id = $_SESSION['bid'];
 $session_role_id=$_SESSION['role_id'];
    
           if(isset($_POST['from_date']))
{
  $from_date = $_POST['from_date'];
}
else{
  $from_date = '';
}
if(isset($_POST['to_date']))
{
  $to_date = $_POST['to_date'];
}
else{
  $to_date = '';
}
 
if(isset($_POST['branch_id']))
{
  $branch_id = $_POST['branch_id'];
}
else{
  $branch_id = '';
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

<div class="alert alert-success alert-dismissible" style="margin:0 0 0 230px;width:100% !important"><?php echo  $info;?></div>

<?php } ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h3>Pre Maturity Report </h3>
    </section>


<!-- Content Wrapper. Contains page content -->
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
                <h3 class="card-title">Pre Maturity Report</h3>  
                 <a class="btn-sm btn-success float-right" href="prematurity_report_print.php?branch_id=<?php echo $branch_id;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date;?>"target="_blank">Print</a>
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  
                  <!-- <a class="btn-sm btn-success float-right" href="account_profile.php">Add New</a> -->
              </div>
              
               <form method="POST" action="" id="form1" name="form1">
               <div class="form-group row">
<label for="from_date" class="col-sm-1 col-form-label">From Date<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="date" name="from_date" class="form-control" id="from_date" placeholder="Select From Date" value="<?php echo $from_date; ?>" />
</div>



<label for="to_date" class="col-sm-1 col-form-label">To Date<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="date" name="to_date" class="form-control" id="to_date" placeholder="Select To Date" value="<?php echo $to_date; ?>" >
</div>
</div>
<?php
              if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{?>
<div class="card-body">
    <div class="form-group row">
      <label for="employee_name" class=" col-form-label">Branch Name<span style="color:red">*</span></label>
            <div class="col-sm-3">
            <select name="branch_id" class="form-control" id="branch_id">
              <option value="">Select Branch Name</option>
              <?php
              $branch_list=select_data(BRANCH_MASTER," ORDER BY branch_id ASC");
              foreach($branch_list as $bl)
              {
              ?>
                <option value="<?php echo $bl['branch_id'];?>" <?php if( $branch_id == $bl['branch_id']){ echo 'selected'; } ?>><?php echo $bl['branch_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
      </div>
</div>
<?php }?>
<div class="col-sm-3">
      <button type="submit" class="btn-sm btn-success" id="submit">Submit</button>
      </div>
 </form>
<?php
if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
    
    if(($from_date!='') && ($to_date!='') && ($branch_id!=''))
 
{
    $from_date1 = date('Y-m-d', strtotime($_POST['from_date']));
  $to_date1 = date('Y-m-d', strtotime($_POST['to_date']));
   $branch_id1 = $_POST['branch_id'];
  
  //echo $from_date;
    //echo $to_date;
    if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
$account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and account_close_date >= '".$from_date1."' and  account_close_date <= '".$to_date1."' and branch_id='$branch_id1' ORDER BY account_id DESC");  
$total_amt=0;
  $acct_details =select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and account_close_date >= '".$from_date1."' and  account_close_date <= '".$to_date1."' and branch_id='$branch_id1' ORDER BY account_id DESC");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['maturity_amt'];

    }
  }
}
else
{
}
}
elseif(($from_date!='') && ($to_date!=''))
 
{
    $from_date1 = date('Y-m-d', strtotime($_POST['from_date']));
  $to_date1 = date('Y-m-d', strtotime($_POST['to_date']));
//   $branch_id = $_POST['branch_id'];
  //echo $from_date;
    //echo $to_date;
     if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
$account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and account_close_date >= '".$from_date1."' and  account_close_date <= '".$to_date1."'  ORDER BY account_id DESC");  
$total_amt=0;
  $acct_details =select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and account_close_date >= '".$from_date1."' and  account_close_date <= '".$to_date1."'  ORDER BY account_id DESC");  
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['maturity_amt'];

    }
  }
}
else{
  $account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and account_close_date >= '".$from_date1."' and  account_close_date <= '".$to_date1."' and branch_id='$session_branch_id'  ORDER BY account_id DESC"); 
  $total_amt=0;
  $acct_details =select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and account_close_date >= '".$from_date1."' and  account_close_date <= '".$to_date1."' and branch_id='$session_branch_id'  ORDER BY account_id DESC");  
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['maturity_amt'];

    }
  }
}
    
}
elseif($branch_id!='')
 
{
     $branch_id1 = $_POST['branch_id'];
    //echo $to_date;
$account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and branch_id='$branch_id1'  ORDER BY account_id DESC");  
$total_amt=0;
  $acct_details =select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and branch_id='$branch_id1'  ORDER BY account_id DESC");   
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['maturity_amt'];

    }
  }
}
else{
    if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
   $account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 ORDER BY account_id DESC");
   $total_amt=0;
  $acct_details =select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 ORDER BY account_id DESC");  
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['maturity_amt'];

    }
  }
}
else{
    $account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and branch_id='.$session_branch_id.' ORDER BY account_id DESC");
    $total_amt=0;
   $account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and branch_id='.$session_branch_id.' ORDER BY account_id DESC");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['maturity_amt'];

    }
  }

}
}
}
else{
   if(($from_date!='') && ($to_date!=''))
 
{
    $from_date1 = date('Y-m-d', strtotime($_POST['from_date']));
  $to_date1 = date('Y-m-d', strtotime($_POST['to_date']));
//   $branch_id = $_POST['branch_id'];
  //echo $from_date;
    //echo $to_date;
    

  $account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and account_close_date >= '".$from_date1."' and  account_close_date <= '".$to_date1."' and branch_id='$session_branch_id'  ORDER BY account_id DESC"); 
  $total_amt=0;
  $acct_details =select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and account_close_date >= '".$from_date1."' and  account_close_date <= '".$to_date1."' and branch_id='$session_branch_id'  ORDER BY account_id DESC"); 
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['maturity_amt'];

    }
  }
} 
else{
      $account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and branch_id='".$session_branch_id."' ORDER BY account_id DESC");
      $total_amt=0;
  $acct_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and branch_id='".$session_branch_id."' ORDER BY account_id DESC");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

     $total_amt=$total_amt+$ad['maturity_amt'];

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
                    <th>Member Name</th>
                    <th>Account No.</th>
                    <th>Member No.</th>
                    <!-- <th>Plan Type</th> -->
                    <th>Scheme Code</th>
                    <th>Total Amount</th>
                    <th>Account Open Date</th>
                    <th>Account Close Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
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
                $accno = $ad['account_no'];
                $accamt = $ad['amount'];
                $maturity_amount = $ad['maturity_amt'];
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ad['customer_id']."'");
              
                $plantypelist=select_data(PLAN_TYPE_MASTER," where plan_type_id='".$ad['plan_type_id']."'");
                $plan_type_name = $plantypelist[0]['plan_type_name'];
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $customerlist[0]['customer_name']; ?></td>
                  <td><?php echo  $accno; ?></td>
                  <td><?php echo  $customerlist[0]['customer_no']; ?></td>
                  
                  <td><?php echo  $plan_code.'-'.$accamt; ?></td>
                  <td><?php echo  $maturity_amount; ?></td>
                  <td><?php echo  $date; ?></td>
                  <td><?php echo  $acd; ?></td>

                   <td>

  <a href="prematurity_report_view_list.php?account_id=<?php echo $ad['account_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
                  
</td> 
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
</body>
</html>
