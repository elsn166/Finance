<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");
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
     <h3> Renewal Sheet </h3>
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
                <h3 class="card-title">Renewal Sheet</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  
                  
            
        <?php
        $employee_details=select_data(EMPLOYEE_MASTER,"ORDER BY employee_id DESC");
        ?>


              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Employee Name</th>
                    <th>Employee Code</th>
                    <th>RoleName</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($employee_details as $ed)
              {
                $get_role_details = select_data(ROLE, "where role_id='".$ed['role_id']."'");
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $ed['employee_name']; ?></td>
                  <td><?php echo  $ed['employee_code']; ?></td>
                  <td><?php echo $get_role_details[0]['role_name']; ?></td>
                 
                  <td>
                  <?php if($_SESSION['role_id']==1) { ?>
      <a href="view_renewal_sheet.php?action=view&amp;employee_id=<?php echo $ed['employee_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
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
