$(document).ready(function() {
    mainPage.displayContent();
    $('.modal-trigger').click(function() {if (!$(this).hasClass('modal-opened')) mainPage.openModal(event);});
    $('.close-modal-button').click(function() {mainPage.closeModal(event);});
});
