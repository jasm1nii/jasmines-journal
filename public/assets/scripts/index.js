// push pin
document.getElementById("pin").addEventListener("click", function hide() {
    var x = document.getElementById("notice");
    if (x.style.display === "none") {
      x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    });

// sticky note contents
const notice = document.querySelector("#notice");
const shadow = notice.attachShadow({ mode: "open" });
const style = document.createElement("style");
style.textContent =
` div {
    border: 1px solid goldenrod;
    box-shadow: 5px 5px 5px rgba(128, 128, 128, 0.1);
    text-align: center;
    margin-top: 10%;
    margin-right: 10%;
    max-width: 180px;
    max-height: 300px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: rgba(184, 145, 94, 0.692) rgba(250, 240, 230, 0.192);
    color: #332900;
    background-color: cornsilk;
  }
  p {
    padding: 0px 1em;
  }
  p:first-of-type {
    font-size: 1.5em;
    margin-bottom: .5em;
  }
  figure {
    margin: auto;
    text-align: center;
  }
  figure figcaption {
    margin-top: .5em;
    margin-bottom: 1em;
  }
  #pretzel, #pluto {
    border: solid 3px white;
    outline: 1px solid #806600;
    margin-left: auto;
    margin-right: auto;
    width: 80%;
    height: 80%;
    object-fit: none;
    filter: brightness(120%);
    image-rendering: crisp-edges;
  }
  #pretzel {
    object-position: left;
  }
  #pluto {
    object-position: right;
  }
  hr {
    border: 1px dashed goldenrod;
  }
  ::-webkit-scrollbar {
    width: .5em;
    height: .5em;
  }
  ::-webkit-scrollbar-thumb {
    border-radius: 5px;
  }
  ::-webkit-scrollbar-track-piece {
    background-color: inherit;
  }
  ::-webkit-scrollbar-thumb {
    background-color: rgb(192, 169, 110);
  }
  ::-webkit-scrollbar-thumb:hover {
    background-color: rgb(192, 142, 96);
  }`;
shadow.appendChild(style);

const noticeContent = document.createElement("div");
noticeContent.innerHTML = `
  <p><b><i>have you seen THEM?!</i></b></p>
  <figure tabindex="0">
    <img src="/assets/media/main/pluto-pretzel_compressed.webp" width="100" height="100" id="pluto" alt="my cat pluto"/>
    <figcaption>
      pluto (she/her)
    </figcaption>
  </figure>
  <figure tabindex="0">
    <img src="/assets/media/main/pluto-pretzel_compressed.webp" width="100" height="100" id="pretzel" alt="my cat pretzel"/>
    <figcaption>
      pretzel (he/him)
    </figcaption>
  </figure>
  <p><b>now you have!</b></p>
  <hr>
  <p><small>click the pushpin to hide this notice.</small></p>`;
shadow.appendChild(noticeContent);

// clock
function dateToText(date) {
  var hours = date.getHours()
  var minutes = date.getMinutes();
  // var seconds = date.getSeconds();
  if (minutes < 10) minutes = '0'+minutes;
  //if  seconds < 10) seconds = '0'+seconds;
  if (hours < 10) hours = '0'+hours;
  return innerHTML = hours + `:` + minutes; // + ":" + seconds;
}
function updateClocks() {
for (var i = 0; i < window.arrClocks.length; i++) {
  var clock = window.arrClocks[i];
  var offset = window.arrOffsets[i];
  clock.innerHTML = dateToText(new Date(new Date().getTime()+offset));
  }
}
function startClocks() {
  clockElements = document.getElementsByClassName('clock');
  window.arrClocks = []
  window.arrOffsets = [];
  for(var i = 0; i < clockElements.length; i++) {
  el = clockElements[i];
  timezone = parseInt(el.getAttribute('timezone'));
  if (!isNaN(timezone)) {
    var tzDifference = timezone * 60 + (new Date()).getTimezoneOffset();
    var offset = tzDifference * 60 * 1000;
    window.arrClocks.push(el);
    window.arrOffsets.push(offset);
  }
}
updateClocks();
clockID = setInterval(updateClocks, 1000);
}
setTimeout(startClocks, 100);

// last.fm
let user = 'jasm1nii';
let url = 'https://lastfm-last-played.biancarosa.com.br/' + user + '/latest-song';
let song = document.querySelector('#song');
  fetch(url).then(function (response) {
    return response.json()
    }).then(function (json) {
      song.innerHTML = json['track']['name'] + ' - ' + json['track']['artist']['#text'];
  });

// scrolling animation toggle
const jstoggle = document.getElementById('js-toggle');
jstoggle.addEventListener('click', () => {
  const animations = document.querySelectorAll('[data-animation');
  animations.forEach(animation => {
    const running = animation.style.animationPlayState || 'running';
    animation.style.animationPlayState = running === 'running' ? 'paused' : 'running';
  })
});

// status.cafe
fetch("https://status.cafe/users/jasm1nii/status.json")
  .then( r => r.json() )
  .then( r => {
    if (!r.content.length) {
      document.getElementById("statuscafe-content").innerHTML = "No status yet."
      return
    }
    document.getElementById("statuscafe-username").innerHTML = '<a href="https://status.cafe/users/jasm1nii" rel="external me" target="_blank">' + r.author + '</a> ' + r.face + ' ' + r.timeAgo
    document.getElementById("statuscafe-content").innerHTML = r.content
  });

// webrings
//// safonts
const g1v5x3 = `https://xandra.cc/safonts/webring.json`;
const w9g5p9 = document.createElement("template");

w9g5p9.innerHTML = `<p class="safonts"></p>`;

class p1v1g6 extends HTMLElement {
  connectedCallback() {
    this.attachShadow({ mode: "open" });
    this.shadowRoot.appendChild(w9g5p9.content.cloneNode(true));
    const thisSite = this.getAttribute("site"); 
    
    fetch(g1v5x3)
      .then((response) => response.json())
      .then((sites) => {
        // Finds the current site in the data
        const matchedSiteIndex = sites.findIndex(
          (site) => site.url === thisSite
        );
        let prevSiteIndex = matchedSiteIndex - 1;
        if (prevSiteIndex === -1) prevSiteIndex = sites.length - 1;
        let nextSiteIndex = matchedSiteIndex + 1;
        if (nextSiteIndex > sites.length - 1) nextSiteIndex = 0;
        const randomSiteIndex = this.getRandomInt(0, sites.length - 1);

        // In this variable, put the HTML that you want your webring "badge" to use.
        // keep the link 'href' values the same, but change the text!
        const cp = `
          <span class="title">i'm a <a href="https://xandra.cc/safonts/" rel="external"><b>sa</b><i>font</i></a></span>
          <br/>
          <span class="nav">
            <a href="${sites[prevSiteIndex].url}" rel="external" aria-label="safonts webring: previous site">&lt;&lt;</a>
            <a href="${sites[randomSiteIndex].url}" rel="external" aria-label="safonts webring: random site">???</a>
            <a href="https://xandra.cc/safonts/members.html" rel="external" aria-label="safonts webring: index">...</a>
            <a href="${sites[nextSiteIndex].url}" rel="external" aria-label="safonts webring: next site">&gt;&gt;</a>
          </span>
        `;
        this.shadowRoot
          .querySelector(".safonts")
          .insertAdjacentHTML("afterbegin", cp);
      });

      var sheet = new CSSStyleSheet
        sheet.replaceSync( `
          .safonts * {
            color: inherit;
          }
          .safonts {
            margin: 1em auto 0px;
            padding-bottom: 1em;
            text-align: center;
            border-bottom: 1px solid rgb(138, 85, 138);
          }
          .safonts .title a {
            font-size: larger;
          }
        `)
      this.shadowRoot.adoptedStyleSheets.push(sheet);
  }

  // this calculates a random number
  getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }
}

// whatever 'customElement' you define MUST be unique
// do not use the name 'webring-css' or you will conflict with other webrings
window.customElements.define("ring-900", p1v1g6);