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
     <h3> Plan Details </h3>
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
                <h3 class="card-title">Plan Details</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  <a class="btn-sm btn-success float-right" href="plan_add.php">Add New</a>
              </div>
            
        <?php
        $plan_details=select_data(PLAN_MASTER,"ORDER BY plan_id DESC");
        ?>


              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Plan Type Name</th>
                    <th>Plan Term</th>
                    <th>Plan Code</th>
                    <th>General</th>
                    <th>Senior Citizen & Women</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($plan_details as $pd)
              {
                $get_plan_type = select_data(PLAN_TYPE_MASTER, "where plan_type_id='".$pd['plan_type_id']."'");

                $plan_term_value = $pd['plan_term_value'];
                if($plan_term_value == 'Y')
                {
                  $plantermvalue = 'Year';
                }
                else if($plan_term_value == 'M')
                {
                  $plantermvalue = 'Month';
                }
                else if($plan_term_value == 'D')
                {
                  $plantermvalue = 'Days';
                }
              
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $get_plan_type[0]['plan_type_name']; ?></td>
                  <td><?php echo $pd['plan_term']." ".$plantermvalue; ?> </td>
                  <td><?php echo $pd['plan_code'];?></td>
                  <td><?php echo $pd['plan_interest'];?>%</td>
                  <td><?php echo $pd['plan_spl_interest'];?>%</td>
                  <td>
      <a href="plan_add.php?action=edit&amp;plan_id=<?php echo $pd['plan_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;
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
