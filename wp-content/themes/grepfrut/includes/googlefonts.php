<?php
/**
 * Checks font options to see if a Google font is selected.
 * If so, tcsn_enqueue_google_font is called to enqueue the font.
 * Ensures that each Google font is only enqueued once.
 */
if ( !function_exists( 'tcsn_google_fonts' ) ) {
	function tcsn_google_fonts() {
	
		global $smof_data;
	
		$default = array(
					'Arial',
					'Georgia',
					'Helvetica',
					'Lucida Grande',
					'Trebuchet MS',
					'Tahoma',
					'Times New Roman',
					'Verdana',
					);
	
		$googlefonts = array(
					$smof_data['tcsn_font_body']['face'],
					$smof_data['tcsn_font_h1']['face'],
					$smof_data['tcsn_font_h2']['face'],
					$smof_data['tcsn_font_h3']['face'],
					$smof_data['tcsn_font_h4']['face'],
					$smof_data['tcsn_font_h5']['face'],
					$smof_data['tcsn_font_h6']['face'],
					$smof_data['tcsn_font_logo']['face'],
					$smof_data['tcsn_font_tagline']['face'],
					$smof_data['tcsn_font_phone']['face'],
					$smof_data['tcsn_font_menu']['face'],
					$smof_data['tcsn_font_header_btm']['face'],
					$smof_data['tcsn_font_title']['face'],
					$smof_data['tcsn_font_footer']['face'],
					$smof_data['tcsn_font_copyright']['face'],
					$smof_data['tcsn_font_button']['face'],
					);
	
		// Remove any duplicates in the list
		$googlefonts = array_unique($googlefonts);

		// Check Google Fonts against System Fonts & Call Enque Font
		foreach($googlefonts as $getfonts) {
			if(!in_array($getfonts, $default)) {
				tcsn_enqueue_google_font($getfonts);
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'tcsn_google_fonts' );

/**
 * Enqueues the Google $font that is passed
 */
 function tcsn_enqueue_google_font($font) {
	$font = explode(',', $font);
	$font = $font[0];
	// Certain Google fonts need slight tweaks in order to load properly
	// Like our friend "Raleway"
	if ( $font == 'Raleway' ){
		$font = 'Raleway:400,600';
	}else{
		$font = $font . ':400,600'; // Add more font weights if required
	}
	$font = str_replace(" ", "+", $font);
	
	wp_enqueue_style( "tcsn_typography_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}
