<?php
/**
 * Add Widgets section
 *
 * Add a Scripts sectioning all the scripts controls
 */
Kirki::add_section( 'recent_projects', array(
    'title'          => __( 'Recent Projects', 'TEXTDOMAIN' ),
    'description'    => __( 'Setup options for the displaying the recent projects section', 'TEXTDOMAIN' ),
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
	'settings' => 'display_recent_projects',
	'label'    => __( 'Display Recent Projects', 'TEXTDOMAIN' ),
	'default'  => 0,
	'section'  => 'recent_projects',
) );

Kirki::add_field( 'my_config', array(
	'type'     => 'text',
	'settings' => 'recent_projects_heading',
	'label'    => __( 'Recent Projects Heading', 'TEXTDOMAIN' ),
	'section'  => 'recent_projects',
	'default'  => esc_attr__( '', 'TEXTDOMAIN' ),
	'priority' => 10,
) );

Kirki::add_field( 'my_config', array(
	'type'     => 'textarea',
	'settings' => 'recent_projects_text',
	'label'    => __( 'Recent Projects Intro Text', 'TEXTDOMAIN' ),
	'section'  => 'recent_projects',
	'default'  => esc_attr__( '', 'TEXTDOMAIN' ),
	'priority' => 10,
) );