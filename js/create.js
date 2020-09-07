// Functionality for create.php

var num_cards = 0;

$(document).ready(function() {	
	// Add cards if already saved
	if (typeof cards_arr == 'undefined') {
		add_card();
	} else {
		for (var card in cards_arr) {
			add_card(card, cards_arr[card]);
		}
	}
	
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
    
    // Focus on textarea shows delete
    $(document).on('focusin', 'textarea', function() {
        var id = $(this).attr('name').substr(1);
        $('#card_'+id).addClass('focus');
    });
    $(document).on('focusout', 'textarea', function() {
        var id = $(this).attr('name').substr(1);
        $('#card_'+id).removeClass('focus');
    });
    
    // Textarea toggle
    $(document).on('click', '.textarea-container', function() {
       $(this).find('textarea').focus(); 
    });
    $(document).on('focusout', 'textarea', function() {
        var id = $(this).attr('name');
        var span = document.getElementById(id);
        $(span).html($(this).val());
        renderMathInElement(span, {delimiters: [{left: "$$", right: "$$", display: false}]});
    });
});

// Adds a card to table
function add_card(q = "", a = "") {
    var x = num_cards + 1;
    $('#cards').append(`<tr id="card_${x}">
                            <td>${num_cards+1}</td>
                            <td><textarea name="q${num_cards+1}" placeholder="Question">${q}</textarea></td>
                            <td>
                                <table>
                                    <tr>
                                        <td><textarea name="a${num_cards+1}" placeholder="Answer">${a}</textarea></td>
                                        <td><i class="fas fa-trash del" id="${x}"></i></td>
                                    </tr>
                                </table>
                            </td>
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
        var td_arr = $(`#card_${i}`).find('td');
        
        // Change label
        $(td_arr[0]).html(i-1);
        
        // Change textarea names
        $(td_arr[1]).find('textarea').attr('name', `q${i-1}`);
        $(td_arr[2]).find('textarea').attr('name', `a${i-1}`);
        
        // Change delete card id
        $(td_arr[3]).find('.del').html(i-1);
        
        // Change card id
        $(`#card_${i}`).attr('id', `card_${i-1}`);
    }
}
