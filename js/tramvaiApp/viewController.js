(function() {
    'use strict';

    angular
        .module('tramvaiApp')
        .controller('ViewController', ViewController);

    function ViewController($scope, $rootScope) {
        $scope.modalOpen = false;

        /* Morphs the box into full size on click */
        $scope.openModal = function(event) {
            var div = $(event.currentTarget);
            var marginTop = (div.parent().is('#coding-box')) ? '-370px' : '-30px';

            div.addClass('modal-opened');
            div.removeClass('box-content');
            div.removeClass('left-side-box-content');
            div.removeClass('modal-trigger');
            div.find('.close-modal-button').fadeIn(1500);
            div.find('.modal-loading-indicator').fadeIn(1500);

            div.css('margin-top', marginTop);

            if (div.parent().is('#notes-box')) {
                div.css('margin-left', '-360px');
            }

            $scope.modalOpen = true;
        };

        /* Morphs the box back to a small box */
        $scope.closeModal = function(event) {
            var div = $(event.currentTarget).parent();

            div.removeClass('modal-opened');
            div.addClass('box-content');
            div.addClass('left-side-box-content');
            div.addClass('modal-trigger');
            div.find('.close-modal-button').hide();
            div.find('.modal-loading-indicator').hide();

            div.css('margin-top', '0px');

            if (div.parent().is('#notes-box')) {
                div.css('margin-left', '0px');
            }

            $scope.modalOpen = false;
        };

        var displayContent = function() {
            $('.page-loading-indicator').fadeOut(500);
            $('#page-content-wrap').fadeIn(1000);
        }

        displayContent();
    }
})();
