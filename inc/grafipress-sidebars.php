<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * WARNING: This file is part of the core G11 framework. DO NOT edit
 * this file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * This file contains the sidebar registration and selection functions.
 *
 * This file is a core Grafipress file and should not be edited.
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 */

/**
 * Generate dynamic sidebars.
 *
 * Reads settings and arrays to generate dynamic sidebars for each theme.
 *
 * @since 4.0.0
 * @link http://www.grafipress.co.za
 */
function gws_register_widgets(  ) {

	$area 					= 'footer';
	$widget_count 			= get_theme_mod( 'footer_widget_count', '' ) ?: 4;
	$widget_areas 			= 1;
	$widget_column_width 	= 12 / $widget_count;

	while( $widget_areas < ( $widget_count + 1 ) ) {
		register_sidebar( array(
			'name'          => sprintf(__( '%s %s Widget ', 'TEXTDOMAIN' ), ordial_number( $widget_areas ), ucfirst( $area ) ),
			'description' 	=> sprintf(__('%s Widget for the %s widget area', 'TEXTDOMAIN'), ordial_number( $widget_areas ), strtolower( $area ) ),
			'id'            => strtolower( $area ) . '_widget_' .  $widget_areas,
			'before_widget' => '<div class="widget-container">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		$widget_areas++;
	}

	/**
	 * Sidebar array list.
	 *
	 * Setup array to generate sidebars.
	 *
	 * @since 4.0.0
	 * @link http://www.grafipress.co.za
	 */
	if( ! is_child_theme() ) {
	    $dynamic_widget_areas = array(
	        'Primary Sidebar', // Always leave Primary siderbar is as it is the fallback for several page templates
	        'Contact Page Sidebar',
	        'Product Page Sidebar',
	        'Home Page 001',
	        'Home Page 002',
	        'Home Page 003',
	        'Home Page 004',
	    );
	}

	/**
	 * Register theme sidebars.
	 *
	 * Register sidebars from the array defined.
	 *
	 * @since 4.0.0
	 * @link http://www.grafipress.co.za
	 */
	if ( function_exists( 'register_sidebar' ) ) {
	    foreach ( $dynamic_widget_areas as $widget_area_name ) {
	        register_sidebar( array(
	            'name'          => ucwords( $widget_area_name ),
	            'before_widget' => '<div class="'. str_replace( " ", "-", strtolower( $widget_area_name ) ) .' widget %2$s">',
	            'after_widget'  => '</div>',
	            'before_title'  => '<h3 class="widget-title">',
	            'after_title'   => '</h3>',
	            'id'            => str_replace( " ", "-", strtolower( $widget_area_name ) ),
	            'description'   => '',
	            //'class'         => str_replace( " ", "-", strtolower( $widget_area_name ) ),
	        ) );
	    }
	}
}
add_action( 'widgets_init', 'gws_register_widgets' );

/**
 * Include sidebars.
 *
 * Includes the sidebar template part in the correct position.
 *
 * @since 4.0.0
 * @link http://www.grafipress.co.za
 */
if ( ! function_exists( 'gws_sidebars' ) ) :
	function gws_sidebars( $location = 'sidebar-right') {

		// Retrieves the stored value from the database
	    $display_sidebar 	= get_post_meta( get_the_ID(), 'display-sidebar', true );
	    $sidebar_selection 	= get_post_meta( get_the_ID(), 'sidebar-selection', true );
	    $sidebar_alignment 	= get_post_meta( get_the_ID(), 'sidebar-alignment', true );

	    if( $display_sidebar && $sidebar_alignment == $location && $sidebar_selection ) :
	    	get_sidebar();
	    endif;
	}
endif;

/**
 * Main content class.
 *
 * Returns the class for the main content container.
 *
 * @since 4.0.0
 * @link http://www.grafipress.co.za
 */
if ( ! function_exists( 'gws_main_class' ) ) :
	function gws_main_class() {

		// Retrieves the stored value from the database
		$display_sidebar 	= get_post_meta( get_the_ID(), 'display-sidebar', true );
		$sidebar_selection 	= get_post_meta( get_the_ID(), 'sidebar-selection', true );

		if ( $display_sidebar && $sidebar_selection ) :
			$class = 'col-md-9';
		else :
			$class = 'col-md-12';
		endif;

		return $class;
	}
endif;

/**
 * Determine sidebar to use.
 *
 * Returns the correct sidebar name or sets up a default sidebar on
 * certain pages.
 *
 * @since 4.0.0
 * @link http://www.grafipress.co.za
 */
if( ! function_exists( 'gws_get_sidebar') ) :
    function gws_get_sidebar() {

        if( is_search() || is_archive() || is_category() ) :
            return 'primary-sidebar';
        else :
            return $sidebar_selection 	= get_post_meta( get_the_ID(), 'sidebar-selection', true );
        endif;
    }
endif;