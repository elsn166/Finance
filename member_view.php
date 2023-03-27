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


<?php if($session_role_id == 1 || $session_role_id == 2) {?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Member Details</h1>
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
        <h3 class="card-title">Member Details</h3>
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


<?php if(isset($_POST['branch_id'])) { ?>


  <?php
 
 $customer_details=select_data(CUSTOMER_MASTER,"where branch_id='".$_POST['branch_id']."' ORDER BY customer_id DESC");
  
       
        ?>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Member Name</th>
                    <th>Member No.</th>
                    <th>Branch Name</th>
                    <th>Referred By</th> 
                    <th>Mobile Number</th>
                    <th>Occupation</th>
                    <th>Member Creation Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($customer_details as $cd)
              {
                $creationdate = $cd['date'];
                $date = date("d-m-Y", strtotime($creationdate));
                $branchlist=select_data(BRANCH_MASTER," where branch_id='".$cd['branch_id']."'");

                $employee_details = select_data(EMPLOYEE_MASTER," where employee_id='".$cd['employee_id']."'");

                if($cd['occupation_id'] != '')
                {
                $occ_details = select_data(OCCUPATION_MASTER," where occupation_id='".$cd['occupation_id']."'");
                $occupation_details = $occ_details[0]['occupation_name'];
                }
                else{
                  $occupation_details='';
                }

                
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $cd['customer_name']; ?></td>
                  <td><?php echo  $cd['customer_no']; ?></td>
                  
                  <td><?php echo  $branchlist[0]['branch_name'];  ?></td>
                  <td><?php echo  $employee_details[0]['employee_name'];  ?></td>
                  <td><?php echo  $cd['mobile_number']; ?></td>
                  <td><?php echo  $occupation_details; ?></td>
                  <td><?php echo  $date; ?></td>
                
                 
                 
                  <td>
<?php if($session_role_id == 1) {?>
      <a href="member_profile.php?action=edit&amp;customer_id=<?php echo $cd['customer_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;

<?php }else{  ?>
      <a href="member_profile.php?action=view&amp;customer_id=<?php echo $cd['customer_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
                  
                  
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
        <!-- /.card-body -->
              
       

                <!-- /.card-footer -->


              </form>
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
     <h3> Member Details </h3>
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
                <h3 class="card-title">Member Details</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->


                  <!-- <a class="btn-sm btn-success float-right" href="member_profile.php">Add New</a> -->

              </div>
            
        <?php
        if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
        {
          $customer_details=select_data(CUSTOMER_MASTER," ORDER BY customer_id DESC");
        }
        else{
          $customer_details=select_data(CUSTOMER_MASTER,"where branch_id='".$session_branch_id."' ORDER BY customer_id DESC");
        }
       
        ?>


              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Member Name</th>
                    <th>Member No.</th>
                    <th>Branch Name</th>
                    <th>Referred By</th> 
                    <th>Mobile Number</th>
                    <th>Occupation</th>
                    <th>Member Creation Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($customer_details as $cd)
              {
                $creationdate = $cd['date'];
                $date = date("d-m-Y", strtotime($creationdate));
                $branchlist=select_data(BRANCH_MASTER," where branch_id='".$cd['branch_id']."'");

                $employee_details = select_data(EMPLOYEE_MASTER," where employee_id='".$cd['employee_id']."'");

                if($cd['occupation_id'] != '')
                {
                $occ_details = select_data(OCCUPATION_MASTER," where occupation_id='".$cd['occupation_id']."'");
                $occupation_details = $occ_details[0]['occupation_name'];
                }
                else{
                  $occupation_details='';
                }

                
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $cd['customer_name']; ?></td>
                  <td><?php echo  $cd['customer_no']; ?></td>
                  
                  <td><?php echo  $branchlist[0]['branch_name'];  ?></td>
                  <td><?php echo  $employee_details[0]['employee_name'];  ?></td>
                  <td><?php echo  $cd['mobile_number']; ?></td>
                  <td><?php echo  $occupation_details; ?></td>
                  <td><?php echo  $date; ?></td>
                
                 
                 
                  <td>
<?php if($session_role_id == 1) {?>
      <a href="member_profile.php?action=edit&amp;customer_id=<?php echo $cd['customer_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;

<?php }else{  ?>
      <a href="member_profile.php?action=view&amp;customer_id=<?php echo $cd['customer_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
                  
                  
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


<?php } ?>



 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>
</body>
</html>
