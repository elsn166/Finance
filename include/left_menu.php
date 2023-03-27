<?php
$filename = curPageName(); 


$session_role_id=$_SESSION['role_id'];
$session_emp_id = $_SESSION['emp_id'];

// fetch image of the employee
$employee_details=select_data(EMPLOYEE_MASTER,"where employee_id='$session_emp_id' ");
$upload_files = $employee_details[0]['upload_files'];


if($session_role_id!=1)
{
$checked1='style="display:none;"';
$checked2='style="display:none;"';
$checked3='style="display:none;"';
$checked4='style="display:none;"';
$checked5='style="display:none;"';
$checked6='style="display:none;"';
$checked7='style="display:none;"';
$checked8='style="display:none;"';
$checked9='style="display:none;"';
$checked10='style="display:none;"';
$checked11='style="display:none;"';
$checked12='style="display:none;"';
$checked13='style="display:none;"';
$checked14='style="display:none;"';
$checked15='style="display:none;"';
}
else
{
$checked1="";
$checked2="";
$checked3="";
$checked4="";
$checked5="";
$checked6="";
$checked7="";
$checked8="";
$checked9="";
$checked10="";
$checked11="";
$checked12="";
$checked13="";
$checked14="";
$checked15='';
}


$fetch_details = select_data(ROLE_PRIVILEGE, "where role_id='".$session_role_id."'");
if(count($fetch_details) > 0)
{
                
               $module_id = $fetch_details[0]['module_id'];
               $modules=explode(',',$module_id);

               for($j = 0;$j<count($modules);$j++){
                $module_id = $modules[$j];
                if($module_id==1)
                {
                  $checked1="";
                }
                else if($module_id==2)
                {
                  $checked2="";
                }
                else if($module_id==3)
                {
                  $checked3="";
                }
                else if($module_id==4)
                {
                  $checked4="";
                }
                else if($module_id==5)
                {
                  $checked5="";
                }
                else if($module_id==6)
                {
                  $checked6='';
                }
                else if($module_id==7)
                {
                  $checked7='';
                }
                else if($module_id==8)
                {
                  $checked8='';
                }
                else if($module_id==9)
                {
                  $checked9='';
                }
                else if($module_id==10)
                {
                  $checked10='';
                }
                else if($module_id==11)
                {
                  $checked11='';
                }
                else if($module_id==12)
                {
                  $checked12='';
                }
                else if($module_id==13)
                {
                  $checked13='';
                }
                else if($module_id==14)
                {
                  $checked14='';
                }
                else if($module_id==15)
                {
                  $checked15='';
                }
              }


}
         

