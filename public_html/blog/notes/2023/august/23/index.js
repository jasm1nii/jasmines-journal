const blogSubpage = document.querySelector('#headernav ul li:nth-child(3)');
blogSubpage.insertAdjacentHTML(
    'afterend',
    '<ul><li><a href="/blog/notes/index.html">notes</a></li></ul>' +
    `<style>
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
    commentSectionId: "notes-20230823"
    });