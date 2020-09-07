$(document).ready(function() {
	// Exit button removes popup
	$(document).on('click', '.exit', function() {
		$('.alert').remove();
		$('#alert-container').hide();
	});
});

// Toggle pop-up alert
function pop_up_alert(type, title = "", message = "") {
	var icon = {
		"error": "times-circle",
		"warning": "exclamation-triangle",
		"info": "info-circle",
		"success": "check-circle"
	};
	
	$('#alert-container').html(`<div class="alert alert-${type}">
        	<div class="exit"><i class="fas fa-times"></i></div>
			<table>
				<tr>
					<td><i class="fas fa-check-circle"></i></td>
					<td>
						<b>${title}</b>
						<br>
						${message}
					</td>
				</tr>
			</table>
        </div>`);
		
	$('#alert-container').show();
	show_popup();
}

// Show popup: animation
function show_popup() {
	// Slide popup in and out of screen
	$('.alert').animate({right: "0"}, 800).delay(4000).animate({right: "-30%"}, 800);
	
	// Fade out background
	var timeout = window.setTimeout(function() {
		$('#alert-container').css('background', 'none');
	}, 4800);
	
	// Hide alert container
	var timeout = window.setTimeout(function() {
		$('#alert-container').hide();
	}, 5600);
}

