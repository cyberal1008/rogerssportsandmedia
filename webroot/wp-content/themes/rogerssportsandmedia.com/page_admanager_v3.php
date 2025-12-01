<?php

/**
 * Template Name: Ad Manager V3
 *
 */
get_header();
?>
<main>
	<?php
	$headline = get_field('headline');
	$headline_content = get_field('content');
	$headline_button = get_field('headline_button');
	$hero_scrolling_target_id = get_field('hero_scrolling_target_id');
	?>
	<section class="tw:relative tw:overflow-hidden tw:h-[672px] tw:md:h-[532px]">
		<video autoplay muted loop class="tw:absolute tw:top-0 tw:left-0 tw:w-full tw:h-full tw:object-cover">
			<source src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/videos/mobius-black.mp4" type="video/mp4">
		</video>
		<div class="tw:absolute tw:top-0 tw:left-0 tw:w-full tw:h-full" style="background-color: color-mix(in oklab, var(--tw-color-white) 10%, transparent);">
			<div class="wrapper tw:text-white">
				<div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-2">
					<div style="margin-top: 70px;">
						<?php if ($headline): ?>
							<h2 class="title2 tw:text-white" style="color: #fff;"><?php echo $headline; ?></h2>
						<?php endif; ?>
						<?php if ($headline_content): ?>
							<div class="tw:text-2xl tw:font-semibold tw:!mb-12">
								<?php echo $headline_content; ?>
							</div>
						<?php endif; ?>
						<?php if ($headline_button): ?>
							<div class="tw:flex tw:gap-x-6">
								<a class="tw:btn-primary" target="_blank" href="<?php echo $headline_button['url'] ?>"><?php echo $headline_button['title'] ?></a>
							</div>
						<?php endif; ?>
					</div>
					<?php if ($headline && $headline_content && !empty($hero_scrolling_target_id)): ?>
						<div class="tw:hidden tw:md:flex tw:flex-col tw:justify-end tw:items-start">
							<a class="tw:hover:no-underline tw:cursor-pointer" href="<?php echo esc_url($hero_scrolling_target_id); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/arrow-down.png" class="tw:h-20">
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- INTRO -->
	<?php
	$intro_title = get_field('intro_title');
	$intro_content = get_field('intro_content');
	$intro_button = get_field('intro_button');
	$intro_button_arialabel = get_field('intro_button_arialabel');
	$intro_column_1 = get_field('intro_column_1');
	$intro_column_2 = get_field('intro_column_2');
	$intro_column_3 = get_field('intro_column_3');
	$intro_column_4 = get_field('intro_column_4');
	?>
	<section style="padding: 50px 0 0">
		<section id="our-difference" class="our-difference">
			<div class="wrapper">
				<div class="top">
					<?php if ($intro_title) : ?>
						<h2 class="title2 tw-text-black"><?php echo $intro_title; ?></h2>
					<?php endif; ?>
					<?php echo $intro_content ? $intro_content : ''; ?>
				</div>
				<div class="grid four">
					<?php if (have_rows('intro_column_1')) : while (have_rows('intro_column_1')): the_row();
							$icon = get_sub_field('icon');
							$title = get_sub_field('title');
							$blurb = get_sub_field('blurb');
					?>
							<div class="item">
								<div class="accordion">
									<button class="accordion-trigger" id="accordion-1" aria-expanded="false" aria-controls="accordion-1-content">
										<?php if ($icon) : ?>
											<img src="<?php echo $icon['url']; ?>" class="mobile" alt="<?php echo $icon['alt']; ?>" loading="lazy">
										<?php endif; ?>
										<span><?php echo $title ? $title : ''; ?></span>
										<i class="fa-sharp fa-solid fa-plus-large status plus"></i>
										<i class="fa-sharp fa-solid fa-minus status minus"></i>
									</button>
									<div class="accordion-content" id="accordion-1-content" aria-labelledby="accordion-1">
										<?php if ($icon) : ?>
											<img src="<?php echo $icon['url']; ?>" class="desktop" alt="<?php echo $icon['alt']; ?>" loading="lazy">
										<?php endif; ?>
										<?php echo $blurb ? $blurb : ''; ?>
									</div>
								</div>
							</div>
					<?php endwhile;
					endif; ?>

					<?php if (have_rows('intro_column_2')) : while (have_rows('intro_column_2')): the_row();
							$icon = get_sub_field('icon');
							$title = get_sub_field('title');
							$blurb = get_sub_field('blurb');
					?>
							<div class="item">
								<div class="accordion">
									<button class="accordion-trigger" id="accordion-2" aria-expanded="false" aria-controls="accordion-2-content">
										<?php if ($icon) : ?>
											<img src="<?php echo $icon['url']; ?>" class="mobile" alt="<?php echo $icon['alt']; ?>" loading="lazy">
										<?php endif; ?>
										<span><?php echo $title ? $title : ''; ?></span>
										<i class="fa-sharp fa-solid fa-plus-large status plus"></i>
										<i class="fa-sharp fa-solid fa-minus status minus"></i>
									</button>
									<div class="accordion-content" id="accordion-2-content" aria-labelledby="accordion-2">
										<?php if ($icon) : ?>
											<img src="<?php echo $icon['url']; ?>" class="desktop" alt="<?php echo $icon['alt']; ?>" loading="lazy">
										<?php endif; ?>
										<?php echo $blurb ? $blurb : ''; ?>
									</div>
								</div>
							</div>
					<?php endwhile;
					endif; ?>

					<?php if (have_rows('intro_column_3')) : while (have_rows('intro_column_3')): the_row();
							$icon = get_sub_field('icon');
							$title = get_sub_field('title');
							$blurb = get_sub_field('blurb');
					?>
							<div class="item">
								<div class="accordion">
									<button class="accordion-trigger" id="accordion-3" aria-expanded="false" aria-controls="accordion-3-content">
										<?php if ($icon) : ?>
											<img src="<?php echo $icon['url']; ?>" class="mobile" alt="<?php echo $icon['alt']; ?>" loading="lazy">
										<?php endif; ?>
										<span><?php echo $title ? $title : ''; ?></span>
										<i class="fa-sharp fa-solid fa-plus-large status plus"></i>
										<i class="fa-sharp fa-solid fa-minus status minus"></i>
									</button>
									<div class="accordion-content" id="accordion-3-content" aria-labelledby="accordion-3">
										<?php if ($icon) : ?>
											<img src="<?php echo $icon['url']; ?>" class="desktop" alt="<?php echo $icon['alt']; ?>" loading="lazy">
										<?php endif; ?>
										<?php echo $blurb ? $blurb : ''; ?>
									</div>
								</div>
							</div>
					<?php endwhile;
					endif; ?>
					<?php if (have_rows('intro_column_4')) : while (have_rows('intro_column_4')): the_row();
							$icon = get_sub_field('icon');
							$title = get_sub_field('title');
							$blurb = get_sub_field('blurb');
					?>
							<div class="item">
								<div class="accordion">
									<button class="accordion-trigger" id="accordion-4" aria-expanded="false" aria-controls="accordion-4-content">
										<?php if ($icon) : ?>
											<img src="<?php echo $icon['url']; ?>" class="mobile" alt="<?php echo $icon['alt']; ?>" loading="lazy">
										<?php endif; ?>
										<span><?php echo $title ? $title : ''; ?></span>
										<i class="fa-sharp fa-solid fa-plus-large status plus"></i>
										<i class="fa-sharp fa-solid fa-minus status minus"></i>
									</button>
									<div class="accordion-content" id="accordion-4-content" aria-labelledby="accordion-4">
										<?php if ($icon) : ?>
											<img src="<?php echo $icon['url']; ?>" class="desktop" alt="<?php echo $icon['alt']; ?>" loading="lazy">
										<?php endif; ?>
										<?php echo $blurb ? $blurb : ''; ?>
									</div>
								</div>
							</div>
					<?php endwhile;
					endif; ?>
				</div>
			</div>
		</section>
	</section>

	<!-- BRANDS -->
	<?php
	$brands_section_title = get_field('brands_section_title');
	$brands_logos = get_field('brands_logos');
	if ($brands_logos) :
	?>
		<section id="brands" class="logos">
			<div class="wrapper">
				<?php if ($brands_section_title) : ?>
					<h2 class="title2"><?php echo $brands_section_title; ?></h2>
				<?php endif; ?>
				<div class="swiper logo-slider">
					<div class="swiper-wrapper">
						<?php foreach ($brands_logos as $logo) : ?>
							<div class="swiper-slide">
								<img style="max-width: 186px;" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- FEATURED VIDEO -->
	<style>
		.featured-video-section {
			padding-top: 44px;
		}

		.featured-video-section video {
			max-width: 800px;
			margin: 0 auto;
		}
	</style>
	<?php
	get_template_part('template-parts/section-featured-video');
	?>

	<!-- Radio Ad Section Repeater -->
	<?php
	if( have_rows('radio_ad_sections') ):
		while( have_rows('radio_ad_sections') ): the_row();
			$section_id = get_sub_field('section_id');
			$title = get_sub_field('title');
			$content = get_sub_field('content');
			$button_1 = get_sub_field('button_1');
			$button_2 = get_sub_field('button_2');
			$background_color = get_sub_field('background_color');
			$text_color = get_sub_field('text_color');
			$reverse_section = get_sub_field('reverse_section');
			
			// Get images
			$image_1 = get_sub_field('image_1');
			$image_2 = get_sub_field('image_2');
			$image_3 = get_sub_field('image_3');
			$image_4 = get_sub_field('image_4');
			$image_5 = get_sub_field('image_5');
			$image_6 = get_sub_field('image_6');
			
			// Capture images grid HTML
			ob_start();
			?>
			<div class="tw:grid tw:grid-cols-2 tw:xl:grid-cols-2 tw:gap-6">
				<div class="tw:flex tw:flex-col tw:gap-y-6 tw:pt-12">
					<?php if($image_1): ?>
					<div>
						<img src="<?php echo esc_url($image_1['url']); ?>" alt="<?php echo esc_attr($image_1['alt']); ?>" class="tw:md:w-[200px] tw:h-auto tw:rounded-xl">
					</div>
					<?php endif; ?>
					
					<?php if($image_2): ?>
					<div>
						<img src="<?php echo esc_url($image_2['url']); ?>" alt="<?php echo esc_attr($image_2['alt']); ?>" class="tw:md:w-[200px] tw:h-auto tw:rounded-xl">
					</div>
					<?php endif; ?>
					
					<?php if($image_3): ?>
					<div>
						<img src="<?php echo esc_url($image_3['url']); ?>" alt="<?php echo esc_attr($image_3['alt']); ?>" class="tw:md:w-[200px] tw:h-auto tw:rounded-xl">
					</div>
					<?php endif; ?>
				</div>
				
				<div class="tw:flex tw:flex-col tw:gap-y-6 tw:translate-y-[-3%]">
					<?php if($image_4): ?>
					<div>
						<img src="<?php echo esc_url($image_4['url']); ?>" alt="<?php echo esc_attr($image_4['alt']); ?>" class="tw:md:w-[200px] tw:h-auto tw:rounded-xl">
					</div>
					<?php endif; ?>
					
					<?php if($image_5): ?>
					<div>
						<img src="<?php echo esc_url($image_5['url']); ?>" alt="<?php echo esc_attr($image_5['alt']); ?>" class="tw:md:w-[200px] tw:h-auto tw:rounded-xl">
					</div>
					<?php endif; ?>
					
					<?php if($image_6): ?>
					<div>
						<img src="<?php echo esc_url($image_6['url']); ?>" alt="<?php echo esc_attr($image_6['alt']); ?>" class="tw:md:w-[200px] tw:h-auto tw:rounded-xl">
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
			$images_html = ob_get_clean();
			
			// Capture content HTML
			ob_start();
			?>
			<div class="tw:py-12">
				<?php if($title): ?>
				<h2 style="font-size: 36px; color: <?php echo esc_attr($text_color); ?>;"><?php echo esc_html($title); ?></h2>
				<?php endif; ?>
				
				<?php if($content): ?>
				<div class="tw:text-2xl tw:font-semibold tw:!mb-12">
					<?php echo wp_kses_post($content); ?>
				</div>
				<?php endif; ?>
				
				<?php if($button_1 || $button_2): ?>
				<div class="tw:flex tw:gap-x-6 tw:mb-8">
					<?php if($button_1): ?>
					<a target="<?php echo esc_attr($button_1['target'] ?: '_self'); ?>" href="<?php echo esc_url($button_1['url']); ?>" class="tw:border-2 tw:px-4 tw:py-3 tw:text-lg tw:font-semibold tw:rounded-full tw:hover:cursor-pointer" style="background-color: rgb(218, 41, 28); color: white; border-color: rgb(218, 41, 28);">
						<?php echo esc_html($button_1['title']); ?>
					</a>
					<?php endif; ?>
					
					<?php if($button_2): ?>
					<a target="<?php echo esc_attr($button_2['target'] ?: '_self'); ?>" href="<?php echo esc_url($button_2['url']); ?>" class="tw:bg-transparent tw:border-2 tw:px-4 tw:py-3 tw:text-lg tw:font-semibold tw:rounded-full tw:hover:cursor-pointer" style="color: <?php echo esc_attr($text_color); ?>; border-color: <?php echo esc_attr($text_color); ?>;">
						<?php echo esc_html($button_2['title']); ?>
					</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
			<?php
			$content_html = ob_get_clean();
			?>
			<section <?php echo $section_id ? 'id="' . esc_attr($section_id) . '"' : ''; ?> class="tw:overflow-hidden" style="background-color: <?php echo esc_attr($background_color); ?>; color: <?php echo esc_attr($text_color); ?>;">
				<div class="wrapper tw:grid tw:grid-cols-1 tw:md:grid-cols-2 tw:gap-x-12 tw:gap-y-12 tw:md:gap-y-0">
					<?php 
					if($reverse_section) {
						echo $content_html;
						echo $images_html;
					} else {
						echo $images_html;
						echo $content_html;
					}
					?>
				</div>
			</section>
			<?php
		endwhile;
	endif;
	?>

	<?php
	// Bottom section
	$bottom_image = get_field('bottom_section_image');
	$bottom_title = get_field('bottom_section_title');
	$bottom_list = get_field('bottom_section_list');
	$bottom_cta = get_field('bottom_section_cta');
	$bottom_bg_color = get_field('bottom_section_background_color');
	$bottom_text_color = get_field('bottom_section_text_color');
	?>
	
	<?php if($bottom_image): ?>
	<section style="padding: 70px 0; background-color: <?php echo esc_attr($bottom_bg_color); ?>; color: <?php echo esc_attr($bottom_text_color); ?>;">
		<div class="wrapper tw:grid tw:grid-cols-1 tw:md:grid-cols-2 tw:gap-x-12 tw:gap-y-12 tw:md:gap-y-0">
			<div class="tw:w-full tw:h-full tw:flex tw:items-center">
				<img 
					src="<?php echo esc_url($bottom_image['url']); ?>" 
					alt="<?php echo esc_attr($bottom_image['alt']); ?>" 
					class="tw:w-full tw:h-full tw:object-cover tw:md:object-cover tw:rounded-none tw:md:rounded-lg" 
					style="max-height: 600px;"
				/>
			</div>
			<div class="tw:md:px-4 tw:flex tw:flex-col tw:justify-center tw:items-start">
				<?php if($bottom_title): ?>
					<h2 style="font-size: 36px; color: <?php echo esc_attr($bottom_text_color); ?>;"><?php echo esc_html($bottom_title); ?></h2>
				<?php endif; ?>
				
				<?php if(have_rows('bottom_section_list')): ?>
					<div class="tw:grid tw:grid-cols-1 tw:gap-y-8 tw:mb-12 tw:w-full">
						<?php 
						$counter = 1;
						while(have_rows('bottom_section_list')): the_row(); 
							$list_item_text = get_sub_field('list_item_text');
						?>
							<div class="tw:flex tw:items-center tw:gap-x-8 tw:md:gap-x-6">
								<div class="tw:w-1/12">
									<span class="tw:flex tw:items-center tw:justify-center tw:w-12 tw:h-12 tw:text-xl tw:font-bold tw:rounded-full" style="background-color: <?php echo esc_attr($bottom_text_color); ?>; color: <?php echo esc_attr($bottom_bg_color); ?>;">
										<?php echo $counter; ?>
									</span>
								</div>
								<div class="tw:w-11/12">
									<span class="tw:text-xl tw:font-semibold"><?php echo esc_html($list_item_text); ?></span>
								</div>
							</div>
						<?php 
						$counter++;
						endwhile; 
						?>
					</div>
				<?php endif; ?>
				
				<?php if($bottom_cta): ?>
					<a class="tw:border-2 tw:px-4 tw:py-3 tw:text-lg tw:font-semibold tw:rounded-full tw:hover:cursor-pointer" 
					href="<?php echo esc_url($bottom_cta['url']); ?>" 
					target="<?php echo esc_attr($bottom_cta['target'] ?: '_self'); ?>"
					style="background-color: rgb(218, 41, 28); color: white; border-color: rgb(218, 41, 28); display: inline-block;">
						<?php echo esc_html($bottom_cta['title']); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>
</main>

<?php
get_footer();
