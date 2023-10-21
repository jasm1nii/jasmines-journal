loadArticles(0);
function loadArticles() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        showArchive(this);
      }
    };
    xhttp.open("GET", "/blog/articles/articles.xml", true);
    xhttp.send();
  }
  function showArchive(xml) {
    var i;
    var xmlDoc = xml.responseXML;
    var x = xmlDoc.getElementsByTagName("entry");
    for (i = 0; i <x.length; i++) { 
    document.getElementById("articlesArchive").innerHTML +=
    `<article>
      <div class="h-entry">
        <h3 class="p-name">&ldquo; ` + x[i].getElementsByTagName("title")[0].childNodes[0].nodeValue + ` &rdquo;</h3><time>` + x[i].getElementsByTagName("updated")[0].childNodes[0].nodeValue.substr(0, 10) + `</time>&nbsp;&nbsp;&bull;&nbsp;&nbsp;
        <a href="` + x[i].getElementsByTagName("id")[0].childNodes[0].nodeValue + `">view post</a>
      </div>
    </article>`;
    };
  };