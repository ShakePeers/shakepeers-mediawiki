/*jslint node: true*/
module.exports = function (grunt) {
    'use strict';

    grunt.loadNpmTasks('grunt-jslint');
    grunt.loadNpmTasks('grunt-shipit');
    grunt.loadNpmTasks('shipit-git-update');
    grunt.loadNpmTasks('shipit-composer-simple');

    grunt.initConfig({
        jslint: {
            Gruntfile: {
                src: 'Gruntfile.js'
            }
        },
        shipit: {
            options: {
                servers: 'shakepeers@shakepeers.org',
                composer: {
                    noDev: true,
                    cmd: 'updatedb -- --quick'
                }
            },
            staging: {
                deployTo: 'mediawiki-beta/',
                branch: 'develop'
            },
            prod: {
                deployTo: 'mediawiki/',
                branch: 'master'
            }
        }
    });

    grunt.registerTask('lint', ['jslint']);
    grunt.registerTask('staging', ['shipit:staging', 'update', 'composer:install', 'composer:cmd']);
    grunt.registerTask('prod', ['shipit:prod', 'update', 'composer:install', 'composer:cmd']);
};
