require.config({
    paths: {
        app: 'app',
        jquery: '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery',
    }
});

require(['app'], function(App) {
    new App();
});