// Functionality for pop-up alerts

$(document).ready(function() {
	// Exit button removes popup
	$(document).on('click', '.exit', function() {
		$('#alert-container').hide();
	});
});