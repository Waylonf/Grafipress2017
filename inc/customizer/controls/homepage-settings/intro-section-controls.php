<?php
/**
 * Add Widgets section
 *
 * Add a Scripts sectioning all the scripts controls
 */
Kirki::add_section( 'homepage_settings', array(
    'title'          => __( 'Intro Section', 'TEXTDOMAIN' ),
    'description'    => __( 'Setup options for the homepage', 'TEXTDOMAIN' ),
    'panel'          => 'homepage_settings', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

/**
 * Add footer heading colour control
 *
 * Add a colour picker to set the colour of widget titiles.
 */
Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'checkbox',
	'mode'     => 'checkbox',
	'settings' => 'display_homepage_intro',
	'label'    => __( 'Display Intro Text', 'TEXTDOMAIN' ),
	'default'  => 0,
	'section'  => 'homepage_settings',
) );

Kirki::add_field( 'my_config', array(
	'type'     => 'text',
	'settings' => 'homepage_intro_heading',
	'label'    => __( 'Homepage Intro Heading', 'TEXTDOMAIN' ),
	'section'  => 'homepage_settings',
	'default'  => esc_attr__( '', 'TEXTDOMAIN' ),
	'priority' => 10,
) );

Kirki::add_field( 'my_config', array(
	'type'     => 'textarea',
	'settings' => 'homepage_intro_text',
	'label'    => __( 'Homepage Intro Text', 'TEXTDOMAIN' ),
	'section'  => 'homepage_settings',
	'default'  => esc_attr__( '', 'TEXTDOMAIN' ),
	'priority' => 10,
) );