(function($){

    var mainPage = Backbone.View.extend({
        el: $('body'),
        loadingIndicator: $('#page-loading-indicator'),
        pageContent: $('#page-content-wrap'),

        events: {
            'click .modal-trigger.box-content': 'openView',
            'click .close-modal-button': 'closeView'
        },

        initialize: function() {
            _.bindAll(this, 'displayContent', 'openView');
            this.displayContent();
        },

        displayContent: function() {
            $(this.loadingIndicator).fadeOut(500);
            $(this.pageContent).fadeIn(1000);
        },

        openView: function(e) {
            var div = $(e.currentTarget);
            var marginTop = (div.parent().is('#coding-box')) ? '-370px' : '-30px';

            div.addClass('modal-opened');
            div.removeClass('box-content modal-trigger');
            div.css('margin-top', marginTop);

            div.find('.close-modal-button').fadeIn(1500);
            div.find('.modal-loading-indicator').fadeIn(1500);

            if (div.parent().is('#notes-box')) {
                div.css('margin-left', '-360px');
            }
        },

        closeView: function(e) {
            var div = $(e.currentTarget).parent();

            div.removeClass('modal-opened');
            div.addClass('box-content modal-trigger');
            div.css('margin-top', '0px');

            div.find('.close-modal-button').hide();
            div.find('.modal-loading-indicator').hide();


            if (div.parent().is('#notes-box')) {
                div.css('margin-left', '0px');
            }
        }
    });

    var mainPage = new mainPage();
})(jQuery);
