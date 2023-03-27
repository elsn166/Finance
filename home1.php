<?php ob_start();
 session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Society Bank Admin Dashboard Template</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link href="css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="plugins/kalendar/kalendar.css" rel="stylesheet">
<link rel="stylesheet" href="plugins/scroll/nanoscroller.css">
<link href="plugins/morris/morris.css" rel="stylesheet" />
</head>
<body class="dark_theme fixed_header left_nav_fixed">
<div class="wrapper">
  <!--\\\\\\\ wrapper Start \\\\\\-->
  <div class="header_bar">
    <!--\\\\\\\ header Start \\\\\\-->
    <div class="brand">
      <!--\\\\\\\ brand Start \\\\\\-->
      <div class="logo" style="display:block"><span style="color:#FF3300;"> <B> Society </B> </span> <span style="color:white;"> <B>Bank </span> </B> </div>
      <div class="small_logo" style="display:none"><img src="images/s-logo.png" width="50" height="47" alt="s-logo" /> <img src="images/r-logo.png" width="122" height="20" alt="r-logo" /></div>
    </div>
    <!--\\\\\\\ brand end \\\\\\-->
    <div class="header_top_bar">
      <!--\\\\\\\ header top bar start \\\\\\-->
      <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
      <div class="top_left">
        <div class="top_left_menu">
          
        </div>
      </div>
      <div class="top_right_bar">
        
        <div class="user_admin dropdown"> <a href="javascript:void(0);" data-toggle="dropdown"><img src="images/user.png" /><span class="user_adminname"><span style="color: #00CCFF; font-weight:bold;" > Admin </span>  <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <div class="top_pointer">   </div>
            <li> <a href="profile.html"> <i class="fa fa-user"></i> Profile </a> </li>
            <li> <a href="login.html">   <i class="fa fa-power-off"></i> Logout </a> </li>
          </ul>
        </div>
      </div>
    </div>
    <!--\\\\\\\ header top bar end \\\\\\-->
  </div>
  <!--\\\\\\\ header end \\\\\\-->
  <div class="inner">
    <!--\\\\\\\ inner start \\\\\\--><div class="left_nav">

      <!--\\\\\\\left_nav start \\\\\\-->
      <div class="left_nav_slidebar">
        <ul>
 <li class="left_nav_active theme_border"><a href="home.php" style="color:white; font-weight:bold;"><i class="fa fa-home"></i> DASHBOARD <span class="left_nav_pointer"></span> </a>
            </li>
			  <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit"></i> MID TERM LOAN <span class="plus"><i class="fa fa-plus"></i></span></a>
		    <ul>
		   <li> <a href="pl_userlist.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT User List  </b> </a> </li>
	  <li> <a href="pl_form.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT Loan Form  </b> </a> </li>	 
	  <li> <a href="pl_due.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> MT Loan Due  </b> </a> </li>	 
	 	 <li> <a href="td_due.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> TD Amount  </b> </a> </li>	
	 <li> <a href="add_suspense_entry.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Add Suspense </b> </a> </li>	 
	  <li> <a href="split_adjustment_entries.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Split Suspense </b> </a> </li>	  
	  <li> <a href="pl_reloan_form.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Reloan Form  </b> </a> </li>	 
	  <li> <a href="demand_notification.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Demand Form  </b> </a> </li>	 
	
	  <li> <a href="org_list.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Organization List  </b> </a> </li>		
		</ul></li>
		 	
<!--   Jewel   -->
			
          <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;" > <i class="fa fa-edit" ></i> JEWEL LOAN <span class="plus"><i class="fa fa-plus"></i></span></a>
            <ul>
              <li> <a href="jewel_member.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> New member </b> </a> </li>
              <li> <a href="jl_ledgerform.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> JL Loan  </b> </a> </li>
			  <li> <a href="jl_due_copy.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> JL Loan Due </b> </a> </li>
			  <li> <a href="jl_userlist.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> JL UserList </b> </a> </li>
             <!-- <li> <a href="icons.html"> <span>&nbsp;</span> <i class="fa fa-thumbs-up"></i> <b>Redressed</b> </a> </li> -->
            </ul>
          </li>
		  
		   <!---  MT  -->
		 <!--  -->

	<!--	
