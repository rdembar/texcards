// Functionality for create.php

var num_cards = 0;

$(document).ready(function() {	

	// Add cards if already saved	
	if (typeof cards_arr == 'undefined' || cards_arr.length == 0) {
		add_card();
		add_card();
	} else {
		for (var card in cards_arr) {
			add_card(card, cards_arr[card]);
		}
	}
	
	$('span.textarea').each(function() {
		$(this).addClass('textarea-clear');
	});
	
	$('textarea').each(function() {
		textarea_height(this);
	});
	
	// Button to add card
    $('#add_card').on('click', function(e) {
        e.preventDefault();
        add_card();
        $(`textarea[name=q${num_cards}]`).focus();
    });
    
    // Delete card buttons
    $(document).on('click', '.del', function() {
        var id = $(this).prop('id');
        delete_card(parseInt(id));
        num_cards -= 1;
    });
    
    // Tab adds new card
    $(document).on('keydown', 'textarea', function(e) {
        if($(this).attr('name') == `a${num_cards}` && e.keyCode == 9) {
            add_card();
        }
    });
    
    // Textarea toggle
    $(document).on('click', '.textarea-container', function() {
       $(this).find('textarea').focus(); 
	   textarea_height($($(this).find('textarea')));
    });
    $(document).on('focusout', 'textarea', function() {
        text_to_span(this);
    });
	
	// Don't allow user to go over 200 characters per card
	$(document).on('keydown', 'textarea', function(e) {
		if(e.key == 'Enter') {
			e.preventDefault();
		}
		if($(this).val().length >= 200) {
			if(e.key != 'Backspace') {
				e.preventDefault();
			}
		}
	});
	$(document).on('paste', 'textarea', function(e) {
		var paste = (event.clipboardData || window.clipboardData).getData('text');
		paste = $(this).val() + paste;
		if(paste.length > 200) {
			paste = paste.substr(0,200);
		}
		$(this).val(paste.replace(/(?:\r\n|\r|\n)/g, ' '));
		textarea_height(this);
		
		e.preventDefault();
	});
	
	$(window).resize(function() {
		$('textarea').each(function() {
			text_to_span(this);
		});
	});
});

// Toggles textarea -> span
function text_to_span(txt) {
	
	var id = $(txt).attr('name');
	var span = document.getElementById(id);
	if($(span).height() != $(txt).height()) {
		$(span).css('height', ($(txt).height()+24) + "px");
	}
	
	if($(txt).val() == "") {
		$(span).addClass('textarea-clear');
	} else {
		$(span).removeClass('textarea-clear');
		$(span).text($(txt).val());
		renderMathInElement(span, {delimiters: [{left: "$$", right: "$$", display: false}]});
	}
}

// Adds a card to table
function add_card(q = "", a = "") {
    var x = num_cards + 1;
    $('#cards').append(`<tr id="card_${x}">
                            <td>${num_cards+1}</td>
                            <td>
								<div class="textarea-container">
									<textarea name="q${num_cards+1}" placeholder="Question">${q}</textarea>
									<span id="q${num_cards+1}" class="textarea"></span>
								</div>
							</td>
							<td>
								<div class="textarea-container">
									<textarea name="a${num_cards+1}" placeholder="Answer">${a}</textarea>
									<span id="a${num_cards+1}" class="textarea"></span>
								</div>
							</td>
                            <td><i class="fas fa-trash del clickable" id="${x}"></i></td>   
                        </tr>`);
    num_cards += 1;
}

// Deletes card of given number
function delete_card(num) {
    // Remove card
    $(`#card_${num}`).remove();
    
    // Relabel remaining cards
    var i;
    for(i = num + 1; i <= num_cards; i++) {
        // Change label 
		$(`#card_${i} td:first-child`).html(i-1);
		
		// Change textarea namespaceURI
		$($(`#card_${i} td`)[1]).find('textarea').attr('name', `q${i-1}`);
		$($(`#card_${i} td`)[2]).find('textarea').attr('name', `a${i-1}`);
		$('#q'+i).prop('id', `q${i-1}`);
		$('#a'+i).prop('id', `a${i-1}`);
		
		// Change del id
		$(`#card_${i} td:last-child .del`).prop('id', i-1);
		
		// Change card id
		$(`#card_${i}`).prop('id', `card_${i-1}`);
    }
}
