<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");


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

<div class="alert alert-success alert-dismissible" style="margin-left:248px;"><?php echo  $info;?></div>

<?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h3> Savings Renewal </h3>
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
                <h3 class="card-title">Savings Renewal</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                   <!-- <a class="btn-sm btn-success float-right" href="#">Print</a> -->
         <a class="btn-sm btn-success float-right" href="account_tally_printtry.php?branch_id=<?php echo $session_branch_id; ?>" target="_blank">Print</a>
                 <!-- Large button-->
                  </button> 
                  <!-- <a class="btn-sm btn-success float-right" href="add_savings_renewal.php">Add New</a> -->
              </div>
            
        <?php
        if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
        {
       $account_details=select_data(ACCOUNT_MASTER,"where status !=3 ORDER BY account_id ASC");
        }
        else{
          $account_details=select_data(ACCOUNT_MASTER,"where branch_id='".$session_branch_id."' and status !=3 ORDER BY account_id ASC");
        }
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
                    <th>Scheme Code</th>
                    <th>Total Amount</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($account_details as $ad)
              {
                $accno = $ad['account_no'];
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ad['customer_id']."'");
                $account_details=select_data(ACCOUNT_MASTER,"where account_id='".$ad['account_id']."'");
                $acctdate_1 =$account_details[0]['created_date'];
                $date= date("d-m-Y", strtotime($acctdate_1));
                $planlist=select_data(PLAN_MASTER," where plan_id='".$ad['plan_id']."'");
                $plan_code = $planlist[0]['plan_code'];
                $plan_amt = $ad['amount'];
                $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='".$ad['account_id']."'");
                $total_amt=0;
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
                  <td><?php echo  $plan_code.'-'.$plan_amt; ?></td>
                  <td><?php echo  $total_amt; ?></td>
                   <td><?php echo  $date; ?></td>
                  <td>
                  <a href="savings_renewal_list.php?action=view&amp;account_id=<?php echo $ad['account_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
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
