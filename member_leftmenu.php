<?php
$userid= $_SESSION['emp_id'];
$session_role_id=$_SESSION['role_id'];
$session_branch_id = $_SESSION['bid'];
$filename = curPageName(); 
if($filename == 'member_profile.php' )
    $active_1="active";
elseif($filename == 'member_personal.php' )
    $active_2="active";
elseif($filename == 'member_address.php' )
    $active_3="active";
?>
<style>
.nav-link.active{
  background-color:#4fa845!important;
}
</style>
<div class="col-3">

<?php if(isset($_GET['customer_id']))
{ ?>
<a class="btn-sm btn-success btn-block margin-bottom" style="text-align:center;color:white;"><?php $customer_id=$_GET['customer_id'];

$customer_details=select_data(CUSTOMER_MASTER,"WHERE customer_id='$customer_id' ");
$customer_name=$customer_details[0]['customer_name']; 
$customer_no = $customer_details[0]['customer_no'];
echo $customer_no.'-'.$customer_name;?></a>    
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
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"> -->
                    <!-- <i class="fas fa-times"></i> -->
                  </button>
                </div>
              </div>
              <div class="card-body">
                <!-- Start creating your amazing application! -->
                <ul class="nav nav-pills flex-column">

                <?php if(isset($_GET['action'])&&$_GET['action']=='view')
                {?>

<li class="nav-item"><a href="member_profile.php?action=view&customer_id=<?php echo $_GET['customer_id'];?>" class="nav-link <?php echo  $active_1; ?>"><i class="fa fa-inbox"></i> Profile
                  </a></li>

<?php }else{ ?>

  <?php if($session_role_id == 1){

    if(isset($_GET['action'])&&$_GET['action']=='edit'){ ?>

                <li class="nav-item"><a href="member_profile.php?action=edit&customer_id=<?php echo $_GET['customer_id'];?>" class="nav-link <?php echo  $active_1; ?>"><i class="fa fa-inbox"></i> Profile
                  </a></li>

<?php } else { ?>

<li class="nav-item"><a href="member_profile.php" class="nav-link <?php echo  $active_1; ?>"><i class="fa fa-inbox"></i> Profile</a></li>

<?php
}
                  }else{ ?>
                    <li class="nav-item"><a href="member_profile.php" class="nav-link <?php echo  $active_1; ?>"><i class="fa fa-inbox"></i> Profile
                  </a></li>
<?php } ?>
          <?php } ?>


                <?php if(isset($_GET['action'])&&$_GET['action']=='view')
                {?>
                <li class="nav-item"><a href="member_personal.php?action=view&customer_id=<?php echo $_GET['customer_id'];?>" class="nav-link <?php echo  $active_2; ?>"><i class="fa fa-inbox"></i> Personal
                </a></li>

                <?php }else{ ?>

                  <?php if($session_role_id == 1){
                    if(isset($_GET['action'])&&$_GET['action']=='edit'){ 
                    ?>

                  <li class="nav-item"><a href="member_personal.php?action=edit&customer_id=<?php echo $_GET['customer_id'];?>" class="nav-link <?php echo  $active_2; ?>"><i class="fa fa-inbox"></i> Personal
                </a></li>

                <?php }else{ ?>

                  <li class="nav-item"><a href="member_personal.php" class="nav-link <?php echo  $active_2; ?>"><i class="fa fa-inbox"></i> Personal </a></li>

                  <?php } ?>


                <?php }else{ ?>

                  <li class="nav-item"><a href="member_personal.php" class="nav-link <?php echo  $active_2; ?>"><i class="fa fa-inbox"></i> Personal
                </a></li>


                <?php } ?>

                <?php } ?>

                <?php if(isset($_GET['action'])&&$_GET['action']=='view')
                {?>

                <li class="nav-item"><a href="member_address.php?action=view&customer_id=<?php echo $_GET['customer_id'];?>" class="nav-link <?php echo  $active_3; ?>"><i class="fa fa-inbox"></i> Address
                </a></li>

                <?php }else{ ?>

                  <?php if($session_role_id == 1){
                    
                    if(isset($_GET['action'])&&$_GET['action']=='edit'){ 
                    ?>

                        <li class="nav-item"><a href="member_address.php?action=edit&customer_id=<?php echo $_GET['customer_id'];?>" class="nav-link <?php echo  $active_3; ?>"><i class="fa fa-inbox"></i> Address
                          </a></li>

                          <?php }else{ ?>
                            <li class="nav-item"><a href="member_address.php" class="nav-link <?php echo  $active_3; ?>"><i class="fa fa-inbox"></i> Address</a></li>


                            <?php } ?>
                <?php }else{ ?>
                          <li class="nav-item"><a href="member_address.php" class="nav-link <?php echo  $active_3; ?>"><i class="fa fa-inbox"></i> Address
                </a></li>

                <?php } ?>

                <?php } ?>
                
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