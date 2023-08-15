<?php
/**
 * Template Name: Sports
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
</head>
<?php get_header(); ?>

<!-- SKIP -->
<a role="banner" href="#content" class="skip-to-content button" aria-label="Skip to main content" tabindex="0">Skip to main content</a>

<main id="content" role="main">

	<!-- HERO -->
	<?php
	get_template_part(
		'template-parts/section-hero', null,
		array(
			'subtitle'		=> 'What We Do',
			'title'     => $hero_title ? $hero_title : get_the_title(),
		)
	);
	?>

	<!-- ANCHORS -->
	<section class="anchors desktop">
		<div class="wrapper">
			<div class="anchor-list">
				<a href="#capabilities" aria-label="Our Capabilities">Our Capabilities</a>
				<a href="#platforms" aria-label="Platforms">Platforms</a>
				<a href="#highlights" aria-label="Highlights">Highlights</a>
				<a href="#trends" aria-label="What's Happening">What's Happening</a>
				<a href="#partner" aria-label="Partner With Us">Partner With Us</a>
			</div>
		</div>
	</section>

	<!-- INTRO -->
	<?php
	$intro_title = get_field('intro_title');
	$intro_content = get_field('intro_content');
	$brands_logos = get_field('brands_logos');
	?>
	<section class="our-difference alt nomargin">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/square-lines-spaced-yellow.svg" alt="yellow square beside diagonal lines pattern" class="deco top-right">
		<div class="wrapper">
			<div class="topblock">
				<?php if ($intro_title) : ?>
					<h2 class="title"><?php echo $intro_title; ?></h2>
				<?php endif; ?>
				<?php echo $intro_content; ?>
			</div>
			<?php if ($brands_logos) : ?>
				<div class="swiper logo-slider-mobile">
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

	<!-- VIDEO SLIDER -->
	<?php get_template_part('template-parts/section-vidslider'); ?>

	<!-- PLATFORMS -->
	<?php 
	if( have_rows('platforms') ) : 
		$plat_section_title = get_field('plat_section_title');
		$plat_section_button = get_field('plat_section_button');
		?>
		<section id="platforms" class="service-grid alt">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/circles-dots-blue.svg" alt="Decorative blue circles beside a dot pattern" class="deco deco3">
			<div class="wrapper">
				<?php if ($plat_section_title) : ?>
					<h2 class="section-title"><?php echo $plat_section_title; ?></h2>
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
												<p class="title h4"><a href="<?php echo $link['url']; ?>" aria-label="<?php echo $link_arialabel ? $link_arialabel : $link['title']; ?>"><?php echo $title; ?></a></p>
											<?php else : ?>
												<p class="title h4"><?php echo $title; ?></p>
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
				<?php if ($plat_section_button) : ?>
					<div class="btn-wrap">
						<a href="<?php echo $plat_section_button['url']; ?>" class="button" aria-label="<?php echo $plat_section_button['title'] ? $plat_section_button['title'] : 'Learn More'; ?>"><?php echo $plat_section_button['title'] ? $plat_section_button['title'] : 'Learn More'; ?></a>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- HIGHLIGHTS -->
	<?php if( have_rows('highlights') ) : 
		$highlights_bottom_text = get_field('highlights_bottom_text');
		?>
		<section id="highlights" class="highlights">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/circle-white.svg" alt="grey decorative rings" class="deco" loading="lazy">
			<div class="wrapper">
				<div class="grid circle-stats">
					<?php while( have_rows('highlights') ) : the_row(); 
						$number = get_sub_field('number');
						$number_text = get_sub_field('number_text');
						$text = get_sub_field('text');
						$circle_color = get_sub_field('circle_color');
						?>
						<div class="item">
							<?php if ($number) : ?> 
								<div class="stat <?php echo $circle_color ? $circle_color : ''; ?>">
									<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span>
									<?php if ($number_text) : ?>
										<span class="sign bold"><?php echo $number_text; ?></span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ($text) : ?>
								<p class="desc"><?php echo $text; ?></p>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>

				<?php if ($highlights_bottom_text) : ?>
					<div class="banner-stats inline">
						<p><?php echo $highlights_bottom_text; ?></p>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- WHAT'S HAPPENING -->
	<?php
	get_template_part(
		'template-parts/section-whats-happening', null,
		array(
			'zone'		=> 'whats-happening-sports',
			'class'     => 'alt',
		)
	);
	?>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>
</main>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
<?php
