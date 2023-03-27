<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_role_id=$_SESSION['role_id'];
$session_branch_id = $_SESSION['bid'];

if(isset($_POST['branch_id']))
 {
   $branch_id = $_POST['branch_id'];
 }
 else
 {
   $branch_id = "";
 }


//echo $_SESSION['state'];

if($session_role_id==1)
{
  $disabled="";
}
else{

  if(isset($_GET['action']) && $_GET['action']=='view' )
  {
    $disabled = "disabled";
  }
  else{
    $disabled="";
  }
  
}

$customer_id='';
$loan_amount="";
$loan_type_id="";
$loan_date="";
$loan_term_id="";
$loan_repay_amt=0;
$loan_term_interest=0;

if(isset($_GET['loan_id']) && $_GET['loan_id']!="" )
{
    $loan_id=$_GET['loan_id'];
    $loan_details=select_data(LOAN_MASTER,"where loan_id='$loan_id' ");
    $customer_id=$loan_details[0]['customer_id'];
    $loan_type_id=$loan_details[0]['loan_type_id']; 
    $branch_id=$loan_details[0]['branch_id'];
    $loan_term_id=$loan_details[0]['loan_term_id'];
    $loan_date = date("d-m-Y",strtotime($loan_details[0]['loan_date']));
    $loan_amount = $loan_details[0]['loan_amount'];
    $loan_repay_amt = $loan_details[0]['loan_repay_amt'];
    $loan_term_interest = $loan_details[0]['loan_term_interest'];
    $loan_details=select_data(LOAN_TYPE_MASTER," ");
    $code=$loan_details[0]['loan_type_code'];
    
}


