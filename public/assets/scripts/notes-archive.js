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
        <div class="notes-format" id="` + x[i].getElementsByTagName("noteID")[0].childNodes[0].nodeValue +`">
            <img class="u-photo" alt="profile photo" src="/assets/media/main/oingo-boingo.png">
            <div class="h-entry">
                <p class="e-content">` +
                    x[i].getElementsByTagName("title")[0].childNodes[0].nodeValue +
                `</p>
                <time datetime="` + x[i].getElementsByTagName("updated")[0].childNodes[0].nodeValue + `">` +
                x[i].getElementsByTagName("displayDate")[0].childNodes[0].nodeValue +
                `</time>
                <a class="u-bridgy-fed" href="https://fed.brid.gy/" aria-hidden="true" tabindex="-1"></a>
            </div>
        </div>
    </article>`;
    }
  }