const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}


if (Encore.isProduction()) {
    Encore
        // directory where compiled assets will be stored
        .setOutputPath('public/assets/')
        // public path used by the web server to access the output path
        .setPublicPath('/assets')
        // only needed for CDN's or sub-directory deploy
        //.setManifestKeyPrefix('build/')
        ;
} else {
    Encore
        // directory where compiled assets will be stored
        .setOutputPath('public/assets-dev/')
        // public path used by the web server to access the output path
        .setPublicPath('assets-dev')
        // only needed for CDN's or sub-directory deploy
        //.setManifestKeyPrefix('build/')
        ;
}


Encore
    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.ts')
    .addEntry('news', './assets/news.tsx')
    .addEntry('project', './assets/project.tsx')
    .addEntry('hash-tool', './assets/tools/hash.tsx')
    .addEntry('ip-address-tool', './assets/tools/ip-address.tsx')
    .addEntry('physics-calculator-tool', './assets/tools/physics-calculator.tsx')
    .addEntry('resistance-tool', './assets/tools/resistance.tsx')
    .addEntry('resolution-tool', './assets/tools/resolution.tsx')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    //.enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    .enableTypeScriptLoader()

    // uncomment if you use React
    .enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    .enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
    ;


if (Encore.isProduction()) {
    Encore
        .configureDefinePlugin((options) => {
            if(options['process.env'] === undefined) {
                options['process.env'] = {};
            }
            options['process.env'].__API__ = JSON.stringify('/api');
        })
        ;
} else {
    Encore
        .configureDefinePlugin((options) => {
            if(options['process.env'] === undefined) {
                options['process.env'] = {};
            }
            options['process.env'].__API__ = JSON.stringify('/~trogon_studios_website/public/api');
        })
        ;
}

module.exports = Encore.getWebpackConfig();
