<?php
/**
 * Add Advanced Settings panel.
 *
 * Add the Advanced Settings responsible for FUNCTION
 * @param   priority            integer         You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param   title               string          The title to be displayed in the panel header
 * @param   description         string          An optional description.
 */
Kirki::add_panel( 'company_info_settings', array(
    'priority'    => 10,
    'title'       => __( 'Company Information', 'TEXTDOMAIN' ),
    'description' => __( 'This section is used to setup contact information as well as any site or company specific information', 'TEXTDOMAIN' ),
) );

/* Load scripts and stylesheets controls */
require_once plugin_dir_path( __FILE__ ) . 'controls/company-settings/contact-information-controls.php';

/* Load developer info controls */
//require_once plugin_dir_path( __FILE__ ) . '/controls/company-settings/address-information-controls.php';

/* Load custom code controls */
require_once plugin_dir_path( __FILE__ ) . 'controls/company-settings/company-media-controls.php';
