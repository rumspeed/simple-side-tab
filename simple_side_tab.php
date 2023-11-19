<?php
/**
 * Plugin Name:       Simple Side Tab
 * Plugin URI:        https://rumspeed.com/wordpress-plugins/simple-side-tab/
 * Description:       Display a side tab that you can easily link to any page. Customize the tab text, font and colors. It's that simple. That's Simple Side Tab.
 * Version:           2.1.11
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Scot Rumery
 * Author URI:        https://rumspeed.com/simple-side-tab/
 * Text Domain:       simple-side-tab
 * Domain Path:       /languages
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
 * Plugin constants.
 */
define( 'SIMPLE_SIDE_TAB_VERSION', '2.1.11' );
define( 'SIMPLE_SIDE_TAB_DIR', dirname( __FILE__ ) );
define( 'SIMPLE_SIDE_TAB_URI', plugins_url( '' , __FILE__ ) );
define( 'SIMPLE_SIDE_TAB_BASENAME', plugin_basename(__FILE__) );
define( 'SIMPLE_SIDE_TAB_OPTIONS_PAGE', 'rum_simple_side_tab' );
define( 'SIMPLE_SIDE_TAB_SETTINGS_PAGE_ID', 'settings_page_' . SIMPLE_SIDE_TAB_OPTIONS_PAGE );




/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-side-tab-activator.php
 */
function activate_simple_side_tab() {
	require_once SIMPLE_SIDE_TAB_DIR . '/includes/class-simple-side-tab-activator.php';
	Simple_Side_Tab_Activator::activate();
}




/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-side-tab-deactivator.php
 */
function deactivate_simple_side_tab() {
	require_once SIMPLE_SIDE_TAB_DIR . '/includes/class-simple-side-tab-deactivator.php';
	Simple_Side_Tab_Deactivator::deactivate();
}




register_activation_hook( __FILE__, 'activate_simple_side_tab' );
register_deactivation_hook( __FILE__, 'deactivate_simple_side_tab' );




/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require SIMPLE_SIDE_TAB_DIR . '/includes/class-simple-side-tab.php';




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




// get the party started
run_simple_side_tab();
