<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head();?>
</head>
<body>
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-6"><img src="<?php asset_path(); ?>/logo-main.jpg" alt="" class="logo"></div>
				<div class="col-md-6">
					<nav id="main-nav" class="navbar navbar-expand-lg navbar-light">
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
				</div>
			</div>
		</div>
	</header>
	<?php wp_footer(); ?>
</body>
</html>