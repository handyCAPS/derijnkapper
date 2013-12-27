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
    // Task configuration.
    concat: {
      options: {
        banner: '<%= banner %>',
        stripBanners: true
      },
      dist: {
        src: ['bower_components/owlcarousel/owl-carousel/owl.carousel.js','lib/js/<%= pkg.name %>.js'],
        dest: 'dist/js/<%= pkg.name %>.js'
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
        dest: '<%= pkg.wpFolderRemote %>/js/<%= pkg.name %>.min.js'
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
        tasks: ['sass:dev', 'sass:wordpressRemote']
      },
      views: {
        files: ['lib/html/**/*.html', 'lib/php/**/*.php'],
        tasks: ['htmlmin:dist', 'htmlmin:wordpressRemote']
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
          style: 'compressed'
        },
        files: [{
          expand: true,
          cwd: 'lib/scss',
          src: '**/*.scss',
          dest: '<%= pkg.wpFolderRemote %>/css',
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
          collapseWhitespace: true
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
          collapseWhitespace: true
        },
        files: [{
          expand: true,
          cwd: 'lib/php',
          src: ['**/*.php'],
          dest: 'dist/<%= pkg.wpFolder %>'
        }]
      },
      wordpressRemote: {
        options: {
          collapseWhitespace: true
        },
        files: [{
          expand: true,
          cwd: 'lib/php',
          src: ['**/*.php'],
          dest: '<%= pkg.wpFolderRemote %>'
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
      }
    }
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-htmlmin');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task.
  grunt.registerTask('default', ['jshint', 'concat', 'uglify', 'imagemin:dist', 'sass:dist']);

};
