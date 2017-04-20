function login(){
	var uname = $("#txt-username").val(),
		pword = $("#txt-password").val(),
		rootURL = "../cgmc/";
	
	$("#error-list").empty();
	
	if(!uname) {
		$("#error-list").append("<li>Username is required.</li>");
	}
	if(!pword) {
		$("#error-list").append("<li>Password is required.</li>");
	}
	
	if(uname && pword) {
		$.ajax({
			url: rootURL + "methods/home_methods.php?action=login",
			type: "POST",
			data: {
				username: uname,
				password: pword
			},
			success: function(e) {
				var result = JSON.parse(e); //{'result': true}
					console.log(result)
				if(result.result){
					if(result.isAdmin != 0)
						location.href = rootURL + "employees-view-list.php";
				}
					
				else
					$("#error-list").append("<li>Invalid username/password.</li>");
			}
		});
	}
	setTimeout(function(){
		if($("#error-list").children().length > 0)
			$(".error-container").show()
		else
			$(".error-container").hide()
	},500)
}

$(window).on('load', function(){
	$("#submit-button").on("click", login);
});