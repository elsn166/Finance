<?php

require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");
 

if(isset($_GET['employee_id']) && $_GET['employee_id']!="" )
{

  $employee_id=$_GET['employee_id'];

  $employee_details=select_data(EMPLOYEE_MASTER,"where employee_id='".$employee_id."'");
  $employee_name = $employee_details[0]['employee_name'];
  $employee_code = $employee_details[0]['employee_code'];
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
	border: 1px solid black;
}

tr {
	border: 1px solid black;
}

td {
    border: 1px solid black;
    padding-left: 5px;
    /*padding:2px;*/
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
  top: 130px;
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



    <img class="watermark" src="images/ADN1.png"/>

    <table style="table-layout:fixed;width:100%;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;">
            <colgroup>
                <col style="width:10%;">
                <col style="width:40%;">
                <col style="width:30%;">
                <col style="width:30%;">
            </colgroup>
            
    <thead>
              
			
		<tr>
			
			<td  colspan="4" width="25%" style="border-bottom: 1px solid black; text-align:center;background-color:white;">
			<span style="color:#000000;  font-size:13px"><img src="images/ADN.png" width="80" height="80"></span>
			<h1 style="font-size:18px;font-weight:800;">AMUDHINI MULTIPURPOSE KOOTURAVU SANGAM NIDHI LIMITED</h1>
      <h2 style="font-size:14px;font-weight:800;">Reg. No. CIN U65990TN2021PLN141344</h2>
<h5>Regd.Office:1/163,P.S.S.Nivas Building First Floor, Keelapallivasal Street, Paramakudi - 623707.</h5>
      </td>
			
		
		</tr>


        </thead>
        
    <tr style="height:100px;">
   <td colspan="4">

   <div style="text-align: left;">
   
   <b> Employee Name: <?php echo $employee_name; ?></b>  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
      <b> Employee Code: <?php echo $employee_code; ?> </b> </div>
   </tr>

   <table style="table-layout:fixed;width:100%;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;">
                
                <thead>
                <tr>
                  <th width="10%">S. No</th>
                  <th width="25%">Name</th>
                  <th width="25%">Account No</th>
                  <th width="25%">Mobile No</th>
                  <th width="10%">Plan</th>
                  <th width="10%">Amount</th>
                  <th width="10%">Payment</th>
                </tr>
                </thead>

                
                <tbody>

   
<?php $customer_list=select_data(CUSTOMER_MASTER," where employee_id='".$_GET['employee_id']."' ");
if(count($customer_list)>0)
{

$j=1;
$k=1;
$l=1;
$s=1;

?>


<tr><td colspan="6" style="text-align:center;"><strong>DAILY SAVINGS</strong><td><tr>

<?php 

 $plan_list = select_data(PLAN_MASTER," where plan_type_id=1 order by plan_id ASC ");
 if(count($plan_list)>0)
 { 
 
  

  foreach($plan_list as $pl)
  {
    


    ?>

  <tr><td colspan="6" style="text-align:center;"><strong><?php echo $pl['plan_code'];?></strong><td><tr>

<?php
  $daily_account_details = select_data(ACCOUNT_MASTER," where plan_id='".$pl['plan_id']."' and plan_type_id=1 and  status !='3' and customer_id in (select customer_id from ".CUSTOMER_MASTER." where employee_id='".$_GET['employee_id']."' )");

  // print_r(count($daily_account_details));

  if(count($daily_account_details)>0)
  { 
    $i=1;
   foreach($daily_account_details as $dad)
   { 
      $customer_id = $dad['customer_id'];
      $acc_no = $dad['account_no'];
      $customer_name = customer_name($customer_id);
      $mobile_number = customer_mobile_no($customer_id);
    ?>
            <tr>
              <td width="10%"><?php echo $i;?></td>
              <td width="25%"><?php echo $customer_name; ?></td>
              <td width="25%"><?php echo $acc_no; ?></td>
              <td width="25%"><?php echo $mobile_number; ?></td>
              <td width="10%"><?php echo $pl['plan_code']; ?></td>
              <td width="10%"><?php echo $dad['amount']; ?></td>
              <td></td>
            </tr>   
<?php 
     $i++;
     } // foreach($daily_account_details as $dad)

    } //if(count($daily_account_details)>0)
   

}//foreach($plan_list as $pl)

  }//if(count($plan_list)>0)

 ?>
 
 <tr><td colspan="6" style="text-align:center;"><strong>MONTHLY SAVINGS</strong><td><tr>


<?php
//second foreach

  foreach($customer_list as $cl)
  {
    $customer_id = $cl['customer_id'];
    $customer_name = $cl['customer_name'];
    $mobile_number = $cl['mobile_number'];


        $monthly_account_details = select_data(ACCOUNT_MASTER," where customer_id='".$customer_id."' and plan_type_id=3 and  status !='3' ");
        if(count($monthly_account_details)>0)
        {
        foreach($monthly_account_details as $dad)
        { 
          $plan_id = $dad['plan_id'];
          $plan_details = select_data(PLAN_MASTER," where plan_id='".$plan_id."'");
          $plan_code = $plan_details[0]['plan_code'];
          ?>
        <tr>
          <td width="10%"><?php echo $j;?></td>
          <td width="25%"><?php echo $customer_name; ?></td>
          <td width="25%"><?php echo $dad['account_no']; ?></td>
          <td width="25%"><?php echo $mobile_number; ?></td>
          <td width="10%"><?php echo $plan_code; ?></td>
          <td width="10%"><?php echo $dad['amount']; ?></td>
          <td width="10%"></td>
        </tr>         
      <?php  }
    }
    else{

      $j--;
    }
    $j++;

  } //second foreach
?>

  <tr><td colspan="6" style="text-align:center;"><strong>WEEKLY SAVINGS</strong><td><tr>


  <?php
  //third foreach
  
      foreach($customer_list as $cl)
      {
        $customer_id = $cl['customer_id'];
        $customer_name = $cl['customer_name'];
        $mobile_number = $cl['mobile_number'];
  
  
            $weekly_account_details = select_data(ACCOUNT_MASTER," where customer_id='".$customer_id."' and plan_type_id=2 and  status !='3' ");
            if(count($weekly_account_details)>0)
            {
            foreach($weekly_account_details as $wad)
            { 
              $plan_id = $wad['plan_id'];
              $plan_details = select_data(PLAN_MASTER," where plan_id='".$plan_id."'");
              $plan_code = $plan_details[0]['plan_code'];
              ?>
            <tr>
              <td><?php echo $k;?></td>
              <td><?php echo $customer_name; ?></td>
              <td><?php echo $wad['account_no']; ?></td>
              <td><?php echo $mobile_number; ?></td>
              <td><?php echo $plan_code; ?></td>
              <td><?php echo $wad['amount']; ?></td>
              <td></td>
            </tr>         
          <?php  }
        }
        else{
  
          $k--;
        }
        $k++;
   
      } //third foreach

?>

 <tr><td colspan="6" style="text-align:center;"><strong>PERSONAL LOAN</strong><td><tr>

 <?php
    //fourth foreach
    
        foreach($customer_list as $cl)
        {
          $customer_id = $cl['customer_id'];
          $customer_name = $cl['customer_name'];
          $mobile_number = $cl['mobile_number'];
    
    
              $loan_details = select_data(LOAN_MASTER," where customer_id='".$customer_id."' and status !='4' ");
              if(count($loan_details)>0)
              {
              foreach($loan_details as $wad)
              { 
                $loan_term_id = $wad['loan_term_id'];
                $loan_term_details = select_data(LOAN_TERM_MASTER," where loan_term_id='".$loan_term_id."'");
                $loan_term_no = $loan_term_details[0]['loan_term_no'];
                ?>
              <tr>
                <td><?php echo $s;?></td>
                <td><?php echo $customer_name; ?></td>
                <td><?php echo $wad['loan_no']; ?></td>
                <td><?php echo $mobile_number; ?></td>
                <td><?php echo $loan_term_no; ?></td>
                <td><?php echo $wad['loan_amount']; ?></td>
                <td></td>
              </tr>         
            <?php  }
          }
          else{
    
            $s--;
          }
          $s++;
     
        } //fourth foreach
        
        ?>
       
     

  <?php

} //if
?>
</tbody>
                
      </table>
   
  </table>

        

    </div>
</body>
</html>
