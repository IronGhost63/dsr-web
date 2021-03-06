<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head();?>
</head>
<body <?php body_class("wp63-page");?>>
	<?php get_template_part("template-parts/global", "header"); ?>
	<div id="main">
		<div class="container">
			<div class="row">
				<div class="col"></div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<div class="post-item">
					<?php if(have_posts()) : ?>
						<?php if(has_post_thumbnail()) :?>
						<div class="post-cover">
							<?php the_post_thumbnail("news-cover"); ?>
						</div>
						<?php endif; ?>
						<div class="post-container">
							<?php while(have_posts()) : the_post(); ?>
							<div class="post-head">
								<h2 class="post-title"><?php the_title(); ?></h2>
							</div>
							<div class="post-meta">
								<i class="fa fa-calendar-o" aria-hidden="true"></i> <span class="post-date"><?php the_time("j F Y g:i a"); ?></span>
								<i class="fa fa-folder-o" aria-hidden="true"></i> <span class="post-category"><?php the_category( ", ");?></span>
							</div>
							<div class="post-content">
								<?php the_content(); ?>
							</div>
							<?php if( get_field( "gallery_store" ) == "link" ) : ?>
							<div class="gallery-meta row">
								<div class="col-2 gallery-icon">
									<i class="fa fa-picture-o" aria-hidden="true"></i>
								</div>
								<div class="col-10 gallery-detail">
									<div class="gallery-detail-wrapper">
										<h5 class="gallery-title">
											<a href="<?php the_field("gallery_url"); ?>">เข้าชมอัลบั้ม <?php the_title();?></a> <i class="fa fa-external-link" aria-hidden="true"></i>
										</h5>
									</div>
								</div>
							</div>
							<?php endif; ?>
							<?php if(function_exists("seed_social")) : ?>
							<div class="post-share">
								<?php seed_social(); ?>
							</div>
							<?php endif; ?>
							<?php endwhile;?>
						</div>
					<?php endif; ?>
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