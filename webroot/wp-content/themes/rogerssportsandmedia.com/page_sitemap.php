<?php
/**
 * Template Name: Sitemap
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
<?php
get_header();
global $post;
$hero_title = get_field('hero_title');
$hero_image = get_field('hero_image');
$hero_mobile_image = get_field('hero_mobile_image');
?>
<section class="hero">
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/ring-red.svg" alt="red decorative ring" class="deco" loading="lazy">

	<div class="wrapper">
		<span>Rogers Sports & Media</span>
		<h1><?php echo $hero_title ? $hero_title : get_the_title(); ?></h1>
	</div>
</section>

<!-- SKIP -->
<a role="banner" href="#content" class="skip-to-content button" aria-label="Skip to main content" tabindex="0">Skip to main content</a>

<main id="content" role="main">

	<!-- SITEMAP -->
	<?php if( have_rows('sitemap_rows') ) : ?>
		<section class="sitemap">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/square-lines-inside-yellow.svg" alt="yellow square beside diagonal lines pattern" class="deco" loading="lazy">
			<div class="wrapper">

				<?php while( have_rows('sitemap_rows') ) : the_row(); 
						$row_title = get_sub_field('row_title');
						$row_title_link = get_sub_field('row_title_link');
						$row_title_link_arialabel = get_sub_field('row_title_link_arialabel');
						?>
						<div class="maprow">
							<?php if ($row_title) : ?>
								<?php if ($row_title_link) : ?>
									<p class="title"><a href="<?php echo $row_title_link['url']; ?>" aria-label="<?php echo $row_title_link_arialabel ? $row_title_link_arialabel : $row_title; ?>"><?php echo $row_title; ?></a></p>
								<?php else : ?>
									<p class="title"><?php echo $row_title; ?></p>
								<?php endif; ?>
							<?php endif; ?>

							<?php if( have_rows('pages') ) : ?>
								<div class="grid items">
									<?php while( have_rows('pages') ) : the_row(); 
										$page_link = get_sub_field('page_link');
										?>
										<div><a href="<?php echo $page_link['url']; ?>" aria-label="Visit <?php echo $page_link['title']; ?>" target="<?php echo $page_link['target'] ? $page_link['target'] : '_self'; ?>"><?php echo $page_link['title']; ?></a></div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
				<?php endwhile; ?>

			</div>
		</section>
	<?php endif; ?>

</main>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
<?php
