<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * WARNING: This file is part of the core {THEME-NAME} framework. DO NOT edit this
 * file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * This file contains functions that may be included into the theme package. They are
 * placed withing this file for testing and separated from the production files 
 * for debugging. This file is bypassed by default if the DEBUG constant is set to false.
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 */

/**
 * Remove login scripts
 *
 * Remove WordPress login stylesheets and avoid the style tag from loading.
 * @todo Check and confirm this works 100%
 */
if ( basename($_SERVER['PHP_SELF']) == 'wp-login.php' )
    add_action( 'style_loader_tag', create_function( '$a', "return null;" ) );

function your_login_stylesheet() { ?>
   <link rel="stylesheet" href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/login-styles.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'your_login_stylesheet' );

/**
 * Add inline scripts
 *
 * Add inline scripts.
 * @see 	http://wordpress.stackexchange.com/questions/24851/wp-enqueue-inline-script-due-to-dependancies
 * @todo 	Check and confirm this works 100%
 */
function print_script_once() {
    if( ! wp_script_is( 'my-handle', 'done' ) ) :
        echo "<script>alert('once!');</script>";
        global $wp_scripts;
        $wp_scripts->done[] = 'my-handle';
    endif;
}
add_action( 'get_footer', 'print_script_once' );

/**
 * Add inline styles
 *
 * Add inline styles.
 * @see 	http://wordpress.stackexchange.com/questions/24851/wp-enqueue-inline-script-due-to-dependancies
 * @todo 	Check and confirm that tabs are correct
 */
function my_styles_method() {
	wp_enqueue_style(
		$handle = 'inline-style',
		$src 	= get_template_directory_uri() . '/css/custom_script.css'
	);
    
    // Required variables   
    $tab 			= '';
	$formatted_css 	= '';

	// Inline CSS rules
    $css[] = ".mycolor{";
	$css[] = "\t" . "background: #ba122a;";
	$css[] = "}";

	// Format CSS as lines
	foreach ( $css as $line ) :
		$formatted_css .= $line . "\r\n";
	endforeach;
    
    wp_add_inline_style( 'inline-style', $formatted_css );
}
add_action( 'wp_enqueue_scripts', 'my_styles_method' );