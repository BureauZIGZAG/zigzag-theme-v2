const fs = require('fs-extra');
const path = require("path");

class PageGenerator {
    constructor(pageName) {
        this.pageName = this.formatPageName(pageName);
        this.pageNameRaw = pageName;
        this.basePath = path.join(__dirname, `../../../`);

        this.generateTemplate();
        this.generateStyleSheet();
    }

    formatPageName(pageName) {
        // split by non-alphanumeric characters
        const words = pageName.split(/[^a-zA-Z0-9]/);
        // lowercase all words
        const lowercaseWords = words.map(word => word.toLowerCase());
        // join words
        return lowercaseWords.join('-');
    }

    generateTemplate() {
        const templatePath = this.basePath + 'templates/template-' + this.pageName + '.php';
        const content = this.getFilledTemplate('template');
        fs.outputFileSync(templatePath, content);
    }

    getFilledTemplate(name, data={}) {
        data = {
            pageName: this.pageName,
            pageNameRaw: this.pageNameRaw,
            ...data,
        }
        const content = path.resolve(__dirname, 'templates/' + name + '.txt');
        let template = fs.readFileSync(content, 'utf8');
        for (const key in data) {
            template = template.replace(new RegExp(`{${key}}`, 'g'), data[key]);
        }
        return template;
    }

    generateStyleSheet() {
        const scssPath = `${this.basePath}scss/pages/_${this.pageName}.scss`;
        const content = this.getFilledTemplate('stylesheet');
        fs.outputFileSync(scssPath, content);
    }
}

module.exports = {PageGenerator};