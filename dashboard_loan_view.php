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


<?php if($session_role_id == 1) {?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Loan Details</h1>
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
        <h3 class="card-title">Loan Details</h3>
        <!-- <a class="btn-sm btn-success float-right" href="#">Print</a> -->
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

  <form method="POST" action="" id="form1" name="form1">
        <div class="card-body">



   

      <?php if(isset($_GET['b_id'])) { 


        $loan_details=select_data(LOAN_MASTER,"where status=2 and branch_id='".$_GET['b_id']."' ORDER BY loan_id DESC");?>


              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Loan Number</th>
                    <th>Member Number</th>
                    <th>Member Name</th>
                    <th>Loan Type</th>
                    <th>Loan Amount</th>
                    <th>Loan Approval Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($loan_details as $ld)
              {
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ld['customer_id']."'");
              
                $loantypelist=select_data(LOAN_TYPE_MASTER," where loan_type_id='".$ld['loan_type_id']."'");
                $loan_type_name = $loantypelist[0]['loan_type_name'];

                

              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $ld['loan_no']; ?></td>
                  <td><?php echo  $customerlist[0]['customer_no']; ?></td>
                  <td><?php echo  $customerlist[0]['customer_name']; ?></td>
                  <td><?php echo  $loan_type_name; ?></td>
                  <td><?php echo  $ld['loan_amount']; ?></td>
                  <td>
                  <?php 
                    if($ld['status']==1)
                    {
                      echo 'Added';
                    }
                    else if($ld['status']==2)
                    {
                          echo 'Forwarded';
                    }
                    else if($ld['status']==3)
                    {
                      echo 'Approved';
                    } else if($ld['status']==4)
                    {
                      echo 'closed';
                    } else if($ld['status']==5)
                    {
                      echo 'forwared for closing';
                    }
                    ?>
                  </td>

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


   

<?php } else { ?>
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
        $loan_details=select_data(LOAN_MASTER,"ORDER BY loan_id DESC");
        }
        else{
      $loan_details=select_data(LOAN_MASTER,"where branch_id='".$session_branch_id."' ORDER BY loan_id DESC"); 
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
                    <th>Loan Type</th>
                    <th>Loan Amount</th>
                    <th>Loan Approval Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($loan_details as $ld)
              {
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ld['customer_id']."'");
              
                $loantypelist=select_data(LOAN_TYPE_MASTER," where loan_type_id='".$ld['loan_type_id']."'");
                $loan_type_name = $loantypelist[0]['loan_type_name'];

                

              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $ld['loan_no']; ?></td>
                  <td><?php echo  $customerlist[0]['customer_no']; ?></td>
                  <td><?php echo  $customerlist[0]['customer_name']; ?></td>
                  <td><?php echo  $loan_type_name; ?></td>
                  <td><?php echo  $ld['loan_amount']; ?></td>
                  <td>
                  <?php 
                    if($ld['status']==1)
                    {
                      echo 'Added';
                    }
                    else if($ld['status']==2)
                    {
                          echo 'Forwarded';
                    }
                    else if($ld['status']==3)
                    {
                      echo 'Approved';
                    }
                    ?>
                  </td>

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



<?php } //else ?>







 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>
</body>
</html>
