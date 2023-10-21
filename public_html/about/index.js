const changelogSubpage = document.querySelector('#headernav #about');
    changelogSubpage.insertAdjacentHTML(
    'beforeend',
    '<ul><li style="font-weight: normal;"><a href="/about/changelog/">change log</a></li></ul>' +
    `<style>#headernav #about {font-weight: 600;}</style>`,
    );