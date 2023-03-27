<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");
 $userid= $_SESSION['emp_id'];
 $session_branch_id = $_SESSION['bid'];
$session_role_id=$_SESSION['role_id'];


if($session_role_id==1)
{
  $disabled="";
}
else{
  if(isset($_GET['action']) && $_GET['action']=='view'){ 
    $disabled = "disabled";
  }
  else{
    $disabled="";
  }
}

 if(isset($_POST['branch_id']))
 {
   $branch_id = $_POST['branch_id'];
 }
 else
 {
   $branch_id = "";
 }
 
 if(isset($_POST['customer_id']))
 {
   $customer_id = $_POST['customer_id'];
 }
 else
 {
   $customer_id = "";
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
            <h1>Customer History</h1>
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
        <!--<h3 class="card-title">Account Details</h3>-->
        <!-- <a class="btn-sm btn-success float-right" href="#">Print</a> -->
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

  <form method="POST" action="" id="form1" name="form1">
        <div class="card-body">



    
        <div class="form-group row">
            <label for="customer_id" class="col-sm-2 col-form-label">Member Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="customer_id" class="form-control select2" id="customer_id" <?php echo $disabled; ?> >
              <option value="">Select</option>
              <?php
      //      if($session_role_id == 1 )
               {
              $member_list=select_data(CUSTOMER_MASTER," ORDER BY customer_name ASC");
               }
              // else{
      //    $member_list=select_data(CUSTOMER_MASTER,"where branch_id='".$session_branch_id."' ORDER BY customer_name ASC");
      //               }


              foreach($member_list as $ml)
              {
              ?>
                <option value="<?php echo $ml['customer_id'];?>" <?php if($customer_id == $ml['customer_id']){ echo 'selected'; } ?>><?php echo $ml['customer_no'].'-'.$ml['customer_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        

      <div class="col-sm-3">
      <button type="submit" class="btn-sm btn-success" id="submit">Submit</button>
      </div>


      </div>


<?php if(isset($_POST['customer_id'])) { ?>


  <?php
 $account_details=select_data(ACCOUNT_MASTER,"where customer_id='".$_POST['customer_id']."' ORDER BY account_id DESC");
 
       
        ?>
               <!-- /.card-header -->
               <h3 class="card-title">Account Details</h3>
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
              
              
              <?php
               $loan_details=select_data(LOAN_MASTER,"where customer_id='".$_POST['customer_id']."' ORDER BY loan_id DESC");?>
             <h3>Loan View</h3>
                 <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>S No</th>
                    <th>Loan Number</th>
                    <th>Member Number</th>
                    <th>Member Name</th>
                    <th>Loan Amount</th>
                    <th>Paid Amount</th>
                    <th>Loan Approval Status</th>
                    <th>Penalty Amount</th>
                    <th>Loan Opening Date</th>
                    <th>Loan Closing Date</th>
                    <th>Loan Period </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($loan_details as $ld)
              {
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ld['customer_id']."'");
                $loan_renewal_detail= select_data(LOAN_MASTER,"where loan_id='".$ld['loan_id']."'");
                $loantypelist=select_data(LOAN_TYPE_MASTER," where loan_type_id='".$ld['loan_type_id']."'");
                $loan_closing_details= select_data(LOAN_TERM_MASTER," where loan_term_id='".$ld['loan_term_id']."'");
                $loan_term_no=$loan_closing_details[0]['loan_term_no'];
                $loan_type_name = $loantypelist[0]['loan_type_name'];
                $creationdate = $ld['loan_date'];
                $plan_term=$ld['loan_term_id'];
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
                }else{
                     $maturity_date=date('Y-m-d', strtotime( "+$loan_term_no month", strtotime($creationdate)) );
                }
                

              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $ld['loan_no']; ?></td>
                  <td><?php echo  $customerlist[0]['customer_no']; ?></td>
                  <td><?php echo  $customerlist[0]['customer_name']; ?></td>
                  <td><?php echo  $ld['loan_amount']; ?></td>
                  <td><?php $loan_id=$ld['loan_id'];
  $loan_detail = select_data(LOAN_RENEWAL,"where loan_id='$loan_id'");
  $total_amt=0;
  if(count($loan_detail) > 0)
  { 
    
    foreach($loan_detail as $lm)
    {

         $total_amt =$total_amt+$lm['loan_renewal_amt'];
         
        //  echo $total_ammount;

    }
   
  }
   echo $total_amt;?></td>
                  
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
                    }else if($ld['status']==4)
                    {
                      echo 'closed';
                    }else if($ld['status']==5)
                    {
                      echo 'Forward for closeing';
                    }
                    ?>
                  </td>
<td><?php echo  $loan_renewal_detail[0]['loan_penalty']; ?></td>
 <td><?php echo    $creationdate;?></td>
 <td><?php echo    $maturity_date;?></td>
   <td><?php echo    $loan_term_no;?></td>
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
