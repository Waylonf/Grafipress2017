<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 */
if ( ! function_exists( 'grafipress_setup' ) ) :
	function grafipress_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Sixteen, use a find and replace
		 * to change 'TEXTDOMAIN' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'TEXTDOMAIN', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );
		add_image_size ( 
			$name 	= 'square_thumbnail',
			$width 	= 600,
			$height = 600,
			$crop 	= true 
		);

		add_image_size ( 
			$name 	= 'logo',
			$width 	= 300,
			$height = 85,
			$crop 	= true 
		);

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'TEXTDOMAIN' ),
			'footer'  => __( 'Footer Menu', 'TEXTDOMAIN' ),
			'social'  => __( 'Social Links Menu', 'TEXTDOMAIN' ),
		) );

		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Declare WooCommerce support
		 */
		add_theme_support( 'woocommerce' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		//add_editor_style( array( 'css/editor-style.css', grafipress_fonts_url() ) );
		add_editor_style( 'css/editor-style.css' );

	}
endif;
add_action( 'after_setup_theme', 'grafipress_setup' );

/**
 * Add additional features and theme support for pages.
 *
 * This function defines the features set specifically for
 * pages in the Wordpress theme.
 */
if( ! function_exists( 'gws_page_support' ) ) :
	function gws_page_support() {
    	add_post_type_support( 'page', 'excerpt' );
	}
endif;
add_action( 'init', 'gws_page_support' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Grafipress 1.0
 */
function grafipress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'grafipress_content_width', 840 );
}
add_action( 'after_setup_theme', 'grafipress_content_width', 0 );

/**
 * Register Google fonts for Grafipress.
 *
 * Create your own grafipress_fonts_url() function to override in a child theme.
 *
 * @since Grafipress 1.0
 *
 * @return string Google fonts URL for the theme.
 */
