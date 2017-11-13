<header id="header">
	<div class="container header-container">
		<div class="row">
			<div class="col">
				<nav id="main-nav" class="navbar navbar-expand-md navbar-light">
					<ul class="navbar-nav nav-logo-wrapper mr-auto">
						<li class="nav-item active">
							<a href="<?php echo esc_url( home_url( '/' ) );?>" class="logo-link"><img src="<?php asset_path(); ?>/logo-main.jpg" alt="" class="logo"></a>
						</li>
					</ul>
					<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarsExampleDefault">
						<ul class="navbar-nav ml-auto">
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
<?php /*
<div class="container">
	<div class="row">
		<div class="col-md-5"><img src="<?php asset_path(); ?>/logo-main.jpg" alt="" class="logo"></div>
		<div class="col-md-7">
			<nav id="main-nav" class="navbar navbar-expand-md navbar-light">
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
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</nav>
		</div>
	</div>
</div>
*/?>
</header>