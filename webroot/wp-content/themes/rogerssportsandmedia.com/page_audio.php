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
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin-alt.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/custom.css?v=1.0.7">
	<style>
		.logo-slider {
			display: block;
		}
	</style>
</head>
<?php get_header(); ?>

	<div class="portfolio-main">

		<main id="content" role="main">

			<!-- HERO -->
			<?php
				get_template_part(
					'template-parts/section-hero', null,
					array(
						'title' => get_the_title(),
					)
				);
			?>

			<!-- INTRO -->
			<?php
				get_template_part('template-parts/section-intro');
			?>

			<?php
				$brands_logos = get_field('brand_logos');
			?>
			<section class="tw-bg-gray tw-py-12">
				<div class="wrapper">
					<?php if ($brands_logos): ?>
					<div class="swiper logo-slider">
						<div class="swiper-wrapper">
							<?php
								$logo_chunks = array_chunk($brands_logos, 4);
							?>
							<?php foreach ($logo_chunks as $logo_chunk): ?>
								<div class="swiper-slide">
									<?php foreach ($logo_chunk as $logo): ?>
										<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
									<?php endforeach; ?>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<?php endif; ?>
				</div>
			</section>

			<!-- FEATURED VIDEO -->
			<?php get_template_part('template-parts/section-featured-video'); ?>

			<!-- HIGHLIGHTS -->
			<?php get_template_part('template-parts/section-highlights'); ?>
			
			<?php
				$prog_section_title = get_field('program_section_title');
				$prog_section_button = get_field('program_section_button');
			?>
			<section id="stations-podcasts" class="stations-podcasts tw-bg-gray">
				<div class="wrapper">
					<div class="tw-flex tw-flex-col md:tw-flex-row tw-mb-6 md:tw-mb-4 md:tw-space-x-12">
						<?php if ($prog_section_title) : ?>
							<h2 class="title2 tw-text-black tw-mb-3 md:tw-mb-0"><?php echo $prog_section_title; ?></h2>
						<?php endif; ?>
						<?php if ($prog_section_button) : ?>
							<div><a href="<?php echo $prog_section_button['url']; ?>" class="button" aria-label="<?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download Buyers Guide'; ?>" target="<?php echo $prog_section_button['target'] ? $prog_section_button['target'] : '_self'; ?>"><?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download Buyers Guide'; ?></a></div>
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

			<!-- PARTNER -->
			<?php get_template_part('template-parts/section-partner'); ?>

		</main>

	    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/main.min.js"></script>

	</div>
<?php
get_footer();
