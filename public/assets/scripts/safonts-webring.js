// this references the file that holds the webring data
const g1v5x3 = `https://xandra.cc/safonts/webring.json`;
const w9g5p9 = document.createElement("template");

// this is our webring styling
w9g5p9.innerHTML = `
<style>
.g1v5x3-myUniqueClass {
  font-family:var(--g1v5x3-text-family);
  font-size:var(--g1v5x3-text-size);
  color:var(--g1v5x3-text-color);
  text-align: center;
  margin-bottom: 1em;
}
.g1v5x3-myUniqueClass .title {
  font-size:var(--g1v5x3-title-size);
  line-height:var(--g1v5x3-title-height);
  letter-spacing:var(--g1v5x3-title-spacing);
  margin:var(--g1v5x3-title-margin);
  text-align:var(--g1v5x3-title-align);
  font-weight:var(--g1v5x3-title-weight);
}
.g1v5x3-myUniqueClass a {
  color:var(--g1v5x3-link-color);
  font-size:var(--g1v5x3-link-size);
}
</style>

<div class="g1v5x3-webring">
  <div class="g1v5x3-myUniqueClass"></div>
</div>`;

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
		    <p class="title">i'm a <strong>sa</strong><a href="https://xandra.cc/safonts/"><em>font</em></a></p>
          <span class="nav">
            <a href="${sites[prevSiteIndex].url}">&lt;&lt;</a>
            <a href="${sites[randomSiteIndex].url}">???</a>
            <a href="https://xandra.cc/safonts/members.html">...</a>
            <a href="${sites[nextSiteIndex].url}">&gt;&gt;</a>
          </span>
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

// whatever 'customElement' you define MUST be unique
// do not use the name 'webring-css' or you will conflict with other webrings
window.customElements.define("ring-900", p1v1g6);