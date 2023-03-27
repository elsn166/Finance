<?php
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");
 
$from_date = date('Y-m-d', strtotime($_GET['from_date']));
$to_date = date('Y-m-d', strtotime($_GET['to_date']));
$customer_id = date('Y-m-d', strtotime($_GET['customer_id']));
$account_id = date('Y-m-d', strtotime($_GET['account_id']));

$session_branch_id = $_GET['branch_id'];

  
$customer_list=select_data(SAVINGS_RENEWAL," where customer_id='".$_GET['customer_id']."' and account_id='".$_GET['account_id']."' and renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by savings_renewal_id asc");



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
<body>
<input type="button" value="Print Page" id="but" onclick="javascript:printDiv('printablediv')" /> 
    <script>
        function myFunction() {
            window.print();
        }

    </script>



   
    
      
   

    <div id="printablediv">



    <!-- <img class="watermark" src="images/ADN1.png"/> -->

    <!-- <table style="table-layout:fixed;width:700px;height:600px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:90px;margin-left:100px" cellspacing="0" cellpadding="0"> -->

    <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:70px;margin-left:100px;table-border:0" cellspacing="0" cellpadding="0">
    
            <colgroup>
                <col style="width:5%;">
                <col style="width:15%;">
                <col style="width:15%;">
                <col style="width:15%;">
                <col style="width:20%;">
                <col style="width:15%;">
                <col style="width:15%;">
            </colgroup>
            
  
         <thead>
         <!-- <tr>
    <td width="5%" style="text-align: center; vertical-align: middle;"><b>S. No</b></td>
    <td width="15%" style="text-align: center; vertical-align: middle;"><b>Date</b></td>
    <td width="15%" style="text-align: center; vertical-align: middle;"><b>Particulars</b></td>
    <td width="15%" style="text-align: center; vertical-align: middle;"><b>Withdrawals</b></td>
    <td width="20%" style="text-align: center; vertical-align: middle;"><b>Deposits</b></td>
    <td width="15%" style="text-align: center; vertical-align: middle;"><b>Balance</b></td>
    <td width="15%" style="text-align: center; vertical-align: middle;"><b>Remarks</b></td>
    </tr> -->
        
    
      
      </thead>


       
      <tbody>

     
<?php 


$customer_list=select_data(SAVINGS_RENEWAL," where customer_id='".$_GET['customer_id']."' and account_id='".$_GET['account_id']."' and renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by savings_renewal_id asc");
$overall_count = 10;
if(count($customer_list) > $overall_count)
{
  $totalcount = 0;
}
else{
  $totalcount = $overall_count - count($customer_list) ;
}


if(count($customer_list)>0)
{

    $i=1;
    foreach($customer_list as $cl)
    {
      
      $date = date('d-m-Y', strtotime($cl['renewal_date']));
      $deposit_amt = $cl['renewal_amt'];
?>
     
        <tr>
          <td style="text-align:center;"><?php echo $i;?></td>
          <td style="text-align:center;"><strong><?php echo $date; ?></strong></td>
          <td style="text-align:center;"><?php echo '-'; ?></td>
          <td style="text-align:center;"><?php echo '-'; ?></td>
          <td style="text-align:center;"><?php echo $deposit_amt; ?></td>
          <td style="text-align:center;"><?php echo '-'; ?></td>
          <td style="text-align:center;"><?php echo '-'; ?></td>
          
        </tr>         
          
    <?php   $i++; }

    for($v=1;$v<=$totalcount;$v++)
    { ?>
        <tr>
          <td style="text-align:center;"><?php echo '';?></td>
          <td style="text-align:center;"><?php echo ''; ?></td>
          <td style="text-align:center;"><?php echo ''; ?></td>
          <td style="text-align:center;"><?php echo ''; ?></td>
          <td style="text-align:center;"><?php echo ''; ?></td>
          <td style="text-align:center;"><?php echo ''; ?></td>
          <td style="text-align:center;"><?php echo ''; ?></td>
        </tr>    
    <?php }
       
      }
   ?>
   
   
 </tbody>
  
  
  </table>

        

    </div>
</body>
</html>
