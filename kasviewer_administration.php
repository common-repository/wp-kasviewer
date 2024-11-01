<?php
/**
 * KasViewer Plugin
 * 
 * FILE
 * kasviewer_administration.php
 *
 * DESCRIPTION
 * Contains base functions to admin of the plugin.
 *
 *   Copyright (C) 2010  Wladimir A. Jimenez B.
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

	// Function plugin active, set initial parameters
	function kasviewer_wp_activate() {
		if ( false === get_option('kasviewer_wp_options') )
		{
			// set default options
			$def = array( 'theme' => 'white');
			update_option('kasviewer_wp_options', $def);
		}

	}
	// Function plugin deactive
	function kasviewer_wp_deactivate() {
		//empty
	}

	// Function plugin uninstall, clean all data of the plugin
	function kasviewer_wp_uninstall() {
		//clear options
		delete_option('kasviewer_wp_options');	   
	}

	// Home plugins menu.
	function kasviewer_wp_admin_settings() {
		kasplugins_wp_admin_home();
		echo '<div class="wrap">';
		echo '<h2>KasViewer</h2>';
		// get options array
		$options = get_option('kasviewer_wp_options');
		// Overwrite existing options
		if ( isset( $_POST['submit'] ) ) {
			$options['theme'] = $_POST['kasviewer_wp_theme'];
			update_option( 'kasviewer_wp_options', $options );
		}		
		echo '<p>More details in homepage of the plugin in : <a href="http://www.kasbeel.cl/kas2008/kasplugins/wp-kasviewer/">Kasbeel Plugins for Wordpress - KasViewer</a>.</p>';
		echo '<form method="post" action="">';
		echo '<table class="widefat">';
		echo '<thead>';
		echo '<tr><th colspan="2" style="text-align:center;">';
		echo 'Customization';
		echo '</th></tr>';
		echo '</thead>';
		// Generate plugin DIR	
		$url = defined('WP_PLUGIN_DIR') ? WP_PLUGIN_DIR . '/wp-kasviewer/themes' : get_bloginfo('HOME') . '/wp-content/plugins/wp-kasviewer/themes';
		// Capture directories in theme plugin DIR	
		$files = scandir($url);
			
		echo '<tr valign="top">';
		echo '<th scope="row">Themes</th>';
		echo '<td><select name="kasviewer_wp_theme" id="kasviewer_wp_theme">';
		foreach ($files as $folder) {
			if ( is_dir( $url . '/' . $folder ) && $folder != '.' && $folder != '..' ) {
				echo '<option' . ( $folder == $options['theme'] ? ' selected="selected"' : '' ) . '>' . $folder . '</option>';
			}
		}
		echo '</select></td>';
		echo '</tr>';
		echo '<tr>';
		// Generate plugin URL	
		$url = defined('WP_PLUGIN_URL') ? WP_PLUGIN_URL . '/wp-kasviewer/themes' : get_bloginfo('wpurl') . '/wp-content/plugins/wp-kasviewer/themes';
		echo '<td colspan="2" align="center"><img id="thumbs-box" name="thumbs-box" src="'.$url.'/'.$options['theme'].'/thumb.png"></td>';
		echo '</tr>';
		echo '</table>';
		echo '<p class="submit">';
		echo '<input type="submit" name="submit" class="button-secondary" value="Save changes" />';
		echo '</p>';		
		echo '</form>';		
		
		echo '<table class="widefat">';
		echo '<thead>';
		echo '<tr><th colspan="2" style="text-align:center;">';
		echo 'Help';
		echo '</th></tr>';
		echo '</thead>';
		echo '<tr><td>';
		echo 'Using To:<br/>';
		echo '<br/>';
		echo '&nbsp;Show Image:<br/>';
		echo '<br/>';
		echo '&nbsp;[kasviewer type="img" image="image-url" thumb="thumbnails-image-url" title="title-box" group="group"]<br/>';
		echo '&nbsp;&nbsp;image-url:<br/>';
		echo '&nbsp;&nbsp;&nbsp;is relative o absolute url link full size image.<br/>';
		echo '&nbsp;&nbsp;thumbnails-image-url<br/>';
		echo '&nbsp;&nbsp;&nbsp;is relative o absolute url link to the thumbsnails image.<br/>';
		echo '&nbsp;&nbsp;title-box:<br/>';
		echo '&nbsp;&nbsp;&nbsp;Box title,optional.<br/>';
		echo '&nbsp;&nbsp;group:<br/>';
		echo '&nbsp;&nbsp;&nbsp;group of content to set in the box, optional<br/>';
		echo '<br/>';
		echo '&nbsp;Show Iframe:<br/>';
		echo '<br/>';
		echo '&nbsp;[kasviewer type="iframe" url="url" width="width-box" height="height-box" thumb="thumbnails-image-url" text="text-link" title="title box" group="group"]<br/>';
		echo '&nbsp;&nbsp;url:<br/>';
		echo '&nbsp;&nbsp;&nbsp;is relative o absolute url link to show in box.<br/>';
		echo '&nbsp;&nbsp;width-box:<br/>';
		echo '&nbsp;&nbsp;&nbsp;is width of the box.<br/>';
		echo '&nbsp;&nbsp;height-box:<br/>';
		echo '&nbsp;&nbsp;&nbsp;is height of the box.<br/>';
		echo '&nbsp;&nbsp;thumbnails-image-url<br/>';
		echo '&nbsp;&nbsp;&nbsp;is relative o absolute url link to the thumbsnails image, optional if set text-link.<br/>';
		echo '&nbsp;&nbsp;text-link<br/>';
		echo '&nbsp;&nbsp;&nbsp;text used in link, optional if set thumbnails-image-url<br/>';
		echo '&nbsp;&nbsp;title:<br/>';
		echo '&nbsp;&nbsp;&nbsp;Box title,optional<br/>';
		echo '&nbsp;&nbsp;group:<br/>';
		echo '&nbsp;&nbsp;&nbsp;group of content to set in the box, optional<br/>';
		echo '<br/>';
		echo '&nbsp;Show Content:<br/>';
		echo '<br/>';
		echo '&nbsp;[kasviewer type="content" width="width-box" height="height-box" thumb="thumbnails-image-url" text="text-link" title="title box" group="group"]content-to-show[/kasviewer]<br/>';
		echo '&nbsp;&nbsp;content-to-show<br/>';
		echo '&nbsp;&nbsp;&nbsp;is a html content to show in box.<br/>';
		echo '&nbsp;&nbsp;width-box:<br/>';
		echo '&nbsp;&nbsp;&nbsp;is width of the box.<br/>';
		echo '&nbsp;&nbsp;height-box:<br/>';
		echo '&nbsp;&nbsp;&nbsp;is height of the box.<br/>';
		echo '&nbsp;&nbsp;thumbnails-image-url<br/>';
		echo '&nbsp;&nbsp;&nbsp;is relative o absolute url link to the thumbsnails image, optional if set text-link<br/>';
		echo '&nbsp;&nbsp;text-link<br/>';
		echo '&nbsp;&nbsp;&nbsp;text used in link, optional if set thumbnails-image-url<br/>';
		echo '&nbsp;&nbsp;title-box:<br/>';
		echo '&nbsp;&nbsp;&nbsp;Box title,optional<br/>';
		echo '&nbsp;&nbsp;group:<br/>';
		echo '&nbsp;&nbsp;&nbsp;group of content to set in the box, optional<br/>';
		echo 'Is it possible to combine different types of boxes using tag groups.<br/>';
		echo 'If set thumbsnails-image-url in case content or iframe, this is used before of the text-link tag.<br/>';
		echo '</p>';		
		echo '<td></tr></table>';
		echo '</div>';
	}

	// Create Plugins Menu.
	function kasviewer_wp_addmenu() {
		if ( function_exists('add_submenu_page') ) {
			// General plugins settings
			add_submenu_page( KASPLUGINS.'/kasplugins_administration.php', 'KasViewer', 'KasViewer', 8, __FILE__, 'kasviewer_wp_admin_settings');
		}
	}

?>