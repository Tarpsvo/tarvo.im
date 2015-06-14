var endomondoWidth = '70px';
var githubWidth = '40px';
var oldBackgroundColor = '#1E252F';
var newBackgroundColor = '#252d39';

var contentDiv, trackerDiv, animWidth;
$('.left-side-box-content').hover(
    function() {
        contentDiv = $(this);
        trackerDiv = $(this).find('.tracker-logo');
        animWidth = (trackerDiv.is('#tracker-endomondo')) ? endomondoWidth : githubWidth;

        contentDiv.css('background-color', newBackgroundColor);
        trackerDiv.css('right', animWidth);
    },

    function() {
        contentDiv = $(this);
        trackerDiv = $(this).find('.tracker-logo');

        contentDiv.css('background-color', oldBackgroundColor);
        trackerDiv.css('right', '5px');
    }
);
