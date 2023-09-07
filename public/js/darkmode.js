document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById("theme-toggle");
    const body = document.body;
    const inputGroupInputs = document.querySelectorAll(".input-group__input");
    const inputGroupLabels = document.querySelectorAll(".input-group__label");

    // Read the dark mode cookie
    const cookies = document.cookie.split("; ");
    for (const cookie of cookies) {
        const [name, value] = cookie.split("=");
        if (name === "darkMode") {
            if (value === "true") {
                body.classList.add("dark-mode");
                inputGroupInputs.forEach(function (input) {
                    input.classList.add("dark-mode");
                });
                inputGroupLabels.forEach(function (label) {
                    label.classList.add("dark-mode");
                });
            }
            break;
        }
    }

    themeToggle.addEventListener("click", function () {
        body.classList.toggle("dark-mode");
        // group.classList.toggle("dark-mode");
        inputGroupInputs.forEach(function (input) {
            input.classList.toggle("dark-mode");
        });
        inputGroupLabels.forEach(function (label) {
            label.classList.toggle("dark-mode");
        });
        const isDarkMode = body.classList.contains("dark-mode");
        // Set a cookie with the dark mode state
        document.cookie = `darkMode=${isDarkMode}; expires=Fri, 31 Dec 9999 23:59:59 GMT`;
    });
});
