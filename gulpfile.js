/**
 * Gulpfile setup
 *
 * @since 	1.0.0
 * @authors Waylon Fourie
 * @package grafipress2017
 *
 * SETUP STEPS
 * 1. Run npm install
 * 2. Run npm install -g gulp
 * 3. Run npm install --save-dev gulp
 * 4. Run npm install npm install --save-dev browser-sync gulp-autoprefixer gulp-clean-css gulp-filter gulp-uglify gulp-imagemin gulp-newer gulp-rename gulp-concat gulp-notify gulp-run-sequence gulp-sass gulp-load-plugins 	gulp-ignore gulp-rimraf gulp-zip gulp-plumber gulp-cache gulp-sourcemaps gulp-todo gulp-wp-pot gulp-sort gulp-replace gulp-trimlines gulp-util vinyl-ftp gulp-download gulp-uglifycss gulp-shorthand npm-check-updates gulp-bower-update-all gulp-line-ending-corrector gulp-merge-media-queries gulp-if
 * 5. Run npm-check-updates
 */

function titleCase(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

// Project configuration
var fs 				= require( 'fs' ),
	json 			= JSON.parse( fs.readFileSync( './package.json' ) ),
	url 			= json.name+'.dev',
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
						'!**/Gruntfile.js',
						'!**/_*.*', // Ignore all files starting with an underscore
					],
	theme 			= [
		name 			= json.name,
		uri 			= 'www.grafika.co.za',
		author 			= 'Waylon Fourie',
		author_uri 		= 'http://www.grafika.co.za',
		description 	= 'Custom theme created by Grafika for Star Signs & Customs',
		version 		= '1.0',
		license 		= 'gnu general public license v2 or later',
		license_uri 	= 'http://www.gnu.org/licenses/gpl-2.0.html',
		tags 			= 'orange, dark, two-columns, left-sidebar, right-sidebar, fluid-layout, flexable-header, responsive-layout, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images, theme-options, translation-ready',
		textdomain 		= 'grafipress17',
	],
	liveHost 		= 'starsignssa.com',
	liveUser 		= 'starskub',
	livePass 		= '!Sta@Grafika@bsv510mp!',
	liveUrl 		= 'public_html/ssc_site/wp-content/themes/'+name+'/',
	bower 			= './bower_components/',
	build 			= './dist/',

	// Plugins
	gulp     	 	= require( 'gulp' ),
	browserSync  	= require( 'browser-sync').create(),
	reload       	= browserSync.reload,
	autoprefixer 	= require( 'gulp-autoprefixer' ),
	cleanCSS    	= require( 'gulp-clean-css' ),
	filter       	= require( 'gulp-filter' ),
	uglify       	= require( 'gulp-uglify' ),
	imagemin     	= require( 'gulp-imagemin' ),
	newer        	= require( 'gulp-newer' ),
	rename       	= require( 'gulp-rename' ),
	concat       	= require( 'gulp-concat' ),
	notify       	= require( 'gulp-notify' ),
	mmq 			= require( 'gulp-merge-media-queries'),
	runSequence  	= require( 'gulp-run-sequence' ),
	sass         	= require( 'gulp-sass' ),
	plugins      	= require( 'gulp-load-plugins')( { camelize: true } ),
	ignore       	= require( 'gulp-ignore' ),
	rimraf       	= require( 'gulp-rimraf' ),
	zip          	= require( 'gulp-zip' ),
	plumber      	= require( 'gulp-plumber' ),
	cache        	= require( 'gulp-cache' ),
	sourcemaps   	= require( 'gulp-sourcemaps' ),
	todo   			= require( 'gulp-todo' ),
	wpPot			= require( 'gulp-wp-pot' ),
	sort 			= require( 'gulp-sort' ),
	replace 		= require( 'gulp-replace' ),
	trimlines 		= require( 'gulp-trimlines' ),
	gutil 			= require( 'gulp-util' ),
	sync 			= require( 'vinyl-ftp' ),
	download 		= require( 'gulp-download' ),
	cssnano 		= require( 'gulp-cssnano' ),
	shorthand 		= require( 'gulp-shorthand' ),
	bowerupdate 	= require( 'gulp-bower-update-all' ),
	gulpif 			= require( 'gulp-if' ),
	lineec 			= require( 'gulp-line-ending-corrector'),
	stripComments   = require( 'gulp-strip-css-comments'),
	insert 			= require( 'gulp-insert'),
	csscomb 		= require( 'gulp-csscomb'),
	production 		= !!gutil.env.production;

	console.log( 'Production Environment: '+gutil.env.production );

	onError = function (err) { 
		console.log( 'ERROR: ', gutil.colors.bgRed( err.message ) );
  		gutil.beep();
  		this.emit( 'end');
	};

