// Form element functionality

$(document).ready(function() {
   // Checkbox functionality
   $('.container').on('click', function() {
        var input = $(this).children('input')[0];
        $(input).prop('checked', !$(input).prop('checked'));
   });
   
   // Textarea automatic resizing
   $(document).on('focusin', 'textarea', function() {
	   	$('#pseudo-div').css('width', ($(this).width()+2) + "px");
   });

	$(window).resize(function() {
		$('textarea').each(function() {
			$('#pseudo-div').css('width', ($(this).width()+2) + "px");
			textarea_height(this);
		});
	});
   
   $(document).on('keydown', 'textarea', function() {			
		textarea_height(this);
   });
   
   // Turn form input red
   $('span.red').each(function() {
		if($(this).html() != "") {
			var id = $(this).prop('id');
			$(`input[name='${id}']`).addClass('invalid');
		}
   });
});

// Set textarea height
function textarea_height(txt) {
	$('#pseudo-div').html($(txt).val());

	var height = Math.max(Math.ceil($('#pseudo-div').height()),26);
    if(height != $(txt).height()) {
		// Change css height -> scrollHeight + 4
		$(txt).css('height', (height+24) + "px");
	}
}