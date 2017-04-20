<?php
	session_start();
	
	$userIsLoggedIn = (isset($_SESSION['UserId'])) ? true : false;
	//$userName = (isset($_SESSION['Name'])) ? $_SESSION['Name'] : 'Admin';
	include('methods\config.php');
?>

<!DOCTYPE html>
<head>
	<meta charset="UTF-8" />
	<title>CGMC Payroll System</title>
	<link href="content/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
	<link href="content/Style.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="content/images/icon_logo.png"/>
	<script src="scripts/jquery-1.11.3.js"></script>
	
</head>
<body style="font-family: Arial!important;">
<style>

body{
	background-color: #333333;
	 -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  
}

</style>
<div>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<?php
				if($userIsLoggedIn) { 
					if(isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] != 0) {
				?>
					<img src="content/images/cgmc_logo_1.png" class="img-rounded" alt="logo" width="30%" height="50">
					<ul class="nav navbar-nav pull-right">
					
					<li> <!--role="presentation" class="active"--><a href="employees-view-list.php"><span class="glyphicon glyphicon-list-alt"></span> Employee</a></li>
					<li role="presentation"><a href="time-record.php" id="time-record-link"><span class="glyphicon glyphicon-time"></span> Time Records</a></li>
					<li role="presentation"><a href="payroll-generator.php"> Generate Payroll</a></li>
					<?php 
						}				
					?>
					<li><a href="methods/home_methods.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					<?php 
					}
				?>
			</ul>
		</div><!-- /.container-fluid -->
	</nav>
</div>

<script>
$(document).ready( function() {
	Date.prototype.toDateInputValue = (function() {
		var local = new Date(this);
		local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
		return local.toJSON().slice(0,10);
	});

    $('#time-record-link').attr("href", "time-record.php?date=" + new Date().toDateInputValue());
})
</script>