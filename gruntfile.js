module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        less: {
            development: {
                options: {
                    paths: 'Static/css',
                    compress: true
                },
                files: {
                    'Build/Static/css/static.css' : 'Static/css/static.less',
                     'Build/Static/css/splash.css' : 'Static/css/splash.less',
                }
            }
        },
        concat: {
            js: {
                files: {
                    'Build/Static/js/app.js' : [
                        'Static/js/urbn.js',
                        'Static/js/components.js',
                        'Static/js/extensions.js',
                        'Static/js/functions.js'
                    ]
                }
            }
        },
        uglify: {
            min: {
                files: {
                    'Build/Static/js/app.min.js' : ['Build/Static/js/app.js']
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.registerTask('default' , ['less', 'concat', 'uglify']);
}