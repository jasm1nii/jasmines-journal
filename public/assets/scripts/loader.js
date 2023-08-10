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

document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
        document.querySelector("body").style.visibility = "hidden";
        document.querySelector("#loader").style.visibility = "visible";
    } else {
        document.querySelector("body").style.visibility = "visible";
        document.querySelector("#loader").style.visibility = "hidden";
    }
};