<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
require_once("../../vendor/autoload.php");
use App\Reports\Reports;
use App\Message\Message;

if(!isset( $_SESSION)) session_start();
$_GLOBAL= Message::message();
?>

<!DOCTYPE HTML>
<html>
<head>
<title>FixMyArea</title>
	<link href="../../resource/css/form.css" rel="stylesheet">
	
	<script type="text/javascript">
	if (screen.width <= 699) {
	document.location = "single_view_m.php";
	}
	</script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<style>
.table {
    border-collapse: collapse;
    width: 100%;
}

.th, .td {
    text-align: left;
    padding: 8px;
}

 .tr:nth-child(even){background-color: #c7d4e8}

.tr{text-align: left; background-color: #f2f2f2}

.th {
    background-color: #000711;
    color: white;
}
</style>		


<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="../../resource/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- start plugins -->
<script type="text/javascript" src="../../resource/js/jquery.min.js"></script>

<!-- start slider -->
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<!-- Scroll to top-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://arrow.scrolltotop.com/arrow7.js"></script>
    <noscript>Not seeing a <a href="http://www.scrolltotop.com/">Scroll to Top Button</a>? Go to our FAQ page for more info.</noscript>
	<!-- Scroll to top End-->


</head>
<body>
<div class="header_bg1">
<div class="container">
	<div class="row header">
		<div class="logo navbar-left">
			<h1><a href="index.php">FixMyArea </a></h1>
		</div>
		<div class="h_search navbar-right">
			<form id="searchForm"  action="../problems.php"  method="get">			   
               <input type="hidden" name="area" id="inlineCheckbox1" checked="" value="">                                				
               <input type="hidden" name="ward_no" id="inlineCheckbox1" checked="" value="">                                                                        
			    <input type="text" id="searchID" name="search" class="text" value="Search by Area Name or Ward No" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search by Area Name or Ward No';}">
				<input type="submit"  value="search">
			</form>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="row h_menu">
		<nav class="navbar navbar-default navbar-left" role="navigation">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		    </div>
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		     <ul class="nav navbar-nav">
		        <li><a href="index.php">Home</a></li>
		        <li><a href="problems.php">View Problems</a></li>
		        <li class="active"><a href="all_reports.php">All Reports </a></li>
		        <li><a href="fixed_problems.php">Recently Fixed Problems</a></li>
		        <li><a href="report_a_problem.php">Report a Problem</a></li>
				  <!--if the user is logged in then logout will be shown otherwise login will be shown-->
				  <?php if (!isset($_SESSION['email'])) { ?>
                            <li><a href="profile/signup_login.php">Login</a></li>
							<li><a href="contact.html">Contact Us</a></li>
                        <?php } else { ?>
                            <li><a href="profile/profile.php">Profile</a></li>
                            <li><a href="profile/logout.php">Log Out</a></li>
                        <?php } ?>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		    <!-- start soc_icons -->
		</nav>
		<div class="soc_icons navbar-right">
				
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</div>
<div class="main_bg"><!-- start main -->

<div id="select" style="padding-right:10%;padding-left:10%; ">
<table class="table">
  <tr class="tr">
    <th class="th">Word No</th>
    <th class="th">New Problems</th>
	<th class="th">Older Problems</th> <!-- Check by admin feedbak status -->
    <th class="th">Fixed Problems</th>
  </tr >
    <?php 

    for($ward=1; $ward<=50; $ward++){
		
	$new_reports=0;$fixed_reports=0;$old_reports=0;
	
	$objReports = new Reports();
	$objReports->setData(array("ward_no"=>$ward));
    $allData_new = $objReports->all_reports_new("obj");
    foreach ($allData_new as $oneData) {  
    $new_reports=$new_reports+1;
    }
	
	$objReports = new Reports();
	$objReports->setData(array("ward_no"=>$ward));
    $allData_old = $objReports->all_reports_old("obj");
    foreach ($allData_old as $oneData) {  
    $old_reports=$old_reports+1;
    }
	
	$objReports = new Reports();
	$objReports->setData(array("ward_no"=>$ward));
    $allData_fixed = $objReports->all_reports_fixed("obj");
    foreach ($allData_fixed as $oneData) {  
    $fixed_reports=$fixed_reports+1;
    }
	?>
  <tr class="tr">
    <td><?php echo $ward;?></td>
    <td><?php echo $new_reports ;?></td>
	<td><?php echo $old_reports ;?></td>
    <td><?php echo $fixed_reports ; ?></td>
  </tr>
<?php } ?> 
  
 </table>
 
     <div style=" margin-top:30px; margin-bottom:30px; float:right; inline-block:inline">
     <a href="pdf.php" class="btn btn-danger" role="button">Download as PDF</a>
     <a href="xl.php" class="btn btn-danger" role="button">Download as XL</a>
     	
	 </div>

</div><!-- end main -->
<div class="footer_bg"><!-- start footer -->
	<div class="container">
		<div class="row  footer">
			<div class="copy text-center">
				<p class="link"><span>&copy; 2014 Learner. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></span></p>
			</div>
		</div>
	</div>
</div>
</body>
</html>
