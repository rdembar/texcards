// Progress dots
var num_dots = 0;
var progress = 0;
var prev_progress = 0;

$(document).ready(function() {
	fill_dots();
	set_progress();
	
	$(window).resize(function() {
		fill_dots();
		set_progress();
	});
});

function fill_dots() {
	$('.progress-dots').html('');
	num_dots = Math.floor($('.progress-dots').width()/24);
	for (var i = 0; i < num_dots; i++) {
		$('.progress-dots').append('<div class="progress-dot" />');
	}
}

function set_progress() {
	if(progress > prev_progress) {
		for(var i = Math.floor(num_dots*prev_progress); i < Math.floor(num_dots*progress); i++) {
			fill_dot(i, 50*(i-Math.floor(num_dots*prev_progress)));
		}
	}else if (progress < prev_progress) {
		for(var i = Math.floor(num_dots*prev_progress)-1; i >= Math.floor(num_dots*progress); i--) {
			unfill_dot(i, 50*(Math.abs(i-Math.floor(num_dots*prev_progress)+1)));
		}
	}
}

function fill_dot(i, time) {
	setTimeout(function() {
		$($('.progress-dot')[i]).addClass('dot-fill');
	}, time);
}

function unfill_dot(i, time) {
	setTimeout(function() {
		$($('.progress-dot')[i]).removeClass('dot-fill');
	}, time);
}