<?php
/**
 * Plugin Name:       Simple Side Tab
 * Plugin URI:        https://rumspeed.com/wordpress-plugins/simple-side-tab/
 * Description:       Display a side tab that you can easily link to any page. Customize the tab text, font and colors. It's that simple. That's Simple Side Tab.
 * Version:           1.2.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Scot Rumery
 * Author URI:        https://rumspeed.com/simple-side-tab/
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 */




/*
Simple Side Tab is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Simple Side Tab is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Simple Side Tab. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
*/




// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}




/**
 * Currently plugin version.
 */
define( 'SIMPLE_SIDE_TAB_VERSION', '1.2.3' );
define( 'SIMPLE_SIDE_TAB_BASENAME', plugin_basename(__FILE__) );




/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-side-tab-activator.php
 */
function activate_simple_side_tab() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-side-tab-activator.php';
	Simple_Side_Tab_Activator::activate();
}




/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-side-tab-deactivator.php
 */
function deactivate_simple_side_tab() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-side-tab-deactivator.php';
	Simple_Side_Tab_Deactivator::deactivate();
}




register_activation_hook( __FILE__, 'activate_simple_side_tab' );
register_deactivation_hook( __FILE__, 'deactivate_simple_side_tab' );




/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-side-tab.php';




/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_simple_side_tab() {

	$plugin = new Simple_Side_Tab();
	$plugin->run();

}




run_simple_side_tab();















// TODO: everything below this must be moved into CLASSES
// TODO: everything below this must be moved into CLASSES
// TODO: everything below this must be moved into CLASSES
// TODO: everything below this must be moved into CLASSES




// non-admin enqueues, actions, and filters (public display of the tab)
function rum_sst_display_tab() {

	if ( is_admin() ) { // return without running if we are in the admin
		return;
	}


	// set the value for the tab display to true
	// this can only be changed by the 'rum_sst_plugin_display_tab' filter)
	$rum_sst_display_tab = true;


	// apply filter for the display of the tab so it can be turned on and off conditionally
	$rum_sst_display_tab = apply_filters( 'rum_sst_plugin_display_tab', $rum_sst_display_tab );


	// do not display the tab if the value has been turned off
	if ( $rum_sst_display_tab == false ) {
		return;
	}


	// get the current page url
	$rum_current_page_url 			= rum_get_full_url();


	// get the tab url from the plugin option variable array
	$rum_sst_plugin_option_array	= get_option( 'rum_sst_plugin_options' );
	$rum_sst_tab_url				= $rum_sst_plugin_option_array[ 'tab_url' ];


	// compare the page url and the option tab - don't render the tab if the values are the same
	if ( $rum_sst_tab_url != $rum_current_page_url ) {

		// hook to get option values and dynamically render css to support the tab classes
		add_action( 'wp_head', 'rum_sst_custom_css_hook' );

		// hook to get option values and write the div for the Simple Side Tab to display
		add_action( 'wp_footer', 'rum_sst_body_tag_html' );
	}
}
add_action( 'wp', 'rum_sst_display_tab' );




// get the complete url for the current page
function rum_get_full_url() {

	// wrap contents within isset(); these variables are not available when using WP-CLI
	// GitHub issue: https://github.com/rumspeed/simple-side-tab/issues/10
	// WP Repo support: https://wordpress.org/support/topic/php-notices-undefined-index-server_port-and-server_name?replies=1#post-7623551
	if(isset($_SERVER["SERVER_NAME"])) {
		$s 			= empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$sp 		= strtolower($_SERVER["SERVER_PROTOCOL"]);
		$protocol 	= substr($sp, 0, strpos($sp, "/")) . $s;

		return $protocol . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	}
}




