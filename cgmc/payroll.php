<?php
include('header.php');

$dateFrom = (isset($_GET['from'])) ? $_GET['from'] : null;
$dateTo = (isset($_GET['to'])) ? $_GET['to'] : null;

$start = new DateTime($dateFrom);
$end = new DateTime($dateTo);
// otherwise the  end date is excluded (bug?)
$end->modify('+1 day');

$interval = $end->diff($start);

// total days
$days = $interval->days;

// create an iterateable period of date (P1D equates to 1 day)
$period = new DatePeriod($start, new DateInterval('P1D'), $end);

// best stored as array, so you can add more than one
//$holidays = array('2012-09-07');

$numdays = 0;
foreach($period as $dt) {
    $curr = $dt->format('D');

    // for the updated question
    //if (in_array($dt->format('Y-m-d'), $holidays)) {
       //$days--;
    //}

    // substract if Saturday or Sunday
    if ($curr == 'Sun') {
        $days = $days - 1;
    }
}

$result = mysql_query("SELECT e.EmployeeId,
												e.FirstName,
												e.MiddleInitial,
												e.LastName,
												CONCAT(a.AddressLine1, ' ', a.AddressLine2, ' ', a.City, ' ', pr.ProvinceName) as 'Address',
												e.Rate,
												e.Rate * count(t.Date) AS 'BasicSalary',
												p.PositionName,
												e.HourlyRate,
												sum(t.Overtime) AS 'Overtime',
												sum(t.Overtime) * e.HourlyRate as 'OvertimePay',
												sum(t.Late) AS 'Late',
												sum(t.Late) * e.HourlyRate as 'LateDeduction',
												sum(t.CashAdvance) as 'CashAdvance',
												((sum(t.Late) * e.HourlyRate) + t.CashAdvance) AS 'Deductions',
												(e.HourlyRate * (count(t.Date) * 8)) + (e.HourlyRate * sum(t.Overtime)) - ((sum(t.Late) * e.HourlyRate) + t.CashAdvance) AS 'NetPay',
												count(t.Date) as 'NumberPresent'
											from employee as e
											inner join position as p on p.PositionId = e.PositionId
											inner join address a on a.AddressId = e.AddressId
											inner join province pr on pr.ProvinceId = a.ProvinceId
											left join time_record t on t.EmployeeId = e.EmployeeId
											WHERE t.Date BETWEEN '$dateFrom' AND '$dateTo'
											group by e.EmployeeId, 
															e.FirstName, 
															e.MiddleInitial, 
															e.LastName, 
															e.Rate, 
															p.PositionName, 
															e.HourlyRate, 
															'NetPay'") or die(mysql_error());


if((isset($_SESSION['UserId'])) && (isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] != 0)) {
?>

<input type="hidden" id="date-from" value="<?php echo $dateFrom ?>"/>
<input type="hidden" id="date-to" value="<?php echo $dateTo ?>"/>

<div class="row"> 
	<div class="col-xs-2 pull-right">
		<button onclick="javascript:print()" class="btn btn-primary btn-block" id="print-button" style="margin-top: 15px;"><span class="glyphicon glyphicon-print"></span> Print Report</button>
	</div>
	<h3>PAYROLL FOR:&nbsp;&nbsp;&nbsp;<u><?php echo $dateFrom ?> to <?php echo $dateTo ?></u></h3>
	</br>
</div>
<table class="table table-bordered table-striped table-condensed table-hover">
	<thead>
		<tr class="info">
			<th>EmployeeId</th>
			<th>Name</th>
			<th>Position</th>
			<th>Rate</br>(Daily)</th>
			<th>Basic Salary</th>
			<th>Overtime</br>(Hour/s)</th>
			<th>Late</br>(Hour/s)</th>
			<th>Cash Advance</th>
			<th>Deductions</th>
			<th>Net Pay</th>
			<th class="button-column">Option</th>
		</tr>
	</thead>
	<tbody>
<?php
while ($row = mysql_fetch_array($result)) {
?>
		<tr align="center" class="active">
			<th scope="row" style="height: 5px;width: 5px;"><?php echo $row["EmployeeId"] ?></th>
			<td style="width: 220px;"><?php echo $row['FirstName'] . ' ' . $row['MiddleInitial'] . ' ' .  $row['LastName']?></td>
			<td><?php echo $row["PositionName"] ?></td>
			<td><?php echo ' ₱ ' . $row["Rate"] ?></td>
			<td style="width: 100px;"><?php echo ' ₱ ' . $row["BasicSalary"] ?></td>
			<td><?php echo $row["Overtime"] ? $row["Overtime"] : 0 ?></td>
			<td><?php echo $row["Late"] ? $row["Late"] : 0 ?></td>
			<td style="width: 100px;"><?php echo ' ₱ ' . $row["CashAdvance"] ? ' ₱ ' . $row["CashAdvance"] : 0 ?></td>
			<td style="width: 100px;"><?php echo ' ₱ ' . $row["Deductions"] ? ' ₱ ' . $row["Deductions"] : 0 ?></td>
			<td style="width: 100px;"><?php echo ' ₱ ' . $row["NetPay"] ? ' ₱ ' . $row["NetPay"] : 0 ?></td>
			<td class="button-column"><button data-id="<?php echo $row["EmployeeId"] ?>" class="btn btn-primary btn-view-payslip" title="View Payslip"><span class="glyphicon glyphicon-eye-open"></span> View Payslip</button></td>
		</tr>
<?php
}
?>
</tbody>
</table>
<div class="row"> 
	<div class="col-xs-2 center-block">
		<button class="btn btn-primary back-button" onClick="window.history.back()">Back</button>
	</div>
</div>
<script src="scripts/payroll.js"></script>
<?php
include('footer.php');
}
?>