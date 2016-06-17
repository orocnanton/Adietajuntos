<?php
/**
 * The custom post type file
 *
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage verano
 */

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'verano_custom_post' );
function verano_custom_post() {
	flush_rewrite_rules();
}


/*****************************
 *   Project custom type
 *****************************/

function custom_post_testimonials() {
    
	register_post_type( 'testimonios',
		array( 'labels' => array(
			     'name' => __( 'Testimonios', 'verano' ),
			     'singular_name' => __( 'Testimonio', 'verano' ),
			),
			'public' => true,
            'has_archive' => true,
			'taxonomies' => array('post_tag'),
			'menu_position' => 8,
            'hierarchical' => true,
			'menu_icon' => 'dashicons-desktop',
			'supports' => array( 'title', 'editor', 'thumbnail', 'revions'),
				'show_ui' => true
		) 
	);
	
}

add_action( 'init', 'custom_post_testimonials');
