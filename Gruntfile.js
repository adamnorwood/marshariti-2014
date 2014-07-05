module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        uglify: {
            options: {
                preserveComments: 'some'
            },
            dev: {
                files: {
                   'js/scripts.min.js':['js/jquery.infinitescroll.min.js', 'js/scripts.js']
                }
            }
        },

        sass: {
            dev: {
                files: {
                    'style.css' : 'sass/style.scss'
                },
                options: {
                    style: 'expanded',
                    sourcemap: true
                }
            }
        },

        watch: {
            php: {
                files: [ '**/*.php' ],
            },
            css: {
                //We watch and compile sass files as normal but don't live reload here
                files: ['sass/**/*.scss'],
                tasks: ['sass:dev']
            },
            js: {
                 //We watch and compile js files as normal but don't live reload here
                 files: ['js/scripts.js'],
                 tasks: ['uglify:dev']
            },
            options: {
                livereload: {
                    options: {
                        livereload: true
                    }
                },
                livereloadOnError: false
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task(s).
    grunt.registerTask('default', ['watch']);
};