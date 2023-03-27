<?php
 
$account_details=$_POST['loan_term_num'];
$loan_details=$_POST['loan_term_int'];
$loan_type=$_POST['loan_type'];
// echo $account_details;
// echo $loan_details;
// echo $loan_type;
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

$sql = "INSERT INTO adn_loan_term_master (loan_term_no, loan_term_interest, loan_type, status)
VALUES ('$account_details', '  $loan_details', '$loan_type','1')";

if ($conn->query($sql) === TRUE) {
   echo "<script type='text/javascript'>window.location='loan_add.php?customer_id=".$last_id."&success=Details Added Successfully';</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<?php
 if(isset($_GET['account_id']) && $_GET['account_id']!="" )
 {
 $account_id=$_GET['account_id'];
$account_details=$_POST['loan_term_numupdate'];
$loan_details=$_POST['loan_term_intupdate'];
}
$servername = "localhost";
$username = "uusqfgmy_demo";
$password = "demo@2022";
$dbname = "uusqfgmy_demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE  adn_loan_term_master SET (loan_term_no, loan_term_interest, status)
VALUES ('$account_details', '$loan_details', '1') WHERE loan_term_id='$account_id'";

if ($conn->query($sql) === TRUE) {
 //  echo "<script type='text/javascript'>window.location='loan_add.php?customer_id=".$last_id."&success=Details Added Successfully';</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>