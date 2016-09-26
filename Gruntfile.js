/*jslint node: true*/
module.exports = function (grunt) {
    'use strict';

    grunt.loadNpmTasks('grunt-jslint');
    grunt.loadNpmTasks('grunt-shipit');
    grunt.loadNpmTasks('shipit-git-update');
    grunt.loadNpmTasks('shipit-composer-simple');
    grunt.loadNpmTasks('grunt-jsonlint');
    grunt.loadNpmTasks('grunt-fixpack');

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
            'staging-redirect': {
                deployTo: 'mediawiki-beta/redirect/'
            },
            prod: {
                deployTo: 'mediawiki/',
                branch: 'master'
            }
        },
        jsonlint: {
            manifests: {
                src: ['*.json'],
                options: {
                    format: true
                }
            }
        },
        fixpack: {
            package: {
                src: 'package.json'
            }
        }
    });

    grunt.registerTask('lint', ['jslint', 'jsonlint', 'fixpack']);
    grunt.registerTask('staging', ['shipit:staging', 'update', 'composer:install', 'composer:cmd', 'shipit:staging-redirect', 'composer:install']);
    grunt.registerTask('prod', ['shipit:prod', 'update', 'composer:install', 'composer:cmd']);
};
