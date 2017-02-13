<?php
/**
 * Add Widgets section
 *
 * Add a Scripts sectioning all the scripts controls
 */
Kirki::add_section( 'footer_widgets', array(
    'title'          => __( 'Footer Widgets', 'TEXTDOMAIN' ),
    'description'    => __( 'Setup footer widgets used across the website', 'TEXTDOMAIN' ),
    'panel'          => 'footer_settings', // Not typically needed.
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
	'type'        => 'radio-buttonset',
	'settings'    => 'footer_widget_count',
	'label'       => __( 'Number of Footer Widgets', 'TEXTDOMAIN' ),
	'section'     => 'footer_widgets',
	'default'     => 3,
	'priority'    => 10,
	'choices'     => array(
		0 	=> esc_attr__( 'None', 'TEXTDOMAIN' ),
		1	=> esc_attr__( '1', 'TEXTDOMAIN' ),
		2 	=> esc_attr__( '2', 'TEXTDOMAIN' ),
		3 	=> esc_attr__( '3', 'TEXTDOMAIN' ),
		4 	=> esc_attr__( '4', 'TEXTDOMAIN' ),
	),
) );

/**
 * Add footer heading colour control
 *
 * Add a colour picker to set the colour of widget titiles.
 */
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'color',
	'settings'    => 'footer_bg_color',
	'label'       => esc_attr__( 'Footer background', 'TEXTDOMAIN' ),
	'section'     => 'footer_widgets',
	'default'     => '',
	'priority'    => 10,
	'alpha'       => true,
	'output' => array(
		array(
			'element'  => '.footer',
			'property' => 'background',
		),
	),
) );

Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'typography',
	'settings'    => 'footer_heading_style',
	'label'       => esc_attr__( 'Footer heading style', 'kirki' ),
	'section'     => 'footer_widgets',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '400',
		'font-size'      => '14px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'color'          => '#333333',
	),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.widget-title',
		),
	),
) );