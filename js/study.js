// Study flashcards functionality

var correct = 0; // Stores correct for this round
var correct_arr = []; // Stores correct for all rounds
var num_cards = [];

// Undo button stored variables
var was_correct = false;
var last_deleted = "";

$(document).ready(function() {
	num_cards.push(terms.length);
	
	// Undo button 
	$('#back').on('click', function() {
		undo();
	});
});

// Undo last card 
function undo() {	
	// Check not first card
	if(index != 0 || last_deleted != "") {		
		if(was_correct) {	
			terms.splice(index, 0, last_deleted);
			iter(0);
			correct -= 1;
		} else {
			// Go to previous card
			iter(-1);
		}
	}
}

// Card marked wrong
function wrong() {	
	if(event.stopPropagation) event.stopPropagation();

	// Go to next card
	if (index != terms.length - 1) {
		iter(1);
	} else {
		end_round();
	}
	
	was_correct = false;
}

// Card marked correct
function press_correct() {
	if(event.stopPropagation) event.stopPropagation();
	
	correct += 1;
	
	// Remove card from array
	last_deleted = terms.splice(index,1);
	
	// Go to next card
	if(index != terms.length) {
		iter(0);
	} else {
		end_round();
	}
	
	was_correct = true;
}

// End of round
function end_round() {
	// Display end of round screen and hide cards
	$('#card').hide();
	$('.progress-dots').hide();
	$('#back').hide();
	
	if (terms.length == 0) {
		end_study();
		$('.end-study').show();
	} else {
		$('.end-round').show();
	}
}

function new_round() {
	// Save correct total to array
	correct_arr.push(correct);
	
	// Save number of cards to array
	num_cards.push(terms.length);
	
	// Reset variables
	correct = 0;
	was_correct = false;
	last_deleted = "";
	
	// Start new round
	setup();
	$('#card').show();
	$('.progress-dots').show();
	$('.end-round').hide();
}

// All cards finished
function end_study() {
	correct_arr.push(correct);
	
	for (var i = 0; i < num_cards.length; i++) {
		$('#progress-table').append(`<tr>
					<td>${i+1}</td>
					<td>${num_cards[i]}</td>
					<td><span class="green">${correct_arr[i]}</span></td>
					<td><span class="red">${num_cards[i] - correct_arr[i]}</span></td>
				</tr>`);
	}
}



