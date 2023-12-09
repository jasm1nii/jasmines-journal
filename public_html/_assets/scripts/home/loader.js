{
    var page = document.querySelector(".board");
    var loader = document.querySelector(".loader");

    var loadExit = setTimeout(showExit, 3000);

    function showExit() {
        var exitButton = document.createElement("button");
        var exitText = document.createTextNode("show me whatever");
        loader.appendChild(exitButton);
        exitButton.setAttribute('type', 'button');
        exitButton.appendChild(exitText);
        exitButton.addEventListener("click", closeLoader);
    };

    var loaderLoop = setInterval(incrLoader, 250);
    var loaderText = loader.querySelector("p");

    var randArr = ["getting there", "any time now", "still brewing", "on the way", "a little longer", "🤔", "🙄", "💭", "🤠", "👀❔", "🦆"];
    var starCount = 0;

    function incrLoader() {
        var randText = Math.floor(Math.random() * randArr.length);
        var ellips = document.createElement('span');
        var star = document.createTextNode(' ✦');
            ellips.ariaHidden = true;
            ellips.appendChild(star);

        if (document.readyState !== 'complete') {

            if (starCount < 3) {
                loaderText.appendChild(ellips);
                starCount++;
            } else {
                loaderText.innerHTML = randArr[randText];
                starCount = 0;
            };

        } else {
            var fin = document.createElement('span');
            var finMsg = document.createTextNode('\\(^o^)/');
                fin.ariaHidden = true;
                fin.appendChild(finMsg);
            loaderText.replaceWith(fin);
            return;
        };
    };

    function closeLoader() {
        loader.style.display = 'none';
        loader.remove();
        page.style.animation = 'fadeInSlide .5s ease-in forwards';
    };

    window.addEventListener("load", ()=> {
        setTimeout(closeLoader, 500);
    });
    
};