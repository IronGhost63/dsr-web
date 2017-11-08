<?php
/* Template name: Page - Full width */
?>
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
				<div class="col">
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
							<div class="post-content">
								<?php the_content(); ?>
							</div>
							<?php endwhile;?>
						</div>
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