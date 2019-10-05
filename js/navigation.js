$(document).ready(function() {
    let winWidth = $(window).width()
    if (winWidth > 960 && winWidth < 1140) {
        let rechButton = $("#rechForm button[type='submit']")
        let rechInput = $("#rechForm input[type='search']")
        rechButton.text("")
        rechButton.prepend("<i class='fas fa-search' aria-hidden='true' id='rechIcon'></i>")
        rechInput.css("width", "75%")
    } else {
        rechButton.text("Rechercher")
    }
    // for "hover"
    $('[data-trigger="hover"]').parent().hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn(200);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut(200);
    });
});