// public/js/theme_toggle.js

$(document).ready(function() {
    $('#theme-toggle').on('click', function() {
        // Toggle the dark-mode class on the body and other elements
        $('body').toggleClass('dark-mode light-mode');
        $('.navbar').toggleClass('dark-mode light-mode');
        $('.navbar-brand').toggleClass('dark-mode light-mode');
        $('.nav-link').toggleClass('dark-mode light-mode');
        $('.container').toggleClass('dark-mode light-mode');

        if ($('body').hasClass('dark-mode')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });

    // Load the saved theme on page load
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        $('body').addClass(savedTheme);
        $('.navbar').addClass(savedTheme);
        $('.navbar-brand').addClass(savedTheme);
        $('.nav-link').addClass(savedTheme);
        $('.container').addClass(savedTheme);
    }
});
