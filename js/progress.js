// Progress dots
var num_dots = 0;
var progress = 0;
		
$(document).ready(function() {
	//fill_dots();
	set_progress();
	
	$(window).resize(function() {
		//fill_dots();
		set_progress();
	});
});

/*function fill_dots() {
	$('.progress-dots').html('');
	num_dots = Math.floor($('.progress-dots').width()/24)-1;
	for (var i = 0; i < num_dots; i++) {
		$('.progress-dots').append('<div class="progress-dot" />');
	}
}*/

function set_progress() {
	$('.progress-dot').removeClass('dot-fill');
		
	for (var i = 0; i < Math.floor(num_dots*progress); i++) {
		set_timeout(i);
	}
}

function set_timeout(i) {
	window.setTimeout(function() {
		$($('.progress-dot')[i]).addClass('dot-fill');
	}, 100*i);
}