<li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT DCP <span class="plus"><i class="fa fa-plus"></i></span></a>
           
		    <ul>
		  <li> <a href="petition_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT Dispursement  </b> </a> </li>
	  <li> <a href="petition_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT TD Refund  </b> </a> </li>	 
	  <li> <a href="monthly_petition_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT Share Capital  </b> </a> </li>	 
	
	  <li> <a href="forward_petition_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> MT TD Ledger </b> </a> </li>	 
	  <li> <a href="monthly_fwd_pt.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> MT Capital ledger  </b> </a> </li>	 
		
		  <li> <a href="addressed_petition_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT Divident Refund  </b> </a> </li>	 
	  <li> <a href="monthly_redressed_pt.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> MT Divident Ledger  </b> </a> </li>	 
		
		  </ul>
		  </li>

		  <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> JL DCP <span class="plus"><i class="fa fa-plus"></i></span></a>
           
		    <ul>
		  <li> <a href="petition_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  JL Dispursement  </b> </a> </li>
	  <li> <a href="petition_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  JL Capital Ledger </b> </a> </li>	 
	  		
		  </ul>
		  </li>
		-->
		
		<li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> DCP <span class="plus"><i class="fa fa-plus"></i></span></a>
           
		    <ul>
			
				<li> <a style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT DCP <span class="plus"></span></a>
			
		  <li  style="margin-left:20px;"> <a href="petition_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT Dispursement  </b> </a> </li>
		  	  <li  style="margin-left:20px;"> <a href="mt_capital_ledger.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> MT Capital ledger  </b> </a> </li>	
			  
			  </li>
			  
			  
			  		
		<li> <a style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT TD DCP <span class="plus"></span></a>
					
		<li  style="margin-left:20px;"> <a href="td_refund.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT TD Refund  </b> </a> </li>	
		
		 <li  style="margin-left:20px;"> <a href="mt_td_ledger.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> MT TD Ledger </b> </a> </li>
		
		 </li>
		
		
	  <li> <a style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT Share Capital DCP <span class="plus"></span></a>
				
	  <li  style="margin-left:20px;"> <a href="mt_share_capital.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT Share Capital  </b> </a> </li>	 </li>
	
	 	 
	   <li> <a style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT Divident DCP <span class="plus"></span></a>
		
		  <li  style="margin-left:20px;"> <a href="mt_divident_refund.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT Divident Refund  </b> </a> </li>	 
	  <li  style="margin-left:20px;"> <a href="mt_divident.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> MT Divident Ledger  </b> </a> </li>	 
		</li>
		  </li>
		  
		  
		  <li> <a  style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> JL DCP <span class="plus"></a>      		  
		  <li  style="margin-left:20px;"> <a href="jl_disbursement.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  JL Dispursement  </b> </a> </li>
	  <li  style="margin-left:20px;"> <a href="jl_capital_ledger.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  JL Capital Ledger </b> </a> </li>	 
	  		
		  </ul>
		  </li>
		  
		  
		    <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i>  REPORTS <span class="plus"><i class="fa fa-plus"></i></span></a>
			
			<ul>
			
			 	  <li> <a href="cash_book_ledger.php" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> CASH BOOK LEDGER <span class="plus"></span></a> </li>
			  
			  
		  	  <li> <a href="cash_receipt.php" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> CASH BOOK RECEIPT <span class="plus"></span></a> </li>
			
			  <li> <a  style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT REPORTS <span class="plus"></span></a>
			  
			  
            <li  style="margin-left:20px;"> <a href="jewel_due_print.php"> <span>&nbsp;</span> <i class="fa fa-circle"> </i> <b> MT Due Report  </b> </a> </li>
			
			<li style="margin-left:20px;"> <a href="mt_daily_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> MT Daily Report  </b> </a> </li>
			
	  <li  style="margin-left:20px;"> <a href="mt_month_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> MT Month Report </b> </a> </li>	 
	  		 <li  style="margin-left:20px;"> <a href="mt_year_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>  MT Year Report </b> </a> </li>	 
	 		
			</li>
			
		
		  <li> <a  style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> JL REPORTS <span class="plus"></span></a>
           
		   	   
	 <li  style="margin-left:20px;"> <a href="jewel_due_print.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> JL Due Report  </b> </a> </li>
	 
	 <li  style="margin-left:20px;"> <a href="jl_daily_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> JL Daily Report  </b> </a> </li>
	  <li  style="margin-left:20px;"> <a href="jewel_month_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> JL Month Report </b> </a> </li>	 
	  <li  style="margin-left:20px;"> <a href="jewel_year_report.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> JL Year Report </b> </a> </li>	 
		  </li>
		  </ul> 
		  </li>
		  
		  		    <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit"></i> STAFF <span class="plus"><i class="fa fa-plus"></i></span></a>
            <ul>
              <li> <a href="staff.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> New Staff </b> </a> </li>
			  <li> <a href="staff_list.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Staff List </b> </a> </li>
              <li> <a href="staff_salary.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Staff Salary </b> </a> </li>
			  <li> <a href="view_staff_deduction.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Payslip </b> </a> </li>
          </ul>
          </li>
		    <li> <a href="staff_loan_form.php" style="color:white; font-weight:bold;"> <i class="fa fa-edit"></i> STAFF LOAN <span class="plus"></span></a> </li>
           
		<!--   
		  <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit"></i> VIEW STAFF LOAN <span class="plus"><i class="fa fa-plus"></i></span></a>
		  
		
            <ul>
              <li> <a href="staff_personal_loan.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Personal Loan </b> </a> </li>
              <li> <a href="staff_festival_loan.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Festival Loan </b> </a> </li>
			  <li> <a href="staff_spf_loan.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> SPF </b> </a> </li>
			  <li> <a href="staff_gpf_loan.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> SPF Loan </b> </a> </li>
          </ul>
       </li>
	   -->	  
		   <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit"></i> VIEW STAFF LOAN <span class="plus"><i class="fa fa-plus"></i></span></a> 
		  
		  <ul>
		  
		     <li> <a  style="color:white; font-weight:bold;"> <i class="fa fa-edit"></i> SINGLE <span class="plus"></a> </li>
			 
			 
			  <li style="margin-left:20px;"> <a href="staff_personal_loan.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Personal Loan </b> </a> </li>
              <li  style="margin-left:20px;"> <a href="staff_festival_loan.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> Festival Loan </b> </a> </li>
			  <li  style="margin-left:20px;"> <a href="staff_spf_loan.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> SPF </b> </a> </li>
			  <li  style="margin-left:20px;"> <a href="staff_gpf_loan.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> SPF Loan </b> </a> </li>
			 
			 
		  <li> <a style="color:white; font-weight:bold;"> <i class="fa fa-edit"></i> GROUP <span class="plus"></a> </li>
		    <li  style="margin-left:20px;"> <a href="view_loan.php"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b> VIEW STAFF LOAN </b> </a> </li>
		  
		  </ul>
		  </li>
		  
		  <li> <a href="staff_festival_reloan.php" style="color:white; font-weight:bold;"> <i class="fa fa-edit"></i> STAFF RELOAN  <span class="plus"> </span></a> </li>
		  
        <li> <a href="staff_withdraw_gpf_loan.php" style="color:white; font-weight:bold;"> <i class="fa fa-edit"></i> WITHDRAW GPF  <span class="plus"></span></a> </li>

         
		   
  <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-user"></i> Users <span class="plus"> <i class="fa fa-plus"></i></span> </a>
            
			<ul>
			
			<li> <a href="change_pwd.php"> <span>&nbsp;</span> <i class="fa fa-users"></i> <b> Change Password </b> </a> </li>
            </ul>
          </li>
		
		 
         <!-- <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT REPORTS1 <span class="plus"><i class="fa fa-plus"></i></span></a> </li>
		 <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT REPORTS2 <span class="plus"><i class="fa fa-plus"></i></span></a> </li>
		 <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT REPORTS3 <span class="plus"><i class="fa fa-plus"></i></span></a> </li>
		 <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT REPORTS4 <span class="plus"><i class="fa fa-plus"></i></span></a> </li>
		 <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT REPORTS5 <span class="plus"><i class="fa fa-plus"></i></span></a> </li>
		 <li> <a href="javascript:void(0);" style="color:white; font-weight:bold;"> <i class="fa fa-edit" ></i> MT REPORTS6 <span class="plus"><i class="fa fa-plus"></i></span></a> </li>
 -->
 	  
      </ul>
        
      </div>
	  
    </div>
    <!--\\\\\\\left_nav end \\\\\\-->
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Dashboard</h1>
          <h2 class="">Subtitle goes here...</h2>
        </div>
      </div>
	  
	   <?php
	   include("include/db.php");
	  // include("include/header1.php");
	   $sql= mysql_query("select * from  jewel_payment_details where particulars!='closed' and initial_entry='1' ");
 $fetch=mysql_num_rows($sql);
	   ?>
	  
	  
      <div class="container clear_both padding_fix" >
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row">
          <div class="col-sm-6 col-sm-6">
            <div class="information green_info">   
              <div class="information_inner">
              	<div class="info green_symbols"> <i class="fa fa-edit icon"> </i> </div>
                <span> <b> NO'S OF MID TERM LOAN </b> </span>
				 <?php
	 $con=mysql_connect("localhost","root","");
