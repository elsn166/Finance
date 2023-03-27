<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");

 $employee_id='';
 $session_branch_id = $_SESSION['bid'];
 $session_role_id=$_SESSION['role_id'];

if(isset($_GET['employee_id']) && $_GET['employee_id']!="" )
{

  $employee_id=$_GET['employee_id'];

  $employee_details=select_data(EMPLOYEE_MASTER,"where employee_id='".$employee_id."'");
  $employee_name = $employee_details[0]['employee_name'];
  $employee_code = $employee_details[0]['employee_code'];
 $employee_id = $employee_details[0]['employee_id'];

} 

if(isset($_POST['update']))
{
    
 $employee_id1=$_POST['employee_id1'];
  
  // if($nominee_dob!=""){ 
  //   $nominee_dob = date("Y-m-d", strtotime($nominee_dob));
  // }
  $data['employee_id']=$employee_id1;
  
  

    $update=update_data(CUSTOMER_MASTER,$data,"employee_id",$_GET['employee_id']);
    if($update!=0)
    { 

      // echo "<script type='text/javascript'>window.location='account_nominee.php?account_id=".$_GET['account_id']."&success=Details Updated Successfully';</script>";

      echo "<script type='text/javascript'>window.location='view_renewal_sheet.php?employee_id='".$_POST['employee_id1']."'&success=Customer Transfered Successfully';</script>";
    }
        
}

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

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>


  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Renewal Sheet List</h1>
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
        <h3 class="card-title">Renewal Sheet List</h3>
      <?php if(isset($_GET['employee_id']) && $_GET['employee_id']!="" )
{
?>
        <a class="btn-sm btn-success float-right" href="renewal_sheet_print.php?employee_id=<?php echo $_GET['employee_id']; ?>" target="_blank">Print</a>
          <?php } ?>      
              
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

  <form method="GET" action="" id="form1" name="form1">
        <div class="card-body">



    <div class="form-group row">
      <label for="employee_name" class="col-sm-2 col-form-label">Employee<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="employee_id" class="form-control select2" id="employee_id">
              <option value="">Select Employee Name</option>
              <?php
if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
    $employee_list=select_data(EMPLOYEE_MASTER," where employee_name != 'admin' ORDER BY employee_id ASC");
}
else{
  $employee_list=select_data(EMPLOYEE_MASTER," where employee_name != 'admin' and branch_id='".$session_branch_id."' ORDER BY employee_id ASC");
}

              foreach($employee_list as $el)
              {
              ?>
                <option value="<?php echo $el['employee_id'];?>" <?php if($employee_id == $el['employee_id']){ echo 'selected'; } ?>><?php echo $el['employee_code'].'-'.$el['employee_name'];?></option>
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
      
      <form method="POST" action="" id="form1" name="form1">
        <div class="card-body">



    <div class="form-group row">
      <label for="employee_name" class="col-sm-2 col-form-label">Transfer To<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="employee_id1" class="form-control select2" id="employee_id">
              <option value="">Select Employee Name</option>
              <?php
if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
    $employee_list=select_data(EMPLOYEE_MASTER," where employee_name != 'admin' ORDER BY employee_id ASC");
}
else{
  $employee_list=select_data(EMPLOYEE_MASTER," where employee_name != 'admin' and branch_id='".$session_branch_id."' ORDER BY employee_id ASC");
}

              foreach($employee_list as $el)
              {
              ?>
                <option value="<?php echo $el['employee_id'];?>" <?php if($employee_id == $el['employee_id']){ echo 'selected'; } ?>><?php echo $el['employee_code'].'-'.$el['employee_name'];?></option>
                <?php  
              }
              ?>
              
              </select>
            </div>

  

      <div class="col-sm-3">
      <button type="submit" class="btn-sm btn-success" name="update" id="submit">Transfer</button>
      </div>


      </div>


