<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$session_branch_id = $_SESSION['bid'];
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

$residence_type_id='';
$door_no = '';
$address = '';

$landmark='';
$country_id='';
$state_id='';
$district_id='';
$pincode='';

$temp_addr_id='';
$temp_door_no = '';
$temp_address = '';

$temp_landmark='';
$temp_country_id='';
$temp_state_id='';
$temp_district_id='';
$temp_pincode='';


if(isset($_GET['customer_id']) && $_GET['customer_id']!="" )
{
    $customer_id=$_GET['customer_id'];
    $customer_details=select_data(CUSTOMER_MASTER,"where customer_id='$customer_id' ");
    $residence_type_id=$customer_details[0]['residence_type_id'];
    $door_no=$customer_details[0]['door_no'];
    $address = $customer_details[0]['address'];
    $landmark = $customer_details[0]['landmark'];
    $state_id = $customer_details[0]['state_id'];
    $district_id = $customer_details[0]['district_id'];
    $pincode = $customer_details[0]['pincode'];
    $temp_addr_id = $customer_details[0]['temp_addr_id'];
    $temp_door_no = $customer_details[0]['temp_door_no'];
    $temp_address = $customer_details[0]['temp_address'];
    $temp_landmark = $customer_details[0]['temp_landmark'];
    $temp_state_id = $customer_details[0]['temp_state_id'];
    $temp_district_id = $customer_details[0]['temp_district_id'];
    $temp_pincode = $customer_details[0]['temp_pincode'];
    
}


