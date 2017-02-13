<?php

/**
 * Customizer configuration
 *
 * Set up configuration options for the custom Customizer
 *
 * @param 	capability 			string 			Any valid WordPress capability. See the WordPress Codex for details.
 * @param 	option_type			string 			Can be either option or theme_mod.
 * @param 	option_name 		string 			If you're using options instead of theme mods then you can use this to specify an option name. All your fields will then be saved as an array under that option in the WordPress database.
 * @param 	disable_output		bool 			Set to true if you don't want Kirki to automatically output any CSS for your config (defaults to false).
 * @param 	url_path			string 			@TODO
 */
Kirki::add_config( 'my_theme', array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'option',
    'url_path'      => plugin_dir_url() . 'kirki/inc/kirki',
) );

/**
 * Customizer custom styles.
 *
 * Set up styling for the custom Customizer
 *
 * @param 	logo_image 			string 			Change the logo image (URL). If omitted, the default theme info will be displayed. You may want to use a relatively large image (for example 700px wide) so that it's properly displayed on retina screens as well.
 * @param 	description 		string 			Changes the theme description. Will be visible when clicking on the theme logo.
 * @param 	color_accent 		string 			The accent color. This will be used on selected items and control details.
 * @param 	color_back			string 			The background color. This will be used on sections & panels titles.
 * @param 	width 				string 			The width of the customizer. Use any valid CSS value like for example 24%, 400px, 25em etc. In case you decide to change the width, please take into account mobile users as well.
 */
function grafipress_customizer_styling( $config ) {
    $config['logo_image']   = 'http://kirki.org/img/kirki-new-logo-white.png';
    $config['description']  = __( 'The theme description.', 'TEXTDOMAIN' );
    $config['color_accent'] = '#ba122a';
    $config['color_back']   = '#2B3542';
    //$config['width']        = '30%';

    return $config;
}
add_filter( 'kirki/config', 'grafipress_customizer_styling' );

/**
 * Add PANEL_TITLE panel.
 *
 * Add the PANEL_TITLE responsible for FUNCTION
 *
 * @param   priority            integer         You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param   title               string          The title to be displayed in the panel header
 * @param   description         string          An optional description.
 */
Kirki::add_panel( 'PANEL_ID', array(
    'priority'    => 10,
    'title'       => __( 'PANEL_TITLE', 'TEXTDOMAIN' ),
    'description' => __( 'This section controls settings that may affect functions within the site. Edit this section only if you are sure you know what you are doing', 'TEXTDOMAIN' ),
) );

/**
 * Add SECTION_NAME
 *
 * Add a SECTION_NAME sectioning all the SECTION controls.
 *
 * @param   title               string         The title to be displayed in the panel header
 * @param 	description 		string 		   An optional description.
 * @param 	panel 	 	        string 		   The panel that this section belongs to
 * @param   priority            integer        You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param 	capability 	 		string         The capability required so that users can access this setting. This is automatically set by your configuration, and if none is defined in your config then falls-back to edit_theme_options. You can use this to override your config defaults on a per-field basis.
 */
