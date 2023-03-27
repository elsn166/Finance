<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_branch_id = $_SESSION['bid'];

$nominee_name='';
$nominee_mob_no='';
$relation_id="";

$session_role_id=$_SESSION['role_id'];

if($session_role_id==1)
{
  $disabled="";
}
else{
  if(isset($_GET['action']) && $_GET['action']=='view'){ 
    $disabled = "disabled";
  }
  else{
    $disabled="";
  }
}

if(isset($_GET['account_id']) && $_GET['account_id']!="" )
{
    $account_id=$_GET['account_id'];
    $account_details=select_data(ACCOUNT_MASTER,"where account_id='$account_id' ");
    $nominee_name=$account_details[0]['nominee_name'];
    $nominee_mob_no=$account_details[0]['nominee_mob_no'];
    // if($nominee_dob!=""){ 
    //   $nominee_dob = date("d-m-Y", strtotime($nominee_dob));
    //   }
    $relation_id=$account_details[0]['relation_id'];
    
}


if(isset($_POST['update']))
{
  $nominee_name=$_POST['nominee_name'];
  $nominee_mob_no=$_POST['nominee_mob_no'];
  $relation_id = $_POST['relation_id'];
  
  // if($nominee_dob!=""){ 
  //   $nominee_dob = date("Y-m-d", strtotime($nominee_dob));
  // }
  $data['nominee_name']=$nominee_name;
  $data['nominee_mob_no']=$nominee_mob_no;
  $data['relation_id']=$relation_id;
 

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $accountlist = select_data(ACCOUNT_MASTER," where account_id='".$_GET['account_id']."'");
  $acctdate = $accountlist[0]['date'];
  $acctnumber = $accountlist[0]['account_no'];
  if($acctdate != '')
  {
    $acctdateval =  explode("-",$acctdate);
    $cur_year =$acctdateval[0];
    $cur_mon = $acctdateval[1];
    $cur_date = $acctdateval[2];
  }
  else{
    $acctdate = date('Y-m-d');
    $cur_year = date('y');
    $cur_mon = date('m');
    $cur_date = date('d');
  
  }
  
  $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$accountlist[0]['customer_id']."'");
  $branchlist=select_data(BRANCH_MASTER," where branch_id='".$customerlist[0]['branch_id']."'");
  $branch_code = $branchlist[0]['branch_code'];

  $planlist=select_data(PLAN_MASTER," where plan_id='".$accountlist[0]['plan_id']."'");
  $plan_code = $planlist[0]['plan_code'];

  

  // generating account number only for the first time

   if($acctnumber == '')
   {

    $acctplanid = $accountlist[0]['plan_id'];
    $acct_details=select_data(ACCOUNT_MASTER,"where plan_id='$acctplanid' and branch_id='$session_branch_id' ORDER BY account_id ASC");
    $count_val = count($acct_details);

    if($count_val==0)
    {
      $acc_no = $plan_code.$branch_code.$cur_date.$cur_mon.$cur_year."00001";
    $ref_no = $plan_code."-".$branch_code."-".$cur_date."-".$cur_mon."-".$cur_year."-"."00001";
    }
    else
    {
      $accid = $_GET['account_id'];
      $ref_acc_no = get_last_acc_no($accid,$session_branch_id,$acctplanid);
      $accno = explode("-",$ref_acc_no);
    
      $new_acc_no = str_pad($accno[5] + 1, 5, 0, STR_PAD_LEFT);

      $acc_no = $plan_code.$branch_code.$cur_date.$cur_mon.$cur_year.$new_acc_no;
      $ref_no = $plan_code."-".$branch_code."-".$cur_date."-".$cur_mon."-".$cur_year."-".$new_acc_no;
    }


    $data['account_no'] = $acc_no;
    $data['ref_acc_no'] = $ref_no;


     //insert into savings renewal table with this initial amt value
     $customer_id=$accountlist[0]['customer_id'];
     $account_id= $_GET['account_id'];
     $savings_renewal_amt= $accountlist[0]['amount'];
     $savings_renewal_date= $acctdate;
     $status = 1;
 
     $savdata['customer_id']=$customer_id;
     $savdata['account_id'] = $account_id;
     $savdata['renewal_amt'] = $savings_renewal_amt;
     $savdata['renewal_date'] = $savings_renewal_date;
     $savdata['status'] = $status;
     $savdata['default_entry'] = 1;
     $savdata['created_date']= date("Y-m-d H:i:s");
     $savdata['created_by']=$userid;
 
     $insert=insert_data(SAVINGS_RENEWAL,$savdata); 


      $acc_id = $_GET['account_id'];
      $acc_details=select_data(ACCOUNT_MASTER,"where account_id='$acc_id' ");
      $account_date = $acc_details[0]['date'];
      $account_amt = $acc_details[0]['amount'];
      //check whether for expense date entry exists in tally list table
      $get_tally_details = select_data(TALLY_MASTER,"where date='".$account_date."' and branch_id='".$session_branch_id."'");
      
      if(count($get_tally_details )>0)
      {

        $acc_details=select_data(TALLY_MASTER,"where date='".$account_date."' and branch_id='".$session_branch_id."'");
        $accamt=$acc_details[0]['account_amt'];
        $new_acc_amt = $account_amt;
        // $accdata['account_amt']=$accamt+$new_acc_amt;
        // $updatetally=update_data(TALLY_MASTER,$accdata,"date",$account_date);
        $naccamt = $accamt+$new_acc_amt;
        $update_tallyqry="UPDATE ".TALLY_MASTER." set account_amt='$naccamt' where date='$account_date' and branch_id='$session_branch_id'";
        $updatetally = mysqli_query($CN,$update_tallyqry);

      }
      else{

        $accdata['account_amt']=$account_amt;
        $accdata['date'] = $account_date;
        $accdata['branch_id'] = $session_branch_id;
        $insert=insert_data(TALLY_MASTER,$accdata); 

      }

}
// generating account number only for the first time


   

    $update=update_data(ACCOUNT_MASTER,$data,"account_id",$_GET['account_id']);
    if($update!=0)
    { 

      // echo "<script type='text/javascript'>window.location='account_nominee.php?account_id=".$_GET['account_id']."&success=Details Updated Successfully';</script>";

      echo "<script type='text/javascript'>window.location='account_view.php?success=Details Updated Successfully';</script>";
    }
        
}


 
?>
<style>
.invalid-feedback {
    display: inline;
    margin-left: 130px;
    font-size: 14px;
}
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
            <h1>Account Details</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

    <?php  include("account_leftmenu.php"); ?>

      <!-- left column -->
      <div class="col-md-9">
           
    <!-- Horizontal Form -->
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Nominee Details</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">


