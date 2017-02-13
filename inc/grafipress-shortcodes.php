<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * WARNING: This file is part of the core G11 framework. DO NOT edit
 * this file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * This file contains all functions for shortcodes used in the theme.
 *
 * This file is a core Grafipress file and should not be edited.
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 */

/**
 * Company Name Shortcode.
 *
 * Add a shortcode to display the company name.
 */
function gws_client_company_name( $atts ) {
     return ucwords( get_option('full_company_name') );
}
add_shortcode( 'company_name', 'gws_client_company_name' );

/**
 * Abbreviation Shortcode
 *
 * Adds a shortcode to output the correct html5 abbrieviation or
 * accronym markup.
 */
function gws_abbr_shortcode( $atts ) {
    extract( shortcode_atts( array( 'title' => '', 'abbreviation' => '' ), $atts ) );

    	if( ! $title ) :
    		$title = 'Not set';
    	endif;

    	if( ! $abbreviation ) :
    		$abbreviation = abbreviation( $title );
    	endif;

        $html = sprintf( '<abbr data-toggle="tooltip" data-placement="top" title="%s">%s</abbr>', ucwords( strtolower( $title ) ), $abbreviation );
    return $html;
};
add_shortcode( 'abbr', 'gws_abbr_shortcode' );

/**
 * Company Name Shortcode
 *
 * Adds a shortcode to output a company name.
 */
function gws_company_name_shortcode( $atts ) {
    extract( shortcode_atts( array( 'display_slogan' => '' ), $atts ) );

        $company_name = get_theme_mod( 'client_company_name', get_bloginfo( 'name' ) );

        if( $display_slogan ) :
            $html = sprintf( '<span class="client-company-name" data-toggle="tooltip" data-placement="top" title="%s">%s</span>', get_bloginfo( 'description' ), ucwords( strtolower( $company_name ) ) );
        else :
            $html = sprintf( '<span class="client-company-name">%s</span>', ucwords( strtolower( $company_name ) ) );
        endif;

    return $html;
};
add_shortcode( 'company', 'gws_company_name_shortcode' );

//echo do_shortcode( '[company display_slogan="true"]' );
