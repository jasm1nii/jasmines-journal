document.getElementById("loader").innerHTML = `
<div>
  <span>loading contents...</span>
  <br>
  <button onclick="closeLoader()">
    skip rendering
  </button>
</div>
<style>
#loader {
  text-align: center;
  position: sticky;
  z-index: 9;
  margin-top: auto;
  width: 100%;
  height: 100vh;
  font-size: 2em;
  letter-spacing: .1em;
  color: white;
  background-color: rgba(83, 68, 117, 1);
  top: 0;
  overflow-x: hidden;
  animation: none;
}
#loader button {
  font-family: var(--font-3);
  font-size: .6em;
  margin: 2em;
  padding: .5em;
  background: transparent;
  color: inherit;
  border: none;
  border-bottom: 1px solid white;
  opacity: 0;
  animation: fadeInPage .5s forwards;
  animation-delay: .25s;
}
#loader div {
  margin-top: 40vh;
}
#loader span:last-of-type {
  letter-spacing: 0;
}
</style>`;
var loader = document.getElementById("loader");
function closeLoader() {
  window.stop();
  loader.style.display = "none";
}
window.addEventListener("load", function () {
  loader.style.display = "none";});



