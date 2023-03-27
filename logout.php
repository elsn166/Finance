<?php session_start(); ?>
<?php
require(dirname(__FILE__).DIRECTORY_SEPARATOR."Config.Admin.inc.php");  
// unset($_SESSION['AdminLogged'.SESSION_TOKEN]);
session_destroy();
header("Location:login.php");
?>
