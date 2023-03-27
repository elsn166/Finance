<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");


 if(isset($_POST['branch_id']))
 {
   $branch_id = $_POST['branch_id'];
 }
 else
 {
   $branch_id = "";
 }
 
  if(isset($_GET['b_id']))
 {
   $branch_id = $_GET['b_id'];
 }
 else
 {
  
    $branch_id = "";
  
 }



 $employee_id='';
 $session_branch_id = $_SESSION['bid'];
 $session_role_id=$_SESSION['role_id'];

$customer_ids_to_show=array();

if($session_role_id == 1 || $session_role_id == 7 || $session_role_id == 9)
{
  $account_details=select_data(ACCOUNT_MASTER,"where status=2 and prematurity_acct=1 ORDER BY account_id DESC");
}
else{

  $account_details=select_data(ACCOUNT_MASTER,"where status=1 and branch_id='".$session_branch_id."' ORDER BY account_id DESC");

}


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


$plantypelist=select_data(PLAN_TYPE_MASTER," where plan_type_id='".$ad['plan_type_id']."'");
$plan_type_name = $plantypelist[0]['plan_type_name'];



array_push($customer_ids_to_show,$ad['account_id']);



}
//foreach


$account_ids = implode("','", $customer_ids_to_show);


  
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


<?php if($session_role_id == 1 || $session_role_id == 7 || $session_role_id == 9){ ?>
  

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h3> PreMaturity List </h3>
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
                <h3 class="card-title">PreMaturity List</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  
                  <!-- <a class="btn-sm btn-success float-right" href="account_profile.php">Add New</a> -->
              </div>


              <form method="POST" action="" id="form1" name="form1">
  

      <?php if(isset($_GET['b_id'])) { 

$account_details=select_data(ACCOUNT_MASTER,"where status=2 and prematurity_acct=1 and branch_id='".$_GET['b_id']."' ORDER BY account_id DESC");
?>


      
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Member Name</th>
                    <th>Account No.</th>
                    <th>Member No.</th>
                    <!-- <th>Plan Type</th> -->
                    <th>Scheme Code</th>
                    <th>Total Amount</th>
                    <th>Account Creation Date</th>
                    <th>Maturity Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              $maturity_date='';
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

                  <td>

  <a href="close_prematurity.php?account_id=<?php echo $ad['account_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;
                  
</td>
              </tr>
             <?php  $i++; } ?>
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->




              <?php } ?>



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


<?php }else{ ?>

<!-- Other roles  -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h3> PreMaturity List </h3>
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
                <h3 class="card-title">PreMaturity List</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  
                  <!-- <a class="btn-sm btn-success float-right" href="account_profile.php">Add New</a> -->
              </div>
            <?php


  $account_details=select_data(ACCOUNT_MASTER,"where account_id in ('$account_ids') and branch_id='".$session_branch_id."' ORDER BY account_id DESC");

 ?>   
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Member Name</th>
                    <th>Account No.</th>
                    <th>Member No.</th>
                    <!-- <th>Plan Type</th> -->
                    <th>Scheme Code</th>
                    <th>Total Amount</th>
                    <th>Account Creation Date</th>
                    <th>Maturity Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              $maturity_date='';
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

                  <td>

  <a href="close_prematurity.php?account_id=<?php echo $ad['account_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;
                  
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

<?php } ?>



 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>
</body>
</html>
