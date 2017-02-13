<div class="product-category section" data-parallax="scroll" data-image-src="<?php echo get_stylesheet_directory_uri() .'/img/parallax/city2.jpg' ?>">
    <div class="container">
        <h2>Your one stop print partner</h2>
        <p>We can help you every step of the way. </p>
    
        <div id="tabs" class="row">

        <?php $args = array(
            'type'                     => 'products',
            'child_of'                 => 0,
            'parent'                   => '',
            'orderby'                  => 'term_order',
            'order'                    => 'ASC',
            'hide_empty'               => 1,
            'hierarchical'             => 1,
            'exclude'                  => '',
            'include'                  => '',
            'number'                   => '',
            'pad_counts'               => false
        );

        $categories = get_categories($args);

              

        foreach ($categories as $category) :
            $url = get_term_link($category);?>

            <a class="single-category col-md-3 col-sm-6" href="#/" class="c-tabs-nav__link is-active">

            <?php switch ( $category->slug ) {
                case 'print':
                    $image = 'print-service-icon.png';
                    break;

                case 'wrap':
                    $image = 'sign-service-icon.png';
                    break;

                case 'sign':
                    $image = 'sign-service-icon.png';
                    break;

                case 'design':
                    $image = 'design-service-icon.png';
                    break;
            } 

            $image_url = get_stylesheet_directory_uri() .'/img/product-categories/'. $image;
            echo '<img class="img-responsive" src="' . $image_url . '" alt="">'
            ?>

                <h4><?php echo $category->name; ?></h4>
            </a>        
                       
        <?php endforeach ?>

        </div> <!-- /#tabs /.row -->
    </div> <!-- /.container -->


    <div class="tab-container container-fluid">
        <div class="row">
            <div id="tab-content" class="col-md-12">

                <?php $args = array(
                    'type'                     => 'products',
                    'child_of'                 => 0,
                    //'parent'                   => '',
                    'orderby'                  => 'name',
                    //'order'                    => 'ASC',
                    'hide_empty'               => 1,
                    'hierarchical'             => 1,
                    //'exclude'                  => '',
                    //'include'                  => '',
                    //'number'                   => '',
                    'pad_counts'               => false
                );

                $categories = get_categories($args);

                      

                foreach ($categories as $category) :
                    
                    $url = get_term_link($category);?>

                    <div id="tab">
                        <div class="container">
                            <div class="row">
                                <h1><?php echo $category->name; ?></h1>
                                <h3><?php echo $category->description; ?></h3>
                            </div>

                            <div class="row">
                                
                                <?php $args = array(
                                    'posts_per_page'   => -1,
                                    'category_name'    => $category->name,
                                    'post_type'        => 'products',
                                    'post_status'      => 'publish',
                                );
                                $category_items = get_posts( $args );
                                $count_items = new WP_Query($args);                                
                                $count_items->found_posts;
                                $columns = 4;

                                $items_per_column = $count_items->found_posts / $columns;

                                $items = $items_per_column;

                                $count =1;

                                //echo '<ul class="list-unstyled col-md-' . $columns . '">';

                                foreach ($category_items as $post) :
                                
                                    if ( $count === $items || $count === 1 ) :
                                        echo '<ul class="list-unstyled col-md-' . $columns . '">';
                                    endif;

                                        echo '<li><a data-toggle="tooltip" data-placement="top" title="' . get_the_excerpt() . '" href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';

                                    if ( $count === $items || $count === 1 ) :
                                        echo '</ul>';
                                        $count = 1;
                                    else:

                                        $count++;

                                    endif;
                                    
                                endforeach;


                                wp_reset_postdata();

                                echo '</ul>';

                                ?>
                                
                            </div>
                        </div>
                    </div>
                               
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

