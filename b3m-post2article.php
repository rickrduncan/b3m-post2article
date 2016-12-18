<?php
/**
 * 	Plugin Name: 	B3M Post2Article
 * 	Plugin URI: 	http://rickrduncan.com
 * 	Description: 	Change all occurrences of the word 'POST' to 'Article'
 * 	Author: 		Rick R. Duncan - B3Marketing, LLC
 * 	Author URI: 	http://rickrduncan.com
 *
 *
 * 	Version: 		1.0.0
 * 	License: 		GPLv3
 *
 *
 *  WordPress Functionality Plugin is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 2 of the License, or
 *  any later version.
 *
 *  WordPress Functionality Plugin is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with WP Functional Plugin. If not, see <http://www.gnu.org/licenses/>.
 */



/**
* Function to change post object labels to "article"
*
* @since 1.0.0
*/
function b3m_change_post_object_label() {
    
    global $wp_post_types;
    
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Articles';
    $labels->singular_name = 'Article';
    $labels->add_new = 'Add New Article';
    $labels->add_new_item = 'Add Article';
    $labels->edit_item = 'Edit Article';
    $labels->new_item = 'Article';
    $labels->view_item = 'View Article';
    $labels->search_items = 'Search Articles';
    $labels->not_found = 'No Articles found';
    $labels->not_found_in_trash = 'No Articles found in Trash';
    $labels->name_admin_bar = 'Article';
}
add_action( 'init', 'b3m_change_post_object_label' );


/**
* Function to change "posts" to "article" in the admin side menu
*
* @since 1.0.0
*/
function b3m_change_post_menu_label() {
    
    global $menu;
    global $submenu;
    
    $menu[5][0] = 'Articles';
    $submenu['edit.php'][5][0] = 'View All Articles';
    $submenu['edit.php'][10][0] = 'Add New Article';
    $submenu['edit.php'][16][0] = 'Tags';
    
    echo '';
}
add_action( 'admin_menu', 'b3m_change_post_menu_label' );


/**
* Register admin styles and scripts
*
* @since 1.0.0
*/
function b3m_register_admin_styles() {
	
	if ( is_admin() ) {
		wp_enqueue_style( 'b3m-post2article-styles', plugins_url( 'b3m-post2article/css/post2article.admin.css' ) );
	}
}
add_action( 'admin_print_styles', 'b3m_register_admin_styles' );


/**
* Post (AKA Article) update messages. Seen when you update a post which is now called "Article"
*
* @since 1.0.0
*/
function b3m_article_post_updated_messages ( $msg ) {
    $msg[ 'post' ] = array (
         0 => '', // Unused. Messages start at index 1.
	 1 => "Article updated.",
           // or simply "Article updated.",
           // natural language "The article has been updated successfully.",
	 2 => 'Article updated.',  // Probably better do not touch
	 3 => 'Article deleted.',  // Probably better do not touch
	 4 => "Article updated.",
	 5 => "Article restored to revision",
	 6 => "Article published.",
            // you can use the kind of messages that better fits with your needs
	    // 6 => "Good boy, one more... so, 4,999,999 are to reach IMDB.",
	    // 6 => "This actor is already on the website.",
	    // 6 => "Congratulations, a new Actor's profile has been published.",
	 7 => "Article saved.",
	 8 => "Article submitted.",
	 9 => "Article scheduled.",
	10 => "Article draft updated.",
    );
    return $msg;
}
add_filter( 'post_updated_messages', 'b3m_article_post_updated_messages', 10, 1 );