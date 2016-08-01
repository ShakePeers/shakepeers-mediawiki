/*jslint node: true*/
module.exports = function (grunt) {
    'use strict';

    grunt.loadNpmTasks('grunt-jslint');
    grunt.loadNpmTasks('grunt-shipit');

    grunt.initConfig({
        jslint: {
            Gruntfile: {
                src: 'Gruntfile.js'
            }
        },
        shipit: {
            shakepeers: {
                servers: 'shakepeers@shakepeers.org'
            }
        }
    });

    grunt.registerTask('lint', ['jslint']);
    grunt.registerTask('pull:staging', function () {
        grunt.shipit.remote('cd mediawiki-beta/; git pull; composer install --no-dev; composer updatedb -- --quick', this.async());
    });
    grunt.registerTask('pull:prod', function () {
        grunt.shipit.remote('cd mediawiki/; git pull; composer install --no-dev; composer updatedb -- --quick', this.async());
    });
    grunt.registerTask('staging', ['shipit:shakepeers', 'pull:staging']);
    grunt.registerTask('prod', ['shipit:shakepeers', 'pull:prod']);
};
