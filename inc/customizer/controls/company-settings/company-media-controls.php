<?php
/**
 * Add Contact Information section
 *
 * Add a Contact Information sectioning all the scripts controls
 */
Kirki::add_section( 'file_uploads', array(
    'title'          => __( 'File Uploads', 'TEXTDOMAIN' ),
    'description'    => __( 'Manage uploads that will be made available to clients.', 'TEXTDOMAIN' ),
    'panel'          => 'company_info_settings', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

/**
 * Add company profile upload control
 *
 * Add an upload control to upload a company profile.
 */
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'upload',
	'settings'    => 'company_profile',
	'label'       => __( 'Company Profile', 'TEXTDOMAIN' ),
	'description' => __( 'Upload a company profile for download', 'TEXTDOMAIN' ),
	'section'     => 'file_uploads',
	'default'     => '',
	'priority'    => 10,
) );

/**
 * Add company profile thumbnail upload control
 *
 * Add an upload control to upload a company profile thumbnail image.
 */
Kirki::add_field( 'grafipress_settings', array(
	'type'        => 'upload',
	'settings'    => 'company_profile_thumbnail',
	'label'       => __( 'Company Profile thumbnail', 'TEXTDOMAIN' ),
	'description' => __( 'Upload a company profile thumbnail image', 'TEXTDOMAIN' ),
	'section'     => 'file_uploads',
	'default'     => get_template_directory_uri() . '/img/defaults/profile_thumbnail.jpg',
	'priority'    => 10,
) );