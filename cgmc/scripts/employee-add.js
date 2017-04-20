function save() {
	var self = this,
		employeeId = $(self).data("id"),
		rootURL = "../cgmc/";

		$.ajax({
			url: rootURL + "methods/employee_methods.php?action=insert",
			type: "POST",
			data: {
				firstname: $("#firstname").val(),
				middleinitial: $("#middleinitial").val(),
				lastname: $("#lastname").val(),
				age: $("#age").val(),
				status: $("#status").val(),
				religion: $("#religion").val(),
				birthday: $("#birthday").val(),
				placeOfBirth: $("#placeOfBirth").val(),
				gender: $("#gender").val(),
				addressLine1: $("#addressLine1").val(),
				addressLine2: $("#addressLine2").val(),
				city: $("#city").val(),
				zip: $("#zip").val(),
				contactNumber: $("#contactNumber").val(),
				position: $("#position").val(),
				rate: $("#rate").val(),
				dateHired: $("#dateHired").val(),
				img: $('#img-viewer').attr("src")
			},
			success: function(e) {
				console.log(e)
				var result = JSON.parse(e); //{'result': true}
				if(result.result)
					location.href = rootURL + "employees-view-list.php";
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
	$(".btn-save").on("click", save);
	$("#image-holder").on("change", fileChanged);
});