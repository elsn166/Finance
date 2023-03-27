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

if(isset($_POST['from_date']) && $_POST['to_date']!="" )
{
  $from_date = $_POST['from_date'];
  $to_date = $_POST['to_date'];
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
            <h1>Savings Renewal Report</h1>
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
        <h3 class="card-title">Savings Renewal Report</h3>
        
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

  <form method="POST" action="" id="form1" name="form1" autocomplete="off">
        <div class="card-body">


<div class="form-group row">
<label for="from_date" class="col-sm-1 col-form-label">From Date<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="from_date" class="form-control" id="from_date" placeholder="Select From Date" value="<?php echo $from_date; ?>" />
</div>



<label for="to_date" class="col-sm-1 col-form-label">To Date<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="to_date" class="form-control" id="to_date" placeholder="Select To Date" value="<?php echo $to_date; ?>" />
</div>

<div class="col-sm-3">
<button type="submit" class="btn-sm btn-success" id="submit">Submit</button>
</div>


</div>


<?php if(isset($_POST['from_date']) && isset($_POST['to_date'])) { 
  
  $from_date = date('Y-m-d', strtotime($_POST['from_date']));
  $to_date = date('Y-m-d', strtotime($_POST['to_date']));
  
  
  ?>


        <!-- <div class="form-group row">
                <label for="plan_term" class="col-sm-4 col-form-label">
                Member Name: &nbsp;&nbsp;&nbsp;<?php echo $customer_name; ?>  
            </label>

            <label for="plan_term" class="col-sm-4 col-form-label">
                Member No: &nbsp;&nbsp;&nbsp;<?php echo $customer_no; ?>  
            </label>
        </div> -->
        

        <table id="example2" class="table table-bordered table-striped">
                
                  <thead>
                  <tr>
                    <th>S. No</th>
                    <th>Date</th>
                    <th>Member Name</th>
                    <th>Member No</th>
                    <th>Account No</th>
                    <th>Deposits</th>
                   
                  </tr>
                  </thead>
                  
                  
                  <tbody>

     
<?php 

if($session_role_id == 1 || $session_role_id == 7 || $session_role_id == 9)
{
  $renewal_list=select_data(SAVINGS_RENEWAL," where renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
}
else{

  $renewal_list=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$session_branch_id."') and renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
}



if(count($renewal_list)>0)
{

    $i=1;
    foreach($renewal_list as $cl)
    {
      
      $date = date('d-m-Y', strtotime($cl['renewal_date']));
      $deposit_amt = $cl['renewal_amt'];

      $member_id = $cl['customer_id'];
      $acc_id =  $cl['account_id'];
      $member_name = customer_name($member_id);
      $member_no = customer_no($member_id);
      $acc_no = acc_no($acc_id);
?>
     
        <tr>
          <td><?php echo $i;?></td>
          <td><?php echo $date; ?></td>
          <td><?php echo $member_name; ?></td>
          <td><?php echo $member_no; ?></td>
          <td><?php echo $acc_no; ?></td>
          <td><?php echo $deposit_amt; ?></td>
          
        
        </tr>         
          
    <?php  $i++; }
       
      }
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


<link rel="stylesheet" href="dist/css/jquery-ui.css">

<script>
$(document.body).on('change','#customer_id',function(){
  // alert('hi');
  var customer_id = $('#customer_id').val();

    var dataString = "savings_customer_id="+customer_id;
      $.ajax({ 
      type: "GET", 
      url: "ajax_data.php", 
      data: dataString, 
        
      success:  function(data){ 
        $("#account_id").html(data);
      } 
    });
});

$(function() {
 $( "#from_date" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
});


$( "#to_date" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
});


});
</script>
</body>
</html>
