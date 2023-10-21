const changelogSubpage = document.querySelector('#headernav #about');
changelogSubpage.insertAdjacentHTML(
    'beforeend',
    '<ul><li><a href="/about/changelog">change log</a></li></ul>' +
    `<style>#headernav #about ul {font-weight: 600;}</style>`,
    );