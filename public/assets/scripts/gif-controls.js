document.addEventListener("DOMContentLoaded", function (event) {
    const e = new Freezeframe();
    document.getElementById("play-gif").addEventListener("click", function () { e.start() });
    document.getElementById("stop-gif").addEventListener("click", function () { e.stop() });
});

document.getElementById("gifControls").innerHTML =`
<button id="play-gif">Play GIFs</button>
<button id="stop-gif">Stop GIFs</button>
<style>
@container (max-width: 210px) {
    #play-gif {
        margin-bottom: 1em;
    }
}
</style>
`;