getNotes(0);

function getNotes(i) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            displayNotes(this, i);
        }
    };
    xmlhttp.open("GET", "/blog/notes/notes.xml", true);
    xmlhttp.send();
}

function displayNotes(xml, i) {
    var xmlDoc = xml.responseXML; 
    x = xmlDoc.getElementsByTagName("entry");
    document.getElementById("notes").innerHTML =
    `<article>
        <div>
            <img src="/assets/media/main/oingo-boingo.png" alt="profile picture" class="u-photo">
        </div>
        <div>
            <time datetime="` + x[i].getElementsByTagName("updated")[0].childNodes[0].nodeValue + `"><a href="` + x[i].getElementsByTagName("id")[0].childNodes[0].nodeValue + `">` +
            x[i].getElementsByTagName("title")[0].childNodes[0].nodeValue +
            `</a></time>
            <p>` + x[i].getElementsByTagName("content")[0].childNodes[0].nodeValue + `</p>
        </div>
    </article>`;
    
}