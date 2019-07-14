=== Simple Side Tab ===
Contributors: srumery
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RYGE4PYK68H54
Tags: tab, navigation, admin, call to action, page link, mobile tab, browser tab, side tab
Requires at least: 4.6
Tested up to: 4.9
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display a side tab that you can easily link to any page. Customize the tab text, font and colors. It's that simple. That's Simple Side Tab.

== Description ==

Add a "Global Call To Action" on your website. Simple Side Tab adds a vertical tab to the left or right side of the browser window that links to any page. The tab stays in place as your visitor scrolls down the page so it's always visible and ready for action. Works great on Mobile too.

Need an effective way to highlight a conversion page? This plugin will help.


= New feature =
* Filter added to modify output of tab text (see FAQ)
* Filter added so the tab display can be turned on and off conditionally (see FAQ)


It's easy to use and simple to set up. From one simple settings screen, you can:

* Set the text for the tab
* Choose fonts - includes 7 standard screen fonts
* Set the URL your tab links to, internal or external
* Assign the tab to the left or right side of browser window
* Change vertical position of your tab
* Unlimited colors for tab elements
* All CSS, no graphics

= Development =
<a href="https://github.com/rumspeed/simple-side-tab" title="Simple Side Tab on GitHub">https://github.com/rumspeed/simple-side-tab</a></p>


== Installation ==

= Install =

1. Upload `simple-side-tab` folder to the `/wp-content/plugins/` directory
1. In your WordPress administration, go to the Plugins page
1. Activate the Simple Side Tab plugin and a subpage for the plugin will appear in your WordPress Settings menu.
1. Go to the Settings > Simple Side Tab and configure your side tab

If you find any bugs or have ideas to make it better, please let us know.


== Frequently Asked Questions ==

= Are graphics used to display the tab?  =

No. The tab is built with CSS. That way, you can customize the tab text, fonts and colors very easily.

= Can I get the tab to work on the right side of the browser? =

Yes. Now it works on both sides.

= Can you setup multiple tabs with this plugin? =

No. We want to keep it simple so we are only supporting one tab. More than one tab would complicate this plugin quite a bit. Besides, two tabs doesn't look that great on mobile. If you need more than one tab, this plugin is not for you.

= How can I conditionally change the tab text or the URL? =

You can use the `rum_sst_plugin_text_for_tab` filter to modify the output of the tab. Here are some examples:

Add a Font Awesome Icon to the front of the tab text (assuming Font Awesome is supported with your theme)
<pre><code>// filter the tab output from the Simple Side Tab plugin
function rum_filter_simple_side_tab_text( $text ) {

	$text = &#039;&lt;i class="fa fa-life-ring"&gt;&lt;/i&gt; &#039; . $text;

	return $text;
}
add_filter( &#039;rum_sst_plugin_text_for_tab&#039;, &#039;rum_filter_simple_side_tab_text&#039;, 10 , 1 ); </code></pre>

Contidionally turn off the tab on the homepage
<pre><code>// filter the tab display value to conditionally turn off the tab
function rum_filter_simple_side_tab_display( $display ) {

	if ( is_front_page() ) {

		$display = false;
	}

	return $display;
}
add_filter( &#039;rum_sst_plugin_display_tab&#039;, &#039;rum_filter_simple_side_tab_display&#039;, 10 , 1 );</code></pre>


== Screenshots ==

1. Simple Side Tab options page
1. Simple Side Tab is action based on option settings

== Changelog ==

= 1.2.1 =
* FIX: Undefined index: 'text_shadow' and 'font_weight_bold' - when on the settings page

= 1.2.0 =
* NEW: filter added to modify output of tab text
* NEW: filter added so the tab display can be turned on and off conditionally

= 1.1.3 =
* Tested up to: 4.4
* FIX: Undefined index: text_shadow - on line 405
* FIX: Right tab not showing in some cases due to length of text in tab
* FIX: PHP notices: Undefined index SERVER_PORT and SERVER_NAME when using WP_CLI
* FIX: Tab URL with HTTPS was still showing on target page when it shouldn't

= 1.1.2 =
* Tested up to: 4.1

= 1.1.1 =
* Tested up to: 4.0
* fix invalid HTML output of "0" when tab was set to open in a new window (hat tip allan23)

= 1.1.0 =
* FEATURE: option for left or right location for the tab
* fix IE8 display issue. made conditional statement for IE8 and IE7

= 1.0.0 =
* FEATURE: remove tab if active page matches the tab url from the settings page
* FEATURE: added a checkbox option to "Open link in new window"; if checked, target="_blank" is added to the tab anchor tag
* Farbtastic is no longer being included on every admin page
* changed the label in the settings page from "Text shadow" to "Drop shadow on hover" to properly indicate what the setting does. (box-shadow attribute usage)
* optimize option select for font drop down
* sanitize option data before it is rendered
* sanitize data fields on the settings page
* removed unnecessary permissions check
* updated plugin uri to point to the proper location

Hat tip to Pippin Williamson for his suggestions from his plugin review. He has a plugin review program for members of his website. See http://pippinsplugins.com/ for details.


= 0.8.6 =
* Initial plugin release
