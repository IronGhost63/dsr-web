<?php
function wp63_register_sidebars(){
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'dsr' ),
		'id' => 'sidebar-single',
		'description' => __( 'Default sidebar', 'dsr' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><div class="widget-content">',
	) );

	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'dsr' ),
		'id' => 'sidebar-page',
		'description' => __( 'Generic Page Sidebar', 'dsr' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><div class="widget-content">',
	) );
	
	register_sidebar( array(
		'name' => __( 'About Sidebar', 'dsr' ),
		'id' => 'sidebar-about',
		'description' => __( 'Sidebar for About section', 'dsr' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><div class="widget-content">',
	) );
}
?>