<?php
if( have_rows('icon_columns') ) : 
	$icon_section_title = get_field('icon_section_title');
	$icon_section_intro = get_field('icon_section_intro');
	$icon_number_of_columns = get_field('icon_number_of_columns');
	?>
	<section id="our-difference" class="our-difference">
		<div class="wrapper">
			<hr class="tw-mb-6 tw-bg-gray tw-w-3/4 md:tw-w-3/5" />
			<div class="topblock">
				<?php if ($icon_section_title) : ?>
					<h2 class="title tw-text-4xl md:tw-text-5xl"><?php echo $icon_section_title; ?></h2>
				<?php endif; ?>
				<?php echo $icon_section_intro; ?>
			</div>
			<div class="grid <?php echo $icon_number_of_columns; ?>">
				<?php $acc_ctr = 0; while( have_rows('icon_columns') ) : the_row(); $acc_ctr++;
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$description = get_sub_field('description');
					?>

					<div class="item">
						<div class="accordion">
							<button class="accordion-trigger" id="accordion-<?php echo $acc_ctr; ?>" aria-expanded="false" aria-controls="accordion-<?php echo $acc_ctr; ?>-content">
								<?php if ($image) : ?>
									<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="mobile" loading="lazy">
								<?php endif; ?>

								<span class="tw-text-2xl"><?php echo $title ? $title : ''; ?></span>
								<i class="fa-sharp fa-solid fa-plus-large status plus"></i>
								<i class="fa-sharp fa-solid fa-minus status minus"></i>
							</button>
							<div class="accordion-content" id="accordion-<?php echo $acc_ctr; ?>-content" aria-labelledby="accordion-<?php echo $acc_ctr; ?>">
								<?php if ($image) : ?>
									<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="icon desktop" loading="lazy">
								<?php endif; ?>
								<?php if ($description) : ?>
									<?php echo $description; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; ?>