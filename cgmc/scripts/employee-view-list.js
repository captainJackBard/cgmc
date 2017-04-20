function viewEmployee() {
	var self = this,
		employeeId = $(self).data("id"),
		rootURL = "../cgmc/";
	
	location.href = rootURL + "employee-information.php?id=" + employeeId;
}

function deactivateEmployee() {
	var self = this,
		employeeId = $(self).data("id"),
		rootURL = "../cgmc/";
	
	$.ajax({
		url: rootURL + "methods/employee_methods.php?action=deactivate",
		type: "POST",
		data: {
			id: employeeId
		},
		success: function(e) {
			var result = JSON.parse(e); //{'result': true}
			if(result.result)
				alert("Employee " + employeeId + " has been Deactivated.")
				location.reload();
		}
	});
}

function activateEmployee() {
	var self = this,
		employeeId = $(self).data("id"),
		rootURL = "../cgmc/";
	
	$.ajax({
		url: rootURL + "methods/employee_methods.php?action=activate",
		type: "POST",
		data: {
			id: employeeId
		},
		success: function(e) {
			var result = JSON.parse(e); //{'result': true}
			if(result.result)
				alert("Employee " + employeeId + " has been Activated.")
				location.reload();
		}
	});
}

function fileChanged(){
	var selectedFile = $('#image-holder')[0].files[0];

	var reader = new FileReader();
	reader.onload = function (e) {
		$('#img-viewer')
			.attr('src', e.target.result);
	};
	reader.readAsDataURL(selectedFile);
}

$(window).on("load", function(){
	$(".btn-edit").on("click", viewEmployee);
	$(".btn-deactivate").on("click", deactivateEmployee);
	$(".btn-activate").on("click", activateEmployee);
});