{
    var page = document.querySelector(".board");
    var loader = document.querySelector(".loader");
    
    function closeLoader() {
        loader.style.display = 'none';
        loader.remove();
        page.style.animation = 'fadeInSlide .5s ease-in forwards';
    };

    var loadExit = setTimeout(showExit, 3000);

    function showExit() {
        var exitButton = document.createElement("button");
        var exitText = document.createTextNode("show me whatever");
        loader.appendChild(exitButton);
        exitButton.setAttribute('type', 'button');
        exitButton.appendChild(exitText);
        exitButton.addEventListener("click", closeLoader);
    };

    var loaderLoop = setInterval(incrLoader, 500);
    var loaderText = loader.querySelector("p");

    var randArr = ["getting there", "any time now", "still brewing", "on the way", "a little longer", "🤔", "🙄", "💭", "🤠", "👀❔", "🦆"];
    var starCount = 0;

    function incrLoader() {

        var randText = Math.floor(Math.random() * randArr.length);

        if (document.readyState !== 'complete') {

            if (starCount < 3) {
                loaderText.insertAdjacentHTML('beforeend', `<span aria-hidden="true">&nbsp;✦</span>`);
                starCount++;
            } else {
                loaderText.innerHTML = randArr[randText];
                starCount = 0;
            };

        } else {
            loaderText.innerHTML = `<span aria-hidden='true'>\\(^o^)/</span>`;
            return;
        };
        
    };

    window.addEventListener("load", ()=> {
        setTimeout(closeLoader, 1000);
    });
    
};