import {onLoad} from "./onLoad";


onLoad(() => {
    const body = document.body;
    const attribute = 'data-has-scrolled';

    const hasScrolled = () => {
        if (window.scrollY > 0) {
            body.setAttribute(attribute, 'true');
        } else {
            body.setAttribute(attribute, 'false');
        }
    }

    window.addEventListener('scroll', hasScrolled);
});