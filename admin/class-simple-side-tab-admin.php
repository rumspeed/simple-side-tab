<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class Simple_Side_Tab_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}




    /**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

        // wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plugin-name-admin.css', array(), $this->version, 'all' );
	}




    /**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {

        // only enqueue farbtastic on the plugin settings page
        if( $hook != 'settings_page_rum_simple_side_tab' ) 
            return;


        // load the style and script for farbtastic color picker
        wp_enqueue_style( 'farbtastic' );
        wp_enqueue_script( 'farbtastic' );

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-admin.js', array( 'jquery' ), $this->version, false );
	}




    // action function to add a new submenu under Settings
    public function admin_menu() {

        // Add a new submenu under Settings
        add_options_page( 'Simple Side Tab Option Settings', 'Simple Side Tab', 'manage_options', 'rum_simple_side_tab', 'rum_sst_options_page' );
    }




    // Use Settings API to whitelist options
    public function settings_api_init() {

        register_setting( 'rum_sst_option_group', 'rum_sst_plugin_options' );
    }




    // Build array of links for rendering in installed plugins list
    public function plugin_actions( $links ) {

        $settings = array( 'settings' => '<a href="options-general.php?page=rum_simple_side_tab">' . __('Settings') . '</a>' );
        $actions  = array_merge( $settings, $links );

        return $actions;
    }

}
