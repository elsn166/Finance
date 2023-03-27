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
     <h3> Role Privilege Details </h3>
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
                <h3 class="card-title">Role Privilege Details</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  <a class="btn-sm btn-success float-right" href="add_privilege.php">Add New</a>
              </div>
            
        <?php
        $privilege_details=select_data(ROLE_PRIVILEGE,"ORDER BY privilege_id DESC");
        ?>


              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Role Name</th>
                    <th>Allocated Modules</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($privilege_details as $pd)
              {
                $role_list = select_data(ROLE, "where role_id='".$pd['role_id']."'");
                $modules = $pd['module_id'];
                $split_modules = explode(',',$modules);
                $mod_names=array();
                for($j = 0;$j<count($split_modules);$j++){
                  $module_id = $split_modules[$j];
                  // $module_list = select_data(MODULE, "where module_id='".$module_id."'");
                  // $module_name = $module_list[0]['module_name'];
                  if($module_id==1)
                  {
                    $module_name = "Member Details";
                  }
                  else if($module_id==2)
                  {
                    $module_name = "Member Creation";
                  }
                  else if($module_id==3)
                  {
                    $module_name = "Account Details";
                  }
                  else if($module_id==4)
                  {
                    $module_name = "Account Creation";
                  }
                  else if($module_id==5)
                  {
                    $module_name = "Loan Details";
                  }
                  else if($module_id==6)
                  {
                    $module_name = "Loan Creation";
                  }
                  else if($module_id==7)
                  {
                    $module_name = "Savings Renewal";
                  }
                  else if($module_id==8)
                  {
                    $module_name = "Loan Renewal";
                  }
                  else if($module_id==9)
                  {
                    $module_name = "Maturity";
                  }
                  else if($module_id==10)
                  {
                    $module_name = "Prematurity";
                  }
                  else if($module_id==11)
                  {
                    $module_name = "Daily Expense";
                  }
                  else if($module_id==12)
                  {
                    $module_name = "Account Tally";
                  }
                  else if($module_id==13)
                  {
                    $module_name = "Renewal Sheet";
                  }
                  else if($module_id==14)
                  {
                    $module_name = "Pass Book";
                  }

                  else if($module_id==15)
                  {
                    $module_name = "Daily Income";
                  }

                  array_push($mod_names, $module_name);
                }

                $modulenames = implode(",",$mod_names);
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $role_list[0]['role_name']; ?></td>
                 
                  <td><?php echo $modulenames; ?></td>
                  <td>
      <a href="add_privilege.php?action=edit&amp;privilege_id=<?php echo $pd['privilege_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;
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
