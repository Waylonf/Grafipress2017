<?php
/**
 * Add Contact Information section
 *
 * Add a Contact Information sectioning all the scripts controls
 */
/*Kirki::add_section( 'theme_sidebars', array(
    'title'          => __( 'Theme Sidebars', 'TEXTDOMAIN' ),
    'description'    => __( 'Setup and define sidebars to use in the theme', 'TEXTDOMAIN' ),
    'panel'          => 'advanced_settings', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );*/

/** @var Setup control priority variable */
$field_priority = 1;

/**
 * Add Landline Number repeater control
 *
 * Add a repeater control that captures all landline numbers.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'repeater',
    'label'       => esc_attr__( 'Sidebars', 'TEXTDOMAIN' ),
    'section'     => 'theme_sidebars',
    'priority'    => $field_priority++,
    'settings'    => 'them_sidebars',
    'description' => esc_attr__( 'Sidebars alow you to display widget in certain areas of the website. Create them here and select where to display them in the page editor.', 'TEXTDOMAIN' ),
    'default'     => array(
        array(
            'link_text' => esc_attr__( 'Primary', 'my_textdomain' ),
        ),
        array(
            'link_text' => esc_attr__( 'Secondary', 'my_textdomain' ),
        ),
    ),
    'fields' => array(
        'number' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Sidebar Name', 'TEXTDOMAIN' ),
            'default'     => 'Primary',
            'description' => esc_attr__( 'Enter a name for the sidebar.', 'TEXTDOMAIN' ),
        ),
    )
) );

