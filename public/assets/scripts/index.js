{ // push pin
  document.getElementById("pin").addEventListener("click", ()=>{
  var x = document.getElementById("notice");
  if (x.style.display === "none") {
    x.style.display = "block";
    } else {
      x.style.display = "none";
    }
});

// sticky note contents
const notice = document.querySelector("#notice");
  notice.innerHTML = `
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
    <p><small>click the pushpin to hide this notice.</small></p>
    `;
  const x = notice.style
    x.border = "1px solid goldenrod";
    x.boxShadow = "5px 5px 5px rgba(128, 128, 128, 0.1)";
    x.textAlign = "center";
    x.margin = "10% 15% 0 0";
    x.maxWidth = "180px";
    x.maxHeight = "300px";
    x.overflowY = "auto";
    x.scrollbarWidth = "thin";
    x.scrollbarColor = "rgba(184, 145, 94, 0.692) rgba(250, 240, 230, 0.192)";
    x.color = "var(--sticky-note-font)";
    x.backgroundColor = "var(--sticky-note-bg)";
    notice.querySelector('p').style.padding = "0px 1em";
    const f = notice.querySelectorAll('figure');
      f.forEach (el => {
        el.style.margin = "auto";
      });
    const fc = notice.querySelectorAll('figcaption');
      fc.forEach (el => {
        el.style.margin = "1em";
      });
    const cats = notice.querySelectorAll('img');
      cats.forEach (el => {
        const pic = el.style
          pic.border = "3px solid white";
          pic.outline = "1px solid gray";
          pic.objectFit = "none";
          pic.width = "80%";
          pic.filter = "brightness(120%)";
      });
notice.querySelector('#pluto').style.objectPosition = "right";
notice.querySelector('#pretzel').style.objectPosition = "left";
notice.querySelector('hr').style.borderColor = "goldenrod";
};

{ // yipee!!!!
const d = document;
const surprise = document.getElementById('surprise');

  const flwrBtn = d.createElement('button');
        flwrBtn.setAttribute('title','open for a surprise!');
  const fs = flwrBtn.style;
        fs.backgroundColor = 'transparent';
        fs.border = 'none';
        fs.padding = 0;

  surprise.appendChild(flwrBtn);

  const flwrAttr = {
          src:'/assets/media/main/flower.svg',
          width:50,
          height:50,
          alt:'',
        };
  const flower = d.createElement('img');
  for (let attr in flwrAttr) { 
    if (flwrAttr.hasOwnProperty(attr)) { 
      flower.setAttribute(attr, flwrAttr[attr]); 
    } 
  };
  flwrBtn.insertAdjacentElement('beforeend', flower);

  const creatureAttr = {
    src:'/assets/media/main/la-creatura.png',
    width:'auto',
    height:'auto',
    alt:'',
    class:'u-featured'
  };
  const yipee = d.createElement('img');
  for (let attr in creatureAttr) { 
    if (creatureAttr.hasOwnProperty(attr)) { 
      yipee.setAttribute(attr, creatureAttr[attr]); 
    }
  };
  let ys = yipee.style;
        ys.position = 'absolute';
        ys.marginTop = '20px';
        ys.marginLeft = '-220px';
        ys.display = 'none';
  surprise.appendChild(yipee);
  flwrBtn.addEventListener('click', ()=>{
    let fs = flower.style;
    if (ys.display === "block") {
      ys.display = "none";
      fs.filter = "none";
      fs.transition = 'filter .25s ease-in-out';
    }
    else {
      ys.display = "block";
      fs.filter = 'hue-rotate(45deg) brightness(80%) saturate(300%)';
      }
    });
};

{ // clock
  function dateToText(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    // var seconds = date.getSeconds();
    if (minutes < 10) minutes = '0'+ minutes;
    //if  seconds < 10) seconds = '0'+seconds;
    if (hours < 10) hours = '0'+ hours;
    return innerHTML = hours + `:` + minutes; // + ":" + seconds;
  };
  function updateClocks() {
  for (var i = 0; i < window.arrClocks.length; i++) {
    var clock = window.arrClocks[i];
    var offset = window.arrOffsets[i];
    clock.innerHTML = dateToText(new Date(new Date().getTime()+offset));
    };
  };
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
      };
    };
  updateClocks();
  clockID = setInterval(updateClocks, 1000);
  };
  setTimeout(startClocks, 100);
};

{ // last.fm
  let user = 'jasm1nii';
  let url = 'https://lastfm-last-played.biancarosa.com.br/' + user + '/latest-song';
  let song = document.querySelector('#song');
    fetch(url).then(function (response) {
      return response.json()
      }).then(function (json) {
        song.innerHTML = json['track']['name'] + ' - ' + json['track']['artist']  ['#text'];
    });
  // scrolling animation toggle
  const jstoggle = document.getElementById('js-toggle');
  jstoggle.addEventListener('click', () => {
    const animations = document.querySelectorAll('[data-animation]');
    animations.forEach(animation => {
      const running = animation.style.animationPlayState || 'running';
      animation.style.animationPlayState = running === 'running' ? 'paused' :   'running';
    })
  });
};

{ // status.cafe
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
};

{ // webrings
  { //// safonts
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

            // In this variable, put the HTML that you want your webring "badge"  to   use.
            // keep the link 'href' values the same, but change the text!
            const cp = `
              <span class="title">i'm a <a href="https://xandra.cc/safonts/"    rel="external"><b>sa</b><i>font</i></a></span>
              <br/>
              <span class="nav">
                <a href="${sites[prevSiteIndex].url}" rel="external"    aria-label="safonts webring: previous site">&lt;&lt;</a>
                <a href="${sites[randomSiteIndex].url}" rel="external"    aria-label="safonts webring: random site">???</a>
                <a href="https://xandra.cc/safonts/members.html" rel="external"     aria-label="safonts webring: index">...</a>
                <a href="${sites[nextSiteIndex].url}" rel="external"    aria-label="safonts webring: next site">&gt;&gt;</a>
              </span>
            `;
            this.shadowRoot.querySelector(".safonts").insertAdjacentHTML    ("afterbegin", cp);
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
  };
};