<?php
if( have_rows('icon_columns') ) : 
	$icon_section_title = get_field('icon_section_title');
	$icon_section_intro = get_field('icon_section_intro');
	$icon_number_of_columns = get_field('icon_number_of_columns');
	?>
	<section id="suite" class="icon-cols">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/circle-white.svg" alt="grey decorative rings" class="deco top-right" loading="lazy">
		<div class="wrapper">
			<div class="topblock">
				<?php if ($icon_section_title) : ?>
					<h2 class="title"><?php echo $icon_section_title; ?></h2>
				<?php endif; ?>
				<?php echo $icon_section_intro; ?>
			</div>
			<div class="grid <?php echo $icon_number_of_columns; ?>">
				<?php while( have_rows('icon_columns') ) : the_row(); 
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$description = get_sub_field('description');
					?>
					<div class="item">
						<?php if ($title) : ?>
							<h3 class="h4 title"><strong><?php echo $title; ?></strong></h3>
						<?php endif; ?>
						<?php if ($image) : ?>
							<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="icon" loading="lazy">
						<?php endif; ?>
						<?php if ($description) : ?>
							<?php echo $description; ?>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; ?>