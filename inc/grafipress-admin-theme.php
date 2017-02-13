<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * WARNING: This file is part of the core {THEME-NAME} framework. DO NOT edit this
 * file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * This file contains functions required to generate custom admin themes.
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 * @todo 		Check if file exists before running this class
 */
class GWS_Color_Schemes {

	private $colors = array( 'grafika' );

	function __construct() {
		add_action( 'admin_init' , array( $this, 'add_colors' ) );
	}

	function add_colors() {
		$suffix = is_rtl() ? '-rtl' : '';

		wp_admin_css_color(
			$key 	= 'grafika',
			$name 	= __( 'Grafika', 'TEXTDOMAIN' ),
			$url 	= trailingslashit( get_template_directory_uri() ) . 'css/admin' . $suffix . '.min.css',
			$colors = array( '#301D25', '#462b36', '#d3995d', '#eabe3f' ),

			$icons 	= array(
				'base' 		=> '#f1f2f3',
				'focus' 	=> '#fff',
				'current' 	=> '#fff'
			)
		);
	}

}
global $gws_colors;

$gws_colors = new GWS_Color_Schemes;

/**
 * Force default admin colour scheme.
 *
 * Forces and sets all admin colour schemes to 'grafika'.
 */
if ( !function_exists( 'gws_default_admin_color' ) ) :
	function gws_default_admin_color( $result ) {
	    return 'grafika';
	}
	add_filter( 'get_user_option_admin_color', 'gws_default_admin_color' );
endif;

/**
 * Remove admin colour scheme selector.
 *
 * Removes the admin colour scheme selector completly.
 */
if( is_admin() ) :
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
endif;