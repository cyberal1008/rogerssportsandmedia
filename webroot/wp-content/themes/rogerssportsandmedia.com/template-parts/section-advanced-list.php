<!-- ADVANCED SOLUTIONS-->
<?php if( have_rows('adv_list_items') ) : 
	$adv_section_title = get_field('adv_section_title');
	$adv_intro_content = get_field('adv_intro_content');
	?>
	<section id="advanced" class="advanced-list">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/dots.svg" alt="pattern of grey dots" class="deco" loading="lazy">
		<div class="wrapper">
			<div class="topblock">
				<?php if ($adv_section_title) : ?>
					<h2 class="section-title"><?php echo $adv_section_title; ?></h2>
				<?php endif; ?>
				<?php echo $adv_intro_content; ?>
			</div>
			<div class="grid two">
						
				<?php while( have_rows('adv_list_items') ) : the_row(); $adv_ctr++;
					$title = get_sub_field('title');
					$content = get_sub_field('content');
					?>
					<div class="item">
						<div class="num">
							<span><?php echo $adv_ctr; ?></span>
						</div>
						<div class="accordion">
							<button class="accordion-trigger" id="accordion-<?php echo $adv_ctr; ?>" aria-expanded="false" aria-controls="accordion-<?php echo $adv_ctr; ?>-content">
								<div class="num mobile">
									<span><?php echo $adv_ctr; ?></span>
								</div>
								<?php echo $title; ?>
								<i class="fa-sharp fa-solid fa-plus-large status plus"></i>
							</button>
							<div class="accordion-content" id="accordion-<?php echo $adv_ctr; ?>-content">
								<?php echo $content; ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>

			</div>
		</div>
	</section>
<?php endif; ?>