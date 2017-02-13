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
 * Inline dynamic theme generated styles
 *
 * @todo Ensure handle matches main stylesheet.
 */
function grafipress_styles_method() {
    if( $custom_css = get_option( 'custom_css' ) ) :
        wp_add_inline_style( 'grafipress-styles-css', $custom_css );
    else:
            return;
    endif;
}
add_action( 'wp_enqueue_scripts', 'grafipress_styles_method' );