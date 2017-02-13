<?php
/**
 * Add Developer Info section
 *
 * Add a Scripts sectioning all the developer information controls
 */
Kirki::add_section( 'custom_code', array(
    'title'          => __( 'Custom Code', 'TEXTDOMAIN' ),
    'description'    => __( 'This section allows you to add basic additional code to enhance the site without having to edit core files', 'TEXTDOMAIN' ),
    'panel'          => 'advanced_settings', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

/** @var Setup control priority variable */
$field_priority = 1;

/**
 * Add Custom CSS code control.
 *
 * Add a code textarea to capture and format code for the Custom CSS control in the Code section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'code',
    'settings'    => 'custom_css',
    'label'       => __( 'Custom CSS rules', 'TEXTDOMAIN' ),
    'section'     => 'custom_code',
    'default'     => '',
    'priority'    => $field_priority++,
    'choices'     => array(
        'language' => 'css',
        'theme'    => 'neo',
        'height'   => 400,
    ),
) );

/**
 * Add Custom Javascript code control.
 *
 * Add a code textarea to capture and format code for the Custom Javascript control in the Code section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'code',
    'settings'    => 'custom_js',
    'label'       => __( 'Custom Javascript', 'TEXTDOMAIN' ),
    'section'     => 'custom_code',
    'default'     => '',
    'priority'    => $field_priority++,
    'choices'     => array(
        'language' => 'javascript',
        'theme'    => 'neo',
        'height'   => 400,
    ),
) );