<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];



if(isset($_GET['action']) && $_GET['action']=="edit" )
{
    $occupation_id=$_GET['occupation_id'];
    $occupation_details=select_data(OCCUPATION_MASTER,"where occupation_id='$occupation_id' ");
    $occupation_name=$occupation_details[0]['occupation_name'];
   
}


if(isset($_POST['update']))
{
  $occupation_name=$_POST['occupation_name'];
  
    
  $data['occupation_name']=$occupation_name;
  

  $data['updated_date']= date("Y-m-d H:i:s");
  $data['updated_by']=$userid;

  $update=update_data(OCCUPATION_MASTER,$data,"occupation_id",$_GET['occupation_id']);
  if($update!=0)
  { 
      echo "<script type='text/javascript'>window.location='occupation_view.php?success=Occupation Updated Successfully';</script>";
  }
        
}


// if(isset($_POST['smits']))
// {
  //  $account_details=$_POST['loan_term_no'];
    //$loan_details=$_POST['loan_term_interest'];
    //$data['loan_term_no ']=$account_details;
//    $data['loan_term_interest']= $loan_details;
//    $insert=insert_data(LOAN_TERM_MASTER,$data);  
//    if($insert!=0)
//    { 
//        echo "<script type='text/javascript'>window.location='occupation_view.php?success=Occupation Added Successfully';</script>";
            
//    }
       
       
// }
 
?>


<style>

.invalid-feedback {
    display: inline;
    margin-left: 170px;
    font-size: 14px;
}
#inner {
    display: table;
    margin: 0 auto;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Loan Term </h1>
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
        <h3 class="card-title">New Loan Term </h3>

        
<button type="button" class="btn-sm btn-success float-right" data-toggle="modal" data-target="#exampleModalCenter">
  Add New
</button>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      

<!-- Button trigger modal -->


<!-- Modal -->
   
   

       
  <?php
 $account_details=select_data(LOAN_TERM_MASTER," ORDER BY loan_term_id ");
$loan_type = $account_details[0]['loan_type'];
               
$loan_details=select_data(LOAN_TYPE_MASTER,"where loan_type_id='$loan_type'  ");
    $loan_type_id=$loan_details[0]['loan_type_id'];               
 ?>
 
         
           <!-- /.card-header -->
               <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>Loan Term</th>
                    <th>Loan Interest</th>
                    <th>Status.</th>
                    <th>Loan Type</th> 
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
              $i=1;
              
              foreach($account_details as $ad)
              {
                $status = $ad['status'];
                $loan_term = $ad['loan_term_no'];
                $loan_interest = $ad['loan_term_interest'];
                 $loan_id = $ad['loan_term_id'];
                 $loan_type_id = $ad['loan_type'];
 $loan_name_detail=select_data(LOAN_TYPE_MASTER,"where loan_type_id ='".$ad['loan_type']."'");
 $loan_name =$loan_name_detail[0]['loan_type_name'];
                     ?>
               <?php
              if($ad['status']==1)
              {$status='Active';
              }else{$status='Inactive';
                  
              }
              ?>
             
          
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo   $loan_term  ?></td>
                  <td><?php echo   $loan_interest ?></td>
                  <td><?php echo   $status  ?></td>
                  <td><?php echo   $loan_name ?></td>                  
                  
                 

                  <td>

                  
<?php 



if($status != 3)
{


if($session_role_id == 1 || $session_role_id == 2 || $session_role_id == 9) {

  ?>
  <a href="loan_add2.php?action=edit&amp;account_id=<?php echo $loan_id  ?>"><span class="btn-sm btn-success"><i class="fas fa-pen"></i></span></a> &nbsp;

                  
                  
<?php } 



}

else{

  echo  "Account Closed";
}

?></td>
              </tr>
             <?php  $i++; } ?>
                  </tbody>
                 
                </table>
  
              </div>
              <!-- /.card-body -->




         
      
        <!-- /.card-body -->
              
        <div class="card-footer">

      

          <!-- <button type="submit" name="submit" class="btn btn-success">Submit</button> -->
        </div>

                <!-- /.card-footer -->


              
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="loan_add1.php" method="POST"  id="form1" name="form1">
      <div class="modal-body">
          
         <label for="loan_term_num" class="col-6 col-form-label">Loan Term<span style="color:red">*</span></label>
            <div class="col-12">
              <input type="text" name="loan_term_num" class="form-control" id="loan_term_num" placeholder="Enter Loan Term" value=>
            </div>
              <label for="loan_term_int" class="col-6 col-form-label">Loan Inrterest<span style="color:red">*</span></label>
            <div class="col-12">
              <input type="text" name="loan_term_int" class="form-control" id="loan_term_int" placeholder="Enter Loan Inrterest" value=>
            </div>
            
            <label for="loan_type" class="col-sm-1col-form-label ">Loan Type<span style="color:red">*</span></label>
            <div class="col-12">
              <select name="loan_type" class="form-control" id="loan_type" <?php echo $disabled; ?>>
              <option value="">Select Loan Type</option>
              <?php
             $loan_type_list=select_data(LOAN_TYPE_MASTER,"where status='1' ORDER BY loan_type_id  ASC");
             foreach($loan_type_list as $ltl)
             {
             ?>
               <option value="<?php echo $ltl['loan_type_id'];?>" <?php if($loan_type == $ltl['loan_type_id']){ echo 'selected'; } ?>><?php echo $ltl['loan_type_name'];?></option>
               <?php  
             }
             ?>
              </select>
            </div>
      </div>
      <div class="modal-footer">
       <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
      </div>
       </form>  
    </div>
  </div>
</div>





 <?php include("include/footer.php"); ?>
 <?php include("include/footerjs.php"); ?>
 
 
 <script>

$(function () {
    $("#form1").validate({
rules: { 
  occupation_name: { required: true},
 
},
messages: {
  occupation_name: { required: 'Please Enter Occupation Name'},

},
errorElement: 'span',
   errorPlacement: function (error, element) {
     error.addClass('invalid-feedback');
     element.closest('.form-group').append(error);
   },
   highlight: function (element, errorClass, validClass) {
     $(element).addClass('is-invalid');
   },
   unhighlight: function (element, errorClass, validClass) {
     $(element).removeClass('is-invalid');
   }

});
   });

   </script>
</body>
</html>
