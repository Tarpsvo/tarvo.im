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

        trackerDiv.find('p').show();
        contentDiv.css('background-color', newBackgroundColor);
        trackerDiv.css('right', animWidth);
    },

    function() {
        contentDiv = $(this);
        trackerDiv = $(this).find('.tracker-logo');

        setTimeout(function() {trackerDiv.find('p').hide();}, 500);
        contentDiv.css('background-color', oldBackgroundColor);
        trackerDiv.css('right', '5px');
    }
);

var ink, d, x, y;
$(".ripple").click(function(e) {
    if ($(this).find(".ink").length === 0) {
        $(this).prepend("<span class='ink'></span>");
    }

    ink = $(this).find(".ink");
    ink.removeClass("animate");

    if(!ink.height() && !ink.width()){
        d = Math.max($(this).outerWidth(), $(this).outerHeight());
        ink.css({height: d, width: d});
    }

    /* Coding box uses 'bottom' for positioning, Notes box uses 'right' */
    if ($(this).parent().is('#coding-box')) {
        x = e.pageX - $(this).offset().left - ink.width()/2;
        y = Math.abs(e.pageY - $(this).offset().top - $(this).height()) - ink.height()/2;
        ink.css({bottom: y, left: x}).addClass("animate");
    } else if ($(this).parent().is('#notes-box')) {
        x = Math.abs(e.pageX - $(this).offset().left - $(this).width()) - ink.height()/2;
        y = e.pageY - $(this).offset().top - ink.height()/2;
        ink.css({top: y+'px', right: x+'px'}).addClass("animate");
    } else {
        x = e.pageX - $(this).offset().left - ink.width()/2;
        y = e.pageY - $(this).offset().top - ink.height()/2;
        ink.css({top: y+'px', left: x+'px'}).addClass("animate");
    }
});
