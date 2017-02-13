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

/**
 * Highlight search terms.
 *
 * This function will highlight any text that matches the term that
 * was searched.
 */
if ( ! function_exists( 'gws_highlight_search_term' ) ) {
	function gws_highlight_search_term( $text ){
	    if( is_search() ) {
			$keys = implode( '|', explode(' ', get_search_query() ) );
			$text = preg_replace( '/(' . $keys .')/iu', '<span class="search-term">\0</span>', $text );
		}
	    return $text;
	}
	add_filter( 'the_excerpt', 'gws_highlight_search_term' );
	add_filter( 'the_title', 'gws_highlight_search_term' );
	apply_filters( 'the_content', 'gws_highlight_search_term' );
}

/**
 * Search autofocus
 *
 * This function sets the autofocus attribute on certain
 * situations for a search form.
 */
if( ! function_exists( 'gws_search_autofocus') ) {
	function gws_search_autofocus() {
		if( is_404() ) {
			$autofocus = 'autofocus';
			//$placeholder = 'Please try searching for it instead. Hit enter to begin search';
		} else {
			$autofocus = '';
			//$placeholder = 'Search...';
		}
	echo $autofocus;
	}
}

/**
 * Search palceholder
 *
 * This function sets the placeholder attribute on certain
 * situations for a search form.
 */
if( ! function_exists( 'gws_search_placeholder') ) {
	function gws_search_placeholder() {
		if( is_404() ) {
			//$autofocus = 'autofocus';
			$placeholder = __( 'Maybe try a search?', 'TEXTDOMAIN' );
		} else {
			//$autofocus = '';
			$placeholder = __( 'Search...', 'TEXTDOMAIN' );
		}
	echo $placeholder;
	}
}

/**
 * Generate dynamic search result page heading.
 *
 * This function will return the count of all search results
 * as well as the rest of the page heading for the search page.
 */
if( !function_exists( 'gws_search_heading') ) {
	function gws_search_heading() {
		global $wp_query;

		$total_results = $wp_query->found_posts;

		if( (int)$total_results > 1 ) {
			$gws_plural = 's';
		} else {
			$gws_plural = '';
		}

		printf( __( '%s Search result%s found for %s', 'TEXTDOMAIN' ), $total_results, $gws_plural, '<span class="search-term">"' . get_search_query() . '"</span>' );
	}
}

/**
 * Search auto-redirect.
 *
 * This function will count search results and if only one
 * result is found it will automatically redirect to the result.
 */
if( ! function_exists( 'gws_search_redirect' ) ) {
	function gws_search_redirect() {
	    if ( is_search() ) {
	        global $wp_query;
	        if ( $wp_query->post_count == 1 && $wp_query->max_num_pages == 1 ) {
	        	wp_redirect( get_permalink( $wp_query->posts[ '0' ]->ID ) );
	            exit;
	        }
	    }
	}
	add_action( 'template_redirect', 'gws_search_redirect' );
}