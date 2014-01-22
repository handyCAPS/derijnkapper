/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    wpFolder: '<%= pkg.wp.folder %>',
    wpRemote: '<%= pkg.wp.remote %>',
    wpPluginFolder: '<%= pkg.wp.pluginFolder %>',

    // Task configuration.
    concat: {
      options: {
        banner: '<%= banner %>',
        stripBanners: true
      },
      dist: {
        src: ['bower_components/owlcarousel/owl-carousel/owl.carousel.js','lib/js/<%= pkg.name %>.js'],
        dest: 'dist/js/<%= pkg.name %>.js'
      },
      wpPlugins: {
        files: [{
          expand: true,
          cwd: 'lib/<%= wpPluginFolder %>/**/js',
          src: '**/*.js',
          dest: 'dist/<%= wpPluginFolder %>/js'
        }]
      }
    },
    uglify: {
      options: {
        banner: '<%= banner %>'
      },
      dist: {
        src: '<%= concat.dist.dest %>',
        dest: 'dist/js/<%= pkg.name %>.min.js'
      },
      wordpressRemote: {
        src: '<%= concat.dist.dest %>',
        dest: '<%= pkg.wp.remote %>/themes/<%= wpFolder %>/js/<%= pkg.name %>.min.js'
      },
      wpPlugins: {
        files: [{
          expand: true,
          cwd: 'lib/<%= wpPluginFolder %>',
          src: '**/*.js',
          dest: 'dist/<%= wpPluginFolder %>'
        }]
      },
      wpPluginsRemote: {
        files: [{
          expand: true,
          cwd: 'lib/<%= wpPluginFolder %>',
          src: '**/*.js',
          dest: '<%= wpRemote %>/plugins'
        }]
      }
    },
    jshint: {
      options: {
        devel: true,
        curly: true,
        eqeqeq: true,
        immed: true,
        latedef: true,
        newcap: true,
        noarg: true,
        sub: true,
        undef: true,
        unused: true,
        boss: true,
        eqnull: true,
        browser: true,
        jquery: true,
        globals: {
          jQuery: true,
          ajaxurl: true,
          require: true
        }
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      lib_test: {
        src: ['lib/**/*.js']
      }
    },
    watch: {
      gruntfile: {
        files: '<%= jshint.gruntfile.src %>',
        tasks: ['jshint:gruntfile']
      },
      lib_test: {
        files: '<%= jshint.lib_test.src %>',
        tasks: ['jshint:lib_test', 'concat', 'uglify']
      },
      sass: {
        files: '**/*.scss',
        tasks: ['sass']
      },
      views: {
        files: ['lib/html/**/*.html', 'lib/php/**/*.php', 'lib/<%= wpPluginFolder %>/**/*.php'],
        tasks: ['htmlmin']
      },
      options: {
          livereload: true
        }
    },
    sass: {
      dev: {
        options: {
          lineNumbers: true
        },
        files: [{
          expand: true,
          cwd: 'lib/scss',
          src: '**/*.scss',
          dest: 'lib/css',
          ext: '.css'
        }]
      },
      dist: {
        options: {
          banner: '<%= banner %>',
          style: 'compressed'
        },
        files: [{
          expand: true,
          cwd: 'lib/scss',
          src: '**/*.scss',
          dest: 'dist/css',
          ext: '.css'
        }]
      },
      wordpress: {
        options: {
          banner: '<%= banner %>',
          style: 'compressed'
        },
        files: [{
          expand: true,
          cwd: 'lib/scss',
          src: '**/*.scss',
          dest: 'dist/<%= wpFolder %>/css',
          ext: '.css'
        }]
      },
      wordpressRemote: {
        options: {
          banner: '<%= banner %>',
          style: 'expanded'
        },
        files: [{
          expand: true,
          cwd: 'lib/scss',
          src: '**/*.scss',
          dest: '<%= wpRemote %>/themes/<%= wpFolder %>/css',
          ext: '.css'
        }]
      },
      wordpressPlugin: {
        options: {
          banner: '<%= banner %>',
          style: 'compressed'
        },
        files: [{
          expand: true,
          cwd: 'lib/<%= wpPluginFolder %>',
          src: '**/*.scss',
          dest: 'dist/<%= wpPluginFolder %>/',
          ext: '.css'
        }]
      },
      wordpressPluginRemote: {
        options: {
          banner: '<%= banner %>',
          style: 'compressed'
        },
        files: [{
          expand: true,
          cwd: 'lib/<%= wpPluginFolder %>',
          src: '**/*.scss',
          dest: '<%= wpRemote %>/plugins',
          ext: '.css'
        }]
      }
    },
    htmlmin: {
      dist: {
        options: {
          collapseWhitespace: true,
          removeComments: true
        },
        files: [{
          expand: true,
          cwd: 'lib/html',
          src: ['**/*.html'],
          dest: 'dist/html'
        }]
      },
      php: {
        options: {
          collapseWhitespace: true,
          removeComments: true,
          removeOptionalTags: true
        },
        files: [{
          expand: true,
          cwd: 'lib/php',
          src: ['**/*.php'],
          dest: 'dist/php'
        }]
      },
      wordpress: {
        options: {
          collapseWhitespace: true,
          removeComments: true,
          removeOptionalTags: true
        },
        files: [{
          expand: true,
          cwd: 'lib/php',
          src: ['**/*.php'],
          dest: 'dist/<%= wpFolder %>'
        }]
      },
      wordpressRemote: {
        options: {
          collapseWhitespace: true,
          removeComments: true,
          removeOptionalTags: true
        },
        files: [{
          expand: true,
          cwd: 'lib/php',
          src: ['**/*.php'],
          dest: '<%= wpRemote %>/themes/<%= wpFolder %>'
        }]
      },
      wordpressPluginRemote: {
        options: {
          collapseWhitespace: true
        },
        files: [{
          expand: true,
          cwd: 'lib/<%= wpPluginFolder %>',
          src: ['**/*.php'],
          dest: '<%= wpRemote %>/plugins'
        }]
      }
    },
    imagemin: {
      dist: {
        files: [{
          expand: true,
          cwd: 'lib/images',
          src: ['**/*.{png,jpg,jpeg,gif}'],
          dest: 'dist/images'
        }]
      },
      wpRemote: {
        files: [{
          expand: true,
          cwd: 'lib/images',
          src: ['**/*.{png,jpg,jpeg,gif}'],
          dest: '<%= wpRemote %>/themes/<%= wpFolder %>/images'
        }]
      }
    },
    autoprefixer: {
      options: {
        diff: true
      },
      dist: {
        src: 'dist/css/**/*.css'
      },
      wordpress: {
        src: 'dist/<%= wpFolder %>/css/**/*.css'
      },
      wordpressRemote: {
        src: '<%= wpRemote %>/themes/<%= wpFolder %>/css/**/*.css'
      }
    }
  });

  // Autoloading all dev dependencies
  require('load-grunt-tasks')(grunt);

  // Default task.
  grunt.registerTask('default', ['jshint', 'htmlmin', 'concat', 'uglify', 'imagemin', 'sass', 'autoprefixer']);

};
