<?php
require 'vendor/autoload.php';

// Load custom libraries
require 'src/helpers/wp_bootstrap_navwalker.php';

// Load custom post type
require 'src/post-type/documents.php';
require 'src/post-type/calendar.php';

require 'src/sidebar.php';

require 'src/theme-setup.php';

function asset_path($asset = "img"){
	echo get_template_directory_uri() . "/public/" . $asset;
}