/**
 * Browser Sync
 *
 * Asynchronous browser syncing of assets across multiple devices!! Watches for changes to js, image and php files
 * Although, I think this is redundant, since we have a watch task that does this already.
 */
gulp.task( 'browser-sync', function() {
	browserSync.init( ['**/*.php', '**/*.css', '**/*.{png,jpg,gif,svg}', '**/*.js'], { proxy: name+'.dev', port: 3000, } );
});

/**
 * Bower update
 *
 * Force updates to the latest version of your bower dependencies. It does this synchronously to allow for
 * updates to complete before executing dependent gulp tasks.
 */
gulp.task( 'bowerupdate', function () {
    return gulp.src( 'bower.json' )
      .pipe( bowerupdate( true ) )
      .on( 'error', function (e) { gulpUtil.log(e); })
      .pipe( notify( {  message: 'Bower packages have been updated', onLast: true } ) );
});

/**
 * Copy Fonts
 *
 * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
 */
gulp.task( 'fonts', function() {
   gulp.src( './bower_components/font-awesome/fonts/**/*.*' )
   .pipe( gulp.dest( './fonts' ) )
   .pipe( notify( {  message: 'Font files have been downloaded and copied to font directory', onLast: true } ) );
});

/**
 * Download external files
 *
 * Download external files from Github
 */
gulp.task( 'download', function() {
   download( 'https://github.com/garand/sticky/raw/master/jquery.sticky.js' )
   .pipe( gulp.dest( bower+'sticky/' ) );
   download( 'https://raw.githubusercontent.com/twittem/wp-bootstrap-navwalker/master/wp_bootstrap_navwalker.php' )
   .pipe( gulp.dest( './lib/' ) );
   download( 'https://raw.githubusercontent.com/TGMPA/TGM-Plugin-Activation/develop/class-tgm-plugin-activation.php' )
   .pipe( gulp.dest( './lib/tgm/' ) );
   download( 'https://raw.githubusercontent.com/TGMPA/TGM-Plugin-Activation/develop/languages/tgmpa.pot' )
   .pipe( gulp.dest( './lib/tgm/languages/' ) );
   download( 'https://raw.githubusercontent.com/SylvainMarty/wordpress-bootstrap-breadcrumb/master/bootstrap-breadcrumb.php' )
   .pipe( gulp.dest( './lib/' ) )
   .pipe( notify( {  message: 'External library files have been downloaded and copied to the required locations', onLast: true } ) );
});

/**
 * Copy Images
 *
 * Copy images supplied with libraries to the images folder
 */
gulp.task( 'copyimages', function() {
   gulp.src( [
   	bower+'swipebox/src/img/**/*.{png,gif,jpg,svg}',
   	'/src/img/**/*.{png,gif,jpg,svg}'
    ])
   	.pipe( plumber( { errorHandler: onError } ) )
	.pipe( imagemin( { optimizationLevel: 7, progressive: true, interlaced: true } ) )
	.pipe( newer( './img/' ) )
   	.pipe( gulp.dest( './img' ) )
   	.pipe( notify( {  message: 'Images have been copied to the required locations', onLast: true } ) );
});

/**
 * Populate Theme Stylesheet header
 *
 * Open the main theme WordPress styleshhet and populate values as set in package.json
 */
gulp.task( 'stylesheetheader', function() {
   gulp.src( './style.css')
   .pipe( replace( '{THEME-NAME}', titleCase(json.name ) ) )
   .pipe( replace( '{THEME-URI}', json.repository.url  ) )
   .pipe( replace( '{THEME-AUTHOR}', titleCase(json.author ) ) )
   .pipe( replace( '{AUTHOR-URI}', json.homepage ) )
   .pipe( replace( '{THEME-DESCRIPTION}', json.description ) )
   .pipe( replace( '{THEME-VERSION}', json.version ) )
   .pipe( replace( '{THEME-LICENSE}', json.license ) )
   .pipe( replace( '{THEME-LICENSE-URI}', json.license ) )
   .pipe( replace( '{THEME-TAGS}', json.keywords ) )
   .pipe( replace( '{TEXTDOMAIN}', textdomain ) )
   .pipe( gulp.dest( './' ) )
   .pipe( notify( {  message: 'Stylesheet header has been populated', onLast: true } ) );
});

gulp.task( 'editorstyles', function() {
   gulp.src( './css/editor-style.css')
   .pipe( replace( '{PARENTSTYLESHEET}', json.name+'-styles.min.css' ) )
   .pipe( stripComments( { preserve: false }) )
   .pipe( production ? csscomb( './src/gulpconfigs/.csscomb.json') : gutil.noop() )
   .pipe( lineec() )
   .pipe( cssnano( { discardComments: { removeAll: true } } ) )
   .pipe( gulp.dest( './css/' ) )
   .pipe( notify( {  message: 'Editor stylesheet file has been updated', onLast: true } ) );
});

