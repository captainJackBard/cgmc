function save() {
	var self = this,
		employeeId = $(self).data("id"),
		timeIn = $(".time-in[data-id=" + employeeId + "]").val(),
		timeOut = $(".time-out[data-id=" + employeeId + "]").val(),
		cashAdvance = $(".cash-advance[data-id=" + employeeId + "]").val(),
		overtime = $(".overtime[data-id=" + employeeId + "]").val(),
		late = $(".late[data-id=" + employeeId + "]").val(),
		rootURL = "../cgmc/";
		
	$.ajax({
		url: rootURL + "methods/time-records_methods.php?action=insert",
		type: "POST",
		data: {
			employeeId: employeeId,
			timein: timeIn,
			timeout: timeOut,
			cashAdvance: cashAdvance,
			overtime: overtime,
			late: late,
			date: $("#date-today").val()
		},
		success: function(e) {
			var result = JSON.parse(e); //{'result': true}
			if(result.result)
				alert("Time Record: " +  $("#date-today").val() + " for Employee " + employeeId + ".")
				location.reload();
			}
	});
}

function dateChanged() {
	location.href = "/cgmc/time-record.php?date=" + $("#date-today").val()
}

function getDTRforToday(){
	var rootURL = "../cgmc/";
		
	$.ajax({
		url: rootURL + "methods/time-records_methods.php?action=getDTRforToday",
		type: "POST",
		data: {
			date: $("#date-today").val()
		},
		success: function(e) {
			var result = JSON.parse(e); //{'result': true}
			if(result.result)
				for(var i = 0; i < result.result.length; i++) {
					var item = result.result[i];
					$(".time-in[data-id='" + item.EmployeeId + "']").val(item.TimeIn);
					$(".time-out[data-id='" + item.EmployeeId + "']").val(item.TimeOut);
					$(".cash-advance[data-id='" + item.EmployeeId + "']").val(item.CashAdvance);
					$(".overtime[data-id='" + item.EmployeeId + "']").val(item.Overtime);
					$(".late[data-id='" + item.EmployeeId + "']").val(item.Late);					
				}
			}
	});
}

$(document).ready( function() {
    $('#date-today').val($("#hdn-date").val());
})

$(window).on("load", function(){
	$(".btn-save").on("click", save);
	$('#date-today').on("change", dateChanged)
	getDTRforToday();
});