var githubView = (function() {
    var modalContent = $('#github-modal-content');
    var topInfo = $('#github-top-info');
    var bottomBoxes = $('#github-bottom-boxes');
    var largeStats = modalContent.parent().find('.center-text-img');
    var closeModalButton = modalContent.parent().parent().find('.close-modal-button');
    var repoBoxes = $('.github-repo-box');

    displayGithubContent = function() {
        modalContent.show();
        bottomBoxes.show();
        largeStats.css('top', '-340px');
        $('.main-page-top-box').hide();

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
        $('.main-page-top-box').show();
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