/**
 * Theme Styles
 *
 * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
 */
gulp.task( 'styles', function () {
 	gulp.src( './src/scss/main.scss' )
 	.pipe( sourcemaps.init() )
	.pipe( plumber( { errorHandler: onError } ) )
	.pipe( sass( { errLogToConsole: true, outputStyle: 'nested', precision: 10 } ) )
	.pipe( sourcemaps.write ( './' ) )
	.pipe( plumber.stop() )
	.pipe( production ? stripComments( { preserve: false }) : gutil.noop())
	.pipe( production ? mmq() : gutil.noop() )
	.pipe( production ? autoprefixer( 'last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4' ) : gutil.noop() )
	.pipe( production ? shorthand() : gutil.noop() )
	.pipe( production ? csscomb( './src/gulpconfigs/.csscomb.json') : gutil.noop() )
	.pipe( production ? lineec() : gutil.noop() )
	.pipe( rename( { basename: json.name + '-styles' } ) )
	.pipe( gulp.dest( './css/' ) )
	.pipe( production ? cssnano( { discardComments: { removeAll: true } } ) : gutil.noop() )
	.pipe( filter( '**/*.css' ) )
	.pipe( rename( { suffix: '.min' } ) )
	.pipe( gulp.dest( './css/') )
	//.pipe( reload( { stream: true } ) )
	.pipe( browserSync.stream() )
	.pipe( notify( { message: 'Styles task complete', onLast: true } ) );
});

/**
 * Scripts: Vendors
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/
gulp.task( 'scripts', function() {
	return 	gulp.src([
		bower+'bootstrap/dist/js/bootstrap.js',
		//bower+'/bootstrap-sass/assets/javascripts/bootstrap/**/*.js'
		bower+'bootstrap-hover-dropdown/bootstrap-hover-dropdown.js',
		bower+'sticky/jquery.sticky.js',
		bower+'scroll-to-top/jquery.scrollToTop.js',
		bower+'swipebox/src/js/jquery.swipebox.js',
		//bower+'wow/dist/wow.js',
		//bower+'PACE/pace.js',
		/*bower+'Morphext/dist/morphext.js',*/
		'./src/js/parallax.js',
		'./src/js/jquery.final-countdown.js',
		'./src/js/kinetic.js',
		/*bower+'smoothstate/src/jquery.smoothState.js',*/
		bower+'owl.carousel/dist/owl.carousel.min.js',
		'./src/js/footer_scripts.js'
	])
	.pipe( plumber( { errorHandler: onError } ) )
	.pipe( concat( json.name+'-scripts.js' ) )
	.pipe( gulp.dest( './js/' ) )
	.pipe( rename( { suffix: '.min' } ) )
	.pipe( production ? uglify() : gutil.noop() )
	.pipe( gulp.dest( './js/' ) )
	//.pipe( reload( { stream: true } ) )
	.pipe( browserSync.stream() )
	.pipe( notify( { message: 'Scripts task complete', onLast: true } ) );
});

/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
 */
gulp.task( 'images', function() {
	return gulp.src( [
		'./src/img/**/*.{png,jpg,gif,svg}'
	] )
	.pipe( plumber( { errorHandler: onError } ) )
	.pipe( newer( './img/' ) )
	.pipe( imagemin( { optimizationLevel: 7, progressive: true, interlaced: true } ) )
	.pipe( gulp.dest( './img/') )
	.pipe( notify( { message: 'Images task complete', onLast: true } ) );
});

/**
 * Generate @TODO
 * 
 * Generate a TODO.md file from comments of files in stream.
 */
