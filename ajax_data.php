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

    if($rowp == 1 || $rowp == 3 || $rowp == 5 || $rowp == 7 || $rowp == 9 || $rowp == 11 || $rowp == 13 || $rowp == 15 || $rowp == 17 || $rowp == 19  || $rowp == 21 || $rowp == 23 || $rowp == 25 || $rowp == 27 || $rowp == 29 || $rowp == 31 || $rowp == 33 || $rowp == 35)
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
    else if($rowp == 2 || $rowp == 4 || $rowp == 6 || $rowp == 8 || $rowp == 10 || $rowp == 12 || $rowp == 14 || $rowp == 16 || $rowp == 18 || $rowp == 20 || $rowp == 22 || $rowp == 24 || $rowp == 26 || $rowp == 28 || $rowp == 30 || $rowp == 32 || $rowp == 34 || $rowp == 36)
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
         else if($i >= 225 && $i < 236)
        {
            $page_no = 19;
        }
         else if($i >= 236 && $i < 250)
        {
            $page_no = 20;
        }
         else if($i >= 250 && $i < 261)
        {
            $page_no = 21;
        }
         else if($i >= 261 && $i < 275)
        {
            $page_no = 22;
        }
         else if($i >= 275 && $i < 286)
        {
            $page_no = 23;
        }
         else if($i >= 286 && $i < 300)
        {
            $page_no = 24;
        }
        else if($i >= 300 && $i < 311)
        {
            $page_no = 25;
        }
        else if($i >= 311 && $i < 325)
        {
            $page_no = 26;
        }
         else if($i >= 325 && $i < 336)
        {
            $page_no = 27;
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


if(isset($_REQUEST['renewal_account_id']))
{
    global $CN;   
    $userid = $_GET['renewal_user_id'];
    $customer_id=$_GET['renewal_customer_id'];
    $account_id= $_GET['renewal_account_id'];
    $savings_renewal_amt= $_GET['savings_renewal_amt'];
    $savings_renewal_date= $_GET['savings_renewal_date'];
    $session_branch_id = $_GET['renewal_branch_id'];
    // insert date 20/10/2022
      $ecct_details = select_data(ACCOUNT_MASTER,"where account_id='$account_id'");
    if(count($ecct_details) > 0){
    $plan_id=$ecct_details[0]['plan_id'];
    $spl=$ecct_details[0]['senior_citizen'];
    $date=$ecct_details[0]['created_date'];
    $date1='2022-11-07';
    }
       $document_charge=select_data(SAVINGS_RENEWAL,"where account_id='$account_id'");
  
if(count($document_charge)>0)
{
    $document_amt = 0;
    $i=1;
    foreach($document_charge as $bl)
    {
      $document_amt = (int)$document_amt + (int)$bl['renewal_amt'];
    }
    
   
    // echo '10000';
}
     

    if($savings_renewal_date!=""){ 
      $savings_renewal_date = date("Y-m-d", strtotime($savings_renewal_date));
    }
    $status = 1;


    // check dupicate entry
    $check_duplicate = select_data(SAVINGS_RENEWAL,"where renewal_date='".$savings_renewal_date."' and account_id='".$account_id."'");
    if(count($check_duplicate)>0)
    {
       echo '1';
    }
    
    
    else{
          $ecct_details = select_data(PLAN_MASTER,"where plan_id='$plan_id'");
    if(count($ecct_details) > 0){
      $plan_intt1=$ecct_details[0]['plan_interest'];
      $plan_intt2=$ecct_details[0]['plan_spl_interest'];
      $plan_term_value=$ecct_details[0]['plan_term_value'];
       $plan_id=$ecct_details[0]['plan_type_id'];
      $plan_term=$ecct_details[0]['plan_term'];
      $plan_code=$ecct_details[0]['plan_code'];
      
}

//if ($plan_term==10 && $plan_term_value =='Y') {
    $days="3650";
//}else        

//if ($plan_term==6 && $plan_term_value =='Y' && $paln_code='F1') {    
 //   $days="1";
//}else
//if ($plan_term==6 && $plan_term_value =='M'&& $paln_code='FM') {
  //  $days="26";
//}else
if($date >= $date1){ 
if (($plan_term==3) and ($plan_term_value =='Y') and ($paln_code='D3')){
$days="1095";
}elseif (($plan_term==2) and ($plan_term_value =='Y') and ($paln_code='D2')){
$days="730";
}elseif (($plan_term==1) and ($plan_term_value =='Y' )and ($paln_code='D1') ){
$days="365";
}elseif (($plan_term==180) and ($plan_term_value =='D') and ($paln_code='DM')){
$days="180";
}elseif (($plan_term=='1')and ($plan_term_value =='Y' )and ($paln_code='W1') ){
$days="52";
}elseif (($plan_term==100 )and ($plan_term_value =='D' )and ($paln_code='DH') ){
    $days="1";
}else{
    
}
if ($spl=='0') {
    $plan_intt=$plan_intt1;
}else        
if ($spl=='1') {
    $plan_intt=$plan_intt2;
}
if($plan_intt == '0')
{
$plan_intt = '0';
}

if($plan_id==3 && $plan_term==1 && $plan_term_value =='Y' && $paln_code='R1' )
{
$num_str1 = "$document_amt";
$num_str2 = "$plan_intt";
$num1=$num_str2/100;
$num=$num1/12;
$int_1=$document_amt+$int+$savings_renewal_amt;
$tot=$document_amt+$int;
}else if($plan_id==3 && $plan_term==2 && $plan_term_value =='Y' && $paln_code='R2'){

$num_str1 = "$document_amt";
$num_str2 = "$plan_intt";
$num1=$num_str2/100;
$num=$num1/24;
$int_1=$document_amt+$int+$savings_renewal_amt;
$tot=$document_amt+$int;
}else if($plan_id==3 && $plan_term==10 && $plan_term_value =='Y' && $paln_code='TM'){
  $num_str1 = "$document_amt";
  $int_1=0;
  $num=0;
  $tot=$document_amt+$int;
}
if($plan_id==2 ){
$num_str1 = "$document_amt";
$num_str2 = "$plan_intt";
$num1=$num_str2/100;
$num=$num1/52;
$int_1=$document_amt+$int+$savings_renewal_amt;
$tot=$document_amt+$int;
}else
if($plan_id==1 ){
$num_str1 = "$document_amt";
$num_str2 = "$plan_intt";
$num1=$num_str2/100;
$num=$num1/$days;
$int_1=$document_amt+$int+$savings_renewal_amt;
$tot=$document_amt+$int;
}

// calculates the multiplication of the two
// numbers when $scaleVal is not specified
//$res=$num_str1*$num;
$res=$int_1*$num;
$res1=$res+$num_str1;
$res2=$res1+$num_str1;
$res3=$res2*$num;
$res4=$res2+$res3;
$res6=$num_str1+$document_amt;
$res7=$res6*$num;
//$res5=$document_amt*$num;

//$i=0;
//$num_str1 ="0";
//$num_str3=500;
//while($i <= 100) {
//$num_str1 = "500";
//$num_str1=$num_str1+500;
//$num_str2 = "5.8";
//$num=$num_str2/100;
// calculates the multiplication of the two
// numbers when $scaleVal is not specified
//$num_str4=$num_str1*$num;//
//$num_str1=$num_str4+500;
  //echo "The number is: $num_str1 <br>";
  //$i++;
//


//echo( ($num_str1)."<br>");
echo( ($res)."<br>");
echo( ($int_1)."<br>");
//echo( ($res)."<br>");
echo( ($tot)."<br>");
echo( ($plan_code)."<br>");
echo( ($plan_intt)."<br>");
echo( ($plan_term)."<br>");
echo( ($plan_term_value)."<br>");
echo( ($days)."<br>");
echo( ($date)."<br>");
//echo( ($res2)."<br>");
//echo( ($res3)."<br>");
//echo( ($res4)."<br>");
//echo( ($document_amt)."<br>");
//echo( ($res6)."<br>");
//echo( ($res7)."<br>");

//echo $num;
//insert end 20/10/2022
}else{
    
}
  $ecct_details = select_data(SAVINGS_RENEWAL,"where account_id='$account_id' ORDER BY renewal_date DESC");
    if(count($ecct_details) > 0){
      $entair_amt=$ecct_details[0]['renewal_amt'];
       $int=$ecct_details[0]['interest'];
    }
         
            
        $data['customer_id']=$customer_id;
        $data['account_id'] = $account_id;
        $data['renewal_amt'] = $savings_renewal_amt;
        $data['renewal_date'] = $savings_renewal_date;
        $data['interest'] = $res;
        $data['status'] = $status;
        $data['default_entry'] = 0;
        $data['created_date']= date("Y-m-d H:i:s");
        $data['created_by']=$userid;
        $insert=insert_data(SAVINGS_RENEWAL,$data); 
             
// PHP program to illustrate bcmul() function
   
// input numbers with arbitrary precision
   
   


        if($insert!=0)
        { 

        //check whether for expense date entry exists in tally list table
        $get_tally_details = select_data(TALLY_MASTER,"where date='".$savings_renewal_date."' and branch_id='".$session_branch_id."'");
        if(count($get_tally_details )>0)
        {

            $sav_renew_details=select_data(TALLY_MASTER,"where date='".$savings_renewal_date."' and branch_id='".$session_branch_id."'");
            $savrenewamt=$sav_renew_details[0]['savings_renewal_amt'];
            $new_savrenew_amt = $savings_renewal_amt;
            // $savrenewdata['savings_renewal_amt']=$savrenewamt+$new_savrenew_amt;
            // $updatetally=update_data(TALLY_MASTER,$savrenewdata,"date",$savings_renewal_date);

            $nsaverenewamt = $savrenewamt+$new_savrenew_amt;
            $update_tallyqry="UPDATE ".TALLY_MASTER." set savings_renewal_amt='$nsaverenewamt' where date='$savings_renewal_date' and branch_id='$session_branch_id'";
            $updatetally = mysqli_query($CN,$update_tallyqry);

        }
        else{

            $savrenewdata['savings_renewal_amt']=$savings_renewal_amt;
            $savrenewdata['date'] = $savings_renewal_date;
            $savrenewdata['branch_id'] = $session_branch_id;
            $insert=insert_data(TALLY_MASTER,$savrenewdata); 

        }


        $customerlist = select_data(CUSTOMER_MASTER," where customer_id='".$customer_id."'");
        $cus_branch_id = $customerlist[0]['branch_id'];
        $mob_no = $customerlist[0]['mobile_number'];
        $customer_name = $customerlist[0]['customer_name'];
        $status=$customerlist[0]['sms'];

        $accountlist = select_data(ACCOUNT_MASTER," where account_id='".$account_id."'");
        $acc_no = $accountlist[0]['account_no']; 

        $savings_renewal_list = select_data(SAVINGS_RENEWAL," where account_id='".$account_id."'");

        $total_amt=0;
        if(count($savings_renewal_list) > 0)
        { 
            
            foreach($savings_renewal_list as $ad)
            {

                $total_amt = $total_amt+$ad['renewal_amt'];

            }
        }
        
        $current_date = date('Y-m-d');
        $prev_date = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $current_date) ) ));
        $prev_one_date = date('Y-m-d',(strtotime ( '-2 day' , strtotime ( $current_date) ) ));
        
        if($savings_renewal_date == $current_date || $savings_renewal_date == $prev_date || $savings_renewal_date == $prev_one_date)
        {
            // sms sending function
            if($cus_branch_id==1 || $cus_branch_id==4 || $cus_branch_id==3 || $cus_branch_id==2 || $customer_id == 712 || $customer_id== 17 || $customer_id == 719 || $customer_id == 373)
            // {
                if($status='yes'|| $status=''){
                $send_sms = send_sms_account_renewal($mob_no,$acc_no,$customer_name,$savings_renewal_date,$savings_renewal_amt,$total_amt);
                }
                    
                
        }

        
        
        } // date codt check





        echo '0';

    }


    

}




