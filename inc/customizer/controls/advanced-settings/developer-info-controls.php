<?php
/**
 * Add Developer Info section
 *
 * Add a Scripts sectioning all the developer information controls
 */
Kirki::add_section( 'developer_info', array(
    'title'          => __( 'Developer Info', 'TEXTDOMAIN' ),
    'description'    => __( 'Set up developer information and links', 'TEXTDOMAIN' ),
    'panel'          => 'advanced_settings', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

/** @var Setup control priority variable */
$field_priority = 1;

/**
 * Add Developer Name text control.
 *
 * Add a textfield to capture the developer name in the Developer Info section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'     => 'text',
    'settings' => 'developer_name',
    'tooltip'  => 'Enter the developer name to display in the site',
    'label'    => __( 'Developer Name', 'TEXTDOMAIN' ),
    'section'  => 'developer_info',
    'default'  => esc_attr__( 'Grafika', 'TEXTDOMAIN' ),
    'priority' => $field_priority++,
) );

/**
 * Add Developer Slogan text control.
 *
 * Add a textfield to capture the developer slogan in the Developer Info section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'     => 'text',
    'settings' => 'developer_slogan',
    'tooltip'  => 'Enter the website for the developer',
    'label'    => __( 'Developer Slogan', 'TEXTDOMAIN' ),
    'section'  => 'developer_info',
    'default'  => esc_attr__( 'Design through inspiration', 'TEXTDOMAIN' ),
    'priority' => $field_priority++,
) );

/**
 * Add Developer URL text control.
 *
 * Add a textfield to capture the developer URL in the Developer Info section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'     => 'text',
    'settings' => 'developer_url',
    'tooltip'  => 'Enter the website for the developer',
    'label'    => __( 'Developer URL', 'TEXTDOMAIN' ),
    'section'  => 'developer_info',
    'default'  => esc_url( 'http://www.grafika.co.za', 'TEXTDOMAIN' ),
    'priority' => $field_priority++,
) );

/**
 * Add Developer Telephone text control.
 *
 * Add a textfield to capture the developer's telephone number in the Developer Info section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'     => 'text',
    'settings' => 'developer_telephone',
    'tooltip'  => 'Enter the telephone number for the developer',
    'label'    => __( 'Developer telephone number', 'TEXTDOMAIN' ),
    'section'  => 'developer_info',
    'default'  => esc_attr( '082 571 4130' ),
    'priority' => $field_priority++,
) );

/**
 * Add Developer Fax text control.
 *
 * Add a textfield to capture the developer's fax number in the Developer Info section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'     => 'text',
    'settings' => 'developer_fax',
    'tooltip'  => 'Enter the fax number for the developer',
    'label'    => __( 'Developer fax number', 'TEXTDOMAIN' ),
    'section'  => 'developer_info',
    'default'  => esc_attr( '086 550 4459' ),
    'priority' => $field_priority++,
) );

/**
 * Add Developer Email text control.
 *
 * Add a textfield to capture the developer's fax number in the Developer Info section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'     => 'text',
    'settings' => 'developer_email',
    'tooltip'  => 'Enter the email address for the developer',
    'label'    => __( 'Developer email', 'TEXTDOMAIN' ),
    'section'  => 'developer_info',
    'default'  => esc_html( 'info@grafika.co.za' ),
    'priority' => $field_priority++,
) );

/**
 * Add Developer Facebook URL text control.
 *
 * Add a textfield to capture the developer's Facebook URL in the Developer Info section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'     => 'text',
    'settings' => 'developer_facebook_url',
    'tooltip'  => 'Enter the Facebook URL for the developer',
    'label'    => __( 'Developer Facebook URL', 'TEXTDOMAIN' ),
    'section'  => 'developer_info',
    'default'  => esc_url( 'https://www.facebook.com/GrafikaWeb', 'TEXTDOMAIN' ),
    'priority' => $field_priority++,
) );

/**
 * Add Developer Twitter URL text control.
 *
 * Add a textfield to capture the developer's Twitter URL in the Developer Info section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'     => 'text',
    'settings' => 'developer_twitter_url',
    'tooltip'  => 'Enter the Twitter URL for the developer',
    'label'    => __( 'Developer Twitter URL', 'TEXTDOMAIN' ),
    'section'  => 'developer_info',
    'default'  => esc_url( 'https://www.twitter.com/GrafikaWeb', 'TEXTDOMAIN' ),
    'priority' => $field_priority++,
) );

/**
 * Add Developer Linkedin URL text control.
 *
 * Add a textfield to capture the developer's Linkedin URL in the Developer Info section.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'     => 'text',
    'settings' => 'developer_linkedin_url',
    'tooltip'  => 'Enter the Linkedin URL for the developer',
    'label'    => __( 'Developer Linkedin URL', 'TEXTDOMAIN' ),
    'section'  => 'developer_info',
    'default'  => esc_url( 'https://www.linkedin.com/GrafikaWeb', 'TEXTDOMAIN' ),
    'priority' => $field_priority++,
) );