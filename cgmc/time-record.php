<?php
$date = (isset($_GET['date'])) ? $_GET['date'] : null;

include('header.php');

$result = mysql_query("SELECT e.EmployeeId,
											e.FirstName,
											e.MiddleInitial,
											e.LastName
											from employee as e") or die(mysql_error());

if((isset($_SESSION['UserId'])) && (isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] != 0)) {
?>
<div class="row">
	<div class="col-xs-2 pull-left">
		<input type="hidden" value="<?php echo $date ?>" id="hdn-date"/>
		<h5><b>Time Record for:</b></h5>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			<input type="date" id="date-today" class="form-control" />
		</div>
	</div>
</div>
<table class="table table-bordered table-striped table-condensed table-hover">
	<thead>
		<tr class="info">
			<th>EmployeeId</th>
			<th>Name</th>
			<th>Time-In</th>
			<th>Time-Out</th>
			<th>Cash Advance</th>
			<th>Overtime (Hours)</th>
			<th>Late (Hours)</th>
			<th>Option</th>
		</tr>
	</thead>
	<tbody>
<?php
while ($row = mysql_fetch_array($result)) {
?>
		<tr align="center" class="active">
			<th scope="row"><?php echo $row["EmployeeId"] ?></th>
			<td>
				<?php echo $row['FirstName'] . ' ' . $row['MiddleInitial'] . ' ' .  $row['LastName']?>
			</td>
			<td style="width: 182px">
				<div class="col-xs-2">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
						<input type="time" class="form-control time-in" data-id="<?php echo $row["EmployeeId"] ?>" style="margin-left: 0px" />
					</div>
				</div>
			</td>
			<td style="width: 182px">
				<div class="col-xs-2">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
						<input type="time" class="form-control time-out" data-id="<?php echo $row["EmployeeId"] ?>" style="margin-left: 0px" />
					</div>
				</div>
			</td>
			<td style="width: 182px">
				<div class="input-group">
					<span class="input-group-addon">₱</span>
					<input type="number" class="form-control cash-advance" min="0" max="120" data-id="<?php echo $row["EmployeeId"] ?>" value="0">
				</div>
			</td>
			<td style="width: 182px">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
					<input type="number" class="form-control overtime" min="0" max="120" data-id="<?php echo $row["EmployeeId"] ?>" value="0">
				</div>
			</td>
			<td style="width: 182px">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
					<input type="number" class="form-control late" min="0" max="120" data-id="<?php echo $row["EmployeeId"] ?>" value="0">
				</div>
			</td>
			<td>
				<center>
					<button data-id="<?php echo $row["EmployeeId"] ?>" class="btn btn-primary btn-save" title="Save"><span class="glyphicon glyphicon-check"></span> Save</button>
				</center>
			</td>
		</tr>
<?php
}
?>
</tbody>
</table>
<script src="scripts/time-records.js"></script>
<?php
	include('footer.php');
}
else {
	header("Location: methods\time-records_methods.php?action=insert");	
}
?>