if(isset($_REQUEST['renewal_loan_id']))
{
    global $CN;   
    $userid = $_GET['loan_renewal_user_id'];
    $customer_id=$_GET['loan_renewal_customer_id'];
    $loan_id= $_GET['renewal_loan_id'];
    $loan_renewal_amt= $_GET['loan_renewal_amt'];
    $loan_renewal_date= $_GET['loan_renewal_date'];
    $session_branch_id = $_GET['loan_renewal_branch_id'];

    if($loan_renewal_date!=""){ 
      $loan_renewal_date = date("Y-m-d", strtotime($loan_renewal_date));
    }
    $status = 1;


    // check dupicate entry
    $check_duplicate = select_data(LOAN_RENEWAL,"where loan_renewal_date='".$loan_renewal_date."' and loan_id='".$loan_id."'");
    if(count($check_duplicate)>0)
    {
       echo '1';
    }
    else{
        $data['customer_id']=$customer_id;
        $data['loan_id'] = $loan_id;
        $data['loan_renewal_amt'] = $loan_renewal_amt;
        $data['loan_renewal_date'] = $loan_renewal_date;
        $data['status'] = $status;
        $data['created_date']= date("Y-m-d H:i:s");
        $data['created_by']=$userid;

        $insert=insert_data(LOAN_RENEWAL,$data); 

        if($insert!=0)
        { 

        //check whether for expense date entry exists in tally list table
        $get_tally_details = select_data(TALLY_MASTER,"where date='".$loan_renewal_date."' and branch_id='".$session_branch_id."'");
        if(count($get_tally_details )>0)
        {

            $loan_renew_details=select_data(TALLY_MASTER,"where date='".$loan_renewal_date."' and branch_id='".$session_branch_id."'");
            $loanrenewamt=$loan_renew_details[0]['loan_renewal_amt'];
            $new_loanrenew_amt = $loan_renewal_amt;
            // $savrenewdata['savings_renewal_amt']=$savrenewamt+$new_savrenew_amt;
            // $updatetally=update_data(TALLY_MASTER,$savrenewdata,"date",$savings_renewal_date);

            $nloanrenewamt = (int)$loanrenewamt+$new_loanrenew_amt;
            $update_tallyqry="UPDATE ".TALLY_MASTER." set loan_renewal_amt='$nloanrenewamt' where date='$loan_renewal_date' and branch_id='$session_branch_id'";
            $updatetally = mysqli_query($CN,$update_tallyqry);

        }
        else{

            $loanrenewdata['loan_renewal_amt']=$loan_renewal_amt;
            $loanrenewdata['date'] = $loan_renewal_date;
            $loanrenewdata['branch_id'] = $session_branch_id;
            $insert=insert_data(TALLY_MASTER,$loanrenewdata); 

        }


                // sms sending function
                // $send_sms = send_sms_account_renewal($mob_no,$acc_no,$customer_name,$savings_renewal_date,$savings_renewal_amt,$total_amt);

        }

        echo '0';

    }


    

}


?>

             