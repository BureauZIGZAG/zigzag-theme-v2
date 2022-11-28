import {defineConfig} from 'vite'
import liveReload from 'vite-plugin-live-reload'
import sassGlobImports from "vite-plugin-sass-glob-import";
import GlobPlugin from 'vite-plugin-glob';

const {resolve} = require('path');

function is_development() {
    return process.env.NODE_ENV === 'development';
}

function is_production() {
    return !is_development();
}

export default defineConfig({
    plugins: [
        sassGlobImports(),
        GlobPlugin(),
        liveReload(__dirname + '/**/*.php')
    ],
    root: '',
    base: '/dist/',

    build: {
        outDir: resolve(__dirname, './dist'),
        emptyOutDir: true,
        cssCodeSplit: true,
        sourcemap: is_development(),

        // emit manifest so PHP can find the hashed files
        manifest: true,

        // esbuild target
        target: 'es2018',

        // our entry
        rollupOptions: {
            input: {
                main: resolve(__dirname + '/inc/scripts/theme.ts'),
            },

            output: {
                assetFileNames: (info) => {
                    if(info.name.includes('export')) {
                        const name = info.name.split('/').pop();
                        const prettyName = name.replace(/\.export\.\w+$/, '');
                        const withoutUnderScore = prettyName.replace('_', '');
                        return `exports/${withoutUnderScore}.[ext]`;
                    }

                    return 'assets/[name].[ext]';
                },
            }
        },
        minify: is_production() ? 'terser' : 'esbuild',
        write: true
    },
    resolve: {
        alias: {
            '@': resolve(__dirname, './'),
            '@assets': resolve(__dirname, './assets'),
            '@scripts': resolve(__dirname, './inc/scripts'),
            '@styling': resolve(__dirname, './inc/styling'),
            'utils': resolve(__dirname, './inc/styling/utils'),
        }
    }
});

