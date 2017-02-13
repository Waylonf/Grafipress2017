<?php
/**
 * Add Advanced Settings panel.
 *
 * Add the Advanced Settings responsible for FUNCTION
 * @param   priority            integer         You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param   title               string          The title to be displayed in the panel header
 * @param   description         string          An optional description.
 */
Kirki::add_panel( 'homepage_settings', array(
    'priority'    => 10,
    'title'       => __( 'Homepage Settings', 'TEXTDOMAIN' ),
    'description' => __( 'This section controls settings that concern the sites homepage.', 'TEXTDOMAIN' ),
) );

/* Load homepage controls */
require_once plugin_dir_path( __FILE__ ) . '/controls/homepage-settings/intro-section-controls.php';
require_once plugin_dir_path( __FILE__ ) . '/controls/homepage-settings/recent-projects-controls.php';
