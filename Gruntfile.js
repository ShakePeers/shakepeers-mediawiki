/*jslint node: true*/
module.exports = function (grunt) {
    'use strict';

    grunt.loadNpmTasks('grunt-jslint');
    grunt.loadNpmTasks('grunt-shipit');
    grunt.loadNpmTasks('shipit-git-update');

    grunt.initConfig({
        jslint: {
            Gruntfile: {
                src: 'Gruntfile.js'
            }
        },
        shipit: {
            options: {
                servers: 'shakepeers@shakepeers.org',
                postUpdateCmd: 'composer install --no-dev; composer updatedb -- --quick'
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
    grunt.registerTask('staging', ['shipit:staging', 'update']);
    grunt.registerTask('prod', ['shipit:prod', 'update']);
};
