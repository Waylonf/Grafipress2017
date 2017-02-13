<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
* Redirect to launch page
*
* This function will redirect all page requests to the launch page
*/
if ( ! function_exists( 'gws_maintenance' ) ) {
	function gws_maintenance() {

		function is_login_page() {
	    	return in_array( $GLOBALS[ 'pagenow' ], array( 'wp-login.php', 'wp-register.php' ) );
		}

		if( get_theme_mod( 'enable_coming_soon_mode', '') && ! is_admin() && ! current_user_can( 'publish_pages' ) ) {		

			wp_load_translations_early();
			
			$protocol = $_SERVER[ "SERVER_PROTOCOL" ];
			
			if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol )
			$protocol = 'HTTP/1.0';
			
			header( "$protocol 503 Service Unavailable", true, 503 );
			header( 'Content-Type: text/html; charset=utf-8' );
			header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
			header( 'Last-Modified : '. gmdate('D, d M Y H:i:s T') );
			header( 'Pragma: no-cache' );
			header( 'Retry-After: ' . gmdate('D, d M Y H:i:s T', strtotime( LAUNCH_DATE) ) );

			require( trailingslashit( get_template_directory() ) . 'gws-templates/coming-soon.php' );

			die();
		}
	}
	add_action( 'template_redirect', 'gws_maintenance' );
}