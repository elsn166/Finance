<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");


if(isset($_GET['account_id']) && $_GET['account_id']!="" )
{

  $account_id=$_GET['account_id'];

  $account_details=select_data(ACCOUNT_MASTER,"where account_id='".$account_id."'");
  $account_no = $account_details[0]['account_no'];
  $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$account_details[0]['customer_id']."'");
  $customer_no = $customerlist[0]['customer_no']; 
  $customer_name = $customerlist[0]['customer_name'];
  $total_amt=0;
  $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='$account_id'");
  if(count($acct_details) > 0)
  { 
    
    foreach($acct_details as $ad)
    {

         $total_amt =$total_amt+$ad['renewal_amt'];

    }
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
            <h1>Savings Renewal List</h1>
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
        <h3 class="card-title">Savings Renewal List</h3>
        <a class="btn-sm btn-success float-right" href="view_savings_renewal.php">Back</a>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">
        <div class="card-body">


        <div class="form-group row">
                <label for="plan_term" class="col-sm-4 col-form-label">
                Account Number: &nbsp;&nbsp;&nbsp;<?php echo $account_no; ?>  
            </label>

            <label for="plan_term" class="col-sm-4 col-form-label">
                Member Number: &nbsp;&nbsp;&nbsp;<?php echo $customer_no; ?>  
            </label>


            <label for="plan_term" class="col-sm-4 col-form-label">
                Member Name: &nbsp;&nbsp;&nbsp;<?php echo $customer_name; ?>  
            </label>

          </div>


          <div class="form-group row">
                <label for="plan_term" class="col-sm-4 col-form-label">
                Total Amount Paid: &nbsp;&nbsp;&nbsp;<?php echo "Rs. ".$total_amt; ?>  
            </label>

           

          </div>

 <div class="form-group row">
 <?php 
              $acct_details = select_data(SAVINGS_RENEWAL,"where account_id='$account_id' order by renewal_date asc");
    if(count($acct_details) > 0)
    { ?>
        
                <table class="table table-bordered table-striped">
                
                <thead>
                  <tr>
                    <th>S. No</th>
                    <th>Renewal Amount</th>
                    <th>Renewal Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $i=1;
              
                    
                    foreach($acct_details as $ad)
                    {
                      $date = date('d-m-Y',strtotime($ad['renewal_date']))
                      ?>
                    <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $ad['renewal_amt'];?></td>
                    <td><?php echo $date; ?></td>

                        
                        
                    </tr>
       <?php  $i++; } ?>
                </tbody></table>

                   <?php } ?>
 </div>


          
         
          
        </div>
        <!-- /.card-body -->
              
        <div class="card-footer">

       

          
        </div>

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
