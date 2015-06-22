$(document).ready(function() {
    mainPage.displayContent();
    $('.modal-trigger').click(function(event) {if (!$(this).hasClass('modal-opened')) mainPage.openModal(event);});
    $('.close-modal-button').click(function(event) {mainPage.closeModal(event);});
});
