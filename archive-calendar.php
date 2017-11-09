<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head();?>
</head>
<body <?php body_class("wp63-page wp63-event");?>>
	<?php get_template_part("template-parts/global", "header"); ?>
	<div id="main">
		<div class="container">
			<div class="row">
				<div class="col"></div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<?php if(have_posts()) : while(have_posts()) : the_post();?>
					<div class="post-item">
						<div class="post-container">
							<div class="event-meta row">
								<div class="col-2 event-icon">
									<i class="fa fa-calendar-o" aria-hidden="true"></i>
								</div>
								<div class="col-10 event-detail">
									<div class="event-detail-wrapper">
										<h5 class="event-title">
										<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
										</h5>
										<p class="event-date">
											<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo date("F j, Y", strtotime(get_field('event_date')));?>
										</p>
										<p class="event-location">
											<i class="fa fa-map-marker" aria-hidden="true"></i> <?php the_field("event_location");?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endwhile; endif; ?>
					<div class="row">
						<div class="container wp63-pagination">
							<?php wp_pagenavi(); ?>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="sidebar-list">
					<?php if ( is_active_sidebar( 'sidebar-single' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-single' ); ?>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part("template-parts/global", "footer");?>
	<?php wp_footer(); ?>
</body>
</html>