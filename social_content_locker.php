<?php
/*
Plugin Name: Social Content Lockerz
Plugin URI: http://www.genweb.es
Description: Social Content Lockerz
Version: 1.0
Author: Juanma Rodríguez
Author URI: http://www.genweb.es
*/

/*
Copyright (C) 2015 Juanma Rodríguez
Contact me at http://www.genweb.es

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

add_shortcode("social_locker_shortcode", "socialcontentlocker_process_shortcode");

function socialcontentlocker_process_shortcode( $attributes, $content = null ) {
	global $add_my_script;
	$add_my_script = true;

	extract( shortcode_atts( array(
		'type' => '',
		'text' => '',
		'textcolor' => '',
		'background' => ''
	), $attributes ) );
	
	if ($textcolor!="") $estiloh3="style='color:$textcolor'";
	if ($text!="") $textomostrar="<h3 $estiloh3>$text</h3>";
	else $textomostrar="<h3 $estiloh3>Use social buttons below to see extra content</h3>";
	if ($background!="") $estilofondo="style='background-color:$background!important'";

	if ($type=="g") return "<div class='sociallockz' $estilofondo>$textomostrar<g:plusone size='tall' callback='plusOned'></g:plusone> <div class='secret'>$content</div></div>";
	elseif ($type=="f") return "<div class='sociallockz' $estilofondo>$textomostrar<fb:like send='false' width='95' show_faces='true' layout='box_count' font='verdana'></fb:like> <div class='secret'>$content</div></div>";
	elseif ($type=="t") return "<div class='sociallockz' $estilofondo>$textomostrar<a href='https://twitter.com/share' class='twitter-share-button' data-via='yoyo' data-count='vertical'></a>	<div class='secret'>$content</div></div>";
	elseif (($type=="tf")||($type=="ft")) return "<div class='sociallockz' $estilofondo>$textomostrar<a href='https://twitter.com/share' class='twitter-share-button' data-via='yoyo' data-count='vertical'></a>	<fb:like send='false' width='95' show_faces='true' layout='box_count' font='verdana'></fb:like> <div class='secret'>$content</div></div>";
	elseif (($type=="gf")||($type=="fg")) return "<div class='sociallockz' $estilofondo>$textomostrar<g:plusone size='tall' callback='plusOned'></g:plusone> <fb:like send='false' width='95' show_faces='true' layout='box_count' font='verdana'></fb:like> <div class='secret'>$content</div></div>";
	elseif (($type=="gt")||($type=="tg")) return "<div class='sociallockz' $estilofondo>$textomostrar<g:plusone size='tall' callback='plusOned'></g:plusone> <a href='https://twitter.com/share' class='twitter-share-button' data-via='yoyo' data-count='vertical'></a> <div class='secret'>$content</div></div>";	
	else return "<div class='sociallockz' $estilofondo>$textomostrar<g:plusone size='tall' callback='plusOned'></g:plusone>
	<fb:like send='false' width='95' show_faces='true' layout='box_count' font='verdana'></fb:like>
	<a href='https://twitter.com/share' class='twitter-share-button' data-via='yoyo' data-count='vertical'></a>
	<div class='secret'>$content</div></div>";	
}



add_action('init', 'register_my_script');
add_action('wp_footer', 'print_my_script');

function register_my_script() {
	wp_enqueue_style('social_lockz',   plugins_url('social_lockz.css', __FILE__) );
	wp_register_script('social_lockz', plugins_url('social_lockz.js', __FILE__), array('jquery'), '1.0', true);
}

function print_my_script() {
	global $add_my_script;

	if ( ! $add_my_script )
		return;

	wp_print_scripts('social_lockz');
}
?>