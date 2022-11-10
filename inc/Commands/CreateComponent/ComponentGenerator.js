const fs = require('fs-extra');
const path = require('path');

class ComponentGenerator {
    constructor(componentName, options = {}) {
        this.options = {
            scss: false,
            ts: false,
            ...options,
        }
        this.componentName = this.formatComponentName(componentName);
        this.componentPath = path.join(__dirname, `../../../Components/${this.componentName}`);
        this.generate();
    }

    generate() {
        // check if component already exists
        if (this.componentExists()) {
            console.log(`Component ${this.componentName} already exists`);
            return;
        }
        console.log(`Generating component ${this.componentName}...`);
        console.log(`Component path: ${this.componentPath}`);
        // create component directory
        fs.mkdirsSync(this.componentPath);
        // create component files
        if (this.options.scss) {
            this.generateScss();
        }
        if (this.options.ts) {
            this.generateTs();
        }
        this.generateTemplate();
        this.generateComponent();

        console.log(`Component ${this.componentName} generated`);
    }

    formatComponentName(componentName) {
        // split by non-alphanumeric characters
        const words = componentName.split(/[^a-zA-Z0-9]/);
        // capitalize first letter of each word
        const capitalizedWords = words.map(word => word.charAt(0).toUpperCase() + word.slice(1));
        // make sure last word is Component
        const lastWord = capitalizedWords[capitalizedWords.length - 1];
        if (lastWord !== 'Component') {
            capitalizedWords.push('Component');
        }
        // join words
        return capitalizedWords.join('');
    }

    componentExists() {
        return fs.pathExistsSync(this.componentPath);
    }

    generateScss() {
        const scssPath = path.join(this.componentPath, `_${this.componentName}.export.scss`);
        const content = this.getFilledTemplate('stylesheet');
        fs.outputFileSync(scssPath, content);
    }

    generateTs() {
        const tsPath = path.join(this.componentPath, `${this.componentName}.export.ts`);
        const content = this.getFilledTemplate('script');
        fs.outputFileSync(tsPath, content);
    }

    generateTemplate() {
        const templatePath = path.join(this.componentPath, `${this.componentName}.template.php`);
        const content = this.getFilledTemplate('template');
        fs.outputFileSync(templatePath, content);
    }

    generateComponent() {
        const componentPath = path.join(this.componentPath, `${this.componentName}.php`);
        console.log(`Generating component file: ${componentPath}`);
        const content = this.getFilledTemplate('component');
        fs.outputFileSync(componentPath, content);
    }

    getFilledTemplate(name, data={}) {
        data = {
            componentName: this.componentName,
            ...data,
        }
        const content = path.resolve(__dirname, 'templates/' + name + '.txt');
        let template = fs.readFileSync(content, 'utf8');
        for (const key in data) {
            template = template.replace(new RegExp(`{${key}}`, 'g'), data[key]);
        }
        return template;
    }
}

module.exports = {
    ComponentGenerator
}