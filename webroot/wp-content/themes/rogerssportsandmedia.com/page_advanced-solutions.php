<?php
/**
 * Template Name: Advanced Solutions
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
				<a href="#advanced" aria-label="Advanced Solutions">Advanced Solutions</a>
				<a href="#red" aria-label="R.E.D.">R.E.D.</a>
				<a href="#suite" aria-label="AS Suite">AS Suite</a>
				<a href="#trends" aria-label="What's Happening">What's Happening</a>
				<a href="#partner" aria-label="Partner With Us">Partner With Us</a>
			</div>
		</div>
	</section>

	<!-- INTRO -->
	<?php
	$intro_title = get_field('intro_title');
	$intro_content = get_field('intro_content');
	?>
	<section class="our-difference alt nomargin">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/semicircles-red.svg" alt="decorative red semicircles" class="deco top-left">
		<div class="wrapper">
			<div class="topblock">
				<?php if ($intro_title) : ?>
					<h2 class="title"><?php echo $intro_title; ?></h2>
				<?php endif; ?>
				<?php echo $intro_content; ?>
			</div>
		</div>
	</section>

	<!-- ADVANCED LIST -->
	<?php get_template_part('template-parts/section-advanced-list'); ?>

	<!-- R.E.D. -->
	<?php
	$red_section_title = get_field('red_section_title');
	$red_content = get_field('red_content');
	$red_image = get_field('red_image');
	?>
	<section id="red" class="discover alt">
		<div class="inner wrapper">
			<div class="imgbox">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/square-lines-yellow.svg" alt="decorative yellow square beside diagonal lines" class="deco1" loading="lazy">
				<?php if ($red_image) : ?>
					<img src="<?php echo $red_image['sizes']['large']; ?>" alt="<?php echo $red_image['alt']; ?>" loading="lazy">
				<?php endif; ?>
			</div>
			<div class="txtbox">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/diamond-teal.svg" class="deco2" alt="teal diamond" loading="lazy">
				<?php if ($red_section_title) : ?>
					<h2 class="title"><?php echo $red_section_title; ?></h2>
				<?php endif; ?>
				<?php echo $red_content; ?>
			</div>
		</div>
	</section>

	<!-- ICON COLUMNS -->
	<?php
	get_template_part(
		'template-parts/section-icon-columns', null,
		array(
			'deco'   => array(
				'url' => get_stylesheet_directory_uri() . '/assets/home/images/circle-white.svg',
				'class'    => 'deco',
				'alt'     => 'grey decorative rings'
			),
		)
	);
	?>

	<!-- CASE STUDIES -->
	<?php get_template_part('template-parts/section-case-studies'); ?>

	<!-- WHAT'S HAPPENING -->
	<?php
	get_template_part(
		'template-parts/section-whats-happening', null,
		array(
			'zone'		=> 'whats-happening-advanced-advertising',
			'class'     => '',
			'deco'   => array(
				'url' => get_stylesheet_directory_uri() . '/assets/home/images/circle-white.svg',
				'class'    => 'deco',
				'alt'     => 'grey decorative rings'
			),
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
