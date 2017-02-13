<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * WARNING: This file is part of the core G11 framework. DO NOT edit
 * this file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * This file contains the essential helper functions used in the theme.
 *
 * This file is a core Grafipress file and should not be edited.
 *
 * @package 	WordPress
 * @subpackage 	{THEME-NAME}
 * @since 		{THEME-NAME} {THEME-VERSION}
 */

 /**
 * Generate ordial numbers.
 *
 * Formats an integar and generates output with the correct
 * suffix eg. 1st, 2nd, 3rd, 4th etc.
 *
 * @since 4.0.0
 * @link http://www.grafipress.co.za
 */
 if ( ! function_exists( 'ordial_number' ) ) :
	function ordial_number( $num ) {
		if ( !in_array( ( $num % 100 ), array( 11, 12, 13 ) ) ) :
			switch ( $num % 10 ) {
	      		case 1:  return $num . __( 'st', 'TEXTDOMAIN' );
	      		case 2:  return $num . __( 'nd', 'TEXTDOMAIN' );
	      		case 3:  return $num . __( 'rd', 'TEXTDOMAIN' );
	    	}
	  	endif;
	  	return $num . __( 'th', 'TEXTDOMAIN' );
	}
endif;

/**
 * Format contact numbers
 *
 * This function formats contact numbers into more
 * readable formats while also being able to add markup to
 * enable clickable actions to these formated numbers. *
 */
if ( ! function_exists( 'gws_phone' ) ) :
	function gws_phone( $num , $dial_code = '', $link = true ) {

		$dial_code = get_option('dialing_codes');
		if ( ! empty ( $num ) ) :
			$num = trim ( stripslashes ( preg_replace ( '/[^0-9]/', '', $num ) ) );
			$len = strlen( $num );

			if( $len == 7 ) :
				$num = preg_replace( '/([0-9]{3})([0-9]{4})/', '$1-$2', $num );
			elseif ( $len == 10 ) :
				$num = preg_replace( '/([0-9]{1})([0-9]{2})([0-9]{3})/', '($1)$2 $3 $4', $num );
			endif;

			if ( $link ) :
				return '<a rel="nofollow" data-toggle="tooltip" data-placement="bottom" title="' .  __( 'Click to automatically dial on a mobile device', 'TEXTDOMAIN' ) . '" href="tel:' . $dial_code . ' ' . $num . '">'. $dial_code . ' ' . $num . '</a>';
			else :
				return $dial_code . ' ' . $num;
			endif;
		endif;
	}
endif;

/**
 * Format email addresses
 *
 * This function formats email addresses into more
 * readable formats while also being able to add markup to
 * enable clickable actions to these email addresses. *
 */
if ( ! function_exists( 'gws_email' ) ) :
	function gws_email( $email, $link = true ) {
		if ( ! empty( $email ) /*&& is_email( $email )*/ ) :
			if( TRUE == $link ) :
				return '<a rel="nofollow" data-toggle="tooltip" data-placement="bottom" title="' .  __( 'Click to automatically open your email client', 'TEXTDOMAIN' ) . '" href="mailto:' . $email . '"> '.  $email . '</a>';
			else :
				return $email;
			endif;
		endif;
	}
endif;

/**
 * Get Abbrieviation
 *
 * Returns an abbrieviated form of a string ie. first letter of each word.
 *
 * @since 1.0.0
 * @author Waylon Fourie
 * @uses get_permalink()
 */
if( ! function_exists( 'gws_initials' ) ) :
	function gws_initials( $string ) {
        if( ! ( empty( $string ) ) ) :
            if( strpos( $string, " ") ) :
                $string 	= explode( " ", $string );
                $count  	= count( $string );
                $new_string = '';

                for( $i = 0; $i < $count; $i++ ) {
                	$first_letter = substr( ucwords( $string[ $i ] ), 0, 1 );
                	$new_string .= $first_letter;
            	}
            	return $new_string;
            else :
                $first_letter 	= substr( ucwords( $string ), 0, 1 );
                $string 		= $first_letter;
                return $string;
            endif;
        else :
            return "empty string!";
        endif;
    }
endif;

/**
 * Get possesive form
 *
 * Returns a string with the correct possesive form.
 */
