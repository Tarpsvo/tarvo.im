var endomondoView = (function() {
    var modalContent = $('#endomondo-modal-content');
    var topInfo = $('#endomondo-top-info');
    var bottomBars = $('#endomondo-bottom-bars');
    var largeStats = modalContent.parent().find('.center-text-img');
    var closeModalButton = modalContent.parent().parent().find('.close-modal-button');
    var weekBars = $('.endomondo-week-bar');

    displayEndomondoContent = function() {
        modalContent.show();
        bottomBars.show();
        largeStats.css('top', '-350px');

        setTimeout(function() {
            topInfo.fadeIn(400);
            largeStats.hide();
            displayAllWeekBars();
            closeModalButton.fadeIn(500);
        }, 300);
    }

    hideEndomondoContent = function() {
        modalContent.hide();
        bottomBars.hide();
        topInfo.hide();
        largeStats.css('top', '0px');
        closeModalButton.hide();
        weekBars.removeClass('show');
        largeStats.show();
    }

    displayAllWeekBars = function() {
        var timeout = 60;
        var inc = timeout;

        weekBars.each(function() {
            var elem = $(this);
            setTimeout(function() {
                elem.addClass('show');
            }, timeout);

            timeout += inc;
        });
    }

    return {
        displayEndomondoContent: displayEndomondoContent,
        hideEndomondoContent: hideEndomondoContent
    }
})();
