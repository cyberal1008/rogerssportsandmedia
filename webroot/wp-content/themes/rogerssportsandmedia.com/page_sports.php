<?php
/**
 * Template Name: Sports
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header();
?>

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


	<!-- INTRO -->
	<?php
		$brands_logos = get_field('brands_logos');
	?>
	<section class="our-difference alt nomargin">
		<div class="wrapper">
			<?php if ($brands_logos) : ?>
				<?php get_template_part( 'template-parts/logo-marquee', null, array( 'logos' => $brands_logos, 'class' => 'logo-marquee--gap-bottom' ) ); ?>
			<?php endif; ?>
		</div>
	</section>

	<!-- HIGHLIGHTS -->
	<?php get_template_part('template-parts/section-highlights'); ?>


	<!-- FEATURED VIDEO -->
	<?php
		$featured_video = get_field('featured_video');
		if ($featured_video) :
	?>
	<section>
		<div class="wrapper">
			<div class="tw:mb-4">&nbsp;</div>
			<video class="tw:w-full" controls>
				<source src="<?php echo $featured_video['url']; ?>" type="video/mp4">
				Your browser does not support the video tag.
			</video>
		</div>
	</section>
	<?php endif; ?>

	<!-- PLATFORMS -->
	<?php 
	if( have_rows('platforms') ) : 
		$plat_section_title = get_field('plat_section_title');
		$plat_section_button = get_field('plat_section_button');
		?>
		<section id="platforms" class="service-grid">
			<div class="wrapper">
				<?php if ($plat_section_title) : ?>
					<h2 class="title2 tw-text-black"><?php echo $plat_section_title; ?></h2>
				<?php endif; ?>

				<div class="swiper plat-slider">
					<div class="swiper-wrapper grid tight">

						<?php while( have_rows('platforms') ) : the_row(); 
							$title = get_sub_field('title');
							$description = get_sub_field('description');
							$link = get_sub_field('link');
							$link_arialabel = get_sub_field('link_arialabel');
							$image = get_sub_field('image');
							?>
							<div class="swiper-slide">
								<div class="item">
									<?php if ($image) : ?>
										<?php if ($link) : ?>
											<a href="<?php echo $link['url']; ?>" aria-label="<?php echo $link_arialabel ? $link_arialabel : $link['title']; ?>"><img src="<?php echo $image['sizes']['medium_large']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy"></a>
										<?php else : ?>
											<img src="<?php echo $image['sizes']['medium_large']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy">
										<?php endif; ?>
									<?php endif; ?>
									<div class="txtbox">
										<?php if ($title) : ?>
											<?php if ($link) : ?>
												<p class="title h4 tw-text-black"><a href="<?php echo $link['url']; ?>" aria-label="<?php echo $link_arialabel ? $link_arialabel : $link['title']; ?>"><?php echo $title; ?></a></p>
											<?php else : ?>
												<p class="title h4 tw-text-black"><?php echo $title; ?></p>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ($description) : ?>
											<div class="excerpt"><?php echo $description; ?></div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>

					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- WHAT'S HAPPENING -->
	<?php
	get_template_part(
		'template-parts/section-whats-happening', null,
		array(
			'zone'		=> 'whats-happening-sports',
		)
	);
	?>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>
</main>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
