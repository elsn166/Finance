<?php


/**
 *
 * mail_settings.php
 * This File is settings for Mail
 * Copyright (c) 2014 Perpetua
 *
 * @package eyes-T
 * @author <>
 * @date of create <>
 * @version 1.0
 * @file path  /include
 *
 * @modified by Immanuel
 * @modified date 02-03-16
 * Defines REPORTMAIL,REPORTPASS for Bus Route Cron 
 * 
 */
 
 
 
######################################################
# Website Mail Settings and Defines
######################################################
if(LIVE_SERVER)
{
	define("SENDERNAME","ARC"); // "First Last"
	define("ADMINMAIL","testing.purpose360@gmail.com");
	define("NOREPLYMAIL","testing.purpose360@gmail.com");
	define("REPORTMAIL","testing.purpose360@gmail.com");
	define("REPORTPASS","perpetua123");
}else
{
	define("SENDERNAME","ARC"); // "First Last"
	define("ADMINMAIL","testing.purpose360@gmail.com");
	define("NOREPLYMAIL","testing.purpose360@gmail.com");
	define("REPORTMAIL","testing.purpose360@gmail.com");
	define("REPORTPASS","perpetua123");
}

// Email Logo Physical Path
//define("MAILLOGO",SERVERPATH."images/logo.jpg");

// SMTP E-mail Account
define("SMTP_AUTH",true);
define("SMTP_SECURE","ssl");
define("SMTP_HOST","smtp.gmail.com");
define("SMTP_PORT","465");
define("SMTP_USER","testing.purpose360@gmail.com");
define("SMTP_PASS","perpetua123");

define("FORGETPASSWORD","Eyes-T New Password");
define("ACTIVATION_CONFIRM","Eyes-T Account Activation");
define("DAILYREPORT","Daily Bus Route Report for ".date('F d, Y')."");
define("MONTHLYREPORT","Monthly Report Report for ".date('F')."");
define("INTERVIEWSCHEDULED","Scheduled Interview Details");
define("INTERVIEWCANCELLED","Cancelled Interview Details");
define("APPLICANTREJECTED","Rejected Application Details");


// print_r($_SESSION);
// echo $school_id;

?>
