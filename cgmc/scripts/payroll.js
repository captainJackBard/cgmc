function viewPayslip() {
		var self = this,
		employeeId = $(self).data("id"),
		rootURL = "../cgmc/";
		
		location.href = rootURL + "/payslip-stub.php?employeeId=" + employeeId + "&dateFrom=" + $("#date-from").val() + "&dateTo=" + $("#date-to").val()
}

$(window).on("load", function(){
	$(".btn-view-payslip").on("click", viewPayslip);
})