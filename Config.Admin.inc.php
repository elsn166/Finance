<?php

define("LIVE_SERVER",0);
define("ERROR_REPORTING",1);
ini_set('memory_limit','2048M');
ini_set('display_errors', 1); 
date_default_timezone_set('Asia/Kolkata');


if(ERROR_REPORTING)
{
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
}
else
{ 
    error_reporting(E_ALL);
}


        $cur_path = $_SERVER['PHP_SELF'];
        $path_extract = explode('/',$cur_path);
        $path_name = $path_extract[1];
	
        define("SITEURL","http://".$_SERVER['HTTP_HOST']."/");


define("ADMINURL",SITEURL."AMKSNL/");


define("ADMINPATH",dirname(__FILE__)."/");		


// ServerSide Physical Path:
define("ADMININC",ADMINPATH."include/");
//echo LOGOURL;

define("UPLOADEMPPROFILE",ADMINPATH."upload_files/employeeprofile/");
define("UPLOADUSERPROFILE",ADMINPATH."upload_files/userprofile/");
define("UPLOADSRESUME",ADMINPATH."upload_files/resume/");

define("UPLOADS_EMP_URL",ADMINURL."upload_files/employeeprofile/");
define("UPLOADS_URL",ADMINURL."upload_files/userprofile/");
define("UPLOADS_RES_URL",ADMINURL."upload_files/resume/");   

// Include the website commons files


require(ADMININC."connect_db.php");
require(ADMININC."db_table_names.php");
require(ADMININC."functions_pack.php");
require(ADMININC."mail_settings.php");
?>
