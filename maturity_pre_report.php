<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");

 $account_id = '';
 $customer_id='';
 $from_date = '';
 $to_date = '';
 $session_branch_id = $_SESSION['bid'];
 $session_role_id=$_SESSION['role_id'];
 $month_value='';
 if(isset($_POST['month_value']) && $_POST['month_value']!="" )
 {
    $month_value = $_POST['month_value'];

 }
//  if(isset($_POST['customer_id']) && $_POST['customer_id']!="" )
//  {
 
//    $customer_id=$_POST['customer_id'];
//    $account_id = $_POST['account_id'];
//    $from_date = $_POST['from_date'];
//    $to_date = $_POST['to_date'];

//    $customer_details=select_data(CUSTOMER_MASTER,"where customer_id='".$customer_id."'");
//    $customer_name = $customer_details[0]['customer_name'];
//    $customer_no = $customer_details[0]['customer_no'];
//  }


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
            <h1>Maturity Pre Report</h1>
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
        <h3 class="card-title">Maturity Pre Report</h3>
          <a class="btn-sm btn-success float-right" href="maturity_pre_report_print.php?month=<?php echo $month_value; ?>" target="_blank">Print</a>
         
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

  <form method="POST" action="" id="form1" name="form1" autocomplete="off">
        <div class="card-body">


<div class="form-group row">
<label for="from_date" class="col-sm-2 col-form-label">Select Month<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="month_value" class="form-control" id="month_value" placeholder="Select Month" value="<?php echo $month_value; ?>" />
</div>




<div class="col-sm-3">
<button type="submit" class="btn-sm btn-success" id="submit">Submit</button>
</div>


</div>


<?php if(isset($_POST['month_value']) && $_POST['month_value']!="" )
{
  // print_r($_POST);

  $month_value = $_POST['month_value'];


  $selected_from_date = '01-'.$month_value;
  $selected_to_date = '31-'.$month_value;

  $from_date = date('Y-m-d', strtotime($selected_from_date));
  $to_date = date('Y-m-d', strtotime($selected_to_date));


  $customer_ids_to_show=array();


  $account_details=select_data(ACCOUNT_MASTER,"where status=1 ORDER BY account_id DESC");

foreach($account_details as $ad)
{
$creationdate = $ad['date'];
$date = date("d-m-Y", strtotime($creationdate));

$planlist=select_data(PLAN_MASTER," where plan_id='".$ad['plan_id']."'");
$plan_code = $planlist[0]['plan_code'];
$plan_term = $planlist[0]['plan_term'];
$plan_term_value=$planlist[0]['plan_term_value'];

if($plan_term == "1" && $plan_term_value == 'Y')
{
$maturity_date=date('d-m-Y', strtotime('+1 year', strtotime($creationdate)) );
$m_date = date('Y-m-d', strtotime('+1 year', strtotime($creationdate)) );
}
else if($plan_term == "100" && $plan_term_value == 'D')
{
$maturity_date=date('d-m-Y', strtotime('+100 days', strtotime($creationdate)) );
$m_date = date('Y-m-d', strtotime('+100 days', strtotime($creationdate)) );

}
else if($plan_term == "180" && $plan_term_value == 'D')
{
$maturity_date=date('d-m-Y', strtotime('+180 days', strtotime($creationdate)) );
$m_date = date('Y-m-d', strtotime('+180 days', strtotime($creationdate)) );
}
else if($plan_term == "2" && $plan_term_value == 'Y')
{
  $maturity_date=date('d-m-Y', strtotime('+2 year', strtotime($creationdate)) );
  $m_date = date('Y-m-d', strtotime('+2 year', strtotime($creationdate)) );
}
else if($plan_term == "10" && $plan_term_value == 'Y')
{
  $maturity_date=date('d-m-Y', strtotime('+10 year', strtotime($creationdate)) );
  $m_date = date('Y-m-d', strtotime('+10 year', strtotime($creationdate)) );
}
$accno = $ad['account_no'];
$accamt = $ad['amount'];


$plantypelist=select_data(PLAN_TYPE_MASTER," where plan_type_id='".$ad['plan_type_id']."'");
$plan_type_name = $plantypelist[0]['plan_type_name'];


if($m_date <= $to_date && $m_date >= $from_date)
{
   
  array_push($customer_ids_to_show,$ad['account_id']);

}

}
//foreach


$account_ids = implode("','", $customer_ids_to_show);
  


  
  ?>


       
        

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
                    <th>Account Open Date</th>
                    <th>Account Close Date</th>
                   
                  </tr>
                  </thead>
                  
                  
                  <tbody>

     
<?php 

if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
  $account_details=select_data(ACCOUNT_MASTER,"where account_id in ('$account_ids') ORDER BY account_id DESC");
}
else{

  $account_details=select_data(ACCOUNT_MASTER,"where account_id in ('$account_ids') and branch_id='".$session_branch_id."' ORDER BY account_id DESC");
}

              $i=1;
              foreach($account_details as $ad)
              {
                $creationdate = $ad['date'];
                $date = date("d-m-Y", strtotime($creationdate));
                $acd = date("d-m-Y", strtotime($ad['account_close_date']));
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

                
                $accno = $ad['account_no'];
                $accamt = $ad['amount'];
                $maturity_amount = $ad['maturity_amt'];
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

                  
              </tr>
             <?php  $i++; } ?>
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


<link rel="stylesheet" href="dist/css/jquery-ui.css">

<script>


$(function() {
 $( "#month_value" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat: 'mm-yy',
yearRange : '1920:c+100',

});


});
</script>
</body>
</html>