if ( ! function_exists( 'grafipress_fonts_url' ) ) :
	function grafipress_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'TEXTDOMAIN' ) ) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}

		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'TEXTDOMAIN' ) ) {
			$fonts[] = 'Montserrat:400,700';
		}

		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'TEXTDOMAIN' ) ) {
			$fonts[] = 'Inconsolata:400';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function grafipress_scripts() {

	global $wp_styles;

	// Assign the Storefront version to a var
	$theme 			= wp_get_theme();
	$theme_name 	= strtolower( $theme );
	$theme_version 	= $theme['Version'];

	$protocol = 'http:';
	if( isset( $_SERVER[ 'HTTPS' ] ) == 'on' )  :
		$protocol = 'https:';
	endif;

	// Unregister jquery-migrate.js
	wp_deregister_script(
		$handle 	= 'jquery-migrate.min'
	);

	// Unregister comment-reply.min.js
	wp_deregister_script(
		$handle 	= 'comment-reply.min'
	);

	// Add custom fonts, used in the main stylesheet.
	/*wp_enqueue_style(
		$handle 	= 'grafipress-fonts',
		$src 		= grafipress_fonts_url(),
		$deps 		= array(),
		$ver 		= '',
		$media 		= null
	);
*/
	// Add Genericons, used in the main stylesheet.
	/*wp_enqueue_style(
		$handle 	= 'genericons',
		$src 		= get_template_directory_uri() . '/genericons/genericons.css',
		$deps 		= array(),
		$ver 		= '3.4.1',
		$media 		= null
	);*/

	// Load Bootstrap stylesheet from CDN.
	if ( true == get_option( 'bootstrap_styles_cdn', true ) ) :
		wp_enqueue_style(
			$handle 	= 'bootstrap-styles-cdn',
			$src 		= $protocol . '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css',
			$deps 		= null,
			$ver 		= null,
			$media 		= null
		);
	endif;

	// Load Fontawesome stylesheet.
	if ( true == get_option( 'fontawesome_styles_cdn', true ) ) :
	wp_enqueue_style(
		$handle 	= 'fontawesome',
		$src 		= $protocol . '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
		$deps 		= null,
		$ver 		= null,
		$media 		= null
	);
	endif;

	// Theme stylesheet.
	wp_enqueue_style(
		$handle 	= $theme_name . '-styles',
		$src 		= get_stylesheet_directory_uri() . '/css/' . $theme_name . '-styles.min.css',
		$deps 		= array(),
		$ver 		= $theme_version,
		$media 		= null
	);

	// Load the Internet Explorer specific stylesheet.
	if ( true == get_option( 'load_ie_styles', true ) ) :
		wp_enqueue_style(
			$handle 	= $theme_name . '-ie',
			$src 		= get_template_directory_uri() . '/css/' . $theme_name . '-ie.css',
			$deps 		= array( $theme_name .'-styles' ),
			$ver 		= $theme_version,
			$media 		= null
		);

		// Add conditional markup to grafipress-ie.css script tag
		wp_style_add_data(
			$handle 	= $theme_name . '-ie',
			$key 		= 'conditional',
			$value 		= 'lt IE 10'
		);

		// Load the Internet Explorer 8 specific stylesheet.
		wp_enqueue_style(
			$handle 	= $theme_name . '-ie8',
			$src 		= get_template_directory_uri() . '/css/' . $theme_name . '-ie8.css',
			$deps 		= array( $theme_name .'-styles' ),
			$ver 		= $theme_version,
			$media 		= null
		);

		// Add conditional markup to grafipress-ie8 style tag
		wp_style_add_data(
			$handle 	= $theme_name . '-ie8',
			$key 		= 'conditional',
			$value 		= 'lt IE 9'
		);

		// Load the Internet Explorer 7 specific stylesheet.
		wp_enqueue_style(
			$handle 	= $theme_name . '-ie7',
			$src 		= get_template_directory_uri() . '/css/' . $theme_name . '-ie7.css',
			$deps 		= array( $theme_name .'-styles' ),
			$ver 		= $theme_version,
			$media 		= null
		);

		// Add conditional markup to grafipress-ie7 style tag
		wp_style_add_data(
			$handle 	= $theme_name . '-ie7',
			$key 		= 'conditional',
			$value 		= 'lt IE 8'
		);
	endif;
	
	// Load the respond.js.
	// TODO Check if resond.js is dependant on jQuery or not.
	if ( true == get_option( 'respondjs_cdn', true ) ) :
		wp_enqueue_script(
			$handle 	= $theme_name . '-respond',
			$src 		= $protocol . '//oss.maxcdn.com/respond/1.4.2/respond.min.js',
			$deps 		= null,
			$ver 		= null,
			$in_footer 	= false
		);
	else: 
		wp_enqueue_script(
			$handle 	= $theme_name . '-respond',
			$src 		= get_template_directory_uri() . '/js/respond.min.js',
			$deps 		= null,
			$ver 		= '3.7.3',
			$in_footer 	= false
		);
	endif;

	wp_script_add_data(
		$handle 	= $theme_name . '-respond',
		$key 		= 'conditional',
		$value 		= 'lt IE 9'
	);

	// Load html5shiv.js
	// TODO Check if HTML5 Shiv is dependant on jQuery or not.
	if ( true == get_option( 'html5shiv_cdn', true ) ) :
		wp_enqueue_script(
			$handle 	= $theme_name . '-html5shiv',
			$src 		= $protocol . '//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js',
			$deps 		= null,
			$ver 		= null,
			$in_footer 	= false
		);
	else :
		// TODO Set Gulpfile to copy minified html5shiv to js folder as theme fallback
		wp_enqueue_script(
			$handle 	= $theme_name . '-html5shiv',
			$src 		= get_template_directory_uri() . '/js/html5.min.js',
			$deps 		= null,
			$ver 		= '3.7.3',
			$in_footer 	= false
		);

	endif;

	// Add conditional markup to html5.js script tag
	wp_script_add_data(
		$handle 	= $theme_name . '-html5shiv',
		$key 		= 'conditional',
		$value 		= 'lt IE 9'
	);

	// Unregister jQuery that comes with WordPress
    wp_deregister_script(
    	$handle 	= 'jquery'
	);

    if ( true == get_option( 'google_jquery', true ) ) :
		// Register the copy of jQuery that from Google CDN
	    // The last parameter set to FALSE states that it should  NOT be loaded
	    // in the footer.
		wp_enqueue_script(
			$handle 	= 'jquery',
			$src 		= $protocol . '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
			$deps 		= null,
			$ver 		= '1.11.1',
			$in_footer 	= false
		);
	else :
		// Register the copy of jQuery that comes with WordPress again
	    // The last parameter set to FALSE states that it should  NOT be loaded
	    // in the footer.
	    wp_register_script(
	    	$handle 	= 'jquery',
	    	$src 		= '/wp-includes/js/jquery/jquery.js',
	    	$deps 		= null,
	    	$ver 		= '1.11.3',
	    	$in_footer 	= false
		);

		// Load the newly re-regitered bundled version of jQuery
		wp_enqueue_script(
    		$handle 	= 'jquery'
		);
	endif;    

	if ( true == get_option( 'skip_link_focus', true ) ) :
		// load skip-link-focus script in footer.
		// TODO Create and deploy default skip link focus file.
		wp_enqueue_script(
			$handle 	= $theme_name . '-skip-link-focus-fix',
			$src 		= get_template_directory_uri() . '/js/skip-link-focus-fix.js',
			$deps 		= array('jQuery'),
			$ver 		= '20151112',
			$in_footer 	= false
		);
	endif;

	if ( true == get_option( 'owl_carousel_cdn_assets', false ) ) :
		// load owl carousel script in footer.
		wp_enqueue_script(
			$handle 	= 'owl-carousel',
			$src 		= 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js',
			$deps 		= null,//array('jQuery'),
			$ver 		= '1.3.3',
			$in_footer 	= false
		);

		wp_enqueue_style(
			$handle 	= 'owl-carousel',
			$src 		= 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css',
			$deps 		= null,//array( $theme_name .'-styles' ),
			$ver 		= '1.3.3',
			$media 		= null
		);
	endif;
		wp_enqueue_script(
			$handle 	= 'owl-carousel',
			$src 		= get_template_directory_uri() . '/js/owl.carousel.min.js',
			$deps 		= null,//array('jQuery'),
			$ver 		= '1.3.3',
			$in_footer 	= true
		);
	

	if ( true == get_option( 'bootstrap_scripts_cdn', true ) ) :
		wp_enqueue_script(
			$handle 	= 'bootstrap-scripts-cdn',
			$src 		= 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
			$deps 		= array('jquery'),
			$ver 		= '3.3.6',
			$in_footer 	= true
		);
	endif;

	wp_enqueue_script(
		$handle 	= $theme_name . '-scripts',
		$src 		= get_template_directory_uri() . '/js/' . $theme_name . '-scripts.min.js',
		$deps 		= array('jquery'),
		$ver 		= $theme_version,
		$in_footer 	= true
	);


}
add_action( 'wp_enqueue_scripts', 'grafipress_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Grafipress 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function grafipress_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'grafipress_body_classes' );

/**
 * Set default site icon
 *
 * @since Grafipress 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function grafipress_default_site_icon() {
	if ( has_site_icon() ) :
		return;
	else :
		$icon_path = esc_url( get_stylesheet_directory_uri() . '/img/defaults' );

		// Use Iconifyer to generate all the favicons and touch icons you need: http://iconifier.net
		$icons[] = '<link rel="apple-touch-icon" sizes="57x57" href="' . $icon_path . '/apple-touch-icon-57x57.png">';
		$icons[] = '<link rel="apple-touch-icon" sizes="60x60" href="' . $icon_path . '/apple-touch-icon-60x60.png">';
		$icons[] = '<link rel="apple-touch-icon" sizes="72x72" href="' . $icon_path . '/apple-touch-icon-72x72.png">';
		$icons[] = '<link rel="apple-touch-icon" sizes="76x76" href="' . $icon_path . '/apple-touch-icon-76x76.png">';
		$icons[] = '<link rel="apple-touch-icon" sizes="114x114" href="' . $icon_path . '/apple-touch-icon-114x114.png">';
		$icons[] = '<link rel="apple-touch-icon" sizes="120x120" href="' . $icon_path . '/apple-touch-icon-120x120.png">';
		$icons[] = '<link rel="apple-touch-icon" sizes="144x144" href="' . $icon_path . '/apple-touch-icon-144x144.png">';
		$icons[] = '<link rel="apple-touch-icon" sizes="152x152" href="' . $icon_path . '/apple-touch-icon-152x152.png">';
		$icons[] = '<link rel="apple-touch-icon" sizes="180x180" href="' . $icon_path . '/apple-touch-icon-180x180.png">';
		$icons[] = '<link rel="icon" type="image/png" href="' . $icon_path . '/favicon-32x32.png" sizes="32x32">';
		$icons[] = '<link rel="icon" type="image/png" href="' . $icon_path . '/favicon-194x194.png" sizes="194x194">';
		$icons[] = '<link rel="icon" type="image/png" href="' . $icon_path . '/favicon-96x96.png" sizes="96x96">';
		$icons[] = '<link rel="icon" type="image/png" href="' . $icon_path . '/android-chrome-192x192.png" sizes="192x192">';
		$icons[] = '<link rel="icon" type="image/png" href="' . $icon_path . '/favicon-16x16.png" sizes="16x16">';
		// TODO Setup Gulp task to generate default manifest.json file for Favicons
		//$icons[] = '<link rel="manifest" href="' . $icon_path . '/manifest.json">';
		//$icons[] = '<link rel="shortcut icon" href="' . $icon_path . '/favicon.ico">';
		$icons[] = '<meta name="msapplication-TileColor" content="#ba122a">';
		$icons[] = '<meta name="msapplication-TileImage" content="' . $icon_path . '/mstile-144x144.png">';
		// TODO Setup Gulp task to generate default browserconfig.xml file for Favicons
		//$icons[] = '<meta name="msapplication-config" content="' . $icon_path . '/browserconfig.xml">';
		// TODO Setup gulp to do a replace and replace the theme color meta tag with the bootstrap primary color variable.
		$icons[] = '<meta name="theme-color" content="#ba122a">';

        foreach ( $icons as $icon ) :
        	echo $icon . "\n";
        endforeach;
	endif;  

}
add_action( 'wp_head', 'grafipress_default_site_icon');

/**
 * Add extra site icon sizes
 *
 * Wordpress provides 32x32 favicon, 180x180 iOS app icon, 192x192 Android/Chrome
 * app icon and 270x270px medium-sized tile for Windows by default.
 *
 * @since Grafipress 1.0
 *
 * @param array $sizes.
 * @return array of added image sizes.
 */
function grafipress_custom_site_icon_size( $sizes ) {

    $sizes[] = 16;
    $sizes[] = 57;
    $sizes[] = 57;
    $sizes[] = 60;
    $sizes[] = 72;
    $sizes[] = 76;
    $sizes[] = 96;
    $sizes[] = 114;
    $sizes[] = 120;
    $sizes[] = 144;
    $sizes[] = 152;
    $sizes[] = 194;

   return $sizes;
}
add_filter( 'site_icon_image_sizes', 'grafipress_custom_site_icon_size' );

function grafipress_custom_site_icon_tag( $meta_tags ) {
	$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="57x57" href="%s"/>', esc_url( get_site_icon_url( 57, null ) ) );
	$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="60x60" href="%s"/>', esc_url( get_site_icon_url( 60, null ) ) );
	$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="72x72" href="%s"/>', esc_url( get_site_icon_url( 72, null ) ) );
	$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="76x76" href="%s"/>', esc_url( get_site_icon_url( 76, null ) ) );
	$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="114x114" href="%s"/>', esc_url( get_site_icon_url( 114, null ) ) );
	$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="120x120" href="%s"/>', esc_url( get_site_icon_url( 120, null ) ) );
	$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="144x144" href="%s"/>', esc_url( get_site_icon_url( 144, null ) ) );
	$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="152x152" href="%s"/>', esc_url( get_site_icon_url( 152, null ) ) );
	$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="180x180" href="%s"/>', esc_url( get_site_icon_url( 180, null ) ) );
	$meta_tags[] = sprintf( '<link rel="icon" type="image/png" href="%s"/>', esc_url( get_site_icon_url( 32, null ) ) );
	$meta_tags[] = sprintf( '<link rel="icon" type="image/png" href="%s"/>', esc_url( get_site_icon_url( 194, null ) ) );
	$meta_tags[] = sprintf( '<link rel="icon" type="image/png" href="%s"/>', esc_url( get_site_icon_url( 96, null ) ) );
	$meta_tags[] = sprintf( '<link rel="icon" type="image/png" href="%s"/>', esc_url( get_site_icon_url( 192, null ) ) );
	$meta_tags[] = sprintf( '<link rel="icon" type="image/png" href="%s"/>', esc_url( get_site_icon_url( 16, null ) ) );

   return $meta_tags;
}
add_filter( 'site_icon_meta_tags', 'grafipress_custom_site_icon_tag' );