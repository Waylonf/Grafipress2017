<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 */ get_header('product'); ?>
		<div class="wrapper" id="wrapper-index">
			<!-- <div class="page-header">
				<div class="container">
					<h1><?php the_title(); ?></h1>
					<p><?php echo get_the_excerpt(); ?></p>
				</div>
			</div> -->
		   	<div id="content" class="container">


			
			<?php 
			$tags = get_the_tags();

			if( $tags ) :

				echo '<ul class="list-inline list-unstyled">';
				foreach ( $tags as $tag ) :

					$tag_icon_url = "";

					switch ( $tag->slug ) {
		                case 'display':
		                    $image = '/tag-icons/display.png';
		                    break;

		                case 'cost-effective':
		                    $image = '/tag-icons/cost-effective.png';
		                    break;

		                case 'indoor':
		                    $image = '/tag-icons/indoors.png';
		                    break;

		                case 'outdoor':
		                    $image = '/tag-icons/outdoors.png';
		                    break;

	                    case 'short-lead-time':
		                    $image = '/tag-icons/quick-lead-time.png';
		                    break;

	                    case 'short-lead-time':
		                    $image = '/tag-icons/quick-lead-time.png';
		                    break;

		                default:
		                	$image = '/defaults/default-tag-icon.png';
	            	}

	            	$tag_icon_url = get_stylesheet_directory_uri() .'/img'. $image;
	            	
	            		echo '<li><img data-toggle="tooltip" data-placement="top" title="' . ucwords( $tag->name ) . '" class="img-responsive" src="' . $tag_icon_url . '" alt="' . ucwords( $tag->name ) . '"></li>';

				endforeach; 

				echo '<ul>';

			endif; ?>















	            <div class="row">
	    	       <div id="primary" class="<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?> content-area">
	                    <main id="main" class="site-main" role="main">
	                    <?php if ( have_posts() ) : ?>
	                        <?php while ( have_posts() ) : the_post(); ?>
	                        	<?php the_content(); ?>
	                        <?php endwhile; ?>
	                        <?php grafipress_paging_nav(); ?>
	                    <?php else : ?>
	                        <?php get_template_part( 'loop-templates/content', 'none' ); ?>
	                    <?php endif; ?>
	                    </main><!-- /#main -->
	    	       </div><!-- /#primary -->
	            <?php get_sidebar(); ?>
	            </div><!-- /.row -->
	       </div><!-- /.container -->
	    </div><!-- /.wrapper-->
		<?php get_footer(); ?>
   </body>
</html>