?>
<style>
/*1c6b31 *//*ff730c*/
 /* .main-sidebar { background-color:#28a745 !important; } */

 /* .main-sidebar { background-color:#f4f6f9 !important; } */

 /* .main-sidebar { background-color:#222d32 !important; } */

 .main-sidebar { background-color:#fff !important; }
 
 .navbar-white {
    background-color: #28a745 !important;
}
.navbar-light .navbar-nav .nav-link {
    color:white!important;
}
[class*=sidebar-dark] .brand-link {
    border-bottom: px solid #4b545c;
    color:green!important;
}

[class*=sidebar-dark-] .sidebar a {
    color: green;
}

[class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item:hover>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link:focus {
    background-color: rgba(255,255,255,.1);
    color: green;
}
[class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link {
    color: green!important;
}

.user-panel img {
    height: 30px!important;
}

</style>
   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="images/ADN.png" alt="Amudhini" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text" style="font-weight:600;">Amudhini Co-op</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">

          <?php if($upload_files != '') {?>

            <img src="uploads/<?php echo $upload_files; ?>" class="img-circle elevation-2" alt="User Image">

          <?php }else{  ?>

            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
<?php } ?>

        </div>
        <div class="info">
        <?php 
          $empname = ucwords(strtolower($_SESSION['emp_name']));
           ?>
          <a href="#" class="d-block" style="font-weight:600;color:green;"><?php echo $empname; ?></a> 
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
          <a href="dashboard.php" class="nav-link">
              <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <!-- <ion-icon name="reorder-four-sharp"></ion-icon> -->
              <p style="font-weight:600;">
                Dashboard
              </p>
            </a>


          </li>
          <?php if($_SESSION['role_id']==1) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Common Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" <?php if( $filename == 'plan_view.php' || $filename == 'plan_add.php' )?>>

              <li class="nav-item" <?php if($filename == 'plan_view.php' || $filename == 'plan_add.php' ){ echo 'active';}?>>
                <a href="plan_view.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Plan Master</p>
                </a>
              </li>


              <li class="nav-item" <?php if($filename == 'income_type_view.php' || $filename == 'income_type_add.php' ){ echo 'active';}?>>
                <a href="income_type_view.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Income Master</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="expense_type_view.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Expense Master</p>
                </a>
              </li>


              <li class="nav-item" <?php if($filename == 'view_privilege.php' ){ echo 'active';}?>>
                <a href="view_privilege.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Role Privilege Master</p>
                </a>
              </li>


                <li class="nav-item" <?php if($filename == 'employee_view.php' ){ echo 'active';}?>>
                <a href="employee_view.php" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                    <p>Employee Creation</p>
                </a>
                </li>

                <li class="nav-item" <?php if($filename == 'occupation_view.php' ){ echo 'active';}?>>
                <a href="occupation_view.php" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                    <p>Occupation Master</p>
                </a>
                </li>
                
                 <li class="nav-item" <?php if($filename == 'occupation_view.php' ){ echo 'active';}?>>
                <a href="loan_add.php" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                    <p>Loan Master</p>
                </a>
                </li>

              
            </ul>
          </li>

            
          <?php } ?>
         


      

         <li class="nav-item"<?php echo $checked1; ?>>
          <a href="member_view.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Member Details</p>
          </a>
          </li>



          <li class="nav-item" <?php echo $checked2; ?>>
          <a href="member_profile.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Member Creation</p>
          </a>
          </li>

          

          <li class="nav-item" <?php echo $checked3; ?>>
          <a href="account_view.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Account Details</p>
          </a>
          </li>

          <li class="nav-item" <?php echo $checked4; ?>>
          <a href="account_profile.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Account Creation</p>
          </a>
          </li>

          <li class="nav-item" <?php echo $checked5; ?>>
          <a href="loan_view.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Loan Details</p>
          </a>
          </li>

          <li class="nav-item" <?php echo $checked6; ?>>
          <a href="loan_profile.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Loan Creation</p>
          </a>
          </li>
           <?php if($_SESSION['role_id']==1 || $_SESSION['role_id']==2 || $_SESSION['role_id']==9 || $_SESSION['role_id']==3) { ?>
          <li class="nav-item"  >
          <a href="customer_history.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Customer History</p>
          </a>
          </li>
                    <?php } ?>

          <li class="nav-item" <?php echo $checked7; ?>>
          <a href="view_savings_renewal.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Savings Renewal</p>
          </a>
          </li>
          <li class="nav-item" <?php echo $checked8; ?>>
          <a href="view_loan_renewal.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Loan Renewal</p>
          </a>
          </li>
          <li class="nav-item" <?php echo $checked9; ?>>
          <a href="view_maturity.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Maturity</p>
          </a>
          </li>
          <li class="nav-item" <?php echo $checked10; ?>>
          <a href="view_prematurity.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Pre-Maturity</p>
          </a>
          </li>
          <li class="nav-item" <?php echo $checked11; ?>>
          <a href="expense_view.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Daily Expense</p>
          </a>
          </li>

          <li class="nav-item" <?php echo $checked15; ?>>
          <a href="income_view.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Daily Income</p>
          </a>
          </li>

          <li class="nav-item" <?php echo $checked12; ?>>
          <a href="daily_account_list.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Account Tally</p>
          </a>
          </li>
          <li class="nav-item" <?php echo $checked13; ?>>
          <a href="view_renewal_sheet.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Renewal Sheet</p>
          </a>
          </li>

          <li class="nav-item" <?php echo $checked14; ?>>
          <a href="view_passbook.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Pass Book</p>
          </a>
          </li>

         
          




          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" <?php if( $filename == 'savings_renewal_report.php' || $filename == 'savings_renewal_report.php' )?>>

              <li class="nav-item" <?php if($filename == 'savings_renewal_report.php' || $filename == 'savings_renewal_report.php' ){ echo 'active';}?>>
                <a href="savings_renewal_report.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Savings Renewal Report</p>
                </a>
              </li>
              
                <li class="nav-item" <?php if($filename == 'total_income_report.php' || $filename == 'total_income_report.php' ){ echo 'active';}?>>
                <a href="total_income_report.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Income Report</p>
                </a>
              </li>


              <li class="nav-item" <?php if($filename == 'loan_renewal_report.php' || $filename == 'loan_renewal_report.php' ){ echo 'active';}?>>
                <a href="loan_renewal_report.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Loan Renewal Report</p>
                </a>
              </li>
              <li class="nav-item" <?php if($filename == 'loan_report.php' || $filename == 'loan_report.php' ){ echo 'active';}?>>
                <a href="loan_report.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Loan Report</p>
                </a>
              </li>
              <li class="nav-item" <?php if($filename == 'maturity_pre_report.php' || $filename == 'maturity_pre_report.php' ){ echo 'active';}?>>
                <a href="maturity_pre_report.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Maturity Pre Report</p>
                </a>
              </li>


              <li class="nav-item" <?php if($filename == 'maturity_report.php' || $filename == 'maturity_report.php' ){ echo 'active';}?>>
                <a href="maturity_report.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Maturity Report</p>
                </a>
              </li>

              <li class="nav-item" <?php if($filename == 'prematurity_report.php' || $filename == 'prematurity_report.php' ){ echo 'active';}?>>
                <a href="prematurity_report.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>PreMaturity Report</p>
                </a>
              </li>

              <li class="nav-item" <?php if($filename == 'expense_report.php' || $filename == 'expense_report.php' ){ echo 'active';}?>>
                <a href="expense_report.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Expense Report</p>
                </a>
              </li>


              
            </ul>
          </li>


        
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>