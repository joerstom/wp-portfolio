// Gruntfile.js

// our wrapper function (required by grunt and its plugins)
// all configuration goes inside this function
module.exports = function(grunt) {

  // ===========================================================================
  // CONFIGURE GRUNT ===========================================================
  // ===========================================================================
  grunt.initConfig({

    // get the configuration info from package.json ----------------------------
    // this way we can use things like name and version (pkg.name)
    pkg: grunt.file.readJSON('package.json'),

    // all of our configuration will go here
    
   
	// configure jshint to validate js files -----------------------------------
    jshint: {
      options: {
        reporter: require('jshint-stylish') // use jshint-stylish to make our errors look and read good
      },

      // when this task is run, lint the Gruntfile and all js files in src
      build: ['Grunfile.js', 'wp-content/themes/fhpress/js/ready.js']
    },
    less: {
      build: {
        files: {
          'wp-content/themes/fhpress/style.full.css': 'wp-content/themes/fhpress/style.full.less'
        }
      }
    },
	// configure uglify to minify js files -------------------------------------
    uglify: {
      options: {
        banner: '/*\n <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> \n*/\n'
      },
      build: {
        files: {
          'wp-content/themes/fhpress/js/final.min.js': ['wp-content/themes/fhpress/js/plugins.min.js', 'wp-content/themes/fhpress/js/ready.js']
        }
      }
    },
    // configure cssmin to minify css files ------------------------------------
    cssmin: {
      options: {
        banner: '/*\n <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> \n*/\n'
      },
      build: {
        files: {
          'wp-content/themes/fhpress/style.min.css': 'wp-content/themes/fhpress/style.full.css'
        }
      }
    },
    imagemin: {                          // Task 
	    dynamic: {                         // Another target 
	      files: [{
	        expand: true,                  // Enable dynamic expansion 
	        cwd: 'wp-content/themes/fhpress/images/src/',                   // Src matches are relative to this path 
	        src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match 
	        dest: 'wp-content/themes/fhpress/images/'                  // Destination path prefix 
	      }]
	    }
  	}

  });

  // ===========================================================================
  // LOAD GRUNT PLUGINS ========================================================
  // ===========================================================================
  // we can only load these if they are in our package.json
  // make sure you have run npm install so our app can find these

  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  
  // ============= // CREATE TASKS ========== //
  grunt.registerTask('default', ['jshint', 'uglify', 'cssmin', 'less', 'imagemin']); 

};
