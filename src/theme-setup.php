<?php
add_action( 'after_setup_theme', 'wp63_theme_setup' );
add_action( 'init', 'wp63_theme_init' );
add_action( 'widgets_init', 'wp63_register_sidebars' );
add_action( "wp_enqueue_scripts", "wp63_enqueue" );
add_filter( 'image_resize_dimensions', 'image_crop_dimensions', 10, 6 );

function wp63_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'news-thumbs', 318, 180, true );
	add_image_size( 'news-cover', 1200, 630, true );
	add_image_size( 'home-slide', 1600, 680, true );
}

function wp63_theme_init() {
	$locations = array(
		'primary' => __( 'Main Menu', 'dsr' ),
	);
	register_nav_menus( $locations );

	// Register Custom Post Types
	wp63_cpt_calendar();
	wp63_cpt_gallery();	
	wp63_cpt_congratulate();
	wp63_cpt_research();
	wp63_cpt_documents();
}

function wp63_enqueue(){
	wp_enqueue_style( "google-fonts", "https://fonts.googleapis.com/css?family=Kanit:200,400,600|Prompt:200,400,700&amp;subset=thai");
	wp_enqueue_style( "bootstrap", get_template_directory_uri() . '/vendor/twbs/bootstrap/dist/css/bootstrap.min.css');
	wp_enqueue_style( "font-awesome", get_template_directory_uri() . '/vendor/fortawesome/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style( "main", get_template_directory_uri() . '/public/css/main.css');

	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', false, '3.2.1');
	wp_enqueue_script('jquery');

	wp_enqueue_script( 'popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js', array('jquery'), true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/vendor/twbs/bootstrap/dist/js/bootstrap.min.js', array('jquery', 'popper'), true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/public/js/main.js', array('jquery'), true );
}
?>