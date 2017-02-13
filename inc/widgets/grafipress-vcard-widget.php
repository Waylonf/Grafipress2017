<?php 
/**
 * Adds Foo_Widget widget.
 */
class Vcard_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'vcard_widget', 
      __( 'vCard Download Widget', 'TEXTDOMAIN' ), // Name
      array( 'description' => __( 'Use this widget to display and setup the display of your vCard download link', 'TEXTDOMAIN' ), ) // Args
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

    $vcard_link_url       = get_option( 'company_vcard' );
    $display_widget_title   = $instance[ 'display_widget_title' ];
    $display_option         = $instance[ 'display_option' ];
    $link_text              = $instance[ 'link_text' ];
    $tooltip                = 'data-placement="top" data-toggle="tooltip"';
    $thumbnail_image        = get_option( 'company_vcard_thumbnail', get_template_directory_uri() . '/img/defaults/vcard_thumbnail.jpg' );

    echo $args[ 'before_widget' ];
    
    if ( ! empty( $instance[ 'title' ] ) && NULL != $display_widget_title ) :
        echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ) . $args[ 'after_title' ];
    endif;
    
    if( $profile_link_url ) :
        
        // Format display according to set option
        switch ( $display_option ) {
            // If set to display as text only        
            case "text":
                default:
               echo '<a ' . $tooltip . ' target="_blank" title="' .  esc_attr__( 'Click to download this file', 'TEXTDOMAIN' ) . ' "href="' . esc_url( $url = $profile_link_url, $protocols = '', $_context = 'display' ) . '">' . $link_text . '</a>';
               break;
            // If set to display as text with prepended icon        
            case "icon":
               echo '<a ' . $tooltip . ' target="_blank" title="' .  esc_attr__( 'Click to download this file', 'TEXTDOMAIN' ) . ' "href="' . esc_url( $url = $profile_link_url, $protocols = '', $_context = 'display' ) . '"><i class="fa fa-fw fa-file-pdf-o"></i>' . $link_text . '</a>';
               break;
            // If set to display with thumbnail        
            case "thumbnail":
               echo '<a ' . $tooltip . ' target="_blank" title="' .  esc_attr__( 'Click to download this file', 'TEXTDOMAIN' ) . ' "href="' . esc_url( $url = $profile_link_url, $protocols = '', $_context = 'display' ) . '"><img class="img-responsive" src="' . esc_url( $thumbnail_image ) . '"></a>';
               break;
            // If no option set render as text only
            default:
               echo 'Deafult Option';
        }
    else :
        // If no file uploaded, render this text
        _e( 'Please upload a vCard', 'TEXTDOMAIN' );
    endif;

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

    $title                  = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'New title', 'TEXTDOMAIN' );
    $display_widget_title   = ! empty( $instance[ 'display_widget_title' ] ) ? $instance[ 'display_widget_title' ] : 1;
    $display_option         = ! empty( $instance[ 'display_option' ] ) ? $instance[ 'display_option' ] : 'icon';
    $link_text              = ! empty( $instance[ 'link_text' ] ) ? $instance[ 'link_text' ] : get_bloginfo( 'name' ) . ' profile';
    $profile_description    = ! empty( $instance[ 'profile_description' ] ) ? $instance[ 'profile_description' ] : '';
    ?>

    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <p>
        <input id="<?php echo esc_attr( $this->get_field_id( 'display_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_widget_title' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $display_widget_title ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'display_widget_title' ) ); ?>"><?php _e( 'Display widget title?', 'TEXTDOMAIN' ); ?></label>
    </p>
    <p>  
        <label for="<?php echo $this->get_field_id( 'display_option' ); ?>"><?php _e('Display option:', 'TEXTDOMAIN'); ?></label><br />  
        <input type="radio" id="<?php echo $this->get_field_id( 'display_option' ); ?>" name="<?php echo $this->get_field_name( 'display_option' ); ?>" value="text" <?php checked( 'text', $display_option ); ?>/> <?php _e( 'Text only', 'TEXTDOMAIN' ); ?><br />
        <input type="radio" id="<?php echo $this->get_field_id( 'display_option' ); ?>" name="<?php echo $this->get_field_name( 'display_option' ); ?>" value="icon" <?php checked( 'icon', $display_option ); ?>/> <?php _e( 'Icon', 'TEXTDOMAIN' ); ?><br />  
        <input type="radio" id="<?php echo $this->get_field_id( 'display_option' ); ?>" name="<?php echo $this->get_field_name( 'display_option' ); ?>" value="thumbnail" <?php checked( 'thumbnail', $display_option ); ?>/> <?php _e( 'Thumbnail', 'TEXTDOMAIN' ); ?><br />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'link_text' ); ?>"><?php _e( 'Link text:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'link_text' ); ?>" name="<?php echo $this->get_field_name( 'link_text' ); ?>" type="text" value="<?php echo esc_attr( $link_text ); ?>">
    </p>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id('profile_description') ); ?>"><?php _e('Profile description:', 'TEXTDOMAIN'); ?></label>
        <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('profile_description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('profile_description') ); ?>"><?php echo esc_html( $profile_description ); ?></textarea>
    </p>
    <?php 
  }

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
    
    $instance[ 'title' ]                  = ! empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '';
    $instance[ 'display_widget_title' ]   = ! empty( $new_instance[ 'display_widget_title' ] ) ? strip_tags( $new_instance[ 'display_widget_title' ] ) : '';
    $instance[ 'display_option' ]         = ! empty( $new_instance[ 'display_option' ] ) ? strip_tags( $new_instance[ 'display_option' ] ) : '';
    $instance[ 'link_text' ]              = ! empty( $new_instance[ 'link_text' ] ) ? strip_tags( $new_instance[ 'link_text' ] ) : '';
    $instance[ 'profile_description' ]    = ! empty( $new_instance[ 'profile_description' ] ) ? strip_tags( $new_instance[ 'profile_description' ] ) : '';

    return $instance;
  }

} // class Profile_Widget

// register Vcard_Widget widget
function register_vcard_widget() {
    register_widget( 'vcard_widget' );
}
add_action( 'widgets_init', 'register_vcard_widget' );