<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");
 $account_id = '';
 $customer_id='';
 $from_date = '';
 $to_date = '';
 $session_branch_id = $_SESSION['bid'];
 //echo $session_branch_id;
 $session_role_id=$_SESSION['role_id'];
//  if(isset($_POST['customer_id']) && $_POST['customer_id']!="" )
//  {
 
//    $customer_id=$_POST['customer_id'];
//    $account_id = $_POST['account_id'];
//    $from_date = $_POST['from_date'];
//    $to_date = $_POST['to_date'];

//    $customer_details=select_data(CUSTOMER_MASTER,"where customer_id='".$customer_id."'");
//    $customer_name = $customer_details[0]['customer_name'];
//    $customer_no = $customer_details[0]['customer_no'];
//  }
 if(isset($_GET['branch_id']))
{
  $branch_id = $_GET['branch_id'];
}
else
{
  $branch_id = "";
}
if(isset($_GET['Startdate']) && $_GET['enddate']!="" )
{
  $from_date = $_GET['Startdate'];
  $to_date = $_GET['enddate'];
}
  $branch_name=select_data(BRANCH_MASTER," where branch_id='".$session_branch_id."'");
  $b_name =$branch_name[0]['branch_name'];
   //echo $b_name;
   
?>
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
    padding:10px;
    text-align:center;
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
        
   
   <td colspan="4">

   <div style="text-align: left;">
   
 <!--  <b> Branch Name:
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
     
   </tr>
    
</style>
<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible"><?php echo  $info;?></div>

<?php } ?>


  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Savings Renewal Report</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
           
    <!-- Horizontal Form -->
    <div class="card card-outline card-success">
      <div class="card-header">
       
          </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

  <form method="POST" action="" id="form1" name="form1" autocomplete="off">
        <div class="card-body">


<div class="form-group row">
    <b>
<label for="from_date" class="col-4 col-form-label">From Date :<?php echo $from_date; ?><span style="color:red"></span></label>



<label for="to_date" class="col-4 col-form-label">To Date :<?php echo $to_date; ?><span style="color:red"></span></label>





</div>


<?php if(isset($_GET['Startdate']) && isset($_GET['enddate'])) { 
  
  $from_date = date('Y-m-d', strtotime($_GET['Startdate']));
  $to_date = date('Y-m-d', strtotime($_GET['enddate']));

if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
if(($from_date!='') && ($to_date!='') && ($branch_id!='')){
  $renewal_list=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$branch_id."') and renewal_date>= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
}elseif(($from_date!='') && ($to_date!='')){
         $renewal_list=select_data(SAVINGS_RENEWAL," where renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
}elseif(($branch_id!='')){
      $renewal_list=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$branch_id."') order by renewal_date asc");
}
}
  else{

    $renewal_list=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$session_branch_id."') and renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
  }

if(count($renewal_list)>0)
{
    $tot_amt = 0;
    $i=1;
    foreach($renewal_list as $cl)
    {
      $tot_amt = (int)$tot_amt + (int)$cl['renewal_amt'];
    }
}else{
    $tot_amt = 0;
}
}
  ?>

<div class="form-group row">

      <label for="plan_term" class="col-sm-4 col-form-label">
          Total Amount: &nbsp;&nbsp;&nbsp;<?php echo $tot_amt; ?>  
      </label>
      </b>
           
 </div> 
       
        

        <table id="" class="table table-bordered table-striped"style=width:100%;>
                
                  <thead>
                  <tr>
                    <th>S. No</th>
                    <th>Date</th>
                    <th>Member Name</th>
                    <th>Member No</th>
                    <th>Account No</th>
                    <th>Deposits</th>
                   
                  </tr>
                  </thead>
                  
                  
                  <tbody>

     
<?php 
 if(isset($_GET['Startdate']) && isset($_GET['enddate'])) { 
  
  $from_date = date('Y-m-d', strtotime($_GET['Startdate']));
  $to_date = date('Y-m-d', strtotime($_GET['enddate']));

if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
     if(($from_date!='') && ($to_date!='') && ($branch_id!='')){
  $renewal_list=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$branch_id."') and renewal_date>= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
}elseif(($from_date!='') && ($to_date!='')){
         $renewal_list=select_data(SAVINGS_RENEWAL," where renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
}elseif(($branch_id!='') && ($from_date=="") && ($to_date=="")){
      $renewal_list=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$branch_id."') and status=1 order by renewal_date asc");
}
}
else{

  $renewal_list=select_data(SAVINGS_RENEWAL," where customer_id in (select customer_id from ".CUSTOMER_MASTER." where branch_id='".$session_branch_id."') and renewal_date >= '".$from_date."' and  renewal_date <= '".$to_date."' order by renewal_date asc");
}



if(count($renewal_list)>0)
{

    $i=1;
    foreach($renewal_list as $cl)
    {
      
      $date = date('d-m-Y', strtotime($cl['renewal_date']));
      $deposit_amt = $cl['renewal_amt'];
      
      $member_id = $cl['customer_id'];
      $acc_id =  $cl['account_id'];
      $member_name = customer_name($member_id);
      $member_no = customer_no($member_id);
      $acc_no = acc_no($acc_id);
?>
     
        <tr>
          <td><?php echo $i;?></td>
          <td><?php echo $date; ?></td>
          <td><?php echo $member_name; ?></td>
          <td><?php echo $member_no; ?></td>
          <td><?php echo $acc_no; ?></td>
          <td><?php echo $deposit_amt; ?></td>
          
        
        </tr>         
          
    <?php  $i++; }
       
      }
   ?>
   
   
 </tbody>
                  
        </table>

 <?php } ?>
         
        </div>
        <!-- /.card-body -->
              
       

                <!-- /.card-footer -->


              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 






 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>


<link rel="stylesheet" href="dist/css/jquery-ui.css">

<script>
$(document.body).on('change','#customer_id',function(){
  // alert('hi');
  var customer_id = $('#customer_id').val();

    var dataString = "savings_customer_id="+customer_id;
      $.ajax({ 
      type: "GET", 
      url: "ajax_data.php", 
      data: dataString, 
        
      success:  function(data){ 
        $("#account_id").html(data);
      } 
    });
});

$(function() {
 $( "#from_date" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
});


$( "#to_date" ).datepicker({
autoclose: true,
changeMonth: true,
changeYear: true,
dateFormat : 'dd-mm-yy',
yearRange : '1920:c',
maxDate: 'now'
});


});
</script>
</body>
</html>
