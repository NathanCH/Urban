module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        less: {
            development: {
                options: {
                    paths: 'Public/static/css',
                    compress: true
                },
                files: {
                    'Build/Public/static/css/static.css' : 'Public/static/css/static.less',
                     'Build/Public/static/css/splash.css' : 'Public/static/css/splash.less',
                }
            }
        },
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.registerTask('default' , ['less']);
}