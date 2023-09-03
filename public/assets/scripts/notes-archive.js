loadNotes(0);

function loadNotes() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        showArchive(this);
      }
    };
    xhttp.open("GET", "/blog/notes/notes.xml", true);
    xhttp.send();
  }
  function showArchive(xml) {
    var i;
    var xmlDoc = xml.responseXML;
    var x = xmlDoc.getElementsByTagName("entry");
    for (i = 0; i <x.length; i++) { 
    document.getElementById("notesArchive").innerHTML += `<article>
        <div class="notes-format">
            <div>
              <img class="u-photo" alt="profile photo" src="/assets/media/main/oingo-boingo.png">
            </div>
            <div class="h-entry">
                <p class="e-content">` +
                    x[i].getElementsByTagName("content")[0].childNodes[0].nodeValue
                     +
                `</p>
                <time>` + x[i].getElementsByTagName("updated")[0].childNodes[0].nodeValue.substr(0, 10) + `</time>&nbsp;&nbsp;&bull;&nbsp;&nbsp;
                <a href="` + x[i].getElementsByTagName("id")[0].childNodes[0].nodeValue + `">view post with comments</a>
            </div>
        </div>
    </article>`;
    }
  }