<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];

$role_id='';
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
$checked15="";


if(isset($_GET['action']) && $_GET['action']=="edit" )
{
    $privilege_id=$_GET['privilege_id'];
    $privilege_details=select_data(ROLE_PRIVILEGE,"where privilege_id='$privilege_id' ");
    $role_id=$privilege_details[0]['role_id'];
    $modules_ids=$privilege_details[0]['module_id'];
    $modules = explode(',',$modules_ids);

    for($j = 0;$j<count($modules);$j++){
      $module_id = $modules[$j];
      if($module_id==1)
      {
        $checked1="checked";
      }
      else if($module_id==2)
      {
        $checked2="checked";
      }
      else if($module_id==3)
      {
        $checked3="checked";
      }
      else if($module_id==4)
      {
        $checked4="checked";
      }
      else if($module_id==5)
      {
        $checked5="checked";
      }
      else if($module_id==6)
      {
        $checked6="checked";
      }
      else if($module_id==7)
      {
        $checked7="checked";
      }
      else if($module_id==8)
      {
        $checked8="checked";
      }
      else if($module_id==9)
      {
        $checked9="checked";
      }
      else if($module_id==10)
      {
        $checked10="checked";
      }
      else if($module_id==11)
      {
        $checked11="checked";
      }
      else if($module_id==12)
      {
        $checked12="checked";
      }
      else if($module_id==13)
      {
        $checked13="checked";
      }
      else if($module_id==14)
      {
        $checked14="checked";
      }
      else if($module_id==15)
      {
        $checked15="checked";
      }
    }

    // if(1 in $modules_ids)
    // {
    //   $checked="checked";
    // }
   
}


