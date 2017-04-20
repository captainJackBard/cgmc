<?php
include('config.php');
$employeeId = (isset($_POST['employeeId'])) ? $_POST['employeeId'] : 0;
$date = (isset($_POST['date'])) ? $_POST['date'] : null;
$timein = (isset($_POST['timein'])) ? $_POST['timein'] : null;
$timeout = (isset($_POST['timeout'])) ? $_POST['timeout'] : null;
$cashAdvance = (isset($_POST['cashAdvance'])) ? $_POST['cashAdvance'] : null;
$overtime = (isset($_POST['overtime'])) ? $_POST['overtime'] : null;
$late = (isset($_POST['late'])) ? $_POST['late'] : null;
$action = (isset($_GET['action'])) ? $_GET['action'] : null;

function getDTRforToday($date){
	$result = mysql_query("SELECT e.EmployeeId,
												t.TimeIn,
												t.TimeOut,
												t.CashAdvance,
												t.Overtime,
												t.Late
												from employee as e
												left join time_record as t on t.EmployeeId = e.EmployeeId
												WHERE t.Date = '$date'") or die(mysql_error());
	
	$eID = array(); 
	$timeIn = array();
	$timeOut = array();
	
	$rows = array();
	while($r = mysql_fetch_assoc($result)) {
	 $rows['result'][] = $r;
	}

	return json_encode($rows);
}

function addRecords($date, $timein, $timeout, $cashAdvance, $overtime, $late, $employeeId) {
	$result = mysql_query("SELECT TimeRecordId FROM time_record
												where EmployeeId = '$employeeId' and Date = '$date'") or die(mysql_error());

	$resultAssoc = mysql_fetch_assoc($result);
	$trId = $resultAssoc["TimeRecordId"];
	
	if($trId ) {		
		$query1 = mysql_query(" UPDATE time_record 
													SET TimeIn = '$timein', 
													TimeOut = '$timeout',
													CashAdvance = '$cashAdvance',
													Overtime = '$overtime',
													Late = '$late'
													WHERE TimeRecordId = '$trId' ");
													
		if($query1){
			return json_encode(array('result' => true));	
		}	
	}
	else {
		$query1 = mysql_query("INSERT INTO time_record (Date, TimeIn, TimeOut, CashAdvance, Overtime, Late, EmployeeId)
							   VALUES ('$date','$timein','$timeout', '$cashAdvance', '$overtime', '$late', '$employeeId')");
		
		if($query1){
			return json_encode(array('result' => true));	
		}	
	}
}

switch($action) {
	case 'insert':
		echo addRecords($date, $timein, $timeout, $cashAdvance, $overtime, $late,  $employeeId);
		break;
		
	case 'getDTRforToday':
		echo getDTRforToday($date);
		break;
		
	default:
		break;
}
?>