/**
 * Gulpfile setup
 *
 * @since 	1.0.0
 * @authors Waylon Fourie
 * @package grafipress
 *
 * SETUP STEPS
 * 1. Run npm install
 * 2. Run npm install -g gulp
 * 3. Run npm install --save-dev gulp
 * 4. Run npm install npm install --save-dev browser-sync gulp-autoprefixer gulp-clean-css gulp-filter gulp-uglify gulp-imagemin gulp-newer gulp-rename gulp-concat gulp-notify gulp-combine-media-queries gulp-run-sequence gulp-sass gulp-load-plugins 	gulp-ignore gulp-rimraf gulp-zip gulp-plumber gulp-cache gulp-sourcemaps gulp-todo gulp-wp-pot gulp-sort gulp-replace gulp-replace-task gulp-trimlines gulp-util
 * 5. Run npm install npm-check-updates -g
 * 6. Run npm-check-updates
 */

function titleCase(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

// Project configuration
var url 			= 'ssc.dev', 			// Local Development URL for BrowserSync. Change as-needed.
	bower 			= './bower_components/', 		// Not truly using this yet, more or less playing right now. TO-DO Place in Dev branch
	build 			= './dist/', 					// Files that you want to package into a zip go here
	buildInclude 	= [
						// Include common file types
						'**/*.php',
						'**/*.html',
						'**/*.css',
						'**/*.js',
						'**/*.svg',
						'**/*.ttf',
						'**/*.otf',
						'**/*.eot',
						'**/*.woff',
						'**/*.woff2',

						// Include specific files and folders
						'screenshot.png',

						// Exclude files and folders
						'!node_modules/**/*',
						'!tpl/**/*',
						'!bower_components/**/*',
						'!src/**/*',
						'!style.css.map',
						'!**/*.yml',
						'!**/*.simplecov',
						'!**/*.editorconfig',
						'!**/*.gitignore',
						'!**/composer.json',
						'!**/gulpfile.js',
						'!**/LICENSE',
						'!**/package.json',
						'!**/*.xml',
						'!**/*.md',
						'!**/*.txt',
						'!**/*.map',
						'!**/thumbs.db',
						'!**/*.scss',
						'!**/Gruntfile.js'
					];

var fs 				= require('fs');
	json 			= JSON.parse(fs.readFileSync('./package.json'));

var theme 			= [
	name 			= 'starsigns',
	uri 			= 'www.grafika.co.za',
	author 			= 'Waylon Fourie',
	author_uri 		= 'http://www.grafika.co.za',
	description 	= 'Custom theme created by Grafika for Star Signs & Customs',
	version 		= '1.0',
	license 		= 'gnu general public license v2 or later',
	license_uri 	= 'http://www.gnu.org/licenses/gpl-2.0.html',
	tags 			= 'orange, dark, two-columns, left-sidebar, right-sidebar, fluid-layout, flexable-header, responsive-layout, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images, theme-options, translation-ready',
	textdomain 		= '',
];


// Load plugins
var gulp     	 	= require('gulp'),
	browserSync  	= require('browser-sync').create(),
	reload       	= browserSync.reload,
	autoprefixer 	= require('gulp-autoprefixer'),
	cleanCSS    	= require('gulp-clean-css'),
	filter       	= require('gulp-filter'),
	uglify       	= require('gulp-uglify'),
	imagemin     	= require('gulp-imagemin'),
	newer        	= require('gulp-newer'),
	rename       	= require('gulp-rename'),
	concat       	= require('gulp-concat'),
	notify       	= require('gulp-notify'),
	cmq          	= require('gulp-combine-media-queries'),
	runSequence  	= require('gulp-run-sequence'),
	sass         	= require('gulp-sass'),
	plugins      	= require('gulp-load-plugins')({ camelize: true }),
	ignore       	= require('gulp-ignore'),
	rimraf       	= require('gulp-rimraf'),
	zip          	= require('gulp-zip'),
	plumber      	= require('gulp-plumber'),
	cache        	= require('gulp-cache'),
	sourcemaps   	= require('gulp-sourcemaps');
	todo   			= require('gulp-todo');
	wpPot			= require('gulp-wp-pot');
	sort 			= require('gulp-sort');
	replace 		= require('gulp-replace');
	//replace 		= require('gulp-replace-task');
	trimlines 		= require('gulp-trimlines');
	gutil 			= require('gulp-util');

var onError = function (err) {
  console.log('ERROR: ', gutil.colors.bgRed(err.message));
  gutil.beep();
  this.emit('end');
};

/**
 * Browser Sync
 *
 * Asynchronous browser syncing of assets across multiple devices!! Watches for changes to js, image and php files
 * Although, I think this is redundant, since we have a watch task that does this already.
*/
gulp.task('browser-sync', function() {
	browserSync.init(
		['**/*.php', '**/*.css', '**/*.{png,jpg,gif,svg}'], {
		proxy: 'ssc.dev',
		//proxy: 'localhost:3000',
		//proxy   : "http://localhost/ssc.dev"
		port: 3000,
		//server: { baseDir: "./"}
		//tunnel: true,
		// tunnel: "ppress",
		//injectChanges: true
	});
});

/**
 * Copy Fonts
 *
 * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
 *
 * Sass output styles: https://web-design-weekly.com/2014/06/15/different-sass-output-styles/
*/
gulp.task('fonts', function() {
   gulp.src('./bower_components/font-awesome/fonts/**/*.{ttf,woff,eof,svg}')
   .pipe(gulp.dest('./fonts'));
});

/**
 * Populate Theme Stylesheet header
 *
 * Open the main theme WordPress styleshhet and populate values as set in package.json
 */
gulp.task('stylesheetheader', function() {
   gulp.src('./style.css')
   .pipe(replace('{THEME-NAME}', titleCase(json.name)))
   .pipe(replace('{THEME-URI}', json.repository.url ))
   .pipe(replace('{THEME-AUTHOR}', titleCase(json.author)))
   .pipe(replace('{AUTHOR-URI}', json.homepage))
   .pipe(replace('{THEME-DESCRIPTION}', json.description))
   .pipe(replace('{THEME-VERSION}', json.version))
   .pipe(replace('{THEME-LICENSE}', json.license))
   .pipe(replace('{THEME-LICENSE-URI}', json.license))
   .pipe(replace('{THEME-TAGS}', json.keywords))
   .pipe(gulp.dest('./'));
});

/**
 * Theme Styles
 *
 * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
 *
 * Sass output styles: https://web-design-weekly.com/2014/06/15/different-sass-output-styles/
 */
gulp.task('styles', function () {
 	gulp.src('./src/scss/main.scss')
	.pipe(plumber({errorHandler: onError}))
	//.pipe( gutil.env.type === 'production' ? sourcemaps.init(): gutil.noop())
	.pipe(sass({
		//errLogToConsole: true,
		//outputStyle: 'compressed',
		//outputStyle: 'compact',
		// outputStyle: 'nested',
		// outputStyle: 'expanded',
		//precision: 10
	}))
	//.pipe(replace('bar', 'foo'))
	//.pipe( gutil.env.type === 'production' ? sourcemaps.write({includeContent: false}) : gutil.noop())
	//.pipe( gutil.env.type === 'production' ? sourcemaps.init({loadMaps: true}):gutil.noop())
	//.pipe(autoprefixer('last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
	//.pipe(sourcemaps.write('.'))
	.pipe(plumber.stop())
	.pipe(rename({
		basename: json.name+'-styles',
	}))
	.pipe(gulp.dest('./css/'))
	//.pipe(filter('**/*.css')) // Filtering stream to only css files
	//.pipe(cmq()) // Combines Media Queries
	//.pipe(reload({stream:true})) // Inject Styles when style file is created
	.pipe(rename({
		//basename: 'grafipress-styles',
		suffix: '.min' }))
	//.pipe(gutil.env.type === 'production'?cleanCSS({keepSpecialComments:0,compatibility:'ie8'}):gutil.noop())
	.pipe(gulp.dest('./css/'))
	//.pipe(browserSync.reload({stream:true})) // Inject Styles when min style file is created
	.pipe(browserSync.stream())
	.pipe(notify({ message: 'Styles task complete', onLast: true }))
});


/**
 * Scripts: Vendors
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/
gulp.task('scripts', function() {
	return 	gulp.src([
		//bower+'/bootstrap-sass/assets/javascripts/bootstrap/**/*.js'
		'./bower_components/bootstrap-sass/assets/javascripts/bootstrap/bootstrap.min.js',
		/*bower+'Morphext/dist/morphext.js',*/
		/*bower+'wow/dist/wow.js',*/
		'./src/js/parallax.js',
		'./src/js/imagelightbox.js',
		'./src/js/*.js'
	])
	.pipe(plumber({errorHandler: onError}))
	.pipe(concat(json.name+'-scripts.js'))
	.pipe(gulp.dest('./js/'))
	.pipe(rename( {
		suffix: '.min'
	}))
	.pipe(uglify())
	.pipe(gulp.dest('./js/'))
	.pipe(reload({stream:true})) // Inject Styles when min style file is created
	.pipe(notify({ message: 'Scripts task complete', onLast: true }));
});

