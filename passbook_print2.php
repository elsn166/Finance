<?php
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");
 
$from_date = date('Y-m-d', strtotime($_GET['from_date']));
$to_date = date('Y-m-d', strtotime($_GET['to_date']));
$customer_id =$_GET['customer_id'];
$account_id = $_GET['account_id'];

$session_branch_id = $_GET['branch_id'];


$passbooklist = select_data(PASS_BOOK," where customer_id='".$_GET['customer_id']."' ");
$pass_book_list = count($passbooklist);



if($pass_book_list > 0)
{
  // fetch last printed date of customer
  $select_print_date = mysqli_query($CN,"SELECT print_date FROM ".PASS_BOOK." WHERE customer_id = '$customer_id' order by pass_book_id desc limit 1");
  $row = mysqli_fetch_array($select_print_date);

  $last_printed_date = $row['print_date'];


  $select_page_no = mysqli_query($CN,"SELECT page_no FROM ".PASS_BOOK." WHERE customer_id = '$customer_id' order by pass_book_id desc limit 1");
  $rowp = mysqli_fetch_array($select_page_no);
  $rowp = $rowp['page_no'];

  $customerlist=select_data(SAVINGS_RENEWAL," where customer_id='".$_GET['customer_id']."' and account_id='".$_GET['account_id']."' and renewal_date > '".$last_printed_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");


  if($rowp == 1 || $rowp == 3 || $rowp == 5 || $rowp == 7 || $rowp == 9 || $rowp == 11 || $rowp == 13 || $rowp == 15 || $rowp == 17)
  {
    $page_list = select_data(PASS_BOOK," where customer_id='".$_GET['customer_id']."' and page_no='$rowp'");
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
    
    $page_list = select_data(PASS_BOOK," where customer_id='".$_GET['customer_id']."' and page_no='$rowp'");
    $page_list_count = count($page_list);
    $default = 14;
    $rem_page_list_count = $default - $page_list_count;

    if($rem_page_list_count == 0)
    {
      $rem_page_list_count = 11;
    }
  }

  $customer_list_count = count($customerlist);
  if($customer_list_count > $rem_page_list_count)
  {
    $customer_list=select_data(SAVINGS_RENEWAL," where customer_id='".$_GET['customer_id']."' and account_id='".$_GET['account_id']."' and renewal_date > '".$last_printed_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc limit ".$rem_page_list_count."");
  }
  else{
    $customer_list=select_data(SAVINGS_RENEWAL," where customer_id='".$_GET['customer_id']."' and account_id='".$_GET['account_id']."' and renewal_date > '".$last_printed_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
  }
  
  $pass_book_val = 1;
}
else{
  $last_printed_date = $from_date;

  $customerlist=select_data(SAVINGS_RENEWAL," where customer_id='".$_GET['customer_id']."' and account_id='".$_GET['account_id']."' and renewal_date >= '".$last_printed_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");

  $customer_list_count = count($customerlist);
  if($customer_list_count > 11)
  {
    $customer_list=select_data(SAVINGS_RENEWAL," where customer_id='".$_GET['customer_id']."' and account_id='".$_GET['account_id']."' and renewal_date >= '".$last_printed_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc limit 11");

  }
  else if($customer_list_count <= 11){
   
    $customer_list=select_data(SAVINGS_RENEWAL," where customer_id='".$_GET['customer_id']."' and account_id='".$_GET['account_id']."' and renewal_date >= '".$last_printed_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
  }

  $pass_book_val = 0;
}
  





?>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js"> </script>
    <script language="javascript" type="text/javascript">


        var cus_id = '<?php echo $_GET['customer_id']; ?>';
        var acc_id = '<?php echo $_GET['account_id']; ?>';
        var branch_id = '<?php echo $_GET['branch_id']; ?>';
        var from_date = '<?php echo $last_printed_date; ?>';
        var to_date = '<?php echo $_GET['to_date']; ?>';
        var pass_book_val = '<?php echo $pass_book_val; ?>';
        function printDiv(divID) {

          // alert(cus_id);
          // alert(acc_id);
          // alert(branch_id);
          // alert(from_date);
          // alert(to_date);
          
          var dataString = "passbook_cus_id="+cus_id+"&from_date="+from_date+"&to_date="+to_date+"&passbook_acc_id="+acc_id+"&passbook_branch_id="+branch_id+"&pass_book_val="+pass_book_val;


            $.ajax({ 
            type: "GET", 
            url: "ajax_data.php", 
            data: dataString, 
              
            success:function(data){ 

            // alert(data);
           
            if(data == 1)
            {
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
             

            
            }

          });



           


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
    padding:5px;
    /* font-family: Times New Roman !important; */
}

tr:nth-child(odd) { 
            background-color:white; 
        } 

tr:nth-child(even) { 
    background-color:white; 
} 
@media print {
  
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

<?php if($pass_book_list == 0)
{ ?>

<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:70px;margin-left:100px;">

<?php
}
else if($pass_book_list == 1 || $pass_book_list == 26 || $pass_book_list == 51 || $pass_book_list == 76 || $pass_book_list == 101)
{ ?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:95px;margin-left:100px;" >
<?php }
else if($pass_book_list == 2 || $pass_book_list == 27 || $pass_book_list == 52 || $pass_book_list == 77 || $pass_book_list == 102)
{ ?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:120px;margin-left:100px;" >
<?php }
else if($pass_book_list == 3 || $pass_book_list == 28 || $pass_book_list == 53 || $pass_book_list == 78 || $pass_book_list == 103)
{ ?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:145px;margin-left:100px;">
<?php }
else if($pass_book_list == 4 || $pass_book_list == 29 || $pass_book_list == 54 || $pass_book_list == 79 || $pass_book_list == 104){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:170px;margin-left:100px;">
<?php } 
else if($pass_book_list == 5 || $pass_book_list == 30 || $pass_book_list == 55 || $pass_book_list == 80 || $pass_book_list == 105){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:195px;margin-left:100px;">
<?php } 
else if($pass_book_list == 6 || $pass_book_list == 31 || $pass_book_list == 56 || $pass_book_list == 81 || $pass_book_list == 106){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:220px;margin-left:100px;">
<?php }
else if($pass_book_list == 7 || $pass_book_list == 32 || $pass_book_list == 57 || $pass_book_list == 82 || $pass_book_list == 107){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:245px;margin-left:100px;">
  <?php } 
else if($pass_book_list == 8 || $pass_book_list == 33 || $pass_book_list == 58 || $pass_book_list == 83 || $pass_book_list == 108){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:270px;margin-left:100px;" >
  <?php } 
else if($pass_book_list == 9 || $pass_book_list == 34 || $pass_book_list == 59 || $pass_book_list == 84 || $pass_book_list == 109){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:295px;margin-left:100px;">
  <?php }
else if($pass_book_list == 10 || $pass_book_list == 35 || $pass_book_list == 60 || $pass_book_list == 85 || $pass_book_list == 110){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:320px;margin-left:100px;" >
  <?php }
else if($pass_book_list == 11 || $pass_book_list == 36 || $pass_book_list == 61 || $pass_book_list == 86 || $pass_book_list == 111){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:365px;margin-left:100px;" >
  <?php }
else if($pass_book_list == 12 || $pass_book_list == 37 || $pass_book_list == 62 || $pass_book_list == 87 || $pass_book_list == 112){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:390px;margin-left:100px;">
  <?php }
else if($pass_book_list == 13 || $pass_book_list == 38 || $pass_book_list == 63 || $pass_book_list == 88 || $pass_book_list == 113){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:415px;margin-left:100px;">
  <?php }
else if($pass_book_list == 14 || $pass_book_list == 39 || $pass_book_list == 64 || $pass_book_list == 89 || $pass_book_list == 114){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:440px;margin-left:100px;" >
  <?php }
else if($pass_book_list == 15 || $pass_book_list == 40 || $pass_book_list == 65 || $pass_book_list == 90 || $pass_book_list == 115){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:465px;margin-left:100px;">
<?php }
else if($pass_book_list == 16 || $pass_book_list == 41 || $pass_book_list == 66 || $pass_book_list == 91 || $pass_book_list == 116){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:490px;margin-left:100px;">
<?php }
else if($pass_book_list == 17 || $pass_book_list == 42 || $pass_book_list == 67 || $pass_book_list == 92 || $pass_book_list == 117){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:515px;margin-left:100px;">
<?php }
else if($pass_book_list == 18 || $pass_book_list == 43 || $pass_book_list == 68 || $pass_book_list == 93 || $pass_book_list == 118){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:540px;margin-left:100px;">
<?php }
else if($pass_book_list == 19 || $pass_book_list == 44 || $pass_book_list == 69 || $pass_book_list == 94 || $pass_book_list == 119){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:565px;margin-left:100px;" >
<?php }
else if($pass_book_list == 20 || $pass_book_list == 45 || $pass_book_list == 70 || $pass_book_list == 95 || $pass_book_list == 120){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:590px;margin-left:100px;" >
<?php }
else if($pass_book_list == 21 || $pass_book_list == 46 || $pass_book_list == 71 || $pass_book_list == 96 || $pass_book_list == 121){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:615px;margin-left:100px;" >
<?php }
else if($pass_book_list == 22 || $pass_book_list == 47 || $pass_book_list == 72 || $pass_book_list == 97 || $pass_book_list == 122){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:640px;margin-left:100px;">
<?php }
else if($pass_book_list == 23 || $pass_book_list == 48 || $pass_book_list == 73 || $pass_book_list == 98 || $pass_book_list == 123){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:665px;margin-left:100px;">
<?php }
else if($pass_book_list == 24 || $pass_book_list == 49 || $pass_book_list == 74 || $pass_book_list == 99 || $pass_book_list == 124){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:690px;margin-left:100px;">
<?php }
else if($pass_book_list == 25 || $pass_book_list == 50 || $pass_book_list == 75 || $pass_book_list == 100 || $pass_book_list == 125){?>
<!-- <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:70px;margin-left:100px;table-border:0" cellspacing="0" cellpadding="0"> -->

<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:70px;margin-left:100px;"> 
<?php } ?>
            <colgroup>
                <col style="width:5%;">
                <col style="width:20%;">
                <col style="width:20%;">
                <col style="width:20%;">
                <col style="width:20%;">
                <col style="width:10%;">
                <col style="width:5%;">
            </colgroup>
      <thead>
      </thead>
      <tbody>
<?php
if(count($customer_list)>0)
{
    if($pass_book_list == 0)
    {
      $snoval = 1;
    }
    else{
      $snoval = $pass_book_list+1;
    }


    $i=$snoval;

    foreach($customer_list as $cl)
    {
      $date = date('d-m-Y', strtotime($cl['renewal_date']));
      $deposit_amt = $cl['renewal_amt'];
      $default_entry = $cl['default_entry'];
      if($default_entry == 1)
      {
        $particulars = "New A/C Amt";
      }
      else{
        $particulars = "Renewal Amt";

      }
?>

        <tr>
          <td style="text-align:center;"><?php echo $i;?></td>
          <td style="text-align:center;"><strong><?php echo $date; ?></strong></td>
          <td style="text-align:center;"><?php echo $particulars; ?></td>
          <td style="text-align:center;"></td>
          <td style="text-align:center;"><?php echo $deposit_amt; ?></td>
          <td style="text-align:center;"></td>
          <td style="text-align:center;"></td>
          
        </tr>         
          
    <?php   
    
    $i++; 
    
    }

   
}
?>
</tbody>
</table>
</div>

 <?php include("include/footerjs.php"); ?>

</body>
</html>