<?php if(isset($_GET['employee_id'])) { ?>
        <div class="form-group row">
                <label for="plan_term" class="col-sm-4 col-form-label">
                Employee Name: &nbsp;&nbsp;&nbsp;<?php echo $employee_name; ?>  
            </label>

            <label for="plan_term" class="col-sm-4 col-form-label">
                Employee Code: &nbsp;&nbsp;&nbsp;<?php echo $employee_code; ?>  
            </label>
        </div>
        

        <table class="table table-bordered">
                
                  <thead>
                  <tr>
                    <th>S. No</th>
                    <th>Name</th>
                    <th>Account No</th>
                    <th>Mobile No</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Payment</th>
                  </tr>
                  </thead>
                  <tbody>

     
<?php $customer_list=select_data(CUSTOMER_MASTER," where employee_id='".$_GET['employee_id']."' ");
if(count($customer_list)>0)
{
  
  $j=1;
  $k=1;
  $l=1;
  $s = 1;
  ?>


  <tr><td colspan="6"><strong>DAILY SAVINGS</strong><td><tr>

  <?php 

   $plan_list = select_data(PLAN_MASTER," where plan_type_id=1 order by plan_id ASC ");
   if(count($plan_list)>0)
   { 
   
    

    foreach($plan_list as $pl)
    {
      


      ?>

    <tr><td colspan="6"><strong><?php echo $pl['plan_code'];?></strong><td><tr>
  
<?php
    $daily_account_details = select_data(ACCOUNT_MASTER," where plan_id='".$pl['plan_id']."' and plan_type_id=1 and status !='3' and customer_id in (select customer_id from ".CUSTOMER_MASTER." where employee_id='".$_GET['employee_id']."' )");

    // print_r(count($daily_account_details));

    if(count($daily_account_details)>0)
    { 
      $i=1;
     foreach($daily_account_details as $dad)
     { 
        $customer_id = $dad['customer_id'];
        $acc_no = $dad['account_no'];
        $customer_name = customer_name($customer_id);
        $mobile_number = customer_mobile_no($customer_id);
      ?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $customer_name; ?></td>
                <td><?php echo $acc_no; ?></td>
                <td><?php echo $mobile_number; ?></td>
                <td><?php echo $pl['plan_code']; ?></td>
                <td><?php echo $dad['amount']; ?></td>
                <td></td>
              </tr>   
  <?php 
       $i++;
       } // foreach($daily_account_details as $dad)

      } //if(count($daily_account_details)>0)
     
  
}//foreach($plan_list as $pl)

    }//if(count($plan_list)>0)

   ?>
   
   <tr><td colspan="6"><strong>MONTHLY SAVINGS</strong><td><tr>


<?php
//second foreach

    foreach($customer_list as $cl)
    {
      $customer_id = $cl['customer_id'];
      $customer_name = $cl['customer_name'];
      $mobile_number = $cl['mobile_number'];


          $monthly_account_details = select_data(ACCOUNT_MASTER," where customer_id='".$customer_id."' and plan_type_id=3 and status !='3' ");
          if(count($monthly_account_details)>0)
          {
          foreach($monthly_account_details as $dad)
          { 
            $plan_id = $dad['plan_id'];
            $plan_details = select_data(PLAN_MASTER," where plan_id='".$plan_id."'");
            $plan_code = $plan_details[0]['plan_code'];
            ?>
          <tr>
            <td><?php echo $j;?></td>
            <td><?php echo $customer_name; ?></td>
            <td><?php echo $dad['account_no']; ?></td>
            <td><?php echo $mobile_number; ?></td>
            <td><?php echo $plan_code; ?></td>
            <td><?php echo $dad['amount']; ?></td>
            <td></td>
          </tr>         
        <?php  }
      }
      else{

        $j--;
      }
      $j++;
 
    } //second foreach
?>

    <tr><td colspan="6"><strong>WEEKLY SAVINGS</strong><td><tr>


    <?php
    //third foreach
    
        foreach($customer_list as $cl)
        {
          $customer_id = $cl['customer_id'];
          $customer_name = $cl['customer_name'];
          $mobile_number = $cl['mobile_number'];
    
    
              $weekly_account_details = select_data(ACCOUNT_MASTER," where customer_id='".$customer_id."' and plan_type_id=2 and status !='3' ");
              if(count($weekly_account_details)>0)
              {
              foreach($weekly_account_details as $wad)
              { 
                $plan_id = $wad['plan_id'];
                $plan_details = select_data(PLAN_MASTER," where plan_id='".$plan_id."'");
                $plan_code = $plan_details[0]['plan_code'];
                ?>
              <tr>
                <td><?php echo $k;?></td>
                <td><?php echo $customer_name; ?></td>
                <td><?php echo $wad['account_no']; ?></td>
                <td><?php echo $mobile_number; ?></td>
                <td><?php echo $plan_code; ?></td>
                <td><?php echo $wad['amount']; ?></td>
                <td></td>
              </tr>         
            <?php  }
          }
          else{
    
            $k--;
          }
          $k++;
     
        } //third foreach
        
        ?>
        
        <tr><td colspan="6"><strong>LOAN AGAINST DEPOSISTS</strong><td><tr>

 <?php
    //fourth foreach
    
        foreach($customer_list as $cl)
        {
          $customer_id = $cl['customer_id'];
          $customer_name = $cl['customer_name'];
          $mobile_number = $cl['mobile_number'];
    
    
              $loan_details = select_data(LOAN_MASTER," where customer_id='".$customer_id."' and status !='4' ");
              if(count($loan_details)>0)
              {
              foreach($loan_details as $wad)
              { 
                $loan_term_id = $wad['loan_term_id'];
                $loan_term_details = select_data(LOAN_TERM_MASTER," where loan_term_id='".$loan_term_id."'");
                $loan_term_no = $loan_term_details[0]['loan_term_no'];
                ?>
              <tr>
                <td><?php echo $s;?></td>
                <td><?php echo $customer_name; ?></td>
                <td><?php echo $wad['loan_no']; ?></td>
                <td><?php echo $mobile_number; ?></td>
                <td><?php echo $loan_term_no; ?></td>
                <td><?php echo $wad['loan_amount']; ?></td>
                <td></td>
              </tr>         
            <?php  }
          }
          else{
    
            $s--;
          }
          $s++;
     
        } //fourth foreach
        
        ?>
       

    <?php

  } //if
?>
 </tbody>
                  
        </table>

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






 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>
</body>
</html>
