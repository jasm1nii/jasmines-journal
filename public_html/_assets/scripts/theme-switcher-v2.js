// based on https://gist.github.com/qaisarferoz/03b133e7fc535dd9f097e31d1f2d1303
{
    let baseTheme = document.getElementById("base-theme").getAttribute("href");
    let baseThemeFile = baseTheme.split("/")[3];
    let baseThemeName = baseThemeFile.replace(".css","");

    if(!document.getElementById('js-theme')) {
        const link = document.createElement('link');
        link.id = 'js-theme';
        link.rel = 'stylesheet';
        link.href = `/_assets/stylesheets/${baseThemeName}_theme.css`;
        link.type = 'text/css';
        document.head.appendChild(link);
    }

};

{
    // retains user-selected theme independent of system color preferences:
    window.matchMedia('(prefers-color-scheme: dark)')
        .addEventListener('change', event => {
            event.matches ? "dark" : "light";
    });

    const page = document.body;
    const themeSwitch = document.createElement('button');

    // create theme toggle button:
    themeSwitch.setAttribute('type', 'button');
    themeSwitch.setAttribute('id', 'themeSwitch');
    document.querySelector('hgroup').insertAdjacentElement('beforebegin', themeSwitch);

    // set default theme:
    localStorage.theme
        ? page.classList.add(localStorage.theme)
        : page.classList.add('light-mode');

    // set theme indicator text:
    page.classList.contains('light-mode')
        ? themeSwitch.innerText = '🌞'
        : themeSwitch.innerText = '🌚';

    // switch theme and store in local storage:
    themeSwitch.addEventListener("click", () => {
        if (page.classList.contains('light-mode')){
            page.classList.remove('light-mode');
            page.classList.add('dark-mode');
            themeSwitch.innerText = '🌚';
            themeSwitch.setAttribute('title','current theme: dark');
            localStorage.theme = 'dark-mode';
        } else {
            page.classList.remove('dark-mode');
            page.classList.add('light-mode');
            themeSwitch.setAttribute('title','current theme: light');
            themeSwitch.innerText = '🌞';
            localStorage.theme = 'light-mode';
        }
    });
};