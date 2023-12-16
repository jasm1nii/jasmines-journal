{ // push pin
  const notice = document.getElementById("notice");

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

  function showNote() {
    if (notice.style.display === "none") {
      notice.style.display = "block";
    } else {
      notice.style.display = "none";
    };
  };

  document.getElementById("pin").addEventListener("click", showNote);
};

{ // yipee!!!!
  const surprise = document.getElementById('surprise');

  function createButton() {
     const flower = document.createElement('img');
     const flwrAttr = {
      src: '/_assets/media/main/flower.svg',
      width: 60,
      height: 60,
      alt: ''
    };
    for (let attr in flwrAttr) { 
      flower.setAttribute(attr, flwrAttr[attr]);
    };

    const flwrBtn = document.createElement('button');
    flwrBtn.insertAdjacentElement('beforeend', flower);
    flwrBtn.setAttribute('title','open for a surprise!');

    const fs = flwrBtn.style;
    fs.backgroundColor = 'transparent';
    fs.border = 'none';
    fs.padding = 0;

    return flwrBtn;
  };

  const button = createButton();
  surprise.appendChild(button);

  function addCreature() {
    const creature = document.createElement('img');
    const creatureAttr = {
      src: '/_assets/media/main/la-creatura.png',
      width: '290',
      height: '341',
      alt: 'ASCII art of the autism creature',
      class: 'u-featured',
      loading: 'lazy'
    };
    for (let attr in creatureAttr) {
      creature.setAttribute(attr, creatureAttr[attr]);
    };
    const cs = creature.style;
    cs.position = 'absolute';
    cs.marginTop = '20px';
    cs.display = 'none';
    cs.marginLeft = '-220px';
    cs.zIndex = '4';
    return creature;
  };

  const yipee = addCreature();
  surprise.appendChild(yipee);

  function toggleYippee() {
    const ys = yipee.style.display;
    yipee.style.display = (ys === 'block') ? 'none' : 'block';
  };

  button.addEventListener('click', toggleYippee);
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
  const song = document.getElementById('song');

  try {
    fetch(url)
    .then((response) => { return response.json()})
    .then((json) => { song.innerHTML = json['track']['name'] + ' - ' + json['track']['artist']  ['#text']; });
  } catch {
    song.innerText = "couldn't fetch track 😥";
  };

  // scrolling animation toggle
  const jstoggle = document.getElementById('js-toggle');
  
  function pauseAnimation() {
    const animation = document.querySelector('[data-animation]');
    let state = animation.style.animationPlayState || 'running';
    animation.style.animationPlayState = (state === 'running') ? 'paused' : 'running';
  };
  
  jstoggle.addEventListener('click', pauseAnimation);
};

{ // status.cafe
  const statusContent = document.getElementById("statuscafe-content");
  const statusUser = document.getElementById("statuscafe-username");
  try {
    fetch("https://status.cafe/users/jasm1nii/status.json")
      .then( r => r.json() )
      .then( r => {
        statusUser.innerHTML = '<a href="https://status.cafe/users/jasm1nii" rel="external me" target="_blank">' + r.author + '</a> ' + r.face + ' ' + r.timeAgo;
        statusContent.innerHTML = r.content;
      });
  } catch {
    statusContent.innerHTML = "couldn't fetch status 🤐";
  };
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

    let html = `<span><a href='` + resourceRing_ringurl + `'><img alt='Badge: resourceRing webring' src='` + resourceRing_badgeurl + `' width='88' height='31' loading='lazy'/></a></span>`;
    html += `<span><a href='` + resourceRing_members[beforeID] + `'><img alt='Previous' src='` + resourceRing_prevurl + `' height='31' width='22' loading='lazy'/></a>`;
    html += `<a href='` + resourceRing_members[randomID] + `'><img alt='Random' src='` + resourceRing_randomurl + `' height='31' width='44' loading='lazy'/></a>`;
    html += `<a href='` + resourceRing_members[afterID] + `'><img alt='Next' src='` + resourceRing_nexturl + `' height='31' width='22' loading='lazy'/></a></span>`;
    
    displayElement.innerHTML = html;
      
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

            let prevSiteIndex = (matchedSiteIndex - 1 == - 1) ? sites.length - 1 : matchedSiteIndex - 1;
            let nextSiteIndex = (matchedSiteIndex + 1 > sites.length - 1) ? 0 : matchedSiteIndex + 1;
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
};