// action function to get option values and write the div for the Simple Side Tab to display
function rum_sst_body_tag_html() {

	// get plugin option array and store in a variable
	$rum_sst_plugin_option_array	= get_option( 'rum_sst_plugin_options' );

	// fetch individual values from the plugin option variable array
	$rum_sst_text_for_tab			= $rum_sst_plugin_option_array[ 'text_for_tab' ];
	$rum_sst_tab_url				= $rum_sst_plugin_option_array[ 'tab_url' ];


	// sanatize the output string
	$rum_sst_text_for_tab = esc_html( $rum_sst_text_for_tab );


	// apply filters for the tab text
	$rum_sst_text_for_tab = apply_filters( 'rum_sst_plugin_text_for_tab', $rum_sst_text_for_tab );


	// this field was added after the initial release so it may not be set
	if ( isset($rum_sst_plugin_option_array[ 'target_blank' ] ) ) {
		$rum_sst_target_blank			= $rum_sst_plugin_option_array[ 'target_blank' ];
	} else {
		$rum_sst_target_blank			= '0';
	}


	// this field was added after the initial release so it may not be set
	if ( isset($rum_sst_plugin_option_array[ 'left_right' ] ) ) {
		$rum_sst_left_right			= $rum_sst_plugin_option_array[ 'left_right' ];
	} else {
		$rum_sst_left_right			= 'left';
	}


	// set the page target
	if ($rum_sst_target_blank == '1') {
		$rum_sst_target_blank = ' target="_blank"';
	} else {
		$rum_sst_target_blank = '';
	}
	

	// set side of page for tab
	if ($rum_sst_left_right == 'right') {
		$rum_sst_left_right_location = 'rum_sst_right';
	} else {
		$rum_sst_left_right_location = 'rum_sst_left';
	}
	

	if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])) {

	    // if IE 7 or 8
	    // Write HTML to render tab
		echo '<a href="' . esc_url( $rum_sst_tab_url ) . '"' . $rum_sst_target_blank . '><div id="rum_sst_tab" class="rum_sst_contents less-ie-9 ' . $rum_sst_left_right_location . '">' . $rum_sst_text_for_tab . '</div></a>';
	} else {

	   // if IE>8
	   // Write HTML to render tab
	   echo '<a href="' . esc_url( $rum_sst_tab_url ) . '"' . $rum_sst_target_blank . ' id="rum_sst_tab" class="rum_sst_contents ' . $rum_sst_left_right_location . '">' . $rum_sst_text_for_tab . '</a>';
	}
}




