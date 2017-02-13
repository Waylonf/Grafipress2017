<?php
/**
 * The homepage slider.
 *
 * Displays all of the markup within the <head>
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package 	WordPress
 * @subpackage 	{THEME-NAME}
 * @since 		{THEME-NAME} {THEME-VERSION}
 */ ?>

<?php // WP_Query arguments
$args = array (
	'post_type'			=> array( 'service' ),
	'post_status'   	=> array( 'publish' ),
	'posts_per_page' 	=> -1,
	'nopaging' 			=> true,
);

// The Query
$service = new WP_Query( $args );

// The Loop
if ( $service->have_posts() ) :
	
	//$service_name 		= get_the_title( $service->ID);
	$html = "<div class=\"owl-carousel-header\">\r\n";
	
	while ( $service->have_posts() ) :									
		//$image_id 			= get_post_thumbnail_id();
		//$thumb_url_array 	= wp_get_attachment_image_src( $thumb_id, 'service_thumbnail', true);
		$service_name 		= get_the_title( $service->ID);
		$service->the_post();
		if( get_header_image() ) :
			$html .= "		<div>\r\n";
			$html .=  "			<img src=\"" . get_header_image() . "\" alt=\"\">\r\n";
			$html .= "		</div>\r\n";
		endif;
		
	endwhile;

	$html .= "</div>\r\n";

	echo $html;
endif;	
	// Restore original Post Data
	wp_reset_postdata(); ?>
