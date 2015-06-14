(function() {
    'use strict';

    angular
        .module('tramvaiApp')
        .controller('ViewController', ViewController);

    function ViewController($scope, $rootScope) {
        /* Morphs the box into full size on click */
        $scope.openModal = function(event) {
            var div = $(event.currentTarget);
            var marginTop = (div.parent().is('#coding-box')) ? '-370px' : '-30px';

            if (div.hasClass('modal-opened')) {
                div.removeClass('modal-opened');
                div.css('margin-top', '0px');

                if (div.parent().is('#notes-box')) {
                    div.css('margin-left', '0px');
                }
            } else {
                div.addClass('modal-opened');
                div.css('margin-top', marginTop);

                if (div.parent().is('#notes-box')) {
                    div.css('margin-left', '-360px');
                }
            }
        };
    }
})();
