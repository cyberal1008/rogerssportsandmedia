<?php
/**
 * Template Name: Audio
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */
?>
<!DOCTYPE html>
<html lang="en" class="audio-landing">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/favicon.png" />
    <title>Rogers Sports & Media</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/main.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin-alt.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/custom.css">
</head>
<?php get_header(); ?>

	<div class="portfolio-main">

		<main id="content" role="main">

			<!-- HERO -->
			<?php
				get_template_part(
					'template-parts/section-hero', null,
					array(
						'subtitle'		=> 'What We Do',
						'title'     => isset($hero_title) ? $hero_title : get_the_title(),
					)
				);
			?>

			<!-- INTRO -->
			<?php
				get_template_part('template-parts/section-intro');
			?>

			<?php
				$intro_title = get_field('intro_title');
				$intro_content = get_field('intro_content');
				$button_type = get_field('button_type');
			?>
			<section class="intro">
				<div class="wrapper">
					<div class="swiper logo-slider">
						<div class="swiper-wrapper">
							
							<!-- SINGLE -->
							<div class="swiper-slide">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/slide1.png" alt="Logos for CityNews 680, 98.1 CHFI, KiSS radio, Sportsnet 590 the Fan, Jack radio, 93.5 Country radio" loading="lazy">
							</div>
							<!-- SINGLE -->
							<div class="swiper-slide">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/slide2.png" alt="Logos for The Big Story podcast, 92.1 CITI, Sonic 102.9, 101.3 Easy radio, K Rock 105.7, Mountain FM" loading="lazy">
							</div>
						
						</div>
						<div class="swiper-pagination"></div>
					</div>
				</div>
			</section>

			<section id="highlights" class="tw-px-4 tw-py-12 md:tw-px-16 lg:tw-px-32 xl:tw-px-48 2xl:tw-px-80 md:tw-py-24" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/red_bkg.jpg'); background-size: cover; background-position: center;">
				<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-text-white tw-gap-y-10 md:tw-gap-x-16">
					<?php if( have_rows('yellow_circle') ) : while( have_rows('yellow_circle') ) : the_row(); 
						$number = get_sub_field('number');
						$caption = get_sub_field('caption');
					?>
						<div class="tw-full">
							<div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
								<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span>
							</div>
							<?php if ($caption) : ?>
								<div class="tw-text-lg"><?php echo $caption; ?></div>
							<?php endif; ?>
						</div>
					<?php endwhile; endif; ?>
					<?php if( have_rows('red_circle') ) : while( have_rows('red_circle') ) : the_row(); 
						$number = get_sub_field('number');
						$caption = get_sub_field('caption');
					?>
						<div class="tw-full">
							<div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
								<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><span class="sign bold"><sup>%</sup></span>
							</div>
							<?php if ($caption) : ?>
								<div class="tw-text-lg"><?php echo $caption; ?></div>
							<?php endif; ?>
						</div>
					<?php endwhile; endif; ?>
					<?php if( have_rows('blue_circle') ) : while( have_rows('blue_circle') ) : the_row(); 
						$number = get_sub_field('number');
						$caption = get_sub_field('caption');
					?>
						<div class="tw-full">
							<div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
								<span class="sign bold">#</span><span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span>
							</div>
							<?php if ($caption) : ?>
								<div class="tw-text-lg"><?php echo $caption; ?></div>
							<?php endif; ?>
						</div>
					<?php endwhile; endif; ?>
					<?php if( have_rows('banner_1') ) : while( have_rows('banner_1') ) : the_row(); 
						$number = get_sub_field('number');
						$number_text = get_sub_field('number_text');
						$caption = get_sub_field('caption');
					?>
						<div class="tw-full">
							<div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
								<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><span class="sign bold"><?php echo $number_text; ?></span>
							</div>
							<?php if ($caption) : ?>
								<div class="tw-text-lg"><?php echo $caption; ?></div>
							<?php endif; ?>
						</div>
					<?php endwhile; endif; ?>
					<?php if( have_rows('banner_2') ) : while( have_rows('banner_2') ) : the_row(); 
						$number = get_sub_field('number');
						$number_text = get_sub_field('number_text');
						$caption = get_sub_field('caption');
					?>
						<div class="tw-full">
							<div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
								<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><span class="sign bold"><?php echo $number_text; ?></span>
							</div>
							<?php if ($caption) : ?>
								<div class="tw-text-lg"><?php echo $caption; ?></div>
							<?php endif; ?>
						</div>
					<?php endwhile; endif; ?>
				</div>
			</section>
			
			<?php
				$prog_section_title = get_field('program_section_title');
				$prog_section_button = get_field('program_section_button');
			?>
			<section id="stations-podcasts" class="stations-podcasts">
				<div class="wrapper">
					<div class="tw-flex tw-flex-col md:tw-flex-row tw-mb-6 md:tw-mb-4 md:tw-space-x-12">
						<?php if ($prog_section_title) : ?>
							<div class="tw-text-gray-dark tw-text-4xl md:tw-text-5xl tw-font-bold tw-mb-3 md:tw-mb-0"><?php echo $prog_section_title; ?></div>
						<?php endif; ?>
						<?php if ($prog_section_button) : ?>
							<div><a href="<?php echo $prog_section_button['url']; ?>" class="button" aria-label="<?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?>" target="<?php echo $prog_section_button['target'] ? $prog_section_button['target'] : '_self'; ?>"><?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?></a></div>
						<?php endif; ?>
					</div>
					<div class="portfolio-page">
							<?php
								$original_post = $post;
								$page_id = get_the_ID();
								get_template_part(
									'template-parts/portfolio',
									'radio',
									array(
										'page_id' => $page_id
									)
								);
								$post = $original_post;
							?>
					</div>
				</div>
			</section>

			<!-- WHAT'S HAPPENING -->
			<?php
				get_template_part(
					'template-parts/section-whats-happening', null,
					array(
						'zone' => 'whats-happening-radio',
					)
				);
			?>

			<!-- PARTNER -->
			<?php get_template_part('template-parts/section-partner'); ?>

		</main>

	    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/main.min.js"></script>

	</div>
<?php
get_footer();
