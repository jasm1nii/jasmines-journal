const blogSubpage = document.querySelector('#headernav #blog');
        blogSubpage.insertAdjacentHTML(
            'beforeend',
            `<ul>
                <li><a href="/blog/notes/" style="
                text-decoration: wavy underline;
                text-underline-offset: .25em;">notes</a></li>
                <li><a href="/blog/articles/">articles</a></li>
            </ul>` +
            `<style>
                #headernav ul ul {
                    padding-top: 0;
                    padding-bottom: 0;
                }
            </style>`,
            );