const changelogSubpage = document.querySelector('#headernav ul li:nth-child(3)');
changelogSubpage.insertAdjacentHTML(
    'beforeend',
    '<ul><li>2023 / august / 17</li></ul>',
);
initComments({
    node: document.getElementById("comment-section"),
    defaultHomeserverUrl: "https://matrix.cactus.chat:8448",
    serverName: "cactus.chat",
    siteName: "<jasm1niixyz>",
    commentSectionId: "blog-20230817"
  });