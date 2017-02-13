<?php

/**
 * Add panels
 */
Kirki::add_panel( 'backgrounds', array(
	'priority'    => 10,
	'title'       => __( 'Backgrounds', 'TEXTDOMAIN' ),
	'description' => __( 'Set background options for site areas', 'TEXTDOMAIN' ),
) );

Kirki::add_panel( 'typography', array(
	'priority'    => 10,
	'title'       => __( 'Typography', 'TEXTDOMAIN' ),
	'description' => __( 'Typography Options', 'TEXTDOMAIN' ),
) );
