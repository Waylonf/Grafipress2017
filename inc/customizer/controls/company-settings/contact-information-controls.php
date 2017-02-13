<?php
/**
 * Add Contact Information section
 *
 * Add a Contact Information sectioning all the scripts controls
 * @todo  Add Google Maps button link for address
 * @todo Add metatags to address and contact information
 * @todo Add dropdowns to prepopulate City, Province and Country fields
 */
Kirki::add_section( 'contact_numbers', array(
    'title'          => __( 'Contact Numbers', 'TEXTDOMAIN' ),
    'description'    => __( 'Setup and define the contact numbers to be used in the website', 'TEXTDOMAIN' ),
    'panel'          => 'company_info_settings', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

/** @var Setup control priority variable */
$field_priority = 1;

/**
 * Add Company name control
 *
 * Add a textfield to set up company name
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'     => 'text',
    'settings' => 'full_company_name',
    'label'    => __( 'Full company name', 'TEXTDOMAIN' ),
    'section'  => 'contact_numbers',
    'default'  => esc_attr__( '', 'TEXTDOMAIN' ),
    'priority' => $field_priority++,
) );

/**
 * Add Clickable Numbers toggle control
 *
 * Add a toggle control to either link the contact numbers in
 * anchor link markup or not.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'clickable_numbers',
    'label'       => __( 'Clickable Numbers', 'TEXTDOMAIN' ),
    'section'     => 'contact_numbers',
    'default'     => 'on',
    'priority'    => $field_priority++,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add Clickable Email Addresses toggle control
 *
 * Add a toggle control to either link the email addressess in
 * anchor link markup or not.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'clickable_emails',
    'label'       => __( 'Clickable Email Addresses', 'TEXTDOMAIN' ),
    'section'     => 'contact_numbers',
    'default'     => 'on',
    'priority'    => $field_priority++,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add International Dialing Codes toggle control
 *
 * Add a toggle control to either display contact numbers in an
 * international dialing code prepended format.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'toggle',
    'settings'    => 'use_dialing_codes',
    'label'       => __( 'International Dialing Codes', 'TEXTDOMAIN' ),
    'section'     => 'contact_numbers',
    'default'     => 'on',
    'priority'    => $field_priority++,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add International Dialing Codes select control
 *
 * Add a select dropdown control that lists all international
 * dialing codes by city.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'select',
    'settings'    => 'dialing_codes',
    'label'       => __( 'Country Dialing Code', 'TEXTDOMAIN' ),
    'section'     => 'contact_numbers',
    'default'     => '+27',
    'priority'    => $field_priority++,
    'multiple'    => 1,
    'choices'     => $dial_codes,
) );

/**
 * Add Landline Number repeater control
 *
 * Add a repeater control that captures all landline numbers.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'repeater',
    'label'       => esc_attr__( 'Landline Numbers', 'TEXTDOMAIN' ),
    'section'     => 'contact_numbers',
    'priority'    => $field_priority++,
    'limit'       => '5',
    'settings'    => 'landline_numbers',
    'description' => esc_attr__( 'Enter all your landline numbers to be displayed on this site. You can add more than one as well as drag them to arrange the display', 'TEXTDOMAIN' ),
    'fields' => array(
        'dial_code'   => array(
            'type'        => 'select',
            'label'       => __( 'Dial Code', 'TEXTDOMAIN' ),
            'default'     => '+27',
            'multiple'    => 1,
            'description' => esc_attr__( 'Unique dialing code if required. Leave blank to use the global dialing code as setup above.', 'TEXTDOMAIN' ),
            'choices'     => $dial_codes,
        ),
        'number' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Landline Number', 'TEXTDOMAIN' ),
            'default'     => '000 000 0000  ',
            'description' => esc_attr__( 'Enter a landline number here.', 'TEXTDOMAIN' ),
        ),
    )
) );

/**
 * Add Mobile Number repeater control
 *
 * Add a repeater control that captures all mobile numbers.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'repeater',
    'label'       => esc_attr__( 'Mobile Numbers', 'TEXTDOMAIN' ),
    'section'     => 'contact_numbers',
    'priority'    => $field_priority++,
    'settings'    => 'mobile_numbers',
    'limit'       => '5',
    'description' => esc_attr__( 'Enter all your mobile numbers to be displayed on this site. You can add more than one as well as drag them to arrange the display.', 'TEXTDOMAIN' ),
    'fields' => array(
        'dial_code'   => array(
            'type'        => 'select',
            'label'       => __( 'Dial Code', 'TEXTDOMAIN' ),
            'default'     => '+27',
            'multiple'    => 1,
            'description' => esc_attr__( 'Unique dialing code if required. Leave blank to use the global dialing code as setup above.', 'TEXTDOMAIN' ),
            'choices'     => $dial_codes,
        ),
        'number' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Mobile Number', 'TEXTDOMAIN' ),
            'default'     => '000 000 0000  ',
            'description' => esc_attr__( 'Enter a mobile number here.', 'TEXTDOMAIN' ),
        ),
    )
) );

/**
 * Add Fax Number repeater control
 *
 * Add a repeater control that captures all fax numbers.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'repeater',
    'label'       => esc_attr__( 'Fax Numbers', 'TEXTDOMAIN' ),
    'section'     => 'contact_numbers',
    'priority'    => $field_priority++,
    'settings'    => 'fax_numbers',
    'limit'       => '5',
    'description' => esc_attr__( 'Enter all your fax numbers to be displayed on this site. You can add more than one as well as drag them to arrange the display.', 'TEXTDOMAIN' ),
    'fields' => array(
        'dial_code'   => array(
            'type'        => 'select',
            'label'       => __( 'Dial Code', 'TEXTDOMAIN' ),
            'default'     => '+27',
            'multiple'    => 1,
            'description' => esc_attr__( 'Unique dialing code if required. Leave blank to use the global dialing code as setup above.', 'TEXTDOMAIN' ),
            'choices'     => $dial_codes,
        ),
        'number' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Mobile Number', 'TEXTDOMAIN' ),
            'default'     => '000 000 0000',
            'description' => esc_attr__( 'Enter a mobile number here.', 'TEXTDOMAIN' ),
        ),
    )
) );

/**
 * Add Email Addresses repeater control
 *
 * Add a repeater control that captures all email addresses.
 */
Kirki::add_field( 'grafipress_settings', array(
    'type'        => 'repeater',
    'label'       => esc_attr__( 'Email Addresses', 'TEXTDOMAIN' ),
    'section'     => 'contact_numbers',
    'priority'    => $field_priority++,
    'settings'    => 'email_addresses',
    'limit'       => '5',
    'description' => esc_attr__( 'Enter all your email addresses to be displayed on this site. You can add more than one as well as drag them to arrange the display.', 'TEXTDOMAIN' ),
    'fields' => array(
        'number' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Email Address', 'TEXTDOMAIN' ),
            'default'     => '',
            'description' => esc_attr__( 'Enter an email address here.', 'TEXTDOMAIN' ),
        ),
    )
) );