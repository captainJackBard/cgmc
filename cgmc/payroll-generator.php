<?php
include('header.php');

if((isset($_SESSION['UserId'])) && (isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] != 0)){
?>

<div class="row">
	<center><h2><b>Payroll Generator</b></h2><center>
	</br>
	<div class="error-container">
		<ul id="error-list">
		</ul>
		</br>
	</div>
	<div class="col-xs-2 center-block">
		<h4>Date From:</h4>
		
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			<input type="date" id="date-from" class="form-control" />
		</div>
		
		</br>
		<h4>Date To:</h4>
		
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			<input type="date" id="date-to" class="form-control" />
		</div>
		
		</br>
		<div class="form-group" style="width: 215px;">	
			<button class="pull-right btn btn-primary btn-generate"><span class="glyphicon glyphicon-log-in"></span> Generate Payroll</button>
		</div>
		
	</div>
</div>

<script src="scripts/payroll-generator.js"></script>
<?php
include('footer.php');
}
?>