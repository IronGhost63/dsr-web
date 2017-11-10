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
					<?php if(have_posts()) : while(have_posts()) : the_post();?>
					<div class="post-item">
						<div class="post-container">
							<div class="post-head">
								<a href="<?php the_permalink(); ?>"><h2 class="post-title"><?php the_title(); ?></h2></a>
							</div>
							<div class="post-meta">
								<i class="fa fa-calendar-o" aria-hidden="true"></i> <span class="post-date"><?php the_time("F j, Y g:i a"); ?></span>
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