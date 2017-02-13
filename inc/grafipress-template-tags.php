<?php
/**
 * Display navigation to next/previous set of posts when applicable.
 */
if ( ! function_exists( 'grafipress_display_page_excerpt' ) ) :
	function grafipress_display_page_excerpt(){
		$display_page_excerpt = get_option( 'display_page_excerpts', '1' );

		if( $display_page_excerpt ) :
			return '<p class="entry-excerpt page-excerpt">' . get_the_excerpt() . '</p>';
		else :
			return;
		endif;
	}
endif;

if ( ! function_exists( 'grafipress_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function grafipress_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'TEXTDOMAIN' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'TEXTDOMAIN' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'TEXTDOMAIN' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'grafipress_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function grafipress_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'TEXTDOMAIN' ) );
		if ( $categories_list && grafipress_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'TEXTDOMAIN' ) . '</span>', $categories_list );
		}
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'TEXTDOMAIN' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'TEXTDOMAIN' ) . '</span>', $tags_list );
		}
	}
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'TEXTDOMAIN' ), __( '1 Comment', 'TEXTDOMAIN' ), __( '% Comments', 'TEXTDOMAIN' ) );
		echo '</span>';
	}
	edit_post_link( __( 'Edit', 'TEXTDOMAIN' ), '<span class="edit-link">', '</span>' );
}
endif;
