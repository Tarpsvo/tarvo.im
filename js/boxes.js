var endomondoWidth = 70;
var githubWidth = 40;
var animationTime = 350;
var oldBackgroundColor = '#1E252F';
var newBackgroundColor = '#252d39';

$('.left-side-box-content').hover(
    function() {
        var contentDiv = $(this);
        var trackerDiv = $(this).find('.tracker-logo');
        var animWidth = (trackerDiv.is('#tracker-endomondo')) ? endomondoWidth : githubWidth;

        trackerDiv.find('p').show();
        contentDiv.css('background-color', newBackgroundColor);
        trackerDiv.css('right', animWidth+'px');
    },

    function() {
        var contentDiv = $(this);
        var trackerDiv = $(this).find('.tracker-logo');

        trackerDiv.css('right', '5px');

        contentDiv.css('background-color', oldBackgroundColor);
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

    x = e.pageX - $(this).offset().left - ink.width()/2;
    y = e.pageY - $(this).offset().top - ink.height()/2;

    ink.css({top: y+'px', left: x+'px'}).addClass("animate");
});
