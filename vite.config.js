
import { defineConfig } from 'vite'
import liveReload from 'vite-plugin-live-reload'
const { resolve } = require('path')
const fs = require('fs')
import sassGlobImports from 'vite-plugin-sass-glob-import';
import GlobPlugin from 'vite-plugin-glob';


// https://vitejs.dev/config
export default defineConfig({

  plugins: [
      sassGlobImports(),
    GlobPlugin(),
    liveReload(__dirname+'/**/*.php')
  ],

  // config
  root: '',
  base: process.env.NODE_ENV === 'development'
    ? '/'
    : '/dist/',

  build: {
    // output dir for production build
    outDir: resolve(__dirname, './dist'),
    emptyOutDir: true,

    // emit manifest so PHP can find the hashed files
    manifest: true,

    // esbuild target
    target: 'es2018',

    // our entry
    rollupOptions: {
      input: {
        main: resolve( __dirname + '/main.ts')
      },

      output: {
        assetFileNames: (file) => {
            if(file.name.includes('.export')) {
              let name = file.name.replace('.export', '');
              const extension = file.name.split('.').pop();

              name = name.split('/');
              name = name[name.length - 1];

              name = name.replace('_', '');

              return `exports/${extension}/${name}`;
            }

            return 'assets/[name][extname]'
        },

        chunkFileNames: (file) => {
            if(file.name.includes('.export')) {
                let name = file.name.replace('.export', '');
                const extension = file.name.split('.').pop();

                name = name.split('/');
                name = name[name.length - 1];

                name = name.replace('_', '');

                return `exports/js/${name}.js`;
            }

            return 'assets/[name][extname]'
        },
      }
      
      /*
      output: {
          entryFileNames: `[name].js`,
          chunkFileNames: `[name].js`,
          assetFileNames: `[name].[ext]`
      }*/
    },

    // minifying switch
    minify: true,
    write: true
  },

  server: {

    // required to load scripts from custom host
    cors: true,

    // we need a strict port to match on PHP side
    // change freely, but update in your functions.php to match the same port
    strictPort: true,
    port: 3000,

    // serve over http
    https: false,

    // serve over httpS
    // to generate localhost certificate follow the link:
    // https://github.com/FiloSottile/mkcert - Windows, MacOS and Linux supported - Browsers Chrome, Chromium and Firefox (FF MacOS and Linux only)
    // installation example on Windows 10:
    // > choco install mkcert (this will install mkcert)
    // > mkcert -install (global one time install)
    // > mkcert localhost (in project folder files localhost-key.pem & localhost.pem will be created)
    // uncomment below to enable https
    //https: {
    //  key: fs.readFileSync('localhost-key.pem'),
    //  cert: fs.readFileSync('localhost.pem'),
    //},

    hmr: {
      host: 'localhost',
      //port: 443
    },
    
  },

  // required for in-browser template compilation
  // https://v3.vuejs.org/guide/installation.html#with-a-bundler
  resolve: {
    alias: {
        zz: resolve(__dirname, './inc/styling/zz'),
        styling: resolve(__dirname, './inc/styling'),
      //vue: 'vue/dist/vue.esm-bundler.js'
    }
  }
})

