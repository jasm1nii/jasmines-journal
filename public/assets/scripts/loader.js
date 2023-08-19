document.getElementById("loader").innerHTML = `loading contents...
<style>
#loader {
  text-align: center;
  position: sticky;
  margin-top: auto;
  width: 100%;
  height: 100vh;
  font-size: 1.5em;
  letter-spacing: .1em;
  line-height: 50vh;
  color: white;
  background-color: rgba(83, 68, 117, 1);
  top: 0;
  overflow-x: hidden;
}
</style>`;

var loader = document.getElementById("loader");
window.addEventListener("load", function () {
  loader.style.display = "none";
});


