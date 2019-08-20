<?php
/* Template name: Personel */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head();?>
</head>
<body <?php body_class("wp63-page wp63-personel");?>>
	<?php get_template_part("template-parts/global", "header"); ?>
	<div id="main">
		<div class="container">
			<div class="row">
				<div class="col"></div>
			</div>
			<div class="row">
				<div class="col-md-9">
				<?php if(have_posts()) : ?>
					<div class="post-item">
						<div class="post-container">
							<?php while(have_posts()) : the_post(); ?>
							<div class="post-head">
								<h2 class="post-title"><?php the_title(); ?></h2>
							</div>
							<?php endwhile;?>
						</div>
					</div>
					<div class="personel-list container">
						<?php if(have_rows("office")) : while(have_rows("office")) : the_row(); ?>
						<div class="row personel-list-head">
							<div class="col">
								<?php the_sub_field("office_name");?>
							</div>
						</div>
						<div class="row personel-list-item">
						<?php if(have_rows("officers")) : while(have_rows("officers")) : the_row(); ?>
							<div class="col-md-3 personel-photo-container">
								<?php echo wp_get_attachment_image(get_sub_field("photo"), "personel-photo", false, array("class"=>"personel-photo")); ?>
								<p class="personel-name text-center"><?php the_sub_field("name");?><?php echo (get_sub_field("position") ? PHP_EOL."<br>" . get_sub_field("position") : "" );?></p>
							</div>
						<?php endwhile; endif; ?>
						</div>
						<?php endwhile; endif; ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="col-md-3">
					<div class="sidebar-list">
					<?php if ( is_active_sidebar( 'sidebar-about' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-about' ); ?>
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