{
  document.addEventListener('DOMContentLoaded', function() {
    const commentsDiv = document.getElementById("comment-section");
    const commentsId = commentsDiv.dataset.commentsId;
    initComments({
      node: commentsDiv,
      defaultHomeserverUrl: "https://matrix.cactus.chat:8448",
      serverName: "cactus.chat",
      siteName: "<jasm1niixyz>",
      commentSectionId: commentsId
    });
  });
};