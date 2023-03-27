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

<div class="alert alert-success alert-dismissible" style="margin-left: 249px;"><?php echo  $info;?></div>

<?php } ?>




<!-- Content Wrapper. Contains page content -->

  
<!-- ################################### NON ADMINS ################################################## -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h3> Loan Details </h3>
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
                <h3 class="card-title">Loan Details</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
          <!-- <a class="btn-sm btn-success float-right" href="loan_profile.php">Add New</a> -->
              </div>
            
        <?php
        if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
        {
            $date1 = date('Y-m-d');
//  echo $date1;
        $loan_details=select_data(LOAN_MASTER,"where status!='4' and closing_before3_days<='$date1' and loan_closing_date!='0000-00-00' ORDER BY loan_id DESC");
        }
        else{
             $date1 = date('Y-m-d');
      $loan_details=select_data(LOAN_MASTER,"where status!='4' and branch_id='".$session_branch_id."' and closing_before3_days<='$date1' and loan_closing_date!='0000-00-00' ORDER BY loan_id DESC"); 
        }
        ?>


              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Loan Number</th>
                    <th>Member Number</th>
                    <th>Member Name</th>
                    <th>Loan Amount</th>
                    <th>Loan Approval Status</th>
                    <th>Loan Opening Date</th>
                    <th>Loan Closing Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($loan_details as $ld)
              {
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ld['customer_id']."'");
               // $_SESSION['state'] = $ld['status'];
              //  echo $_SESSION['state'];
                $loantypelist=select_data(LOAN_TYPE_MASTER," where loan_type_id='".$ld['loan_type_id']."'");
                $loan_type_name = $loantypelist[0]['loan_type_name'];
                $creationdate = $ld['loan_date'];
                $plan_term=$ld['loan_term_id'];
                $loan_closing_details= select_data(LOAN_TERM_MASTER," where loan_term_id='".$ld['loan_term_id']."'");
                $loan_term_no=$loan_closing_details[0]['loan_term_no'];
              if($plan_term == "1"  )
                {
                  $maturity_date=date('Y-m-d', strtotime('+4 month', strtotime($creationdate)) );
                }
                else if($plan_term == "2")
                {
                  $maturity_date=date('Y-m-d', strtotime('+8 month', strtotime($creationdate)) );
                  
                }
                else if($plan_term == "3" )
                {
                  $maturity_date=date('Y-m-d', strtotime('+12 month', strtotime($creationdate)) );
                }
                else{
                   $maturity_date=date('Y-m-d', strtotime( "+$loan_term_no month", strtotime($creationdate)) );
                }
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $ld['loan_no']; ?></td>
                  <td><?php echo  $customerlist[0]['customer_no']; ?></td>
                  <td><?php echo  $customerlist[0]['customer_name']; ?></td>
                 <td><?php echo  $ld['loan_amount']; ?></td>
                 
                  
                  <td>
                  <?php 
                    if($ld['status']==1)
                    {
                      echo 'Added';
                    }
                    else if($ld['status']==2)
                    {
                          echo 'Forward';
                    }
                    else if($ld['status']==3)
                    {
                      echo 'Approved';
                    } else if($ld['status']==4)
                    {
                      echo 'closed';
                    } else if($ld['status']==5)
                    {
                      echo 'Forward for closeing';
                    }
                    ?>
                  </td>
                  <td><?php echo    $creationdate;?></td>
 <td><?php echo    $maturity_date;?></td>
                    <td>
<?php if($session_role_id == 1) {?>
  <a href="loan_profile.php?action=edit&amp;loan_id=<?php echo $ld['loan_id']; ?>&amp;loan_status=<?php echo $ld['status']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;

<?php }else{  ?>
  <a href="loan_profile.php?action=view&amp;loan_id=<?php echo $ld['loan_id']; ?>&amp;loan_status=<?php echo $ld['status']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
                  
                  
<?php } ?>
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
