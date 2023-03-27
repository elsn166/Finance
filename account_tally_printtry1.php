<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

$session_branch_id = $_GET['branch_id'];
 $branch_name = branch_name($session_branch_id);

 $session_role_id=$_SESSION['role_id'];
 $session_branch_id = $_SESSION['bid'];
 
?>

</style>
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
        
    <tr style="height:100px;">
   <td colspan="4">

   <div style="text-align: left;">
   
   <b> Branch Name: <?php echo $branch_name; ?></b>  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
     
   </tr>
<?php if(isset($_GET['success']) && $_GET['success']){ $info=$_GET['success'];?>

<div class="alert alert-success alert-dismissible" style="margin-left:248px;"><?php echo  $info;?></div>

<?php } ?>

<!-- Content Wrapper. Contains page content -->

    <!-- Main content -->
    <section class="content">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- /.card-header -->
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Loan Renewal</h3>  
                  <!-- <button type="button" class="btn btn-primary float-right">
                  
                  Large button-->
                  <!--<a class="btn-sm btn-success float-right" href="add_loan_renewal.php">Add New</a>-->
              </div>
            
        <?php
         if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9)
         {
    $loan_details=select_data(LOAN_MASTER,"where status !=4 ORDER BY loan_id ASC");
         }
         else{
    $loan_details=select_data(LOAN_MASTER,"where branch_id='".$session_branch_id."' and status !=4 ORDER BY loan_id ASC"); 
         }
        ?>


              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped"style="width:100%">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Member Name</th>
                    <th>Loan No.</th>
                    <th>Member No.</th>
                    <th>Loan Type</th>
                   <th>Total Amt</th>
                       </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              foreach($loan_details as $ld)
              {
                $loan_type_id = $ld['loan_type_id'];
                $loan_details = select_data(LOAN_TYPE_MASTER," where loan_type_id='".$loan_type_id."'");
                $loan_type_name = $loan_details[0]['loan_type_name'];
                $customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$ld['customer_id']."'");
                $loan_renewal_details = select_data(LOAN_RENEWAL,"where loan_id='".$ld['loan_id']."'");
                $total_amt=0;
                if(count($loan_renewal_details) > 0)
                { 
                  
                  foreach($loan_renewal_details as $ad)
                  {

                      $total_amt =$total_amt+$ad['loan_renewal_amt'];

                  }
                }
                
              ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo  $customerlist[0]['customer_name']; ?></td>
                  <td><?php echo  $ld['loan_no']; ?></td>
                  <td><?php echo  $customerlist[0]['customer_no']; ?></td>
                  <td><?php echo  $loan_type_name; ?></td>
                  <td><?php echo $total_amt; ?></td>
              </tr>
             <?php  $i++; } ?>
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        
        
       
        <!-- /.row -->
     <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>






 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>
</body>
</html>
