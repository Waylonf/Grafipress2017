<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * WARNING: This file is part of the core G11 framework. DO NOT edit
 * this file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * Theme activation functions
 *
 * This file is a core Grafipress file and should not be edited.
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 */
if ( ! function_exists( 'gws_theme_setup' ) ) :
    function gws_theme_setup() {
        // First we check to see if our default theme settings have been applied.
        $the_theme_status = get_option( 'theme_setup_status' );

        // Setup Default WordPress settings
        if ( $the_theme_status !== '1' ) :

            // Rename default category if it exists
            if ( term_exists( 'Uncategorized' ) ) :
            wp_update_term( term_exists( 'Uncategorized' ), 'category' , array(
                'name' => 'Unspecified category',
                'slug' => 'unspecified-category',
                ));
            endif;

            $core_settings = array(
                // Comment Avatars should be using mystery by default
                'avatar_default'            => 'mystery',
                // Avatar rating
                'avatar_rating'             => 'G',
                // We do not allow links from comments
                'comment_max_links'         => 0,
                // Default to 20 comments per page
                'comments_per_page'         => 20,
                // Close all comments
                'default_comment_status'    => 'closed',
                // All comments need to be manually confirmed
                'comment_moderation'        => 1,
                // User must be logged in to comment
                'comment_registration'      => 1,
                // Set default timezone
                'timezone_string'           => 'Africa/Johannesburg',
                // Set default time format
                'date_format'               => 'j F Y',
                // Set default time format
                'time_format'               => 'H:i A',
            );

            foreach ( $core_settings as $theme_option => $theme_option_setting ) :
                update_option( $theme_option, $theme_option_setting );
            endforeach;

            // Delete dummy post, page and comment.
            wp_delete_post( 1, true );
            wp_delete_post( 2, true );
            wp_delete_comment( 1 );

            // Create home page
            if ( isset( $_GET[ 'activated' ] ) && is_admin() ) :
                $new_page_title     = 'Home';
                $new_page_content   = '';
                $new_page_template  = 'front-page.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.

                $page_check = get_page_by_title( $new_page_title );
                $new_page = array(
                    'post_type'         => 'page',
                    'post_title'        => $new_page_title,
                    'post_content'      => $new_page_content,
                    'post_status'       => 'publish',
                    'post_author'       => 1,
                    'comment_status'    => 'closed',
                    'post_excerpt'      => 'This page displays a list of all the pages available on this site.',
                );

                if( ! isset( $page_check->ID ) ) :
                    $new_page_id = wp_insert_post( $new_page );
                    if( !empty( $new_page_template ) ) :
                        update_post_meta( $new_page_id, '_wp_page_template', $new_page_template );
                    endif;
                endif;
            endif;

            // Create sitemap page
            if ( isset( $_GET[ 'activated' ] ) && is_admin() ) :
                $new_page_title     = 'Sitemap';
                $new_page_content   = '';
                $new_page_template  = 'template-sitemap.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.

                $page_check = get_page_by_title( $new_page_title );
                $new_page = array(
                    'post_type'         => 'page',
                    'post_title'        => $new_page_title,
                    'post_content'      => $new_page_content,
                    'post_status'       => 'publish',
                    'post_author'       => 1,
                    'comment_status'    => 'closed',
                    'post_excerpt'      => 'This page displays a list of all the pages available on this site.'
                );

                if( ! isset( $page_check->ID) ) :
                    $new_page_id = wp_insert_post( $new_page );
                    if( ! empty( $new_page_template ) ) :
                        update_post_meta( $new_page_id, '_wp_page_template', $new_page_template );
                    endif;
                endif;
            endif;

            // Create terms and conditions page
            if ( isset( $_GET[ 'activated' ] ) && is_admin() ) :
                $new_page_title     = 'Terms & Conditions';
                $new_page_content   = '';
                $new_page_template  = 'template-terms-and-conditions.php';

                $page_check = get_page_by_title( $new_page_title );
                $new_page = array(
                    'post_type'         => 'page',
                    'post_title'        => $new_page_title,
                    'post_content'      => $new_page_content,
                    'post_status'       => 'publish',
                    'post_author'       => 1,
                    'comment_status'    => 'closed',
                    'post_excerpt'      => 'Below are the terms and conditions that you are compelled to follow when making use of our site.'
                );

                if( ! isset( $page_check->ID ) ) :
                    $new_page_id = wp_insert_post( $new_page );
                    if( ! empty( $new_page_template ) ) :
                        update_post_meta( $new_page_id, '_wp_page_template', $new_page_template );
                    endif;
                endif;
            endif;

            // Create disclaimer page
            if ( isset( $_GET[ 'activated' ] ) && is_admin()) :
                $new_page_title     = 'Privacy Policy';
                $new_page_content   = '';
                $new_page_template  = 'template-privacy-policy.php';

                $page_check = get_page_by_title( $new_page_title );
                $new_page = array(
                    'post_type'         => 'page',
                    'post_title'        => $new_page_title,
                    'post_content'      => $new_page_content,
                    'post_status'       => 'publish',
                    'post_author'       => 1,
                    'comment_status'    => 'closed',
                    'post_excerpt'      => 'Below you will find all information regarding our Privacy Policy.'
                );

                if( !isset( $page_check->ID) ) :
                    $new_page_id = wp_insert_post( $new_page );
                    if( !empty( $new_page_template ) ) :
                        update_post_meta( $new_page_id, '_wp_page_template', $new_page_template );
                    endif;
                endif;
            endif;

            // Create terms and conditions page
            if ( isset( $_GET[ 'activated' ] ) && is_admin()) :
                $new_page_title     = 'Contact us';
                $new_page_content   = '';
                $new_page_template  = 'template-contact.php';

                $page_check = get_page_by_title( $new_page_title );
                $new_page = array(
                    'post_type'         => 'page',
                    'post_title'        => $new_page_title,
                    'post_content'      => $new_page_content,
                    'post_status'       => 'publish',
                    'post_author'       => 1,
                    'comment_status'    => 'closed',
                    'post_excerpt'      => 'Feel free to contact us by completing the form below. We will reply as soon as we can.'
                );

                if( !isset( $page_check->ID) ) :
                    $new_page_id = wp_insert_post( $new_page );
                    if( !empty( $new_page_template ) ) :
                        update_post_meta( $new_page_id, '_wp_page_template', $new_page_template );
                    endif;
                endif;
            endif;

            // Create default main menu
            $primary_nav = wp_get_nav_menu_object(__('Primary Menu', 'TEXTDOMAIN' ) );
            if ( ! $primary_nav ) :
                $primary_nav_id = wp_create_nav_menu( __( 'Primary Menu', 'TEXTDOMAIN' ), array( 'slug' => 'primary' ) );
            endif;

            // Create default footer menu
            $primary_nav = wp_get_nav_menu_object(__('Secondary', 'TEXTDOMAIN' ) );
            if ( ! $primary_nav ) :
                $primary_nav_id = wp_create_nav_menu( __( 'Secondary', 'TEXTDOMAIN' ), array( 'slug' => 'secondary' ) );
            endif;

            // Create default footer menu
            $primary_nav = wp_get_nav_menu_object(__('Social Links Menu', 'TEXTDOMAIN' ) );
            if ( ! $primary_nav ) :
                $primary_nav_id = wp_create_nav_menu( __( 'Social Links Menu', 'TEXTDOMAIN' ), array( 'slug' => 'social' ) );
            endif;

            // Change permalink structure
            global $wp_rewrite;
            $wp_rewrite->set_permalink_structure( '/%postname%/' );
            flush_rewrite_rules();

            // Set homepage
            $home = get_page_by_title( __( 'Home', 'TEXTDOMAIN' ) );
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $home->ID );

            $home_menu_order = array(
              'ID'          => $home->ID,
              'menu_order'  => -1
            );
            wp_update_post($home_menu_order);

            // Once done, we register our setting to make sure we don't duplicate everytime we activate.
            update_option( 'theme_setup_status', '1' );

            // Lets let the admin know whats going on.
            $msg = '<div class="error"><p>The ' . get_option( 'current_theme' ) . ' theme has changed your default <a href="' . admin_url() . 'options-general.php" title="See Settings"> settings</a> and deleted default posts and comments. There are also several options that have been adjusted to ensure your site is equipped and ready to work for you.</p></div>';
            add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
        // Else if we are re-activing the theme
        elseif ( $the_theme_status === '1' and isset( $_GET[ 'activated' ] ) ) :
            $msg = '<div class="updated"><p>The ' . get_option( 'current_theme' ) . ' theme was successfully re-activated.</p></div>';
            add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
        endif;
    }
    add_action( 'after_setup_theme', 'gws_theme_setup' );
endif;