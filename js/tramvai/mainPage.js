var mainPage = (function() {
    openModal = function(e) {
        e.stopPropagation();
        var div = $(e.currentTarget);
        var marginTop = (div.parent().is('#coding-box')) ? '-370px' : '-30px';

        div.addClass('modal-opened');
        div.removeClass('box-content modal-trigger');
        div.css('margin-top', marginTop);

        if (div.parent().is('#coding-box')) div.find('.large-stats').hide();
        div.find('.close-modal-button').fadeIn(500);
        div.find('.modal-loading-indicator').fadeIn(500);
        div.find('.modal-content').fadeIn(500);

        if (div.parent().is('#notes-box')) {
            div.css('margin-left', '-360px');
        }
    }

    closeModal = function(e) {
        e.stopPropagation();
        var div = $(e.currentTarget).parent();

        div.removeClass('modal-opened');
        div.addClass('box-content modal-trigger');
        div.css('margin-top', '0px');

        if (div.parent().is('#coding-box')) div.find('.large-stats').fadeIn(500);
        div.find('.close-modal-button').hide();
        div.find('.modal-loading-indicator').hide();
        div.find('.modal-content').hide();

        if (div.parent().is('#notes-box')) {
            div.css('margin-left', '0px');
        }
    }

    displayContent = function() {
        $('#page-loading-indicator').fadeOut(500);
        $('#page-content-wrap').fadeIn(1000);
    }

    return {
        openModal: openModal,
        closeModal: closeModal,
        displayContent: displayContent
    }
})();
