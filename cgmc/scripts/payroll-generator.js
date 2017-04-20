function generatePayroll() {
	var self = this,
		employeeId = $(self).data("id"),
		rootURL = "../cgmc/";
	
	$("#error-list").empty();
	
	if(!$("#date-from").val()) {
		$("#error-list").append("<li>Date From is required.</li>");
	}
	if(!$("#date-to").val()) {
		$("#error-list").append("<li>Date To is required.</li>");
	}
	if($("#date-from").val() > $("#date-to").val()){
		$("#error-list").append("<li>Date From is lower than Date To.</li>");
	}
	if($("#date-from").val() <= $("#date-to").val()){
		location.href = rootURL + "payroll.php?from=" + $("#date-from").val() + "&to=" + $("#date-to").val();
	}
	setTimeout(function(){
		if($("#error-list").children().length > 0)
			$(".error-container").show()
		else
			$(".error-container").hide()
	},500)
}
$(window).on("load", function(){
	$(".btn-generate").on("click", generatePayroll);
});