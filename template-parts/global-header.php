		<div id="header" class="container">
			<img src="<?php asset_path(); ?>/logo-main.jpg" alt="" class="logo">
		</div>
		<nav id="main-nav" class="navbar navbar-expand-lg navbar-dark">
			<div class="collapse navbar-collapse" id="navbarsExampleDefault">
				<ul class="navbar-nav mr-auto">
				<?php
					wp_nav_menu( array(
						'menu'              => 'primary',
						'theme_location'    => 'primary',
						'depth'             => 2,
						'container' => '',
						'items_wrap' => '%3$s',
						'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						'walker'            => new wp_bootstrap_navwalker())
					);
				?>
				</ul>
			</div>
		</nav>