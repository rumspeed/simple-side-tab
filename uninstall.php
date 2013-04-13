<?php

// If uninstall was not called from WordPress, then exit
if( !defined( 'WP_UNINSTALL_PLUGIN') )
	exit ();


// Delete all plugin related fields from the options table
delete_option( 'rum_sst_plugin_options' );

delete_option( 'rum_sst_text_for_tab' );
delete_option( 'rum_sst_font_family' );
delete_option( 'rum_sst_font_weight_bold' );
delete_option( 'rum_sst_tab_url' );
delete_option( 'rum_sst_pixels_from_top' );
delete_option( 'rum_sst_text_color' );
delete_option( 'rum_sst_tab_color' );
delete_option( 'rum_sst_hover_color' );


?>