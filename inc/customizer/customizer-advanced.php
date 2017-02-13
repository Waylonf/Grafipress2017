<?php
/**
 * Add Advanced Settings panel.
 *
 * Add the Advanced Settings responsible for FUNCTION
 * @param   priority            integer         You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param   title               string          The title to be displayed in the panel header
 * @param   description         string          An optional description.
 */
Kirki::add_panel( 'advanced_settings', array(
    'priority'    => 10,
    'title'       => __( 'Advanced Settings', 'TEXTDOMAIN' ),
    'description' => __( 'This section controls settings that may affect functions within the site. Edit this section only if you are sure you know what you are doing', 'TEXTDOMAIN' ),
) );

/* Load scripts and stylesheets controls */
require_once plugin_dir_path( __FILE__ ) . 'controls/advanced-settings/scripts-styles-controls.php';

/* Load developer info controls */
require_once plugin_dir_path( __FILE__ ) . 'controls/advanced-settings/developer-info-controls.php';

/* Load custom code controls */
require_once plugin_dir_path( __FILE__ ) . 'controls/advanced-settings/custom-code-controls.php';

/* Load custom code controls */
require_once plugin_dir_path( __FILE__ ) . 'controls/advanced-settings/sidebar-controls.php';
