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
 * Simple helper function to add menu item objects
 * 
 * @param $title      - menu item title
 * @param $url        - menu item url
 * @param $order      - where the item should appear in the menu
 * @param int $parent - the item's parent item
 * @return \stdClass
 */
if( ! function_exists( 'add_loginout_link' ) ) :
    function add_loginout_link( $items, $args ) {
        
        if (is_user_logged_in() && $args->theme_location == 'primary') {
            $items .= '<li><a rel="nofollow" data-toggle="tooltip" data-placement="bottom" title="' .  __( 'Log Out', 'TEXTDOMAIN' ) . '" href="'. wp_logout_url() .'"><i class="fa fa-fw fa-lock"></i></a></li>';
        }
        elseif (!is_user_logged_in() && $args->theme_location == 'primary') {
            $items .= '<li><a rel="nofollow" data-toggle="tooltip" data-placement="bottom" title="' .  __( 'Login to manage this site', 'TEXTDOMAIN' ) . '" href="'. site_url('wp-login.php') .'"><i class="fa fa-fw fa-lock-o"></i></a></li>';
        }

        // Add edit page menu item to main navigation
        if (is_user_logged_in() && $args->theme_location == 'primary') :
            $items .= '<li><a rel="nofollow" data-toggle="tooltip" data-placement="bottom" href="'. get_edit_post_link() .'" title="' .  __( 'Edit this page', 'TEXTDOMAIN' ) . '"><i class="fa fa-fw fa-edit"></i></a></li>';
        endif;

        if (is_user_logged_in() && $args->theme_location == 'primary') :
            $items .= '<li><a rel="nofollow" data-toggle="tooltip" data-placement="bottom" href="'. get_admin_url() .'" title="' .  __( 'Go to the Dashboard section', 'TEXTDOMAIN' ) . '"><i class="fa fa-fw fa-dashboard"></i></a></li>';
        endif;

        return $items;
    }
    add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
endif;

function add_edit_page_link( $items, $args ) {
    return $items;
}
//add_filter( 'wp_nav_menu_items', 'add_edit_page_link', 10, 2 );

 /**
 * Add Navigation Search
 * 
 * Add a search form to the main menu.
 */
 if( ! function_exists( 'add_search_to_wp_menu' ) ) {
    function add_search_to_wp_menu ( $items, $args ) {
        if( 'primary' === $args -> theme_location ) { 
            
            global $wp_query; 
            
            $items  = '<form class="navbar-form" role="search">';
            $items .= '    <div class="input-group">';
            $items .= '        <input type="text" class="form-control" placeholder="Search">';
            $items .= '        <span class="input-group-btn">';
            $items .= '            <button type="reset" class="btn btn-default ">';
            $items .= '                <span class="text-warning glyphicon glyphicon-remove">';
            $items .= '                    <span class="sr-only">Close</span>';
            $items .= '                </span>';
            $items .= '            </button>';
            $items .= '            <button type="submit" class="btn btn-warning">';
            $items .= '                <span class="glyphicon glyphicon-search">';
            $items .= '                    <span class="sr-only">Search</span>';
            $items .= '                </span>';
            $items .= '            </button>';
            $items .= '        </span>';
            $items .= '    </div>';
            $items .= '</form>';
        }
        return $items;
    }
    // TODO Add customizer option to toggle this option
    //add_filter( 'wp_nav_menu_items', 'add_search_to_wp_menu', 10, 2 );
}

 /**
 * Add Navigation Search
 * 
 * Add a search form to the main menu.
 */
if( ! function_exists( 'gws_search_link' ) ) {
    function gws_search_link ( $items, $args ) {
        // TODO Add check to see if Navbar search is enabled
        if ( $args->theme_location == 'primary') {
            $items .= '<li>';
            $items .= '<a id="nav-search-toggle" href="#search-form">';
            $items .= '<i class="fa fa-search"></i>';
            $items .= '</a>';
            $items .= '</li>';
        }
        return $items;
    }
    //add_filter( 'wp_nav_menu_items', 'gws_search_link', 10, 2 );
}

/**
 * Clean navigation classes
 * 
 * This function removes native WordPress CSS classes
 * that are injected into the navigation menus leaving
 * only the "current-menu-item" class.
 *
 * @todo Add customizer option to toggle navigation class cleanup
 */
if( ! function_exists( 'gws_clean_nav_classes' ) ) {
    function gws_clean_nav_classes( $var ) {
        return is_array( $var ) ? array_intersect( $var, array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor' ) ) : '';
    }
    add_filter( 'nav_menu_css_class', 'gws_clean_nav_classes', 100, 1 );    
}

/**
 * Clean navigation id's
 * 
 * This function removes native WordPress CSS ID's
 * that are injected into the navigation menus.
 * 
 * @todo Add customizer option to toggle navigation id cleanup
 */
if( ! function_exists( 'gws_clean_nav_ids' ) ) {
    function gws_clean_nav_ids( $id, $item ) {
        return '';
    }
    add_filter( 'nav_menu_item_id', 'gws_clean_nav_ids', 10, 2 );
}