mysql_select_db("merged",$con);

	   $sql1 = mysql_query("select  *  from loan_details where status!='closed' ");
	    $fetch1=mysql_num_rows($sql1);
	   // $fetch1=get_jlcount();
		?>
                <h1 class="bolded"> <?php echo $fetch1; ?> </h1> 
               
              </div>
            </div>
          </div>
			  
          <div class="col-sm-6 col-sm-6">
            <div class="information blue_info">
              <div class="information_inner">
              <div class="info blue_symbols"><i class="fa fa-stack-exchange icon"></i></div>
                <span><b> NO'S OF JEWEL LOAN  </b>  </span>
				
                <h1 class="bolded"> <?php echo $fetch; ?> </h1>
              </div>
            </div>
          </div>
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
  </div>
  <!--\\\\\\\ inner end\\\\\\-->
</div>
<!--\\\\\\\ wrapper end\\\\\\-->
<script src="js/jquery-2.1.0.js"> </script>
<script src="js/bootstrap.min.js"> </script>
<script src="js/common-script.js"> </script>
<script src="js/jquery.slimscroll.min.js"> </script>
<script src="js/jquery.sparkline.js"> </script>
<script src="js/sparkline-chart.js"> </script>
<script src="js/graph.js"> </script>
<script src="js/edit-graph.js"> </script>
<script src="plugins/kalendar/kalendar.js" type="text/javascript"> </script>
<script src="plugins/kalendar/edit-kalendar.js" type="text/javascript"> </script>
<script src="plugins/sparkline/jquery.sparkline.js" type="text/javascript"> </script>
<script src="plugins/sparkline/jquery.customSelect.min.js" > </script> 
<script src="plugins/sparkline/sparkline-chart.js"> </script> 
<script src="plugins/sparkline/easy-pie-chart.js"> </script>
<script src="plugins/morris/morris.min.js" type="text/javascript"> </script> 
<script src="plugins/morris/raphael-min.js" type="text/javascript"> </script>  
<script src="plugins/morris/morris-script.js"> </script> 
<script src="plugins/knob/jquery.knob.min.js"> </script> 
<script src="js/jPushMenu.js">    </script> 
<script src="js/side-chats.js">   </script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="plugins/scroll/jquery.nanoscroller.js"></script>

</body>
</html>
