// Form.js

$(document).ready(function() {
   // Checkbox functionality
   $('.container').on('click', function() {
        var input = $(this).children('input')[0];
        $(input).prop('checked', !$(input).prop('checked'));
   });
   
   // Textarea automatic resizing
   $(document).on('keyup', 'textarea', function() {
        // 'scrollHeight' = height of content + padding (20)
        // height() = height of visible content
        // css height = height of content + padding(20) + border(4)
    
        if($(this).prop('scrollHeight') > $(this).height() + 20) {
            // Change css height -> scrollHeight + 4
            $(this).css('height', $(this).prop('scrollHeight') + 4);
        }
   });
});