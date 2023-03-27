<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");
$emp_id= $_SESSION['emp_id'];
$emp_name=$_SESSION['emp_name'];
$role_id=$_SESSION['role_id'];


if(isset($_REQUEST['passbook_cus_id']))
{
 global $CN;

 $customer_id = $_GET['passbook_cus_id'];

 //insert into passbook table
 $customer_id = $_GET['passbook_cus_id'];
 $acc_id = $_GET['passbook_acc_id'];
 $branch_id = $_GET['passbook_branch_id'];
 $pass_book_val = $_GET['pass_book_val'];
 $from_date = date('Y-m-d', strtotime($_GET['from_date']));
 $to_date = date('Y-m-d', strtotime($_GET['to_date']));

 $passbooklist = select_data(PASS_BOOK," where customer_id='".$customer_id."' and account_id='".$acc_id."' ");
 $pass_book_list_count = count($passbooklist);

 if($pass_book_val == 1)
 { 

        // get last total amt
    $select_last_balance = mysqli_query($CN,"SELECT total_amt FROM ".PASS_BOOK." WHERE customer_id = '".$customer_id."' and account_id='".$acc_id."' order by pass_book_id desc limit 1");
    $row_last_balance = mysqli_fetch_array($select_last_balance);
    $last_total_balance  = $row_last_balance['total_amt'];


    $select_page_no = mysqli_query($CN,"SELECT page_no FROM ".PASS_BOOK." WHERE customer_id = '".$customer_id."' and account_id='".$acc_id."' order by pass_book_id desc limit 1");
    $rowp = mysqli_fetch_array($select_page_no);
    $rowp = $rowp['page_no'];

    if($rowp == 1 || $rowp == 3 || $rowp == 5 || $rowp == 7 || $rowp == 9 || $rowp == 11 || $rowp == 13 || $rowp == 15 || $rowp == 17)
    {
        $page_list = select_data(PASS_BOOK," where customer_id='".$customer_id."' and account_id='".$acc_id."' and page_no='$rowp'");
        $page_list_count = count($page_list);
        
        $default = 11;
        $rem_page_list_count = $default - $page_list_count;

        if($rem_page_list_count == 0)
        {
        $rem_page_list_count = 14;
        }

    }
    else if($rowp == 2 || $rowp == 4 || $rowp == 6 || $rowp == 8 || $rowp == 10 || $rowp == 12 || $rowp == 14 || $rowp == 16 || $rowp == 18)
    {
        
        $page_list = select_data(PASS_BOOK," where customer_id='".$customer_id."' and account_id='".$acc_id."' and page_no='$rowp'");
        $page_list_count = count($page_list);
        $default = 14;
        $rem_page_list_count = $default - $page_list_count;

        if($rem_page_list_count == 0)
        {
        $rem_page_list_count = 11;
        }
    }

    $customerlist=select_data(SAVINGS_RENEWAL," where customer_id='".$customer_id."' and account_id='".$acc_id."' and renewal_date > '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
    $customer_list_count = count($customerlist);
    if($customer_list_count > $rem_page_list_count)
    {
        $customer_list=select_data(SAVINGS_RENEWAL," where customer_id='".$customer_id."' and account_id='".$acc_id."' and renewal_date > '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc limit ".$rem_page_list_count."");
    }
    else{

        $customer_list=select_data(SAVINGS_RENEWAL," where customer_id='".$customer_id."' and account_id='".$acc_id."' and renewal_date > '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
    }
 }
 else if($pass_book_val == 0){

    $last_total_balance = 0;

    $customerlist=select_data(SAVINGS_RENEWAL," where customer_id='".$customer_id."' and account_id='".$acc_id."' and renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
    $customer_list_count = count($customerlist);
    if($customer_list_count > 11)
    {
        $customer_list=select_data(SAVINGS_RENEWAL," where customer_id='".$customer_id."' and account_id='".$acc_id."' and renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc limit 11");

    }
    else if($customer_list_count <= 11){
    
        $customer_list=select_data(SAVINGS_RENEWAL," where customer_id='".$customer_id."' and account_id='".$acc_id."' and renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
    }
 }
 
 if(count($customer_list) > 0)
 {
    $i=$pass_book_list_count;
    $passbookbalance = $last_total_balance;
    foreach($customer_list as $cl)
    {
    
        if($i < 11)
        {
            $page_no = 1;
        }
        else if($i >= 11 && $i < 25)
        {
            $page_no = 2;
        }
        else if($i >= 25 && $i < 36)
        {
            $page_no = 3;
        }
        else if($i >= 36 && $i < 50)
        {
            $page_no = 4;
        }
        else if($i >= 50 && $i < 61)
        {
            $page_no = 5;
        }
        else if($i >= 61 && $i < 75)
        {
            $page_no = 6;
        }
        else if($i >= 75 && $i < 86)
        {
            $page_no = 7;
        }
        else if($i >= 86 && $i < 100)
        {
            $page_no = 8;
        }
        else if($i >= 100 && $i < 111)
        {
            $page_no = 9;
        }
        else if($i >= 111 && $i < 125)
        {
            $page_no = 10;
        }
        else if($i >= 125 && $i < 136)
        {
            $page_no = 11;
        }
        else if($i >= 136 && $i < 150)
        {
            $page_no = 12;
        }
        else if($i >= 150 && $i < 161)
        {
            $page_no = 13;
        }
        else if($i >= 161 && $i < 175)
        {
            $page_no = 14;
        }
        else if($i >= 175 && $i < 186)
        {
            $page_no = 15;
        }
        else if($i >= 186 && $i < 200)
        {
            $page_no = 16;
        }
        else if($i >= 200 && $i < 211)
        {
            $page_no = 17;
        }
        else if($i >= 211 && $i < 225)
        {
            $page_no = 18;
        }
        

        $print_date = $cl['renewal_date'];
        
        $renewal_amt = ($passbookbalance + $cl['renewal_amt']);


        $data['customer_id'] = $customer_id;
        $data['account_id'] = $acc_id;
        $data['print_date'] = $print_date;
        $data['page_no'] = $page_no;
        $data['total_amt'] = $renewal_amt;
        $insert=insert_data(PASS_BOOK,$data); 

        $i++; 
        $passbookbalance = $renewal_amt;
    }
 }

 echo 1;

}


if(isset($_REQUEST['customer_id']))
{
    $customer_id = $_GET['customer_id'];
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
 $select = mysqli_query($CN,"SELECT * FROM ".ACCOUNT_MASTER." WHERE customer_id = '$customer_id' and status!=3 ");
	
 
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

             