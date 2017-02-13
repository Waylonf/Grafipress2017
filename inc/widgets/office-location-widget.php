<?php 
/**
* Adds Foo_Widget widget.
*/
class Branch_Widget extends WP_Widget {

    /**
    * Register widget with WordPress.
    */
    function __construct() {
        parent::__construct(
            'branch_widget', 
            __( 'Company Branches', 'TEXTDOMAIN' ), // Name
            array( 'description' => __( 'Use this widget to render and setup the display of your company branches', 'TEXTDOMAIN' ), ) // Args
        );
    }

    /**
    * Front-end display of widget.
    *
    * @see WP_Widget::widget()
    *
    * @param array $args     Widget arguments.
    * @param array $instance Saved values from database.
    */
    public function widget( $args, $instance ) {

    	$use_icons 			= $instance['use_icons'];
    	$branch_landline 	= $instance['branch_landline'];
    	$branch_fax 		= $instance['branch_fax'];
    	$branch_mobile 		= $instance['branch_mobile'];
    	$branch_email 		= $instance['branch_email'];
    	$branch_street_01 	= $instance['branch_street_01'];
    	$branch_street_02 	= $instance['branch_street_02'];
    	$branch_suburb 		= $instance['branch_suburb'];
    	$branch_city 		= $instance['branch_city'];
    	$branch_country 	= $instance['branch_country'];

        //$profile_link_url       = get_option( 'company_profile' );
        //$display_widget_title   = $instance[ 'display_widget_title' ];
        //$display_option         = $instance[ 'display_option' ];
        //$link_text              = $instance[ 'link_text' ];
        //$tooltip                = 'data-placement="top" data-toggle="tooltip"';
        //$thumbnail_image        = get_option( 'company_profile_thumbnail', get_template_directory_uri() . '/img/defaults/profile_thumbnail.jpg' );

        echo $args[ 'before_widget' ];

            if ( ! empty( $instance[ 'title' ] ) ) :
            echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ) . $args[ 'after_title' ];
            endif;

            echo '<ul class="fa-ul">';

            // Branch Landline
        	if( ! empty( $branch_landline ) ):

        		echo '<li>';

        		// Icon
        		if( NULL != $use_icons ) : 
        			echo '<i class="fa-li fa fa-fw fa-phone"></i>&nbsp;'; 
        		endif;

        		// Landine
            	echo $branch_landline;

            	echo '</li>';
        	endif;

        	// Branch Fax
            if( ! empty( $branch_fax ) ):

            	echo '<li>';

            	// Icon
        		if( NULL != $use_icons ) : 
        			echo '<i class="fa-li fa fa-fw fa-fax"></i>&nbsp;'; 
        		endif;

        		// Fax
            	echo $branch_fax;

            	echo '</li>';

        	endif;

        	// Branch Mobile
        	if( ! empty( $branch_mobile ) ):

            	echo '<li>';

            	// Icon
        		if( NULL != $use_icons ) : 
        			echo '<i class="fa-li fa fa-fw fa-mobile"></i>&nbsp;'; 
        		endif;

        		// Mobile
            	echo gws_phone( $branch_mobile );

            	echo '</li>';

        	endif;

        	// Branch Email
        	if( ! empty( $branch_email ) ):

            	echo '<li>';

            	// Icon
        		if( NULL != $use_icons ) : 
        			echo '<i class="fa-li fa fa-fw fa-paper-plane"></i>&nbsp;'; 
        		endif;

        		// Email
            	echo gws_email( $branch_email);

            	echo '</li>';

        	endif;

        	// Branch Street Line 01
        	if( ! empty( $branch_street_01 ) ):
            	echo '<br>';
            	echo '<li>';

            	// Icon
        		if( NULL != $use_icons ) : 
        			echo '<i class="fa-li fa fa-fw fa-map-marker"></i>'; 
        		endif;
        		// Street Line 01
            	echo $branch_street_01;

                echo '<br>';

        	endif;

        	// Branch Street Line 02
        	if( ! empty( $branch_street_02 ) ):
            	
            	echo $branch_street_02;
            	
                echo '<br>';
                
        	endif;

        	// Branch Suburb
        	if( ! empty( $branch_suburb ) ):
            	
