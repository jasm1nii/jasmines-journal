// jasm1nii.xyz | check out the source code at github.com/jasm1nii/jasmines-journal

{ 
    const lightbox = document.querySelector('script[data-lightbox]');

    const targetClass = lightbox.dataset.targetClass;
    const targetElement = document.querySelectorAll(`.${targetClass} img`);

    for (const image of targetElement) {

        const originalParent = image.parentElement;
        const previewContainer = document.createElement('div');

        originalParent.insertAdjacentElement('beforeend', previewContainer);
        previewContainer.style.position = 'relative';
        previewContainer.replaceChildren(image);

        const overlay = createOverlay(image);

        document.addEventListener('keydown', (event) => {
            if (event.key == 'Tab') {
                previewContainer.append(overlay);
            }
        });

        previewContainer.addEventListener('mouseover', () => {
            previewContainer.append(overlay);
        });
        previewContainer.addEventListener('mouseleave', () => {
            overlay.remove();
        });

        previewContainer.addEventListener('touchstart', () => {
            previewContainer.append(overlay);
        });
        previewContainer.addEventListener('touchcancel', () => {
            overlay.remove();
        });

    }

    function createOverlay(image) {

        const toggle = document.createElement('button');
        toggle.classList.add('lightbox-toggle');
        
        toggle.style.position = 'absolute';
        toggle.style.bottom = 0;
        toggle.style.right = 0;
        toggle.style.marginBottom = '25px';
        toggle.style.marginRight = '25px';
        toggle.style.padding = '0 .5em';
        toggle.style.zIndex = 99;

        const toggleText = document.createTextNode('enlarge');
        toggle.appendChild(toggleText);

        toggle.addEventListener('click', () => {
            document.body.style.overflow = 'hidden';
            displayFull(image);
        });

        return toggle;

    }

    function displayFull(image) {

        const lightboxElem = document.createElement('div');

        document.body.insertAdjacentElement('afterbegin', lightboxElem);

        lightboxElem.style.position = 'absolute';
        lightboxElem.style.zIndex = '100';
        lightboxElem.classList.add('lightbox');

        const lightboxChild = document.createElement('div');
        lightboxElem.appendChild(lightboxChild);
        
        lightboxChild.classList.add('lightbox-inset');

        lightboxChild.style.position = 'fixed';
        lightboxChild.style.top = 0;
        lightboxChild.style.left = 0;
        lightboxChild.style.width = '100vw';
        lightboxChild.style.height = '100vh';
        lightboxChild.style.backgroundColor = 'rgba(0,0,0,.75)';
        lightboxChild.style.overflow = 'auto';

        const fullImage = image.cloneNode();
        lightboxChild.appendChild(fullImage);

        fullImage.classList.add('lightbox-img');

        fullImage.style.maxWidth = '100vw';
        fullImage.style.maxHeight = '100vh';
        fullImage.style.display = 'block';
        fullImage.style.margin = 'auto';

        if (window.innerWidth < 768) {
            fullImage.style.marginTop = '10vh';
        } else {
            fullImage.style.marginTop = 0;
        }

        const closeBtn = document.createElement('button');

        closeBtn.classList.add('lightbox-close');

        closeBtn.style.position = 'fixed';
        closeBtn.style.top = '5vh';
        closeBtn.style.left = '5vw';
        closeBtn.style.padding = '.5em';

        lightboxChild.appendChild(closeBtn);

        const closeTxt = document.createTextNode('close');
        closeBtn.appendChild(closeTxt);

        closeBtn.focus();

        function closeLightbox() {
            document.body.style.overflow = 'auto';
            lightboxElem.remove();
        }

        closeBtn.addEventListener('click', () => {
            closeLightbox();
        });

        document.addEventListener('keydown', (event) => {
            if (event.key == 'Escape') {
                closeLightbox();
            }
        });

        lightboxChild.appendChild(addZoomControls());

    }

    function addZoomControls() {

        const zoomControls = document.createElement('menu');
        zoomControls.classList.add('lightbox-zoom-controls');

        zoomControls.style.position = 'fixed';
        zoomControls.style.bottom = '5vh';
        zoomControls.style.left = '5vw';
        zoomControls.style.paddingLeft = 0;
        
        zoomControls.appendChild(addZoomOption('zoom in'));
        zoomControls.appendChild(addZoomOption('reset'));
        zoomControls.appendChild(addZoomOption('zoom out'));

        zoomControls.style.display = 'flex';
        zoomControls.style.flexDirection = 'column';
        zoomControls.style.rowGap = '1em';

        return zoomControls;

    }

    function addZoomOption(option) {

        const zoomLi = document.createElement('li');
        zoomLi.style.display = 'block';

        const zoomBtn = document.createElement('button');
        zoomBtn.style.padding = '.5em';
        zoomLi.appendChild(zoomBtn);

        let zoomTxt = document.createTextNode(option);
        zoomBtn.appendChild(zoomTxt);
        zoomBtn.style.width = '100%';

        let zoomClass = option.replace(/\s/g , "-");
        zoomBtn.classList.add(`lightbox-${zoomClass}`);

        zoomBtn.addEventListener('click', () => zoomImage(option));

        return zoomLi;

    }

    function zoomImage(option) {

        const img = document.getElementsByClassName('lightbox-img')[0];

        if (option == 'zoom in') {

            img.style.width = `${img.clientWidth + 100}px`;
            img.style.maxWidth = 'none';
            img.style.maxHeight = 'none';

        } else if (option == 'zoom out') {

            let marginSize;

            if (window.innerWidth < 768) {
                marginSize = 11 * (window.innerWidth / img.clientWidth);
            } else if (window.innerWidth < 1100) {
                marginSize = 7 * (window.innerWidth / img.clientWidth);
            } else {
                marginSize = 3 * (window.innerWidth / img.clientWidth);
            }

            if (marginSize < 40) {
                img.style.marginTop = marginSize + 'vh';
            }

            img.style.width = `${img.clientWidth - (img.clientWidth / 10)}px`;

        } else if (option == 'reset') {

            if (window.innerWidth < 768) {
                img.style.marginTop = '10vh';
            } else {
                img.style.marginTop = 0;
            }

            img.style.width = 'initial';
            img.style.maxWidth = '100vw';
            img.style.maxHeight = '100vh';

        }
        
    }

};