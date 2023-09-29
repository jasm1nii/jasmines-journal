const blogSubpage = document.querySelector('#headernav #blog');
blogSubpage.insertAdjacentHTML(
'beforeend',
`<ul>
    <li><a href="/blog/notes/">notes</a></li>
    <li><a href="/blog/articles/">articles</a></li>
</ul>` +
`<style>
    #headernav #blog > a {
        text-decoration: wavy underline;
        text-underline-offset: .25em;
    }
</style>`,
);