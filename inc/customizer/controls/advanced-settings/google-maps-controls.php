<?php
/**
 * Add Contact Information section
 *
 * Add a Contact Information sectioning all the scripts controls
 * @todo  Add Google Maps button link for address
 * @todo Add metatags to address and contact information
 * @todo Add dropdowns to prepopulate City, Province and Country fields
 */
Kirki::add_section( 'google_map_settings', array( 
    'title'          => __( 'Map Settings', 'TEXTDOMAIN' ),
    'description'    => __( 'Setup and define the display of your map', 'TEXTDOMAIN' ),
    'panel'          => 'advanced_settings', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
) );

/** @var Setup control priority variable */
$field_priority = 1;

Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'text',
	'settings' => 'map_api_key',
	'label'    => __( 'Google Map API key', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'default'  => '',
	'description' => __( 'To make use of Google maps you will need to get a free API key <a href="#">here</a>', 'TEXTDOMAIN'),
	'priority' => $field_priority++,
) );

Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'text',
	'settings' => 'map_lat',
	'label'    => __( 'Location lattitude', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'default'  => '',
	'priority' => $field_priority++,
) );

Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'text',
	'settings' => 'map_long',
	'label'    => __( 'Location longatude', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'default'  => '',
	'priority' => $field_priority++,
) );

// Minimum allowed map zoom level
Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'slider',
	'settings' => 'map_height',
	'label'    => __( 'Map height', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'Set map height', 'TEXTDOMAIN'),
	'default'  => 300,
	'priority' => $field_priority++,
	'choices'  => array(
		'min'  => 100,
		'max'  => 1000,
		'step' => 1,
	),
) );

// Initial map zoom level
Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'slider',
	'settings' => 'map_zoom',
	'label'    => __( 'Map Zoom', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'The initial zoom level when your map loads', 'TEXTDOMAIN'),
	'default'  => 15,
	'priority' => $field_priority++,
	'choices'  => array(
		'min'  => 1,
		'max'  => 20,
		'step' => 1,
	),
) );

// Minimum allowed map zoom level
/*Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'slider',
	'settings' => 'min_map_zoom',
	'label'    => __( 'Min Map Zoom', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'Min allowed zoom level', 'TEXTDOMAIN'),
	'default'  => 6,
	'priority' => $field_priority++,
	'choices'  => array(
		'min'  => 1,
		'max'  => 20,
		'step' => 1,
	),
) );*/

// Maximum allowed map zoom level
/*Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'slider',
	'settings' => 'max_map_zoom',
	'label'    => __( 'Max Map Zoom', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'Max allowed zoom level', 'TEXTDOMAIN'),
	'default'  => 17,
	'priority' => $field_priority++,
	'choices'  => array(
		'min'  => 1,
		'max'  => 20,
		'step' => 1,
	),
) );*/

// Display zoom controls
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'map_disable_ui',
    'label'       => __( 'Disable UI', 'TEXTDOMAIN' ),
    'section'     => 'google_map_settings',
    'description' => __( 'Disables the default UI entirely', 'TEXTDOMAIN'),
    'default'     => true,
    'priority' => $field_priority++,
    'choices'     => array(
        'true'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'false' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

// Display zoom controls
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'map_display_zoom_control',
    'label'       => __( 'Display zoom controls', 'TEXTDOMAIN' ),
    'section'     => 'google_map_settings',
    'description' => __( 'To hide all zoom controls set to off.', 'TEXTDOMAIN'),
    'default'     => 'false',
    'priority' => $field_priority++,
    'choices'     => array(
        'true'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'false' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
    'active_callback'  => array(
		array(
			'setting'  => 'map_disable_ui',
			'operator' => '!=',
			'value'    => true,
		),		
	)
) );

// Display zoom controls
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'map_display_type_control',
    'label'       => __( 'Map type controls', 'TEXTDOMAIN' ),
    'section'     => 'google_map_settings',
    'description' => __( 'Display map type control?.', 'TEXTDOMAIN'),
    'default'     => 'false',
    'priority' => $field_priority++,
    'choices'     => array(
        'true'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'false' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
    'active_callback'  => array(
		array(
			'setting'  => 'map_disable_ui',
			'operator' => '!=',
			'value'    => true,
		),		
	)
) );

