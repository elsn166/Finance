<?php
$filename = curPageName(); 

$userid= $_SESSION['emp_id'];
$session_role_id=$_SESSION['role_id'];
$session_branch_id = $_SESSION['bid'];

if($filename == 'account_profile.php' )
    $active_1="active";
elseif($filename == 'account_first_profile.php' )
    $active_2="active";
elseif($filename == 'account_second_profile.php' )
    $active_3="active";
elseif($filename == 'account_nominee.php' )
    $active_4="active";
elseif($filename == 'account_maturity.php' )
    $active_5="active";
?>
<style>
.nav-link.active{
  background-color:#4fa845!important;
}
</style>
<div class="col-3">

<?php if(isset($_GET['account_id']))
{ 
  $acc_id = $_GET['account_id'];
  ?>
<a class="btn-sm btn-success btn-block margin-bottom" style="text-align:center;color:white;"><?php $account_id=$_GET['account_id'];

$account_details=select_data(ACCOUNT_MASTER,"WHERE account_id='$account_id' ");
$account_no=$account_details[0]['account_no']; 
$customer_id=$account_details[0]['customer_id']; 
$customerlist=select_data(CUSTOMER_MASTER," where customer_id='".$customer_id."'");
$customer_no = $customerlist[0]['customer_no'];
echo $account_no;   ?>


</a>    
<?php }else{ 
  $acc_id = '';
  
  ?>

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
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i> -->
                  </button>
                </div>
              </div>
              <div class="card-body">
                <!-- Start creating your amazing application! -->
                <ul class="nav nav-pills flex-column">

                <?php if(isset($_GET['action'])&&$_GET['action']=='view')
                {?>

                <li class="nav-item"><a href="account_profile.php?action=view&account_id=<?php echo $_GET['account_id'];?>" class="nav-link <?php echo  $active_1; ?>"><i class="fa fa-inbox"></i> Profile
                  </a></li>

                <?php }else{ ?>
                  <?php if($session_role_id == 1){

                    if(isset($_GET['action'])&&$_GET['action']=='edit'){
                    ?>


                        <li class="nav-item"><a href="account_profile.php?action=edit&account_id=<?php echo $_GET['account_id'];?>" class="nav-link <?php echo  $active_1; ?>"><i class="fa fa-inbox"></i> Profile
                        </a></li>


                  <?php }else{ ?>

                        <li class="nav-item"><a href="account_profile.php" class="nav-link <?php echo  $active_1; ?>"><i class="fa fa-inbox"></i> Profile
                        </a></li>

                    <?php } ?>

                  <?php }else{ ?>

                        <li class="nav-item"><a href="account_profile.php" class="nav-link <?php echo  $active_1; ?>"><i class="fa fa-inbox"></i> Profile
                        </a></li>

                    <?php } ?>


                <?php } ?>



                <?php if(isset($_GET['action'])&&$_GET['action']=='view')
                {?>
                    <li class="nav-item"><a href="account_first_profile.php?action=view&account_id=<?php echo $_GET['account_id'];?>" class="nav-link <?php echo  $active_2; ?>"><i class="fa fa-inbox"></i> 1st Depositor
                </a></li>

                <?php }else{ ?>
                  <?php if($session_role_id == 1){

                    if(isset($_GET['action'])&&$_GET['action']=='edit'){
                    ?>

                    <li class="nav-item"><a href="account_first_profile.php?action=edit&account_id=<?php echo $_GET['account_id'];?>" class="nav-link <?php echo  $active_2; ?>"><i class="fa fa-inbox"></i> 1st Depositor
                    </a></li>

                    <?php }else{ ?>

                      <li class="nav-item"><a href="account_first_profile.php" class="nav-link <?php echo  $active_2; ?>"><i class="fa fa-inbox"></i> 1st Depositor
                      </a></li>

                    <?php } ?>

                <?php }else{ ?>

                    <li class="nav-item"><a href="account_first_profile.php" class="nav-link <?php echo  $active_2; ?>"><i class="fa fa-inbox"></i> 1st Depositor
                    </a></li>

                    <?php } ?>
                <?php } ?>


                <?php if(isset($_GET['action'])&&$_GET['action']=='view')
                {?>

                  <li class="nav-item"><a href="account_second_profile.php?action=view&account_id=<?php echo $_GET['account_id'];?>" class="nav-link <?php echo  $active_3; ?>"><i class="fa fa-inbox"></i> 2nd Depositor
                                  </a></li>
                <?php }else{ ?>

                  <?php if($session_role_id == 1){
                     if(isset($_GET['action'])&&$_GET['action']=='edit'){
                    ?>
                  <li class="nav-item"><a href="account_second_profile.php?action=edit&account_id=<?php echo $_GET['account_id'];?>" class="nav-link <?php echo  $active_3; ?>"><i class="fa fa-inbox"></i> 2nd Depositor
                </a></li>
                <?php }else{ ?>

                  <li class="nav-item"><a href="account_second_profile.php" class="nav-link <?php echo  $active_3; ?>"><i class="fa fa-inbox"></i> 2nd Depositor
                </a></li>
                  <?php } ?>


                <?php }else{ ?>

                  <li class="nav-item"><a href="account_second_profile.php" class="nav-link <?php echo  $active_3; ?>"><i class="fa fa-inbox"></i> 2nd Depositor
                </a></li>

                    <?php } ?>

                <?php } ?>


                <?php if(isset($_GET['action'])&&$_GET['action']=='view')
                {?>
                  <li class="nav-item"><a href="account_nominee.php?action=view&account_id=<?php echo $_GET['account_id'];?>" class="nav-link <?php echo  $active_4; ?>"><i class="fa fa-inbox"></i> Nominee Details
                </a></li>

                <?php }else{ ?>

                  <?php if($session_role_id == 1){
                    if(isset($_GET['action'])&&$_GET['action']=='edit'){
                    ?>

                  <li class="nav-item"><a href="account_nominee.php?action=edit&account_id=<?php echo $_GET['account_id'];?>" class="nav-link <?php echo  $active_4; ?>"><i class="fa fa-inbox"></i> Nominee Details
                </a></li>
                <?php }else{  if($acc_id != "")
                    { ?>

                  <li class="nav-item"><a href="account_nominee.php?action=edit&account_id=<?php echo $_GET['account_id'];?>" class="nav-link <?php echo  $active_4; ?>"><i class="fa fa-inbox"></i> Nominee Details
                </a></li>

                <?php }else{  ?>

                  <li class="nav-item"><a href="account_nominee.php" class="nav-link <?php echo  $active_4; ?>"><i class="fa fa-inbox"></i> Nominee Details
                </a></li>

                  <?php } 
                  
                }?>




                <?php }else{ 
                  
                    if($acc_id != "")
                    { ?>
 <li class="nav-item"><a href="account_nominee.php?action=edit&account_id=<?php echo $_GET['account_id'];?>" class="nav-link <?php echo  $active_4; ?>"><i class="fa fa-inbox"></i> Nominee Details
                </a></li>
                   <?php  }
                  else {
                  ?>

                  <li class="nav-item"><a href="account_nominee.php" class="nav-link <?php echo  $active_4; ?>"><i class="fa fa-inbox"></i> Nominee Details
                </a></li>
                <?php } ?>

                  <?php } ?>

                <?php } ?>




                

               

               
                <!-- <li class="nav-item"><a href="account_maturity.php?account_id=<?php //echo $_GET['account_id'];?>" class="nav-link <?php //echo  $active_5; ?>"><i class="fa fa-inbox"></i> Maturity Payment Details
                </a></li> -->
                
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