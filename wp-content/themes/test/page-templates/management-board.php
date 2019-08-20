<?php
/* Template name: Management Board */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head();?>
</head>
<body <?php body_class("wp63-page wp63-personel wp63-management");?>>
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
						<div class="row personel-list-head">
							<div class="col-md-9 offset-md-3">
								<?php _e("ผู้อำนวยการ", "dsr");?>
							</div>
						</div>
						<div class="row personel-list-item">
							<div class="col-md-2 offset-md-1"><?php echo wp_get_attachment_image(get_field("photo"), "personel-photo", false, array("class"=>"personel-photo")); ?></div>
							<div class="col-md-9">
								<p class="personel-name"><?php the_field("name");?></p>
								<p class="personel-position"><?php _e("ผู้อำนวยการโรงเรียนเทพศิรินทร์ร่มเกล้า"); ?></p>
							</div>
						</div>
						<div class="row personel-list-head">
							<div class="col-md-9 offset-md-3">
								<?php _e("รองผู้อำนวยการ", "dsr");?>
							</div>
						</div>
						<?php if(have_rows("deputy_directors")) : while(have_rows("deputy_directors")) : the_row(); ?>
						<div class="row personel-list-item">
							<div class="col-md-2 offset-md-1"><?php echo wp_get_attachment_image(get_sub_field("photo"), "personel-photo", false, array("class"=>"personel-photo")); ?></div>
							<div class="col-md-9">
								<p class="personel-name"><?php the_sub_field("name");?></p>
								<p class="personel-position"><?php the_sub_field("position"); ?></p>
							</div>
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