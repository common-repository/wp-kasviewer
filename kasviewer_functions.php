<?php
/**
 * KasViewer Plugin
 * 
 * FILE
 * kasviewer_functions.php
 *
 * DESCRIPTION
 * Contains base functions of the plugin.
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
 
 
	function kasviewer_wp_head() {
		// Set plugin URL	
		$url = defined('WP_PLUGIN_URL') ? WP_PLUGIN_URL . '/wp-kasviewer' : get_bloginfo('wpurl') . '/wp-content/plugins/wp-kasviewer';
		// get plugins options
		$options = get_option( 'kasviewer_wp_options', array() );
		// default theme
		$theme = 'black';
		if(isset($options['theme'])){
			$theme = $options['theme'];
		}
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.3/mootools-yui-compressed.js"></script>';
		echo '<script type="text/javascript" src="'.$url.'/js/sexylightbox.v2.3.mootools.min.js"></script>';
		echo '<link rel="stylesheet" href="'.$url.'/css/sexylightbox.css" type="text/css" media="all" />';
		echo '<script type="text/javascript">';
		echo "    window.addEvent('domready', function(){";
		echo "      SexyLightbox = new SexyLightBox({color:'$theme', dir: '$url/themes'});";
		echo "    });";
		echo "</script>";
	}

	// Shortcode function for kasviewer tag; sample [kasviewer  ....]
	function kasviewer_wp_tags($atts, $content = null) {
		// verify type is set
		if(isset($atts['type'])){
			$type = $atts['type'];
		}else{
			return "<b>kasviewer:</b>tag type not found"; 
		}
		// switch for type
		switch($type){
			case 'img':
				return kasviewer_wp_image($atts);
			break;
			case 'iframe':
				return kasviewer_wp_iframe($atts);
			break;			
			case 'content':
				return kasviewer_wp_content($atts, $content);
			break;			
			default:
				return "<b>kasviewer:</b>tag type $type is not valid";
			break;
		}
	}
	// Parser img type
	function kasviewer_wp_image($atts) {
		// extraction data in variables
		extract(shortcode_atts(array(
			'image' => 'N/A',
			'thumb' => 'N/A',
			'title' => '',
			'group' => ''
		), $atts));	
		if($image=='N/A')
			return "<b>kasviewer:</b>tag image is not set";
		if($thumb=='N/A')
			return "<b>kasviewer:</b>tag thumb is not set";
			
		if($group!=''){
			$group = "[$group]";
		}
		return '<a href="'.$image.'" rel="sexylightbox'.$group.'" title="'.$title.'"><img src="'.$thumb.'" alt="" /></a>';
	}	
	// Parser iframe type
	function kasviewer_wp_iframe($atts) {
		// extraction data in variables
		extract(shortcode_atts(array(
			'url' => 'N/A',
			'thumb' => '',
			'text' => '',
			'title' => '',
			'group' => '',
			'width' => '',
			'height' => '',
		), $atts));	
		if($url=='N/A')
			return "<b>kasviewer:</b>tag url is not set";
		if($thumb=='' && $text=='')
			return "<b>kasviewer:</b>tag thumb or text is need to create link";
		if($width=='' || $height=='')
			return "<b>kasviewer:</b>tag width and height are required";
		if($group!=''){
			$group = "[$group]";
		}
		if($text=='')
			return '<a href="'.$url.'?TB_iframe=true&height='.$height.'&width='.$width.'" rel="sexylightbox'.$group.'" title="'.$title.'"><img src="'.$thumb.'" alt="" /></a>';
		else
			return '<a href="'.$url.'?TB_iframe=true&height='.$height.'&width='.$width.'" rel="sexylightbox'.$group.'" title="'.$title.'">'.$text.'</a>';
	}	
	// Parser iframe type
	function kasviewer_wp_content($atts, $content = null) {
		// get post
		global $post;
		// extraction data in variables
		extract(shortcode_atts(array(
			'show' => 'none',
			'thumb' => '',
			'text' => '',
			'title' => '',
			'group' => '',
			'width' => '',
			'height' => '',
		), $atts));	
		if($content==null)
			return "<b>kasviewer:</b>content is required";
		if($thumb=='' && $text=='')
			return "<b>kasviewer:</b>tag thumb or text is need to create link";
		if($width=='' || $height=='')
			return "<b>kasviewer:</b>tag width and height are required";
		if($group!=''){
			$group = "[$group]";
		}
		if($show!='true')
			$show = 'inline';
		else
			$show = 'none';
		// create randon id
		$id = $post->ID.'-'.rand(10,999);
		echo '<div id="kasview'.$id.'" style="display:'.$show.';">'.$content.'</div>';
		if($text=='')
			return '<a href="#TB_inline?height='.$height.'&width='.$width.'&inlineId=kasview'.$id.'" rel="sexylightbox'.$group.'" title="'.$title.'"><img src="'.$thumb.'" alt="" /></a>';
		else
			return '<a href="#TB_inline?height='.$height.'&width='.$width.'&inlineId='.$id.'" rel="sexylightbox'.$group.'" title="'.$title.'">'.$text.'</a>';
	}
	// add settings link on plugins list
    function kasviewer_wp_plugin_action($links, $file) {
		if ($file == plugin_basename(dirname(__FILE__).'/kasviewer.php')){
			$settings_link = '<a href="admin.php?page=wp-kasviewer/kasviewer_administration.php">Settings</a>';
			return array_merge(array($settings_link), $links);
		}
		return $links;
    }	
?>