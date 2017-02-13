<?php
/**
 * Customizer configuration
 *
 * Set up configuration options for the custom Customizer
 */
Kirki::add_config( 'grafipress_settings', array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'option',
) );

/**
 * Customizer Kirki styles.
 *
 * Set up styling for the custom Customizer
 */
function grafipress_configuration_styling( $config ) {

    $config['logo_image']   = get_template_directory_uri() . '/img/defaults/gws_logo.svg';
    $config['description']  = __( 'The theme description.', 'TEXTDOMAIN' );
    $config['color_accent'] = '#ba122a';
    $config['color_back']   = '#2B3542';
    $config['width']        = '20%';

    return $config;

}
add_filter( 'kirki/config', 'grafipress_configuration_styling' );

/*Homepage Settings*/
require get_template_directory() . '/inc/customizer/customizer-homepage.php';

/** Advanced settings panel */
require get_template_directory() . '/inc/customizer/customizer-advanced.php';

/** Client settings panel */
require get_template_directory() . '/inc/customizer/customizer-client.php';

/** Footer settings panel */
require get_template_directory() . '/inc/customizer/customizer-footer.php';

/** Footer settings panel */
require get_template_directory() . '/inc/customizer/customizer-general.php';

/** Default panel integrations */
require get_template_directory() . '/inc/customizer/controls/integrated-settings/title-tagline.php';