<?php

Kirki::add_config( 'TEXTDOMAIN', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'         => 'background',
	'settings'     => 'header_background',
	'label'        => __( 'Background', 'TEXTDOMAIN' ),
	'section'      => 'header_background',
	'default'      => array(
		'color'    => '#a46497',
		'image'    => '',
		'repeat'   => 'repeat',
		'size'     => 'inherit',
		'position' => 'center-center',
		'opacity'  => 100,
	),
	'priority'     => 3,
	'output'       => '#masthead #header-wrapper',
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'         => 'background',
	'settings'     => 'offcanvas_menu_background',
	'label'        => __( 'Background', 'TEXTDOMAIN' ),
	'section'      => 'offcanvas_menu_background',
	'default'      => array(
		'color'    => '#a46497',
		'image'    => '',
		'repeat'   => 'repeat',
		'size'     => 'inherit',
		'position' => 'left-top',
	),
	'priority'     => 3,
	'output'       => '#masthead .left-offcanvas-menu',
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'         => 'background',
	'settings'     => 'offcanvas_sidebar_background',
	'label'        => __( 'Background', 'TEXTDOMAIN' ),
	'section'      => 'offcanvas_sidebar_background',
	'default'      => array(
		'color'    => '#a46497',
		'image'    => '',
		'repeat'   => 'repeat',
		'size'     => 'inherit',
		'position' => 'left-top',
	),
	'priority'     => 3,
	'output'       => 'body .offcanvas-sidebar',
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'         => 'background',
	'settings'     => 'footer_wrapper_background',
	'label'        => __( 'Background', 'TEXTDOMAIN' ),
	'section'      => 'footer',
	'default'      => array(
		'color'    => '#ededed',
		'image'    => '',
		'repeat'   => 'repeat',
		'size'     => 'inherit',
		'attach'   => 'inherit',
		'position' => 'left-top',
		'opacity'  => 100,
	),
	'priority'     => 3,
	'output'       => '#colophon',
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'checkbox',
	'mode'     => 'checkbox',
	'settings' => 'responsive_text',
	'label'    => __( 'Responsive Text', 'TEXTDOMAIN' ),
	'default'  => 0,
	'section'  => 'base_typography',
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'select',
	'settings' => 'base_typography_font_family',
	'label'    => __( 'Font Family', 'TEXTDOMAIN' ),
	'section'  => 'base_typography',
	'default'  => 'Roboto',
	'priority' => 20,
	'choices'  => Kirki_Fonts::get_font_choices(),
	'output' => array(
		'element'  => 'body',
		'property' => 'font-family',
	),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'multicheck',
	'settings' => 'base_typography_subsets',
	'label'    => __( 'Google-Font subsets', 'TEXTDOMAIN' ),
	'description' => __( 'The subsets used from Google\'s API.', 'TEXTDOMAIN' ),
	'section'  => 'base_typography',
	'default'  => 'all',
	'priority' => 22,
	'choices'  => Kirki_Fonts::get_google_font_subsets(),
	'output' => array(
		'element'  => 'body',
		'property' => 'font-subset',
	),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'slider',
	'settings' => 'base_typography_font_weight',
	'label'    => __( 'Font Weight', 'TEXTDOMAIN' ),
	'section'  => 'base_typography',
	'default'  => 300,
	'priority' => 24,
	'choices'  => array(
		'min'  => 100,
		'max'  => 900,
		'step' => 100,
	),
	'output' => array(
		'element'  => 'body',
		'property' => 'font-weight',
	),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'slider',
	'settings' => 'base_typography_font_size',
	'label'    => __( 'Font Size', 'TEXTDOMAIN' ),
	'section'  => 'base_typography',
	'default'  => 14,
	'priority' => 25,
	'choices'  => array(
		'min'  => 7,
		'max'  => 48,
		'step' => 1,
	),
	'output' => array(
		'element'  => 'html',
		'property' => 'font-size',
		'units'    => 'px',
	),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'select',
	'settings' => 'headers_typography_font_family',
	'label'    => __( 'Font Family', 'TEXTDOMAIN' ),
	'section'  => 'headers_typography',
	'default'  => 'Roboto',
	'priority' => 20,
	'choices'  => Kirki_Fonts::get_font_choices(),
	'output' => array(
		'element'  => 'h1, h2, h3, h4, h5, h6',
		'property' => 'font-family',
	),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'slider',
	'settings' => 'headers_typography_font_weight',
	'label'    => __( 'Font Weight', 'TEXTDOMAIN' ),
	'section'  => 'headers_typography',
	'default'  => 700,
	'priority' => 24,
	'choices'  => array(
		'min'  => 100,
		'max'  => 900,
		'step' => 100,
	),
	'output' => array(
		'element'  => 'h1, h2, h3, h4, h5, h6',
		'property' => 'font-weight',
	),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'select',
	'settings' => 'sitename_typography_font_family',
	'label'    => __( 'Font Family', 'TEXTDOMAIN' ),
	'section'  => 'sitename_typography',
	'default'  => 'Roboto',
	'priority' => 20,
	'choices'  => Kirki_Fonts::get_font_choices(),
	'output' => array(
		'element'  => 'h1.site-title',
		'property' => 'font-family',
	),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'slider',
	'settings' => 'sitename_typography_font_weight',
	'label'    => __( 'Font Weight', 'TEXTDOMAIN' ),
	'section'  => 'sitename_typography',
	'default'  => 700,
	'priority' => 24,
	'choices'  => array(
		'min'  => 100,
		'max'  => 900,
		'step' => 100,
	),
	'output' => array(
		'element'  => 'h1.site-title',
		'property' => 'font-weight',
	),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'slider',
	'settings' => 'sidebar_width',
	'label'    => __( 'Sidebar Width', 'TEXTDOMAIN' ),
	'subtitle' => __( 'number of columns on a 12-column grid. <strong>Set to 0 to disable the sidebar</strong>', 'TEXTDOMAIN' ),
	'section'  => 'layout',
	'default'  => 3,
	'priority' => 24,
	'choices'  => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'radio',
	'settings' => 'sidebar_position',
	'label'    => __( 'Sidebar Position', 'TEXTDOMAIN' ),
	'section'  => 'layout',
	'default'  => 'l',
	'priority' => 20,
	'choices'  => array(
		'l'    => __( 'Left', 'TEXTDOMAIN' ),
		'r'    => __( 'Right', 'TEXTDOMAIN' ),
	),
) );

