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

<div class="alert alert-success alert-dismissible" style="margin:0 0 0 230px;width:100% !important"><?php echo  $info;?></div>

<?php } ?>


<?php if($session_role_id == 1) {?>


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
        <!-- <a class="btn-sm btn-success float-right" href="#">Print</a> -->
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

  <form method="POST" action="" id="form1" name="form1">
        <div class="card-body">
        <div class="form-group row">
        <label for="employee_name" class="col-sm-2 col-form-label">Branch Name<span style="color:red">*</span></label>
            <div class="col-sm-5">

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

      <div class="col-sm-3">
      <button type="submit" class="btn-sm btn-success" id="submit">Submit</button>
      </div>


      </div>

      </form>


      <?php if(isset($_POST['branch_id'])) { 


$expense_details=select_data(EXPENSE_MASTER,"where status=1 and branch_id='".$_POST['branch_id']."' ORDER BY expense_date DESC"); ?>

<form method="POST" action="" id="form2" name="form2">


<!-- /.card-header -->
<div class="card-body">

<table id="example2" class="table table-bordered table-striped">
  <thead>
  <tr>
    <th>S. No</th>
    <th>Expense Type Name</th>
    <th>Expense Amount</th>
    <th>Expense Date</th>
    <th>Approval Status</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody>
  <?php
$i=1;
foreach($expense_details as $ed)
{
$expense_date = $ed['expense_date'];
$date = date("d-m-Y", strtotime($expense_date));
$status = $ed['status'];
if($status == 1)
{
   $statusvalue = 'Forwarded';

}
else if($status == 2)
{
  $statusvalue = 'Approved';
}

$get_expense_type = select_data(EXPENSE_TYPE_MASTER, "where expense_type_id='".$ed['expense_type_id']."'");
?>
<tr>
<td><?php echo $i;?></td>
  <td><?php echo $get_expense_type[0]['expense_type_name']; ?></td>
  <td><?php echo $ed['expense_amount']; ?>.Rs</td>
  <td><?php echo $date; ?></td>
  <td><?php echo $statusvalue; ?></td>

  <td>
  <?php if($session_role_id == 1) {?>

<?php if($status == 1 || $status == 2){ ?>
<a href="expense_add.php?action=edit&amp;expense_id=<?php echo $ed['expense_id']; ?>"><span class="label label-success">EDIT</span></a> &nbsp;
<?php }else{  ?>
-
<?php } ?>         


 <?php }else{ ?>
<a href="#"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
   <?php
 } ?>
 
  </td>
</tr>
<?php  $i++; } ?>
  </tbody>
 
</table>
</div>
<!-- /.card-body -->



</form>
              


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


  <!-- ################################### NON ADMINS ################################################## -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h3> Daily Expense Details </h3>
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
                <h3 class="card-title">Daily Expense Details</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  <a class="btn-sm btn-success float-right" href="expense_add.php">Add New</a>
              </div>
            
        <?php
         if($session_role_id == 1 || $session_role_id == 7 || $session_role_id == 9)
         {
        $expense_details=select_data(EXPENSE_MASTER,"where status=1 ORDER BY expense_id DESC");
         }
         else{
          $expense_details=select_data(EXPENSE_MASTER,"where status=1 and branch_id='".$session_branch_id."' ORDER BY expense_id DESC");  
         }
        ?>


              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Expense Type Name</th>
                    <th>Expense Amount</th>
                    <th>Expense Date</th>
                    <th>Approval Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($expense_details as $ed)
              {
                $expense_date = $ed['expense_date'];
                $date = date("d-m-Y", strtotime($expense_date));
                $status = $ed['status'];
                if($status == 1)
                {
                   $statusvalue = 'Forwarded';

                }
                else if($status == 2)
                {
                  $statusvalue = 'Approved';
                }

                $get_expense_type = select_data(EXPENSE_TYPE_MASTER, "where expense_type_id='".$ed['expense_type_id']."'");
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $get_expense_type[0]['expense_type_name']; ?></td>
                  <td><?php echo $ed['expense_amount']; ?>.Rs</td>
                  <td><?php echo $date; ?></td>
                  <td><?php echo $statusvalue; ?></td>

                  <td>
                  <?php if($session_role_id == 1) {?>

<?php if($status == 1 || $status == 2){ ?>
   <a href="expense_add.php?action=edit&amp;expense_id=<?php echo $ed['expense_id']; ?>"><span class="label label-success">EDIT</span></a> &nbsp;
   <?php }else{  ?>
 -
  <?php } ?>         
                
                
                 <?php }else{ ?>
 <a href="#"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
                   <?php
                 } ?>
                 
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


 <script>
 $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
 </script>

</body>
</html>
