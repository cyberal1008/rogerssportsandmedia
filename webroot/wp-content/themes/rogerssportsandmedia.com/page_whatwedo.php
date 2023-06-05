<?php
/**
 * Template Name: What We Do
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

	<?php
	$hero_title = get_field('hero_title');
	$hero_image = get_field('hero_image');
	$hero_mobile_image = get_field('hero_mobile_image');
	?>
	<section class="hero">
		<picture>
			<source srcset="<?php echo $hero_image['url']; ?>"
					media="(min-width: 640px)">
			<img src="<?php echo $hero_mobile_image['url']; ?>" class="bg" alt="<?php echo $hero_image['alt']; ?>" />
		</picture>

		<div class="wrapper">
			<span>What We Do</span>
			<h1><?php echo $hero_title ? $hero_title : get_the_title(); ?></h1>
		</div>
	</section>

	<!-- SKIP -->
	<a role="banner" href="#content" class="skip-to-content button" aria-label="Skip to main content" tabindex="0">Skip to main content</a>

		<main id="content" role="main">

			<!-- INTRO -->
			<?php
			$intro_title = get_field('intro_title');
			$intro_content = get_field('intro_content');
			?>
			<section class="our-difference alt">
				<div class="wrapper">
					<div class="top">
						<?php if ($intro_title) : ?>
							<h2 class="title"><?php echo $intro_title; ?></h2>
						<?php endif; ?>
						<?php echo $intro_content; ?>
					</div>
				</div>
			</section>

			<!-- SERVICES -->
			<?php if( have_rows('products') ) : ?>
				<section class="service-grid">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/triangle-black.svg" alt="" class="deco">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/circle-white.svg" alt="" class="deco deco2">
					<div class="wrapper grid two">

						<?php while( have_rows('products') ) : the_row(); 
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							$excerpt = get_sub_field('excerpt');
							$link = get_sub_field('link');
							$link_arialabel = get_sub_field('link_arialabel');
							?>
							<div class="item">
								<?php if ($image) : ?>
									<a href="<?php echo $link['url']; ?>" aria-label="<?php echo $link_arialabel ? $link_arialabel : ''; ?>"><img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy"></a>
								<?php endif; ?>
								<div class="txtbox">
									<?php if ($title) : ?>
										<p class="title h4"><a href="<?php echo $link['url']; ?>" aria-label="<?php echo $link_arialabel ? $link_arialabel : ''; ?>"><?php echo $title; ?></a></p>
									<?php endif; ?>
									<?php if ($excerpt) : ?>
										<div class="excerpt"><?php echo $excerpt; ?></div>
									<?php endif; ?>
									<?php if ($link) : ?>
										<a href="<?php echo $link['url']; ?>" class="lined" aria-label="<?php echo $link_arialabel ? $link_arialabel : ''; ?>"><?php echo $link['title'] ? $link['title'] : 'Learn More'; ?></a>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile; ?>

						<?php if( have_rows('products_grey_box') ) : while( have_rows('products_grey_box') ) : the_row(); 
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							$excerpt = get_sub_field('excerpt');
							$link = get_sub_field('link');
							$link_arialabel = get_sub_field('link_arialabel');
							?>
							<div class="item noimg">
								<div class="txtbox">
									<?php if ($title) : ?>
										<p class="title h4"><a href="<?php echo $link['url']; ?>" aria-label="<?php echo $link_arialabel ? $link_arialabel : ''; ?>"><?php echo $title; ?></a></p>
									<?php endif; ?>
									<?php if ($excerpt) : ?>
										<div class="excerpt"><?php echo $excerpt; ?></div>
									<?php endif; ?>
									<?php if ($link) : ?>
										<a href="<?php echo $link['url']; ?>" class="button" aria-label="<?php echo $link_arialabel ? $link_arialabel : ''; ?>"><?php echo $link['title'] ? $link['title'] : 'Learn More'; ?></a>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile; endif; ?>
					</div>
				</section>
			<?php endif; ?>

		</main>

		<script src="https://kit.fontawesome.com/8ded1e9203.js" data-search-pseudo-elements crossorigin="anonymous"></script>
	    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>

<?php
get_footer();
