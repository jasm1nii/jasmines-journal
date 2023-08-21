document.getElementById("loader").innerHTML = `
<div>
  <span>loading contents...</span>
</div>
<style>
#loader {
  text-align: center;
  position: sticky;
  z-index: 9;
  margin-top: auto;
  width: 100%;
  height: 100vh;
  font-size: 1.5em;
  letter-spacing: .1em;
  color: white;
  background-color: rgba(83, 68, 117, 1);
  top: 0;
  overflow-x: hidden;
}
#loader div {
  margin-top: 40vh;
}
#loader span:last-of-type {
  letter-spacing: 0;
}
</style>`;

var loader = document.getElementById("loader");
window.addEventListener("load", function () {
  loader.style.display = "none";
});


