<?php
/**
 * Template Name: Sitemap
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header();
?>

<!-- SKIP -->
<a role="banner" href="#content" class="skip-to-content button" aria-label="Skip to main content" tabindex="0">Skip to main content</a>

<main id="content" role="main">

	<!-- SITEMAP -->
	<?php if( have_rows('sitemap_rows') ) : ?>
		<section class="sitemap">
			<div class="wrapper">
				<?php while( have_rows('sitemap_rows') ) : the_row(); 
						$row_title = get_sub_field('row_title');
						$row_title_link = get_sub_field('row_title_link');
						$row_title_link_arialabel = get_sub_field('row_title_link_arialabel');
						?>
						<div class="maprow">
							<?php if ($row_title) : ?>
								<?php if ($row_title_link) : ?>
									<h2 style="font-size: clamp(3.6rem, 5vw, 4.2rem);"><a href="<?php echo $row_title_link['url']; ?>" aria-label="<?php echo $row_title_link_arialabel ? $row_title_link_arialabel : $row_title; ?>"><?php echo $row_title; ?></a></h2>
								<?php else : ?>
									<h2 style="font-size: clamp(3.6rem, 5vw, 4.2rem);"><?php echo $row_title; ?></h2>
								<?php endif; ?>
							<?php endif; ?>

							<?php if( have_rows('pages') ) : ?>
								<ul>
									<?php while( have_rows('pages') ) : the_row(); 
										$page_link = get_sub_field('page_link');
										?>
										<li style="margin-bottom: 20px;"><a style="color: #2f6fa7; font-size: 1.6rem; font-weight: 600" href="<?php echo $page_link['url']; ?>" aria-label="Visit <?php echo $page_link['title']; ?>" target="<?php echo $page_link['target'] ? $page_link['target'] : '_self'; ?>"><?php echo $page_link['title']; ?> ></a></li>
									<?php endwhile; ?>
								</ul>
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
