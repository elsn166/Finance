<?php
// Redirect to Login If Admin Not Logged In 
if(!isset($_SESSION['AdminLogged'.SESSION_TOKEN]))
{

header("Location:".ADMINURL."login.php");
	exit();
}
?>