gulp.task( 'todo', function() {
    return gulp.src([
		// Include common file types
		build+'**/*.php',
		build+'**/*.html',
		build+'**/*.css',
		build+'**/*.js',
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
    .pipe( todo() )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( gulp.dest( './' ) )
    .pipe( notify( {  message: 'TODO file has been created', onLast: true } ) );
});

/**
 * Generate POT files
 * 
 * Generate pot-files for WordPress localization.
 */
gulp.task( 'settextdomain', function() {
  	gulp.src( build+'**/*.*' )
	.pipe( replace( '\''+textdomain+'\'', '\'TEXTDOMAIN\'' ) )
	.pipe( plumber( { errorHandler: onError } ) )
	.pipe( gulp.dest( './' ) )
	.pipe( notify( {  message: 'Translation textdomain strings have been replaced', onLast: true } ) );
});

/**
 * Trimlines
 * 
 * Removes the trailing whitespace at the end of each line in a string.
 */
gulp.task( 'trimlines', function () {
	gulp.src( build+'**/*.php')
 	.pipe(trimlines( { leading: false } ) )
 	.pipe(plumber( { errorHandler: onError} ) )
 	.pipe(gulp.dest( './' ) )
 	.pipe( notify( {  message: 'Lines have been trimmed', onLast: true } ) );
});

/**
 * Gulp translate function
 */
gulp.task( 'translate', function () {
	return gulp.src([
		// Include common file types
		build+'**/*.*',
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
	.pipe( plumber( { errorHandler: onError} ) )
	.pipe( wpPot( { domain: json.name, destFile: json.name+'.pot', package: json.name, bugReport: json.bugs.url, lastTranslator: json.author }  ) )
	.pipe( gulp.dest( 'languages' ) )
	.pipe( notify( {  message: 'Translation files generated', onLast: true } ) );
});

gulp.task( 'deployDev', function() {
    var conn = sync.create( { host:liveHost, user:liveUser, password:livePass, parallel: 3, log: gutil.log } );
    return gulp.src( buildInclude, { buffer: false } )
        .pipe( conn.newer( liveUrl ) )
        .pipe( conn.dest( liveUrl ) )
        .pipe( notify( {  message: 'Files synced to live server', onLast: true } ) );
});

/**
* Clean gulp cache
*/
gulp.task( 'clear', function () {
	cache.clearAll();
});

/**
* Clean tasks for zip
*
* Being a little overzealous, but we're cleaning out the build folder, codekit-cache directory and annoying DS_Store files and Also
* clearing out unoptimized image files in zip as those will have been moved and optimized
*/
gulp.task( 'cleanup', function() {
	return gulp.src(['./src/bower_components', '**/.sass-cache','**/.DS_Store'], { read: false }) // much faster
	.pipe(ignore( 'node_modules/**' ) ) //Example of a directory to ignore
	.pipe(rimraf( {  force: true } ) )
	.pipe(plumber( { errorHandler: onError} ) )
	.pipe( notify( {  message: 'Clean task complete', onLast: true } ) );
});

/**
* Build task that moves essential theme files for production-ready sites
*
* buildFiles copies all the files in buildInclude to build folder - check variable values at the top
* buildImages copies all the images from img folder in assets while ignoring images inside raw folder if any
*/
gulp.task( 'buildFiles', function() {
	return gulp.src( buildInclude )
	.pipe( gulp.dest( build ) )
	.pipe( plumber( { errorHandler: onError} ) )
	.pipe( notify( {  message: 'Copy from buildFiles complete', onLast: true } ) );
});

/**
* Images
*
* Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task( 'buildImages', function() {
	return 	gulp.src(['assets/img/**/*', '!assets/images/raw/**'])
	.pipe( gulp.dest(build+'assets/img/' ) )
	.pipe( plumber( { errorHandler: onError} ) )
	.pipe( plugins.notify( {  message: 'Images copied to buildTheme folder', onLast: true } ) );
});

/**
* Zipping build directory for distribution
*
* Taking the build folder, which has been cleaned, containing optimized files and zipping it up to send out as an installable theme
*/
gulp.task( 'buildZip', function () {
	// return 	gulp.src([build+'/**/', './.jshintrc','./.bowerrc','./.gitignore' ])
	return 	gulp.src( build+'**/' )
	.pipe( zip( json.name+'.zip' ) )
	.pipe( gulp.dest( './' ) )
	.pipe( plumber( { errorHandler: onError} ) )
	.pipe( notify( {  message: 'Zip task complete', onLast: true } ) );
});

// ==== TASKS ==== //
/**
* Gulp Default Task
*
* Compiles styles, fires-up browser sync, watches js and php files. Note browser sync task watches php files
*
*/
// Package Distributable Theme
gulp.task( 'build', function(cb) {
	runSequence( 'styles', 'editorstyles', 'stylesheetheader', 'scripts', 'buildFiles', 'buildImages', /*'translate',*/ 'settextdomain', 'todo', 'trimlines', 'cleanup', 'buildZip' );
});

// Watch Task
gulp.task( 'default', ['styles', 'scripts', 'images', 'watch', 'browser-sync']);

gulp.task( 'watch', function() {
	gulp.watch( './src/img/**/*.{png,jpg,gif,svg}', ['images']);
	gulp.watch( '*.php', browserSync.reload);
	gulp.watch( './src/scss/**/*.scss', ['styles']);
	gulp.watch( './bower_components/bootstrap-sass/assets/**/*.scss', ['styles']);
	gulp.watch( './src/js/**/*.js', ['scripts']);
});
