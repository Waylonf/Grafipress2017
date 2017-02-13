<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package 	WordPress
 * @subpackage 	{THEME-NAME}
 * @since 		{THEME-NAME} {THEME-VERSION}
 */ ?>

<!-- html -->
    <!-- head --><!-- /head -->
    <!-- body -->
        <!-- .wrapper -->
            <!-- header -->
                <!-- nav --><!-- /nav -->
                <!-- site-header-image --><!-- /site-header-image -->
                <!-- site-breadcrumbs --><!-- /site-breadcrumbs -->
            <!-- /header -->
<?php get_header(); ?>
        	<main id="site-main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'loops/content', 'page' ); ?>
                <!-- article -->
                    <!-- header.entry-header -->
                        <!-- h1.entry-title --><!-- h1.entry-title -->
                        <!-- h1.entry-summary --><!-- h1.entry-summary -->
                    <!-- /header.entry-header -->
                    <!-- featured-image-markup -->
                    <!-- header.entry-content -->
                        <!-- p --><!-- /p -->
                        <!-- .page-links --><!-- /.page-links -->
                    <!-- /header.entry-content -->
                    <!-- header.entry-footer -->
                        <!-- span.edit-link --><!-- /span.edit-link -->
                    <!-- /header.entry-footer -->
                <!-- /article -->
			<?php endwhile; ?>
        	</main>

<?php get_sidebar(); ?>
            <!-- aside -->
                <!-- widget-markup -->
            <!-- /aside -->

<?php get_footer(); ?>
            <!-- footer -->
                <!-- .widget-container -->
                    <!-- .row -->
                        <!-- .widget-area -->
                            <!-- widget markup goes here -->
                        <!-- /.widget-area -->
                    <!-- /.row -->
                <!-- /.widget-container -->
                <!-- .sit-info --><!-- /.sit-info -->
            <!-- /footer -->
        <!-- /.wrapper -->
    <!-- /body -->
<!-- /html -->