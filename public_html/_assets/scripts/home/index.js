{ // push pin
  const notice = document.getElementById("notice");
  let ns = notice.style.display;

  document.getElementById("pin").addEventListener("click", () => {
    ns === "none" ? ns = "block" : ns = "none";
  });

  // sticky note contents
  let n = `<p><b><i>have you seen THEM?!</i></b></p>`;
  n += `<figure tabindex="0">`;
  n += `<img src="/_assets/media/main/pluto-pretzel_compressed.webp" width="122" height="106" id="pluto" alt="my cat pluto"/>`;
  n += `<figcaption>pluto (she/her)</figcaption>`;
  n += `</figure>`;
  n += `<figure tabindex="0">`;
  n += `<img src="/_assets/media/main/pluto-pretzel_compressed.webp" width="122" height="106" id="pretzel" alt="my cat pretzel"/>`;
  n += `<figcaption>pretzel (he/him)</figcaption>`;
  n += `</figure>`;
  n += `<p><b>now you have!</b></p><hr/><p><small>click the pushpin to hide this notice.</small></p>`;
  notice.innerHTML = n;
};

{ // yipee!!!!
  const surprise = document.getElementById('surprise');

  const flwrBtn = document.createElement('button');
  flwrBtn.setAttribute('title','open for a surprise!');

  const fs = flwrBtn.style;
  fs.backgroundColor = 'transparent';
  fs.border = 'none';
  fs.padding = 0;

  surprise.appendChild(flwrBtn);

  const flower = document.createElement('img');
  const flwrAttr = {
    src: '/_assets/media/main/flower.svg',
    width: 60,
    height: 60,
    alt: ''
  };

  for (let attr in flwrAttr) { 
    if (flwrAttr.hasOwnProperty(attr)) { flower.setAttribute(attr, flwrAttr[attr]); };
  };

  flwrBtn.insertAdjacentElement('beforeend', flower);

  const creatureAttr = {
    src: '/_assets/media/main/la-creatura.png',
    width: '290',
    height: '341',
    alt: 'ASCII art of the autism creature',
    class: 'u-featured',
    loading: 'lazy'
  };

  const yipee = document.createElement('img');

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
        ys.zIndex = '4';

  surprise.appendChild(yipee);

  flwrBtn.addEventListener('click', ()=>{
    let fs = flower.style;
    if (ys.display === "block") {
      ys.display = "none";
      fs.filter = "none";
      fs.transition = 'filter .25s ease-in-out';
    } else {
      ys.display = "block";
      fs.filter = 'hue-rotate(45deg) brightness(80%) saturate(300%)';
    };
  });
};

{ // clock

  
  function dateToText(date) {
    let hours = date.getHours();
    let minutes = date.getMinutes();
    // var seconds = date.getSeconds();
    if (minutes < 10) { minutes = '0' + minutes; };
    // if  (seconds < 10) seconds = '0'+seconds;
    if (hours < 10) { hours = '0' + hours; };
    return innerHTML = hours + `:` + minutes; // + ":" + seconds;
  };

  function updateClocks() {
    for (var i = 0; i < window.arrClocks.length; i++) {
      let clock = window.arrClocks[i];
      let offset = window.arrOffsets[i];
      clock.innerHTML = dateToText(new Date(new Date().getTime()+offset));
    };
  };
  
  function startClocks() {
    window.arrClocks = [];
    window.arrOffsets = [];

    let el = document.getElementsByClassName('clock')[0];
    let timezone = parseInt(el.getAttribute('timezone'));

    if (!isNaN(timezone)) {
      let tzDifference = timezone * 60 + (new Date()).getTimezoneOffset();
      let offset = tzDifference * 60 * 1000;
      window.arrClocks.push(el);
      window.arrOffsets.push(offset);
    };

    updateClocks();
    setInterval(updateClocks, 1000);
  };

  setTimeout(startClocks, 100);

};

{ // last.fm
  const user = 'jasm1nii';
  const url = 'https://lastfm-last-played.biancarosa.com.br/' + user + '/latest-song';
  const song = document.querySelector('#song');
    fetch(url).then(function (response) {
      return response.json()
      }).then(function (json) {
        song.innerHTML = json['track']['name'] + ' - ' + json['track']['artist']  ['#text'];
    });

  // scrolling animation toggle
  const jstoggle = document.getElementById('js-toggle');
  const animation = document.querySelector('[data-animation]');
  
  jstoggle.addEventListener('click', () => {
      let state = animation.style.animationPlayState || 'running';
      animation.style.animationPlayState = (state === 'running') ? 'paused' : 'running';
    });
  };

{ // status.cafe
  fetch("https://status.cafe/users/jasm1nii/status.json")
    .then( r => r.json() )
    .then( r => {
      if (!r.content.length) {
        document.getElementById("statuscafe-content").innerHTML = "No status yet.";
        return;
      }
      document.getElementById("statuscafe-username").innerHTML = '<a href="https://status.cafe/users/jasm1nii" rel="external me" target="_blank">' + r.author + '</a> ' + r.face + ' ' + r.timeAgo;
      document.getElementById("statuscafe-content").innerHTML = r.content;
    });
};

