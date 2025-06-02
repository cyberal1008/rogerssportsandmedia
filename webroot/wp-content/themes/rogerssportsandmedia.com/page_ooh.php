<?php
/**
 * Template Name: Out of Home
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/favicon.png" />
    <title><?php echo get_the_title(); ?> | Rogers Sports & Media</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin-alt.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/custom.css">
</head>
<?php get_header(); ?>

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

	<?php
		get_template_part(
			'template-parts/section-intro'
		);
	?>

	<!-- FEATURED VIDEO -->
	<?php
		$featured_video = get_field('featured_video');
	?>
	<section class="tw-bg-gray tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-48 2xl:tw-px-80">
		<?php if ($featured_video) : ?>
			<video controls>
				<source src="<?php echo $featured_video['url']; ?>" type="video/mp4">
				Your browser does not support the video tag.
			</video>
			<div style="padding-bottom: 32px;">&nbsp;</div>
		<?php endif; ?>
	</section>

	<!-- HIGHLIGHTS -->
	<?php get_template_part('template-parts/section-highlights'); ?>

	<!-- SOLUTIONS -->
	<?php
	if( have_rows('solutions') ) : 
		$sol_section_title = get_field('sol_section_title');
		?>
		<section id="solutions" class="solutions tw-bg-white">
			<div class="inner wrapper">
				<?php if ($sol_section_title) : ?>
					<h2 class="title2 tw-text-black"><?php echo $sol_section_title; ?></h2>
				<?php endif; ?>

				<div class="swiper sol-slider">
					<div class="swiper-wrapper grid two">
						
						<?php while( have_rows('solutions') ) : the_row(); 
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							$content = get_sub_field('content');
							?>
							<div class="swiper-slide">
								<div class="item">
									<?php if ($image) : ?>
										<div class="imgbox">
											<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>"  loading="lazy">
										</div>
									<?php endif; ?>
									<div class="txtbox">
										<?php if ($title) : ?>
											<p class="name"><?php echo $title; ?></p>
										<?php endif; ?>
										<?php echo $content; ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>

					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>

			<?php $sol_section_button = get_field('sol_section_button'); ?>
			<?php if ($sol_section_button) : ?>
				<div class="btn-wrap wrapper" style="margin-top: 48px">
					<a href="<?php echo $sol_section_button['url']; ?>" class="button" aria-label="<?php echo $sol_section_button['title'] ? $sol_section_button['title'] : 'Download Media Kit'; ?>" target="<?php echo $sol_section_button['target'] ? $sol_section_button['target'] : '_self'; ?>"><?php echo $sol_section_button['title'] ? $sol_section_button['title'] : 'Download Media Kit'; ?></a>
				</div>
			<?php endif; ?>
		</section>
	<?php endif; ?>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>
</main>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
<?php
