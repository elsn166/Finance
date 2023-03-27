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

$loan_details_one=select_data(LOAN_MASTER,"where status=2 and branch_id=1 ORDER BY loan_id ASC");
$loan_count_one = count($loan_details_one);

$loan_details_two=select_data(LOAN_MASTER,"where status=2 and branch_id=2 ORDER BY loan_id ASC");
$loan_count_two = count($loan_details_two);

$loan_details_three=select_data(LOAN_MASTER,"where status=2 and branch_id=3 ORDER BY loan_id ASC");
$loan_count_three = count($loan_details_three);

$loan_details_four=select_data(LOAN_MASTER,"where status=2 and branch_id=4 ORDER BY loan_id ASC");
$loan_count_four = count($loan_details_four);


if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
        {
            $date1 = date('Y-m-d');
//  echo $date1;
       $loan_details_closing=select_data(LOAN_MASTER,"where status!='4' and closing_before3_days<='$date1' and loan_closing_date!='0000-00-00' ORDER BY loan_id DESC");
        $loan_closing_count = count($loan_details_closing);
            
        }
        else{
             $date1 = date('Y-m-d');
     $loan_details_closing=select_data(LOAN_MASTER,"where status!='4' and branch_id='".$session_branch_id."' and closing_before3_days<='$date1' and loan_closing_date!='0000-00-00' ORDER BY loan_id DESC"); 
       $loan_closing_count = count($loan_details_closing);
        }
        


$expense_details_one=select_data(EXPENSE_MASTER,"where status=1 and branch_id=1 ORDER BY expense_id ASC");
$expense_count_one = count($expense_details_one);

$expense_details_two=select_data(EXPENSE_MASTER,"where status=1 and branch_id=2 ORDER BY expense_id ASC");
$expense_count_two = count($expense_details_two);

$expense_details_three=select_data(EXPENSE_MASTER,"where status=1 and branch_id=3 ORDER BY expense_id ASC");
$expense_count_three = count($expense_details_three);

$expense_details_four=select_data(EXPENSE_MASTER,"where status=1 and branch_id=4 ORDER BY expense_id ASC");
$expense_count_four = count($expense_details_four);

$maturity_details_one=select_data(ACCOUNT_MASTER,"where status=2 and maturity_acct=1 and branch_id=1 ORDER BY account_id ASC");
$maturity_count_one = count($maturity_details_one);

$maturity_details_two=select_data(ACCOUNT_MASTER,"where status=2 and maturity_acct=1 and branch_id=2 ORDER BY account_id ASC");
$maturity_count_two = count($maturity_details_two);

$maturity_details_three=select_data(ACCOUNT_MASTER,"where status=2 and maturity_acct=1 and branch_id=3 ORDER BY account_id ASC");
$maturity_count_three = count($maturity_details_three);

$maturity_details_four=select_data(ACCOUNT_MASTER,"where status=2 and maturity_acct=1 and branch_id=4 ORDER BY account_id ASC");
$maturity_count_four = count($maturity_details_four);


$pre_maturity_details_one=select_data(ACCOUNT_MASTER,"where status=2 and prematurity_acct=1 and branch_id=1 ORDER BY account_id ASC");
$pre_maturity_count_one = count($pre_maturity_details_one);

$pre_maturity_details_two=select_data(ACCOUNT_MASTER,"where status=2 and prematurity_acct=1 and branch_id=2 ORDER BY account_id ASC");
$pre_maturity_count_two = count($pre_maturity_details_two);

$pre_maturity_details_three=select_data(ACCOUNT_MASTER,"where status=2 and prematurity_acct=1 and branch_id=3 ORDER BY account_id ASC");
$pre_maturity_count_three = count($pre_maturity_details_three);

$pre_maturity_details_four=select_data(ACCOUNT_MASTER,"where status=2 and prematurity_acct=1 and branch_id=4 ORDER BY account_id ASC");
$pre_maturity_count_four = count($pre_maturity_details_four);

$loan_closed_one=select_data(LOAN_MASTER,"where status=4 and branch_id=1 ORDER BY loan_id ASC");
$loan_close_one = count($loan_closed_one);

$loan_closed_two=select_data(LOAN_MASTER,"where status=4 and branch_id=2 ORDER BY loan_id ASC");
$loan_close_two = count($loan_closed_two);

