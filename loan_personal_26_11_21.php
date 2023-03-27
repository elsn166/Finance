<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_role_id = $_SESSION['role_id'];
$session_branch_id = $_SESSION['bid'];
$customer_id='';

$customer_no="";
$customer_name="";
$mother_name="";
$dob="";
$gender="";
$email="";
$pan_no="";
$aadhar_no="";
$mobile_number="";
$residence_type="";


if(isset($_GET['loan_id']) && $_GET['loan_id']!="" )
{
    $loan_id=$_GET['loan_id'];
    $loan_details=select_data(LOAN_MASTER,"where loan_id='$loan_id' ");
    $customer_id=$loan_details[0]['customer_id'];

    $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$customer_id."'");
    $customer_no = $customerlist[0]['customer_no'];
    $customer_name = $customerlist[0]['customer_name'];
    $mother_name = $customerlist[0]['mother_name'];
    $dob = date("d-m-Y",strtotime($customerlist[0]['dob']));
    $gender_id = $customerlist[0]['gender_id'];
    $genderlist = select_data(TYPE_MASTER," where type_id='".$gender_id."'");
    $gender = $genderlist[0]['type_name'];
    $pan_no = $customerlist[0]['pan_no'];
    $aadhar_no = $customerlist[0]['aadhar_no'];
    $mobile_number = $customerlist[0]['mobile_number'];
    $email = $customerlist[0]['email'];
    $residence_type_id=$customerlist[0]['residence_type_id'];
    if($residence_type_id !='')
    {
      $residencelist = select_data(TYPE_MASTER," where type_id='".$residence_type_id."'");
      $residence_type = $residencelist[0]['type_name'];
    }
    else{
      $residence_type = '-';
    }
    
    $status = $loan_details[0]['status'];
    if($status == 1)
    {
      $disabled = "disabled";
    }
    
    
}


if(isset($_POST['update']))
{
    if($session_role_id == 1)
    {
      $status=3;
    }
    else
    {
      $status=2;
    }
  $data['status']=$status;

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  //if only admin login, generate loan no
  if($session_role_id == 1)
  {

     
  $loanlist=select_data(LOAN_MASTER,"where loan_id='".$_GET['loan_id']."'");

  $loanno = $loanlist[0]['loan_no'];
  $loan_amount = $loanlist[0]['loan_amount'];

  //generate loan number only for the first time
  if($loanno == '')
  { 

    $loan_type_id = $loanlist[0]['loan_type_id'];

  
  $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$loanlist[0]['customer_id']."'");

  
  $branchlist=select_data(BRANCH_MASTER," where branch_id='".$customerlist[0]['branch_id']."'");

  
  $branch_code = $branchlist[0]['branch_code'];
  
  $loantypelist=select_data(LOAN_TYPE_MASTER," where loan_type_id='".$loan_type_id."'");
  $loan_type_code = $loantypelist[0]['loan_type_code'];
  
  $loandate = $loanlist[0]['loan_date'];
  
  if($loandate!= '')
  {
    $loandateval =  explode("-",$loandate);
    $year = $loandateval[0];
    $cur_year = substr($year, -2);
    $cur_mon = $loandateval[1];
    $cur_date = $loandateval[2];
  
  }
  else{
    $cur_year = date('y');
    $cur_mon = date('m');
    $cur_date = date('d');
  }
  

  // generating loan number
  $cusbranchid = $customerlist[0]['branch_id'];
  
  $loan_details=select_data(LOAN_MASTER,"where branch_id='$cusbranchid' and loan_type_id='$loan_type_id' ORDER BY loan_id ASC");
  $count_val = count($loan_details);

  // echo 'hello';
  // print_r($count_val);

  if($count_val==0)
  {
    $loan_no = $loan_type_code.$branch_code.$cur_date.$cur_mon.$cur_year."00001";
    $ref_no = $loan_type_code."-".$branch_code."-".$cur_date."-".$cur_mon."-".$cur_year."-"."00001";
  }
  else
  {
    $loanid = $_GET['loan_id'];
    $ref_loan_no = get_last_loan_no($loan_type_id,$cusbranchid,$loanid);
    
    $loanno = explode("-",$ref_loan_no);
  
    $new_loan_no = str_pad($loanno[5] + 1, 5, 0, STR_PAD_LEFT);

    $loan_no = $loan_type_code.$branch_code.$cur_date.$cur_mon.$cur_year.$new_loan_no;
    $ref_no = $loan_type_code."-".$branch_code."-".$cur_date."-".$cur_mon."-".$cur_year."-".$new_loan_no;
  }


  $data['loan_no'] = $loan_no;
  $data['ref_loan_no'] = $ref_no;

  }//generate loan number only for the first time



//check whether for loan date entry exists in tally list table
$get_tally_details = select_data(TALLY_MASTER,"where date='".$loandate."' and branch_id='".$session_branch_id."'");
if(count($get_tally_details )>0)
{

  $loan_tally_details=select_data(TALLY_MASTER,"where date='".$loandate."' and branch_id='".$session_branch_id."'");
  $loantallyamt=$loan_tally_details[0]['loan_amt'];
  $new_loantally_amt = $loan_amount;
  // $savrenewdata['savings_renewal_amt']=$savrenewamt+$new_savrenew_amt;
  // $updatetally=update_data(TALLY_MASTER,$savrenewdata,"date",$savings_renewal_date);

  $nloantallyamt = (int)$loantallyamt+$new_loantally_amt;
  $update_tallyqry="UPDATE ".TALLY_MASTER." set loan_amt='$nloantallyamt' where date='$loandate' and branch_id='$session_branch_id'";
  $updatetally = mysqli_query($CN,$update_tallyqry);

}
else{

  $loantallydata['loan_amt']=$loan_amount;
  $loantallydata['date'] = $loandate;
  $loantallydata['branch_id'] = $session_branch_id;
  $insert=insert_data(TALLY_MASTER,$loantallydata); 

}
  
  

  }
