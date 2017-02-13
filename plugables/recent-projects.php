<div class="recent-work section" data-parallax="scroll" data-image-src="<?php echo get_stylesheet_directory_uri() .'/img/parallax/cloudsa.jpg' ?>">
	
	<div class="container">
		<h2><?php echo get_theme_mod( 'recent_projects_heading'); ?></h2>
		<p><?php echo get_theme_mod( 'recent_projects_text' ); ?></p>
	</div>

    <?php $args = array(
			'post_type'   => 'recent_work',
			'post_status' => 'publish',
	);


    $recent_work = new WP_Query( $args );

	if( $recent_work->have_posts() ) : 

		echo '<div class="container-fluid">';
		echo '<div class="row">';
		echo '<div class="owl-carousel">';

		while( $recent_work->have_posts() ) : $recent_work->the_post(); ?>

    		<a id="imagelightbox" href="<?php the_post_thumbnail_url('square_thumbnail') ?>">
    		<?php the_post_thumbnail('square_thumbnail', array('class' => 'img-responsive' ) ) ?>
    			
    		</a>


  		<?php endwhile;

  		wp_reset_postdata();

  		echo '</div> <!-- /.owl-carousel -->';
  		echo '</div> <!-- /.row -->';
  		echo '</div> <!-- /.container-fluid -->';
  		//echo '<div class="row">';
		echo '<a class="btn btn-primary btn-lg" href="' . get_post_type_archive_link( 'recent_work' ) . '">View All Projects</a>';

		endif; ?>

	</div> <!-- /.container-fluid -->
</div> <!-- /.homepage-intro <-->