if(isset($_POST['update']))
{
  // print_r($_POST);
  $modules=array();
   $role_id=$_POST['hidden_role_id'];

   if(isset($_POST['member_details']))
   {
      $member_details = $_POST['member_details'];
      if($member_details == 1)
      {
      array_push($modules,'1');
      }
   }
   
   if(isset($_POST['member_creation']))
   {
   $member_creation = $_POST['member_creation'];
   if($member_creation == 1)
   {
    array_push($modules,'2');
   }
   } 


   if(isset($_POST['account_details']))
   {
   $account_details = $_POST['account_details'];
   if($account_details == 1)
   {
    array_push($modules,'3');
   }
   } 


   if(isset($_POST['account_creation']))
   {
   $account_creation = $_POST['account_creation'];
   if($account_creation == 1)
   {
    array_push($modules,'4');
   }
   } 


   if(isset($_POST['loan_details']))
   {
   $loan_details = $_POST['loan_details'];
   if($loan_details == 1)
   {
    array_push($modules,'5');
   }
   }
   
   if(isset($_POST['loan_creation']))
   {
   $loan_creation = $_POST['loan_creation'];
   if($loan_creation == 1)
   {
    array_push($modules,'6');
   }
   } 

   if(isset($_POST['savings_renewal']))
   {
   $savings_renewal = $_POST['savings_renewal'];
   if($savings_renewal == 1)
   {
    array_push($modules,'7');
   }
   } 

   if(isset($_POST['loan_renewal']))
   {
   $loan_renewal = $_POST['loan_renewal'];
   if($loan_renewal == 1)
   {
    array_push($modules,'8');
   }
   } 

   if(isset($_POST['maturity']))
   {
   $maturity = $_POST['maturity'];
   if($maturity == 1)
   {
    array_push($modules,'9');
   }
   } 


   if(isset($_POST['prematurity']))
   {
   $prematurity = $_POST['prematurity'];
   if($prematurity == 1)
   {
    array_push($modules,'10');
   }
   } 

   if(isset($_POST['daily_expense']))
   {
   $daily_expense = $_POST['daily_expense'];
   if($daily_expense == 1)
   {
    array_push($modules,'11');
   }
   } 

   if(isset($_POST['account_tally']))
   {
   $account_tally = $_POST['account_tally'];
   if($account_tally == 1)
   {
    array_push($modules,'12');
   }
   } 

   if(isset($_POST['renewal_sheet']))
   {
   $renewal_sheet = $_POST['renewal_sheet'];
   if($renewal_sheet == 1)
   {
    array_push($modules,'13');
   }
   }
   
   
   if(isset($_POST['pass_book']))
   {
   $pass_book = $_POST['pass_book'];
   if($pass_book == 1)
   {
    array_push($modules,'14');
   }
   } 



   if(isset($_POST['daily_income']))
   {
   $daily_income = $_POST['daily_income'];
   if($daily_income == 1)
   {
    array_push($modules,'15');
   }
   } 

  $module_id = implode(',',$modules);
  
  $data['module_id'] = $module_id;

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $update=update_data(ROLE_PRIVILEGE,$data,"role_id",$role_id);
  if($update!=0)
  { 
      echo "<script type='text/javascript'>window.location='view_privilege.php?success= Updated Successfully';</script>";
  }
        
}


 if(isset($_POST['submit']))
 {
  
   $modules=array();
   $role_id=$_POST['role_id'];

   if(isset($_POST['member_details']))
   {
      $member_details = $_POST['member_details'];
      if($member_details == 1)
      {
      array_push($modules,'1');
      }
   }
   
   if(isset($_POST['member_creation']))
   {
   $member_creation = $_POST['member_creation'];
   if($member_creation == 1)
   {
    array_push($modules,'2');
   }
   } 


   if(isset($_POST['account_details']))
   {
   $account_details = $_POST['account_details'];
   if($account_details == 1)
   {
    array_push($modules,'3');
   }
   } 


   if(isset($_POST['account_creation']))
   {
   $account_creation = $_POST['account_creation'];
   if($account_creation == 1)
   {
    array_push($modules,'4');
   }
   } 


   if(isset($_POST['loan_details']))
   {
   $loan_details = $_POST['loan_details'];
   if($loan_details == 1)
   {
    array_push($modules,'5');
   }
   }
   
   if(isset($_POST['loan_creation']))
   {
   $loan_creation = $_POST['loan_creation'];
   if($loan_creation == 1)
   {
    array_push($modules,'6');
   }
   } 

   if(isset($_POST['savings_renewal']))
   {
   $savings_renewal = $_POST['savings_renewal'];
   if($savings_renewal == 1)
   {
    array_push($modules,'7');
   }
   } 

   if(isset($_POST['loan_renewal']))
   {
   $loan_renewal = $_POST['loan_renewal'];
   if($loan_renewal == 1)
   {
    array_push($modules,'8');
   }
   } 

   if(isset($_POST['maturity']))
   {
   $maturity = $_POST['maturity'];
   if($maturity == 1)
   {
    array_push($modules,'9');
   }
   } 


   if(isset($_POST['prematurity']))
   {
   $prematurity = $_POST['prematurity'];
   if($prematurity == 1)
   {
    array_push($modules,'10');
   }
   } 

   if(isset($_POST['daily_expense']))
   {
   $daily_expense = $_POST['daily_expense'];
   if($daily_expense == 1)
   {
    array_push($modules,'11');
   }
   } 

   if(isset($_POST['account_tally']))
   {
   $account_tally = $_POST['account_tally'];
   if($account_tally == 1)
   {
    array_push($modules,'12');
   }
   } 

   if(isset($_POST['renewal_sheet']))
   {
   $renewal_sheet = $_POST['renewal_sheet'];
   if($renewal_sheet == 1)
   {
    array_push($modules,'13');
   }
   } 

   if(isset($_POST['pass_book']))
   {
   $pass_book = $_POST['pass_book'];
   if($pass_book == 1)
   {
    array_push($pass_book,'14');
   }
   } 
   if(isset($_POST['daily_income']))
   {
   $daily_income = $_POST['daily_income'];
   if($daily_income == 1)
   {
    array_push($modules,'15');
   }
   } 
  

  $module_id = implode(',',$modules);
  $data['role_id']=$role_id;
  $data['module_id'] = $module_id;
 
  $data['created_date']= date("Y-m-d H:i:s");
  $data['created_by']=$userid;

  $insert=insert_data(ROLE_PRIVILEGE,$data); 

  if($insert!=0)
  { 
      echo "<script type='text/javascript'>window.location='view_privilege.php?success= Added Successfully';</script>";
          
  }
         
 }
