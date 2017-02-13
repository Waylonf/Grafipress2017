<?php
/**
 * Grafipress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 *
 * @todo Create 404 page template with content loop
 * @todo Create search page with content loop
 * @todo Update index.php template
 * @todo Create base font-page.php template
 *
 * @todo Remove Constant variables in functions.php used accross the site
 * @todo Check for consistant docblock headers in all files
 * @todo Wrap all function in child theme friendly check function
 * @todo Create Ninja-Forms hooks to add Bootstrap css classes
 * @todo Check Customizer files for consistancy and correct file names
 * @todo Add lightbox script to package
 * @todo Add admin notice to check if DEBUG is set to true or not on live server
 * @todo Filter admin menu builder to add select for FontAwesome icons
 * @todo Create search results page template
 * @todo Create 404 results page template
 * @todo Create base styles sass file for default style rules & declarations
 * @todo Debug and implement sidebar selection functionality
 * @todo Create social sharing template part with options.
 * @todo Hook, code and format WordPress internal mail functionality
 * @todo Design and code shortcode library
 * @todo Pull bootstrap-wp-navwalker.php from github with gulp task
 * @todo Pull bootstrap-ninja-forms.php from github with gulp task
 */

//-----------------------------------------------------------------------
// Load vendor classes, functions and scripts.
//-----------------------------------------------------------------------
require get_template_directory() . '/lib/bootstrap-wp-navwalker.php';
require get_template_directory() . '/lib/bootstrap-ninja-forms.php';
//require get_template_directory() . '/menu-item-custom-fields/menu-item-custom-fields.php'; 

//-----------------------------------------------------------------------
// Load helper arrays
//-----------------------------------------------------------------------
require get_template_directory() . '/inc/grafipress-arrays.php';

//-----------------------------------------------------------------------
// Developer links and contact information
//-----------------------------------------------------------------------
define( 'GWS_CREATOR', get_theme_mod( 'grafipress_developer_name' ) );
define( 'GWS_URL', 'http://www.grafika.co.za' );
define( 'GWS_SLOGAN', 'Design through inspiration' );
define( 'GWS_ADMIN_MENU_NAME', GWS_CREATOR );
define( 'GWS_FACEBOOK', 'GrafikaWeb' );
define( 'GWS_TWITTER', 'GrafikaWeb' );
define( 'GWS_CLIENTZONE', 'grafika_billing' );
define( 'GWS_KNOWLEDGEBASE', 'grafika_billing/knowledgebase.php' );
define( 'GWS_TELEPHONE', '0825714130');
define( 'GWS_FAX', '0865504459');
define( 'GWS_EMAIL', 'info@grafika.co.za');

//-----------------------------------------------------------------------
// Load theme essentials functions used in Grafipress.
//-----------------------------------------------------------------------
require get_template_directory() . '/inc/grafipress-admin-theme.php';
require get_template_directory() . '/inc/grafipress-meta-boxes.php';
require get_template_directory() . '/inc/grafipress-activation.php';
require get_template_directory() . '/inc/grafipress-helpers.php';
require get_template_directory() . '/inc/grafipress-template-tags.php';
require get_template_directory() . '/inc/grafipress-theme-setup.php';
require get_template_directory() . '/inc/grafipress-jetpack.php';
require get_template_directory() . '/inc/grafipress-sitewide.php';
require get_template_directory() . '/inc/grafipress-sidebar-selection-metabox.php';
require get_template_directory() . '/inc/grafipress-sidebars.php';
require get_template_directory() . '/inc/grafipress-required-plugins.php';
require get_template_directory() . '/inc/grafipress-breadcrumbs.php';
require get_template_directory() . '/inc/grafipress-welcome-widget.php';
require get_template_directory() . '/inc/grafipress-custom-header.php';
require get_template_directory() . '/inc/grafipress-additional-css.php';
require get_template_directory() . '/inc/grafipress-navigation.php';
//require get_template_directory() . '/inc/grafipress-nav-menu-fields.php';

//-----------------------------------------------------------------------
// Conditionally load sandbox.php
//-----------------------------------------------------------------------
if (defined('WP_DEBUG') && true === WP_DEBUG) :
    require get_template_directory() . '/inc/grafipress-sandbox.php';
endif;

//-----------------------------------------------------------------------
// If Kirki installed and active, load base customizer options
//-----------------------------------------------------------------------
if ( class_exists( 'Kirki' ) ) :
	require get_template_directory() . '/inc/grafipress-customizer.php';
endif;

//-----------------------------------------------------------------------
// Load theme widgets
//-----------------------------------------------------------------------
require get_template_directory() . '/inc/widgets/grafipress-profile-widget.php';
require get_template_directory() . '/inc/widgets/grafipress-vcard-widget.php';
require get_template_directory() . '/inc/widgets/office-location-widget.php';