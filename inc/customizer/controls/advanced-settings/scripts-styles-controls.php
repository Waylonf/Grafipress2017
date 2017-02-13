<?php
/**
 * Add Scripts section
 *
 * Add a Scripts sectioning all the scripts controls
 */
Kirki::add_section( 'scripts_styles', array(
    'title'          => __( 'Scripts & Stylesheets', 'TEXTDOMAIN' ),
    'description'    => __( 'Control the source of stylesheets and scripts used across the website', 'TEXTDOMAIN' ),
    'panel'          => 'advanced_settings', // Not typically needed.
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

/**
 * Add Google jQuery toggle control
 *
 * Add a toggle control to load dequeue bundled WordPress
 * jQuery and load latest version from Google CDN.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'google_jquery',
    'label'       => __( 'Google jQuery', 'TEXTDOMAIN' ),
    'section'     => 'scripts_styles',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add FontAwesome Styles toggle control
 *
 * Add a toggle control to load FontAwesome stylesheets from a CDN.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'fontawesome_styles_cdn',
    'label'       => __( 'FontAwesome styles CDN', 'TEXTDOMAIN' ),
    'section'     => 'scripts_styles',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add IE Styles toggle control
 *
 * Add a toggle control to load IE stylesheets with conditional markup.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'load_ie_styles',
    'label'       => __( 'IE stylesheets', 'TEXTDOMAIN' ),
    'section'     => 'scripts_styles',
    'default'     => '0',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add HTML5 Shiv toggle control
 *
 * Add a toggle control to load HTML5 Shiv with conditional markup.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'html5shiv_cdn',
    'label'       => __( 'HTML5shiv from CDN', 'TEXTDOMAIN' ),
    'section'     => 'scripts_styles',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add Respond.js toggle control
 *
 * Add a toggle control to load Respond.js with conditional markup.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'respondjs_cdn',
    'label'       => __( 'Respond.js from CDN', 'TEXTDOMAIN' ),
    'section'     => 'scripts_styles',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add Skip Link Focus toggle control
 *
 * Add a toggle control to load Skip Link Focus script.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'skip_link_focus',
    'label'       => __( 'Load Skip Link Focus script', 'TEXTDOMAIN' ),
    'section'     => 'scripts_styles',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add Skip Link Focus toggle control
 *
 * Add a toggle control to load Skip Link Focus script.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'owl_carousel_cdn_assets',
    'label'       => __( 'Load Owl Carousel assets', 'TEXTDOMAIN' ),
    'section'     => 'scripts_styles',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );