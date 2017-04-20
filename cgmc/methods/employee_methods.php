<?php
include('config.php');
$employeeId = (isset($_POST['id'])) ? $_POST['id'] : 0;
$firstname = (isset($_POST['firstname'])) ? $_POST['firstname'] : null;
$middleinitial = (isset($_POST['middleinitial'])) ? $_POST['middleinitial'] : null;
$lastname = (isset($_POST['lastname'])) ? $_POST['lastname'] : null;
$age = (isset($_POST['age'])) ? $_POST['age'] : 0;
$status = (isset($_POST['status'])) ? $_POST['status'] : null;
$religion = (isset($_POST['religion'])) ? $_POST['religion'] : null;
$birthday = (isset($_POST['birthday'])) ? $_POST['birthday'] : null;
$placeOfBirth = (isset($_POST['placeOfBirth'])) ? $_POST['placeOfBirth'] : null;
$gender = (isset($_POST['gender'])) ? $_POST['gender'] : null;
$addressLine1 = (isset($_POST['addressLine1'])) ? $_POST['addressLine1'] : null;
$addressLine2 = (isset($_POST['addressLine2'])) ? $_POST['addressLine2'] : null;
$city = (isset($_POST['city'])) ? $_POST['city'] : null;
$zip = (isset($_POST['zip'])) ? $_POST['zip'] : 0;
$contactNumber = (isset($_POST['contactNumber'])) ? $_POST['contactNumber'] : null;
$contactPerson = (isset($_POST['contactPerson'])) ? $_POST['contactPerson'] : null;
$position = (isset($_POST['position'])) ? $_POST['position'] : null;
$contactId = (isset($_POST['contactId'])) ? $_POST['contactId'] : null;
$addressId = (isset($_POST['addressId'])) ? $_POST['addressId'] : null;
$positionId = (isset($_POST['position'])) ? $_POST['position'] : null;
$genderId = (isset($_POST['gender'])) ? $_POST['gender'] : null;
$rate = (isset($_POST['rate'])) ? $_POST['rate'] : 0;
$dateHired = (isset($_POST['dateHired'])) ? $_POST['dateHired'] : null;
$imageBinary = (isset($_POST['img'])) ? $_POST['img'] : null;
$action = (isset($_GET['action'])) ? $_GET['action'] : null;


