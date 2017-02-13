<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Add class thumbnail img-thumbnail.
 *
 * Add class="thumbnail img-thumbnail" to attachment items.
 *
 * @package     WordPress
 * @subpackage  {THEME-NAME}
 * @since       {THEME-NAME} {THEME-VERSION}
 *
 */
if ( ! function_exists( 'gws_attachment_link_class' ) ) { 
	function gws_attachment_link_class( $html ) {		
		$postid = get_the_ID();
		$html 	= str_replace( '<a', '<a class="gallery thumbnail img-thumbnail "', $html );
		return $html;
	}
	add_filter( 'wp_get_attachment_image', 'gws_attachment_link_class', 10, 1 );
}

if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Add data-imagelightbox to images.
 *
 * Add data-imagelightbox to images withing the 'content()'.
 *
 * @since 4.0.0
 *
 * @link http://www.grafipress.co.za
 *
 */
if( ! function_exists( 'gws_add_imagelightbox_rel' ) ) {
	function gws_add_imagelightbox_rel( $content ) {
	   global $post;
	   $type		="f";
	   $pattern 	= "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	   $replacement = '<a$1href=$2$3.$4$5$6 data-imagelightbox="' . $type . '">';
	   $content 	= preg_replace( $pattern, $replacement, $content );

	   return $content;
	}
	add_filter( 'the_content', 'gws_add_imagelightbox_rel' );
	add_filter( 'wp_get_attachment_link','gws_add_imagelightbox_rel' );
	add_filter( 'wp_get_attachment_image','gws_add_imagelightbox_rel' );
}

/**
 * Remove inline <img> tag attributes.
 *
 * This function removes the inline width and height attributes in <img>
 * tags which ensures images can be displayed responsivly.
 *
 * @since 4.0.0
 *
 * @link http://www.grafipress.co.za
 *
 */
if( ! function_exists( 'gws_remove_inline_img_dimensions' ) ) {
	function gws_remove_inline_img_dimensions( $html ) {
	    /*if ( preg_match( '/<img[^>]+>/ims', $html, $matches ) ) {
	    	foreach ($matches as $match) {
	            $clean 	= preg_replace( '/(width|height)=["\'\d%\s]+/ims', "", $match );
	            $html 	= str_replace( $match, $clean, $html );
	        }
	    }*/
	    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	    return $html;
	}
	/*add_filter( 'wp_get_attachment_link', 'gws_remove_inline_img_dimensions', 10, 1 );
	add_filter( 'wp_get_attachment_image', 'gws_remove_inline_img_dimensions', 10, 1 );
	add_filter( 'post_thumbnail_html', 'gws_remove_inline_img_dimensions', 10 );
	add_filter( 'the_content', 'gws_remove_inline_img_dimensions', 10 );
	add_filter( 'get_avatar', 'gws_remove_inline_img_dimensions', 10 );*/
}

if( ! function_exists( 'gws_add_image_responsive_class' ) ) {
	function gws_add_image_responsive_class($content) {
	   global $post;
	   $pattern 	="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
	   $replacement = '<img$1class="$2 img-responsive"$3>';
	   $content 	= preg_replace( $pattern, $replacement, $content );
	   return $content;
	}
	add_filter( 'the_content', 'gws_add_image_responsive_class', 9 );
	add_filter( 'wp_get_attachment_link', 'gws_add_image_responsive_class', 10, 1 );
	add_filter( 'wp_get_attachment_image', 'gws_add_image_responsive_class', 10, 1 );
	add_filter( 'post_thumbnail_html', 'gws_add_image_responsive_class', 10 );
	add_filter( 'the_content', 'gws_add_image_responsive_class', 10 );
	add_filter( 'get_avatar', 'gws_add_image_responsive_class', 10 );
}

/**
 * Set default post thumbnail.
 *
 * This function checks to see in a post thumbnail exists and if not
 * will return a default image.
 *
 * @since 4.0.0
 *
 * @link http://www.grafipress.co.za
 *
 */
if( ! function_exists( 'gws_post_thumbnail' ) ){
	function gws_post_thumbnail( $size ){
		if ( has_post_thumbnail() ){
			global $wp_postmeta;

			$attr = array(				
				'class'	=> "img-responsive",
				'alt'	=> trim( __( 'Featured image for ', 'gws' ) . get_the_title() ),
			);

			the_post_thumbnail( $size, $attr );

		} else {
			echo '<img class="img-responsive" src="' . trailingslashit( get_stylesheet_directory_uri() ) . 'assets/img/framework/default_image_placeholder_large.jpg' . '" alt="' . __( 'No image set', 'gws' ) . '" />';
		}
	}
}

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'twentyfourteen-full-width' );
		} else {
			the_post_thumbnail();
		}
	?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'twentyfourteen-full-width' );
		} else {
			the_post_thumbnail();
		}
	?>
	</a>

	<?php endif; // End is_singular()
}

////// TESTING
/**
*
* @author pixeline
* @link https://github.com/eddiemachado/bones/issues/90
*
*/
 
/* Remove Width/Height attributes from images, for easier image responsivity. */
 
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'img_caption_shortcode', 'remove_thumbnail_dimensions');
add_filter( 'wp_caption', 'remove_thumbnail_dimensions', 10 );
add_filter( 'caption', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
 
function remove_thumbnail_dimensions( $html ) {
$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
return $html;
}
 
// HTML5: Use figure and figcaption for captions
function html5_caption($attr, $content = null) {
$output = apply_filters( 'img_caption_shortcode', '', $attr, $content );
if ( $output != '' )
return $output;
 
extract( shortcode_atts ( array(
'id' => '',
'align' => 'alignnone',
'width'=> '',
'caption' => ''
), $attr ) );
 
if ( 1 > (int) $width || empty( $caption ) )
return $content;
 
if ( $id ) $id = 'id="' . $id . '" ';
 
return '<figure ' . $id . 'class="wp-caption ' . $align . '" ><figcaption class="wp-caption-text">' . $caption . '</figcaption>'. do_shortcode( $content ) . '</figure>';
}
 
//add_filter('img_caption_shortcode', 'html5_caption',10,3);
add_shortcode( 'wp_caption', 'html5_caption' );
add_shortcode( 'caption', 'html5_caption' );