Kirki::add_section( 'SECTION_ID', array(
    'title'          => __( 'SECTION_NAME', 'TEXTDOMAIN' ),
    'description'    => __( 'DESCRIPTION', 'TEXTDOMAIN' ),
    'panel'          => 'PANEL_ID', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

/**
 * Add CONTROL NAME checkbox control
 *
 * Add a checkbox control to capture the SETTING in the SECTION section.
 *
 * @uses 	<?php if ( true == get_theme_mod( 'SETTING', true ) ) : ?> <p>Checkbox is checked</p> <?php else : ?> <p>Checkbox is unchecked</p> <?php endif; ?>
 *
 * @param 	settings			string 			The setting-name that will be used to identify this field.
 * @param 	type				string 			Set to checkbox, switch or toggle.
 * @param 	label				string 			The title that will be displayed in the control.
 * @param 	description 		string 			An optional description.
 * @param 	section				string 			Defines the section in which this field's control will be added.
 * @param 	priority 	 		integer 		You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param 	default				string|bool 	Set to '0' or '1'.
 * @param 	choices 	 		array 			If you're using switches, you can use this to change the ON/OFF labels.
 * @param 	variables 	 		array 			If you're using a compiler you can use this to define the corresponding variable names. See variables documentation for more details.
 * @param 	tooltip 	 		string 			Add a localized 	string to show an informative tooltip.
 * @param 	active_callback 	string|array 	A callable function or method returning boolean (true/false) to define if the current field will be displayed or not. Overrides the required argument if one is defined.
 * @param 	sanitize_callback 	string|array 	Not necessary since we already have a default sanitization callback in pace. If you want to override the default sanitization you can enter a callable function or method.
 * @param 	transport 	 		string 			refresh or postMessage. defaults to refresh.
 * @param 	required 	 		array 			Define field dependencies if you want to show or hide this field conditionally based on the values of other controls.
 * @param 	capability 	 		string 			The capability required so that users can access this setting. This is automatically set by your configuration, and if none is defined in your config then falls-back to edit_theme_options. You can use this to override your config defaults on a per-field basis.
 * @param 	option_type 		string 			theme_mod, option, user_meta. This option is set in your configuration but can be overriden on a per-field basis. See configuration documentation for more details.
 * @param 	option_name 		string 			This option is set in your configuration but can be overriden on a per-field basis. See configuration documentation for more details
 */
Kirki::add_field( 'CONFIG_ID', array(
    'type'        => 'checkbox',
    'settings'    => 'SETTING',
    'label'       => __( 'This is the label', 'TEXTDOMAIN' ),
    'description' => '',
    'choices'	  => '',
    'section'     => 'SECTION',
    'default'     => '1',
    'priority'    => 10,
) );

/**
 * Add CONTROL NAME switch control
 *
 * Add a switch control to capture the SETTING in the SECTION section.
 *
 * @uses 	<?php if ( true == get_theme_mod( 'SETTING', true ) ) : ?> <p>Checkbox is checked</p> <?php else : ?> <p>Checkbox is unchecked</p> <?php endif; ?>
 *
 * @param 	settings			string 			The setting-name that will be used to identify this field.
 * @param 	type				string 			Set to checkbox, switch or toggle.
 * @param 	label				string 			The title that will be displayed in the control.
 * @param 	description 		string 			An optional description.
 * @param 	section				string 			Defines the section in which this field's control will be added.
 * @param 	priority 	 		integer 		You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param 	default				string|bool 	Set to '0' or '1'.
 * @param 	choices 	 		array 			If you're using switches, you can use this to change the ON/OFF labels.
 * @param 	variables 	 		array 			If you're using a compiler you can use this to define the corresponding variable names. See variables documentation for more details.
 * @param 	tooltip 	 		string 			Add a localized 	string to show an informative tooltip.
 * @param 	active_callback 	string|array 	A callable function or method returning boolean (true/false) to define if the current field will be displayed or not. Overrides the required argument if one is defined.
 * @param 	sanitize_callback 	string|array 	Not necessary since we already have a default sanitization callback in pace. If you want to override the default sanitization you can enter a callable function or method.
 * @param 	transport 	 		string 			refresh or postMessage. defaults to refresh.
 * @param 	required 	 		array 			Define field dependencies if you want to show or hide this field conditionally based on the values of other controls.
 * @param 	capability 	 		string 			The capability required so that users can access this setting. This is automatically set by your configuration, and if none is defined in your config then falls-back to edit_theme_options. You can use this to override your config defaults on a per-field basis.
 * @param 	option_type 		string 			theme_mod, option, user_meta. This option is set in your configuration but can be overriden on a per-field basis. See configuration documentation for more details.
 * @param 	option_name 		string 			This option is set in your configuration but can be overriden on a per-field basis. See configuration documentation for more details
 */
Kirki::add_field( 'CONFIG_ID', array(
    'type'        => 'switch',
    'settings'    => 'SETTING',
    'label'       => __( 'TOGGLE_LABEL', 'TEXTDOMAIN' ),
    'section'     => 'SECTION',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );

/**
 * Add CONTROL_NAME toggle control
 *
 * Add a toggle control to capture the SETTING in the SECTION section.
 *
 * @uses 	<?php if ( true == get_theme_mod( 'SETTING', true ) ) : ?> <p>Checkbox is checked</p> <?php else : ?> <p>Checkbox is unchecked</p> <?php endif; ?>
 *
 * @param 	settings			string 			The setting-name that will be used to identify this field.
 * @param 	type				string 			Set to checkbox, switch or toggle.
 * @param 	label				string 			The title that will be displayed in the control.
 * @param 	description 		string 			An optional description.
 * @param 	section				string 			Defines the section in which this field's control will be added.
 * @param 	priority 	 		integer 		You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param 	default				string|bool 	Set to '0' or '1'.
 * @param 	choices 	 		array 			If you're using switches, you can use this to change the ON/OFF labels.
 * @param 	variables 	 		array 			If you're using a compiler you can use this to define the corresponding variable names. See variables documentation for more details.
 * @param 	tooltip 	 		string 			Add a localized 	string to show an informative tooltip.
 * @param 	active_callback 	string|array 	A callable function or method returning boolean (true/false) to define if the current field will be displayed or not. Overrides the required argument if one is defined.
 * @param 	sanitize_callback 	string|array 	Not necessary since we already have a default sanitization callback in pace. If you want to override the default sanitization you can enter a callable function or method.
 * @param 	transport 	 		string 			refresh or postMessage. defaults to refresh.
 * @param 	required 	 		array 			Define field dependencies if you want to show or hide this field conditionally based on the values of other controls.
 * @param 	capability 	 		string 			The capability required so that users can access this setting. This is automatically set by your configuration, and if none is defined in your config then falls-back to edit_theme_options. You can use this to override your config defaults on a per-field basis.
 * @param 	option_type 		string 			theme_mod, option, user_meta. This option is set in your configuration but can be overriden on a per-field basis. See configuration documentation for more details.
 * @param 	option_name 		string 			This option is set in your configuration but can be overriden on a per-field basis. See configuration documentation for more details
 */
Kirki::add_field( 'CONFIG_ID', array(
    'type'        => 'toggle',
    'settings'    => 'SETTING',
    'label'       => __( 'TOGGLE_LABEL', 'TEXTDOMAIN' ),
    'section'     => 'SECTION',
    'default'     => '1',
    'priority'    => 10,
) );

/**
 * Add CONTROL_NAME text control.
 *
 * Add a textfield to capture the SETTING in the SECTION section.
 *
 * @param   settings            string          The setting-name that will be used to identify this field.
 * @param   type                string          Set to checkbox, switch or toggle.
 * @param   label               string          The title that will be displayed in the control.
 * @param   description         string          An optional description.
 * @param   section             string          Defines the section in which this field's control will be added.
 * @param   priority            integer         You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param   default             string|bool     Set to '0' or '1'.
 * @param   choices             array           If you're using switches, you can use this to change the ON/OFF labels.
 * @param   variables           array           If you're using a compiler you can use this to define the corresponding variable names. See variables documentation for more details.
 * @param   tooltip             string          Add a localized     string to show an informative tooltip.
 * @param   active_callback     string|array    A callable function or method returning boolean (true/false) to define if the current field will be displayed or not. Overrides the required argument if one is defined.
 * @param   sanitize_callback   string|array    Not necessary since we already have a default sanitization callback in pace. If you want to override the default sanitization you can enter a callable function or method.
 * @param   transport           string          refresh or postMessage. defaults to refresh.
 * @param   required            array           Define field dependencies if you want to show or hide this field conditionally based on the values of other controls.
 * @param   capability          string          The capability required so that users can access this setting. This is automatically set by your configuration, and if none is defined in your config then falls-back to edit_theme_options. You can use this to override your config defaults on a per-field basis.
 * @param   option_type         string          theme_mod, option, user_meta. This option is set in your configuration but can be overriden on a per-field basis. See configuration documentation for more details.
 * @param   option_name         string          This option is set in your configuration but can be overriden on a per-field basis. See configuration documentation for more details
 */
Kirki::add_field( 'CONFIG_ID', array(
    'type'     => 'text',
    'settings' => 'SETTING',
    'label'    => __( 'TEXT_LABEL', 'TEXTDOMAIN' ),
    'section'  => 'SECTION',
    'default'  => esc_attr__( 'DEFAULT VALUE', 'TEXTDOMAIN' ),
    'priority' => 10,
) );

/**
 * Add CONTROL_NAME code control.
 *
 * Add a code textarea to capture and format code for the SETTING in the SECTION section.
 *
 * @param   settings            string          The setting-name that will be used to identify this field.
 * @param   type                string          Set to checkbox, switch or toggle.
 * @param   label               string          The title that will be displayed in the control.
 * @param   description         string          An optional description.
 * @param   section             string          Defines the section in which this field's control will be added.
 * @param   priority            integer         You can use priority to change the order in which your controls are added inside a section. Defaults to 10.
 * @param   default             string|bool     Set to '0' or '1'.
 * @param   choices             array           If you're using switches, you can use this to change the ON/OFF labels.
 * @param   variables           array           If you're using a compiler you can use this to define the corresponding variable names. See variables documentation for more details.
 * @param   tooltip             string          Add a localized     string to show an informative tooltip.
 * @param   active_callback     string|array    A callable function or method returning boolean (true/false) to define if the current field will be displayed or not. Overrides the required argument if one is defined.
 * @param   sanitize_callback   string|array    Not necessary since we already have a default sanitization callback in pace. If you want to override the default sanitization you can enter a callable function or method.
 * @param   transport           string          refresh or postMessage. defaults to refresh.
 * @param   required            array           Define field dependencies if you want to show or hide this field conditionally based on the values of other controls.
 * @param   capability          string          The capability required so that users can access this setting. This is automatically set by your configuration, and if none is defined in your config then falls-back to edit_theme_options. You can use this to override your config defaults on a per-field basis.
 * @param   option_type         string          theme_mod, option, user_meta. This option is set in your configuration but can be overriden on a per-field basis. See configuration documentation for more details.
 * @param   option_name         string          This option is set in your configuration but can be overriden on a per-field basis. See configuration documentation for more details
 */
Kirki::add_field( 'CONFIG_ID', array(
    'type'        => 'code',
    'settings'    => 'SETTING',
    'label'       => __( 'CODE_LABEL', 'TEXTDOMAIN' ),
    'section'     => 'SECTION',
    'default'     => 'DEFAULT',
    'priority'    => 10,
    'choices'     => array(
        'language' => 'css',
        'theme'    => 'monokai',
        'height'   => 250,
    ),
) );

Kirki::add_field( 'my_theme', array(
    'type'        => 'image',
    'settings'    => 'image_demo',
    'label'       => __( 'This is the label', 'TEXTDOMAIN' ),
    'description' => __( 'This is the control description', 'TEXTDOMAIN' ),
    'help'        => __( 'This is some extra help text.', 'TEXTDOMAIN' ),
    'section'     => 'custom_css',
    'default'     => '',
    'priority'    => 10,
) );

Kirki::add_field( 'my_theme', array(
    'type'        => 'switch',
    'settings'    => 'my_setting',
    'label'       => __( 'This is the label', 'TEXTDOMAIN' ),
    'section'     => 'custom_css',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'TEXTDOMAIN' ),
        'off' => esc_attr__( 'Disable', 'TEXTDOMAIN' ),
    ),
) );