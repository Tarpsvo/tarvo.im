var ink, d, x, y;
$(".ripple").click(function(e) {
    var currentDiv = $(this);
    var parentDiv = currentDiv.parent();

    if (currentDiv.find(".ink").length === 0) {
        currentDiv.prepend("<span class='ink'></span>");
    }

    ink = currentDiv.find(".ink");
    ink.removeClass("animate");

    if (!ink.height() && !ink.width()) {
        d = currentDiv.outerWidth();
        ink.css({height: d, width: d});
    }

    /* Coding box uses 'bottom' for positioning, Notes box uses 'right' */
    if (parentDiv.is('#coding-box')) {
        x = e.pageX - currentDiv.offset().left - ink.width()/2;
        y = Math.abs(e.pageY - currentDiv.offset().top - currentDiv.height()) - ink.height()/2;
        ink.css({bottom: y, left: x}).addClass("animate");
    } else if (parentDiv.is('#notes-box')) {
        x = Math.abs(e.pageX - currentDiv.offset().left - currentDiv.width()) - ink.height()/2;
        y = e.pageY - currentDiv.offset().top - ink.height()/2;
        ink.css({top: y+'px', right: x+'px'}).addClass("animate");
    } else {
        x = e.pageX - currentDiv.offset().left - ink.width()/2;
        y = e.pageY - currentDiv.offset().top - ink.height()/2;
        ink.css({top: y+'px', left: x+'px'}).addClass("animate");
    }
});
