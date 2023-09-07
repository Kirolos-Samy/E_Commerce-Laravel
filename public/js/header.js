document.addEventListener("DOMContentLoaded", function () {
    const navbarToggle = document.getElementById("navbar-toggle");
    const navbarLinks = document.querySelector(".navbar-links");
    // const themeToggle = document.getElementById("theme-toggle");
    // const body = document.body;
    // const group = document.getElementsByClassName("input-group__input");
    // const inputGroupInputs = document.querySelectorAll(".input-group__input");
    // const inputGroupLabels = document.querySelectorAll(".input-group__label");

    navbarToggle.addEventListener("click", function () {
        navbarLinks.classList.toggle("active");
    });

    // themeToggle.addEventListener("click", function () {
    //     body.classList.toggle("dark-mode");
    //     // group.classList.toggle("dark-mode");
    //     inputGroupInputs.forEach(function (input) {
    //         input.classList.toggle("dark-mode");
    //     });
    //     inputGroupLabels.forEach(function (label) {
    //         label.classList.toggle("dark-mode");
    //     });
    //     const isDarkMode = body.classList.contains("dark-mode");
    //     // Set a cookie with the dark mode state
    //     document.cookie = `darkMode=${isDarkMode}; expires=Fri, 31 Dec 9999 23:59:59 GMT`;
    // });
});