<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>

        <div class="card-body">
       

        <div class="form-group row">
            <label for="customer_id" class="col-sm-2 col-form-label">Nominee Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="nominee_name" class="form-control" id="nominee_name" placeholder="Enter Nominee Name" value="<?php echo $nominee_name; ?>" <?php echo $disabled; ?>/>
            </div>
        </div>


       
       <!-- <div class="form-group row">
            <label for="employee_name" class="col-sm-2 col-form-label">Date Of Birth<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="nominee_dob" class="form-control" id="nominee_dob" placeholder="Select Date Of Birth" value="<?php //echo $nominee_dob; ?>" />
            </div>
          </div> -->

          <div class="form-group row">
            <label for="mobile_number" class="col-sm-2 col-form-label">Mobile Number<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="nominee_mob_no" class="form-control" id="nominee_mob_no" placeholder="Enter Mobile Number" value="<?php echo $nominee_mob_no; ?>" <?php echo $disabled; ?>/>
            </div>
          </div>


        <div class="form-group row">
            <label for="plan_id" class="col-sm-2 col-form-label">Type Of Relation<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="relation_id" class="form-control" id="relation_id" <?php echo $disabled; ?>>
              <option value="">Select</option>
              <?php
             $relation_list=select_data(TYPE_MASTER," where category='relation'");
             foreach($relation_list as $rl)
             {
             ?>
               <option value="<?php echo $rl['type_id'];?>" <?php if($relation_id == $rl['type_id']){ echo 'selected'; } ?>><?php echo $rl['type_name'];?></option>
               <?php  
             }
             ?>
              </select>
            </div>
        </div>


         

  
          
        </div>
        <!-- /.card-body -->
        <br>
              <br>
        <div class="card-footer">

        <div id="inner">

        <?php if(!isset($_GET['action'])){  ?>
            <?php if(!isset($_GET['account_id'])) { ?>
              <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
                    <?php } else { ?>
            <button type="submit" class="btn-sm btn-success" id="submit" name="update" >Update</button>
                          <?php } ?>
              <a href=""><button type="button" class="btn-sm btn-default">Cancel</button></a>
          
            <?php  } ?>
            
          </div>

          <!-- <button type="submit" name="submit" class="btn btn-success">Submit</button> -->
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

<link rel="stylesheet" href="dist/css/jquery-ui.css">

 <script>

 $(function () {
     $("#form1").validate({
rules: { 
  nominee_name: { required: true},
  nominee_mob_no: {required: true,
  number: true },
  relation_id: {required: true },
  
},
messages: {
  nominee_name: { required: 'Please Enter Nominee Name'},
  nominee_mob_no: {required: 'Please Enter Mobile Number' },
  relation_id: {required: 'Please Select Type of Relation' },
  
 
 
},
errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }

});
    });
 
 $(function() {
  $( "#nominee_dob" ).datepicker({
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
