<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */



// TODO: this could be another class and all the if() statements could be methods

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

<div class="wrap">
    <h2>Simple Side Tab</h2>
    <p>Simple Side Tab was created to give you an easy option for adding a linkable tab to the side of your WordPress website. Use it to link to your contact/support/feedback page or use it to drive traffic to a new product you just released. It's quick and easy. <em>NOTE: This plugin requires the WP_footer() hook to be fired from your theme.</em></p>

    <form method="post" action="options.php">
    <?php
        settings_fields( 'rum_sst_option_group' );
		do_settings_sections( 'rum_simple_side_tab' );
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

        <br>

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

    </form>
</div>
