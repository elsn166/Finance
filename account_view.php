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


<?php if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9) {?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Account Details</h1>
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
        <h3 class="card-title">Account Details</h3>
           <a class="btn-sm btn-success float-right" href="account_view.php">Back</a> 
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
 $account_details=select_data(ACCOUNT_MASTER,"where branch_id='".$_POST['branch_id']."' ORDER BY account_id DESC");
 
       
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
                    <!-- <th>Plan Type</th> -->
                    <th>Scheme Code</th>
                   <th>Old Scheme</th>
                  <!--  <th>int</th>  -->
                    <th>Total Amount</th>
                    <th>Account Creation Date</th>
                    <th>Maturity Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($account_details as $ad)
              {
                $status = $ad['status'];
                $creationdate = $ad['date'];
                $date = date("d-m-Y", strtotime($creationdate));

                $planlist=select_data(PLAN_MASTER," where plan_id='".$ad['plan_id']."'");
                if($ad['old_plan_id']==NULL){
                
                 $old_plan_code = '';
                }
                else{
                  $planlists=select_data(PLAN_MASTER," where plan_id='".$ad['old_plan_id']."'");
                $old_plan_code = $planlists[0]['plan_code'];  
                }
                $plan_code = $planlist[0]['plan_code'];
                
                $plan_term = $planlist[0]['plan_term'];
                $plan_term_value=$planlist[0]['plan_term_value'];

                if($plan_term == "1" && $plan_term_value == 'Y')
                {
                  $maturity_date=date('d-m-Y', strtotime('+1 year', strtotime($creationdate)) );
                }
                else if($plan_term == "100" && $plan_term_value == 'D')
                {
                  $maturity_date=date('d-m-Y', strtotime('+100 days', strtotime($creationdate)) );
                  
                }
                else if($plan_term == "180" && $plan_term_value == 'D')
                {
                  $maturity_date=date('d-m-Y', strtotime('+180 days', strtotime($creationdate)) );
                }
                else if($plan_term == "2" && $plan_term_value == 'Y')
                {
                  $maturity_date=date('d-m-Y', strtotime('+2 year', strtotime($creationdate)) );
                }
                else if($plan_term == "10" && $plan_term_value == 'Y')
                {
                  $maturity_date=date('d-m-Y', strtotime('+10 year', strtotime($creationdate)) );
                }
                else if($plan_term == "6" && $plan_term_value == 'M')
                {
                  $maturity_date=date('d-m-Y', strtotime('+180 days', strtotime($creationdate)) );
                }
                $accno = $ad['account_no'];
                $accamt = $ad['amount'];
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ad['customer_id']."'");
              
                $plantypelist=select_data(PLAN_TYPE_MASTER," where plan_type_id='".$ad['plan_type_id']."'");
                $plan_type_name = $plantypelist[0]['plan_type_name'];

               
                $total_amt = 0;
                $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='".$ad['account_id']."'");
             //   $interest=$acct_details[0]['interest'];
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
                  <td><?php echo  $plan_code.'-'.$accamt; ?></td>
                 <td><?php echo  $old_plan_code; ?></td>
                  <td><?php echo  $total_amt; ?></td>
                  <td><?php echo  $date; ?></td>
                  <td><?php echo  $maturity_date; ?></td>

                  <td>

                  
<?php 



if($status != 3)
{


if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9) {

  ?>
  <a href="account_profile.php?action=edit&amp;account_id=<?php echo $ad['account_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;

<?php }else{  ?>
  <a href="account_profile.php?action=view&amp;account_id=<?php echo $ad['account_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
                  
                  
<?php } 



}

else{

  echo  "Account Closed";
}

?></td>
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
     <h3> Account Details </h3>
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
                <h3 class="card-title">Account Details</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  
                  <!-- <a class="btn-sm btn-success float-right" href="account_profile.php">Add New</a> -->
              </div>
            
              <?php
        if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
        {
        $account_details=select_data(ACCOUNT_MASTER,"ORDER BY account_id DESC");
        }
        else{
        $account_details=select_data(ACCOUNT_MASTER,"where branch_id='".$session_branch_id."' ORDER BY account_id DESC");
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
                    <!-- <th>Plan Type</th> -->
                    <th>Scheme Code</th>
                    <th>Total Amount</th>
                    <th>Account Creation Date</th>
                    <th>Maturity Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($account_details as $ad)
              {
                $status = $ad['status'];
                $creationdate = $ad['date'];
                $date = date("d-m-Y", strtotime($creationdate));

                $planlist=select_data(PLAN_MASTER," where plan_id='".$ad['plan_id']."'");
                $plan_code = $planlist[0]['plan_code'];
                $plan_term = $planlist[0]['plan_term'];
                $plan_term_value=$planlist[0]['plan_term_value'];

                if($plan_term == "1" && $plan_term_value == 'Y')
                {
                  $maturity_date=date('d-m-Y', strtotime('+1 year', strtotime($creationdate)) );
                }
                else if($plan_term == "100" && $plan_term_value == 'D')
                {
                  $maturity_date=date('d-m-Y', strtotime('+100 days', strtotime($creationdate)) );
                  
                }
                else if($plan_term == "180" && $plan_term_value == 'D')
                {
                  $maturity_date=date('d-m-Y', strtotime('+180 days', strtotime($creationdate)) );
                }
                else if($plan_term == "2" && $plan_term_value == 'Y')
                {
                  $maturity_date=date('d-m-Y', strtotime('+2 year', strtotime($creationdate)) );
                }
                else if($plan_term == "10" && $plan_term_value == 'Y')
                {
                  $maturity_date=date('d-m-Y', strtotime('+10 year', strtotime($creationdate)) );
                }
                 else if($plan_term == "6" && $plan_term_value == 'M')
                {
                  $maturity_date=date('d-m-Y', strtotime('+180 days', strtotime($creationdate)) );
                }
                $accno = $ad['account_no'];
                $accamt = $ad['amount'];
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ad['customer_id']."'");
              
                $plantypelist=select_data(PLAN_TYPE_MASTER," where plan_type_id='".$ad['plan_type_id']."'");
                $plan_type_name = $plantypelist[0]['plan_type_name'];

               
                $total_amt = 0;
                $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='".$ad['account_id']."'");
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
                  
                  <td><?php echo  $plan_code.'-'.$accamt; ?></td>
                  <td><?php echo  $total_amt; ?></td>
                  <td><?php echo  $date; ?></td>
                  <td><?php echo  $maturity_date; ?></td>

                  <td>


                  
<?php 


if($status != 3)
{
if($session_role_id == 1) {?>
  <a href="account_profile.php?action=edit&amp;account_id=<?php echo $ad['account_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;

<?php }else{  ?>
  <a href="account_profile.php?action=view&amp;account_id=<?php echo $ad['account_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
                  
                  
<?php } 


}
else{

  echo  "Account Closed";
}



?></td>
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
