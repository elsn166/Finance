<?php
$filename = curPageName(); 
if($filename == 'loan_profile.php' )
    $active_1="active";
elseif($filename == 'loan_personal.php' )
    $active_2="active";
?>
<style>
.nav-link.active{
  background-color:#4fa845!important;
}
</style>
<div class="col-3">

<?php if(isset($_GET['loan_id']))
{ ?>
<a class="btn-sm btn-success btn-block margin-bottom" style="text-align:center;color:white;"><?php $loan_id=$_GET['loan_id'];

$loan_details=select_data(LOAN_MASTER,"WHERE loan_id='$loan_id' ");
$loan_no=$loan_details[0]['loan_no']; 
$customer_id=$loan_details[0]['customer_id']; 
$customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$customer_id."'");
$customer_no = $customerlist[0]['customer_no'];
echo $customer_no."-".$loan_no;   ?>


</a>    
<?php }else{ ?>

<a class="btn btn-success btn-block margin-bottom" style="text-align:center;color:white;"></a>
<?php } ?>
      

<br>
            <!-- Default box -->
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title">Menu</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <!-- Start creating your amazing application! -->
                <ul class="nav nav-pills flex-column">

                <li class="nav-item"><a href="loan_profile.php?loan_id=<?php echo $_GET['loan_id'];?>" class="nav-link <?php echo  $active_1; ?>"><i class="fa fa-inbox"></i> Loan Details
                </a></li>

                <li class="nav-item"><a href="loan_personal.php?loan_id=<?php echo $_GET['loan_id'];?>" class="nav-link <?php echo  $active_2; ?>"><i class="fa fa-inbox"></i> Personal Details
                </a></li>

                
                
</ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <!-- Footer -->
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>