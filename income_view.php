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

  <!-- ################################### NON ADMINS ################################################## -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h3> Daily Income Details </h3>
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
                <h3 class="card-title">Daily Income Details</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  <a class="btn-sm btn-success float-right" href="income_add.php">Add New</a>
              </div>
            
        <?php
         if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
         {
        $income_details=select_data(INCOME_MASTER,"where status=1 ORDER BY income_id DESC");
        
       
         }
         else{
          $income_details=select_data(INCOME_MASTER,"where status=1 and branch_id='".$session_branch_id."' ORDER BY income_id DESC");  
         }
        ?>
         <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Income Type Name</th>
                    <th>Income Amount</th>
                    <th>Income Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($income_details as $ed)
              {
                $income_date = $ed['income_date'];
                $date = date("d-m-Y", strtotime($income_date));
                

                $get_income_type = select_data(INCOME_TYPE_MASTER, "where income_type_id='".$ed['income_type_id']."'");
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $get_income_type[0]['income_type_name']; ?></td>
                  <td><?php echo $ed['income_amount']; ?>.Rs</td>
                  <td><?php echo $date; ?></td>
                  

                  <td>
                 
   <a href="income_add.php?action=view&amp;income_id=<?php echo $ed['income_id']; ?>"><span class="label label-success">VIEW</span></a> &nbsp;
       
                
                
              
                 
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


 <script>
 $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
 </script>

</body>
</html>
