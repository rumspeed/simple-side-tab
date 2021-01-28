<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class Simple_Side_Tab_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

        // populate plugin options array
        $rum_sst_plugin_options = array(
            'text_for_tab'     => 'SIMPLE SIDE TAB',
            'font_family'      => 'Tahoma, sans-serif',
            'font_weight_bold' => '1',
            'text_shadow'      => '0',
            'tab_url'          => 'https://rumspeed.com',
            'pixels_from_top'  => '350',
            'text_color'       => '#FFFFFF',
            'tab_color'        => '#A0244E',
            'hover_color'      => '#A4A4A4',
            'target_blank'     => '0',
            'left_right'	   => 'left'
            );

        // create field in WP_options to store all plugin data in one field
        add_option( 'rum_sst_plugin_options', $rum_sst_plugin_options );
    }

}
