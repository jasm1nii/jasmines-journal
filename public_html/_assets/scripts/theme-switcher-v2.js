// based on https://gist.github.com/qaisarferoz/03b133e7fc535dd9f097e31d1f2d1303

// retains user-selected theme independent of system color preferences
window.matchMedia('(prefers-color-scheme: dark)')
    .addEventListener('change', event => {
        event.matches ? "dark" : "light";
});
// creates theme toggle button
const   page = document.body;
const   themeSwitch = document.createElement('button');
        themeSwitch.setAttribute('type', 'button');
        themeSwitch.setAttribute('id', 'themeSwitch');
document.querySelector('hgroup').insertAdjacentElement('beforebegin',themeSwitch);

// set default theme
if(localStorage.theme) {
    page.classList.add(localStorage.theme);
    } 
    else {
        page.classList.add('light-mode');
    };
// set theme indicator text
if (page.classList.contains('light-mode')){
        themeSwitch.innerText = '🌞';
    }
    else {
        themeSwitch.innerText = '🌚';
    };
// switch theme and store in local storage
themeSwitch.addEventListener("click", function(){
    if (page.classList.contains('light-mode')){
        page.classList.remove('light-mode');
        page.classList.add('dark-mode');
        themeSwitch.innerText = '🌚';
        themeSwitch.setAttribute('title','current theme: dark');
        localStorage.theme = 'dark-mode';
        }
    else {
        page.classList.remove('dark-mode');
        page.classList.add('light-mode');
        themeSwitch.setAttribute('title','current theme: light');
        themeSwitch.innerText = '🌞';
        localStorage.theme = 'light-mode';
    }
});