/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
 */
gulp.task('images', function() {
	// Add the newer pipe to pass through newer images only
	return 	gulp.src(['./src/img/**/*.{png,jpg,gif,svg}'])
	.pipe(plumber({errorHandler: onError}))
	.pipe(newer('./img/'))
	.pipe(rimraf({ force: true }))
	.pipe(imagemin({ optimizationLevel: 7, progressive: true, interlaced: true }))
	.pipe(gulp.dest('./img/'))
	.pipe( notify( { message: 'Images task complete', onLast: true } ) );
});

/**
 * Generate a TODO.md file from comments of files in stream.
 * TODO Test todo gulp stream
 */
gulp.task('todo', function() {
    return gulp.src([
		// Include common file types
		'**/*.php',
		'**/*.html',
		'**/*.css',
		'**/*.js',
		// Exclude files and folders
		'!lib/**/*',
		'!node_modules/**/*',
		'!bower_components/**/*',
		'!src/**/*',
		'!style.css.map',
		'!**/*.yml',
		'!**/*.simplecov',
		'!**/*.editorconfig',
		'!**/*.gitignore',
		'!**/composer.json',
		//'!**/gulpfile.js',
		'!**/LICENSE',
		'!**/package.json',
		'!**/*.xml',
		'!**/*.md',
		'!**/*.txt',
		'!**/*.map',
		'!**/thumbs.db',
		'!**/*.scss',
		'!**/Gruntfile.js'
	])
    .pipe(todo())
    .pipe(plumber({errorHandler: onError}))
    .pipe(gulp.dest('./'));
});

