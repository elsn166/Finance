<?php
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");
 

$customer_id =$_GET['customer_id'];
$account_id = $_GET['account_id'];


$customer_details=select_data(CUSTOMER_MASTER,"where customer_id='".$customer_id."'");
$customer_name = $customer_details[0]['customer_name'];
$customer_no = $customer_details[0]['customer_no'];
$branch_id = $customer_details[0]['branch_id'];

$door_no =  $customer_details[0]['door_no'];
$address =  $customer_details[0]['address'];
$district_id =  $customer_details[0]['district_id'];

$district_details = select_data(DISTRICT_MASTER,"where district_id='".$district_id."'");
$district_name = $district_details[0]['district_name'];
$pin_code = $customer_details[0]['pincode'];

$account_details=select_data(ACCOUNT_MASTER,"where account_id='".$account_id."'");
$account_no = $account_details[0]['account_no'];

$branch_details=select_data(BRANCH_MASTER,"where branch_id='".$branch_id."'");
$branch_code= $branch_details[0]['branch_code'];
$branch_name = $branch_details[0]['branch_name'];
$branch_door_no = $branch_details[0]['door_no'];
$branch_address = $branch_details[0]['address'];
$branch_district_id = $branch_details[0]['district_id'];
$branch_district_details = select_data(DISTRICT_MASTER,"where district_id='".$branch_district_id."'");
$branch_district_name = $branch_district_details[0]['district_name'];

$branch_pin_code = $branch_details[0]['pincode'];

$creationdate = $account_details[0]['date'];
$account_date = date("d-m-Y", strtotime($creationdate));

$account_amt = $account_details[0]['amount'];

$planlist=select_data(PLAN_MASTER," where plan_id='".$account_details[0]['plan_id']."'");
$plan_code = $planlist[0]['plan_code'];
$plan_term = $planlist[0]['plan_term'];
$plan_term_value=$planlist[0]['plan_term_value'];

if($plan_term_value == 'D')
{
  $plan_term_val = 'Days';
}
else if($plan_term_value == 'Y')
{
  $plan_term_val = 'Year';
}

if($plan_term == "1" && $plan_term_value == 'Y')
{
$maturity_date=date('d-m-Y', strtotime('+1 year', strtotime($creationdate)) );
}
else if($plan_term == "100" && $plan_term_value == 'D')
{
$maturity_date=date('d-m-Y', strtotime('+100 days', strtotime($creationdate)) );

}
else if($plan_term == "180" && $plan_term_value == 'D')
{
$maturity_date=date('d-m-Y', strtotime('+180 days', strtotime($creationdate)) );
}
else if($plan_term == "2" && $plan_term_value == 'Y')
{
  $maturity_date=date('d-m-Y', strtotime('+2 year', strtotime($creationdate)) );
}
else if($plan_term == "10" && $plan_term_value == 'Y')
{
  $maturity_date=date('d-m-Y', strtotime('+10 year', strtotime($creationdate)) );
}


?>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js"> </script>
    <script language="javascript" type="text/javascript">


      
        function printDiv(divID) {

        
          
                //Get the HTML of div
                var divElements = document.getElementById(divID).innerHTML;
                //Get the HTML of whole page
                var oldPage = document.body.innerHTML;

                //Reset the page's HTML with div's HTML only
                document.body.innerHTML =
                    "<html><head><title></title></head><body>" +
                    divElements + "</body>";

                //Print Page
                window.print();

                //Restore orignal HTML
                document.body.innerHTML = oldPage;
          
            


        }
    </script>
    <style type="text/css">

    
       #header {
  display: table-header-group;
}

#main {
  display: table-row-group;
}

#footer {
  display: table-footer-group;
      bottom: 0px
}


table {
	border-collapse: collapse;
}

table {
	border: 0px solid black;
}

tr {
	border: 0px solid black;
}

td {
    border: 0px solid black;
    padding-left: 5px;
    padding:5px;
    /* font-family: Times New Roman !important; */
}

tr:nth-child(odd) { 
            background-color:white; 
        } 


@media print {
  #but {
    display: none;
  }

  


  tr:nth-child(odd) { 
            background-color:white; 
        } 

}


.watermark { opacity: 0.2;
  position: fixed;
  left: 0;
  top: 20px;
  width: 100%;
  height: auto; }
.watermark::after { position: absolute; bottom: 0; right: 0; content: "COPYRIGHT"; }

</style>

</head>
<body style="background-color:#b8bb53;">



<input type="button" value="Print Page" id="but" onclick="javascript:printDiv('printablediv')" /> 


  
<div id="printablediv">

<div style="margin-top:20px;margin-left:10px;">

<div style="font-weight:bolder;"><?php echo $customer_name; ?></div>

<div style="font-weight:bolder;margin-top:-15px;margin-left:200px;">Branch: <?php echo $branch_name; ?></div>


<div style="font-weight:bolder;margin-top:-17px;margin-left:440px;">A/c No: <?php echo $account_no; ?></div>

</div>



<div style="margin-top:295px;margin-left:10px;">

<div style="font-weight:bolder;margin-left:60px;">AMUDHINI MULTIPURPOSE KOOTURAVU SANGAM NIDHI LIMITED</div><br>

<!-- Left Side -->
<div>

<div style="font-weight:bolder;"><?php echo $customer_name; ?></div>
<?php echo $door_no; ?><br>
<?php echo $address; ?><br>
<?php echo $district_name; ?>, TAMILNADU, INDIA, PIN-<?php echo $pin_code;?><br><br>

<div style="font-weight:bolder;">Member No: <?php echo $customer_no; ?></div>
<div style="font-weight:bolder;">Account No: <?php echo $account_no; ?></div>
<div style="font-weight:bolder;">Date Of Issue: <?php echo $account_date; ?></div>
<div style="font-weight:bolder;">Date Of Maturity: <?php echo $maturity_date; ?></div>
<div style="font-weight:bolder;">Plan: <?php echo $plan_code; ?></div>
<div style="font-weight:bolder;">Term: <?php echo $plan_term." ".$plan_term_val; ?></div>
<div style="font-weight:bolder;">Installment: <?php echo $account_amt; ?></div>
<div style="font-weight:bolder;">MOP: <?php echo 'Single'; ?></div>


</div>
<!-- Left Side -->


<!-- Right Side -->
<div style="margin-top:-230px;margin-left:450px;">

<div style="font-weight:bolder;">Branch: BBC<?php echo $branch_code; ?> <?php echo $branch_name; ?></div>
<?php echo $branch_door_no; ?><br>
<?php echo $branch_address; ?><br>
<?php echo $branch_district_name; ?>, TAMILNADU, INDIA, PIN-<?php echo $branch_pin_code;?><br><br>


<div style="font-weight:bolder;">Cus. Care No: <?php echo '9025487308'; ?></div>


<br><br><br><br><br>
<div style="font-weight:bolder;">Authorised Signature</div>

</div>
<!-- Right Side -->



</div>

 

</body>
</html>
