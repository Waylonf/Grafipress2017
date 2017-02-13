<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * WARNING: This file is part of the core {THEME-NAME} framework. DO NOT edit this
 * file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * This file contains functions required to ehnace the navigation
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 */

if ( ! function_exists( 'gws_copyright' ) ) {
	function gws_copyright() {

		global $wpdb;

		$initial_date = $wpdb->get_results( "SELECT YEAR( min( post_date_gmt ) ) AS firstdate, YEAR( max( post_date_gmt ) ) AS lastdate FROM $wpdb->posts WHERE post_status = 'publish'" );
		$initial_date = $initial_date[0]->firstdate;

		// TODO Add translation string to footer credit.
		// TODO Add customizer option to use custom footer credit.
		if( $initial_date < date( 'Y' ) ) {
			$credit_item[] = 'Copyright &copy; ' . $initial_date . ' - ' . date( 'Y' );
		} elseif( $initial_date == date( 'Y' ) ) {
			$credit_item[] = 'Copyright &copy; ' . date( 'Y' );
		}

		$credit_item[] = '<a href="' . get_home_url() . '">' . get_bloginfo( 'name' ) . '.</a>';
		$credit_item[] = 'All rights reserved.';
		if( ! NULL == get_option( 'developer_slogan') ) : 
			$credit_item[] = 'Powered by <a title="' . __( get_option( 'developer_slogan' , 'Design through inspiration' ) , 'TEXTDOMAIN' ) . '" data-toggle="tooltip" data-placement="top" rel="nofollow" href="' . get_option( 'developer_url' , 'http://www.grafika.co.za' ) . '" target="_blank">' . get_option( 'developer_name' , 'Grafika' ) . '</a>';
		else :
			$credit_item[] = 'Powered by <a rel="nofollow" href="' . get_option( 'developer_url' , 'http://www.grafika.co.za' ) . '" target="_blank">' . get_option( 'developer_name' , 'Grafika' ) . '</a>';
		endif;
		$credit_item[] = icon_loginout( false, false );
		$footer_credit 	= '';
		foreach( $credit_item as $item ){
			if( $item != '' && !NULL ) {
				$footer_credit .= '&nbsp;' . $item;
			}
		}
		echo $footer_credit;
	}
}