function addEmployee($firstname, $middleinitial, $lastname, $age, $status, $religion, $birthday, $placeOfBirth, $genderId, $gender, $addressLine1, $addressLine2, $city, $zip, $contactNumber, $positionId, $position, $addressId, $contactId, $rate, $dateHired, $imageBinary){
	$query1 = mysql_query("INSERT INTO address (AdddressLine1, AddressLine2, City, Zip)
						   VALUES ('$addressLine1','$addressLine2','$city','$zip')");
	
		$addressId = mysql_query("LAST_INSERT_ID()");
	
	$query2 = mysql_query("INSERT INTO contact (ContactNumber)
						   VALUES ('$contactNumber')");
	
		$contactId = mysql_query("LAST_INSERT_ID()");
	
	$query_position = mysql_query("SELECT PositionName from position WHERE PositionId = '$positionId' ");
	
	while ($row = mysql_fetch_array($query_position)){
			$position_name = $row['PositionName'];
	}
	
	$query4 = mysql_query("INSERT INTO position (PositionName)
						   VALUES ('$position_name')");
	
	//***************************************************************************************************//
	
	$query_gender = mysql_query("SELECT GenderName from gender WHERE GenderId = '$genderId' ");
	
	while ($row = mysql_fetch_array($query_gender)){
			$gender_name = $row['GenderName'];
	}
	
	$query5 = mysql_query("INSERT INTO position (GenderName)
						   VALUES ('$gender_name')");
	
	$query3 = mysql_query("INSERT INTO employee 
												(FirstName, 
												MiddleInitial, 
												LastName, 
												Age,  
												CivilStatus, 
												Religion, 
												DateOfBirth, 
												PlaceOfBirth,
												GenderId,
												AddressId, 
												ContactId, 
												PositionId,
												Rate, 
												HourlyRate, 
												DateHired, 
												ImageDataURL)
							VALUES ('$firstname',
											 '$middleinitial',
											 '$lastname',
											 '$age',
											 '$status',
											 '$religion',
											 '$birthday',
											 '$placeOfBirth',
											 '$genderId',
											 '$addressId',
											 '$contactId',
											 '$positionId',
											 '$rate', 
											 '$rate' / 8, 
											 '$dateHired',
											 '$imageBinary')");
	
	if($query3 ){
		return json_encode(array('result' => true));
	}
}

function editEmployee($employeeId, $firstname, $middleinitial, $lastname, $age, $status, $religion, $birthday, $placeOfBirth, $genderId, $gender, $addressLine1, $addressLine2, $city, $zip, $contactNumber, $positionId, $position, $addressId, $contactId, $rate, $dateHired, $imageBinary){
	$query1 = mysql_query("UPDATE address 
													SET 
													AddressLine2 = '$addressLine1', 
													AddressLine2 = '$addressLine2', 
													City = '$city'
												WHERE AddressId = '$addressId' ");
		
	$query2 = mysql_query("UPDATE contact 
													SET ContactNumber = '$contactNumber'
												WHERE ContactId = '$contactId'");
						   
	$query4 = mysql_query("UPDATE employee 
												SET 
													Firstname = '$firstname', 
													MiddleInitial = '$middleinitial', 
													LastName = '$lastname', 
													Age = '$age',  
													CivilStatus = '$status', 
													Religion = '$religion', 
													DateOfBirth = '$birthday',
													PlaceOfBirth = '$placeOfBirth',
													GenderId = '$genderId',
													AddressId = '$addressId', 
													ContactId = '$contactId', 
													PositionId = '$position', 
													Rate = '$rate', 
													HourlyRate = ('$rate' / 8), 
													DateHired = '$dateHired', 
													ImageDataURL = '$imageBinary'
												WHERE EmployeeId = '$employeeId' ");
						   
	if($query4)
		return json_encode(array('result' => true));
}

function deactivateEmployee($employeeId){
	$query1 = mysql_query("UPDATE employee 
												SET 
													Status = '1' 
												WHERE EmployeeId = '$employeeId' ") or die(mysql_error());
	
	/*$message = "The Employee has been Deactivated";
	
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo "<script>window.location.assign('employee-view-list.php')</script>";*/
	
	/*$query1 = mysql_query("INSERT INTO deactivated
													(EmployeeId,
													FirstName, 
													MiddleInitial, 
													LastName, 
													Age,  
													CivilStatus, 
													Religion, 
													DateOfBirth, 
													PlaceOfBirth,
													GenderId,
													AddressId, 
													ContactId, 
													PositionId,
													Rate, 
													DateHired, 
													ImageDataURL)
													
							VALUES ('$employeeId',
											 '$firstname',
											 '$middleinitial',
											 '$lastname',
											 '$age',
											 '$status',
											 '$religion',
											 '$birthday',
											 '$placeOfBirth',
											 '$genderId',
											 '$addressId',
											 '$contactId',
											 '$positionId',
											 '$rate', 
											 '$dateHired',
											 '$imageBinary')");*/
											
	
	
	if($query1)
		return json_encode(array('result' => true));
}

function activateEmployee($employeeId){
	$query1 = mysql_query("UPDATE employee 
												SET 
													Status = '0' 
												WHERE EmployeeId = '$employeeId' ") or die(mysql_error());
	
	if($query1)
		return json_encode(array('result' => true));
}

switch($action) {
	case 'insert':
		echo addEmployee($firstname, 
										$middleinitial, 
										$lastname, 
										$age,  
										$status, 
										$religion, 
										$birthday, 
										$placeOfBirth,
										$genderId,
										$gender,										
										$addressLine1, 
										$addressLine2, 
										$city, 
										$zip, 
										$contactNumber,
										$positionId, 
										$position, 
										$addressId, 
										$contactId, 
										$rate, 
										$dateHired, 
										$imageBinary);
		break;
		
	case 'update':
		echo editEmployee($employeeId,
										$firstname, 
										$middleinitial, 
										$lastname, 
										$age,  
										$status, 
										$religion, 
										$birthday, 
										$placeOfBirth,
										$genderId,
										$gender,										
										$addressLine1, 
										$addressLine2, 
										$city, 
										$zip, 
										$contactNumber,
										$positionId, 
										$position, 
										$addressId, 
										$contactId, 
										$rate, 
										$dateHired, 
										$imageBinary);
		break;
		
	case 'deactivate':
		echo deactivateEmployee($employeeId);
		break;
	
	case 'activate';
		echo activateEmployee($employeeId);
		break;
	
	default:
		break;
}

?>