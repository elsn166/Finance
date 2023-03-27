<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");
 if(isset($_GET['b_id']))
 {
   $branch_id = $_GET['b_id'];
 }
 else
 {
  
    $branch_id = "";
   
   
 }
 $session_role_id=$_SESSION['role_id'];
 $session_branch_id = $_SESSION['bid'];

 if($branch_id == 1)
 {
    $branch_name = 'Paramakudi';
 }
 else if($branch_id == 2)
 {
  $branch_name = 'Mudukulathur';
 }
 else if($branch_id == 3)
 {
  $branch_name = 'Ramnad';
 }
 else if($branch_id == 4)
 {
  $branch_name = 'Pudur';
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

<div class="alert alert-success alert-dismissible" style="margin:0 0 0 230px;width:100% !important"><?php echo  $info;?></div>

<?php } ?>

<?php 

if(isset($_POST['approve_all']))
{
   $expense_id = $_POST['expense_id'];

   foreach($expense_id as $val)
   {
  
  if($session_role_id == 1)
  {
    $status = 2;
  }
  
  $data['status'] = $status;
  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $expdet = select_data(EXPENSE_MASTER,"where expense_id='".$val."'");
  $expense_type_id = $expdet[0]['expense_type_id'];

    if($session_role_id == 1)
    {
      if((int)$expense_type_id != 21 && (int)$expense_type_id != 22 && (int)$expense_type_id != 20 && (int)$expense_type_id != 19 && (int)$expense_type_id != 14 && (int)$expense_type_id != 15 && (int)$expense_type_id != 16 && (int)$expense_type_id != 17 && (int)$expense_type_id != 44 && (int)$expense_type_id != 45)
      {

          $update=update_data(EXPENSE_MASTER,$data,"expense_id",$val);

          // get branch id 
          $get_exp_details = select_data(EXPENSE_MASTER,"where expense_id='".$val."'");
          $expense_date = $get_exp_details[0]['expense_date'];
          $expense_amount = $get_exp_details[0]['expense_amount'];
          $entry_branch_id = $get_exp_details[0]['branch_id'];

          //check whether for expense date entry exists in tally list table
          $get_tally_details = select_data(TALLY_MASTER,"where date='".$expense_date."' and branch_id='".$entry_branch_id."'");
          if(count($get_tally_details )>0)
          {

            $exp_details=select_data(TALLY_MASTER,"where date='".$expense_date."' and branch_id='".$entry_branch_id."'");
            $expenseamt=$exp_details[0]['expense_amt'];
            if($expenseamt == '')
            {
              $expenseamt = 0;
            }
            // $expdata['expense_amt']=$expenseamt+$expense_amount;
            // $updatetally=update_data(TALLY_MASTER,$expdata,"date",$expense_date);

            $nexpamt = (int)$expenseamt+$expense_amount;
            $update_tallyqry="UPDATE ".TALLY_MASTER." set expense_amt='$nexpamt' where date='$expense_date' and branch_id='$entry_branch_id'";
            $updatetally = mysqli_query($CN,$update_tallyqry);

          }
          else{

            $expdata['expense_amt']=$expense_amount;
            $expdata['date'] = $expense_date;
            $expdata['branch_id'] = $entry_branch_id;
            $insert=insert_data(TALLY_MASTER,$expdata); 

          }

                


        }
        else{

          $update=update_data(EXPENSE_MASTER,$data,"expense_id",$val);
        }

    }

    

    if($update!=0)
    { 
      $bid = $_GET['b_id'];
      echo '<script type="text/javascript">window.location="dashboard_expense_view.php?b_id='.$bid.'&success=Daily Expense Approved Successfully;"</script>';
    }





   } //foreach
  


} 
?>
<?php if($session_role_id == 1) {?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daily Expense Details</h1>
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
        <h3 class="card-title">Daily Expense Details - <?php echo $branch_name; ?></h3>
       
        <a class="btn-sm btn-success float-right" href="dashboard.php">Back To Dashboard</a>

      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->


      <?php if(isset($_GET['b_id'])) { 


$expense_details=select_data(EXPENSE_MASTER,"where status=1 and branch_id='".$_GET['b_id']."' ORDER BY expense_date DESC"); ?>

<form method="POST" action="" id="form2" name="form2">


<!-- /.card-header -->
<div class="card-body">

<table id="example2" class="table table-bordered table-striped">
  <thead>
  <tr>
    <th><?php if(count($expense_details)>0){?><input type="checkbox" name="total_expense" id="checkAll"/> <?php }else{ } ?>  Check All</th>

    <th>Expense Type Name</th>
    <th>Expense Amount</th>
    <th>Expense Date</th>
    <th>Approval Status</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody>
  <?php
$i=1;
foreach($expense_details as $ed)
{
$expense_date = $ed['expense_date'];
$date = date("d-m-Y", strtotime($expense_date));
$status = $ed['status'];
if($status == 1)
{
   $statusvalue = 'Forwarded';

}
else if($status == 2)
{
  $statusvalue = 'Approved';
}

$get_expense_type = select_data(EXPENSE_TYPE_MASTER, "where expense_type_id='".$ed['expense_type_id']."'");
?>
<tr>
  <td> <?php  if($status == 1)
{ ?>

<input type="checkbox" name="expense_id[]" value="<?php echo $ed['expense_id']; ?>" id="checkItem" />

<?php } ?>

</td>
  <td><?php echo $get_expense_type[0]['expense_type_name']; ?></td>
  <td><?php echo $ed['expense_amount']; ?>.Rs</td>
  <td><?php echo $date; ?></td>
  <td><?php echo $statusvalue; ?></td>

  <td>
  <?php if($session_role_id == 1) {?>

<?php if($status == 1 || $status == 2){ ?>
<a href="dashboard_expense_add.php?b_id=<?php echo $branch_id?>&amp;action=edit&amp;expense_id=<?php echo $ed['expense_id']; ?>"><span class="label label-success">EDIT</span></a> &nbsp;
<?php }else{  ?>
-
<?php } ?>         


 <?php }else{ ?>
<a href="#"><span class="btn-sm btn-success"><i class="fas fa-eye"></i></span></a> &nbsp;
   <?php
 } ?>
 
  </td>
</tr>
<?php  $i++; } ?>
  </tbody>
 
</table>
</div>
<!-- /.card-body -->
<div class="card-footer">
      <div id="inner">

<?php if(count($expense_details)>0){?>
      <button type="submit" class="btn-sm btn-success" id="submit" name="approve_all">Approve All</button>
<?php } ?>
      </div>
</div>


</form>
              


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



<?php } ?>
 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>


 <script>
 $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
 </script>

</body>
</html>
