<?php
/**
 * Plugin Name: ALT LAB Iframe Helper
 * Plugin URI: https://github.com/woodwardtw/
 * Description: Shortcode to throw IG pics by tag or user //[igpics user="" or tag="" pics="5"]

 * Version: 1.7
 * Author: Tom Woodward
 * Author URI: http://bionicteaching.com
 * License: GPL2
 */
 
 /*   2018 Tom  (email : bionicteaching@gmail.com)
 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
 
 // If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) exit;

function alt_lab_iframe_enqueue_scripts() {
    wp_enqueue_style( 'iframe helper style', plugins_url( '/css/main.css', __FILE__ ),array(), '1.0.0', false  ); 
    wp_enqueue_script( 'iframe helper script', plugins_url('/js/main.js', __FILE__ ),array(), '1.0.0', true );    

}
add_action( 'wp_enqueue_scripts', 'alt_lab_iframe_enqueue_scripts' );


add_filter( 'the_content', 'add_iframe_code_element' ); 
function add_iframe_code_element($content){
    global $post;
    if( current_user_can('editor') || current_user_can('administrator') ) {
        $url = htmlentities(get_permalink($post->ID));
        $html = '<button id="copy-embed" class="outcomes">Copy</button>';
        $html .= '<input type="text" name="iframe-embed" id="iframe-code" data-url="' . $url . '">';
        return $content . $html;
                                    }
}