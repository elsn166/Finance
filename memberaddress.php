// check whether all the mandatory fields are entered and then generate member no
// $customer_details=select_data(CUSTOMER_MASTER,"where customer_id='".$_GET['customer_id']."'");

// $customer_name = $customer_details[0]['customer_name'];
// $father_name = $customer_details[0]['father_name'];
// $husband_name = $customer_details[0]['husband_name'];
// $gender_id = $customer_details[0]['gender_id'];
// $employee_id = $customer_details[0]['employee_id'];
// $marital_status_id = $customer_details[0]['marital_status_id'];
// $occupation_id = $customer_details[0]['occupation_id'];
// $employment_id = $customer_details[0]['employment_id'];
// $income_id = $customer_details[0]['income_id'];
// $proof_of_identity = $customer_details[0]['proof_of_identity'];
// $proof_of_addr = $customer_details[0]['proof_of_addr'];

// if($proof_of_identity !='')
// {
//   $split_identity_proof = explode(',',$proof_of_identity);
//   for($j = 0;$j<count($split_identity_proof);$j++){
//     $type_id = $split_identity_proof[$j];
//     if($type_id==44)
//     {
//       $aadhar_no=$customer_details[0]['aadhar_no'];
//     }
//     else if($type_id==41)
//     {
//       $pan_no=$customer_details[0]['pan_no'];
//     }
//   }
// }

// if($proof_of_addr !='')
// {
//   $split_addr_proof = explode(',',$proof_of_addr);
//   for($j = 0;$j<count($split_addr_proof);$j++){
//     $type_id = $split_addr_proof[$j];
//     if($type_id==49)
//     {
//       $aadhar_no=$customer_details[0]['aadhar_no'];
//     }
  
//   }
// }

// if($customer_name!='' && $father_name!='' && $husband_name!='' && $gender_id!='' &&$employee_id!='' && $marital_status_id!='' && $occupation_id!='' && $employment_id!='' &&$income_id!='' && $proof_of_identity!='' && $proof_of_addr!='' && $aadhar_no!='' && $pan_no!='')
// {
//  // generating member number
//  $customer_details=select_data(CUSTOMER_MASTER,"ORDER BY customer_id ASC");
//  $count_val = count($customer_details);
//  $branch_code = branch_code($branch_id);
//  if($count_val==0)
//  {
//    $member_no = "AM00".$branch_code."00001";
//    $ref_no = "AM00-".$branch_code."-00001";
//  }
//  else
//  {
//    $ref_member_no = get_last_member_no();
//    $memberno = explode("-",$ref_member_no);
   
//    // $new_member_no = $memberno[2]+1;
//    $new_member_no = str_pad($memberno[2] + 1, 5, 0, STR_PAD_LEFT);

//    $member_no = "AM00".$branch_code.$new_member_no;
//    $ref_no = "AM00-".$branch_code."-".$new_member_no;
//  }

//  $data['customer_no'] = $member_no;
//  $data['ref_cus_no'] = $ref_no;

//     $update1=update_data(CUSTOMER_MASTER,$data,"customer_id",$_GET['customer_id']);
//     if($update1!=0)
//     { 

//     echo "<script type='text/javascript'>window.location='member_address.php?customer_id=".$_GET['customer_id']."&success=Details Updated Successfully';</script>";
//     }
// }
// else{
//   echo "<script type='text/javascript'>window.location='member_address.php?customer_id=".$_GET['customer_id']."&danger=Please fill all mandatory fields to generate member number';</script>";
// }


// }  
