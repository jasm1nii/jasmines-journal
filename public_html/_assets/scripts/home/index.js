{ // push pin
  const notice = document.getElementById("notice");

  document.getElementById("pin").addEventListener("click", () => {
      if (notice.style.display === "none") {
        notice.style.display = "block";
      } else {
        notice.style.display = "none";
      };
    }
  );

  // sticky note contents
  
  notice.innerHTML = `
    <p><b><i>have you seen THEM?!</i></b></p>
    <figure tabindex="0">
      <img src="/_assets/media/main/pluto-pretzel_compressed.webp" width="122" height="106" id="pluto" alt="my cat pluto"/>
      <figcaption>
        pluto (she/her)
      </figcaption>
    </figure>
    <figure tabindex="0">
      <img src="/_assets/media/main/pluto-pretzel_compressed.webp" width="122" height="106" id="pretzel" alt="my cat pretzel"/>
      <figcaption>
        pretzel (he/him)
      </figcaption>
    </figure>
    <p><b>now you have!</b></p>
    <hr/>
    <p><small>click the pushpin to hide this notice.</small></p>`;

  const x = notice.style;

        x.border = "1px solid goldenrod";
        x.boxShadow = "5px 5px 5px rgba(128, 128, 128, 0.1)";
        x.textAlign = "center";
        x.margin = "10% 15% 0 0";
        x.maxWidth = "200px";
        x.maxHeight = "300px";
        x.overflowY = "auto";
        x.scrollbarWidth = "thin";
        x.scrollbarColor = "rgba(184, 145, 94, 0.692) rgba(250, 240, 230, 0.192)";
        x.color = "var(--sticky-note-font)";
        x.backgroundColor = "var(--sticky-note-bg)";

  notice.querySelector('p').style.padding = "0px 1em";

  const f = notice.querySelectorAll('figure');
        f.forEach (el => { el.style.margin = "auto";});

  const fc = notice.querySelectorAll('figcaption');
        fc.forEach (el => { el.style.margin = "1em"; });

  const cats = notice.querySelectorAll('img');
        cats.forEach (el => {
          const pic = el.style;
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
          src:'/_assets/media/main/flower.svg',
          width:60,
          height:60,
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
    src:'/_assets/media/main/la-creatura.png',
    width:'290',
    height:'341',
    alt:'ASCII art of the autism creature',
    class:'u-featured',
    loading: 'lazy'
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
    } else {
      ys.display = "block";
      fs.filter = 'hue-rotate(45deg) brightness(80%) saturate(300%)';
      }
    }
  );
};

