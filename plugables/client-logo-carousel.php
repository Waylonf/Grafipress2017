<?php // WP_Query arguments
$args = array (
	'post_type'			=> array( 'client' ),
	'post_status'   	=> array( 'published' ),
	'posts_per_page' 	=> -1
);

// The Query
$clients = new WP_Query( $args );

// The Loop
if ( $clients->have_posts() ) :
	$html  = "<div class=\"client-slider\">\r\n";
	$html .= "<div class=\"container\">\r\n";
	$html .= "<h2 class=\"client-slider-heading\">" . __( 'Our Clients', 'TEXTDOMAIN' ) ." </h2>\r\n";
	$html .= "<p class=\"client-slider-intro\">" . __( 'We have an ever growing list of happy, satisfied clients whose business operations have benefited greatly from our services and implementations.', 'TEXTDOMAIN' ) ." </p>\r\n";
	$html .= "<div class=\"owl-carousel\">\r\n";
	
		while ( $clients->have_posts() ) :

			// Set up variables
			$thumb_id 			= get_post_thumbnail_id();
			$thumb_url_array 	= wp_get_attachment_image_src( $thumb_id );
			$client_name 		= get_the_title(); 
			$thumb_url 			= $thumb_url_array[0];

			// Check if thumbnail exixts
			if( has_post_thumbnail() ) :
				$thumb_url = $thumb_url_array[0];
			//else :
				//$thumb_url = get_stylesheet_directory_uri() . '/img/defaults/no_logo_found.png';
			endif;

			$clients->the_post();

			$html .= "<div>\r\n";												
			$html .= "<img title=\"" . $client_name . "\" src=\" " . $thumb_url . " \" alt=\"" . $client_name . "\" class=\"img-responsive\">";

			// Check if the entry has any content
			if( $clients->has_content() != '' ) :
				// If so, add "Read more" button
				$html .= "<a href=\"" . $clients->get_the_permalink() ."\" class=\"btn\">" . __( 'Link', 'TEXTDOMAIN' ) . "</a>";
			endif;
	
			$html .= "			</div>\r\n";	
		endwhile;

	$html .= "		</div>\r\n";
	$html .= "	</div>\r\n";

	// Echo all content and markup
	echo $html;
endif;

// Restore original Post Data
wp_reset_postdata(); ?>