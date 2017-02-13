<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 */ ?>
            <?php get_template_part( 'plugables/client-logo-carousel'); ?>
            
            <footer class="site-footer" id="site-footer">

            <?php if( ! 0 == get_option( 'footer_widget_count', 3 ) ) : ?>
                <div class="container widget-container">
                    <div class="row">

                    <?php $widget_area_count = '';

                    while( $widget_area_count <= get_option( 'footer_widget_count', 3 ) ) :
                        if ( is_active_sidebar( 'footer_widget_' . $widget_area_count ) ) :  ?>

                        <div id="widget-area" class="widget-area widget-area-<?php echo $widget_area_count = ( $widget_area_count != NULL ? $widget_area_count : '1') ?> col-md-<?php echo 12 / get_option( 'footer_widget_count', '' ) ?>" role="complementary">
                            <?php dynamic_sidebar( 'footer_widget_' . $widget_area_count ); ?>
                        </div> <!--.widget-area -->

                        <?php endif;

                        $widget_area_count++;

                    endwhile; ?>

                    </div> <!-- /.row -->
                </div> <!-- /.container -->

            <?php endif; ?>
                <div class="site-info">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php gws_copyright(); ?>
                            </div>
                        </div>
                    </div>
                </div><!-- /.site-info -->
            </footer>
            <?php wp_footer(); ?>

            <script>
                
            </script>
        </div><!-- /.wrapper -->
    </body><!-- /body -->
</html><!-- /html -->