//the above part is only functioned by admin

  $update=update_data(LOAN_MASTER,$data,"loan_id",$_GET['loan_id']);
  if($update!=0)
  { 

    if($session_role_id == 1)
    {
      echo "<script type='text/javascript'>window.location='loan_view.php?loan_id=".$_GET['loan_id']."&success=Loan Details Approved Successfully';</script>";
    }
    else{
      echo "<script type='text/javascript'>window.location='loan_view.php?loan_id=".$_GET['loan_id']."&success=Loan Details Forwarded Successfully';</script>";

    }
    
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
            <h1>Loan Details</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

    <?php  include("loan_leftmenu.php"); ?>

      <!-- left column -->
      <div class="col-md-9">
           
    <!-- Horizontal Form -->
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Personal Details</h3>
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
        <label for="member_no" class="col-sm-2 col-form-label">Member Number</label>
        <div class="col-sm-5">
        <input type="text" name="member_no" class="form-control" id="member_no" placeholder="Enter Member Number" value="<?php echo $customer_no; ?>" readonly />
        </div>
    </div>

 <div class="form-group row">
      <label for="member_name" class="col-sm-2 col-form-label">Member Full Name</label>
      <div class="col-sm-5">
        <input type="text" name="member_name" class="form-control" id="member_name" placeholder="Enter Member Name" value="<?php echo $customer_name; ?>" readonly />
      </div>
    </div>

        <div class="form-group row">
      <label for="mother_name" class="col-sm-2 col-form-label">Mother's Name</label>
      <div class="col-sm-5">
        <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Enter Mother Name" value="<?php echo $mother_name; ?>" readonly />
      </div>
    </div>

      <div class="form-group row">
      <label for="dob" class="col-sm-2 col-form-label">DOB</label>
      <div class="col-sm-5">
        <input type="text" name="dob" class="form-control" id="dob" placeholder="Select Date" value="<?php echo $dob; ?>" readonly />
      </div>
    </div>


        <div class="form-group row">
      <label for="dob" class="col-sm-2 col-form-label">Gender</label>
      <div class="col-sm-5">
        <input type="text" name="gender" class="form-control" id="gender" placeholder="Enter Gender" value="<?php echo $gender; ?>" readonly />
      </div>
    </div>

      <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-5">
        <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="<?php echo $email; ?>" readonly />
      </div>
    </div>

     <div class="form-group row">
      <label for="pan_no" class="col-sm-2 col-form-label">PAN No.</label>
      <div class="col-sm-5">
        <input type="text" name="pan_no" class="form-control" id="pan_no" placeholder="Enter PAN No" value="<?php echo $pan_no; ?>" readonly />
      </div>
    </div>

     <div class="form-group row">
      <label for="aadhar_no" class="col-sm-2 col-form-label">Aadhaar No.</label>
      <div class="col-sm-5">
        <input type="text" name="aadhar_no" class="form-control" id="aadhar_no" placeholder="Enter Aadhaar No" value="<?php echo $aadhar_no; ?>" readonly />
      </div>
    </div>


    <div class="form-group row">
      <label for="mobile_no" class="col-sm-2 col-form-label">Mobile No.</label>
      <div class="col-sm-5">
        <input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Enter Mobile No" value="<?php echo $mobile_number; ?>" readonly />
      </div>
    </div>


    <div class="form-group row">
      <label for="mobile_no" class="col-sm-2 col-form-label">Residence Type</label>
      <div class="col-sm-5">
        <input type="text" name="residence_type" class="form-control" id="residence_type" placeholder="Enter Residence Type" value="<?php echo $residence_type; ?>" readonly />
      </div>
    </div>

  
          
        </div>
        <!-- /.card-body -->
        <br>
              <br>
        <div class="card-footer">

          <div id="inner">
          <?php if(((isset($_GET['action']) && $_GET['action'] == 'edit') || $session_role_id == 1) || !isset($_GET['action'])) {
              ?>


    <button type="submit" class="btn-sm btn-success" id="update" name="update" >Approve</button>

    

    

 

   <?php }else{ ?>
   
   
   <button type="submit" class="btn-sm btn-success" id="update" name="update" $disabled >Forward To Admin</button>


                    <?php } ?>
      <a href=""><button type="button" class="btn-sm btn-default">Cancel</button></a>
          </div>
         
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

 

<link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
 <script>
 
 $(function() {
  $( "#cheque_date" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
 });
});

$(document.body).on('change','#first_depositor_id',function(){
  var customer_id = $('#first_depositor_id').val();
    //  alert(customer_id);
    var dataString = "customer_id="+customer_id;
      $.ajax({ 
      type: "POST", 
      url: "ajax_data.php", 
      data: dataString, 
        
      success:  function(html){ 

        var subst=html.split('@');
        $("#member_name").val(subst[0]);
        $("#mother_name").val(subst[1]);
        $("#dob").val(subst[2]);
        $("#gender").val(subst[3]);
        $("#email").val(subst[4]);
        $("#pan_no").val(subst[5]);
        $("#aadhar_no").val(subst[6]);
        $("#mobile_no").val(subst[7]);
      } 
    });
});
   </script>
</body>
</html>
