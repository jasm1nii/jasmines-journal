document.getElementById("loader").innerHTML = `loading contents...
<style>
#loader {
  text-align: center;
  margin: auto;
  position: absolute;
  width: 100%;
  top: 50%;
  font-size: 1.5em;
  letter-spacing: .1em;
  background: thistle;
  color: indigo;
}
</style>`;

var loader = document.getElementById("loader");
window.addEventListener("load", function () {
  loader.style.display = "none";
});

//Fade out, optional
var s = document.getElementById("loader").style;
s.opacity = 1;
(function fade() {
  (s.opacity -= 0.1) < 0 ? (s.display = "none") : setTimeout(fade, 40);
})();