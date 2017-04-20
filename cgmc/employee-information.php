<?php
include('header.php');

if(isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] != 0){
$employeeId = (isset($_GET['id'])) ? $_GET['id'] : null;
$result = mysql_query("SELECT e.EmployeeId,
															CONCAT(e.FirstName,' ',e.MiddleInitial,' ',e.LastName) as 'Name',
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
															e.Status,
															g.GenderId,
															g.GenderName,
															CONCAT(a.AddressLine1, ', ', a.AddressLine2, ',', a.City, ' ', pv.ProvinceName) as 'Address',
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

/* */

if($resultAssoc['EmployeeId']) {
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

<div class="row">
	<div class="col-xs-12">
		<center><h3><b>Employee Information</b></h3></center>
		</br>
		</br>
	</div>
	<div class="row">
	
		<div class="col-xs-12">
			<div class="form-group">
				<center>
				<label for="image-holder"><b>Employee Image:</b></label>
				</br>
				</br>
				<img id="img-viewer"  width="200" src="<?php echo $resultAssoc['ImageDataURL'] ?>">
				</center>
				<!--input id = "image-holder" type = "file" name = "image-holder" class="form-control"/-->
			</div>
		</div>
	</div>
</div>
		
	<div class="container">
		<!-- Trigger the modal with a button -->
		<center><button type="button" class="btn btn-info btn-sml" data-toggle="modal" data-target="#myModal">Open Information</button></center>


		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
	
				<!-- Modal content-->
				<div class="modal-content" style="background-color:#333!important;">
					<div class="modal-header" style="border-bottom-width: 0px;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title" style="color:white;">INFORMATION</h3>
			
			
						<div class="modal-body"> 
							<h4>
								<b><u>Official Information</u></b>
							</h4>
							
							<div class="row">
									<div class="col-xs-6">
										<label for="employeeId"><b>Employee ID:</b>&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['EmployeeId']?></b></label>
									</div>
									<div class="col-xs-6">
										<label for="rate"><b>Rate:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['Rate'] ?></b></label>
									</div>
							</div>
			
							<div class="row">
									<div class="col-xs-6">
										<label for="position"><b>Position:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['PositionName'] ?></b></label>
									</div>
									
									<div class="col-xs-6">
										<label for="dateHired"><b>DateHired:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['DateHired'] ?></b></label>
									</div>	
							</div>
							
							<div class="row">
									<div class="col-xs-6">
										<label for="firstname"><b>Full Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['Name']?></b></label>
									</div>
									
									<div class="col-xs-6">
										<?php
										if($resultAssoc['Status'] == '0'){
											
											$display = "Active";
										?>
										<label for="currentStatus"><b>Status:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $display ?></b></label>
										<?php
										}
										else{
											$display = "Deactivated";
										?>
										<label for="currentStatus"><b>Status:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $display ?></b></label>
										<?php
										}
										?>
									</div>	
							</div>	
							
							<div class="row">
							
								<h4>
									<b><u>Personal Information</u></b>
								</h4>
								
								<div class="row">
										<div class="col-xs-6">
											<label for="age"><b>Age:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['Age']?></b></label>
										</div>
										<div class="col-xs-6">
											<label for="religion"><b>Religion:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['Religion']?></b></label>
										</div>
								</div>
							
								<div class="row">
										<div class="col-xs-6">
											<label for="gender"><b>Gender:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['GenderName']?></b></label>
										</div>
										<div class="col-xs-6">
											<label for="birthday"><b>Birthday:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['DateOfBirth']?></b></label>
										</div>
								</div>
								
								<div class="row">
										<div class="col-xs-6">
											<label for="status"><b>Civil Status:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['CivilStatus']?></b></label>
										</div>
										<div class="col-xs-6">
											<label for="placeOfBirth"><b>PlaceOfBirth:</b>\&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['PlaceOfBirth']?></b></label>
										</div>
								</div>
							</div>
							<div class="row">
								
								<h3>
									<b><u>Contact Information</u></b>
								</h3>
								
								<div>
									<label for="addressLine1"><b>Current Address:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b id="address"><?php echo $resultAssoc['Address']?></b></label>
								</div>
							
								<div class="row">
									<div>
										<label for="contactNumber"><b>Contact Number:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['ContactNumber']?></b></label>
									</div>
								</div>
								
								<div class="row">
									<div>
										<label for="contactPerson"><b>ContactPerson:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $resultAssoc['ContactPerson']?></b></label>
									</div>
								</div>
							</div>
							<div class="row">
								</br>
									<div class ="form-group">
										<input id = "genderId" type = "hidden" name = "genderId" value="<?php echo $resultAssoc['GenderId'] ?>"/>
										<input id = "contactId" type = "hidden" name = "contactId" value="<?php echo $resultAssoc['ContactId'] ?>"/>
										<input id = "addressId" type = "hidden" name = "addressId" value="<?php echo $resultAssoc['AddressId'] ?>"/>
										<input id = "positionId" type = "hidden" name = "positionId" value="<?php echo $resultAssoc['PositionId'] ?>"/>
									</div>
								<div class="col-xs-12">
									<div style="margin-left: 100px;" class="form-group">
										<input type="hidden" name="action" value="update" />
										<button onclick="location.href = 'employee-edit.php?id=<?php echo $resultAssoc["EmployeeId"] ?>'" class="btn btn-primary" title="Edit Information"><span class="glyphicon glyphicon-edit"></span> Edit Information</button>
										<?php
										if($resultAssoc['Status'] == '0'){
										?>
										<button data-id="<?php echo $resultAssoc["EmployeeId"] ?>" title="Deactivate" class="btn btn-danger btn-deactivate"><span class="glyphicon glyphicon-ban-circle"></span> Deactivate</button>
										<?php
										}
										else{
										?>
										<button data-id="<?php echo $resultAssoc["EmployeeId"] ?>" title="Activate" class="btn btn-success btn-activate"><span class="glyphicon glyphicon-ok-circle"></span> Activate</button>
										<span class="glyphicon glyphicon-flag"></span>
										<?php
										}
										?>
										<button class="btn btn-default" onClick="window.history.back()">Back</button>
									</div>
								</div>
							</div>
		
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--<div class="row">
			</br>
			<div class="col-xs-3">
				<div class ="form-group">
					<input id = "genderId" type = "hidden" name = "genderId" value="<?php echo $resultAssoc['GenderId'] ?>"/>
					<input id = "contactId" type = "hidden" name = "contactId" value="<?php echo $resultAssoc['ContactId'] ?>"/>
					<input id = "addressId" type = "hidden" name = "addressId" value="<?php echo $resultAssoc['AddressId'] ?>"/>
					<input id = "positionId" type = "hidden" name = "positionId" value="<?php echo $resultAssoc['PositionId'] ?>"/>
				</div>
			</div>
			<!--<div class="col-xs-9">
				<div style="margin-left: 100px;" class="form-group">
					<input type="hidden" name="action" value="update" />
					<button onclick="location.href = 'employee-edit.php?id=<?php echo $resultAssoc["EmployeeId"] ?>'" class="btn btn-primary" title="Edit Information"><span class="glyphicon glyphicon-edit"></span> Edit Information</button>
					<?php
					if($resultAssoc['Status'] == '0'){
					?>
					<button data-id="<?php echo $resultAssoc["EmployeeId"] ?>" title="Deactivate" class="btn btn-danger btn-deactivate"><span class="glyphicon glyphicon-ban-circle"></span> Deactivate</button>
					<?php
					}
					else{
					?>
					<button data-id="<?php echo $resultAssoc["EmployeeId"] ?>" title="Activate" class="btn btn-success btn-activate"><span class="glyphicon glyphicon-ok-circle"></span> Activate</button>
					<span class="glyphicon glyphicon-flag"></span>
					<?php
					}
					?>
					<button class="btn btn-default" onClick="window.history.back()">Back</button>
				</div>
			</div>-->
	</div>
</html>
<script src="scripts/employee-information.js"></script>
<?php
	}
}
else {
	header("Location: methods\home_methods.php?action=logout");
}
include('footer.php');
?><!--class="btn btn-primary btn-view"-->