<?php
include('header.php');

$result = mysql_query("SELECT e.EmployeeId,
															e.FirstName,
															e.MiddleInitial,
															e.LastName,
															e.ImageDataURL,
															e.Status,
															e.PositionId,
															p.PositionName
															from employee as e
															inner join position as p on p.PositionId = e.PositionId") or die(mysql_error());


if((isset($_SESSION['UserId'])) && (isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] != 0)){
?>

<center>
<h3><b>EMPLOYEE MASTERLIST</b></h3>
<h4>ACTIVE</h4>
</center>
	<div class="row">
		<div class="col-xs-4" style="margin-left: 40%">
			<button onclick="location.href = 'employees-view-list.php'" class="btn btn-success"><span class="glyphicon glyphicon-user"></span> ACTIVATED</button>
			<button onclick="location.href = 'deactivated-employees.php'" class="btn btn-danger"><span class="glyphicon glyphicon-user"></span> DEACTIVATED</button>
		</div>
		<div class="col-xs-2 pull-right">
			<button onclick="location.href = 'employee-add.php'" title="Add Employee" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus-sign"></span> Add Employee</button>
		</div>
	</div>
<table class="table table-bordered table-striped table-condensed table-hover">
	<thead>
		<tr class="info">
			<th>EmployeeId</th>
			<th>Image</th>
			<th>Name</th>
			<th>Position</th>
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
		<?php
		while ($row = mysql_fetch_array($result)) {
		?>
			<?php
				if($row['Status'] == '0'){
			?>
				<tr align="center" class="active">
					<th scope="row"><?php echo $row["EmployeeId"] ?></th>
					<td id="picture"><img width="70" src="<?php echo $row['ImageDataURL'] ?>"></td>
					<td id="name"><?php echo $row['FirstName'] . ' ' . $row['MiddleInitial'] . ' ' .  $row['LastName']?></td>
					<td id="position"><?php echo $row["PositionName"] ?></td>
					<td class="option">
							<button data-id="<?php echo $row["EmployeeId"] ?>" class="btn btn-primary btn-edit" title="View Information" on><span class="glyphicon glyphicon-user"></span> View Information</button>
							<button data-id="<?php echo $row["EmployeeId"] ?>" title="Deactivate" class="btn btn-danger btn-deactivate"><span class="glyphicon glyphicon-ban-circle"></span> Deactivate</button>
					</td>
				</tr>
		<?php
			}
		}
		?>
		
	</tbody>
</table>
<script src="scripts/employee-view-list.js"></script>
<?php
include('footer.php');
}
else{
	header("Location: methods\home_methods.php?action=logout");	
}
?>