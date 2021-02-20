<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */




 /**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class Simple_Side_Tab_Options {

    // values from the option value rum_sst_plugin_options
    public  $text_for_tab;
    public  $font_family;
    public  $tab_url;
    public  $pixels_from_top;
    public  $text_color;
    public  $tab_color;
    public  $hover_color;
    public  $left_right;
    public  $font_weight_bold;
    public  $text_shadow;
    public  $target_blank;




    // set values when object is created
    public function __construct() {

        // get option
        $plugin_option              = get_option( 'rum_sst_plugin_options' );

        // set values
        $this->text_for_tab         = $plugin_option[ 'text_for_tab' ];
        $this->font_family          = $plugin_option[ 'font_family' ];
        $this->tab_url              = $plugin_option[ 'tab_url' ];
        $this->pixels_from_top      = $plugin_option[ 'pixels_from_top' ];
        $this->text_color           = $plugin_option[ 'text_color' ];
        $this->tab_color            = $plugin_option[ 'tab_color' ];
        $this->hover_color          = $plugin_option[ 'hover_color' ];
        $this->left_right           = $plugin_option[ 'left_right' ];

        // if these value are not checked, they will be missing from the options array
        $this->font_weight_bold     = (isset($plugin_option['font_weight_bold']))   ? true : false;
        $this->text_shadow          = (isset($plugin_option['text_shadow']))        ? true : false;
        $this->target_blank         = (isset($plugin_option['target_blank']))       ? true : false;

        // calculate values
    }


    public function is_renderable() {
        if ($this->text_for_tab && $this->tab_url) {
            return true;
        }
    }


    public function get_page_target() {
        if ($this->target_blank) {
            return ' target="_blank"';
        } else {
            return '';
        }
    }


    public function get_tab_side_class() {
        return 'rum_sst_' . $this->left_right;
    }


    public function get_font_weight() {
        if ($this->font_weight_bold) {
            return 'bold';
        } else {
            return 'normal';
        }
    }


    static function get_default_settings() {
        // return default option values; used in class Simple_Side_Tab_Activator
        return array(
            'text_for_tab'     => '',
            'tab_url'          => '',
            'font_family'      => 'Tahoma, sans-serif',
            'font_weight_bold' => null,
            'text_shadow'      => null,
            'target_blank'     => null,
            'pixels_from_top'  => '350',
            'text_color'       => '#ffffff',
            'tab_color'        => '#a0244e',
            'hover_color'      => '#a4a4a4',
            'left_right'	   => 'left'
            );
    }

}
