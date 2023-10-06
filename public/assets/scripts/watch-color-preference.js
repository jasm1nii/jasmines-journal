window.matchMedia('(prefers-color-scheme: dark)')
    .addEventListener('change', event => {
        event.matches ? "dark" : "light";
    });