        		// Suburb
            	echo $branch_suburb;

            	echo '<br>';
            	
        	endif;

        	// Branch City
        	if( ! empty( $branch_city ) ):
            	
        		// City
            	echo $branch_city;

            	echo '<br>';
            	
        	endif;

        	// Branch Country
        	if( ! empty( $branch_country ) ):

        		// Country
            	echo $branch_country;

            	echo '<br>';
        	endif;

        	echo '</ul>';

            echo $args[ 'after_widget' ];       

    }

    /**
    * Back-end widget form.
    *
    * @see WP_Widget::form()
    *
    * @param array $instance Previously saved values from database.
    */
    public function form( $instance ) {

        $title              = !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'New title', 'TEXTDOMAIN' );
        $use_icons 			= !empty( $instance['use_icons'] ) ? $instance['use_icons'] : '';
    	$branch_landline 	= !empty( $instance['branch_landline'] ) ? $instance['branch_landline'] : '';
    	$branch_fax 		= !empty( $instance['branch_fax'] ) ? $instance['branch_fax'] : '';
    	$branch_mobile 		= !empty( $instance['branch_mobile'] ) ? $instance['branch_mobile'] : '';
    	$branch_email 		= !empty( $instance['branch_email'] ) ? $instance['branch_email'] : '';
    	$branch_street_01 	= !empty( $instance['branch_street_01'] ) ? $instance['branch_street_01'] : '';
    	$branch_street_02 	= !empty( $instance['branch_street_02'] ) ? $instance['branch_street_02'] : '';
    	$branch_suburb 		= !empty( $instance['branch_suburb'] ) ? $instance['branch_suburb'] : '';
    	$branch_city 		= !empty( $instance['branch_city'] ) ? $instance['branch_city'] : '';
    	$branch_country 	= !empty( $instance['branch_country'] ) ? $instance['branch_country'] : '';

        //$display_widget_title   = ! empty( $instance[ 'display_widget_title' ] ) ? $instance[ 'display_widget_title' ] : 1;
        //$display_option         = ! empty( $instance[ 'display_option' ] ) ? $instance[ 'display_option' ] : 'icon';
        //$link_text              = ! empty( $instance[ 'link_text' ] ) ? $instance[ 'link_text' ] : get_bloginfo( 'name' ) . ' profile';
        //$profile_description    = ! empty( $instance[ 'profile_description' ] ) ? $instance[ 'profile_description' ] : '';
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'use_icons' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'use_icons' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $use_icons ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'use_icons' ) ); ?>"><?php _e( 'Display icons?', 'TEXTDOMAIN' ); ?></label>
        </p>

        <!-- Branch Landline -->
        <p>
           <label for="<?php echo $this->get_field_id( 'branch_landline' ); ?>"><?php _e( 'Branch Landline No.:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'branch_landline' ); ?>" name="<?php echo $this->get_field_name( 'branch_landline' ); ?>" type="text" value="<?php echo esc_attr( $branch_landline ); ?>">
        </p>

        <!-- Branch Fax -->
        <p>
           <label for="<?php echo $this->get_field_id( 'branch_fax' ); ?>"><?php _e( 'Branch Fax No.:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'branch_fax' ); ?>" name="<?php echo $this->get_field_name( 'branch_fax' ); ?>" type="text" value="<?php echo esc_attr( $branch_fax ); ?>">
        </p>

        <!-- Branch Mobile -->
        <p>
           <label for="<?php echo $this->get_field_id( 'branch_mobile' ); ?>"><?php _e( 'Branch Mobile No.:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'branch_mobile' ); ?>" name="<?php echo $this->get_field_name( 'branch_mobile' ); ?>" type="text" value="<?php echo esc_attr( $branch_mobile ); ?>">
        </p>

        <!-- Branch Email -->
        <p>
           <label for="<?php echo $this->get_field_id( 'branch_email' ); ?>"><?php _e( 'Branch Email Address:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'branch_email' ); ?>" name="<?php echo $this->get_field_name( 'branch_email' ); ?>" type="text" value="<?php echo esc_attr( $branch_email ); ?>">
        </p>

        <!-- Branch Address Line 01 -->
        <p>
           <label for="<?php echo $this->get_field_id( 'branch_street_01' ); ?>"><?php _e( 'Address Line 01:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'branch_street_01' ); ?>" name="<?php echo $this->get_field_name( 'branch_street_01' ); ?>" type="text" value="<?php echo esc_attr( $branch_street_01 ); ?>">
        </p>

        <!-- Branch Address Line 02 -->
        <p>
           <label for="<?php echo $this->get_field_id( 'branch_street_02' ); ?>"><?php _e( 'Address Line 02:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'branch_street_02' ); ?>" name="<?php echo $this->get_field_name( 'branch_street_02' ); ?>" type="text" value="<?php echo esc_attr( $branch_street_02 ); ?>">
        </p>

        <!-- Branch Suburb -->
        <p>
           <label for="<?php echo $this->get_field_id( 'branch_suburb' ); ?>"><?php _e( 'Suburb:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'branch_suburb' ); ?>" name="<?php echo $this->get_field_name( 'branch_suburb' ); ?>" type="text" value="<?php echo esc_attr( $branch_suburb ); ?>">
        </p>

        <!-- Branch City -->
        <p>
           <label for="<?php echo $this->get_field_id( 'branch_city' ); ?>"><?php _e( 'City:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'branch_city' ); ?>" name="<?php echo $this->get_field_name( 'branch_city' ); ?>" type="text" value="<?php echo esc_attr( $branch_city ); ?>">
        </p>

        <!-- Branch Country -->
        <p>
           <label for="<?php echo $this->get_field_id( 'branch_country' ); ?>"><?php _e( 'Country:' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'branch_country' ); ?>" name="<?php echo $this->get_field_name( 'branch_country' ); ?>" type="text" value="<?php echo esc_attr( $branch_country ); ?>">
        </p>

        
    <?php }

    /**
    * Sanitize widget form values as they are saved.
    *
    * @see WP_Widget::update()
    *
    * @param array $new_instance Values just sent to be saved.
    * @param array $old_instance Previously saved values from database.
    *
    * @return array Updated safe values to be saved.
    */
    public function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance[ 'title' ]                = ! empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '';
        $instance[ 'use_icons' ]   			= ! empty( $new_instance[ 'use_icons' ] ) ? strip_tags( $new_instance[ 'use_icons' ] ) : '';
        $instance[ 'branch_landline' ]      = ! empty( $new_instance[ 'branch_landline' ] ) ? strip_tags( $new_instance[ 'branch_landline' ] ) : '';
        $instance[ 'branch_fax' ]      		= ! empty( $new_instance[ 'branch_fax' ] ) ? strip_tags( $new_instance[ 'branch_fax' ] ) : '';
        $instance[ 'branch_mobile' ]      	= ! empty( $new_instance[ 'branch_mobile' ] ) ? strip_tags( $new_instance[ 'branch_mobile' ] ) : '';
        $instance[ 'branch_email' ]      	= ! empty( $new_instance[ 'branch_email' ] ) ? strip_tags( $new_instance[ 'branch_email' ] ) : '';
        $instance[ 'branch_street_01' ]     = ! empty( $new_instance[ 'branch_street_01' ] ) ? strip_tags( $new_instance[ 'branch_street_01' ] ) : '';
        $instance[ 'branch_street_02' ]     = ! empty( $new_instance[ 'branch_street_02' ] ) ? strip_tags( $new_instance[ 'branch_street_02' ] ) : '';
        $instance[ 'branch_suburb' ]      	= ! empty( $new_instance[ 'branch_suburb' ] ) ? strip_tags( $new_instance[ 'branch_suburb' ] ) : '';
        $instance[ 'branch_city' ]      	= ! empty( $new_instance[ 'branch_city' ] ) ? strip_tags( $new_instance[ 'branch_city' ] ) : '';
        $instance[ 'branch_country' ]      	= ! empty( $new_instance[ 'branch_country' ] ) ? strip_tags( $new_instance[ 'branch_country' ] ) : '';

        return $instance;
    }

} // class Profile_Widget

// Register Profile_Widget widget
function register_branch_widget() {
    register_widget( 'branch_widget' );
}
add_action( 'widgets_init', 'register_branch_widget' );