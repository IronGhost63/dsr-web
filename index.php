<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head();?>
</head>
<body <?php body_class();?>>
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
	<div id="home-slider">
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<div class="carousel-item active">
					<img class="d-block img-fluid" src="<?php asset_path(); ?>/sample/stock-1.jpg" alt="First slide">
				</div>
				<div class="carousel-item">
					<img class="d-block img-fluid" src="<?php asset_path(); ?>/sample/stock-2.jpg" alt="Second slide">
				</div>
				<div class="carousel-item">
					<img class="d-block img-fluid" src="<?php asset_path(); ?>/sample/stock-3.jpg" alt="Third slide">
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	<div id="main">
		<div id="news-block" class="block">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2><?php _e("ข่าวสาร", "dsr");?></h2>
						<div class="row news-list">
							<div class="col-md-4 news-item">
								<a class="card" href="#">
									<img class="card-img-top" src="http://via.placeholder.com/318x180" alt="Card image cap">
									<div class="card-block">
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
									</div>
								</a>
							</div>
							<div class="col-md-4 news-item">
								<a class="card" href="#">
									<img class="card-img-top" src="http://via.placeholder.com/318x180" alt="Card image cap">
									<div class="card-block">
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
									</div>
								</a>
							</div>
							<div class="col-md-4 news-item">
								<a class="card" href="#">
									<img class="card-img-top" src="http://via.placeholder.com/318x180" alt="Card image cap">
									<div class="card-block">
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
									</div>
								</a>
							</div>
							<div class="col-md-4 news-item">
								<a class="card" href="#">
									<img class="card-img-top" src="http://via.placeholder.com/318x180" alt="Card image cap">
									<div class="card-block">
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
									</div>
								</a>
							</div>
							<div class="col-md-4 news-item">
								<a class="card" href="#">
									<img class="card-img-top" src="http://via.placeholder.com/318x180" alt="Card image cap">
									<div class="card-block">
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
									</div>
								</a>
							</div>
							<div class="col-md-4 news-item">
								<a class="card" href="#">
									<img class="card-img-top" src="http://via.placeholder.com/318x180" alt="Card image cap">
									<div class="card-block">
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
									</div>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col text-right">
								<a href="<?php get_post_type_archive_link( 'post' ); ?>"><?php _e("ข่าวสารทั้งหมด"); ?> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<h2><?php _e("ปฏิทิน", "dsr");?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6"></div>
				<div class="col-md-3"></div>
				<div class="col-md-3">
					<h6>ติดต่อโรงเรียน</h6>
					<p class="address">
					โรงเรียนเทพศิรินทร์ร่มเกล้า เลขที่ 2 ซอย ไอซีดี 8 แขวงคลองสามประเวศ เขตลาดกระบัง กรุงเทพมหานคร 10520
					</p>
					<p class="phone">
						<i class="fa fa-phone" aria-hidden="true"></i> โทรศัพท์ 0 2737 8919 - 20
					</p>
					<p class="fax">
						<i class="fa fa-fax" aria-hidden="true"></i> โทรสาร 0 2360 9287 
					</p>
				</div>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>