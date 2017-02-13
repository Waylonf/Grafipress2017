<?php
// Dynamically include back-to-top link
if ( ! function_exists( 'back_to_top_link_hook' ) ) :
	function back_to_top_link_hook() {
		echo '<a href="#0" id="back-to-top" class="back-to-top">' . esc_html( 'Top', 'TEXTDOMAIN' ) . '</a>';
		echo "\n";
	}
endif;

	if( get_option( 'display_back_to_top_link' ) ) :
		add_action( 'tha_footer_after', 'back_to_top_link_hook' );
	endif;