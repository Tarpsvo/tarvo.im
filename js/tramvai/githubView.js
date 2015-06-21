var githubView = (function() {
    modalContent = $('#github-modal-content');
    topInfo = $('#github-top-info');
    bottomBoxes = $('#github-bottom-boxes');
    largeStats = modalContent.parent().find('.large-stats');
    closeModalButton = modalContent.parent().parent().find('.close-modal-button');
    repoBoxes = $('.github-repo-box');

    displayGithubContent = function() {
        modalContent.show();
        bottomBoxes.show();
        largeStats.css('top', '-400px');

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
