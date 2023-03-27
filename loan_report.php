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


<?php if($session_role_id == 1) {?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Loan Report</h1>
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
        <h3 class="card-title">Loan Report</h3>
        <!-- <a class="btn-sm btn-success float-right" href="#">Print</a> -->
         <a class="btn-sm btn-success float-right" href="loan_report_print.php?branch_id=<?php echo $branch_id; ?>" target="_blank">Print</a>

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


      <?php if(isset($_POST['branch_id'])) { 


        $loan_details=select_data(LOAN_MASTER,"where branch_id='".$_POST['branch_id']."' and status =4 ORDER BY loan_id DESC");?>


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
                    <th>Paid Amount</th>
                    <th>Loan Approval Status</th>
                    <th>Penalty Amount</th>
                    <th>Loan Opening Date</th>
                    <th>Loan Closing Date</th>
               <!--     <th>Loan Period </th>-->
                <th>Loan Closed Date</th>
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
                 $loan_closing_date=$loan_renewal_detail[0]['actual_date'];
                $loantypelist=select_data(LOAN_TYPE_MASTER," where loan_type_id='".$ld['loan_type_id']."'");
                $loan_closing_details= select_data(LOAN_TERM_MASTER," where loan_term_id='".$ld['loan_term_id']."'");
                $loan_term_no=$loan_closing_details[0]['loan_term_no'];
                $loan_type_name = $loantypelist[0]['loan_type_name'];
                $creationdate = $ld['loan_date'];
                $plan_term=$ld['loan_term_id'];
              if($plan_term == "1")
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
   <!--  <td><?php echo    $loan_term_no;?></td>-->
              <td><?php echo $loan_closing_date;?></td>
              <td>
<?php if($session_role_id == 1) {?>
  <a href="loan_renewal_listnew.php?action=edit&amp;loan_id=<?php echo $ld['loan_id']; ?>&amp;loan_status=<?php echo $ld['status']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;

<?php }else{  ?>
  <a href="loan_renewal_listnew.php?action=view&amp;loan_id=<?php echo $ld['loan_id']; ?>&amp;loan_status=<?php echo $ld['status']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
                  
                  
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
     <h3> Loan Report </h3>
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
                        <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Loan Report</h3> 
        <!-- <a class="btn-sm btn-success float-right" href="#">Print</a> -->
         <a class="btn-sm btn-success float-right" href="loan_report_print.php?branch_id=<?php echo $session_branch_id; ?>" target="_blank">Print</a>

      </div>
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
          <!-- <a class="btn-sm btn-success float-right" href="loan_profile.php">Add New</a> -->
              </div>
            
        <?php
        if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
        {
        $loan_details=select_data(LOAN_MASTER,"where status =4  ORDER BY loan_id DESC");
        }
        else{
      $loan_details=select_data(LOAN_MASTER,"where branch_id='".$session_branch_id."' and status =4 ORDER BY loan_id DESC"); 
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
                    <th>Paid Amount</th>
                    <th>Loan Approval Status</th>
                    <th>Penalty Amount</th>
                    <th>Loan Opening Date</th>
                    <th>Loan Closing Date</th>
                  <!--  <th>Loan Loan Period</th>-->
                   <th>Loan Closed Date</th>
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
                $loan_renewal_detail= select_data(LOAN_MASTER,"where loan_id='".$ld['loan_id']."'");
                 $loan_closing_date=$loan_renewal_detail[0]['actual_date'];
               $loan_closing_details= select_data(LOAN_TERM_MASTER," where loan_term_id='".$ld['loan_term_id']."'");
                $loan_term_no=$loan_closing_details[0]['loan_term_no'];
                $loantypelist=select_data(LOAN_TYPE_MASTER," where loan_type_id='".$ld['loan_type_id']."'");
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
                 <td><?php $loan_id=$ld['loan_id'];
  $loan_detail = select_data(LOAN_RENEWAL,"where loan_id='$loan_id'");
  $total_amt=0;
  if(count($loan_detail) > 0)
  { 
    
    foreach($loan_detail as $lm)
    {

         $total_amt =$total_amt+$lm['loan_renewal_amt'];
         
        //  echo $total_amt;

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
                    } else if($ld['status']==4)
                    {
                      echo 'closed';
                    } else if($ld['status']==5)
                    {
                      echo 'Forward for closeing';
                    }
                    ?>
                  </td>
                  <td><?php echo  $loan_renewal_detail[0]['loan_penalty']; ?></td>
                  <td><?php echo    $creationdate;?></td>
                   <td><?php echo    $maturity_date;?></td>
 <!--  <td><?php echo    $loan_term_no;?></td>-->
      <td><?php echo $loan_closing_date;?></td>
      <td>
<?php if($session_role_id == 1) {?>
  <a href="loan_renewal_listnew.php?action=edit&amp;loan_id=<?php echo $ld['loan_id']; ?>&amp;loan_status=<?php echo $ld['status']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;

<?php }else{  ?>
  <a href="loan_renewal_listnew.php?action=view&amp;loan_id=<?php echo $ld['loan_id']; ?>&amp;loan_status=<?php echo $ld['status']; ?>"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
                  
                  
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
