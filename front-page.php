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
 */ get_header(); ?>

		<div class="wrapper" id="wrapper-index">

			<?php get_template_part( 'plugables/product-categories') ?>
			
			<!-- Homepage Intro -->
	        <?php if( true == get_option( 'display_homepage_intro', false ) ) : get_template_part( 'plugables/homepage-intro'); endif; ?>

	        <!-- Search Form -->
	        <div class="searchbox section">
	        	<div class="container">
	        		<?php get_search_form(); ?>
        		</div>
	        </div>

	        <!-- Recent Projects -->
	        <?php if( true == get_option( 'display_recent_projects', false ) ) : get_template_part( 'plugables/recent-projects'); endif; ?>

		   	<div class="social section primary-section">
			   	<div class="container">
	        		<h2>We <i class="fa fa-heart"></i> new friends!</h2>
	        		<ul class="list-inline list-social">
	            		<li class="social-twitter">
							<a href="#">
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
								</span>
							</a>
	            		</li>
	            		<li class="social-facebook">
	                		<a href="#">
	                			<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
								</span>
	                		</a>
	            		</li>
	            		<li class="social-google-plus">
	                		<a href="#">
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
								</span>
	                		</a>
	            		</li>
	        		</ul>
	    		</div>
    		</div>

		   	<div id="content" class="container">
		   		
	            <div class="row">
	    	       <div id="primary" class="<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?> content-area">
	                    <main id="main" class="site-main" role="main">
	                    
	                    </main><!-- /#main -->
	    	       </div><!-- /#primary -->
	    	    
	            <?php get_sidebar(); ?>
	            </div><!-- /.row -->
	       </div><!-- /.container -->
	    </div><!-- /.wrapper-->
		<?php get_footer(); ?>
		
   </body>
</html>