<?php
/**
 * The template used for displaying page content
 *
 * @package 	WordPress
 * @subpackage 	{THEME-NAME}
 * @since 		{THEME-NAME} {THEME-VERSION}
 */
?>

<article>
	
	<!-- Page heading -->
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php echo grafipress_display_page_excerpt(); ?>
	</header>
    
    <!-- Featured image -->
    <?php //echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

    <!-- Page content -->
	<div class="entry-content">
		<?php the_content(); ?>

		<!-- Page navigation -->
		<?php wp_link_pages( 
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		); ?>
	</div><!-- /.entry-content -->

	<!-- entry-footer -->
	<?php edit_post_link( __( 'Edit', 'TEXTDOMAIN' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- /.entry-footer -->' ); ?>

</article>