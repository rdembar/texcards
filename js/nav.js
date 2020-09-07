// Nav.js
// Menu bar toggle functionality

$(document).ready(function() {
   $('.nav-toggle').on('click', function() {
        if($('.menu ul').css('display') == 'none') {
            $('.menu ul').show();
        } else {
            $('.menu ul').hide();
        }
   });
});