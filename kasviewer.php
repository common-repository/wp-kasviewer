<?php
/*
Plugin Name: KasViewer
Plugin URI: http://www.kasbeel.cl/kas2008/kasplugins/wp-kasviewer/
Description: Display popup box in the same frame, using sexylightbox.
Version: 1.0.2
Author: Wladimir A. Jimenez B.
Author URI: http://www.kasbeel.cl/kas2008

Acknowledgement: 
	Eduardo D. Sada - http://www.coders.me/web-html-js-css/javascript/sexy-lightbox-2
*/
/**
 * KasViewer Plugin
 * 
 * FILE
 * kasviewer.php
 *
 * DESCRIPTION
 * Contains hooks of the plugins
 *
 *   Copyright (C) 2010  Wladimir A. Jiménez B.
 *   E-mail: wjimenez@kasbeel.cl
 *   Home site: www.kasbeel.cl
 *
 *   This file is part of wp-kasviewer.
 *
 *   wp-kasviewer is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>. 
 **/

 /**
 * Inclusion of administration,  and general functions.
 */

   if(!defined('KASPLUGINS'))	
	include( 'kasplugins_administration.php' );
   include( 'kasviewer_administration.php' );
   include( 'kasviewer_functions.php' );
 
 /**
 * Addition functions to hooks.
 */

if (is_admin()) {
   // Create administration menu 
   add_action( 'admin_menu', 'kasviewer_wp_addmenu' );
}
else{
	// include headers 
	add_action('wp_head', 'kasviewer_wp_head');
}

// Shortcode for [kasviewer  ....]
add_shortcode('kasviewer', 'kasviewer_wp_tags' );

// Activation of plugin
register_activation_hook( __FILE__, 'kasviewer_wp_activate' );

// Deactivation of plugin 
register_deactivation_hook( __FILE__, 'kasviewer_wp_deactivate' );

// Add link settings 
add_filter('plugin_action_links', 'kasviewer_wp_plugin_action', 10, 2);