// Display and fill the form fields for the plugin admin page
function rum_sst_options_page() {


?>

	<div class="wrap">
	<h2>Simple Side Tab</h2>
	<p>Simple Side Tab was created to give you an easy option for adding a linkable tab to the side of your WordPress website. Use it to link to your contact/support/feedback page or use it to drive traffic to a new product you just released. It's quick and easy. <em>NOTE: This plugin requires the WP_footer() hook to be fired from your theme.</em></p>
	<form method="post" action="options.php">


<?php

	settings_fields( 'rum_sst_option_group' );
	do_settings_sections( 'rum_simple_side_tab' );

	// get plugin option array and store in a variable
	$rum_sst_plugin_option_array	= get_option( 'rum_sst_plugin_options' );

	// fetch individual values from the plugin option variable array
	$rum_sst_text_for_tab			= $rum_sst_plugin_option_array[ 'text_for_tab' ];
	$rum_sst_font_family			= $rum_sst_plugin_option_array[ 'font_family' ];
	$rum_sst_tab_url				= $rum_sst_plugin_option_array[ 'tab_url' ];
	$rum_sst_pixels_from_top		= $rum_sst_plugin_option_array[ 'pixels_from_top' ];
	$rum_sst_text_color				= $rum_sst_plugin_option_array[ 'text_color' ];
	$rum_sst_tab_color				= $rum_sst_plugin_option_array[ 'tab_color' ];
	$rum_sst_hover_color			= $rum_sst_plugin_option_array[ 'hover_color' ];


	// set a default value if the option is not set
	if ( isset($rum_sst_plugin_option_array[ 'text_shadow' ] ) ) {
		$rum_sst_text_shadow			= $rum_sst_plugin_option_array[ 'text_shadow' ];
	} else {
		$rum_sst_text_shadow			= 0;
	}


	// set a default value if the option is not set
	if ( isset($rum_sst_plugin_option_array[ 'font_weight_bold' ] ) ) {
		$rum_sst_font_weight_bold		= $rum_sst_plugin_option_array[ 'font_weight_bold' ];
	} else {
		$rum_sst_font_weight_bold		= 0;
	}


	// this field was added after the initial release so it may not be set
	if ( isset($rum_sst_plugin_option_array[ 'target_blank' ] ) ) {
		$rum_sst_target_blank			= $rum_sst_plugin_option_array[ 'target_blank' ];
	} else {
		$rum_sst_target_blank			= '0';
	}

	// this field was added after the initial release so it may not be set
	if ( isset($rum_sst_plugin_option_array[ 'left_right' ] ) ) {
		$rum_sst_left_right			= $rum_sst_plugin_option_array[ 'left_right' ];
	} else {
		$rum_sst_left_right			= 'left';
	}


?>



	<script type="text/javascript">

		jQuery(document).ready(function() {
			jQuery('#colorpicker1').hide();
			jQuery('#colorpicker1').farbtastic("#color1");
			jQuery("#color1").click(function(){jQuery('#colorpicker1').slideToggle()});
		});

		jQuery(document).ready(function() {
			jQuery('#colorpicker2').hide();
			jQuery('#colorpicker2').farbtastic("#color2");
			jQuery("#color2").click(function(){jQuery('#colorpicker2').slideToggle()});
		});

		jQuery(document).ready(function() {
			jQuery('#colorpicker3').hide();
			jQuery('#colorpicker3').farbtastic("#color3");
			jQuery("#color3").click(function(){jQuery('#colorpicker3').slideToggle()});
		});

	</script>


	<table class="widefat">

		<tr valign="top">
		<th scope="row" width="230"><label for="rum_sst_text_for_tab">Text for tab</label></th>
		<td width="525"><input maxlength="30" size="25" type="text" name="rum_sst_plugin_options[text_for_tab]" value="<?php echo esc_html( $rum_sst_text_for_tab ); ?>" /></td>
		</tr>


		<tr valign="top">
		<th scope="row"><label for="rum_sst_tab_font">Select font</label></th>
		<td>
			<select name="rum_sst_plugin_options[font_family]">
				<option value="Arial, sans-serif"									<?php selected( $rum_sst_font_family, 'Arial, sans-serif' );									?>	>ARIAL</option>
				<option value="Georgia, serif"										<?php selected( $rum_sst_font_family, 'Georgia, serif' );										?>	>GEORGIA</option>
				<option value='"Helvetica Neue", Helvetica, sans-serif'				<?php selected( $rum_sst_font_family, '"Helvetica Neue", Helvetica, sans-serif' );				?>	>HELVETICA NEUE / HELVETICA</option>
				<option value='"Lucida Sans Unicode", "Lucida Grande", sans-serif'	<?php selected( $rum_sst_font_family, '"Lucida Sans Unicode", "Lucida Grande", sans-serif' );	?>	>LUCIDA</option>
				<option value="Tahoma, sans-serif"									<?php selected( $rum_sst_font_family, 'Tahoma, sans-serif' );									?>	>TAHOMA</option>
				<option value='"Trebuchet MS", sans-serif'							<?php selected( $rum_sst_font_family, '"Trebuchet MS", sans-serif' );							?>	>TREBUCHET MS</option>
				<option value="Verdana, sans-serif"									<?php selected( $rum_sst_font_family, 'Verdana, sans-serif' );									?>	>VERDANA</option>
			</select>
		</td>
		</tr>


		<tr valign="top">
		<th scope="row"><label for="rum_sst_font_weight_bold">Bold text</label></th>
		<td><input name="rum_sst_plugin_options[font_weight_bold]" type="checkbox" value="1" <?php checked( '1', $rum_sst_font_weight_bold ); ?> /></td>
		</tr>


		<tr valign="top">
		<th scope="row"><label for="rum_sst_text_shadow">Drop shadow on hover</label></th>
		<td><input name="rum_sst_plugin_options[text_shadow]" type="checkbox" value="1" <?php checked( '1', $rum_sst_text_shadow ); ?> /></td>
		</tr>


		<tr valign="top">
		<th scope="row"><label for="rum_sst_target_blank">Open link in new window</label></th>
		<td><input name="rum_sst_plugin_options[target_blank]" type="checkbox" value="1" <?php checked( '1', $rum_sst_target_blank ); ?> /></td>
		</tr>


		<tr valign="top">
		<th scope="row"><label for="rum_sst_tab_url">Tab URL</label></th>
		<td><input size="45" type="text" name="rum_sst_plugin_options[tab_url]" value="<?php echo esc_url( $rum_sst_tab_url ); ?>" /></td>
		</tr>


		<tr valign="top">
		<th scope="row"><label for="rum_sst_left_right">Show tab on left or right</label></th>
		<td>
			<input name="rum_sst_plugin_options[left_right]" type="radio" value="left" <?php checked( 'left', $rum_sst_left_right ); ?> /> Left
			<input name="rum_sst_plugin_options[left_right]" type="radio" value="right" <?php checked( 'right', $rum_sst_left_right ); ?> /> Right
		</td>
		</tr>


		<tr valign="top">
		<th scope="row"><label for="rum_sst_pixels_from_top">Position from top (px)</label></th>
		<td><input maxlength="4" size="4" type="text" name="rum_sst_plugin_options[pixels_from_top]" value="<?php echo sanitize_text_field( $rum_sst_pixels_from_top ); ?>" /></td>
		</tr>		
		
	</table>

<BR>

	<table class="widefat" border="1">

		<tr valign="top">
			<th scope="row" colspan="2" width="33%"><strong>Colors:</strong> Click on each field to display the color picker. Click again to close it.</th>
			<td width="33%" rowspan="4">
				<div id="colorpicker1"></div>
				<div id="colorpicker2"></div>
				<div id="colorpicker3"></div>
			</td>
		</tr>


		<tr valign="top">
			<th scope="row"><label for="rum_sst_text_color">Text color</label></th>
			<td width="33%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $rum_sst_text_color ); ?>" name="rum_sst_plugin_options[text_color]" id="color1" /></td>
		</tr>


		<tr valign="top">
			<th scope="row"><label for="rum_sst_tab_color">Tab color</label></th>
			<td width="33%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $rum_sst_tab_color ); ?>" name="rum_sst_plugin_options[tab_color]" id="color2" /></td>
		</tr>


		<tr valign="top">
			<th scope="row"><label for="rum_sst_hover_color">Tab hover color</label></th>
			<td width="33%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $rum_sst_hover_color ); ?>" name="rum_sst_plugin_options[hover_color]" id="color3" /></td>
		</tr>

		<tr valign="top">
			<td colspan="3">&nbsp;</td>
		</tr>

	</table>

	<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>



<?php
	echo '</form>';
	echo '</div>';
}




