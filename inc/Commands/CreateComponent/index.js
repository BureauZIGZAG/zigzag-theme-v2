const prompts = require('prompts');
const {ComponentGenerator} = require("./ComponentGenerator");

(async() =>  {
    const response = await prompts([
        {
            type: 'text',
            name: 'componentName',
            message: 'Component name:',
        },
        {
            type: 'multiselect',
            name: 'choices',
            message: 'Configure component:',
            choices: [
                { title: 'SCSS', value: 'scss', selected: true },
                { title: 'TS', value: 'ts' },
            ],
        }
    ]);

    const componentName = response.componentName;
    const choices = response.choices;
    const scss = choices.includes('scss');
    const ts = choices.includes('ts');

    const generator = new ComponentGenerator(componentName, {
        scss: scss,
        ts: ts,
    });
})();