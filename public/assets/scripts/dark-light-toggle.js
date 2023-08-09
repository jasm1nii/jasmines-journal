var body = document.body;
let darkMode = window.matchMedia('(prefers-color-scheme: dark)');
let lightMode = window.matchMedia('(prefers-color-scheme: light)');
function themeToggle() {
        if (darkMode.matches) {
            body.classList.toggle("light-mode");
        } else if (lightMode.matches) {
            body.classList.toggle("dark-mode");
        }
}