$loan_closed_three=select_data(LOAN_MASTER,"where status=4 and branch_id=3 ORDER BY loan_id ASC");
$loan_close_three = count($loan_closed_three);

$loan_closed_four=select_data(LOAN_MASTER,"where status=4 and branch_id=4 ORDER BY loan_id ASC");
$loan_close_four = count($loan_closed_four);

$loan_closed_one=select_data(LOAN_MASTER,"where status=5 and branch_id=1 ORDER BY loan_id ASC");
$loan_fwdclose_one = count($loan_closed_one);

$loan_closed_two=select_data(LOAN_MASTER,"where status=5 and branch_id=2 ORDER BY loan_id ASC");
$loan_fwdclose_two = count($loan_closed_two);

$loan_closed_three=select_data(LOAN_MASTER,"where status=5 and branch_id=3 ORDER BY loan_id ASC");
$loan_fwdclose_three = count($loan_closed_three);

$loan_closed_four=select_data(LOAN_MASTER,"where status=5 and branch_id=4 ORDER BY loan_id ASC");
$loan_fwdclose_four = count($loan_closed_four);


$loan_closing_details_one=select_data(LOAN_MASTER,"where branch_id=1 ORDER BY loan_id ASC");
$loan_closing_count_one = count($loan_closing_details_one);

$loan_closing_details_two=select_data(LOAN_MASTER,"where branch_id=2 ORDER BY loan_id ASC");
$loan_closing_count_two = count($loan_closing_details_two);

$loan_closing_details_three=select_data(LOAN_MASTER,"where branch_id=3 ORDER BY loan_id ASC");
$loan_closing_count_three = count($loan_closing_details_three);

$loan_closing_details_four=select_data(LOAN_MASTER,"where branch_id=4 ORDER BY loan_id ASC");
$loan_closing_count_four = count($loan_closing_details_four);

