<?php

/*
Plugin Name: Seeds
Plugin URI: http://dominicmcphee.com/seeds
Description: Seeds allows you to display links added to post in a widget
Version: 0.1.0
Author: Dominic McPhee
Author URI: http://dominicmcphee.com
License: GPL2
*/


/*  Copyright 2012  Dominic McPhee  (email : dominic.mcphee@gmail.com)

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

require_once('seeds-widget.php');
require_once('post-seeds-meta.php');

/**
 * Action to save link to post meta through ajax
 */
function save_post_seed() {
    $data = $_POST['data'];

    $post_id = $data['post_id'];
    $seed = $data['seed'];
    $link = $data['link'];

    update_post_meta($post_id, $seed, $link);
    
    echo 'success';

    die();
}

add_action('wp_ajax_save_post_seed', 'save_post_seed');

/**
 * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
 */
add_action( 'wp_enqueue_scripts', 'add_seeds_stylesheet' );

/**
 * Enqueue plugin style-file
 */
function add_seeds_stylesheet() {
    wp_register_style( 'seeds-style', plugins_url('css/style.css', __FILE__) );
    wp_register_style( 'font-awesome-style', plugins_url('css/font-awesome.css', __FILE__) );
    wp_register_style( 'fonts-style', plugins_url('css/fonts.php', __FILE__) );
    wp_enqueue_style( 'seeds-style' );
    wp_enqueue_style( 'font-awesome-style' );
    wp_enqueue_style( 'fonts-style' );
}