/**
 * Generate pot-files for WordPress localization.
 */
gulp.task('settextdomain', function(){
  gulp.src('/**/*.*')
    .pipe(replace('\'grafipress\'', '\'TEXTDOMAIN\''))
    .pipe(plumber({errorHandler: onError}))
    .pipe(gulp.dest('./'));
});

/**
 * Removes the trailing whitespace at the end of each line in a string.
 */
gulp.task('trimlines', function () {
	gulp.src('/header2.php')
 .pipe(trimlines({
    leading: false
  }))
 .pipe(plumber({errorHandler: onError}))
 .pipe(gulp.dest('./trimmed/'));
});

/**
 * Gulp translate function
 */
gulp.task('translate', function () {
	return gulp.src([
		// Include common file types
		'**/*.*',
		'!lib/**/*',
		'!node_modules/**/*',
		'!bower_components/**/*',
		'!src/**/*',
		'!style.css.map',
		'!**/*.yml',
		'!**/*.simplecov',
		'!**/*.editorconfig',
		'!**/*.gitignore',
		'!**/composer.json',
		'!**/LICENSE',
		'!**/package.json',
		'!**/*.xml',
		'!**/*.md',
		'!**/*.txt',
		'!**/*.map',
		'!**/thumbs.db',
		'!**/*.scss',
		'!**/Gruntfile.js'
	])
	//.pipe(sort())
	.pipe(plumber({errorHandler: onError}))
	.pipe(wpPot( {
		domain: json.name,
		destFile: json.name+'.pot',
		package: json.name,
		bugReport: json.bugs.url,
		lastTranslator: json.author,
	} ))
	.pipe(gulp.dest('languages'));
});

