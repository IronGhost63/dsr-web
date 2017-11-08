<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head();?>
</head>
<body <?php body_class("wp63-home");?>>
	<?php get_template_part("template-parts/global", "header"); ?>
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
						<h2><i class="fa fa-newspaper-o" aria-hidden="true"></i> <?php _e("ข่าวสาร", "dsr");?></h2>
						<div class="row news-list">
						<?php
						$home_news = new WP_Query(array(
							'post_type' => 'post',
							'posts_per_page' => 6
						));
						?>
						<?php if($home_news->have_posts()) : while($home_news->have_posts()) : $home_news->the_post(); ?>
							<div class="col-md-4 news-item" id="news-<?php the_ID();?>">
								<a class="card" href="<?php the_permalink(); ?>">
									<img class="card-img-top" src="<?php the_post_thumbnail_url( "news-thumbs" ); ?> " alt="<?php the_title();?>">
									<div class="card-block">
										<p class="card-text"><?php the_title(); ?></p>
									</div>
								</a>
							</div>
						<?php endwhile; else: ?>
							<div class="col text-center">
								<div class="alert alert-warning" role="alert">
									<?php _e("ไม่พบข้อมูล"); ?>
								</div>
							</div>	
						<?php endif;?>
						</div>
						<div class="row">
							<div class="col text-right">
								<a href="<?php get_post_type_archive_link( 'post' ); ?>"><?php _e("ข่าวสารทั้งหมด"); ?> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<h2><i class="fa fa-calendar" aria-hidden="true"></i> <?php _e("ปฏิทิน", "dsr");?></h2>
						<div class="row">
						<?php
						$today = date("Ymd");
						$home_event = new WP_Query(array(
							'post_type' => 'calendar',
							'posts_per_page' => 3,
							'meta_query' => array(
								array(
									'meta_key' => "event_date",
									'meta_value' => $today,
									'meta_compare' => ">="
								)
							)
						));
						?>
						<?php if($home_event->have_posts()) : ?>
							<div class="col">
								<ul class="event-list list-group">
						<?php while($home_event->have_posts()) : $home_event->the_post(); ?>
									<li class="event-item list-group-item" id="event-<?php the_ID();?>">
										<p class="event-title">
											<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
										</p>
										<p class="event-date">
											<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo date("F j, Y", strtotime(get_field('event_date')));?>
										</p>
										<p class="event-location">
											<i class="fa fa-map-marker" aria-hidden="true"></i> <?php the_field("event_location");?>
										</p>
									</li>
						<?php endwhile; ?>
								</ul>
							</div>
						<?php else : ?>
							<div class="col text-center">
								<div class="alert alert-warning" role="alert">
									<?php _e("ไม่มีกิจกรรม"); ?>
								</div>
							</div>	
						<?php endif;?>
						</div>
						<div class="row">
							<div class="col text-right">
								<a href="<?php get_post_type_archive_link( 'calendar' ); ?>"><?php _e("กิจกรรมทั้งหมด"); ?> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="congratulate-block" class="block">
			<div class="container">
				<div class="row">
					<div class="col text-center">
						<h2><?php _e("ทำเนียบคนเก่ง", "dsr");?></h2>
					</div>
				</div>
				<div class="row justify-content-center align-items-stretch">
				<?php
				$home_congrat = new WP_Query(array(
					'post_type' => 'congratulate',
					'posts_per_page' => 4
				));
				?>
				<?php if($home_congrat->have_posts()) : while($home_congrat->have_posts()) : $home_congrat->the_post();?>
					<div class="col-md-3">
						
					</div>
				<?php endwhile; else : ?>
					<div class="col text-center">
						<div class="alert alert-warning" role="alert">
							<?php _e("ไม่พบข้อมูล"); ?>
						</div>
					</div>	
				<?php endif;?>
				</div>
				<div class="row">
					<div class="col text-right">
						<a href="<?php get_post_type_archive_link( 'calendar' ); ?>"><?php _e("คนเก่งทั้งหมด"); ?> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div id="activity-block" class="block">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2><i class="fa fa-star-o" aria-hidden="true"></i> <?php _e("ภาพกิจกรรม", "dsr");?></h2>
					</div>
					<div class="col-md-4">
						<h2><i class="fa fa-file-text-o" aria-hidden="true"></i> <?php _e("คำสั่งโรงเรียน", "dsr");?></h2>
						<div class="row">
						<?php
						$home_document = new WP_Query(array(
							'post_type' => "document",
							'posts_per_page' => 5
						));
						?>
						<?php if($home_document->have_posts()) : ?>
							<div class="col">
								<ul class="document-list list-group">
								<?php while($home_document->have_posts()) : $home_document->the_post(); ?>
									<li class="document-item list-group-item" id="document-<?php the_ID();?>">
										<a href="<?php echo document_link(get_the_ID()); ?>"><?php the_title(); ?></a>
									</li>
								<?php endwhile; ?>
								</ul>
							</div>
						<?php else: ?>
							<div class="col text-center">
								<div class="alert alert-warning" role="alert">
									<?php _e("ไม่มีเอกสารเผยแพร่"); ?>
								</div>
							</div>	
						<?php endif;?>
						</div>
						<div class="row">
							<div class="col text-right">
								<a href="<?php get_post_type_archive_link( 'document' ); ?>"><?php _e("เอกสารทั้งหมด"); ?> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part("template-parts/global", "footer");?>
	<?php wp_footer(); ?>
</body>
</html>