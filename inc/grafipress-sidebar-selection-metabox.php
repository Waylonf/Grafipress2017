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
 * Sidebar array list.
 *
 * Setup array to generate sidebar select list.
 *
 * @since 4.0.0
 * @link http://www.grafipress.co.za
 */
function sidebar_selectbox( $name = '', $current_value = false ) {
    global $wp_registered_sidebars;

    if ( empty( $wp_registered_sidebars ) )
        return;

    $name       = empty( $name ) ? false : ' name="' . esc_attr( $name ) . '"';
    $current    = $current_value ? esc_attr( $current_value ) : false;
    $selected   = '';
    ?>
    <select<?php echo $name; ?>>
    <?php foreach ( $wp_registered_sidebars as $sidebar ) :
        if ( $current ) :
            $selected = selected( $current === $sidebar['id'], true, false );
        /*else :*/ ?>
        <?php endif; ?>
        <option value="<?php echo $sidebar['id']; ?>"<?php echo $selected; ?>><?php echo $sidebar['name']; ?></option>
    <?php endforeach; ?>
    </select>
    <?php
}

/**
 * Register the Sidebar Metabox.
 *
 * Creates a metabox for the sidebar selection dropdown.
 *
 * @since 4.0.0
 * @link http://www.grafipress.co.za
 */
function add_sidebar_meta_box() {
    add_meta_box(
        $id             = 'siebar-options',
        $title          = 'Sidebar Options',
        $callback       = 'sidebar_meta_box_markup',
        $post_type      = array( 'page', 'products'),
        //$post_type      = get_post_types(),
        $context        = 'side',
        $priority       = 'high',
        $callback_args  = null
    );
}
add_action( 'add_meta_boxes', 'add_sidebar_meta_box' );

/**
 * Render the Sidebar Metabox.
 *
 * Creates a metabox for the sidebar selection dropdown.
 *
 * @since 4.0.0
 * @link http://www.grafipress.co.za
 */
function sidebar_meta_box_markup( $object ) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce"); ?>
    <div>

        <!-- Display Sidebar -->
        <p>
            <label for="display-sidebar">
            <?php $display_sidebar = get_post_meta( $object->ID, "display-sidebar", true );

            if( $display_sidebar == "" ) : ?>
                <input name="display-sidebar" type="checkbox" value="true">
            <?php elseif( $display_sidebar == "true" ) : ?>
                <input name="display-sidebar" type="checkbox" value="true" checked>
            <?php endif; ?>
            Display page sidebar?</label>
        </p>

        <!-- Sidebar Selection -->
        <p><strong><?php _e( 'Sidebar Selection', 'TEXTDOMAIN' ); ?></strong></p>
            <label class="screen-reader-text" for="sidebar-selection"><?php _e( 'Sidebar Selection', 'TEXTDOMAIN' ); ?></label>
        </p>
        <?php sidebar_selectbox( $name = 'sidebar-selection',  $current_value = get_post_meta( $object->ID, 'sidebar-selection', true ) ); ?>

        <!-- Sidebar alignment -->
        <?php $sidebar_alignment = get_post_meta( $object->ID, 'sidebar-alignment', true ); ?>
        <p>
            <span class="prfx-row-title"><strong><?php _e( 'Sidebar alignment', 'TEXTDOMAIN' )?></strong></span><br>
                <label for="sidebar-left">
                    <input type="radio" name="sidebar-alignment" id="sidebar-left" value="sidebar-left" <?php if ( $sidebar_alignment ) checked( $sidebar_alignment, 'sidebar-left' ); ?>>
                    <?php _e( 'Left', 'TEXTDOMAIN' )?>
                </label><br>
                <label for="sidebar-right">
                    <input type="radio" name="sidebar-alignment" id="sidebar-right" value="sidebar-right" <?php if ( $sidebar_alignment ) checked( $sidebar_alignment, 'sidebar-right' ); ?>>
                    <?php _e( 'Right', 'TEXTDOMAIN' )?>
                </label>
        </p>
    </div>
    <?php }

/**
 * Save the Sidebar Metabox values.
 *
 * Creates a metabox for the sidebar selection dropdown.
 *
 * @since 4.0.0
 * @link http://www.grafipress.co.za
 */
function save_custom_meta_box( $post_id, $post, $update ) {
    if ( ! isset( $_POST[ "meta-box-nonce" ] ) || ! wp_verify_nonce( $_POST[ "meta-box-nonce" ], basename(__FILE__) ) ) :
        return $post_id;
    endif;

    if( ! current_user_can( "edit_post", $post_id ) ) :
        return $post_id;
    endif;

    if( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE ) :
        return $post_id;
    endif;

    // Save sidebar view value
    $display_sidebar = "";
    if( isset( $_POST[ "display-sidebar" ] ) ) :
        $display_sidebar = $_POST[ "display-sidebar" ];
    endif;
    update_post_meta( $post_id, "display-sidebar", $display_sidebar );

    // Save sidebar selection value
    $sidebar_selection = "";
    if( isset( $_POST[ "sidebar-selection" ] ) ) :
        $sidebar_selection = $_POST[ "sidebar-selection" ];
    endif;
    update_post_meta( $post_id, "sidebar-selection", $sidebar_selection );

    // Save sidebar alignment value
    $sidebar_alignment = "";
    if( isset( $_POST[ 'sidebar-alignment' ] ) ) :
        $sidebar_alignment = $_POST[ "sidebar-alignment" ];
    endif;
    update_post_meta( $post_id, 'sidebar-alignment', $sidebar_alignment );

}
add_action( "save_post", "save_custom_meta_box", 10, 3 );