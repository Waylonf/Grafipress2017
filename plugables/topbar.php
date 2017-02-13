<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * WARNING: This file is part of the core G11 framework. DO NOT edit
 * this file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * Topbar markup generation
 *
 * This file is a core Grafipress file and should not be edited.
 *
 * @package     WordPress
 * @subpackage  {THEMENAME}
 * @since       {THEMENAME} {THEMEVERSION}
 */

function my_theme_get_option( $setting, $default ) {
    $options = get_option( 'contact_numbers', array() );
    $value = $default;
    if ( isset( $options[ $setting ] ) ) {
        $value = $options[ $setting ];
    }
    return $value;
}
?>
<?php if( 
	get_option( 'landline_numbers' ) ||
	get_option( 'mobile_numbers' )   ||
	get_option( 'email_addresses' )  ||
	get_option( 'fax_numbers' ) ) :  ?>
	
<div class="topbar">
	<div class="container">
		<div class="row">

			<div class="col-md-4">
				<?php 
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

				?>
				<img class="img-responsive" src="<?php echo $image[0] ?>">


			</div>
			
			<div class="col-md-8">

				<?php // Set default variables
				$topbar_data[] 		= '';
				$landine_numbers[] 	= get_option( 'landline_numbers' );
				$mobile_numbers[] 	= get_option( 'mobile_numbers' );
				$email_addresses[] 	= get_option( 'email_addresses' );
				$fax_numbers[] 		= get_option( 'fax_numbers' );

				// Landline numbers
				if( get_option( 'landline_numbers' ) ) : 
					foreach( $landine_numbers as $value ) :
						foreach( $value as $key => $value ) :
							// If we are using dialing codes and the dialing code is set
							if( get_option( 'use_dialing_codes' ) && 0 != $value['dial_code'] ) :
								// Send number and dialing code to format function to return a formatted number
								$topbar_data[] = '<i class="fa fa-fw fa-phone"></i>' . gws_phone( $value['number'] , $value['dial_code'], $link = get_option( 'clickable_numbers' ) );
							elseif ( 0 == $value['dial_code'] || 0 == get_option( 'use_dialing_codes' ) ) :
								$topbar_data[] = '<i class="fa fa-fw fa-phone"></i>' . gws_phone( $value['number'] , false, $link = get_option( 'clickable_numbers' ) );
							endif;
						endforeach;
					endforeach;
				endif;

				if( get_option( 'fax_numbers' ) ) : 
					foreach( $fax_numbers as $value ) :
						foreach( $value as $key => $value ) :
							// If we are using dialing codes and the dialing code is set
							if( get_option( 'use_dialing_codes' ) && 0 != $value['dial_code'] ) :
								// Send number and dialing code to format function to return a formatted number
								$topbar_data[] = '<i class="fa fa-fw fa-fax"></i>' . gws_phone( $value['number'] , $value['dial_code'], $link = get_option( 'clickable_numbers' ) );
							elseif ( 0 == $value['dial_code'] || 0 == get_option( 'use_dialing_codes' ) ) :
								$topbar_data[] = '<i class="fa fa-fw fa-fax"></i>' . gws_phone( $value['number'] , false, $link = get_option( 'clickable_numbers' ) );
							endif;
						endforeach;
					endforeach;
				endif;
				
				// Fax Numbers
				if( get_option( 'mobile_numbers' ) ) : 
					foreach( $mobile_numbers as $value ) :
						foreach( $value as $key => $value ) :
							// If we are using dialing codes and the dialing code is set
							if( get_option( 'use_dialing_codes' ) && 0 != $value['dial_code'] ) :
								// Send number and dialing code to format function to return a formatted number
								$topbar_data[] = '<i class="fa fa-fw fa-mobile"></i>' . gws_phone( $value['number'] , $value['dial_code'], $link = get_option( 'clickable_numbers' ) );
							elseif ( 0 == $value['dial_code'] || 0 == get_option( 'use_dialing_codes' ) ) :
								$topbar_data[] = '<i class="fa fa-fw fa-mobile"></i>' . gws_phone( $value['number'] , false, $link = get_option( 'clickable_numbers' ) );
							endif;
						endforeach;
					endforeach;
				endif;

				// Email addresses
				if( get_option( 'email_addresses' ) ) : 
					foreach( $email_addresses as $value ) :
						foreach( $value as $key => $value ) :
								// Send email to format function to return a formatted number
								$topbar_data[] = '<i class="fa fa-fw fa-send"></i>' . gws_email( $value['number'], $link = get_option( 'clickable_emails' ) );
						endforeach;
					endforeach;
				endif;

				// Looop through all data in array and generate list
				if( NULL != $topbar_data ) :
					echo '<ul class="list-unstyled list-inline text-right hidden-xs">';
					foreach( $topbar_data as $contact_item ) :
						if( NULL != $contact_item ) :
							echo '<li>' . $contact_item . '</li>';
						endif;
					endforeach;
					echo '</ul>';
				endif; ?>
			</div>
		<?php endif;?>			
		</div>
	</div>
</div>
