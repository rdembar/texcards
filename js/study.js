// Study flashcards functionality

var correct = 0; // Stores correct for this round
var correct_arr = []; // Stores correct for all rounds
var num_cards = [];
var current_round = 1;

// Undo button stored variables
var was_correct = false;
var last_deleted = "";
var is_back = false;

$(document).ready(function() {
	num_cards.push(terms.length);
	
	// Undo button 
	$('#back').on('click', function() {
		if(!is_back) {
			undo();
		}
	});
});

// Undo last card 
function undo() {	
	// Check not first card
	if(index != 0 || last_deleted != "") {	
		is_back = true;
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
	
	if(is_back) {
		is_back = false;
	}
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
	
	if(is_back) {
		is_back = false;
	}
}

// End of round
function end_round() {
	// Display end of round screen and hide cards
	$('#card').hide();
	$('#title-row').hide();
	$('.progress-dots').hide();
	$('#back').hide();
	
	if (terms.length == 0) {
		end_study();
		$('.end-study').show();
	} else {
		var c_num = num_cards[current_round-1].toString();
		var cor_num = correct.toString();
		var w_num = (c_num - cor_num).toString();
		
		$('#span-cards').html(c_num);
		$('#span-correct').html(cor_num);
		$('#span-wrong').html(w_num);
		
		$('.end-round h2').html("End of Round " + current_round);
		
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
	current_round += 1;
	prev_progress = progress = 0;
	
	// Start new round
	setup();
	$('.card-inner').css('transform', 'none');
		
	$('#title-row').show();
	$('#back').show();
	$('#card').show();	
	$('.progress-dots').show();
	$('.end-round').hide();
	set_progress();
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



