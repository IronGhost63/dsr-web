<?php
function wp63_register_sidebars(){
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'dsr' ),
		'id' => 'sidebar-single',
		'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'dsr' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><div class="widget-content">',
	) );

	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'dsr' ),
		'id' => 'sidebar-page',
		'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'dsr' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><div class="widget-content">',
	) );
}
?>