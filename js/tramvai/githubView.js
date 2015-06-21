var githubView = (function() {
    var modalContent = $('#github-modal-content');
    var topInfo = $('#github-top-info');
    var bottomBoxes = $('#github-bottom-boxes');
    var largeStats = modalContent.parent().find('.large-stats');
    var closeModalButton = modalContent.parent().parent().find('.close-modal-button');
    var repoBoxes = $('.github-repo-box');

    displayGithubContent = function() {
        modalContent.show();
        bottomBoxes.show();
        largeStats.css('top', '-360px');

        setTimeout(function() {
            topInfo.fadeIn(400);
            largeStats.hide();
            displayAllRepoBoxes();
            closeModalButton.fadeIn(500);
        }, 300);
    }

    hideGithubContent = function() {
        modalContent.hide();
        bottomBoxes.hide();
        topInfo.hide();
        largeStats.css('top', '0px');
        closeModalButton.hide();
        repoBoxes.removeClass('show');
        largeStats.show();
    }

    displayAllRepoBoxes = function() {
        var timeout = 60;
        var inc = timeout;

        repoBoxes.each(function() {
            var elem = $(this);
            setTimeout(function() {
                elem.addClass('show');
            }, timeout);

            timeout += inc;
        });
    }

    return {
        displayGithubContent: displayGithubContent,
        hideGithubContent: hideGithubContent
    }
})();
