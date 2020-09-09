// Flashcards functionality
var terms = [];
var index;

$(document).ready(function() {
	// Render math
	renderMathInElement(document.body, {delimiters: [{left: "$$", right: "$$", display: false}]});
	
	// Fills in terms array
	terms = Object.keys(cards_arr);
	
	setup();	

	// Arrow keys move to next/prev card
	// Spacebar flips card
	$(document).on('keyup', function(e) {
		switch(e.key) {
			case "ArrowRight":
				if(!study) {
					iter(1);
				}
				break;
			case "ArrowLeft":
				if(!study) {
					iter(-1);
				}
				break;
			case " ":
				flip();
				break;
		}
	});
	
	// Clicking flashcard flips card 
	$('#card').on('click', function() {
		flip();
	});
});

// Sets up first flashcard
function setup() {
	// Initialize variables;
	index = 0;
	progress = round(1/terms.length);
	
	// Set progress
	set_progress();
	
	// Flashcard = first card
	$('.front .text').html(terms[0]);
	$('.back .text').html(cards_arr[terms[0]]);
	
	// Render math
	render();
}

// Sets card to index + num
function iter(num) {
	// If card is flipped, flip it back
	if ($('.card-inner').css('transform') != 'none') {
		$('.card-inner').css('transition', 'transform 0s')
						.css('transform', 'none');
		requestAnimationFrame(function() {
			requestAnimationFrame(function() {
				iter(num);
				$('.card-inner').css('transition', 'transform 0.8s');
			});
		});
	} else if (index + num < terms.length && index + num >= 0) {
		// Sets flashcard
		$('.front .text').html(terms[index + num]);
		$('.back .text').html(cards_arr[terms[index + num]]);
	
		// Render math
		render();
	
		// Changes index
		index += num;
	
		// Reset progress
		progress = round((index+1)/terms.length);
		set_progress();
	}
}

// Renders math in flashcard
function render() {
	var front = $('.front .text')[0];
	var back = $('.back .text')[0];
	renderMathInElement(front, {delimiters: [{left: "$$", right: "$$", display: false}]});;
	renderMathInElement(back, {delimiters: [{left: "$$", right: "$$", display: false}]});;
}

// Flips card
function flip() {
	if ($('.card-inner').css('transform') == 'none') {
        $('.card-inner').css('transform', 'rotateY(180deg)');
    } else {
        $('.card-inner').css('transform', 'none');   
    }
}

// Rounds to 2 decimal places
function round(x) {
	return Math.round(x*100)/100;
}
