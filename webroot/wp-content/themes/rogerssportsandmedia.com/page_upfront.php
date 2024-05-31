<?php
/**
 * Template Name: Upfront
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
<?php
	get_header();
	global $post;
	$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );
?>

<main id="content" role="main">
	<!-- HERO -->
	<?php
		get_template_part(
			'template-parts/section-hero', null,
			array(
				'subtitle'		=> '',
				'title'     => isset($hero_title) ? $hero_title : get_the_title(),
			)
		);
	?>

	<!-- INTRO -->
	<?php
		get_template_part('template-parts/section-intro');
	?>

	<!-- INTRO -->
	<?php
		$intro_title = get_field('intro_title');
		$intro_content = get_field('intro_content');
		$brands_logos = get_field('brands_logos');
	?>
	<section class="our-difference alt nomargin">
		<div class="wrapper">
		</div>
	</section>

	<!-- UPFRONT CTA -->
	<?php
		$upfront_title = get_field('upfront_title');
		$upfront_link = get_field('upfront_link');
		$upfront_link_arialabel = get_field('upfront_link_arialabel');
		$upfront_image = get_field('upfront_image');
	?>
	<section id="upfront" class="tw-mb-16 tw-text-white tw-text-center tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-96 tw-relative tw-py-12 tw-h-[328px] md:tw-h-[500px] xl:tw-h-[612px]" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bkg_red_01.jpg'); background-size: cover; background-position: center;">
		<?php if ($upfront_title) : ?>	
			<div class="tw-font-bold tw-text-4xl md:tw-text-5xl tw-mb-12">
				<?php echo $upfront_title; ?>
			</div>
		<?php endif; ?>
		<?php if ($upfront_image) : ?>
			<!-- <a href="<?php echo $upfront_link['url']; ?>" aria-label="<?php echo $upfront_link_arialabel ? $upfront_link_arialabel : ''; ?>" target="<?php echo $upfront_link['target'] ? $upfront_link['target'] : '_self'; ?>"> -->
				<img src="<?php echo $upfront_image['sizes']['large']; ?>" alt="<?php echo $upfront_image['url']; ?>" loading="lazy">
			<!-- </a> -->
		<?php endif; ?>
		<?php if ($upfront_link) : ?>
			<!-- <div style="margin-top: 16px;">
				<a href="<?php echo $upfront_link['url']; ?>" class="button" aria-label="<?php echo $upfront_link_arialabel ? $upfront_link_arialabel : ''; ?>" target="<?php echo $upfront_link['target'] ? $upfront_link['target'] : '_self'; ?>"><?php echo $upfront_link['title'] ? $upfront_link['title'] : 'Watch Now'; ?></a>
			<div> -->
		<?php endif; ?>
	</section>
	
		<!-- INTRO -->
		<?php
		$intro_title = get_field('intro_title');
		$intro_content = get_field('intro_content');
		$brands_logos = get_field('brands_logos');
	?>
	<section class="our-difference alt nomargin">
		<div class="wrapper">
			<?php if ($brands_logos) : ?>
				<div class="swiper logo-slider">
					<div class="swiper-wrapper">
						<?php foreach ($brands_logos as $logo) : ?>
							<div class="swiper-slide">
								<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
							</div>
						<?php endforeach; ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- PROGRAMMING -->
	<?php
		$prog_section_title = get_field('prog_section_title');
		$prog_section_button = get_field('prog_section_button');
	?>	
	<section id="programming" class="programming">
		<div class="portfolio-main">
			<div class=" portfolio-page">
				<div class="inner wrapper">
					<hr class="tw-mb-6 tw-bg-gray tw-w-3/4 md:tw-w-3/5" />
					<div class="top md:tw-space-x-12" style="gap: 0rem; justify-content: start;">
						<?php if ($prog_section_title) : ?>
							<h2 class="section-title" style="margin-bottom: 16px"><?php echo $prog_section_title; ?></h2>
						<?php endif; ?>
						<?php if ($prog_section_button) : ?>
							<a href="<?php echo $prog_section_button['url']; ?>" class="button" aria-label="<?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?>" target="<?php echo $prog_section_button['target'] ? $prog_section_button['target'] : '_self'; ?>"><?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?></a>
						<?php endif; ?>
					</div>
					<?php
						get_template_part(
							'template-parts/portfolio',
							'program-slider',
							array(
								'page_meta'     => $page_meta,
							)
						);
					?>
				</div>
			</div>
		</div>
	</section>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>

</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>

<?php
get_footer();
