<?php

 $account_id=$_POST['account_id'];
$account_details=$_POST['loan_term_numupdate'];
$loan_details=$_POST['loan_term_intupdate'];
$state=$_POST['status'];
$loan_type=$_POST['loan_type'];

$servername = "localhost";
$username = "u309950752_finance";
$password = "Finance@123";
$dbname = "u309950752_finance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE  adn_loan_term_master SET loan_term_no='$account_details', loan_term_interest='$loan_details' ,status='$state',loan_type='$loan_type' WHERE loan_term_id='$account_id'";

if ($conn->query($sql) === TRUE) {
  echo "<script type='text/javascript'>window.location='loan_add.php?customer_id=".$last_id."&success=Details Added Successfully';</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>