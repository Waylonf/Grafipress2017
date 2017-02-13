<?php
/**
 * Add Widgets section
 *
 * Add a Scripts sectioning all the scripts controls
 */
Kirki::add_section( 'typography', array(
    'title'          => __( 'Typography', 'TEXTDOMAIN' ),
    'description'    => __( 'Setup text display options', 'TEXTDOMAIN' ),
    'panel'          => 'general_settings', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

/** @var Setup control priority variable */
$field_priority = 1;

Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'typography',
	'settings'    => 'general_font',
	'label'       => esc_attr__( 'Select base font', 'TEXTDOMAIN' ),
	'section'     => 'typography',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '400',
		'font-size'      => '14px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'color'          => '#333333',
	),
	'priority'    => $field_priority++,
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
) );

Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'typography',
	'settings'    => 'heading_font',
	'label'       => esc_attr__( 'Set up headings text display', 'TEXTDOMAIN' ),
	'section'     => 'typography',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		//'font-size'      => '14px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		//'subsets'        => array( 'latin-ext' ),
		//'color'          => '#333333',
		'text-transform' => 'none',
		'text-align'     => 'left'
	),
	'priority'    => $field_priority++,
	'output'      => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6',
		),
	),
) );