// Study flashcards functionality

var correct = 0; // Stores correct for this round
var correct_arr = []; // Stores correct for all rounds


$(document).ready(function() {
	
});

// Card marked wrong
function wrong() {
	// Go to next card
	if (index != terms.length - 1) {
		iter(1);
	} else {
		end_round();
	}
}

// Card marked correct
function correct() {
	// Add 1 to correct count
	correct += 1;
	
	// Take card out of rotation
	terms.splice(index,1);
	
	// If we are on the last card, say 5 cards, index = 4
	// Remove one card and now index = 4, terms = 4
	
	// Go to next card
	if(index != terms.length) {
		iter(0);
	} else {
		end_round();
	}
}

// End of round
function end_round() {
	// Display end of round screen and hide cards
	$('#card').hide();
	$('.end-round').show();
}

// All cards finished
function end_study() {
}