/**
* Clean gulp cache
*/
gulp.task('clear', function () {
	cache.clearAll();
});

/**
* Clean tasks for zip
*
* Being a little overzealous, but we're cleaning out the build folder, codekit-cache directory and annoying DS_Store files and Also
* clearing out unoptimized image files in zip as those will have been moved and optimized
*/
gulp.task('cleanup', function() {
	return gulp.src(['./src/bower_components', '**/.sass-cache','**/.DS_Store'], { read: false }) // much faster
	.pipe(ignore('node_modules/**')) //Example of a directory to ignore
	.pipe(rimraf({ force: true }))
	.pipe(plumber({errorHandler: onError}))
	// .pipe(notify({ message: 'Clean task complete', onLast: true }));
});

gulp.task('cleanupFinal', function() {
	return gulp.src(['./src/bower_components','**/.sass-cache','**/.DS_Store'], { read: false }) // much faster
	.pipe(ignore('node_modules/**')) //Example of a directory to ignore
	.pipe(rimraf({ force: true }))
	.pipe(plumber({errorHandler: onError}))
	// .pipe(notify({ message: 'Clean task complete', onLast: true }));
});

/**
* Build task that moves essential theme files for production-ready sites
*
* buildFiles copies all the files in buildInclude to build folder - check variable values at the top
* buildImages copies all the images from img folder in assets while ignoring images inside raw folder if any
*/
gulp.task('buildFiles', function() {
	return 	gulp.src(buildInclude)
	.pipe(gulp.dest(build))
	.pipe(plumber({errorHandler: onError}))
	.pipe(notify({ message: 'Copy from buildFiles complete', onLast: true }));
});


/**
* Images
*
* Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task('buildImages', function() {
	return 	gulp.src(['assets/img/**/*', '!assets/images/raw/**'])
	.pipe(gulp.dest(build+'assets/img/'))
	.pipe(plumber({errorHandler: onError}))
	.pipe(plugins.notify({ message: 'Images copied to buildTheme folder', onLast: true }));
});

/**
* Zipping build directory for distribution
*
* Taking the build folder, which has been cleaned, containing optimized files and zipping it up to send out as an installable theme
*/
gulp.task('buildZip', function () {
	// return 	gulp.src([build+'/**/', './.jshintrc','./.bowerrc','./.gitignore' ])
	return 	gulp.src(build+'/**/')
	.pipe(zip(json.name+'.zip'))
	.pipe(gulp.dest('./'))
	.pipe(plumber({errorHandler: onError}))
	.pipe(notify({ message: 'Zip task complete', onLast: true }));
});

// ==== TASKS ==== //
/**
* Gulp Default Task
*
* Compiles styles, fires-up browser sync, watches js and php files. Note browser sync task watches php files
*
*/
// Package Distributable Theme
gulp.task('build', function(cb) {
	runSequence('styles', 'stylesheetheader', 'cleanup', 'scripts',  'buildFiles', 'buildImages', 'buildZip',/*'cleanupFinal',*/ cb);
});

// Watch Task
gulp.task('default', ['styles', 'scripts', 'images', 'browser-sync'], function () {
	gulp.watch('./src/img/raw/**/*', ['images']);
	gulp.watch('./src/scss/**/*.scss', ['styles', browserSync.reload]);
	gulp.watch('./bower_components/bootstrap-sass/assets/**/*.scss', ['styles', browserSync.reload]);
	gulp.watch('./src/js/**/*.js', ['scripts', browserSync.reload]);
});