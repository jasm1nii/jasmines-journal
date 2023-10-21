const blogSubpage = document.querySelector('#headernav #blog');
blogSubpage.insertAdjacentHTML(
    'beforeend',
    `<ul>
        <li><a href="/blog/notes/">notes</a></li>
        <li><a href="/blog/articles/" style="
        text-decoration: wavy underline;
        text-underline-offset: .25em;">articles</a></li>
    </ul>`,
    );