if(isset($_POST['update']))
{
  
  $customer_id=$_POST['customer_id'];
  $loan_type_id= $_POST['loan_type_id'];
  $loan_amount = $_POST['loan_amount'];
  $loan_date = $_POST['loan_date'];
  $loan_term_id=$_POST['loan_term_id'];
  $loan_repay_amt = $_POST['loan_repay_amt'];
  if($loan_date!=""){ 
    $loan_date = date("Y-m-d", strtotime($loan_date));
  }
  


  $data['customer_id']=$customer_id;
  $data['loan_type_id']=$loan_type_id;
  $data['loan_amount']=$loan_amount;
  $data['loan_date']=$loan_date;
  $data['loan_term_id']=$loan_term_id;
  $data['loan_repay_amt']=$loan_repay_amt;
  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;
  

  $update=update_data(LOAN_MASTER,$data,"loan_id",$_GET['loan_id']);
  if($update!=0)
  { 
      $_SESSION['sta'] = $_GET['loan_status'];
      
    echo "<script type='text/javascript'>window.location='loan_nominee.php?loan_id=".$_GET['loan_id']."&success=Details Updated Successfully&loan_status=".$_GET['loan_status']."';</script>";
  }
        
}


 if(isset($_POST['submit']))
 {
   
  $customer_id=$_POST['customer_id'];
  $loan_type_id= $_POST['loan_type_id'];
  $loan_amount = $_POST['loan_amount'];
  $loan_date = $_POST['loan_date'];
  $loan_closing_date = $_POST['loan_closing_date'];
  $loan_term_id=$_POST['loan_term_id'];
  $loan_repay_amt = $_POST['loan_repay_amt'];
  $loan_term_interest = $_POST['loan_term_interest'];
  $loan_closing_details= select_data(LOAN_TERM_MASTER," where loan_term_id='$loan_term_id'");
  $loan_term_no=$loan_closing_details[0]['loan_term_no'];
 // $code=$loan_closing_details[0]['loan_type_code'];

//   $plan_term=$ld['loan_term_id'];
              if( $loan_term_id == "1"  )
                {
                  $maturity_date=date('Y-m-d', strtotime('+4 month', strtotime($loan_date)) );
                }
                else if( $loan_term_id == "2")
                {
                  $maturity_date=date('Y-m-d', strtotime('+8 month', strtotime($loan_date)) );
                  
                }
                else if( $loan_term_id == "3" )
                {
                  $maturity_date=date('Y-m-d', strtotime('+12 month', strtotime($loan_date)) );
                }else{
                $maturity_date=date('Y-m-d', strtotime( "+$loan_term_no month", strtotime($loan_date)) );
                }
//   $maturity_date=date('Y-m-d', strtotime('+4 month', strtotime($loan_date)) );
  $after_date=date('Y-m-d', strtotime('+2 days', strtotime($maturity_date)) );
  $before_date=date('Y-m-d', strtotime('-3 days', strtotime($maturity_date)) );
  
   if($session_role_id==1){
      $branch_id1 = $_POST['branch_id']; 
      }
  else{
      
       $branch_id1 = $_SESSION['bid'];
  }    
  
  if($loan_date!=""){ 
    $loan_date = date("Y-m-d", strtotime($loan_date));
  }
  

  $data['customer_id']=$customer_id;
  $data['loan_type_id']=$loan_type_id;
  $data['loan_amount']=$loan_amount;
  $data['loan_date']=$loan_date;
  $data['loan_term_id']=$loan_term_id;
  $data['loan_repay_amt']=$loan_repay_amt;
  $data['loan_term_interest']=$loan_term_interest;
  $data['branch_id'] = $branch_id1;
  $data['loan_closing_date']=$maturity_date;
  $data['closing_after2_days']=$after_date;
  $data['closing_before3_days']=$before_date;

  $data['status'] = 1;
  
  $data['created_date']= date("Y-m-d H:i:s");
  $data['created_by']=$userid;

    $insert=insert_data(LOAN_MASTER,$data); 
    $last_id=mysqli_insert_id($CN);
    if($insert!=0)
    { 
      echo "<script type='text/javascript'>window.location='loan_nominee.php?loan_id=".$last_id."&success=Loan created Successfully&loan_status=".$_GET['loan_status']="1" ."';</script>";
             
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
        <h3 class="card-title">Loan Details</h3>
           <a class="btn-sm btn-success float-right" href="loan_view.php">Back</a> 
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
            <label for="customer_id" class="col-sm-2 col-form-label">Member Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="customer_id" class="form-control select2" id="customer_id" <?php echo $disabled; ?>>
              <option value="">Select Member Name</option>
              <?php
                if($session_role_id == 1)
                {
              $member_list=select_data(CUSTOMER_MASTER," ORDER BY customer_name ASC");
                }
                else{
          $member_list=select_data(CUSTOMER_MASTER,"where branch_id='".$session_branch_id."' ORDER BY customer_name ASC");      
                }
              foreach($member_list as $ml)
              {
              ?>
                <option value="<?php echo $ml['customer_id'];?>" <?php if($customer_id == $ml['customer_id']){ echo 'selected'; } ?>><?php echo $ml['customer_no'].'-'.$ml['customer_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>
       <?php if($session_role_id == 1) {?>
         <div class="form-group row">
         <label for="employee_name" class="col-sm-2 col-form-label">Branch Name<span style="color:red">*</span></label>
            <div class="col-sm-5">

            <select name="branch_id" class="form-control" id="branch_id">
              <option value="">Select Branch Name</option>
              <?php
              $branch_list=select_data(BRANCH_MASTER," ORDER BY branch_id ASC");
              foreach($branch_list as $bl)
              {
              ?>
                <option value="<?php echo $bl['branch_id'];?>" <?php if( $branch_id == $bl['branch_id']){ echo 'selected'; } ?>><?php echo $bl['branch_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
            </div>
            <?php } else {}?>

         <div class="form-group row">
            <label for="loan_type_id" class="col-sm-2 col-form-label">Loan Type<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="loan_type_id" class="form-control" id="loan_type_id" <?php echo $disabled; ?>>
              <option value="">Select Loan Type</option>
              <?php
             $loan_type_list=select_data(LOAN_TYPE_MASTER,"where status='1' ORDER BY loan_type_id  ASC");
             foreach($loan_type_list as $ltl)
             {
             ?>
               <option value="<?php echo $ltl['loan_type_id'];?>" <?php if($loan_type_id == $ltl['loan_type_id']){ echo 'selected'; } ?>><?php echo $ltl['loan_type_name'];?></option>
               <?php  
             }
             ?>
              </select>
            </div>
        </div>


<div class="form-group row">
      <label for="loan_amount" class="col-sm-2 col-form-label">Loan Amount<span style="color:red">*</span></label>
      <div class="col-sm-5">
        <input type="text" name="loan_amount" class="form-control" id="loan_amount" placeholder="Enter Amount" value="<?php echo $loan_amount; ?>" <?php echo $disabled; ?>/>
      </div>
    </div>


         <div class="form-group row">
            <label for="loan_term_id" class="col-sm-2 col-form-label">Loan Term<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="loan_term_id" class="form-control" id="loan_term_id" <?php echo $disabled; ?>>
              <option value="">Select Loan Term</option>
              <?php
             $loan_term_list=select_data(LOAN_TERM_MASTER," Where status=1 ORDER BY loan_term_id  ASC");
             foreach($loan_term_list as $ltl)
             {
                
             ?>
               <option value="<?php echo $ltl['loan_term_id'];?>" <?php if($loan_term_id == $ltl['loan_term_id']){ echo 'selected'; } ?>><?php 
                $loan_type=$ltl['loan_type'];
                 $loan_code=select_data(LOAN_TYPE_MASTER,"where loan_type_id='".$ltl['loan_type']."'");
                 $loan_type_code=$loan_code[0]['loan_type_code'];
                echo $ltl['loan_term_no'];?>-<?php echo $loan_type_code;?></option>
               <?php  
             }
             ?>
              </select>
            </div>
        </div>


        <div class="form-group row">
            <label for="loan_term_interest" class="col-sm-2 col-form-label">Loan Interest<span style="color:red">*</span></label>
            <div class="col-sm-5">
             <input type="text" name="loan_term_interest" class="form-control" id="loan_term_interest" placeholder="Select" value="<?php echo $loan_term_interest."%"; ?>" <?php echo $disabled; ?>/>
            </div>
        </div>

         <div class="form-group row">
            <label for="loan_repay_amt" class="col-sm-2 col-form-label">Loan Repay Amount<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="loan_repay_amt" class="form-control" id="loan_repay_amt" placeholder="Select" value="<?php echo $loan_repay_amt; ?>" <?php echo $disabled; ?>/>
            </div>
        </div>
      
        <div class="form-group row">
            <label for="loan_date" class="col-sm-2 col-form-label">Loan Date<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <input type="text" name="loan_date" class="form-control" id="loan_date" placeholder="Select Date" value="<?php echo $loan_date; ?>" <?php echo $disabled; ?>/>
        
            </div>
        </div>
         <div class="form-group row">
           <!-- <label for="loan_date" class="col-sm-2 col-form-label">Loan Closing Date<span style="color:red">*</span></label>-->
            <div class="col-sm-5">
            <input type="text" name="loan_closing_date" class="form-control" id="loan_closing_date" placeholder="Select Date" hidden value="<?php echo $loan_closing_date; ?>" <?php echo $disabled; ?>/>
            </div>
        </div>
        </div>
        <!-- /.card-body -->
        <br>
              <br>
        <div class="card-footer">

        <div id="inner">

        <?php 
    if(((isset($_GET['action']) && $_GET['action'] == 'edit') || $session_role_id == 1) || !isset($_GET['action'])) {
        
          ?>

            <?php if(!isset($_GET['loan_id'])) { ?>
              <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
                    <?php } else { ?>
            <button type="submit" class="btn-sm btn-success" id="submit" name="update" >Update</button>
                          <?php } ?>
              <a href=""><button type="button" class="btn-sm btn-default">Cancel</button></a>
         
         <?php } ?>
         
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
  customer_id: { required: true},
  loan_type_id: { required: true},
  loan_amount: { required: true, number: true },
  loan_term_id: { required: true},
  loan_term_interest: { required: true},
  loan_repay_amt: { required: true},
  loan_date: { required: true},
  
},
messages: {
  customer_id: { required: 'Please Select Member'},
  loan_type_id: { required: 'Please Select Loan Type'},
  loan_amount: { required: 'Please Enter Loan Amount'},
  loan_term_id: { required: 'Please Select Loan Term'},
  loan_term_interest: { required: 'Please Enter Loan Interest'},
  loan_repay_amt: { required: 'Please Enter Loan Repay Amount'},
  loan_date: { required: 'Please Select Loan Date'},

 
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


 $(document.body).on('change','#loan_term_id',function(){

    var loan_term_id = $('#loan_term_id').val();
    var amount = $("#loan_amount").val();
  
    var dataString = "loan_term_id="+loan_term_id+"&amount="+amount;
      $.ajax({ 
      type: "GET", 
      url: "ajax_data.php", 
      data: dataString, 
        
      success:  function(html){
        // alert(html);
        var subst=html.split('@'); 
        $("#loan_term_interest").val(subst[0]);
            $("#loan_repay_amt").val(subst[1]);
      } 
    });
});

 $(function() {
  $( "#loan_date" ).datepicker({
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