// This function runs all the css and dynamic css elements for displaying the simple side tab
function rum_sst_custom_css_hook() {

	// get plugin option array and store in a variable
	$rum_sst_plugin_option_array	= get_option( 'rum_sst_plugin_options' );

	// fetch individual values from the plugin option variable array
	$rum_sst_font_family			= $rum_sst_plugin_option_array[ 'font_family' ];
	$rum_sst_pixels_from_top		= $rum_sst_plugin_option_array[ 'pixels_from_top' ];
	$rum_sst_text_color				= $rum_sst_plugin_option_array[ 'text_color' ];
	$rum_sst_tab_color				= $rum_sst_plugin_option_array[ 'tab_color' ];
	$rum_sst_hover_color			= $rum_sst_plugin_option_array[ 'hover_color' ];
	$rum_sst_left_right				= $rum_sst_plugin_option_array[ 'left_right' ];


	// set a default value if the option is not set
	if ( isset($rum_sst_plugin_option_array[ 'text_shadow' ] ) ) {
		$rum_sst_text_shadow			= $rum_sst_plugin_option_array[ 'text_shadow' ];
	} else {
		$rum_sst_text_shadow			= 0;
	}


	// set a default value if the option is not set
	if ( isset($rum_sst_plugin_option_array[ 'font_weight_bold' ] ) ) {
		$rum_sst_font_weight_bold		= $rum_sst_plugin_option_array[ 'font_weight_bold' ];
	} else {
		$rum_sst_font_weight_bold		= 0;
	}
?>

<style type='text/css'>
/* Begin Simple Side Tab Styles*/
#rum_sst_tab {
	font-family:<?php echo $rum_sst_font_family; ?>;
	top:<?php echo $rum_sst_pixels_from_top; ?>px;
	background-color:<?php echo $rum_sst_tab_color; ?>;
	color:<?php echo $rum_sst_text_color; ?>;
	border-style:solid;
	border-width:0px;
}

