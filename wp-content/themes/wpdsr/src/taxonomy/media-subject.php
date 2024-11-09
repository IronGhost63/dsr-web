<?php
function wp63_tax_media_subject() {

	$labels = array(
		'name'                       => _x( 'กลุ่มสาระวิชา', 'Taxonomy General Name', 'dsr' ),
		'singular_name'              => _x( 'กลุ่มสาระวิชา', 'Taxonomy Singular Name', 'dsr' ),
		'menu_name'                  => __( 'กลุ่มสาระวิชา', 'dsr' ),
		'all_items'                  => __( 'All Items', 'dsr' ),
		'parent_item'                => __( 'Parent Item', 'dsr' ),
		'parent_item_colon'          => __( 'Parent Item:', 'dsr' ),
		'new_item_name'              => __( 'New Item Name', 'dsr' ),
		'add_new_item'               => __( 'Add New Item', 'dsr' ),
		'edit_item'                  => __( 'Edit Item', 'dsr' ),
		'update_item'                => __( 'Update Item', 'dsr' ),
		'view_item'                  => __( 'View Item', 'dsr' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'dsr' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'dsr' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'dsr' ),
		'popular_items'              => __( 'Popular Items', 'dsr' ),
		'search_items'               => __( 'Search Items', 'dsr' ),
		'not_found'                  => __( 'Not Found', 'dsr' ),
		'no_terms'                   => __( 'No items', 'dsr' ),
		'items_list'                 => __( 'Items list', 'dsr' ),
		'items_list_navigation'      => __( 'Items list navigation', 'dsr' ),
	);
	$rewrite = array(
		'slug'                       => 'instruction-media/subject',
		'with_front'                 => false,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'mediasubject', array( 'instruction-media' ), $args );

}
