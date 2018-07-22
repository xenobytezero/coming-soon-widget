/*global module:false*/
module.exports = function(grunt) {

    var opts = {

        packageName: 'coming-soon-widget',

        artifacts:[
            'css/*.css',
            '*.php'
        ],

        packageVersion: grunt.file.readJSON('package.json')['version'],
        packageDest: grunt.option('packageDest') || '../out'
    };

    opts.fullPackagePath = opts.packageDest + '/' + opts.packageName + '/';

    // ----------------------------------------------------------------

    // These plugins provide necessary tasks.
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-replace');

    // ----------------------------------------------------------------

    grunt.registerTask('deploy', ['sass', 'copy', 'replace']);

    // ----------------------------------------------------------------

    // Project configuration.
    grunt.initConfig({

        // ----------------------------------------------------------------
        // Watch

        watch: {
            files: ['../sass/**/*.scss'],
            tasks: ['sass'],
            options: {
                atBegin: true
            }
        },

        // -----------------------------------------------------------------
        // SASS

        sass: {

            main: {

                options: {
                    loadPath: ['.'],
                    compass: true
                },

                files: [
                    {
                        src: '../sass/' + opts.packageName + '.scss',
                        dest: '../css/' + opts.packageName + '.css'
                    }
                ]

            }
        },

        // ------------------------------------------------------------------
        // Replace

        replace: {

            deploy: {

                src: opts.fullPackagePath + opts.packageName + '.php',
                dest: opts.fullPackagePath + opts.packageName + '.php',
                options: {
                    patterns: [{
                        match: 'releaseVersion',
                        replacement: opts.packageVersion
                    }]
                }

            }




        },

        // --------------------------------------------------------------------
        // Copy

        copy: {

            deploy: {
                expand: true,
                cwd: '../',
                src: opts.artifacts,
                dest: opts.fullPackagePath
            }

        }


    });

    // -----------------------------------------------------------------

};