if ( ! function_exists( 'grafipress_missing_files_notice' ) ) :
	function grafipress_missing_files_notice() {
		$theme = wp_get_theme();
		$theme_name     = strtolower( $theme );
		$theme_version  = $theme['Version'];
		$missing_files 	= '';

		$mandatory_files = array(
		    'html5' => array(
		        'filename'  		=> $theme_name . '-html5.min.js',
		        'location'  		=> get_template_directory_uri() . '/js/html5.min.js',
		        'option'    		=> 'html5shiv_cdn',
		        'required_option' 	=> false,
		        'message' 			=> __( 'This file ensures that the site renders correctly on old or inferior browsers.', 'TEXTDOMAIN' ),
		        ),
		    'respond' => array(
		        'filename'  		=> $theme_name . '-respond.min.js',
		        'location'  		=> get_template_directory_uri() . '/js/respond.min.js',
		        'option'    		=> 'respondjs_cdn',
		        'required_option' 	=> false,
		        'message' 			=> __('This file ensures that the site layout adjusts correctly on old or inferior browsers.', 'TEXTDOMAIN' ),
		        ),
		    'theme_styles' => array(
		        'filename'  		=> $theme_name . '-styles.min.css',
		        'location'  		=> get_stylesheet_directory() . '/css/' . $theme_name . '-styles.min.css',
		        'option'    		=> '',
		        'required_option' 	=> '',
		        'message'   		=> __( 'This file is an essential part of this site. Please upload it to the required directory to ensure that the site renders correctly.', 'TEXTDOMAIN' ),
		        ),
		    'ie' => array(
		        'filename'  		=> $theme_name . '-ie.css',
		        'location'  		=> get_template_directory_uri() . '/css/' . $theme_name . '-ie.css',
		        'option'    		=> 'load_ie_styles',
		        'required_option' 	=> true,
		        'message' 			=> __( 'This file handles rendering combatability for general Internet Explorer browser pitfalls', 'TEXTDOMAIN' ),
		        ),
		    'ie8' => array(
		        'filename'  		=> $theme_name . '-ie8.css',
		        'location'  		=> get_template_directory_uri() . '/css/' . $theme_name . '-ie8.css',
		        'option'    		=> 'load_ie_styles',
		        'required_option' 	=> true,
		        'message' 			=> __( 'This file handles rendering combatability for Internet Explorer 8 browser pitfalls', 'TEXTDOMAIN' ),
		        ),
		    'ie7' => array(
		        'filename'  		=> $theme_name . '-ie7.css',
		        'location'  		=> get_template_directory_uri() . '/css/' . $theme_name . '-ie7.css',
		        'option'    		=> 'load_ie_styles',
		        'required_option' 	=> true,
		        'message' 			=> __( 'This file handles rendering combatability for Internet Explorer 7 browser pitfalls', 'TEXTDOMAIN' ),
		        ),
		    'skip_link' => array(
		        'filename'  		=> 'skip-link-focus-fix.js',
		        'location'  		=> get_template_directory_uri() . '/js/skip-link-focus-fix.js',
		        'option'    		=> 'skip_link_focus',
		        'required_option' 	=> true,
		        'message'   		=> __( 'This is a required file due to your current theme settings. To ensure proper functioning ot this site please re-visit the settings section or provide the file in the required location.', 'TEXTDOMAIN' ),
		        ),
		    'theme_scripts' => array(
		        'filename'  		=> $theme_name . '-scripts.min.js',
		        'location'  		=> get_template_directory() . '/js/' . $theme_name . '-scripts.min.js',
		        'option'    		=> '',
		        'required_option' 	=> '',
		        'message'   		=> __( 'This file is responsible for added & essential features accross this site. It is suggested that you upload this file to the required directory to restore all functionality.', 'TEXTDOMAIN' ),
		        ),
		    );

		foreach ( $mandatory_files as $property => $value) :
		    if( ! file_exists( $value['location'] ) && $value['location'] != '' ) : 
		        if( $value['option'] != '' ) :
		            if ( $value['required_option'] == get_option( $value['option'] ) ) :
		                $missing_files[] = '<b>' . $value['filename'] . ':</b> ' . $value['message'] . '<br/>';
		            endif;                  
		        elseif( $value['required_option'] != $value['option'] || $value['option'] == '' || $value['required_option'] == '' ) :
		            $missing_files[] =  '<b>' . $value['filename'] . ':</b> ' . $value['message'] . '<br/>';
		        endif;
		    endif;
		endforeach;

		// TODO Add dismissable functionality to Admin Notice (@see http://wptheming.com/2011/08/admin-notices-in-wordpress/)
		// TODO Add these errors to a global Admin notice function
		if( $missing_files ) : ?>
			<div class="error notice is-dismissable">
				<p><?php _e( 'The following required files are missing:', 'TEXTDOMAIN' ); ?> 
					<ol>
					<?php foreach( $missing_files as $file ) :
						echo '<li>' . $file . '</li>';
					endforeach; ?>
					</ol>
				</p>
			</div>
		<?php else :
			return;
		endif;
	}	
endif;
add_action( 'admin_notices', 'grafipress_missing_files_notice' );

/**
 * Embed Analytics
 * 
 * Include analytics code into each page in theme
 * @todo Correct checks and variables so that snippet is included
 * @todo Confirm snippet is current and best practice.
 */
if ( ! function_exists( 'gws_google_analytics' ) ) :
	function gws_google_analytics() { ?>
	    <script>
	        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
	        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
	        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
	        e.src='//www.google-analytics.com/analytics.js';
	        r.parentNode.insertBefore(e,r)}(window,document,'script','ga' ) );
	        ga( 'create','<?php echo get_theme_mod( 'analytics_code', '') ?>' );ga( 'send','pageview' );
	    </script>
	<?php }
	if ( !current_user_can( 'manage_options' ) && get_theme_mod( 'include_analytics', '' ) && get_theme_mod( 'analytics_code', '') ) :
	    add_action( 'wp_footer', 'gws_google_analytics', 20 );
	endif;
endif;

/**
 * Remove IE link borders
 * 
 * Remove the stippled borders around links for IE
 */
if ( ! function_exists( 'gws_ie_link_border_removal' ) ) :
	function gws_ie_link_border_removal() {
		echo '<meta http-equiv="X-UA-Compatible" content="IE=9" />' . "\n";
	}
	add_action( 'wp_head', 'gws_ie_link_border_removal');
endif;