{
    document.addEventListener("DOMContentLoaded", () => {
        var e = new Freezeframe();
        var playButton =  document.getElementById("play-gif");
        var pauseButton = document.getElementById("stop-gif");

            playButton.addEventListener("click", function () { e.start() });
            pauseButton.addEventListener("click", function () { e.stop() });

        var toggleBox = document.querySelector(".warning");
            toggleBox.style.display = 'block';

        var buttons = document.querySelectorAll(".buttons");
        for (var section of buttons) {
            section.style.display = 'block';
        };
    });
};