<?php
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");
 
$from_date = date('Y-m-d', strtotime($_GET['from_date']));
$to_date = date('Y-m-d', strtotime($_GET['to_date']));
$customer_id =$_GET['customer_id'];
$account_id = $_GET['account_id'];

$session_branch_id = $_GET['branch_id'];


$passbooklist = select_data(PASS_BOOK," where customer_id='".$_GET['customer_id']."' and account_id='".$account_id."' ");
$pass_book_list = count($passbooklist);



if($pass_book_list > 0)
{
  // fetch last printed date of customer
  $select_print_date = mysqli_query($CN,"SELECT print_date FROM ".PASS_BOOK." WHERE customer_id = '$customer_id' and account_id='".$account_id."' order by pass_book_id desc limit 1");
  $row = mysqli_fetch_array($select_print_date);

  $last_printed_date = $row['print_date'];


  $select_page_no = mysqli_query($CN,"SELECT page_no FROM ".PASS_BOOK." WHERE customer_id = '$customer_id' and account_id='".$account_id."' order by pass_book_id desc limit 1");
  $rowp = mysqli_fetch_array($select_page_no);
  $rowp = $rowp['page_no'];


  // get last total amt
  $select_last_balance = mysqli_query($CN,"SELECT total_amt FROM ".PASS_BOOK." WHERE customer_id = '".$customer_id."' and account_id='".$account_id."' order by pass_book_id desc limit 1");
  $row_last_balance = mysqli_fetch_array($select_last_balance);
  $last_total_balance  = $row_last_balance['total_amt'];
  

  $customerlist=select_data(SAVINGS_RENEWAL," where customer_id='".$_GET['customer_id']."' and account_id='".$_GET['account_id']."' and renewal_date > '".$last_printed_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");


  if($rowp == 1 || $rowp == 3 || $rowp == 5 || $rowp == 7 || $rowp == 9 || $rowp == 11 || $rowp == 13 || $rowp == 15 || $rowp == 17)
  {
    $page_list = select_data(PASS_BOOK," where customer_id='".$_GET['customer_id']."' and account_id='".$account_id."' and page_no='$rowp'");
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
    
    $page_list = select_data(PASS_BOOK," where customer_id='".$_GET['customer_id']."' and account_id='".$account_id."' and page_no='$rowp'");
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

<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:40px;margin-left:10px;">

<?php
}
else if($pass_book_list == 1 || $pass_book_list == 26 || $pass_book_list == 51 || $pass_book_list == 76 || $pass_book_list == 101 || $pass_book_list == 126 $pass_book_list == 151 || $pass_book_list == 176 || $pass_book_list == 201 || $pass_book_list == 226) 
{ ?>

<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:65px;margin-left:10px;" >

<?php }
else if($pass_book_list == 2 || $pass_book_list == 27 || $pass_book_list == 52 || $pass_book_list == 77 || $pass_book_list == 102 || $pass_book_list == 127 || $pass_book_list == 152 || $pass_book_list == 177 || $pass_book_list == 202 || $pass_book_list == 227)
{ ?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:90px;margin-left:10px;" >
<?php }
else if($pass_book_list == 3 || $pass_book_list == 28 || $pass_book_list == 53 || $pass_book_list == 78 || $pass_book_list == 103 || $pass_book_list == 128 || $pass_book_list == 153 || $pass_book_list == 178 || $pass_book_list == 203 || $pass_book_list == 228)
{ ?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:115px;margin-left:10px;">
<?php }
else if($pass_book_list == 4 || $pass_book_list == 29 || $pass_book_list == 54 || $pass_book_list == 79 || $pass_book_list == 104 || $pass_book_list == 129 || $pass_book_list == 154 || $pass_book_list == 179 || $pass_book_list == 204 || $pass_book_list == 229){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:140px;margin-left:10px;">
<?php } 
else if($pass_book_list == 5 || $pass_book_list == 30 || $pass_book_list == 55 || $pass_book_list == 80 || $pass_book_list == 105 || $pass_book_list == 130 || $pass_book_list == 155 || $pass_book_list == 180 || $pass_book_list == 205 || $pass_book_list == 230){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:165px;margin-left:10px;">
<?php } 
else if($pass_book_list == 6 || $pass_book_list == 31 || $pass_book_list == 56 || $pass_book_list == 81 || $pass_book_list == 106 || $pass_book_list == 131 || $pass_book_list == 156 || $pass_book_list == 181 || $pass_book_list == 206 || $pass_book_list == 231){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:190px;margin-left:10px;">
<?php }
else if($pass_book_list == 7 || $pass_book_list == 32 || $pass_book_list == 57 || $pass_book_list == 82 || $pass_book_list == 107 || $pass_book_list == 132 || $pass_book_list == 157 || $pass_book_list == 182 || $pass_book_list == 207 || $pass_book_list == 232){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:215px;margin-left:10px;">
  <?php } 
else if($pass_book_list == 8 || $pass_book_list == 33 || $pass_book_list == 58 || $pass_book_list == 83 || $pass_book_list == 108 || $pass_book_list == 133 || $pass_book_list == 158 || $pass_book_list == 183 || $pass_book_list == 208 || $pass_book_list == 233){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:240px;margin-left:10px;" >
  <?php } 
else if($pass_book_list == 9 || $pass_book_list == 34 || $pass_book_list == 59 || $pass_book_list == 84 || $pass_book_list == 109 || $pass_book_list == 134 || $pass_book_list == 159 || $pass_book_list == 184 || $pass_book_list == 209 || $pass_book_list == 234){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:265px;margin-left:10px;">
  <?php }
else if($pass_book_list == 10 || $pass_book_list == 35 || $pass_book_list == 60 || $pass_book_list == 85 || $pass_book_list == 110 || $pass_book_list == 135 || $pass_book_list == 160 || $pass_book_list == 185 || $pass_book_list == 210 || $pass_book_list == 235){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:290px;margin-left:10px;" >
  <?php }
else if($pass_book_list == 11 || $pass_book_list == 36 || $pass_book_list == 61 || $pass_book_list == 86 || $pass_book_list == 111 || $pass_book_list == 136 || $pass_book_list == 161 || $pass_book_list == 186 || $pass_book_list == 211 || $pass_book_list == 236){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:315px;margin-left:10px;" >
  <?php }
else if($pass_book_list == 12 || $pass_book_list == 37 || $pass_book_list == 62 || $pass_book_list == 87 || $pass_book_list == 112 || $pass_book_list == 137 || $pass_book_list == 162 || $pass_book_list == 187 || $pass_book_list == 212 || $pass_book_list == 237){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:340px;margin-left:10px;">
  <?php }
else if($pass_book_list == 13 || $pass_book_list == 38 || $pass_book_list == 63 || $pass_book_list == 88 || $pass_book_list == 113 || $pass_book_list == 138 || $pass_book_list == 163 || $pass_book_list == 188 || $pass_book_list == 213 || $pass_book_list == 238){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:365px;margin-left:10px;">
  <?php }
else if($pass_book_list == 14 || $pass_book_list == 39 || $pass_book_list == 64 || $pass_book_list == 89 || $pass_book_list == 114 || $pass_book_list == 139 || $pass_book_list == 164 || $pass_book_list == 189 || $pass_book_list == 214 || $pass_book_list == 239){?>
  <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:390px;margin-left:10px;" >
  <?php }
else if($pass_book_list == 15 || $pass_book_list == 40 || $pass_book_list == 65 || $pass_book_list == 90 || $pass_book_list == 115 || $pass_book_list == 140 || $pass_book_list == 165 || $pass_book_list == 190 || $pass_book_list == 215 || $pass_book_list == 240){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:415px;margin-left:10px;">
<?php }
else if($pass_book_list == 16 || $pass_book_list == 41 || $pass_book_list == 66 || $pass_book_list == 91 || $pass_book_list == 116 || $pass_book_list == 141 || $pass_book_list == 166 || $pass_book_list == 191 || $pass_book_list == 216 || $pass_book_list == 241){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:440px;margin-left:10px;">
<?php }
else if($pass_book_list == 17 || $pass_book_list == 42 || $pass_book_list == 67 || $pass_book_list == 92 || $pass_book_list == 117 || $pass_book_list == 142 || $pass_book_list == 167 || $pass_book_list == 192 || $pass_book_list == 217 || $pass_book_list == 242){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:465px;margin-left:10px;">
<?php }
else if($pass_book_list == 18 || $pass_book_list == 43 || $pass_book_list == 68 || $pass_book_list == 93 || $pass_book_list == 118 || $pass_book_list == 143 || $pass_book_list == 168 || $pass_book_list == 193 || $pass_book_list == 218 || $pass_book_list == 243){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:490px;margin-left:10px;">
<?php }
else if($pass_book_list == 19 || $pass_book_list == 44 || $pass_book_list == 69 || $pass_book_list == 94 || $pass_book_list == 119 || $pass_book_list == 144 || $pass_book_list == 169 || $pass_book_list == 194 || $pass_book_list == 219 || $pass_book_list == 244){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:515px;margin-left:10px;" >
<?php }
else if($pass_book_list == 20 || $pass_book_list == 45 || $pass_book_list == 70 || $pass_book_list == 95 || $pass_book_list == 120 || $pass_book_list == 145 || $pass_book_list == 170 || $pass_book_list == 195 || $pass_book_list == 220 || $pass_book_list == 245){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:540px;margin-left:10px;" >
<?php }
else if($pass_book_list == 21 || $pass_book_list == 46 || $pass_book_list == 71 || $pass_book_list == 96 || $pass_book_list == 121 || $pass_book_list == 146 || $pass_book_list == 171 || $pass_book_list == 196 || $pass_book_list == 221 || $pass_book_list == 246){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:565px;margin-left:10px;" >
<?php }
else if($pass_book_list == 22 || $pass_book_list == 47 || $pass_book_list == 72 || $pass_book_list == 97 || $pass_book_list == 122 || $pass_book_list == 147 || $pass_book_list == 172 || $pass_book_list == 197 || $pass_book_list == 222 || $pass_book_list == 247){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:590px;margin-left:10px;">
<?php }
else if($pass_book_list == 23 || $pass_book_list == 48 || $pass_book_list == 73 || $pass_book_list == 98 || $pass_book_list == 123 || $pass_book_list == 148 || $pass_book_list == 173 || $pass_book_list == 198 || $pass_book_list == 223 || $pass_book_list == 248){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:615px;margin-left:10px;">
<?php }
else if($pass_book_list == 24 || $pass_book_list == 49 || $pass_book_list == 74 || $pass_book_list == 99 || $pass_book_list == 124 || $pass_book_list == 149 || $pass_book_list == 174 || $pass_book_list == 199 || $pass_book_list == 224 || $pass_book_list == 249){?>
<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:640px;margin-left:10px;">
<?php }
else if($pass_book_list == 25 || $pass_book_list == 50 || $pass_book_list == 75 || $pass_book_list == 100 || $pass_book_list == 125 || $pass_book_list == 150 || $pass_book_list == 175 || $pass_book_list == 200 || $pass_book_list == 225 || $pass_book_list == 250){?>
<!-- <table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:14px;margin-top:70px;margin-left:100px;table-border:0" cellspacing="0" cellpadding="0"> -->

<table style="table-layout:fixed;width:700px;font-family:Poppins,Helvetica,sans-serif!important;font-size:12px;margin-top:40px;margin-left:10px;"> 
<?php } ?>
            <colgroup>
                <col style="width:5%;">
                <col style="width:15%;">
                <col style="width:15%;">
                <col style="width:20%;">
                <col style="width:20%;">
                <col style="width:20%;">
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
      $passbookbalance = 0;
    }
    else{
      $snoval = $pass_book_list+1;
      $passbookbalance = $last_total_balance;
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
      $balance = ($passbookbalance + $deposit_amt)
?>

        <tr>
          <td style="text-align:center;"><?php echo $i;?></td>
          <td style="text-align:center;"><?php echo $date; ?></td>
          <td style="text-align:center;"><?php echo $particulars; ?></td>
          <td style="text-align:center;"></td>
          <td style="text-align:center;"><?php echo $deposit_amt; ?></td>
          <td style="text-align:center;"><?php echo $balance; ?></td>
          <td style="text-align:center;"></td>
          
        </tr>         
          
    <?php
    $i++; 
    $passbookbalance = $balance;
    }

   
}
?>
</tbody>
</table>
</div>

 <?php include("include/footerjs.php"); ?>

</body>
</html>
