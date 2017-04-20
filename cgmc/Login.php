<?php
include('header.php');
?>
	<div>
	<center><img src="content/images/cgmc_logo_3.png" class="img-rounded" alt="logo" width="45%" height="170"></center>    
	</div>

<div class="row">
	<div class="error-container">
		<ul id="error-list">
		</ul>
	</div>
	</br>
	
	<div class="contact-form col-xs-3 center-block">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id = "txt-username" type = "text" name = "username" placeholder = "Username" class="form-control" required=""/>
			</div>
			
			</br>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input id = "txt-password" type = "password" name = "password" placeholder = "********" class="form-control" required=""/>
			</div>
			
			</br>
			<div class="form-group">
				<button id = "submit-button" value = "Login" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Login</button>
			</div>
	</div>
</div>
<script src="scripts/home.js"></script>
<?php
include('footer.php');
?>