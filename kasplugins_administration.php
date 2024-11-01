<?php
/**
 * Kas Plugin
 * 
 * FILE
 * kasplugins_administration.php
 *
 * DESCRIPTION
 * Contains base functions to admin of the plugin.
 *
 *   Copyright (C) 2010  Wladimir A. Jimenez B.
 *   E-mail: wjimenez@kasbeel.cl
 *   Home site: www.kasbeel.cl
 *
 *   This file is part of wp-kasplugins.
 *
 *   wp-kasplugins is free software: you can redistribute it and/or modify
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

	// Home plugins menu.
	function kasplugins_wp_admin_home() {
		// Generate plugin URL	
		$url = defined('WP_PLUGIN_URL') ? WP_PLUGIN_URL . '/wp-kasviewer' : get_bloginfo('wpurl') . '/wp-content/plugins/wp-kasviewer';
		echo '<div class="wrap">';
		echo '<h2><img src="'.$url.'/kas-32.png" />KasPlugins</h2>';
		echo '<p>For more information, visit Kasbeel Plugins for Wordpress homepage: <a href="http://www.kasbeel.cl/kas2008/kasplugins">here</a>.</p>';
		echo '<center><script  language="javascript"  type="text/javascript">iwsrcplus="http://codenew.impresionesweb.com/r/banner_iw.php?idrotador=34213&tamano=468x60&lgid="+((new Date()).getTime() % 2147483648) + Math.random(); document.write("<scr"+"ipt language=javascript  type=text/javascript src="+iwsrcplus+"></scr"+"ipt>");</script><noscript><iframe src="http://alt.impresionesweb.com/noscript.php?tam=468x60&idp=34213&ref=34213&cod=39831" width="468" height="60" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe></noscript></center>';
		echo '</div>';
	}

	// Create Plugins Menu.
	function kasplugins_wp_addmenu() {
		if ( function_exists('add_menu_page') ) {
			// Main menu
			add_menu_page( 'Settings', 'KasPlugins', 8, __FILE__, 'kasplugins_wp_admin_home',plugins_url('wp-kasviewer/kas-16.png'));
		}
	}
	if (is_admin()) {
	   // Create administration menu 
	   add_action( 'admin_menu', 'kasplugins_wp_addmenu' );
	}	
	//Set KASPLUGINS Constant to exclude this file in next kasplugins
	define('KASPLUGINS','wp-kasviewer');

?>