{ // webrings
  { // re:source ring
    // source: https://pixelsafari.neocities.org/webring/resourcering.js
    const resourceRing_members = [
      'https://pixelsafari.neocities.org/',
      'https://www.thefrugalgamer.net/resources.php',
      'https://choiyoona.neocities.org/resources',
      'https://foreverliketh.is/',
      'https://favicons.neocities.org/',
      'https://bechnokid.neocities.org/home',
      'https://jasm1nii.xyz/',
      'https://pixelglade.net/',
      'https://shinyexe.neocities.org/',
      'https://trinityexe.neocities.org/homepage'
    ];
    const resourceRing_ringurl = "https://pixelsafari.neocities.org/webring/";
    const resourceRing_badgeurl = "/_assets/media/main/resourcering.png";
    const resourceRing_prevurl = "/_assets/media/main/resourceringprev.png";
    const resourceRing_nexturl = "/_assets/media/main/resourceringnext.png";
    const resourceRing_randomurl = "/_assets/media/main/resourceringrandom.png";

    const displayElement = document.getElementById("resourceRing"); 
    const currentLocation = window.location.href;
    const siteIndex = resourceRing_members.indexOf(currentLocation);

    let beforeID = (siteIndex == 0) ? (resourceRing_members.length - 1) : (siteIndex - 1);
    let afterID = (siteIndex == resourceRing_members.length - 1) ? 0 : (siteIndex + 1);
    let randomID = Math.floor(Math.random() * resourceRing_members.length);
    
    displayElement.innerHTML =
      `<span><a href='` + resourceRing_ringurl + `'><img alt='Badge: resourceRing webring' src='` + resourceRing_badgeurl + `' width='88' height='31' loading='lazy'/></a></span>` +
      `<span><a href='` + resourceRing_members[beforeID] + `'><img alt='Previous' src='` + resourceRing_prevurl + `' height='31' width='22' loading='lazy'/></a>` +
      `<a href='` + resourceRing_members[randomID] + `'><img alt='Random' src='` + resourceRing_randomurl + `' height='31' width='44' loading='lazy'/></a>` +
      `<a href='` + resourceRing_members[afterID] + `'><img alt='Next' src='` + resourceRing_nexturl + `' height='31' width='22' loading='lazy'/></a></span>`;
  };

  { // safonts
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
            const matchedSiteIndex = sites.findIndex((site) => site.url === thisSite);

            let prevSiteIndex = matchedSiteIndex - 1;
            if (prevSiteIndex === -1) { prevSiteIndex = sites.length - 1; };

            let nextSiteIndex = matchedSiteIndex + 1;
            if (nextSiteIndex > sites.length - 1) { nextSiteIndex = 0; };

            let randomSiteIndex = this.getRandomInt(0, sites.length - 1);

            let cp = `<span class="title">i'm a <a href="https://xandra.cc/safonts/" rel="external"><b>sa</b><i>font</i></a></span>`;
            cp += `<br/><span class="nav">`;
            cp += `<a href="${sites[prevSiteIndex].url}" rel="external" aria-label="safonts webring: previous site">&lt;&lt;</a>`
            cp += `<a href="${sites[randomSiteIndex].url}" rel="external" aria-label="safonts webring: random site">???</a>`;
            cp += `<a href="https://xandra.cc/safonts/members.html" rel="external" aria-label="safonts webring: index">...</a>`;
            cp += `<a href="${sites[nextSiteIndex].url}" rel="external" aria-label="safonts webring: next site">&gt;&gt;</a></span>`;

            this.shadowRoot.querySelector(".safonts").insertAdjacentHTML("afterbegin", cp);
          });

          const sheet = new CSSStyleSheet;
          let style = `.safonts * { color: inherit; }`;
          style += `.safonts { margin: 1em auto 0px; padding-bottom: 1em; text-align: center; border-bottom: 1px solid rgb(138, 85, 138); }`;
          style += `.safonts .title a { font-size: larger; }`;
          sheet.replaceSync(style);
          this.shadowRoot.adoptedStyleSheets.push(sheet);
      };
      // this calculates a random number
      getRandomInt(min, max) {
        this.min = Math.ceil(min);
        this.max = Math.floor(max);
        return Math.floor(Math.random() * (this.max - this.min + 1)) + this.min;
      };
    };
    // whatever 'customElement' you define MUST be unique
    // do not use the name 'webring-css' or you will conflict with other webrings
    window.customElements.define("ring-900", p1v1g6);
  };
  { // healing hospital
    const tag = document.getElementById('healinghospital');

    let c = `<a href="https://strawberry-gashes.neocities.org" rel="external"><img src="/_assets/media/main/healing-hospital-left.png" width="40" height="40" alt="healing hospital webring: previous site" loading="lazy"/></a>`;
    c += `<a href="https://mizuki.world/healinghospital" rel="external"><img src="/_assets/media/main/healing-hospital.png" width="80" height="40" alt="healing hospital webring: index" loading="lazy"/></a>`;
    c += `<a href="https://tsuinosora.neocities.org/" rel="external"><img src="/_assets/media/main/healing-hospital-right.png" width="40" height="40" alt="healing hospital webing: next site" loading="lazy"/></a>`;

    tag.insertAdjacentHTML('afterbegin', c);
  };
  { // autiring
    const tag = document.getElementById('autiring');

    let c = `<a href='https://zombiigutz.neocities.org/' rel="external"><img src="/_assets/media/main/autiring-left.png" width="32" height="15" alt="autists online webring: previous site" loading="lazy"/></a>`;
    c += `<a href="https://macaque.moe/autiring/index.html" rel="external"><img src="/_assets/media/main/autiring.png" width="96" height="15" alt="autists online webring: index" loading="lazy"/></a>`;
    c += `<a href='https://jubiland.neocities.org/' rel="external" title="next site"><img src="/_assets/media/main/autiring-right.png" width="32" height="15" alt="autists online webring: next site" loading="lazy"/></a>`;

    tag.insertAdjacentHTML('afterbegin', c);
  };
};