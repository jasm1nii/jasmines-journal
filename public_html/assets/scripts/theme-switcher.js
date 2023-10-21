// based on https://gist.github.com/qaisarferoz/03b133e7fc535dd9f097e31d1f2d1303

// retains user-selected theme independent of system color preferences
window.matchMedia('(prefers-color-scheme: dark)')
    .addEventListener('change', event => {
        event.matches ? "dark" : "light";
});
const page = document.body;
// set default theme
if(localStorage.theme) {
    page.classList.add(localStorage.theme);
    } 
    else {
        page.classList.add('light-mode');
    };
const toggle = document.getElementById('themeToggle');
// switch theme and store in local storage
toggle.addEventListener("click", function(){
    if (page.classList.contains('light-mode')){
            page.classList.remove('light-mode');
            page.classList.add('dark-mode');
            localStorage.theme = 'dark-mode';
        }
        else {
            page.classList.remove('dark-mode');
            page.classList.add('light-mode');
            localStorage.theme = 'light-mode';
        }
    });