?>
<style>
.fa-stack[data-count]:after{
  position:absolute;
  right:0%;
  top:1%;
  content: attr(data-count);
  font-size:30%;
  padding:.6em;
  border-radius:999px;
  line-height:.75em;
  color: white;
  background:rgba(255,0,0,.85);
  text-align:center;
  min-width:2em;
  font-weight:bold;
  
}
.fa-2x{
    margin-left: 400px;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li> -->
            </ol>
            
           <a  href="loan_closing.php" <span class="fa-stack fa-2x" data-count="<?php echo $loan_closing_count; ?>">
                 <i class="fa fa-circle fa-stack-2x"></i>
                 <i class="fa fa-bell fa-stack-1x fa-inverse"></i>
           </span></a>
           
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->



        <?php if($session_role_id != 1){ ?>
        <div class="row">
       
          <!-- ./col -->
        
          <!-- ./col -->
        <div class="col-md-6">
      
          <img src="images/brochure.jpeg" class="img-circle elevation-2" alt="User Image" style="margin-left:150px;">
       
        </div>


        <div class="col-md-6" style="margin-left: 538px;margin-top: -165px;">
  
         <h5>- Savings Account</h5>
         <h5>- Daily Deposit Account</h5>
         <h5>- Weekly Deposit Account</h5>
         <h5>- Monthly Deposit Account</h5>
         <h5>- Fixed Deposit Account</h5>
        </div>


        </div>

         <div class="row">

       
        <div class="col-md-6" style="margin-left:210px;margin-top:100px;">
       
         <h5>- Gold Loan</h5>
         <h5>- Personal Loan</h5>
         <h5>- Business Loan</h5>
         <h5>- Instant Loan</h5>
        </div>


        <div class="col-md-6">
          <img src="images/gold.jpg" class="img-circle elevation-2" alt="User Image" style="margin-left:520px;margin-top:-160px;">
        </div>


        </div>

<?php }else{ ?>


 <?php if($branch_id==1){ ?>
  <div class="row">


      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">

          <p>Pending For Expense Approval</p>

            <h5>Paramakudi <?php echo $expense_count_one ; ?></h5>

           
          </div>
        
          <a href="dashboard_expense_view.php?b_id=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
     

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <p>Pending For Loan Approval</p>
                <h5>Paramakudi <?php echo $loan_count_one ; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_loan_view.php?b_id=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      <!--  <div class="col-lg-3 col-6"> -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">

          <p>Pending Approval For Loan Closing</p>

            <h5>Paramakudi <?php echo $loan_fwdclose_one; ?></h5>

           
          </div>
        
          <a href="dashboard_loan_closing_view.php?b_id=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      
       <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <p>Pending Approval For Maturity</p>
                <h5>Paramakudi <?php echo $maturity_count_one ; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_maturity_view.php?b_id=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <p>Pending Approval For Pre-Maturity</p>
                <h5>Paramakudi <?php echo $pre_maturity_count_one; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_prematurity_view.php?b_id=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>     

</div>
<?php }else if($branch_id==2){ ?>
<div class="row">


          
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
          <p>Pending For Expense Approval</p>
            <h5>Mudukulathur <?php echo $expense_count_two ; ?></h5>
        </div>
          <!-- <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div> -->
          <a href="dashboard_expense_view.php?b_id=2" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <p>Pending For Loan Approval</p>
                <h5>Mudukulathur <?php echo $loan_count_two ; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_loan_view.php?b_id=2" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      <!--  <div class="col-lg-3 col-6"> -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
          <p>Pending Approval For Loan Closing</p>
            <h5>Mudukulathur <?php echo $loan_fwdclose_two; ?></h5>

           
          </div>
          <!-- <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div> -->
          <a href="dashboard_loan_closing_view.php?b_id=2" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <p>Pending Approval For Maturity</p>
                <h5>Mudukulathur <?php echo $maturity_count_two ; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_maturity_view.php?b_id=2" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <p>Pending Approval For Pre-Maturity</p>
                <h5>Mudukulathur <?php echo  $pre_maturity_count_two; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_prematurity_view.php?b_id=2" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>   
          </div>             
 <?php }else if($branch_id==3){ ?>
  <div class="row">


      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
          <p>Pending For Expense Approval</p>
            <h5>Ramnad <?php echo $expense_count_three ; ?></h5>

          
          </div>
          <!-- <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div> -->
          <a href="dashboard_expense_view.php?b_id=3" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>



      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <p>Pending For Loan Approval</p>
                <h5>Ramnad <?php echo $loan_count_three ; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_loan_view.php?b_id=3" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      <!--  <div class="col-lg-3 col-6"> -->


      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
          <p>Pending Approval For Loan Closing</p>
            <h5>Ramnad <?php echo $loan_fwdclose_three; ?></h5>
          </div>
          <!-- <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div> -->
          <a href="dashboard_loan_closing_view.php?b_id=3" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <p>Pending Approval For Maturity</p>
                <h5>Ramnad <?php echo $maturity_count_three; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_maturity_view.php?b_id=3" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <p>Pending Approval For Pre-Maturity</p>
                <h5>Ramnad <?php echo  $pre_maturity_count_three; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_prematurity_view.php?b_id=3" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            </div>
<?php }else{ ?>
<div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
          <p>Pending For Expense Approval</p>
            <h5>Pudur <?php echo $expense_count_four ; ?></h5>
            
          </div>
          <!-- <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div> -->
          <a href="dashboard_expense_view.php?b_id=4" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <p>Pending For Loan Approval</p>
                <h5>Pudur <?php echo $loan_count_four ; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_loan_view.php?b_id=4" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      <!--  <div class="col-lg-3 col-6"> -->


      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
          <p>Pending Approval For Loan Closing</p>
            <h5>Pudur <?php echo $loan_fwdclose_four ?></h5>
            
          </div>
          <!-- <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div> -->
          <a href="dashboard_loan_closing_view.php?b_id=4" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <p>Pending Approval For Maturity</p>
                <h5>Pudur <?php echo $maturity_count_four ; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_maturity_view.php?b_id=4" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <p>Pending Approval For Pre-Maturity</p>
                <h5>Pudur <?php echo  $pre_maturity_count_four; ?></h5>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="dashboard_prematurity_view.php?b_id=4" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
<?php } ?>
</div>







    


        
          





    


        
          
<?php
} ?>



          <!-- ./col -->
        </div>




        </div>
        <!-- /.row -->

















        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
         
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<br>
<br>

<?php include("include/footer.php"); ?>
<?php include("include/footerjs.php"); ?>
</body>
</html>
