<?php
ob_start();

function login($uname,$pass)
{
global $CN;
$query = "select employee_id,employee_name,password,role_id,branch_id,status from ".EMPLOYEE_MASTER." where employee_code='".$uname."' and password='".$pass."'";    
// print_r($query);
$result = mysqli_query($CN,$query);
	if(mysqli_num_rows($result)>0)
	{
		
		$row=mysqli_fetch_array($result);
		if($row['status'] == 1)
		{
			$_SESSION['emp_id']=$row['employee_id'];
			$_SESSION['emp_name']=$row['employee_name'];
			$_SESSION['role_id']=$row['role_id'];
			$_SESSION['bid']=$row['branch_id'];
			
			return 1;
		}
		else if($row['status'] == 0){

			return 2; 
		}
		
	}
	else
	{
		return 3; 
	}
		
}

	 
function curPageName() 
{
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
} 


function select_data($tablename,$where="",$fields=" * ")
{
	global $CN,$select_count;
	
	@$select_count++;
	
	if($tablename=="")
		die("select_data(): Table name Required");
		
		if($where!="")
			$sql="SELECT $fields FROM $tablename $where";
			else
				$sql="SELECT $fields FROM $tablename";
				
					// print_r($sql);
				$result=mysqli_query($CN,$sql) or print(mysqli_error($CN)."select_data() - <br /> $sql".__LINE__);
				$data=array();
				while($row=mysqli_fetch_assoc($result))
				{
					foreach($row as $key=>$value)
					{
						$row[$key]=stripslashes($value);
					}
					array_push($data,$row);
					
				}
				return $data;
}

function insert_data($tablename,$data)
{
	// print_r($data);
	global $CN;
	if(!is_array($data) or $tablename=="")
		die("insert_data() : Invalid Data or Invalid Table Name");
		
		$result=mysqli_query($CN,"select * from $tablename");
		$field_count=mysqli_num_fields($result);
		$field_names=array();
		for($i=0;$i<$field_count;$i++)
			$field_names[]=mysqli_fetch_field_direct($result,$i)->name;
			
			$sql="INSERT IGNORE INTO $tablename ";
			
			$fields=array();
			$values=array();
			foreach($data as $key=>$value)
			{
				if(in_array($key,$field_names))
				{
					$fields[]=$key;
					$value=trim(addslashes($value));
					$values[]="'$value'";
				}
			}
			$sql.="(".implode(",",$fields).")";
			$sql.=" VALUES (".implode(",",$values).")";
            
			// print_r($sql);
			// exit();
			if(mysqli_query($CN,$sql))
				return mysqli_insert_id($CN);
				else
					// die(mysql_error($CN)."<br />$sql  at Line: ".__LINE__);
					$error=mysqli_errno($CN);
					$error_details=select_data(TBL_ERROR,"where error_codes='".$error."'");
					$error_desc=$error_details[0]['description'];
					echo '<div style="margin:10px; padding:10px; color:#cc2a32; border:1px solid #cc2a32; background:#f9d6d6;">'.$error_desc.'</div>';
					// echo "<b>".$error_desc."</b>";
}


// @Desc: Updata Data to a Table with the Array of Field Data: Return True if Pass
// @Parm: TableName, Data Array, KeyField, KeyValue
// @Dependancy: $CN Connection - connect_db.php
function update_data($tablename,$data,$keyfield,$valueif)
{
	//	echo '<pre>';
	//	print_r($data);
	//	exit;
	global $CN;
	if($data==""  or $tablename=="" or $keyfield=="" or $valueif=="")
		die("update_data() : Invalid Parms");
		
		$result=mysqli_query($CN,"select * from $tablename");
		$field_count=mysqli_num_fields($result);
		$field_names=array();
		for($i=0;$i<$field_count;$i++)
			$field_names[]=mysqli_fetch_field_direct($result,$i)->name;
			
			$sql="UPDATE $tablename set ";
			$fields=array();
			foreach($data as $key=>$value)
			{
				if(in_array($key,$field_names))
				{
					$value=trim(addslashes($value));
					$fields[]=" $key='$value'";
				}
			}
			$sql.=implode(",",$fields)." where $keyfield='$valueif'";
			// echo $sql; exit;
			if(mysqli_query($CN,$sql))
				return true;
				
}


function branch_code($branch_id){
	global $CN;
	$select = mysqli_query($CN,"SELECT branch_code FROM ".BRANCH_MASTER." WHERE branch_id = '$branch_id'");

	if($row = mysqli_fetch_array($select)){
	
		$branch_code = $row['branch_code'];
	
	}
	return $branch_code;
}


function branch_name($branch_id){
	global $CN;
	$select = mysqli_query($CN,"SELECT branch_name FROM ".BRANCH_MASTER." WHERE branch_id = '$branch_id'");

	if($row = mysqli_fetch_array($select)){
	
		$branch_name = $row['branch_name'];
	
	}
	return $branch_name;
}


function get_last_member_no($cusid,$session_branch_id)
{
	global $CN;
	
	$select = mysqli_query($CN,"SELECT ref_cus_no FROM ".CUSTOMER_MASTER." WHERE branch_id='$session_branch_id' and customer_id!='$cusid' ORDER BY customer_id DESC LIMIT 1");
    
	if($row = mysqli_fetch_array($select)){
	
		$customer_no = $row['ref_cus_no'];
	
	}
	return $customer_no;

}

