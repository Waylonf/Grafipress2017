<?php
/**
 * Add Scripts section
 *
 * Add a Scripts sectioning all the scripts controls
 */
Kirki::add_section( 'contact_numbers', array(
    'title'          => __( 'Scripts & Stylesheets', 'TEXTDOMAIN' ),
    'description'    => __( 'Control the source of stylesheets and scripts used across the website', 'TEXTDOMAIN' ),
    'panel'          => 'company_info_settings', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

/**
 * Add Bootstrap Styles toggle control
 *
 * Add a toggle control to load default Bootstrap stylesheets.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'bootstrap_styles_cdn',
    'label'       => __( 'Bootstrap styles CDN', 'TEXTDOMAIN' ),
    'section'     => 'scripts_styles',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add Bootstrap Scripts toggle control
 *
 * Add a toggle control to load default Bootstrap jQuery.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'bootstrap_scripts_cdn',
    'label'       => __( 'Bootstrap jQuery CDN', 'TEXTDOMAIN' ),
    'section'     => 'scripts_styles',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

