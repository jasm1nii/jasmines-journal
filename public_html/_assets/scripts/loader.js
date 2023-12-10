{
    const loader = document.querySelector(".loader");
    const page = loader.nextElementSibling;
    
    const loaderLoop = setInterval(incrLoader, 200);

    let dotCount = 0;

    function incrLoader() {
        
        const loaderEl = loader.querySelector("p");
        const loadingArr = ["getting there", "any time now", "still brewing", "on the way", "a little longer", "🤔", "☕", "💭", "🤠", "👀❔", "🦆"];
        const finArr = ["\\(^o^)/", "ʚ(｡˃ ᵕ ˂ )ɞ", "ฅ^•ﻌ•^ฅ", "˗ˏˋ✩ˎˊ˗", "˖⁺‧₊˚ ♡ ˚₊‧⁺˖"];

        const dots = document.createElement('span');
        const dot = document.createTextNode(' ✦');
        dots.ariaHidden = true;
        dots.appendChild(dot);

        if (document.readyState !== 'complete') {

            if (dotCount < 3) {

                loaderEl.appendChild(dots);
                dotCount++;

            } else {

                let loadingMsgKey = Math.floor(Math.random() * loadingArr.length);
                loaderEl.innerHTML = loadingArr[loadingMsgKey];
                dotCount = 0;

            };

        } else {

            const fin = document.createElement('span');
            let finKey = Math.floor(Math.random() * finArr.length);
            let finMsg = document.createTextNode(finArr[finKey]);
                fin.ariaHidden = true;
                fin.appendChild(finMsg);

            if (loaderEl !== null) { loaderEl.replaceWith(fin); };
            return;

        };

    };

    class ExitButton {
        constructor() {
            this.button = document.createElement("button");
            this.text = document.createTextNode("show me whatever");
            this.button.setAttribute('type', 'button');
            this.button.appendChild(this.text);
            this.button.addEventListener('click', closeLoader);
            return this.button;
        };
    };

    class FinalAnimation {
        constructor() {
            this.keyframes = [
                { opacity: 0, transform: "translatey(-10px)" },
                { opacity: 1, transform: "translatey(0)" },
            ];
            this.timing = { duration: 500, iterations: 1, fill: "forwards" };
        }
    };

    const loadExit = setTimeout(() => { loader.appendChild(new ExitButton); }, 3000);

    // check this variable to prevent the animation from firing twice:
    let closeTriggered = false;

    function closeLoader() {
        closeTriggered = true;
        const animation = new FinalAnimation;

        loader.remove();
        page.animate(animation.keyframes, animation.timing);

        clearInterval(loaderLoop);
        clearTimeout(loadExit);

        return;
    };

    if (closeTriggered == false) {
        window.addEventListener("load", ()=> {
            setTimeout(closeLoader, 500);
        });
    };
};