function get_last_acc_no($accid,$session_branch_id,$acctplanid)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT ref_acc_no FROM ".ACCOUNT_MASTER." where account_id != '$accid' and branch_id = '$session_branch_id' and plan_id='$acctplanid' ORDER BY account_id DESC LIMIT 1");

	if($row = mysqli_fetch_array($select)){
	
		$acc_no = $row['ref_acc_no'];
	
	}
	return $acc_no;

}


function get_last_loan_no($loan_type_id,$session_branch_id,$loanid)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT ref_loan_no FROM ".LOAN_MASTER." where loan_type_id='$loan_type_id' and branch_id='$session_branch_id' and loan_id!='$loanid' ORDER BY loan_id DESC LIMIT 1");

	if($row = mysqli_fetch_array($select)){
	
		$loan_no = $row['ref_loan_no'];
	
	}
	return $loan_no;

}


function customer_name($customer_id){
	global $CN;
	$select = mysqli_query($CN,"SELECT customer_name FROM ".CUSTOMER_MASTER." WHERE customer_id = '$customer_id'");

	if($row = mysqli_fetch_array($select)){
	
		$customer_name = $row['customer_name'];
	
	}
	return $customer_name;
}

function customer_no($customer_id){
	global $CN;
	$select = mysqli_query($CN,"SELECT customer_no FROM ".CUSTOMER_MASTER." WHERE customer_id = '$customer_id'");

	if($row = mysqli_fetch_array($select)){
	
		$customer_no = $row['customer_no'];
	
	}
	return $customer_no;
}

function acc_no($acc_id){
	global $CN;
	$select = mysqli_query($CN,"SELECT account_no FROM ".ACCOUNT_MASTER." WHERE account_id = '$acc_id' and account_no is not null");
	$rowcount=mysqli_num_rows($select);
	if($rowcount > 0)
	{
	if($row = mysqli_fetch_array($select)){
	
		$account_no = $row['account_no'];
	
	}
}
else{
	$account_no = '-';
}
	return $account_no;
}



function customer_mobile_no($customer_id){
	global $CN;
	$select = mysqli_query($CN,"SELECT mobile_number FROM ".CUSTOMER_MASTER." WHERE customer_id = '$customer_id'");

	if($row = mysqli_fetch_array($select)){
	
		$mobile_number = $row['mobile_number'];
	
	}
	return $mobile_number;
}


function pmk_received($date)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT sum(expense_amount) as expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 21 and status=2 and expense_date='$date'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function ramnad_received($date)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT sum(expense_amount) as expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 22 and status=2 and expense_date='$date'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function mudhuvai_received($date)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT sum(expense_amount) as expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 20 and status=2 and expense_date='$date'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function ho_received($date)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT sum(expense_amount) as expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 19 and status=2 and expense_date='$date'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}


function pmk_remitted($date)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT sum(expense_amount) as expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 15 and status=2 and expense_date='$date'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function ramnad_remitted($date)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT sum(expense_amount) as expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 17 and status=2 and expense_date='$date'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function mudhuvai_remitted($date)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT sum(expense_amount) as expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 16 and status=2 and expense_date='$date'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function ho_remitted($date)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT sum(expense_amount) as expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 14 and status=2 and expense_date='$date'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}



// Branch id based

function pmk_received_branch($date,$session_branch_id)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 21 and status=2 and expense_date='$date' and branch_id='$session_branch_id'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function ramnad_received_branch($date,$session_branch_id)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 22 and status=2 and expense_date='$date' and branch_id='$session_branch_id'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function mudhuvai_received_branch($date,$session_branch_id)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 20 and status=2 and expense_date='$date' and branch_id='$session_branch_id'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function ho_received_branch($date,$session_branch_id)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 19 and status=2 and expense_date='$date' and branch_id='$session_branch_id'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}


function pmk_remitted_branch($date,$session_branch_id)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 15 and status=2 and expense_date='$date' and branch_id='$session_branch_id'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function ramnad_remitted_branch($date,$session_branch_id)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 17 and status=2 and expense_date='$date' and branch_id='$session_branch_id'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function mudhuvai_remitted_branch($date,$session_branch_id)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 16 and status=2 and expense_date='$date' and branch_id='$session_branch_id'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}

function ho_remitted_branch($date,$session_branch_id)
{
	global $CN;
	$select = mysqli_query($CN,"SELECT expense_amount FROM ".EXPENSE_MASTER." WHERE expense_type_id = 14 and status=2 and expense_date='$date' and branch_id='$session_branch_id'");

	if($row = mysqli_fetch_array($select)){
	
		$expense_amount = $row['expense_amount'];
	
	}
	else{
		$expense_amount = 0;
	}
	return $expense_amount;
}


function send_sms($mob_no,$member_no,$customer_name)
{
// Account details
$apiKey = urlencode('NmE0NTZkNzA0YjczNDc0ODc5NzU1YTQ4NWE0MzMzNmI=');
// Message details
$numbers = array($mob_no);
$sender = urlencode('AMKSNL');
$message = rawurlencode('Dear "'.$customer_name.'", Welcome to Amudhini. Customer ID is "'.$member_no.'". Thank you for joining us.');
 
$numbers = implode(',', $numbers);
 
// Prepare data for POST request
$data = array('apikey' => $apiKey, 'numbers' => $mob_no, 'sender' => $sender, 'message' => $message);
// Send the POST request with cURL
$ch = curl_init('https://api.textlocal.in/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
// Process your response here
return $response;

}

?>








