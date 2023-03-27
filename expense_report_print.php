<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");


 $employee_id='';
 $session_branch_id = $_SESSION['bid'];
 $session_role_id=$_SESSION['role_id'];
           if(isset($_GET['from_date']))
{
  $from_date = $_GET['from_date'];
}
else
{
  $from_date = "";
}if(isset($_GET['to_date']))
{
  $to_date = $_GET['to_date'];
}
else
{
  $to_date = "";
}    
if(isset($_GET['branch_id']))
{
  $branch_id = $_GET['branch_id'];
}
else
{
  $branch_id = "";
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
    padding:10px;
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
   
   
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
     
   </tr>
    
<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible" style="margin:0 0 0 230px;width:100% !important"><?php echo  $info;?></div>

<?php } ?>


<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h3> Expense Report </h3>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- /.card-header -->
              <div class="card">
              <div class="card-header">
              
                
                  <!-- <button type="button" class="btn btn-primary float-right">
                  Large button
                  </button> -->
                  
                  <!-- <a class="btn-sm btn-success float-right" href="account_profile.php">Add New</a> -->
              </div>
        <?php if(isset($_GET['from_date'])) { ?>
    <?php if(isset($_GET['to_date'])) { ?>
    <?php if(isset($_GET['branch_id'])) { ?> 
            <?php
if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
{
    
    if(($_GET['from_date']) && ($_GET['to_date']&&($_GET['branch_id'])))
 
{
    $from_date = date('Y-m-d', strtotime($_GET['from_date']));
  $to_date = date('Y-m-d', strtotime($_GET['to_date']));
  //echo $from_date;
    //echo $to_date;
$account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and date >= '".$from_date."' and  date <= '".$to_date."' and branch_id='$branch_id' ORDER BY account_id DESC");  
} else
if(($_GET['from_date']) && ($_GET['to_date']))
 
{
    $from_date = date('Y-m-d', strtotime($_GET['from_date']));
  $to_date = date('Y-m-d', strtotime($_GET['to_date']));
  //echo $from_date;
    //echo $to_date;
$account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and date >= '".$from_date."' and  date <= '".$to_date."'  ORDER BY account_id DESC");  
}else
if(($_GET['branch_id'] ))
 
{
    $from_date = date('Y-m-d', strtotime($_GET['from_date']));
  $to_date = date('Y-m-d', strtotime($_GET['to_date']));
  //echo $from_date;
    //echo $to_date;
$account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and branch_id='$branch_id'  ORDER BY account_id DESC");  
}

else{
   $account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 ORDER BY account_id DESC");
}
 
}

else {
      if(($_GET['from_date']) && ($_GET['to_date']))
 
{
    $from_date = date('Y-m-d', strtotime($_GET['from_date']));
  $to_date = date('Y-m-d', strtotime($_GET['to_date']));
  

  $account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and maturity_acct=0 and date >= '".  $from_date."' and  date <= '".$to_date."'  branch_id='$session_branch_id'  ORDER BY account_id DESC");
}
else{
     $account_details=select_data(ACCOUNT_MASTER,"where status=3 and prematurity_acct=1 and branch_id='$session_branch_id'  maturity_acct=0 and ORDER BY account_id DESC");
}
}   ?>   
 
              <!-- /.card-header -->
           <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped"style=width:100%>
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Member Name</th>
                    <th>Account No.</th>
                    <th>Member No.</th>
                    <!-- <th>Plan Type</th> -->
                    <th>Scheme Code</th>
                    <th>Total Amount</th>
                    <th>Account Open Date</th>
                    <th>Account Close Date</th>
                    <!-- <th>Action</th> -->
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($account_details as $ad)
              {
                $creationdate = $ad['date'];
                $date = date("d-m-Y", strtotime($creationdate));
                $acd = date("d-m-Y", strtotime($ad['account_close_date']));
                $planlist=select_data(PLAN_MASTER," where plan_id='".$ad['plan_id']."'");
                $plan_code = $planlist[0]['plan_code'];
                $plan_term = $planlist[0]['plan_term'];
                $plan_term_value=$planlist[0]['plan_term_value'];

                
                $accno = $ad['account_no'];
                $accamt = $ad['amount'];
                $maturity_amount = $ad['maturity_amt'];
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ad['customer_id']."'");
              
                $plantypelist=select_data(PLAN_TYPE_MASTER," where plan_type_id='".$ad['plan_type_id']."'");
                $plan_type_name = $plantypelist[0]['plan_type_name'];
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $customerlist[0]['customer_name']; ?></td>
                  <td><?php echo  $accno; ?></td>
                  <td><?php echo  $customerlist[0]['customer_no']; ?></td>
                  
                  <td><?php echo  $plan_code.'-'.$accamt; ?></td>
                  <td><?php echo  $maturity_amount; ?></td>
                  <td><?php echo  $date; ?></td>
                  <td><?php echo  $acd; ?></td>

                  <!-- <td>

  <a href="close_maturity.php?account_id=<?php echo $ad['account_id']; ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;
                  
</td> -->
              </tr>
             <?php  $i++; } ?>
                  </tbody>
                 
                </table>
              </div>
               <?php } ?>
               <?php } ?>
                     <?php } ?>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>






 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>
</body>
</html>
