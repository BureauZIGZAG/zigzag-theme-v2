import {onLoad} from "./onLoad";


onLoad(() => {
   const elements = document.querySelectorAll('[data-src]');
    elements.forEach((element) => {
        const src = element.getAttribute('data-src');
        element.setAttribute('src', src);
    });

    const scrollElements = document.querySelectorAll('[data-src-scroll]');
    window.addEventListener('scroll', () => {
        scrollElements.forEach((element) => {
            const src = element.getAttribute('data-src-scroll');
            const rect = element.getBoundingClientRect();
            if (rect.top < window.innerHeight) {
                element.setAttribute('src', src);
            }
        });
    });
});

onLoad(() => {
   const styleSheets = document.querySelectorAll('link[rel="defer-css"]');
    styleSheets.forEach((styleSheet) => {
       styleSheet.setAttribute('rel', 'stylesheet');
    });
});