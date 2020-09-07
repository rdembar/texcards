// Flashcards functionality
var terms = [];
var index;

$(document).ready(function() {
	setup();
	
	// Arrow keys move to next/prev card
	// Spacebar flips card
	$(document).on('keyup', function(e) {
		switch(e.key) {
			case "ArrowRight":
				iter(1);
				break;
			case "ArrowLeft":
				iter(-1);
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
	terms = Object.keys(cards_arr);
	index = 0;
	
	// Flashcard = first card
	$('.front .text').html(terms[0]);
	$('.back .text').html(cards_arr[terms[0]]);
}

// Sets card to index + num
function iter(num) {
	// Checks if in range
	if (index + num < terms.length && index + num >= 0) {
		// Sets flashcard
		$('.front .text').html(terms[index + num]);
		$('.back .text').html(cards_arr[terms[index + num]]);
		
		// Changes index
		index += num;
	}
}

// Flips card
function flip() {
	if ($('.card-inner').css('transform') == 'none') {
        $('.card-inner').css('transform', 'rotateY(180deg)');
    } else {
        $('.card-inner').css('transform', 'none');   
    }
}
