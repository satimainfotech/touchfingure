$(document).ready(function() {
	$('.demo-chosen-select').chosen();
	$('.demo-cs-multiselect').chosen({
		width: '100%'
	});
});

$(document).ready(function() {
	$("form").submit(function(e) {
		return false;
	});
});