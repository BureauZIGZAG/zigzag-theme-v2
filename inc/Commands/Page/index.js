const prompts = require('prompts');
const {PageGenerator} = require("./PageGenerator");

(async() =>  {
    const response = await prompts([
        {
            type: 'text',
            name: 'pageName',
            message: 'Page name:',
        }
    ]);

    const pageName = response.pageName;
    const generator = new PageGenerator(pageName);
})();