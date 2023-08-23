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
    `<article><a href="/blog/notes/#` + x[i].getElementsByTagName("noteID")[0].childNodes[0].nodeValue + `">` +
    x[i].getElementsByTagName("displayDate")[0].childNodes[0].nodeValue +
    `</a> - &ldquo;` +
    x[i].getElementsByTagName("title")[0].childNodes[0].nodeValue +
    `&rdquo;</article>`;
    
}