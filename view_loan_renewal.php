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
     <h3> Loan Renewal </h3>
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
                <h3 class="card-title">Loan Renewal</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  
                  Large button-->
                    <a class="btn-sm btn-success float-right" href="account_tally_printtry1.php?branch_id=<?php echo $session_branch_id; ?>" target="_blank">Print</a>
               <!--   </button> -->
                  <!--<a class="btn-sm btn-success float-right" href="add_loan_renewal.php">Add New</a>-->
              </div>
            
        <?php
         if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
         {
    $loan_details=select_data(LOAN_MASTER,"where status !=4 ORDER BY loan_id ASC");
         }
         else{
    $loan_details=select_data(LOAN_MASTER,"where branch_id='".$session_branch_id."' and status !=4 ORDER BY loan_id ASC"); 
         }
        ?>


              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Member Name</th>
                    <th>Loan No.</th>
                    <th>Member No.</th>
                    <th>Loan Type</th>
                    <th>Total Amt</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($loan_details as $ld)
              {
                $loan_type_id = $ld['loan_type_id'];
                $loan_details = select_data(LOAN_TYPE_MASTER," where loan_type_id='".$loan_type_id."'");
                $loan_type_name = $loan_details[0]['loan_type_name'];
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ld['customer_id']."'");
                $loan_renewal_details = select_data(LOAN_RENEWAL,"where loan_id='".$ld['loan_id']."'");
                $loan_renewal_detail= select_data(LOAN_MASTER,"where loan_id='".$ld['loan_id']."'");
                $total_amt=0;
                if(count($loan_renewal_details) > 0)
                { 
                  
                  foreach($loan_renewal_details as $ad)
                  {

                      $total_amt =$total_amt+$ad['loan_renewal_amt'];

                  }
                }
                
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $customerlist[0]['customer_name']; ?></td>
                  <td><?php echo  $ld['loan_no']; ?></td>
                  <td><?php echo  $customerlist[0]['customer_no']; ?></td>
                  <td><?php echo  $loan_type_name; ?></td>
                  <td><?php echo $total_amt; ?></td>
                  <td>
                  <a href="loan_renewal_list.php?action=view&amp;loan_id=<?php echo $ld['loan_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
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
