<?php
require 'vendor/autoload.php';

// Load custom libraries
require 'src/helpers/wp_bootstrap_navwalker.php';

// Load custom post type
require 'src/post-type/documents.php';
require 'src/post-type/calendar.php';
require 'src/post-type/gallery.php';
require 'src/post-type/congratulate.php';
require 'src/post-type/student-works.php';
require 'src/post-type/research.php';
require 'src/post-type/order.php';

require 'src/sidebar.php';

require 'src/theme-setup.php';

// Hooks
add_filter( 'wp_pagenavi', __NAMESPACE__ . '\\gc_pagination', 10, 2 );

function get_asset_path($asset = "img"){
	return get_template_directory_uri() . "/public/" . $asset;
}

function asset_path($asset = "img"){
	echo get_template_directory_uri() . "/public/" . $asset;
}

function document_link($doc_id) {
	$type = get_field("document_store", $doc_id);
	if(!$type){
		return false;
	}

	if($type == "upload"){
		return get_field("document_file", $doc_id);
	}elseif($type == "link"){
		return get_field("document_url", $doc_id);
	}else{
		return false;
	}
}

function gallery_link($gallery_id) {
	$type = get_field("gallery_store", $gallery_id);
	if(!$type){
		return false;
	}

	if($type == "upload"){
		return get_permalink($gallery_id);
	}elseif($type == "link"){
		return get_field("gallery_url", $gallery_id); 
	}else{
		return false;
	}
}

function gc_pagination($html) {
    $out = '';
    $out = str_replace('<div','',$html);
    $out = str_replace('class=\'wp-pagenavi\'>','',$out);
    $out = str_replace('<a','<li class="page-item"><a class="page-link"',$out);
    $out = str_replace('</a>','</a></li>',$out);
    $out = str_replace('<span class=\'current\'','<li class="page-item active"><span class="page-link current"',$out);
    $out = str_replace('<span class=\'pages\'','<li class="page-item"><span class="page-link pages"',$out);
    $out = str_replace('<span class=\'extend\'','<li class="page-item"><span class="page-link extend"',$out);  
    $out = str_replace('</span>','</span></li>',$out);
    $out = str_replace('</div>','',$out);
    return '<ul class="pagination justify-content-center">'.$out.'</ul>';
}