// Map display type
Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'select',
	'settings' => 'map_display_type_default',
	'label'    => __( 'Map Type', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'Set the type of Map.', 'TEXTDOMAIN'),
	'default'  => 'roadmap',
	'priority' => $field_priority++,
	'choices'  => array(
		'roadmap' 		=> __( 'Roadmap', 'TEXTDOMAIN' ),
		'satellite'    	=> __( 'Satellite', 'TEXTDOMAIN' ),
		'hybrid'    	=> __( 'Hybrid', 'TEXTDOMAIN' ),
		'terrain'    	=> __( 'Terrain', 'TEXTDOMAIN' ),
	),
) );

// Map display type
Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'toggle',
	'settings' => 'map_display_scale_control',
	'label'    => __( 'Scale control', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'Display scale control that provides a simple map scale.', 'TEXTDOMAIN'),
	'default'  => 'false',
	'priority' => $field_priority++,
	'choices'     => array(
        'true'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'false' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
    'active_callback'  => array(
		array(
			'setting'  => 'map_disable_ui',
			'operator' => '!=',
			'value'    => true,
		),		
	)
) );

// Map display type
Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'toggle',
	'settings' => 'map_display_streetview_control',
	'label'    => __( 'Streetview control', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'Display Pegman control that lets visitors activate a Street View panorama.', 'TEXTDOMAIN'),
	'default'  => 'false',
	'priority' => $field_priority++,
	'choices'     => array(
        'true'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'false' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
    'active_callback'  => array(
		array(
			'setting'  => 'map_disable_ui',
			'operator' => '!=',
			'value'    => true,
		),		
	)
) );

// Map display type
Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'toggle',
	'settings' => 'map_display_rotate_control',
	'label'    => __( 'Rotate control', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'Display Rotate control for controlling the orientation of 45° imagery.', 'TEXTDOMAIN'),
	'default'  => 'false',
	'priority' => $field_priority++,
	'choices'     => array(
        'true'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'false' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
    'active_callback'  => array(
		array(
			'setting'  => 'map_disable_ui',
			'operator' => '!=',
			'value'    => true,
		),		
	)
) );

// Map display type
Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'toggle',
	'settings' => 'map_display_fullscreen_control',
	'label'    => __( 'Fullscreen control', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'Display control that opens the map in fullscreen mode.', 'TEXTDOMAIN'),
	'default'  => 'false',
	'priority' => $field_priority++,
	'choices'     => array(
        'true'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'false' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
    'active_callback'  => array(
		array(
			'setting'  => 'map_disable_ui',
			'operator' => '!=',
			'value'    => true,
		),		
	)
) );

// Map display type
Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'select',
	'settings' => 'map_gesture_handling',
	'label'    => __( 'Scrolling and Panning Behavior', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'Set the scrolling and panning behaviour of a map when viewed on a mobile device.', 'TEXTDOMAIN'),
	'default'  => 'none',
	'priority' => $field_priority++,
	'choices'  => array(
		'greedy' 		=> __( 'Greedy', 'TEXTDOMAIN' ),
		'cooperative'   => __( 'Cooperative', 'TEXTDOMAIN' ),
		'none'    		=> __( 'None', 'TEXTDOMAIN' ),
		'auto'    		=> __( 'Auto', 'TEXTDOMAIN' ),
	),
) );