if( ! function_exists( 'gws_posesive') ) :
	function gws_posesive( $string ) {
		return $string . '\'' . ( $string[ strlen( $string ) - 1 ] != 's' ? 's' : '' );
	}
endif;

/**
 * Stacked icon markup.
 *
 * Return markup for a stacked icon set.
 */
if( ! function_exists( 'stacked_icon') ) :
	function stacked_icon( $icon = '', $shape = 'fa-circle', $echo = false ) {

		if( $icon ) :
			$icon_markup  = '<span class="fa-stack fa-lg">';
		  	$icon_markup .= '<i class="fa ' . $shape . ' fa-stack-2x"></i>';
		  	$icon_markup .= '<i class="fa ' . $icon . ' fa-stack-1x fa-inverse"></i>';
			$icon_markup .= '</span>';

			if ( $echo ) :
				echo $icon_markup;
			else :
				return $icon_markup;
			endif;

		else :
			return;
		endif;
	}
endif;

/**
 * Build physical address
 *
 * General the physical address as a urlencoded string.
 */
if( ! function_exists( 'gws_full_physical_address' ) ) :
	function gws_full_physical_address() {

		$address= '';

	    $address .= get_theme_mod( 'gws_client_address_line_one' ) . ',' ?: NULL;
		$address .= get_theme_mod( 'gws_client_address_line_two' ) . ',' ?: NULL;
		$address .= get_theme_mod( 'gws_client_address_suburb' ) . ',' ?: NULL;
		$address .= get_theme_mod( 'gws_client_address_town' ) . ',' ?: NULL;
		$address .= get_theme_mod( 'gws_client_address_province' ) . ',' ?: NULL;
		$address .= get_theme_mod( 'gws_client_address_code' ) . ',' ?: NULL;

		return $address;
	}
endif;

/**
 * Display Co-ordinates
 *
 * Retrieve the co-ordinates of a give address.
 */
function gws_display_coordinates( $address = '' ) {

	if( $address && $address != '' ) :
		$address = urlencode( $address );
	else :
		$address = urlencode( gws_full_physical_address() );
	endif;

    $url 		= "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
    $response 	= file_get_contents( $url );
    $json 		= json_decode( $response, true );

    $lat 		= gws_latitude( $json[ 'results' ][0][ 'geometry' ][ 'location' ][ 'lat' ] );
    $lng 		= gws_longitude( $json[ 'results' ][0][ 'geometry' ][ 'location' ][ 'lng' ] );

    $result 	= array( $lat, $lng );

    if( $result ) :
    	return $result;
    else :
    	return 'GPS Data not available!';
    endif;
}

/**
 * Get Permalink
 *
 * This function is used to return the permalink of a page
 * outside of the loop.
 */
if( ! function_exists( 'gws_get_permalink') ) :
	function gws_get_permalink( ) {
		$pageURL = ( @$_SERVER[ "HTTPS" ] == "on" ) ? "https://" : "http://";
		if ( $_SERVER[ "SERVER_PORT" ] != "80" ) :
    		$pageURL .= $_SERVER[ "SERVER_NAME" ] . ":" . $_SERVER[ "SERVER_PORT" ] . $_SERVER[ "REQUEST_URI" ];
		else :
    		$pageURL .= $_SERVER[ "SERVER_NAME" ] . $_SERVER[ "REQUEST_URI" ];
		endif;
		return esc_url( $pageURL );
	}
endif;

/**
 * Hex to RGBA
 *
 * this function converts a HEX color to rgba.
 */
if( ! function_exists( 'hex2rgba') ) :
	function hex2rgba( $color, $opacity = false ) {

		$default = 'rgb(0,0,0)';

		if(empty($color)) :
	          return $default;
	    endif;

        if ($color[0] == '#' ) :
        	$color = substr( $color, 1 );
        endif;

        if (strlen($color) == 6) :
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        elseif ( strlen( $color ) == 3 ) :
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        else :
            return $default;
        endif;

        $rgb =  array_map('hexdec', $hex);

        if( $opacity ) :
        	if( abs( $opacity ) > 1 ) :
        		$opacity = 1.0;
        		$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        	else :
        		$output = 'rgb('.implode(",",$rgb).')';
        	endif;
        endif;

        return $output;
	}
endif;

/**
 * Display the Log In/Out link with icons.
 *
 * Displays a link, which allows users to navigate to the Log In page to log in
 * or log out depending on whether they are currently logged in.
 */
