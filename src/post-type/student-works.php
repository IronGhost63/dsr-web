<?php
function wp53_cpt_studentworks() {	
	$labels = array(
		'name'                  => _x( 'ผลงานนักเรียน', 'Post Type General Name', 'dsr' ),
		'singular_name'         => _x( 'ผลงานนักเรียน', 'Post Type Singular Name', 'dsr' ),
		'menu_name'             => __( 'ผลงานนักเรียน', 'dsr' ),
		'name_admin_bar'        => __( 'ผลงานนักเรียน', 'dsr' ),
		'archives'              => __( 'Item Archives', 'dsr' ),
		'attributes'            => __( 'Item Attributes', 'dsr' ),
		'parent_item_colon'     => __( 'Parent Item:', 'dsr' ),
		'all_items'             => __( 'All Items', 'dsr' ),
		'add_new_item'          => __( 'Add New Item', 'dsr' ),
		'add_new'               => __( 'Add New', 'dsr' ),
		'new_item'              => __( 'New Item', 'dsr' ),
		'edit_item'             => __( 'Edit Item', 'dsr' ),
		'update_item'           => __( 'Update Item', 'dsr' ),
		'view_item'             => __( 'View Item', 'dsr' ),
		'view_items'            => __( 'View Items', 'dsr' ),
		'search_items'          => __( 'Search Item', 'dsr' ),
		'not_found'             => __( 'Not found', 'dsr' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'dsr' ),
		'featured_image'        => __( 'Featured Image', 'dsr' ),
		'set_featured_image'    => __( 'Set featured image', 'dsr' ),
		'remove_featured_image' => __( 'Remove featured image', 'dsr' ),
		'use_featured_image'    => __( 'Use as featured image', 'dsr' ),
		'insert_into_item'      => __( 'Insert into item', 'dsr' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'dsr' ),
		'items_list'            => __( 'Items list', 'dsr' ),
		'items_list_navigation' => __( 'Items list navigation', 'dsr' ),
		'filter_items_list'     => __( 'Filter items list', 'dsr' ),
	);
	$rewrite = array(
		'slug'                  => 'student-works',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'ผลงานนักเรียน', 'dsr' ),
		'description'           => __( 'Post Type Description', 'dsr' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'studentworks', $args );

}
?>