// Map display type
Kirki::add_field( 'grafipress_settings', array(
	'type'     => 'toggle',
	'settings' => 'map_use_custom_map_marker',
	'label'    => __( 'Custom map marker', 'TEXTDOMAIN' ),
	'section'  => 'google_map_settings',
	'description' => __( 'Use custom map marker.', 'TEXTDOMAIN'),
	'default'  => 'false',
	'priority' => $field_priority++,
	'choices'     => array(
        'true'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'false' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
    
) );

Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'image',
	'settings'    => 'map_marker_image',
	'label'       => __( 'Map marker image', 'TEXTDOMAIN' ),
	'description' => __( 'Set a custom map marker image', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => get_stylesheet_directory_uri() . '/img/defaults/map-marker.svg',
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_use_custom_map_marker',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'dimension',
	'settings'    => 'map_marker_image_width',
	'label'       => __( 'Map marker width', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => '64',
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_use_custom_map_marker',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'dimension',
	'settings'    => 'map_marker_image_height',
	'label'       => __( 'Map marker height', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => '64',
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_use_custom_map_marker',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );


// Alternative text for mouse over marker
Kirki::add_field( 'grafipress_settings', array(
	'type'     		=> 'text',
	'settings' 		=> 'map_marker_alt_text',
	'label'    		=> __( 'Map marker hover text', 'TEXTDOMAIN' ),
	'description' 	=> __( 'Enter the text to display when user hovers over the clickable marker.', 'TEXTDOMAIN'),
	'section'  		=> 'google_map_settings',
	'default'  		=> esc_attr__( 'Click here to visit our site', 'TEXTDOMAIN' ),
	'priority' 		=> $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_use_custom_map_marker',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

// Display info window popup
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'display_map_info_window_display',
    'label'       => __( 'Marker info window', 'TEXTDOMAIN' ),
    'section'     => 'google_map_settings',
    'description' => __( 'Display map marker information window', 'TEXTDOMAIN'),
    'default'     => 'true',
    'priority' => $field_priority++,
    'choices'     => array(
        'true'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'false' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

// Alternative text for mouse over marker
Kirki::add_field( 'grafipress_settings', array(
	'type'     		=> 'text',
	'settings' 		=> 'infowindow_heading_text',
	'label'    		=> __( 'Info window heading', 'TEXTDOMAIN' ),
	'description' 	=> __( 'Enter the heading for the map info window heading.', 'TEXTDOMAIN'),
	'section'  		=> 'google_map_settings',
	'default'  		=> '',
	'priority' 		=> $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'display_map_info_window_display',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

// Alternative text for mouse over marker
Kirki::add_field( 'grafipress_settings', array(
	'type'     		=> 'textarea',
	'settings' 		=> 'infowindow_content_text',
	'label'    		=> __( 'Info window text', 'TEXTDOMAIN' ),
	'description' 	=> __( 'Enter text to display in the info window.', 'TEXTDOMAIN'),
	'section'  		=> 'google_map_settings',
	'default'  		=> '',
	'priority' 		=> $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'display_map_info_window_display',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

// Display info window popup
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'map_custom_style',
    'label'       => __( 'Custom styling', 'TEXTDOMAIN' ),
    'section'     => 'google_map_settings',
    'description' => __( 'Define a custom colour scheme for the map', 'TEXTDOMAIN'),
    'default'     => 'true',
    'priority' => $field_priority++,
    'choices'     => array(
        'true'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'false' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

// Locality label colour
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'color',
	'settings'    => 'map_base_geometry_color',
	'label'       => __( 'Base: geometry colour', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => '',
	'description' => __( 'Set colour for all geometry.', 'TEXTDOMAIN' ),
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_custom_style',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

// Locality label colour
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'color',
	'settings'    => 'map_base_stroke_color',
	'label'       => __( 'Base: stroke colour', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => '',
	'description' => __( 'Set colour for all label outlines.', 'TEXTDOMAIN' ),
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_custom_style',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

// Locality label colour
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'color',
	'settings'    => 'map_base_text_color',
	'label'       => __( 'Base: text colour', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => '',
	'description' => __( 'Set colour for all labels.', 'TEXTDOMAIN' ),
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_custom_style',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

// Locality label colour
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'color',
	'settings'    => 'map_administrative_locality_color',
	'label'       => __( 'Locality: label colour', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => '',
	'description' => __( 'Set colour for all locality labels.', 'TEXTDOMAIN' ),
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_custom_style',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

// Locality label colour
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'color',
	'settings'    => 'map_poi_text_color',
	'label'       => __( 'POI: label colour', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => '',
	'description' => __( 'Set colour for all points of interest labels.', 'TEXTDOMAIN' ),
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_custom_style',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

// Locality label colour
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'color',
	'settings'    => 'map_poi_park_geometry_color',
	'label'       => __( 'POI: label colour', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => '',
	'description' => __( 'Set colour for all parks.', 'TEXTDOMAIN' ),
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_custom_style',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

// Locality label colour
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'color',
	'settings'    => 'map_road_geometry_color',
	'label'       => __( 'Roads: colour', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => '',
	'description' => __( 'Set colour for all roads.', 'TEXTDOMAIN' ),
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_custom_style',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );

// Locality label colour
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'color',
	'settings'    => 'map_highway_geometry_color',
	'label'       => __( 'Highway: colour', 'TEXTDOMAIN' ),
	'section'     => 'google_map_settings',
	'default'     => '',
	'description' => __( 'Set colour for all highways.', 'TEXTDOMAIN' ),
	'priority'    => $field_priority++,
	'active_callback'  => array(
		array(
			'setting'  => 'map_custom_style',
			'operator' => '==',
			'value'    => true,
		),		
	)
) );