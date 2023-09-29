// this references the file that holds the webring data
const g1v5x3 = `https://xandra.cc/safonts/webring.json`;
const w9g5p9 = document.createElement("template");

// this is our webring styling
w9g5p9.innerHTML = `
<style>
.g1v5x3-webring {
  background-image:var(--g1v5x3-background-image);
  background-color:var(--g1v5x3-background-color);
  border:var(--g1v5x3-border);
  padding:var(--g1v5x3-padding); 
  max-width:var(--g1v5x3-width);
  height:var(--g1v5x3-height);
  border-radius:var(--g1v5x3-border-radius);
}
.g1v5x3-myUniqueClass .title {
  font-family:var(--g1v5x3-title-font);
  font-size:var(--g1v5x3-title-size);
  line-height:var(--g1v5x3-title-height);
  letter-spacing:var(--g1v5x3-title-spacing);
  color:var(--g1v5x3-title-color);
  margin:var(--g1v5x3-title-margin);
  text-align:var(--g1v5x3-title-align);
  font-weight:var(--g1v5x3-title-weight);
}
.g1v5x3-myUniqueClass {
  font-family:var(--g1v5x3-text-family);
  font-size:var(--g1v5x3-text-size);
  line-height:var(--g1v5x3-text-height);
  color:var(--g1v5x3-text-color);
  text-align:var(--g1v5x3-text-align);
  letter-spacing:var(--g1v5x3-text-spacing);
}
.g1v5x3-myUniqueClass a {
color:var(--g1v5x3-link-color);
text-decoration:var(--g1v5x3-link-decoration);
font-size:var(--g1v5x3-link-size);
}
.g1v5x3-myUniqueClass p {
margin:var(--g1v5x3-text-margin);
}
.icon {
  font-size: 100px;
}
</style>

<span class="g1v5x3-webring">
  <div class="g1v5x3-myUniqueClass"></div>
</span>`;

// not really sure about this stuff, but don't delete it!
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
        
        const matchedSite = sites[matchedSiteIndex];

        let prevSiteIndex = matchedSiteIndex - 1;
        if (prevSiteIndex === -1) prevSiteIndex = sites.length - 1;

        let nextSiteIndex = matchedSiteIndex + 1;
        if (nextSiteIndex > sites.length - 1) nextSiteIndex = 0;

        const randomSiteIndex = this.getRandomInt(0, sites.length - 1);

        // In this variable, put the HTML that you want your webring "badge" to use.
        // keep the link 'href' values the same, but change the text!
        const cp = `
		    <p class="title">i'm a <strong>sa</strong><a href="https://xandra.cc/safonts/"><em>font</em></a><br></p>
            <p class="nav">
            <a href="${sites[prevSiteIndex].url}">&lt;&lt;</a>
            <a href="${sites[randomSiteIndex].url}">???</a>
            <a href="https://xandra.cc/safonts/members.html">...</a>
            <a href="${sites[nextSiteIndex].url}">&gt;&gt;</a>
          </p>
        `;

        this.shadowRoot
          .querySelector(".g1v5x3-myUniqueClass")
          .insertAdjacentHTML("afterbegin", cp);
      });
  }

  // this calculates a random number
  getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }
}

var rootVars = `:root {
  /* background! */
  --g1v5x3-background-color: transparent;
    /* sizing */
  --g1v5x3-width:150px;
  --g1v5x3-padding: 1rem;
  
  /* title! */
  --g1v5x3-title-font:'Arial';
  --g1v5x3-title-color: var(--font-color-light);
  --g1v5x3-title-size:16px;
  --g1v5x3-title-align:center;
  /* line height & letter spacing */
  --g1v5x3-title-spacing:2px;
  --g1v5x3-title-weight:bold;

  /* text! */
  --g1v5x3-text-family:sans-serif;
  --g1v5x3-text-color:#FFF;
  --g1v5x3-text-size:12pt;
  --g1v5x3-text-align:center;
  --g1v5x3-text-spacing:1px;
  --g1v5x3-text-height:1em;

  /* links! */
  --g1v5x3-link-family:sans-serif;
  --g1v5x3-link-color:#2ECFCA;
  --g1v5x3-link-decoration:none;
  --g1v5x3-link-weight:bold;
  --g1v5x3-link-size:12pt;
}`

window.onload = function() {
var p = document.getElementsByTagName("body")[0];
var style = document.createElement('style');
var css = document.createTextNode(rootVars);
style.appendChild(css);
p.appendChild(style);
}

// whatever 'customElement' you define MUST be unique
// do not use the name 'webring-css' or you will conflict with other webrings
window.customElements.define("ring-900", p1v1g6);