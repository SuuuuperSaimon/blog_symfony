var Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    .splitEntryChunks()
    .enableSingleRuntimeChunk()

    .addEntry('app',        './assets/app.js')
    .addEntry('app_admin',  './assets/app_admin.js')

    .copyFiles([
        {
            from: './assets/backend/css',
            to: 'backend/css/[path][name].[hash:8].[ext]'
        },
        {
            from: './assets/backend/js',
            to: 'backend/js/[path][name].[hash:8].[ext]'
        },
        {
            from: './assets/backend/images',
            to: 'backend/images/[path][name].[ext]'
        },
        {
            from: './assets/backend/fonts',
            to: 'backend/fonts/[path][name].[ext]'
        }
    ])

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
;

module.exports = Encore.getWebpackConfig();
