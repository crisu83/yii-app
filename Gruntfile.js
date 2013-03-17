// The wrapper function
module.exports = function(grunt) {
	
	// Project and task configuration
	grunt.initConfig({
		less: {
			development: {
				options: {
					compress: true,
					yuicompress: true,
					optimization: 2
				},
				files: {
					"web/css/main.css": "app/less/main.less",
					"web/css/responsive.css": "app/less/responsive.less"
				}
			}
		},
		concat: {
			options: {
				separator: "\n\n"
			},
			dist: {
				src: [
					'app/js/app.js'
				],
				dest: 'web/js/main.js'
			}
		},
		"closure-compiler": {
			main: {
				closurePath: 'app/lib/closure-compiler',
				js: 'web/js/main.js',
				jsOutputFile: 'web/js/main.min.js',
				maxBuffer: 500,
				options: {
					compilation_level: 'SIMPLE_OPTIMIZATIONS',
					language_in: 'ECMASCRIPT5_STRICT'
				}
			}
		},
		watch: {
			styles: {
				files: ['app/less/**/*.less'],
				tasks: ['less'],
				options: {
					nospawn: true
				}
			},
			scripts: {
				files: ['app/js/**/*.js'],
				tasks: ['concat'],
				options: {
					nospawn: true
				}
			}
		}
	});

	// Load plugins
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-closure-compiler');

	// Define tasks
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('compile-js', ['closure-compiler']);

};