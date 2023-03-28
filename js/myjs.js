const slideMenu = $('.app-sections-menu');
const openButton = $('.open-sections-menu');
const closeButton = $('.close-sections-menu');

openButton.click(function() {
    slideMenu.addClass('open');
});

closeButton.click(function() {
    slideMenu.addClass('close');
    setTimeout(function() {
        slideMenu.removeClass('open');
        slideMenu.removeClass('close');
    }, 300); // match the transition time in CSS
});