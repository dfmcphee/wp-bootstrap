<?php

/*
Plugin Name: Nimbl Editor
Plugin URI: http://dominicmcphee.com/nimbl
Description: A better file editor for WordPress
Version: 1.0
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

require_once('nimbl.php');


add_action( 'admin_menu' , 'admin_menu_new_items' );
function admin_menu_new_items() {
	$link = plugins_url( 'nimbl/index.php' );
    global $submenu;
    $submenu['index.php'][500] = array( 'Nimbl Editor', 'manage_options' , $link ); 
} 