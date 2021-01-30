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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

    }

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

        // wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plugin-name-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

        // wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', array( 'jquery' ), $this->version, false );
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

        // set the value for the tab display to true
        // this can only be changed by the 'rum_sst_plugin_display_tab' filter
        $rum_sst_display_tab = true;
    
    
        // apply filter for the display of the tab so it can be turned on and off conditionally
        $rum_sst_display_tab = apply_filters( 'rum_sst_plugin_display_tab', $rum_sst_display_tab );
    
    
        // do not display the tab if the value has been turned off
        if ( $rum_sst_display_tab == false ) {
            return;
        }
    
    
        // compare the page url and the option tab - don't render the tab if the values are the same
        // TODO: consider adding this to the plugin loader
        if ( $this->settings->tab_url != $this->get_full_url() ) {
    
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
            $s 			= empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
            $sp 		= strtolower($_SERVER["SERVER_PROTOCOL"]);
            $protocol 	= substr($sp, 0, strpos($sp, "/")) . $s;

            return $protocol . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        }
    }




    // action function to get option values and write the div for the Simple Side Tab to display
    public function body_tag_html() {

        // fetch and sanatize values from the plugin object
        $rum_sst_text_for_tab		= esc_html( $this->settings->text_for_tab);
        $rum_sst_tab_url			= esc_url( $this->settings->tab_url );


        // apply filters for the tab text
        $rum_sst_text_for_tab       = apply_filters( 'rum_sst_plugin_text_for_tab', $rum_sst_text_for_tab );


        if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])) {

            // if IE 7 or 8
            // Write HTML to render tab
            echo '<a href="' . $rum_sst_tab_url . '"' . $this->settings->get_page_target() . '><div id="rum_sst_tab" class="rum_sst_contents less-ie-9 ' . $this->settings->get_tab_side_class() . '">' . $rum_sst_text_for_tab . '</div></a>';
        } else {

            // if IE>8
            // Write HTML to render tab
            echo '<a href="' . $rum_sst_tab_url . '"' . $this->settings->get_page_target() . ' id="rum_sst_tab" class="rum_sst_contents ' . $this->settings->get_tab_side_class() . '">' . $rum_sst_text_for_tab . '</a>';
        }
    }




    // This function runs all the css and dynamic css elements for displaying the simple side tab
    public function custom_css_hook() {

    ?>

    <style type='text/css'>
    /* Begin Simple Side Tab Styles*/
    #rum_sst_tab {
        font-family:<?php echo $this->settings->font_family; ?>;
        top:<?php echo $this->settings->pixels_from_top; ?>px;
        background-color:<?php echo $this->settings->tab_color; ?>;
        color:<?php echo $this->settings->text_color; ?>;
        border-style:solid;
        border-width:0px;
    }

    #rum_sst_tab:hover {
        background-color: <?php echo $this->settings->hover_color; ?>;
        <?php
        if ( $this->settings->text_shadow ) {
            if ( $this->settings->left_right == 'left' ) {
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
        font-weight:<?php echo $this->settings->get_font_weight(); ?>;
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

}