{ // clock
  function dateToText(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    // var seconds = date.getSeconds();
    if (minutes < 10) minutes = '0' + minutes;
    // if  (seconds < 10) seconds = '0'+seconds;
    if (hours < 10) hours = '0' + hours;
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
    var clockElements = document.getElementsByClassName('clock');
    window.arrClocks = [];
    window.arrOffsets = [];

    for (var i = 0; i < clockElements.length; i++) {
      var el = clockElements[i];
      var timezone = parseInt(el.getAttribute('timezone'));

      if (!isNaN(timezone)) {
        var tzDifference = timezone * 60 + (new Date()).getTimezoneOffset();
        var offset = tzDifference * 60 * 1000;

        window.arrClocks.push(el);
        window.arrOffsets.push(offset);
      };
    };

    updateClocks();
    setInterval(updateClocks, 1000);
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
    });
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
    var resourceRing_members = [
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
    var resourceRing_ringurl = "https://pixelsafari.neocities.org/webring/";
    var resourceRing_badgeurl = "/_assets/media/main/resourcering.png";
    var resourceRing_prevurl = "/_assets/media/main//resourceringprev.png";
    var resourceRing_nexturl = "/_assets/media/main/resourceringnext.png";
    var resourceRing_randomurl = "/_assets/media/main/resourceringrandom.png";

    var displayElement = document.getElementById("resourceRing"); 
    var currentLocation = window.location.href;
    var siteIndex = resourceRing_members.indexOf(currentLocation);

    var beforeID = (siteIndex == 0) ? (resourceRing_members.length - 1) : (siteIndex - 1);

    var afterID = (siteIndex == resourceRing_members.length - 1) ? 0 : (siteIndex + 1);

    var randomID = Math.floor(Math.random() * resourceRing_members.length);
    
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
            `);

          this.shadowRoot.adoptedStyleSheets.push(sheet);
      };
      // this calculates a random number
      getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
      };
    };
    // whatever 'customElement' you define MUST be unique
    // do not use the name 'webring-css' or you will conflict with other webrings
    window.customElements.define("ring-900", p1v1g6);
  };
  { // healing hospital
    // part 1 source: https://mizuki.world/healinghospital/onionring-variables.js
    var sites = [
      'https://mizuki.world',
      'https://free-butterfly.neocities.org/',
      'https://sleepy-sage.neocities.org/',
      'https://maaar.space/',
      'https://macaque.moe/',
      'https://sanguineroyal.com/',
      'https://strawberry-gashes.neocities.org',
      'https://jasm1nii.xyz/',
      'https://tsuinosora.neocities.org/',
      ];
      var ringName = 'Healing Hospital Webring';
      var ringID = 'healinghospital';

    // part 2 source: https://mizuki.world/healinghospital/onionring-widget.js
    var tag = document.getElementById('healinghospital');
    thisSite = window.location.href;
    thisIndex = null;

    for (i = 0; i < sites.length; i++) {
      if (thisSite.startsWith(sites[i])) {
      thisIndex = i;
      break;
      };
    };

    var previousIndex = (thisIndex-1 < 0) ? sites.length-1 : thisIndex-1;
    var nextIndex = (thisIndex+1 >= sites.length) ? 0 : thisIndex+1;

    tag.insertAdjacentHTML('afterbegin', `
      <a href="${sites[previousIndex]}" rel="external"><img src="/_assets/media/main/healing-hospital-left.png" width="40" height="40" alt="healing hospital webring: previous site" loading="lazy"/></a>
      <a href="https://mizuki.world/healinghospital" rel="external"><img src="/_assets/media/main/healing-hospital.png" width="80" height="40" alt="healing hospital webring: index" loading="lazy"/></a>
      <a href="${sites[nextIndex]}" rel="external"><img src="/_assets/media/main/healing-hospital-right.png" width="40" height="40" alt="healing hospital webing: next site" loading="lazy"/></a>
    `);
  };
  { // autiring
    // part 1 source: https://macaque.moe/autiring/onionring-variables.js
    var sites = [
      'https://macaque.moe/',
      'https://sunwukong.neocities.org/',
      'https://feelingmachine.moe/',
      'https://laikacore.neocities.org/',
      'https://diluculo.neocities.org/',
      'https://controlcoreangel.neocities.org/',
      'https://patchworkofshadows.neocities.org/',
      'https://monkiebusiness.neocities.org/',
      'https://chipsfunfun.neocities.org/',
      'https://vhswarehouse.neocities.org/',
      'https://fluffylor.neocities.org/',
      'https://suntooth.online/',
      'https://sunnyday.neocities.org/',
      'https://mothcore.neocities.org/',
      'https://faeriebottled97.neocities.org/',
      'https://onlywonder.net/',
      'https://choiyoona.neocities.org/',
      'https://braigwen.neocities.org/',
      'https://pathwbeast.neocities.org/',
      'https://themby.neocities.org/',
      'https://servetier.neocities.org/',
      'https://killing-machine.neocities.org/',
      'https://korekiyovillage.neocities.org/',
      'https://the-bat-house.neocities.org/',
      'https://axelcentral.neocities.org/',
      'https://infamousblackcoat.neocities.org/',
      'https://superkirbylover.neocities.org/',
      'https://foreverliketh.is/',
      'https://mirrorteru.neocities.org/',
      'https://rayofhope.neocities.org/',
      'https://kyomakus.online/',
      'https://thechillzone.neocities.org/',
      'https://ghostingpen.neocities.org/',
      'https://falconiforme.neocities.org/',
      'https://neonriser.neocities.org/',
      'https://uhf-channel-27.neocities.org/',
      'https://arsenicteddy.neocities.org/',
      'https://sillyalien.neocities.org/',
      'https://followthewhiterabbit.neocities.org/',
      'https://portfiend.quest/',
      'https://cadeion.neocities.org/',
      'https://mizuki.world/',
      'https://sunny-cities.neocities.org/',
      'https://retrovampz.neocities.org/',
      'https://nonkiru.art/',
      'https://martin-is-a-real-person.neocities.org/',
      'https://xp-zone.neocities.org/',
      'https://radiationcat.neocities.org/',
      'https://worldsaddress.neocities.org/',
      'https://timephone.neocities.org/',
      'https://transbro.neocities.org/',
      'https://strawberry-gashes.neocities.org/',
      'https://gensoukai.net/',
      'https://waxynwane.neocities.org/',
      'https://mizunotic.neocities.org/',
      'https://melankorin.net/',
      'https://grulovia.neocities.org/',
      'https://milkywaytrain.neocities.org/',
      'https://cvnnbl.neocities.org/',
      'https://wappydog.neocities.org/',
      'https://cinders-stuff.neocities.org/',
      'https://juxtajuno.neocities.org/',
      'https://dicey.neocities.org/',
      'https://www.royalchapelarchive.net/',
      'https://confettiguts.neocities.org/',
      'https://mikufan3939.neocities.org/',
      'https://www.autisticasfxxk.com/',
      'https://milestailsprower.neocities.org/',
      'https://qso404.neocities.org/',
      'https://thecatingrey.neocities.org/',
      'https://daedrms.neocities.org/',
      'https://punkwasp.leprd.space/',
      'https://frequency-modulator.neocities.org/',
      'https://nimravidae.neocities.org/',
      'https://pokeau.com/',
      'https://magneticdogz.neocities.org/',
      'https://shinyexe.neocities.org/',
      'https://debtdeath.neocities.org/',
      'https://item64.neocities.org/',
      'https://vurren.neocities.org/',
      'https://pinkvampyr.leprd.space/',
      'https://1dkreally.neocities.org/',
      'https://nickolox.neocities.org/',
      'https://emeowly.gay/',
      'https://zombiigutz.neocities.org/',
      'https://jasm1nii.xyz/',
      'https://jubiland.neocities.org/',
      'https://wolfsite.neocities.org/',
      'https://butt0n-z.neocities.org/',
      'https://grlrot.neocities.org/',
      'https://candypop-garden.neocities.org/',
      'https://natmsearch.neocities.org/',
      'https://foofoai.neocities.org/',
      'https://wyrm.quest/',
      'https://notprincehamlet.neocities.org/',
      'https://crisis.city/',
      'https://freekittie.neocities.org/',
      'https://jaybirds.neocities.org/',
      'https://dhampirave.neocities.org/',
      'https://keplari.neocities.org/',
      'https://itpuddle.com/',
      'https://roselle.neocities.org/',
      'https://pizzacatdelights.neocities.org/',
      'https://tsumugsfish.neocities.org/',
      'https://bigtub.neocities.org/',
      'https://owlsroost.xyz/',
      'https://neonnights.neocities.org/',
      'https://candykiller.neocities.org/',
      'https://tsuinosora.neocities.org/',
      'https://interstellar-shipwreck.neocities.org/',
      'https://foggybear42.neocities.org/',
      'https://crystepsi.com/',
      'https://ironminer888.neocities.org/',
      'https://ctrl64.neocities.org/',
      'https://f3r4l-c4tg1rl.neocities.org/',
    ];
    var ringName = 'Autists Online';
    var ringID = 'autiring';
      
    // part 2 source: https://macaque.moe/autiring/onionring-widget.js
    var tag = document.getElementById('autiring');
    var thisSite = window.location.href;
    var thisIndex = null;

    for (i = 0; i < sites.length; i++) {
      if (thisSite.startsWith(sites[i])) {
        thisIndex = i;
        break;
      };
    };

    var previousIndex = (thisIndex-1 < 0) ? sites.length-1 : thisIndex-1;
    var nextIndex = (thisIndex+1 >= sites.length) ? 0 : thisIndex+1;

    tag.insertAdjacentHTML('afterbegin', `
      <a href='${sites[previousIndex]}' rel="external"><img src="/_assets/media/main/autiring-left.png" width="32" height="15" alt="autists online webring: previous site" loading="lazy"/></a><a href="https://macaque.moe/autiring/index.html" rel="external"><img src="/_assets/media/main/autiring.png" width="96" height="15" alt="autists online webring: index" loading="lazy"/></a><a href='${sites[nextIndex]}' rel="external" title="next site"><img src="/_assets/media/main/autiring-right.png" width="32" height="15" alt="autists online webring: next site" loading="lazy"/></a>
    `);
  };
};