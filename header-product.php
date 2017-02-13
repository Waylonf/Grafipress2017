<?php
/**
 * The template for displaying the header.
 *
 * Displays all of the markup within the <head>
 *
 * @package 	WordPress
 * @subpackage 	{THEME-NAME}
 * @since 		{THEME-NAME} {THEME-VERSION}
 */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<!-- TODO Add dns prefetch with hook -->
		<!-- TODO Add dns prefetch for other resources -->
		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	
		<div class="wrapper">
			<!-- TODO Check that the skip to content link targets the correct div -->
			<a class="skip-link screen-reader-text sr-only" href="#content"><?php _e( 'Skip to content', 'TEXTDOMAIN' ); ?></a>
			<?php get_template_part( 'plugables/topbar'); ?>

			<?php if ( has_nav_menu( 'primary' ) ) { ?>
   
			<header id="masthead" class="site-header" role="banner">

				<!-- Navigation -->
				<nav id="site-navigation" class="site-navigation" role="navigation">
	            	<div class="navbar navbar-default navbar-static">
	        			<div class="container">
		                    <div class="row">
		                        <div class="col-xs-12">
		                            <div class="navbar-header">

		                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
		                                    <span class="sr-only"><?php _e( 'Toggle navigation', 'TEXTDOMAIN' ); ?></span>
		                                    <span class="icon-bar"></span>
		                                    <span class="icon-bar"></span>
		                                    <span class="icon-bar"></span>
		                                </button>

		                                <?php 
		                                	$custom_logo_id = get_theme_mod( 'custom_logo' );
											$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
										?>

	                        			<!-- Site title -->
	                        			<a class="navbar-brand image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
	                        				<img class="img-responsive" src="<?php echo $image[0] ?>">
	                    				</a>
		                            </div>

		                            <!-- The WordPress menu -->
		                            <?php wp_nav_menu(
	                                    array(
	                                        'theme_location'    => 'primary',
	                                        'container_class'   => 'collapse navbar-collapse navbar-responsive-collapse',
	                                        'menu_class'        => 'nav navbar-nav navbar-right',
	                                        'fallback_cb'       => '',
	                                        'walker'            => new wp_bootstrap_navwalker()
	                                    )
	                                ); ?>

		                        </div> <!-- /.col-md-11 or col-md-12 -->
		                    </div> <!-- /.row -->
		                </div> <!-- /.container -->
		            </div><!-- /.navbar -->
		        </nav><!-- /.site-navigation -->
	    	</header>

	    	<?php } ?>

			    <?php $header_image = get_header_image();

			    if ( !empty( $header_image ) ) : ?>
				    <!-- TODO Add inline styles in wp_header hook -->
					<div style="background: url('<?php header_image(); ?>') no-repeat; min-height: <?php echo get_custom_header()->height; ?>px;">
						<div class="container">
							<div class="site-header-image">
								<div class="page-header">
									<h1 class="page-title"><?php echo get_the_title(); ?></h1>
									<p class="page-excerpt"><?php echo get_the_excerpt(); ?></p>							
								</div>
							</div>
						</div>
						<!-- <div class="site-description" id="desc">
							<?php //bloginfo( 'description' ); ?>
						</div> -->
						<!-- </div> -->
					</div>
			    <?php endif; ?>

				<!-- Breadcrumbs -->
			    <div class="site-breadcrumbs hidden-xs">
	    			<?php gws_breadcrumbs( $custom_home_icon = '<i class="fa fa-fw fa-home"></i>' ); ?>
		    	</div> <!-- /.breadcrumb -->
