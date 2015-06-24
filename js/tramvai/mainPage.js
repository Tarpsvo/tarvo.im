var mainPage = (function() {
    openModal = function(e) {
        e.stopPropagation();
        var div = $(e.currentTarget);

        div.addClass('modal-opened');
        div.removeClass('box-content modal-trigger');

        if (div.parent().is('#sport-box')) {
            div.css('margin-top', '-180px');
            setTimeout(function() { endomondoView.displayEndomondoContent(); }, 300);
        } else if (div.parent().is('#coding-box')) {
            div.css('margin-left', '-340px');
            div.css('margin-top', '-230px');
            setTimeout(function() { githubView.displayGithubContent(); }, 300);
        } else if (div.parent().is('#notes-box')) {
            div.parent().find('.close-modal-button').fadeIn('500');
            div.css('margin-left', '-360px');
        }
    }

    closeModal = function(e) {
        e.stopPropagation();
        var div = $(e.currentTarget).parent();

        div.removeClass('modal-opened');
        div.addClass('box-content modal-trigger');
        div.css('margin-top', '0px');

        if (div.parent().is('#sport-box')) {
            endomondoView.hideEndomondoContent();
        } else if (div.parent().is('#coding-box')) {
            div.css('margin-left', '0px');
            githubView.hideGithubContent();
        } else if (div.parent().is('#notes-box')) {
            div.parent().find('.close-modal-button').hide();
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