if ( class_exists( 'WooCommerce' ) && ! class_exists( 'WC_Colors' ) ) {
	Kirki::add_field( 'TEXTDOMAIN', array(
		'type'        => 'custom',
		'settings'    => 'install_woocolors',
		'section'     => 'colors',
		'default'     => '<div style="background:#f2dede;padding:10px;color:#a94442;">' . __( 'You are using the WooCommerce plugin but don\'t have "<strong><a target="_blank" style="color:#c00;" href="https://wordpress.org/plugins/woocommerce-colors/">WooCommerce Colors</a></strong>" installed. Please install this plugin for additional color options.', 'TEXTDOMAIN' ) . '</div>',
		'priority'    => 1,
	) );
}

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'        => 'color',
	'settings'    => 'accent_color',
	'label'       => __( 'Accent Color', 'TEXTDOMAIN' ),
	'section'     => 'colors',
	'default'     => '#a46497',
	'description' => __( 'Used for search and comment form buttons.', 'TEXTDOMAIN' ),
	'priority'    => 1,
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'color',
	'settings' => 'text_color',
	'label'    => __( 'Text Color', 'TEXTDOMAIN' ),
	'section'  => 'colors',
	'default'  => '#222222',
	'priority' => 1,
	'output'   => array(
		'element'  => 'body, a.page-numbers, a.page-numbers:visited',
		'property' => 'color',
	),
	'description' => __( 'Change the color of the main text on your site. Please note you should choose a color with enough contrast to your background, so that it\'s  easy to read. You should also avoid using colourful text and instead prefer using dark grey or white depending on the background color of your site.', 'TEXTDOMAIN' ),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'color',
	'settings' => 'a_color',
	'label'    => __( 'Links Color', 'TEXTDOMAIN' ),
	'section'  => 'colors',
	'default'  => '#00bcd4',
	'priority' => 1,
	'output'   => array(
		'element'  => 'a',
		'property' => 'color',
	),
	'description' => __( 'The color for your links', 'TEXTDOMAIN' ),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'color',
	'settings' => 'a_hover_color',
	'label'    => __( 'Links - Hover Color', 'TEXTDOMAIN' ),
	'section'  => 'colors',
	'default'  => '#00acc1',
	'priority' => 1,
	'output'   => array(
		'element'  => 'a:hover, a:focus, a:active, a:visited:hover, a:visited:focus, a:visited:active, .top_menu ul li.current_page_item a',
		'property' => 'color',
	),
	'description' => __( 'The color for your links when a user hovers them. Traditionally this is something close to the normal links color but a different shade, enough for contrast.', 'TEXTDOMAIN' ),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'color',
	'settings' => 'a_visited_color',
	'label'    => __( 'Links - Visited Color', 'TEXTDOMAIN' ),
	'section'  => 'colors',
	'default'  => '#00bcd4',
	'priority' => 1,
	'output'   => array(
		'element'  => 'a:visited',
		'property' => 'color',
	),
	'description' => __( 'The color for your visited links. Traditionally this should be the same as the main links color, though you can choose whatever you want.', 'TEXTDOMAIN' ),
) );

if ( class_exists( 'WooCommerce' ) ) {
	Kirki::add_field( 'TEXTDOMAIN', array(
		'type'     => 'slider',
		'settings' => 'product_cat_image_height',
		'label'    => __( 'Product Category Image Height', 'TEXTDOMAIN' ),
		'subtitle' => __( 'Specify the minimum height of the category image. (percentage of screen height). Set to 0 to disable.', 'TEXTDOMAIN' ),
		'section'  => 'extras',
		'default'  => 30,
		'priority' => 24,
		'choices'  => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'output' => array(
			'element'  => '.term-description.has-term-image',
			'property' => 'min-height',
			'units'    => 'vh',
		),
	) );
}

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'select',
	'settings' => 'blog_mode',
	'label'    => __( 'Blog Mode', 'TEXTDOMAIN' ),
	'section'  => 'extras',
	'default'  => 'full',
	'priority' => 20,
	'choices'  => array(
		'excerpt' => __( 'Excerpt', 'TEXTDOMAIN' ),
		'full'    => __( 'Full', 'TEXTDOMAIN' ),
	),
) );

Kirki::add_field( 'TEXTDOMAIN', array(
	'type'     => 'select',
	'settings' => 'product_mode',
	'label'    => __( 'Single-Product Display Mode', 'TEXTDOMAIN' ),
	'section'  => 'woocommerce_colors',
	'default'  => 'default',
	'priority' => 1,
	'choices'  => array(
		'big-image' => __( 'Big Image', 'TEXTDOMAIN' ),
		'default'   => __( 'Default', 'TEXTDOMAIN' ),
	),
) );
