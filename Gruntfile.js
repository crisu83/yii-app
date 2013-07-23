// The wrapper function
module.exports = function(grunt) {

	// Project and task configuration
	grunt.initConfig({
		concat: {
			options: {
				separator: "\n\n"
			},
			dist: {
				src: [
					'app/js/app.js'
				],
				dest: 'environments/dev/web/js/main.js'
			}
		},
        copy: {
            styles: {
                files: [
                    {
                        cwd: 'environments/dev/web/css/',
                        expand: true,
                        filter: 'isFile',
                        src: ['**/*.css'],
                        dest: 'web/css/'
                    }
                ]
            },
            scripts: {
                files: [
                    {
                        cwd: 'environments/dev/web/js/',
                        expand: true,
                        filter: 'isFile',
                        src: ['**/*.js'],
                        dest: 'web/js/'
                    }
                ]
            }
        },
		"closure-compiler": {
			main: {
				closurePath: 'vendor/crisu83/closurecompiler-bin',
				js: 'environments/dev/web/js/main.js',
				jsOutputFile: 'environments/prod/web/js/main.js',
				maxBuffer: 500,
				options: {
					compilation_level: 'SIMPLE_OPTIMIZATIONS',
					language_in: 'ECMASCRIPT5_STRICT'
				}
			}
		},
        less: {
            dev: {
                files: {
                    "environments/dev/web/css/main.css": "app/less/main.less",
                    "environments/dev/web/css/responsive.css": "app/less/responsive.less"
                }
            },
            prod: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: {
                    "environments/prod/web/css/main.css": "app/less/main.less",
                    "environments/prod/web/css/responsive.css": "app/less/responsive.less"
                }
            }
        },
		watch: {
			styles: {
				files: ['app/less/**/*.less'],
				tasks: ['less', 'copy'],
                options: {
                    livereload: 1337,
                    nospawn: true
                }
			},
			scripts: {
				files: ['app/js/**/*.js'],
				tasks: ['concat', 'copy'],
                options: {
                    // Start a live reload server on the default port 35729
                    livereload: true,
                    nospawn: true
                }
			}
		}
	});

	// Load plugins
    grunt.loadNpmTasks('grunt-closure-compiler');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');

	// Define tasks
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('compile-js', ['closure-compiler', 'copy']);

};