<?php
/**
 * Plugin Name: Custom post 
 * Author: Rupom
 * Description: plugin description
 * Version: 1.0
 *
 */

function create_car_cpt() {
	$labels = array(
		'name' => 'Cars',
		'singular_name' =>  'Car',
		'all_items' =>  'All Cars',
		'add_new_item' =>  'Add New Car',
		'edit_item' =>  'Edit Car',
		'update_item' =>  'Update Car',
		'view_item' =>  'View Car',
		'view_items' =>  'View Cars',
		'search_items' =>  'Search Car',
		'featured_image' =>  'Car Image',
		'set_featured_image' =>  'Set car image',
		'remove_featured_image' =>  'Remove car image',
	);
	$args = array(
		'label' =>  'Cars',
		'labels' => $labels,
		'menu_icon' => 'dashicons-cart',
		'supports' => array('title', 'editor', 'thumbnail'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 15,
		'show_in_nav_menus' => true,
		'has_archive' => 'cars',
		'hierarchical' => true,
		'exclude_from_search' => false,
		'capability_type' => 'page',
		// 'rewrite' =>array(
        //     'slug' => 'mycar',
        //     'with_front' => false,  
        // ),
	);
	register_post_type( 'car', $args );
}
add_action( 'init', 'create_car_cpt');

// cpt ui
function register_my_cpts() {
	$labels = [
		"name" => "Books", 
		"singular_name" => "Book", 
		"add_new" => "Add New Book", 
		"add_new_item" => "Add New book", 
	];

	$args = [
		"label" => "Books", 
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"has_archive" => "books",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"hierarchical" => true,
		"rewrite" => [ "slug" => "note", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 12,
		"menu_icon" => "dashicons-book-alt",
		"supports" => [ "title", "editor", "thumbnail", "page-attributes" ],
	];

	register_post_type( "book", $args );
}
add_action( 'init', 'register_my_cpts' );
function callback_for_book_data(){
	$args = array(
		'post_type' => 'book',
		'posts_per_page' => -1,
	);
	$a_data = new WP_Query($args);
	$output = '';
	while($a_data->have_posts()){
		$a_data->the_post();
		$output .=  '<h2>'. get_the_title() .'</h2>' . get_the_content();
	}
	wp_reset_query();
	return $output;
}
add_shortcode('book_data','callback_for_book_data');
?>