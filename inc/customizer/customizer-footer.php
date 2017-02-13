<?php
/**
 * Add Advanced Settings panel.
 *
 * Add the Advanced Settings responsible for FUNCTION
 * @param   priority            integer         You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param   title               string          The title to be displayed in the panel header
 * @param   description         string          An optional description.
 */
Kirki::add_panel( 'footer_settings', array(
    'priority'    => 10,
    'title'       => __( 'Footer Settings', 'TEXTDOMAIN' ),
    'description' => __( 'This section controls settings that concern the sites footer.', 'TEXTDOMAIN' ),
) );

/* Load footer controls */
require_once plugin_dir_path( __FILE__ ) . '/controls/footer-settings/footer-widget-controls.php';
