<?php
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");
 

$customer_id =$_GET['customer_id'];
$account_id = $_GET['account_id'];
$branch_id = $_GET['branch_id'];

$customer_details=select_data(CUSTOMER_MASTER,"where customer_id='".$customer_id."'");
$customer_name = $customer_details[0]['customer_name'];
$customer_no = $customer_details[0]['customer_no'];

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


<div style="margin-top:360px;margin-left:110px;font-weight: bolder;">

<strong>Amudhini Nidhi Limited</strong><br><br>

Branch: [<?php echo $branch_code; ?>] <?php echo $branch_name; ?> <br><br>

Account No: <?php echo $account_no; ?><br><br>

<?php echo $customer_name; ?> <br><br>

<?php echo $door_no; ?><br>
<?php echo $address; ?><br>
<?php echo $district_name; ?><br>
<?php echo $district_name; ?>, TAMILNADU, INDIA, PIN-<?php echo $pin_code;?><br>


</div>


</div>

 

</body>
</html>