?>
<style>
#inner {
    display: table;
    margin: 0 auto;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Role Privilege</h1>
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
        <h3 class="card-title">Role Privilege</h3>

        <a class="btn-sm btn-success float-right" href="view_privilege.php">Back</a>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">

        <div class="card-body">

          <div class="form-group row">
            <label for="role_id" class="col-sm-2 col-form-label">Select Role Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <?php if(isset($_GET['action']) && $_GET['action']=="edit" )
              { ?>

              <select name="role_id" class="form-control" id="role_id" disabled>
                <option value="">Select</option>
              <?php
              $role_list=select_data(ROLE," where role_name!='Admin' ORDER BY role_id  ASC");
              foreach($role_list as $rl)
              {
              ?>
                <option value="<?php echo $rl['role_id'];?>" <?php if($role_id == $rl['role_id']){ echo 'selected'; } ?>><?php echo $rl['role_name'];?></option>
                <?php  
              }
              ?>
              </select>

              <input type="hidden" name="hidden_role_id" value="<?php echo $role_id; ?>">
              <?php }else{ ?>

                <select name="role_id" class="form-control" id="role_id">
                <option value="">Select</option>
              <?php
              $role_list=select_data(ROLE," where role_name!='Admin' ORDER BY role_id  ASC");
              foreach($role_list as $rl)
              {
              ?>
                <option value="<?php echo $rl['role_id'];?>" <?php if($role_id == $rl['role_id']){ echo 'selected'; } ?>><?php echo $rl['role_name'];?></option>
                <?php  
              }
              ?>
              </select>
              <?php } ?>
             
            </div>
          </div>

         <!-- iCheck -->
         <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Select Modules List </h3>
              </div>
              <div class="card-body">
                <!-- Minimal style -->
                <div class="row">
                  <div class="col-sm-6">

                    <!-- checkbox -->
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">

                        <input type="checkbox" id="checkboxSuccess1" name="member_details" value="1" <?php echo $checked1; ?>/>
                        <label for="checkboxSuccess1">Member Details
                        </label>
                      </div></div>

                      <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess2" name="member_creation" value="1" <?php echo $checked2; ?>/>
                        <label for="checkboxSuccess2">Member Creation
                        </label>
                      </div>
                      </div>

                      <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess3" name="account_details" value="1" <?php echo $checked3; ?>/>
                        <label for="checkboxSuccess3">Account Details
                        </label>
                      </div>
                    </div>

                     <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess4" name="account_creation" value="1" <?php echo $checked4; ?>/>
                        <label for="checkboxSuccess4">Account Creation
                        </label>
                      </div>
                    </div>

                      <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess5" name="loan_details" value="1" <?php echo $checked5; ?>/> 
                        <label for="checkboxSuccess5">Loan Details
                        </label>
                      </div>
                    </div>


                    <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess6" name="loan_creation" value="1" <?php echo $checked6; ?>/>
                        <label for="checkboxSuccess6">Loan Creation
                        </label>
                      </div>
                    </div>

                  
                     <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess7" name="savings_renewal" value="1" <?php echo $checked7; ?>/>
                        <label for="checkboxSuccess7">Savings Renewal
                        </label>
                      </div>
                    </div>

                     <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess8" name="loan_renewal" value="1" <?php echo $checked8; ?>/>
                        <label for="checkboxSuccess8">Loan Renewal
                        </label>
                      </div>
                    </div>

                     <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess9" name="maturity" value="1" <?php echo $checked9; ?>/>
                        <label for="checkboxSuccess9">Maturity
                        </label>
                      </div>
                    </div>

                     <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess10" name="prematurity" value="1" <?php echo $checked10; ?> />
                        <label for="checkboxSuccess10">PreMaturity
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess11" name="daily_expense" value="1" <?php echo $checked11; ?> />
                        <label for="checkboxSuccess11">Daily Expense
                        </label>
                      </div>
                    </div>

                     <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess12" name="account_tally" value="1" <?php echo $checked12; ?>/>
                        <label for="checkboxSuccess12">Account Tally
                        </label>
                      </div>
                    </div>

                     <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess13" name="renewal_sheet" value="1" <?php echo $checked13; ?>/>
                        <label for="checkboxSuccess13">Renewal Sheet
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess14" name="pass_book" value="1" <?php echo $checked14; ?>/>
                        <label for="checkboxSuccess14">Pass Book
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                       <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess15" name="daily_income" value="1" <?php echo $checked15; ?>/>
                        <label for="checkboxSuccess15">Daily Income
                        </label>
                      </div>
                    </div>



                  </div>
             
                  </div>
                </div>
              
                </div>
              </div>
              <!-- /.card-body -->



            <div class="card-footer">

                <div id="inner">
                  <?php if(!isset($_GET['privilege_id'])) { ?>
                    <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
                          <?php } else { ?>
                  <button type="submit" class="btn-sm btn-success" id="submit" name="update" >Update</button>
                                <?php } ?>
                    <a href=""><button type="button" class="btn-sm btn-default">Cancel</button></a>
                </div>

  
            </div>

                    <!-- /.card-footer -->

              
            </div>
            <!-- /.card -->



                    
       
          
        </div>
        <!-- /.card-body -->
      


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
