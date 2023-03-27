<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

 include("include/header.php");
 include("include/header_top.php");
 include("include/left_menu.php");
if(isset($_GET['account_id']) && $_GET['account_id']!="" )
 {
 $account_id=$_GET['account_id'];

 $account_details=select_data(LOAN_TERM_MASTER,"where loan_term_id='$account_id' ");

              foreach($account_details as $ad)
              {
                $status = $ad['status'];
                $loan_term = $ad['loan_term_no'];
                $loan_interest = $ad['loan_term_interest'];
                $loan_id = $ad['loan_term_id'];
                $loan_type = $ad['loan_type'];
              }
    $loan_details=select_data(LOAN_TYPE_MASTER,"where loan_type_id='$loan_type'  ");
    $loan_type_id=$loan_details[0]['loan_type_id'];               
 }
 $employee_id='';
 $session_branch_id = $_SESSION['bid'];
 $session_role_id=$_SESSION['role_id'];

  if(isset($_POST['branch_id']))
{
  $branch_id = $_POST['branch_id'];
}
else
{
  $branch_id = "";
}

  if(isset($_POST['expence_id']))
{
 $expense_lists = $_POST['expence_id'];
 
}
else
{
  $expense_lists = "";
}
if(isset($_POST['from_date']))
{
  $from_date = $_POST['from_date'];
}
else
{
  $from_date = "";
}if(isset($_POST['to_date']))
{
  $to_date = $_POST['to_date'];
}
else
{
  $to_date = "";
}
$loan_type_id="";
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


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h3> Update Loan Plan </h3>
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
                <h3 class="card-title">Update Loan Plan</h3>  
             <!--    <a class="btn-sm btn-success float-right" href="expense_report_print.php?" target="_blank">Print</a>-->
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  
                  <!-- <a class="btn-sm btn-success float-right" href="account_profile.php">Add New</a> -->
              </div>
               <form action="loan_addupdate.php" method="POST"  id="form1" name="form1">
               <div class="form-group row">
<label for="loan_term_numupdate" class="col-sm-1 col-form-label mx-3">Loan Term Number<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="loan_term_numupdate" class="form-control my-2" id="loan_term_numupdate" placeholder="Loan Term" value="<?php echo  $loan_term ; ?>" />
</div>
<input type="hidden" name="account_id" class="form-control" id="account_id" placeholder="Loan Term" value="<?php echo  $account_id; ?>" />
<label for="loan_term_intupdate" class="col-sm-1 col-form-label ">Loan Term Interest<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="loan_term_intupdate" class="form-control my-2" id="loan_term_intupdate" placeholder="Loan Interest" value="<?php echo $loan_interest; ?>" >
</div>
</div>


 
  <div class="form-group row">
      <label for="employee_name" class="col-sm-1 col-form-label mx-3">Status<span style="color:red">*</span></label>
            <div class="col-sm-3">
            <select name="status" class="form-control " id="status">
              
              <?php
              $loanterm_list=select_data(LOAN_TERM_MASTER," where loan_term_id='$account_id' ORDER BY loan_term_id ASC");
              foreach($loanterm_list as $ll)
              {
              ?>  <?php
              if($ll['status']==1)
              {$status='Active';
              }else{$status='Inactive';
                  
              }
              ?>
                <option value="<?php echo $ll['status'];?>" <?php if( $loanterm_list== $ll['status']){ echo 'selected'; } ?>><?php echo $status;?></option>
                <?php  
                if($ll['status']==1)
                {?>
                    <option value="0">Inactive</option>
                    <?php
                }else{?>
                     <option value="1">active</option>
              <?php  }?>
             <?php }
              ?>
              </select>
            </div>

            <label for="loan_type" class="col-sm-1 col-form-label ">Loan Type<span style="color:red">*</span></label>
            <div class="col-3">
              <select name="loan_type" class="form-control" id="loan_type" <?php echo $disabled; ?>>
              <option value="">Select Loan Type</option>
              <?php
             $loan_type_list=select_data(LOAN_TYPE_MASTER,"where status='1' ORDER BY loan_type_id  ASC");
             foreach($loan_type_list as $ltl)
             {
             ?>
               <option value="<?php echo $ltl['loan_type_id'];?>" <?php if($loan_type == $ltl['loan_type_id']){ echo 'selected'; } ?>><?php echo $ltl['loan_type_name'];?></option>
               <?php  
             }
             ?>
              </select>
            </div>
        </div>
            <div class="col-sm-3">
           <button type="submit" class="btn-sm btn-success" id="submit">Update</button>
            </div>

      <div class="col-sm-3">
      
      </div>


      </div>


        </form>
 
  
 
  
       

  
  
   

              <!-- /.card-header -->
            
             
 
        <div class="card-body">
              
              
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



 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>
 <link rel="stylesheet" href="dist/css/jquery-ui.css">


</body>
</html>