#rum_sst_tab:hover {
	background-color: <?php echo $rum_sst_hover_color; ?>;
	<?php
	if ( $rum_sst_text_shadow == '1' ) {

		if ( $rum_sst_left_right == 'left' ) {

		  echo '	-moz-box-shadow:    -3px 3px 5px 2px #ccc;' . "\n";
		  echo '	-webkit-box-shadow: -3px 3px 5px 2px #ccc;' . "\n";
		  echo '	box-shadow:         -3px 3px 5px 2px #ccc;' . "\n";
		} else {

		  echo '	-moz-box-shadow:    -3px -3px 5px 2px #ccc;' . "\n";
		  echo '	-webkit-box-shadow: -3px -3px 5px 2px #ccc;' . "\n";
		  echo '	box-shadow:         -3px -3px 5px 2px #ccc;' . "\n";			
		}
	}
?>


}

.rum_sst_contents {
	position:fixed;
	margin:0;
	padding:6px 13px 8px 13px;
	text-decoration:none;
	text-align:center;
	font-size:15px;
	<?php
	if ( $rum_sst_font_weight_bold == '1' ) :
	  echo 'font-weight:bold;' . "\n";
	else :
	  echo 'font-weight:normal;' . "\n";
	endif;
	?>
	border-style:solid;
	display:block;
	z-index:100000;
}

.rum_sst_left {
	left:-2px;
	cursor: pointer;
	-webkit-transform-origin:0 0;
	-moz-transform-origin:0 0;
	-o-transform-origin:0 0;
	-ms-transform-origin:0 0;
	-webkit-transform:rotate(270deg);
	-moz-transform:rotate(270deg);
	-ms-transform:rotate(270deg);
	-o-transform:rotate(270deg);
	transform:rotate(270deg);
	-moz-border-radius-bottomright:10px;
	border-bottom-right-radius:10px;
	-moz-border-radius-bottomleft:10px;
	border-bottom-left-radius:10px;
}

.rum_sst_right {
   	right:-1px;
	cursor: pointer;
	-webkit-transform-origin:100% 100%;
	-moz-transform-origin:100% 100%;
	-o-transform-origin:100% 100%;
	-ms-transform-origin:100% 100%;
	-webkit-transform:rotate(-90deg);
	-moz-transform:rotate(-90deg);
	-ms-transform:rotate(-90deg);
	-o-transform:rotate(-90deg);
	transform:rotate(-90deg);
	-moz-border-radius-topright:10px;
	border-top-right-radius:10px;
	-moz-border-radius-topleft:10px;
	border-top-left-radius:10px;
}

.rum_sst_right.less-ie-9 {
	right:-120px;
	filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);
}

.rum_sst_left.less-ie-9 {
	filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}

/* End Simple Side Tab Styles*/

</style>

<?php
}
