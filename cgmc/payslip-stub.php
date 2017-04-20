<?php
include('methods\config.php');
$employeeId = (isset($_GET['employeeId'])) ? $_GET['employeeId'] : null;
$dateFrom = (isset($_GET['dateFrom'])) ? $_GET['dateFrom'] : null;
$dateTo = (isset($_GET['dateTo'])) ? $_GET['dateTo'] : null;


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
												(e.HourlyRate * (count(t.Date) * 8)) + (e.HourlyRate * sum(t.Overtime)) - ((sum(t.Late) * e.HourlyRate) + t.CashAdvance) AS 'NetPay',
												count(t.Date) as 'NumberPresent'
											from employee as e
											inner join position as p on p.PositionId = e.PositionId
											inner join address a on a.AddressId = e.AddressId
											inner join province pr on pr.ProvinceId = a.ProvinceId
											left join time_record t on t.EmployeeId = e.EmployeeId
											WHERE t.Date BETWEEN '$dateFrom' AND '$dateTo'
											AND e.EmployeeId = '$employeeId'
											group by e.EmployeeId, 
															e.FirstName, 
															e.MiddleInitial, 
															e.LastName, 
															e.Rate, 
															p.PositionName, 
															e.HourlyRate, 
															'NetPay'") or die(mysql_error());

	$resultAssoc = mysql_fetch_assoc($result);
?>
<!DOCTYPE html>
<body>
<head>
	<link rel="stylesheet" href="content/Style.css"/>
	<link href="content/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
</head>
	<div class="text-center" id="paystub-container">
		<table id="payslip">
			<tr>
				<td colspan="6">
					<h3><b>CGMC Architecture + Design</b></h3>		
				</td>
			</tr>
			<tr>
				<td colspan="6">
					<b>Payslip</b>
				</td>
			</tr>
			<tr>
				<td colspan="6">
					Payroll Period: <?php echo $dateFrom ?> to <?php echo $dateTo ?>
				</td>
			</tr>
			<tr>
				<td colspan="6">
					Pay Date: <?php echo $dateTo ?>
				</td>
			</tr>
			<tr>
				<td colspan="6">
					Number of Days in Pay period: <?php echo $days ?>
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td colspan="6">
					Number of Days present: <?php echo $resultAssoc['NumberPresent'] ?>
				</td>
			</tr>
			<tr style="text-align: left">
				<td colspan="6"><?php echo  $resultAssoc['FirstName'].' '.$resultAssoc['MiddleInitial'].' '.$resultAssoc['LastName']  ?></td>
			</tr>
			<tr  style="text-align: left">
				<td colspan="6"><?php echo $resultAssoc['Address'] ?></td>
			</tr>
			<tr style="text-align: left">
					<td colspan="5">Basic Salary</td>
					<td colspan="1"  style="text-align: right"><?php echo $resultAssoc['BasicSalary'] ?></td>
			</tr>
			<tr style="text-align: left">
				<td colspan="2">
					Overtime Hours: 
				</td>
				<td colspan="1">
					<?php echo $resultAssoc['Overtime'] ?>
				</td>
				<td colspan="2" >
					Overtime Pay:
				</td>
				<td colspan="1" style="text-align: right">
					<?php echo $resultAssoc['OvertimePay'] ?>
				</td>
			</tr>
			<tr style="text-align: left">
				<td colspan="5">
					Total Earnings
				</td>
				<td colspan="1" style="text-align: right">
					<?php echo $resultAssoc['OvertimePay'] + $resultAssoc['BasicSalary'] ?>
				</td>
			</tr>
			<tr>
				<td colspan="6">
				<hr/>
				</td>
			</tr>
			<tr style="text-align: left">
				<td colspan="6">
					Deductions
				</td>
			</tr>
			<tr style="text-align: left">
				<td colspan="5">
					Cash Advance
				</td>
				<td colspan="1" style="text-align: right">
					<?php echo $resultAssoc['CashAdvance']  ?>
				</td>
			</tr>
			<tr style="text-align: left">
				<td colspan="2">
						Late Hours: 
					</td>
					<td colspan="1">
						2
					</td>
					<td colspan="2" >
						Late Pay Deduction:
					</td>
					<td colspan="1" style="text-align: right">
						<?php echo $resultAssoc['LateDeduction'] ?>
					</td>
			</tr>
			<tr style="text-align: left">
				<td colspan="5">
					Total Deductions
				</td>
				<td colspan="1" style="text-align: right">
					<?php echo $resultAssoc['CashAdvance'] + $resultAssoc['LateDeduction'] ?>
				</td>
			<tr>
				<td colspan="6">
				<hr/>
				</td>
			</tr>
			<tr style="text-align: left">
				<td colspan="5">
					Net Pay
				</td>
				<td colspan="1" style="text-align: right">
					<?php echo ($resultAssoc['OvertimePay'] + $resultAssoc['BasicSalary']) -  ($resultAssoc['CashAdvance'] + $resultAssoc['LateDeduction'])?>
				</td>
			</tr>
			<tr>
				<td>
				</td>
			</tr>
			<tr style="text-align: left">
				<td colspan="2">
					Received By:
				</td>
				<td colspan="4">
					___________________________________________
				</td>
			</tr>
			<tr style="text-align: left">
				<td colspan="2">
					Date Received:
				</td>
				<td colspan="4">
					___________________________________________
				</td>
			</tr>
		</table>
		<button onclick="javascript:print()" class="btn btn-primary btn-print" title="Print"> Print</button>
		<button class="btn btn-default" onClick="window.history.back()">Back</button>
	</div>	
	</body>
</html>