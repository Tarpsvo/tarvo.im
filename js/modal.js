$('.modal-trigger').click(function() {
    var marginTop = ($(this).parent().is('#coding-box')) ? '-370px' : '-30px';

    if ($(this).hasClass('modal-opened')) {

        $(this).removeClass('modal-opened');
        $(this).css('margin-top', '0px');

        if ($(this).parent().is('#notes-box')) {
            $(this).css('margin-left', '0px');
        }

    } else {

        $(this).addClass('modal-opened');
        $(this).css('margin-top', marginTop);

        if ($(this).parent().is('#notes-box')) {
            $(this).css('margin-left', '-360px');
        }

    }
});
