<?php 
session_start(); 
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");

include("include/header.php");
include("include/header_top.php");
include("include/left_menu.php");

$userid= $_SESSION['emp_id'];
$income_type_name = '';

if(isset($_GET['action']) && $_GET['action']=="edit" )
{
    $income_type_id=$_GET['income_type_id'];
    $income_type_details=select_data(INCOME_TYPE_MASTER,"where income_type_id='$income_type_id' ");
    $income_type_name=$income_type_details[0]['income_type_name'];
}

if(isset($_POST['update']))
{
    $income_type_name=$_POST['income_type_name'];
    $data['income_type_name']=$income_type_name;
    $data['updated_date']= date("Y-m-d H:i:s");
    $data['updated_by']=$userid;

    $update=update_data(INCOME_TYPE_MASTER,$data,"income_type_id",$_GET['income_type_id']);
    if($update!=0)
    { 
        echo "<script type='text/javascript'>window.location='income_type_view.php?success=Income Type Name Updated Successfully';</script>";
    }
        
}


 if(isset($_POST['submit']))
 {
        $income_type_name=$_POST['income_type_name'];

        $data['income_type_name']=$income_type_name;
        $data['status'] = 1;
        $data['created_date']= date("Y-m-d H:i:s");
        $data['created_by']=$userid;

        $insert=insert_data(INCOME_TYPE_MASTER,$data); 

        if($insert!=0)
        { 
            echo "<script type='text/javascript'>window.location='income_type_view.php?success=Income Type Name Added Successfully';</script>";
                
        }
         
 }
?>

<style>
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
            <h1>Income Type Details</h1>
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
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Income Type Details</h3>

                <a class="btn-sm btn-success float-right" href="income_type_view.php">Back</a>

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- <form class="form-horizontal"> -->

              <form method="post" action="" id="form1" name="form1">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="income_type_name" class="col-sm-2 col-form-label">Income Type Name</label>
                    <div class="col-sm-5">
                      <input type="text" name="income_type_name" class="form-control" id="income_type_name" placeholder="Enter Income Type Name" value="<?php echo $income_type_name;?>"/>
                    </div>
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->
              
        <div class="card-footer">

        <div id="inner">
            <?php if(!isset($_GET['income_type_id'])) { ?>
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
</body>
</html>
