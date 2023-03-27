<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");
$emp_id= $_SESSION['emp_id'];
$emp_name=$_SESSION['emp_name'];
$role_id=$_SESSION['role_id'];


if(isset($_REQUEST['customer_id']))
{
    $customer_id = $_POST['customer_id'];
    global $CN;
    if($customer_id != '')
    {
        $select = mysqli_query($CN,"SELECT * FROM ".CUSTOMER_MASTER." WHERE customer_id = '$customer_id'");
        $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$customer_id."'");
        $customer_name = $customerlist[0]['customer_name'];
        $mother_name = $customerlist[0]['mother_name'];
        $dob = $customerlist[0]['dob'];
        if($dob != '')
        {
            $dob =  date("Y-m-d", strtotime($dob));
        } 
        else
        {
            $dob="-";
        }
           
        $gender_id = $customerlist[0]['gender_id'];
        $genderlist = select_data(TYPE_MASTER," where type_id='".$gender_id."'");
        $gender = $genderlist[0]['type_name'];
        $pan_no = $customerlist[0]['pan_no'];
        $aadhar_no = $customerlist[0]['aadhar_no'];
        $mobile_no = $customerlist[0]['mobile_number'];
        $email = $customerlist[0]['email'];
    
        echo $value = $customer_name."@".$mother_name."@".$dob."@".$gender."@".$email."@".$pan_no."@".$aadhar_no."@".$mobile_no;

    }
    
}

if(isset($_REQUEST['loan_term_id']))
{
    global $CN;
    $loan_term_id = $_GET['loan_term_id'];
    $amount = $_GET['amount'];
    

    $loan_term_list = select_data(LOAN_TERM_MASTER," where loan_term_id='".$loan_term_id."'");
    $loan_term = $loan_term_list[0]['loan_term_no'];
    $interest =  $loan_term_list[0]['loan_term_interest'];
    $int = $interest/100;
    $loan_repay_amt = $amount*$int;
    $full_amt = $loan_repay_amt+$amount;
    echo $value = $interest."@".$full_amt;

}


if(isset($_REQUEST['savings_customer_id']))
{
$customer_id = $_GET['savings_customer_id'];
	global $CN;
 $select = mysqli_query($CN,"SELECT * FROM ".ACCOUNT_MASTER." WHERE customer_id = '$customer_id'");
	
 
	echo '<option value="">Select Account Number</option>';
	while($row = mysqli_fetch_array($select)){
		?>
	<option value="<?php echo $row['account_id'];?>" ><?php echo $row['account_no'];?></option>';
 		<?php
 	}


}

if(isset($_REQUEST['savings_account_id']))
{
    global $CN;
    $account_id = $_REQUEST['savings_account_id'];
    $acct_details = select_data(ACCOUNT_MASTER,"where account_id='$account_id'");
    if(count($acct_details) > 0)
    { ?>
        
                <table>
                <tbody>
                    
                
                  <?php
                    $i=1;
              
                    
                    foreach($acct_details as $ad)
                    {
                      $plan_type_id = $ad['plan_type_id'];
                      $plantypedetails = select_data(PLAN_TYPE_MASTER,"where plan_type_id='$plan_type_id'");
                      $plan_name = $plantypedetails[0]['plan_type_name'];
                      $plan_id = $ad['plan_id'];
                      $plandetails = select_data(PLAN_MASTER,"where plan_id='$plan_id'");
                      $plan_term = $plandetails[0]['plan_term'];
                      $plan_code = $plandetails[0]['plan_code'];
                      $plan_interest = $plandetails[0]['plan_interest'];
                      $plan_term_value = $plandetails[0]['plan_term_value'];
                      if($plan_term_value == 'D')
                      {
                        $plan_term_val = 'Days';
                      }
                      else if($plan_term_value == 'Y')
                      {
                        $plan_term_val = 'Year';
                      }
                      ?>
                    <tr>
                        <td><?php echo $plan_name;?></td>
                        <td><?php echo $plan_code;?></td>
                        <td><?php echo $plan_term." ".$plan_term_val; ?></td>
                        <td><?php echo $plan_interest;?></td>
                        
                        
                    </tr>
       <?php  $i++; } ?>
                </tbody></table>
                
              
            
               
<?php
    }
    else
    {
        echo "No Records Found";
    }

}




if(isset($_REQUEST['loan_customer_id']))
{
     $customer_id = $_GET['loan_customer_id'];
	global $CN;
 $select = mysqli_query($CN,"SELECT * FROM ".LOAN_MASTER." WHERE customer_id = '$customer_id'");
	
	echo '<option value="">Select Loan Number</option>';
	while($row = mysqli_fetch_array($select)){
		?>
		<option value="<?php echo $row['loan_id'];?>" ><?php echo $row['loan_no'];?></option>';
		<?php
	}
}


if(isset($_REQUEST['loan_account_id']))
{
    global $CN;
    $loan_id = $_REQUEST['loan_account_id'];
    $loan_details = select_data(LOAN_MASTER,"where loan_id='$loan_id'");
    if(count($loan_details) > 0)
    { ?>
        
                <table>
                <tbody>
                    
                
                  <?php
                    $i=1;
              
                    
                    foreach($loan_details as $ld)
                    {
                      $loan_type_id = $ld['loan_type_id'];
                      $loantypedetails = select_data(LOAN_TYPE_MASTER,"where loan_type_id='$loan_type_id'");
                      $loan_name = $loantypedetails[0]['loan_type_name'];
                      $loan_term_id = $ld['loan_term_id'];
                      $termdetails = select_data(LOAN_TERM_MASTER,"where loan_term_id='$loan_term_id'");
                      $loan_term_no = $termdetails[0]['loan_term_no'];
                      $loan_term_interest = $termdetails[0]['loan_term_interest'];
                      $loan_repay_amt = $ld['loan_repay_amt'];
                      ?>
                    <tr>
                        <td><?php echo $loan_name;?></td>
                        <td><?php echo $loan_term_no;?></td>
                        <td><?php echo $loan_term_interest."%"?></td>
                        <td><?php echo $loan_repay_amt;?></td>
                        
                        
                    </tr>
       <?php  $i++; } ?>
                </tbody></table>
                
              
            
               
<?php
    }
    else
    {
        echo "No Records Found";
    }

}


?>

             