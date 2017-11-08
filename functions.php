<?php
require 'vendor/autoload.php';

// Load custom libraries
require 'src/helpers/wp_bootstrap_navwalker.php';

// Load custom post type
require 'src/post-type/documents.php';
require 'src/post-type/calendar.php';
require 'src/post-type/gallery.php';

require 'src/sidebar.php';

require 'src/theme-setup.php';

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