// get styles
import "./inc/styling/_autoload.scss";
import "./scss/styles.scss";

// get scripts
import './ts/scripts.ts';

// @ts-ignore
const tsModules = import.meta.importGlob('./**/*.export.ts');
// @ts-ignore
const scssModules = import.meta.importGlob('./**/*.export.scss');