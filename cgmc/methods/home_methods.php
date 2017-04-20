<?php
include('config.php');
$username = $_POST['username'];
$password = $_POST['password'];
$action = $_GET['action'];

function verifyCredentials($username, $password){
	$login_query = mysql_query("SELECT UserId, FirstName, LastName, IsAdmin
								FROM users 
								WHERE Username = '$username'
									AND UserAccess = '$password'");
	
	$variable = mysql_fetch_assoc($login_query);
	
	if($variable['UserId']) {
		session_start();
		session_regenerate_id();
		$_SESSION['UserId'] = $variable['UserId'];
		$_SESSION['Name'] = $variable['FirstName'] . ' ' . $variable['LastName'];
		$_SESSION['IsAdmin'] = $variable['IsAdmin'];
		
		return json_encode(array('result' => true, 'isAdmin' => $variable['IsAdmin'])); //results into {'result':true}
	}	
	else
		return json_encode(array('result' => false));
}

function logout() {
	session_start();
	
	session_regenerate_id();
	session_unset();
	session_destroy();
	
	header("Location: ../Login.php");
}

if(isset($action)) {
	switch($action) {
		case "login":
			echo verifyCredentials($username, $password);
			break;
		
		case "logout":
			logout();
			break;
		
		default:
			echo json_encode(array('result' => false));
			break;
	}
}
?> 