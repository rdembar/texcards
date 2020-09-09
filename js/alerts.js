// Functionality for pop-up alerts

// Icons for types of pop-ups 
var icon = {
	"error": "times-circle",
	"warning": "exclamation-triangle",
	"info": "info-circle",
	"success": "check-circle"
};

$(document).ready(function() {
	// Exit button removes popup
	$(document).on('click', '.exit', function() {
		$('.alert').remove();
		$('#alert-container').hide();
	});
});

// Toggle slide-in pop-up
function pop_up_slide(type, title = "", message = "", time = 4000) {
	fill_alert(type, title, message);
	$('.alert').addClass('alert-slide');
		
	$('#alert-container').show();
	show_popup(time);
}

// Toggle static pop-up
function pop_up_static(type, title = "", message = "") {
	fill_alert(type, title, message);
	$('.alert').addClass('alert-static');
	
	$('#alert-container').show();
}

// Helper: show popup animation
function show_popup(time) {
	// Slide popup in and out of screen
	$('.alert').animate({right: "0"}, 800).delay(time).animate({right: "-30%"}, 800);
	
	// Fade out background
	var timeout = window.setTimeout(function() {
		$('#alert-container').css('background', 'none');
	}, time+800);
	
	// Hide alert container
	var timeout = window.setTimeout(function() {
		$('#alert-container').hide();
	}, time+1600);
}

// Helper: fill in alert message
function fill_alert(type, title = "", message = "") {
	$('#alert-container').html(`<div class="alert alert-${type}">
        <div class="exit"><i class="fas fa-times clickable"></i></div>
		<table>
			<tr>
				<td><i class="fas fa-${icon[type]}"></i></td>
				<td>
					<b>${title}</b>
					<br>
					${message}
				</td>
			</tr>
		</table>
       </div>`);
}