if( ! function_exists( 'icon_loginout') ) :
	function icon_loginout( $redirect = '', $echo = true ) {

	    if ( ! is_user_logged_in() ) :
	        $link = '<a target="_blank" data-toggle="tooltip" data-placement="top" rel="nofollow" title="' . __('Log in') . '" href="' . esc_url( wp_login_url($redirect) ) . '">' . stacked_icon( 'fa-lock', 'fa-circle', false ) . '</a>';
	    else :
	        $link = '<a target="_blank" data-toggle="tooltip" data-placement="top" rel="nofollow" title="' . __('Log out') . '" href="' . esc_url( wp_logout_url($redirect) ) . '">' . stacked_icon( 'fa-unlock', 'fa-circle', false ) . '</a>';
	    endif;

	    if ( $echo ) :
	            echo apply_filters( 'loginout', $link );
	    else :
	            return apply_filters( 'loginout', $link );
	    endif;
	}
endif;

function colourBrightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}

/**
 * Display custom edit post link for post.
 */
function gws_edit_post_link( $edit_text = null, $dashboard_text = null, $id = 0 ) {
    if ( ! $post = get_post( $id ) ) :
            return;
    endif;

    if ( ! $edit_url = get_edit_post_link( $post->ID ) ) :
            return;
    endif;

    if ( ! $dashboard_url = get_admin_url() ) :
            return;
    endif;

    if ( null === $edit_text ) :
            $edit_text = __( 'Edit This' );
    endif;

    if ( null === $dashboard_text ) :
            $dashboard_text = __( 'Dashboard' );
    endif;

    $link  = '<div class="btn-group" role="group" aria-label="...">';
    $link .= '<a class="btn btn-default post-edit-link" data-toggle="tooltip" data-placement="top" title="' . $edit_text . '" target="_self" href="' . $edit_url . '"><i class="fa fa-fw fa-edit"></i></a>';
    $link .= '<a class="btn btn-default post-edit-link" data-toggle="tooltip" data-placement="top" title="' . $dashboard_text . '" target="_self" href="' . $dashboard_url . '"><i class="fa fa-fw fa-dashboard"></i></a>';
	$link .= '</div>';

    //$link = '<a class="post-edit-link" href="' . $url . '">' . $text . '</a>';

    /**
     * Filter the post edit link anchor tag.
     *
     * @since 2.3.0
     *
     * @param string $link    Anchor tag for the edit link.
     * @param int    $post_id Post ID.
     * @param string $text    Anchor text.
     */
    echo $link;
}

/**
 * Acronym or Abbrieviation
 *
 * Generate accronym or string of a string.
 */
if( ! function_exists( 'abbreviation' ) ) :
	function abbreviation( $str, $as_space = array( '-' ) ) {
	    $str = str_replace( $as_space, ' ', trim( $str ) );
	    $ret = '';

	    foreach ( explode( ' ', $str ) as $word ) :
	        $ret .= strtoupper( $word[0] );
	    endforeach;

	    return $ret;
	}
endif;

/**
 * Build physical address
 *
 * General the physical address as a urlencoded string.
 */
if( ! function_exists( 'gws_url_encode_physical_address' ) ) :
	function gws_url_encode_physical_address() {

		$address= '';

	    $address .= get_theme_mod( 'gws_client_address_line_one' ) . ',' ?: NULL;
		$address .= get_theme_mod( 'gws_client_address_line_two' ) . ',' ?: NULL;
		$address .= get_theme_mod( 'gws_client_address_suburb' ) . ',' ?: NULL;
		$address .= get_theme_mod( 'gws_client_address_town' ) . ',' ?: NULL;
		$address .= get_theme_mod( 'gws_client_address_province' ) . ',' ?: NULL;
		$address .= get_theme_mod( 'gws_client_address_code' ) . ',' ?: NULL;

		return $address;
	}
endif;

/**
 * Return custom post type description
 *
 * This function will return the description of a custom post type in
 * a page.
 */
if ( ! function_exists( 'grafipress_post_type_description' ) ) :
    function grafipress_post_type_description( $post_type = '' ) {
        $obj = get_post_type_object( $post_type );

        if ( ! empty( $obj ) ) :
            echo $obj->description;
        endif;
    }
endif;