if(isset($_POST['update']))
{
  $residence_type_id=$_POST['residence_type_id'];
  $door_no=$_POST['door_no'];
  $address=$_POST['address'];
  $landmark=$_POST['landmark'];
  $state_id=$_POST['state_id'];
  $district_id=$_POST['district_id'];
  $pincode= $_POST['pincode'];
  $temp_addr_id= $_POST['temp_addr_id'];

  if($temp_addr_id == 1)
  {
    $temp_door_no=$_POST['door_no'];
    $temp_address=$_POST['address'];
    $temp_landmark=$_POST['landmark'];
    $temp_state_id=$_POST['state_id'];
    $temp_district_id=$_POST['district_id'];
    $temp_pincode= $_POST['pincode'];
  }
  else{
    $temp_door_no=$_POST['temp_door_no'];
    $temp_address=$_POST['temp_address'];
    $temp_landmark=$_POST['temp_landmark'];
    $temp_state_id=$_POST['temp_state_id'];
    $temp_district_id=$_POST['temp_district_id'];
    $temp_pincode= $_POST['temp_pincode'];
  }
  
  
  
  $data['residence_type_id']=$residence_type_id;
  $data['door_no']=$door_no;
  $data['address']=$address;
  $data['landmark']=$landmark;

  $data['state_id'] = $state_id;
  $data['district_id'] = $district_id;
  $data['pincode'] = $pincode;
  $data['temp_addr_id'] = $temp_addr_id;

  $data['temp_door_no']=$temp_door_no;
  $data['temp_address']=$temp_address;
  $data['temp_landmark']=$temp_landmark;

  $data['temp_state_id'] = $temp_state_id;
  $data['temp_district_id'] = $temp_district_id;
  $data['temp_pincode'] = $temp_pincode;
 

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;


  
// generating member number only for the first time
$cusid = $_GET['customer_id'];
$cusdetails=select_data(CUSTOMER_MASTER,"where customer_id='$cusid' ");
$cusno = $cusdetails[0]['customer_no'];
$customer_name = $cusdetails[0]['customer_name'];
$mob_no = $cusdetails[0]['mobile_number'];
$cus_branch_id = $cusdetails[0]['branch_id'];
if($cusno == '')
{

if($session_role_id==1)
{
  $session_branch_id = $cusdetails[0]['branch_id'];
}


$customer_details=select_data(CUSTOMER_MASTER,"where branch_id='$session_branch_id' ORDER BY customer_id ASC");
$count_val = count($customer_details);

$branch_code = branch_code($session_branch_id);
if($count_val==0)
{
  $member_no = "AM00".$branch_code."00001";
  $ref_no = "AM00-".$branch_code."-00001";
}
else
{
  $cusid  = $_GET['customer_id'];
  $ref_member_no = get_last_member_no($cusid,$session_branch_id);
  $memberno = explode("-",$ref_member_no);
  $new_member_no = str_pad($memberno[2] + 1, 5, 0, STR_PAD_LEFT);
  $member_no = "AM00".$branch_code.$new_member_no;
  $ref_no = "AM00-".$branch_code."-".$new_member_no;
}

  $data['customer_no'] = $member_no;
  $data['ref_cus_no'] = $ref_no;


  $cus_id = $_GET['customer_id'];
  $cus_details=select_data(CUSTOMER_MASTER,"where customer_id='$cus_id' ");
  $member_date = $cus_details[0]['date'];
  //check whether for expense date entry exists in tally list table
  $get_tally_details = select_data(TALLY_MASTER,"where date='".$member_date."' and branch_id='".$session_branch_id."'");
  if(count($get_tally_details )>0)
  {

    $mem_details=select_data(TALLY_MASTER,"where date='".$member_date."' and branch_id='".$session_branch_id."'");
    $memberamt=$mem_details[0]['member_amt'];
    $new_mem_amt = 100;
    // $memdata['member_amt']=$memberamt+$new_mem_amt;
    // $updatetally=update_data(TALLY_MASTER,$memdata,"date",$member_date);
    $nmemamt = (int)$memberamt+$new_mem_amt;
    $update_tallyqry="UPDATE ".TALLY_MASTER." set member_amt='$nmemamt' where date='$member_date' and branch_id='$session_branch_id'";
    $updatetally = mysqli_query($CN,$update_tallyqry);

  }
  else{

    $memdata['member_amt']=100;
    $memdata['date'] = $member_date;
    $memdata['branch_id'] = $session_branch_id;
    $insert=insert_data(TALLY_MASTER,$memdata); 

  }

  // sms sending function
  if($cus_branch_id==4 || $cus_branch_id==2 || $cus_branch_id==3 || $cus_branch_id==1){
      $send_sms = send_sms($mob_no,$member_no,$customer_name);
  }
  
    // print_r($send_sms);
    // exit;

}// generating member number only for the first time

  $update=update_data(CUSTOMER_MASTER,$data,"customer_id",$_GET['customer_id']);
  if($update!=0)
  { 
    echo "<script type='text/javascript'>window.location='member_view.php?success=Details Updated Successfully';</script>";
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
            <h1>Member Details</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

    <?php  include("member_leftmenu.php"); ?>

      <!-- left column -->
      <div class="col-md-9">
           
    <!-- Horizontal Form -->
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Member Address Details</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">


<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>

<?php if(isset($_GET['danger']) && $_GET['danger']){ $info=$_GET['danger'];?>

<div class="alert alert-danger alert-dismissible"><?php echo  $info;?></div>

<?php } ?>

        <div class="card-body">
      
         <div class="form-group row">
            <label for="residence_type_id" class="col-sm-2 col-form-label">Residence Type<span style="color:red">*</span></label>
            <div class="col-sm-5">
            <select name="residence_type_id" class="form-control" id="residence_type_id" <?php echo $disabled; ?>>
              <option value="">Select Residence Type</option>
              <?php
              $residence_type_list=select_data(TYPE_MASTER," where category='residence_type'");
              foreach($residence_type_list as $rtl)
              {
              ?>
                <option value="<?php echo $rtl['type_id'];?>" <?php if($residence_type_id == $rtl['type_id']){ echo 'selected'; } ?>><?php echo $rtl['type_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
          </div>


        
      <h4 for="exampleInputEmail1"><b>Permanent Address </b></h4><br>

          <div class="form-group row">
            <label for="door_no" class="col-sm-2 col-form-label">Door No<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="door_no" class="form-control" id="door_no" placeholder="Enter Door No" value="<?php echo $door_no; ?>" <?php echo $disabled; ?>/>
            </div>
          </div>


          <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label">Address<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" value="<?php echo $address; ?>" <?php echo $disabled; ?>/>
            </div>
          </div>

           <div class="form-group row">
            <label for="landmark" class="col-sm-2 col-form-label">Landmark<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="landmark" class="form-control" id="landmark" placeholder="Enter Landmark" value="<?php echo $landmark; ?>" <?php echo $disabled; ?>/>
            </div>
          </div>



        <div class="form-group row">
            <label for="country_id" class="col-sm-2 col-form-label">Country<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="country_id" class="form-control" id="country_id" <?php echo $disabled; ?>>
              <option value="">Select Country</option>
              <?php
              $country_list=select_data(COUNTRY_MASTER," ORDER BY country_id ASC");
              foreach($country_list as $cl)
              {
              ?>
                <option value="<?php echo $cl['country_id'];?>" <?php if($country_id == $cl['country_id']){ echo 'selected'; } ?>><?php echo $cl['country_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>


        


          <div class="form-group row">
            <label for="state_id" class="col-sm-2 col-form-label">State<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="state_id" class="form-control" id="state_id" <?php echo $disabled; ?>>
              <option value="">Select State</option>
              <?php
              $state_list=select_data(STATE_MASTER," ORDER BY state_id ASC");
              foreach($state_list as $sl)
              {
              ?>
                <option value="<?php echo $sl['state_id'];?>" <?php if($state_id == $sl['state_id']){ echo 'selected'; } ?>><?php echo $sl['state_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>

          <div class="form-group row">
            <label for="district_id" class="col-sm-2 col-form-label">District<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="district_id" class="form-control select2" id="district_id" <?php echo $disabled; ?>>
              <option value="">Select District</option>
              <?php
              $district_list=select_data(DISTRICT_MASTER," ORDER BY district_id ASC");
              foreach($district_list as $dl)
              {
              ?>
                <option value="<?php echo $dl['district_id'];?>" <?php if($district_id == $dl['district_id']){ echo 'selected'; } ?>><?php echo $dl['district_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>


          <div class="form-group row">
            <label for="pincode" class="col-sm-2 col-form-label">Pincode<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="pincode" class="form-control" id="pincode" placeholder="Enter Pincode" value="<?php echo $pincode; ?>" <?php echo $disabled; ?>/>
            </div>
          </div>




 <div class="form-group row">
            <label for="pincode" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-5">
             
            </div>
          </div>
<br>

        <h4 for="exampleInputEmail1"><b>Present Address
     
        <input type="checkbox" name="temp_addr" id="temp_addr" <?php if($temp_addr_id == 1) {?> checked <?php }?> <?php echo $disabled; ?>/>

         <input type="hidden" name="temp_addr_id" id="temp_addr_id" value="" <?php echo $disabled; ?>/>
         </b></h4><br>

        <div class="form-group row">
            <label for="temp_door_no" class="col-sm-2 col-form-label">Door No<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="temp_door_no" class="form-control" id="temp_door_no" placeholder="Enter Door No" value="<?php echo $temp_door_no; ?>" <?php echo $disabled; ?>/>
            </div>
          </div>


          <div class="form-group row">
            <label for="temp_address" class="col-sm-2 col-form-label">Address<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="temp_address" class="form-control" id="temp_address" placeholder="Enter Address" value="<?php echo $temp_address; ?>" <?php echo $disabled; ?>/>
            </div>
          </div>

           <div class="form-group row">
            <label for="temp_landmark" class="col-sm-2 col-form-label">Landmark<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="temp_landmark" class="form-control" id="temp_landmark" placeholder="Enter Landmark" value="<?php echo $temp_landmark; ?>" <?php echo $disabled; ?>/>
            </div>
          </div>



        <div class="form-group row">
            <label for="temp_country_id" class="col-sm-2 col-form-label">Country<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="temp_country_id" class="form-control" id="temp_country_id" <?php echo $disabled; ?>>
              <option value="">Select Country</option>
              <?php
              $country_list=select_data(COUNTRY_MASTER," ORDER BY country_id ASC");
              foreach($country_list as $cl)
              {
              ?>
                <option value="<?php echo $cl['country_id'];?>" <?php if($temp_country_id == $cl['country_id']){ echo 'selected'; } ?>><?php echo $cl['country_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>


        


          <div class="form-group row">
            <label for="temp_state_id" class="col-sm-2 col-form-label">State<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="temp_state_id" class="form-control" id="temp_state_id" <?php echo $disabled; ?>>
              <option value="">Select State</option>
              <?php
              $state_list=select_data(STATE_MASTER," ORDER BY state_id ASC");
              foreach($state_list as $sl)
              {
              ?>
                <option value="<?php echo $sl['state_id'];?>" <?php if($temp_state_id == $sl['state_id']){ echo 'selected'; } ?>><?php echo $sl['state_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>

          <div class="form-group row">
            <label for="temp_district_id" class="col-sm-2 col-form-label">District<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <select name="temp_district_id" class="form-control select2" id="temp_district_id" <?php echo $disabled; ?>>
              <option value="">Select District</option>
              <?php
              $district_list=select_data(DISTRICT_MASTER," ORDER BY district_id ASC");
              foreach($district_list as $dl)
              {
              ?>
                <option value="<?php echo $dl['district_id'];?>" <?php if($temp_district_id == $dl['district_id']){ echo 'selected'; } ?>><?php echo $dl['district_name'];?></option>
                <?php  
              }
              ?>
              </select>
            </div>
        </div>


          <div class="form-group row">
            <label for="temp_pincode" class="col-sm-2 col-form-label">Pincode<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="temp_pincode" class="form-control" id="temp_pincode" placeholder="Enter Pincode" value="<?php echo $temp_pincode; ?>" <?php echo $disabled; ?>/>
            </div>
          </div>
  

         

         
          
        </div>
        <!-- /.card-body -->  <br>
              <br>
              
        <div class="card-footer">

        <div id="inner">
        <?php if(  ((isset($_GET['action']) && $_GET['action'] == 'edit') || $session_role_id == 1) || !isset($_GET['action'])){ ?>
            <?php if(!isset($_GET['customer_id'])) { ?>
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

 

<link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
 <script>

 $(function () {
     $("#form1").validate({
rules: { 
  residence_type_id: { required: true},
  door_no: {required: true },
  address: {required: true },
  landmark: {required: true },
  country_id: {required: true },
  state_id:{ required: true },
  district_id:{required: true },
  pincode:{required: true },
  temp_door_no: {required: true },
  temp_address: {required: true },
  temp_landmark: {required: true },
  temp_country_id: {required: true },
  temp_state_id:{ required: true },
  temp_district_id:{required: true },
  temp_pincode:{required: true },
  },

messages: {
  residence_type_id: { required: 'Please Select Residence Type'},
  door_no: {required: 'Please Enter Door No' },
  address: {required: 'Please Enter Address' },
  landmark: {required:'Please Enter Landmark' },
  country_id: {required: 'Please Select Country' },
  state_id: {required: 'Please Select State'},
  district_id: {required: 'Please Select District'},
  pincode: {required: 'Please Enter Pincode'},
  temp_door_no: {required: 'Please Enter Door No' },
  temp_address: {required: 'Please Enter Address' },
  temp_landmark: {required:'Please Enter Landmark' },
  temp_country_id: {required: 'Please Select Country' },
  temp_state_id: {required: 'Please Select State'},
  temp_district_id: {required: 'Please Select District'},
  temp_pincode: {required: 'Please Enter Pincode'},
 
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
  $( "#dob" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
 });
});


$("#temp_addr").click(function()
    	{
			var textBox  =  $.trim($('#address').val());
			var textBox2 =	$.trim($('#country_id').val());
			var textBox3 =  $.trim($('#state_id').val());
			var textBox4 =  $.trim($('#district_id').val() );
			var textBox5 =  $.trim($('#pincode').val() );
            //var textBox6 =  $.trim($('#landmark').val() );
			var textBox7 =  $.trim($('#door_no').val() );


			
			
    if (textBox == "" || textBox2 == "" || textBox3 == "" || textBox4 == "" || textBox5 == "" || textBox7 == "") {
       
		alert("Please Enter all Address details");
		$('#temp_addr').prop('checked', false); 
       
		}
		else
		{
                    
			    $('#temp_country_id').val($('#country_id').val());
				$('#temp_state_id').val($('#state_id').val());
				$('#temp_district_id').val($('#district_id').val());
        		$('#temp_pincode').val($('#pincode').val());
             $('#temp_landmark').val($('#landmark').val());
        		$('#temp_door_no').val($('#door_no').val());

				$('#temp_addr_id').val(1);
		}
   
    
        	if (this.checked) {                
                var address = $('textarea:input[name=address]').val();
        		$('#temp_state_same').show();
        		$('#temp_district_same').show();
        		$('#temp_state_diff').hide();
        		$('#temp_district_diff').hide();
        		$('#temp_address').val($('#address').val());
        		$('#temp_country_id').val($('#country_id').val());
        		$('#temp_state_same_id').val($('#state_id').val());
          	$('#temp_district_same_id').val($('#district_id').val());
        		$('#temp_pincode').val($('#pincode').val());
            $('#temp_landmark').val($('#landmark').val());
            $('#temp_door_no').val($('#door_no').val());

				
		        		
        		$('#temp_address').prop('disabled', true);
        		$('#temp_country_id').prop('disabled', true);
        		$('#temp_state_id').prop('disabled', true);
            $('#temp_district_id').prop('disabled', true);
        		$('#temp_pincode').prop('disabled', true);
            $('#temp_landmark').prop('disabled', true);
        		$('#temp_door_no').prop('disabled', true);

        	}
        	else{
        		$('#temp_state_diff').show();
        		$('#temp_district_diff').show();
        		$('#temp_state_same').hide();
        		$('#temp_district_same').hide();

        		$('#temp_address').val('');
        		$('#temp_country_id').val('Select');
        		$('#temp_state_id').val('');
          		$('#temp_district_id').val('');
        		$('#temp_pincode').val('');
                $('#temp_landmark').val('');
                $('#temp_door_no').val('');
                
		        		
        		$('#temp_address').prop('disabled', false);
        		$('#temp_country_id').prop('disabled', false);
        		$('#temp_state_id').prop('disabled', false);
          		$('#temp_district_id').prop('disabled', false);
        		$('#temp_pincode').prop('disabled', false);
                $('#temp_landmark').prop('disabled', false);
        		$('#temp_door_no').prop('disabled', false);

        	}
     	});

   </script>
</body>
</html>
