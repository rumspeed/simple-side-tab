<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 * @author     Your Name <email@example.com>
 */
class Simple_Side_Tab_Public {

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
	 * Plugin settings.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $settings    Plugin settings.
	 */
	private $settings;

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $settings ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->settings = $settings;
    }

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

        // wp_enqueue_style( $this->plugin_name, SIMPLE_SIDE_TAB_URI . '/public/css/simple-side-tab-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

        // wp_enqueue_script( $this->plugin_name, SIMPLE_SIDE_TAB_URI . '/public/js/simple-side-tab-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function set_plugin_options() {
        $this->settings = new Simple_Side_Tab_Options();
    }




    public function display_tab() {

        // check to see if the tab settings are incomplete
        if ( ! $this->settings->is_renderable() ) {
            // settings are incomplete; bail
            return;
        }


        // set the value for the tab display to true
        // this can only be changed by the 'rum_sst_plugin_display_tab' filter
        $rum_sst_display_tab = true;
    
    
        // apply filter for the display of the tab so it can be turned on and off conditionally
        $rum_sst_display_tab = apply_filters( 'rum_sst_plugin_display_tab', $rum_sst_display_tab );
    
    
        // do not display the tab if the value has been turned off
        if ( $rum_sst_display_tab == false ) {
            return;
        }
    
    
        // only run display actions if the Tab URL and the currnet page URL do not matach
        // in other words... do not display the tab on a page that links to itself
        if ( ! $this->is_url_match() ) {
            // hook to get option values and dynamically render css to support the tab classes
            add_action( 'wp_head', array( $this, 'custom_css_hook') );
    
            // hook to get option values and write the div for the Simple Side Tab to display
            add_action( 'wp_footer', array( $this, 'body_tag_html') );
        }
    }




    // get the complete url for the current page
    public function get_full_url() {

        // wrap contents within isset(); these variables are not available when using WP-CLI
        // GitHub issue: https://github.com/rumspeed/simple-side-tab/issues/10
        // WP Repo support: https://wordpress.org/support/topic/php-notices-undefined-index-server_port-and-server_name?replies=1#post-7623551
        if(isset($_SERVER["SERVER_NAME"])) {
            $s 			= (empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on")) ? "s" : "";
            $sp 		= strtolower($_SERVER["SERVER_PROTOCOL"]);
            $protocol 	= substr($sp, 0, strpos($sp, "/")) . $s;

            return $protocol . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        }
    }




    // conditional for comparing the Tab URL value with the current page URL
    public function is_url_match() {
        // using untrailingslashit() on both in case the settings URL doesn't have a trailing slash but the page does
        if ( untrailingslashit( $this->settings->tab_url ) == untrailingslashit( $this->get_full_url() ) ) {
            // we've got a match
            return true;
        }
    }




    // action function to get option values and write the div for the Simple Side Tab to display
    public function body_tag_html() {

        // fetch and sanatize values from the plugin object
        $rum_sst_text_for_tab		= esc_html( $this->settings->text_for_tab);
        $rum_sst_tab_url			= esc_url( $this->settings->tab_url );


        // apply filters for the tab text
        $rum_sst_text_for_tab       = apply_filters( 'rum_sst_plugin_text_for_tab', $rum_sst_text_for_tab );

        // apply filters for the tab class
        $rum_sst_class_for_tab      = apply_filters( 'rum_sst_plugin_class_for_tab', 'rum_sst_contents ' . $this->settings->get_tab_side_class() );

        if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])) {

            // if IE 7 or 8
            // Write HTML to render tab
            echo '<a href="' . $rum_sst_tab_url . '"' . $this->settings->get_page_target() . '><div id="rum_sst_tab" class="less-ie-9 ' . $rum_sst_class_for_tab . '">' . $rum_sst_text_for_tab . '</div></a>';
        } else {

            // if IE>8
            // Write HTML to render tab
            echo '<a href="' . $rum_sst_tab_url . '"' . $this->settings->get_page_target() . ' id="rum_sst_tab" class="' . $rum_sst_class_for_tab . '">' . $rum_sst_text_for_tab . '</a>';
        }
    }




    // This function runs all the css and dynamic css elements for displaying the simple side tab
    public function custom_css_hook() {

		require_once SIMPLE_SIDE_TAB_DIR . '/public/partials/dynamic-css.php';
    }

}
