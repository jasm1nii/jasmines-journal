const blogSubpage = document.querySelector('#headernav ul li:nth-child(3)');
    blogSubpage.insertAdjacentHTML(
    'beforeend',
    `<ul>
        <li>
            <a href="/blog/notes">notes</a>
        </li>
        <li>
            <a href="/blog/articles">articles</a>
        </li>
    </ul>
    <style>
        #headernav ul ul {
            padding-top: 0;
            padding-bottom: 0;
        }
    </style>`,
    );
initComments({
    node: document.getElementById("comment-section"),
    defaultHomeserverUrl: "https://matrix.cactus.chat:8448",
    serverName: "cactus.chat",
    siteName: "<jasm1niixyz>",
    commentSectionId: "notes-20231020"
  });