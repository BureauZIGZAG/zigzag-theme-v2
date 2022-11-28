// generate stylesheets
import "./exports";
// import theme styling
import "@styling/theme.scss";
// import "./dependencies/autoload";
import "@/ts/main.ts";

window.addEventListener('load', () => {
    import('./after-load/load').then();
});
