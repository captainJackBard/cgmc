<?php
include('header.php');

if(isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] != 0){
$employeeId = (isset($_GET['id'])) ? $_GET['id'] : null;
$result = mysql_query("SELECT e.EmployeeId,
															e.FirstName,
															e.MiddleInitial,
															e.LastName,
															e.Age,
															e.CivilStatus,
															e.Religion,
															e.DateOfBirth,
															e.PlaceOfBirth,
															e.GenderId,
															e.AddressId,
															e.ContactId,
															e.DateHired,
															e.ImageDataURL,
															g.GenderId,
															g.GenderName,
															a.AddressLine1,
															a.AddressLine2,
															a.City,
															pv.ProvinceName,
															a.Zip,
															c.ContactNumber,
															c.ContactPerson,
															p.PositionId,
															p.PositionName,
															e.Rate
															from employee as e
															left join gender as g on g.GenderId = e.GenderId
															left join address as a on a.AddressId = e.AddressId
															left join contact as c on c.ContactId = e.ContactId
															left join position as p on p.PositionId = e.PositionId
															left join province as pv on pv.ProvinceId = a.ProvinceId
															where EmployeeId = '$employeeId'") or die(mysql_error());

$resultAssoc = mysql_fetch_assoc($result);

if($resultAssoc['EmployeeId']) {
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
		<div class="w3-bar w3-black">		
			<button class="w3-bar-item w3-button tablink w3-gray" onclick="openCity(event,'OfficialInformation')">Official Information</button>
			<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'PersonalInformation')">Personal Information</button>
			<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'ContactInfromation')">Contact Information</button>
		</div>
		</br>
			<div class="col-xs-4 center-block">
				<center><img id="img-viewer" width="100" src="<?php echo $resultAssoc['ImageDataURL'] ?>"/></center>
				</br>
				<label for="image-holder"><b>Employee Image:</b></label>
					<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
					<input id = "image-holder" type = "file" name = "image-holder" class="form-control" accept="image/*" />
				</div>
			</div>
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
			<div id="OfficialInformation" class="w3-container w3- city">
   				<h4>
					<b><u>Official Information</u></b>
				</h4>
				</br>
				<div class="col-xs-4">
					<label for="firstname"><b>First Name:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id = "firstname" type = "text" name = "firstname" class="form-control" value="<?php echo $resultAssoc['FirstName']?>" autofocus required="" />
					</div>
				</div>
				<div class="col-xs-4">
					<label for="middleinitial"><b>Middle Initial:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id = "middleinitial" type = "text" name = "middleinitial" class="form-control" value="<?php echo $resultAssoc['MiddleInitial']?>" required="" />
					</div>
				</div>
				
				<div class="col-xs-4">
					<label for="lastname"><b>Last Name:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id = "lastname" type = "text" name = "lastname" class="form-control" value="<?php echo $resultAssoc['LastName']?>" required="" />
						
					</div>
				</div>
	
				<div class="col-xs-4">
					</br>
					<label for="position"><b>Position:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<select id="position" class="form-control" name="position" value="<?php echo $resultAssoc['PositionId'] ?>" />
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
						<input id = "rate" type = "number" name = "rate" min="1" max="1000" class="form-control" value="<?php echo $resultAssoc['Rate']?>" />
					</div>
				</div>
				
				<div class="col-xs-4">
					</br>
					<label for="dateHired"><b>Date Hired:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input id = "dateHired" type = "date" name = "dateHired" class="form-control" value="<?php echo $resultAssoc['DateHired']?>" />
					</div>
				</div>
			</div>
		</div>

		<div class="row"> 
			<div id="PersonalInformation" class="w3-container w3- city" style="display:none">
				<h4>
					<b><u>Personal Information</u></b>
				</h4>
				</br>
				<div class="col-xs-4">
					<label for="age"><b>Age:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-registration-mark"></i></span>
						<input id = "age" type = "number" name = "age" min="0" max="120" class="form-control" value="<?php echo $resultAssoc['Age'] ?>" required="" />
					</div>			
				</div>
				
				<div class="col-xs-4">
					<label for="gender"><b>Gender:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<select id="gender" class="form-control" name="gender" value="<?php echo $resultAssoc['GenderName'] ?>">
							<option value="1">Male</option>
							<option value="2">Female</option>
						</select>
					</div>
				</div>
				
				<div class="col-xs-4">
					<label for="status"><b>Civil Status:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id = "status" type = "text" name = "status" class="form-control" value="<?php echo $resultAssoc['CivilStatus'] ?>" required />
					</div>
				</div>
	
				<div class="col-xs-4">
					</br>
					<label for="religion"><b>Religion:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input id = "religion" type = "text" name = "religion" class="form-control" value="<?php echo $resultAssoc['Religion'] ?>" required />
					</div>
				</div>
				
				<div class="col-xs-4">
					</br>
					<label for="birthday"><b>Date Of Birth:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input id = "birthday" type = "date" name = "birthday" class="form-control" value="<?php echo $resultAssoc['DateOfBirth'] ?>" />
					</div>	
				</div>
				
				<div class="col-xs-4">
					</br>
					<label for="placeOfBirth"><b>Place Of Birth:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input id = "placeOfBirth" type = "text" name = "placeOfBirth" class="form-control" value="<?php echo $resultAssoc['PlaceOfBirth'] ?>" />
					</div>
				</div>
			</div>
		</div>

		<div class="row"> 
			<div id="ContactInfromation" class="w3-container w3- city" style="display:none">
				<h4>
					<b><u>Contact Information</u></b>
				</h4>
				</br>
				
				<div class="col-xs-4">
					<label for="contactNumber"><b>Contact Number:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
						<input id = "contactNumber" type = "text" name = "contactNumber" class="form-control" value="<?php echo $resultAssoc['ContactNumber'] ?>" required />
					</div>
				</div>
				
				<div class="col-xs-4">
					<label for="addressLine1"><b>AddressLine1:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input id = "addressLine1" type = "text" name = "addressLine1" class="form-control" placeholder="House No., Street" value="<?php echo $resultAssoc['AddressLine1']?>" required />
					</div>
				</div>
				
				<div class="col-xs-4">
					<label for="addressLine2"><b>AddressLine2:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input id = "addressLine2" type = "text" name = "addressLine2" class="form-control" placeholder="Brgy., City"  value="<?php echo $resultAssoc['AddressLine2']?>" required/>
					</div>
				</div>
		
				<div class="col-xs-4">
					</br>
					<label for="province"><b>Province:</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input id = "province" type = "text" name = "province" class="form-control" placeholder="Province" value="<?php echo $resultAssoc['ProvinceName'] ?>" required />
					</div>
				</div>
			</div>
		</div>

		<div class="row">
		</br>
			<div class="col-xs-4">
				<div class ="form-group">
					<input id = "genderId" type = "hidden" name = "genderId" value="<?php echo $resultAssoc['GenderId'] ?>"/>
					<input id = "contactId" type = "hidden" name = "contactId" value="<?php echo $resultAssoc['ContactId'] ?>"/>
					<input id = "addressId" type = "hidden" name = "addressId" value="<?php echo $resultAssoc['AddressId'] ?>"/>
					<input id = "positionId" type = "hidden" name = "positionId" value="<?php echo $resultAssoc['PositionId'] ?>"/>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="form-group">
					<input type="hidden" name="action" value="update" />
					<button data-id="<?php echo $resultAssoc['EmployeeId'] ?>" class="btn btn-primary btn-save">Save Information</button>
					<button class="btn btn-default" onClick="window.history.back()">Cancel</button>
				</div>
			</div>
		</div>
	
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
<script src="scripts/employee-edit.js"></script>
<?php
	}
}
else {
	header("Location: methods\home_methods.php?action=logout");
}
include('footer.php');
?>