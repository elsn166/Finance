<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];

$occupation_id='';
$occupation_name='';


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


 if(isset($_POST['submit']))
 {
    $occupation_name=$_POST['occupation_name'];
  
    $data['occupation_name']=$occupation_name;
   
    $data['created_date']= date("Y-m-d H:i:s");
    $data['created_by']=$userid;

    $insert=insert_data(OCCUPATION_MASTER,$data); 

    if($insert!=0)
    { 
        echo "<script type='text/javascript'>window.location='occupation_view.php?success=Occupation Added Successfully';</script>";
            
    }
         
 }
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
            <h1>Occupation Details</h1>
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
        <h3 class="card-title">Occupation Details</h3>

        <a class="btn-sm btn-success float-right" href="occupation_view.php">Back</a>

      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form class="form-horizontal"> -->

      <form method="post" action="" id="form1" name="form1">
        <div class="card-body">


          <div class="form-group row">
            <label for="occupation_name" class="col-sm-2 col-form-label">Occupation Name<span style="color:red">*</span></label>
            <div class="col-sm-5">
              <input type="text" name="occupation_name" class="form-control" id="occupation_name" placeholder="Enter Occupation Name" value="<?php echo $occupation_name; ?>" />
            </div>
          </div>

          
          
        </div>
        <!-- /.card-body -->
              
        <div class="card-footer">

        <div id="inner">
            <?php if(!isset($_GET['occupation_id'])) { ?>
              <button type="submit" class="btn-sm btn-success" id="submit" name="submit" >Submit</button>
                    <?php } else { ?>
            <button type="submit" class="btn-sm btn-success" id="submit" name="update" >Update</button>
                          <?php } ?>
              <a href=""><button type="button" class="btn-sm btn-default">Cancel</button></a>
          </div>

          <!-- <button type="submit" name="submit" class="btn btn-success">Submit</button> -->
        </div>

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
