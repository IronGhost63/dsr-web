<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head();?>
</head>
<body>
	<div id="page">
		<?php get_template_part( "template-parts/global", "header" );?>
		<div id="main" class="container">
			<div class="row">
				<div class="col-md-8">
					<?php if(have_posts()) : while(have_posts()) : the_post();?>
						<div class="post-item">
							<div class="post-head">
								<h2><?php the_title(); ?></h2>
							</div>
							<div class="post-meta">
								<i class="fa fa-calendar-o" aria-hidden="true"></i> <span class="post-date"><?php the_time("F j, Y g:i a"); ?></span>
							</div>
							<?php if(has_post_thumbnail()): ?>
							<div class="post-thumbnail">
								<?php the_post_thumbnail("post-cover");?>
							</div>
							<?php endif; ?>
							<div class="post-content">
								<?php the_content();?>
							</div>
						</div>
					<?php endwhile; else: ?>

					<?php endif;?>
				</div>
				<div class="col-md-4">Hello</div>
			</div>
		</div>
		<?php get_template_part( "template-parts/global", "footer" );?>
	</div>
	<?php wp_footer(); ?>
</body>
</html>