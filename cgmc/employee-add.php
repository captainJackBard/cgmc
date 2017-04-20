<?php
include('header.php');

if($_SESSION["UserId"] && $_SESSION['IsAdmin'] != 0) {
?>
<div class="row">
	<div class="col-xs-9 center-block">
		<center><h3><b>Employee Information</b></h3></center>
		</br>
		<div class="row">
			<!--<div class="error-container">
				<ul id="error-list">
				</ul>
			</div>-->
			<div class="w3-bar w3-black w3-border">		
			<button class="w3-bar-item w3-button tablink w3-gray" onclick="openCity(event,'OfficialInformation')">Official Information</button>
			<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'PersonalInformation')">Personal Information</button>
			<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'ContactInfromation')">Contact Information</button>
			</div>
			</br>
		</div>
	
		<!DOCTYPE html>
		<html>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
			<body>
			<style>
			</style>
		</br>
		<div class="row"> 
			<div id="OfficialInformation" class="w3-container w3-border city">
   				</br>
				<div class="col-xs-4 center-block">
					<center><img id="img-viewer" width="100" /></center>
					</br>
					<label for="image-holder"><b>Employee Image:</b></label>
						<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
						<input id = "image-holder" type = "file" name = "image-holder" class="form-control" accept="image/*" />
					</div>
				</div>
				</br>
				<h4>
					<b><u>Official Information</u></b>
				</h4>
				</br>
				<div class="col-xs-4">
					<label for="firstname"><b>First Name:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<form action="employee-add.php">
						<input id = "firstname" type = "text" name = "firstname" class="form-control" autofocus required />
					</div>
				</div>
				<div class="col-xs-4">
					<label for="middleinitial"><b>Middle Initial:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id = "middleinitial" type = "text" name = "middleinitial" class="form-control" required />
					</div>
				</div>
				
				<div class="col-xs-4">
					<label for="lastname"><b>Last Name:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id = "lastname" type = "text" name = "lastname" class="form-control" required />
					</div>
				</div>
	
				<div class="col-xs-4">
					</br>
					<label for="position"><b>Position:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<select id="position" class="form-control" name="position"  />
							<option value="1">Admin Officer</option>
							<option value="2">Carpenter</option>
							<option value="3">Driver</option>
							<option value="4">Foreman</option>
							<option value="5">General Foreman</option>
							<option value="6">Junior Architecture</option>
							<option value="7">Laborer</option>
							<option value="8">Mason</option>
							<option value="9">Paintor</option>
							<option value="10">Welder</option>
						</select>
					</div>
				</div>
				
				<div class="col-xs-4">
					</br>
					<label for="rate"><b>Rate:</b></label>
					<div class="input-group">	
						<span class="input-group-addon">₱</span>
						<input id = "rate" type = "number" name = "rate" min="1" max="1000" class="form-control" />
					</div>
				</div>
				
				<div class="col-xs-4">
					</br>
					<label for="dateHired"><b>Date Hired:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input id = "dateHired" type = "date" name = "dateHired" class="form-control" />
					</div>
				</div>
			</div>
		</div>

		<div class="row"> 
			<div id="PersonalInformation" class="w3-container w3-border city" style="display:none">
				<h4>
					<b><u>Personal Information</u></b>
				</h4>
				</br>
				<div class="col-xs-4">
					<label for="age"><b>Age:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-registration-mark"></i></span>
						<input id = "age" type = "number" name = "age" min="0" max="120" class="form-control" />
					</div>			
				</div>
				
				<div class="col-xs-4">
					<label for="gender"><b>Gender:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<select id="gender" class="form-control" name="gender">
							<option value="1">Male</option>
							<option value="2">Female</option>
						</select>
					</div>
				</div>
				
				<div class="col-xs-4">
					<label for="status"><b>Civil Status:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id = "status" type = "text" name = "status" class="form-control" />
					</div>
				</div>
	
				<div class="col-xs-4">
					</br>
					<label for="religion"><b>Religion:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input id = "religion" type = "text" name = "religion" class="form-control" />
					</div>
				</div>
				
				<div class="col-xs-4">
					</br>
					<label for="birthday"><b>Date Of Birth:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input id = "birthday" type = "date" name = "birthday" class="form-control" />
					</div>	
				</div>
				
				<div class="col-xs-4">
					</br>
					<label for="placeOfBirth"><b>Place Of Birth:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input id = "placeOfBirth" type = "text" name = "placeOfBirth" class="form-control" />
					</div>
				</div>
			</div>
		</div>

		<div class="row"> 
			<div id="ContactInfromation" class="w3-container w3-border city" style="display:none">
				<h4>
					<b><u>Contact Information</u></b>
				</h4>
				</br>
				
				<div class="col-xs-4">
					<label for="contactNumber"><b>Contact Number:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
						<input id = "contactNumber" type = "text" name = "contactNumber" class="form-control" placeholder="Contact Number" />
					</div>
				</div>
				
				<div class="col-xs-4">
					<label for="addressLine1"><b>AddressLine1:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input id = "addressLine1" type = "text" name = "addressLine1" class="form-control" placeholder="House No., Street" />
					</div>
				</div>
				
				<div class="col-xs-4">
					<label for="addressLine2"><b>AddressLine2:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input id = "addressLine2" type = "text" name = "addressLine2" class="form-control" placeholder="Brgy., City" />
					</div>
				</div>
				
				<div class="col-xs-4">
					</br>
					<label for="province"><b>Province:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input id = "province" type = "text" name = "province" class="form-control" placeholder="Province" />
					</div>
				</div>
			</div>
		</div>
			
		<div class="row">
			<div class="col-xs-4">
				<div class ="form-group">
				</div>
			</div>
			<div class="col-xs-4">
				<div class="form-group">
				</br>
					<input type="hidden" name="action" value="insert" />
					<button class="btn btn-primary btn-save"><span class="glyphicon glyphicon-check"></span> Add Employee</button>
					<button class="btn btn-default" onClick="window.history.back()">Cancel</button>
				</div>
			</div>
		</div>
		</form>
<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-gray", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-gray";
}
</script>
</body>
</html>
<script src="scripts/employee-add.js"></script>
<?php
	include('footer.php');
	}
else {
	header("Location: home_methods.php?action=logout");
}
?>